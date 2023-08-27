<?php

namespace App\Http\Controllers;

use App\Models\Target;
use Illuminate\Http\Request;
use App\Models\LaporanFinance;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class KkpController extends Controller
{
    public function index()
    {
        $kkpData = DB::table('laporan_finance')
            ->select(
                DB::raw('YEAR(tanggal) as year'),
                DB::raw('MONTH(tanggal) as month'),
                DB::raw('SUM(nilai) as total_nilai')
            )
            ->groupBy('year', 'month')
            ->orderBy('year', 'asc')
            ->orderBy('month', 'asc')
            ->get();

        $tahunData = Target::distinct()->where('jenis_laporan', '=', 'KKP')->get(['tahun']);

        $targetData = DB::table('target')
            ->select(
                DB::raw('tahun as year'),
                DB::raw('bulan as month'),
                DB::raw('SUM(jumlah) as total_nilai')
            )
            ->where('jenis_laporan', '=', 'KKP')
            ->groupBy('tahun', 'bulan')
            ->orderBy('tahun', 'asc')
            ->orderBy('bulan', 'asc')
            ->get();


        $monthMapping = [
            'Januari' => 1,
            'Februari' => 2,
            'Maret' => 3,
            'April' => 4,
            'Mei' => 5,
            'Juni' => 6,
            'Juli' => 7,
            'Agustus' => 8,
            'September' => 9,
            'Oktober' => 10,
            'November' => 11,
            'Desember' => 12,
        ];

        $targetGap = DB::table('target')
            ->select(
                DB::raw('tahun as year'),
                DB::raw('bulan as month'),
                DB::raw('SUM(jumlah) as total_nilai')
            )
            ->where('jenis_laporan', '=', 'KKP')
            ->groupBy('tahun', 'bulan')
            ->orderBy('tahun', 'asc')
            ->orderBy('bulan', 'asc')
            ->get()
            ->map(function ($item) use ($monthMapping) {
                $item->month = $monthMapping[$item->month];
                return $item;
            });

        $gapData = [];

        foreach ($kkpData as $kkpItem) {
            foreach ($targetGap as $targetItem) {
                if ($kkpItem->year == $targetItem->year && $kkpItem->month == $targetItem->month) {
                    $gapData[] = [
                        'year' => $kkpItem->year,
                        'month' => $kkpItem->month,
                        'gap' => $targetItem->total_nilai - $kkpItem->total_nilai,
                    ];
                    break;
                }
            }
        }
        
        $newestYear = LaporanFinance::max(DB::raw('YEAR(tanggal)'));
        $TotalRealisasiKKP = LaporanFinance::whereYear("tanggal", [$newestYear])
            ->sum('nilai');

        $lastYear = $newestYear-1;
        $TotalRealisasiKKP2 = LaporanFinance::whereYear("tanggal", [$lastYear])
            ->sum('nilai');


        if ($TotalRealisasiKKP2 != 0) {
            $kenaikanRealisasi = ($TotalRealisasiKKP - $TotalRealisasiKKP2) / $TotalRealisasiKKP2 * 100;
        } else {
            $kenaikanRealisasi = 0;
        }

        $account = Auth::guard('account')->user();
        if ($account->role == "Finance") {
            return view('finance.dashboard.chart', [
                "title" => "KKP",
                "kkpData" => $kkpData,
                'tahunData' => $tahunData,
                "TotalRealisasiKKP" => $TotalRealisasiKKP,
                "kenaikanRealisasi" => $kenaikanRealisasi,
                "gapData" => $gapData,
                // "revenueData" => $revenueData,
                "targetData" => $targetData
            ]);
        }
        else{
            return view('admin.dashboard.kkp', [
                "title" => "KKP",
                "kkpData" => $kkpData,
                'tahunData' => $tahunData,
                "TotalRealisasiKKP" => $TotalRealisasiKKP,
                "kenaikanRealisasi" => $kenaikanRealisasi,
                "gapData" => $gapData,
                // "revenueData" => $revenueData,
                "targetData" => $targetData
            ]);
        }
    }
}