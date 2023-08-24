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
                DB::raw('YEAR(created_at) as year'),
                DB::raw('MONTH(created_at) as month'),
                DB::raw('SUM(nilai) as total_nilai')
            )
            ->groupBy('year', 'month')
            ->orderBy('year', 'asc')
            ->orderBy('month', 'asc')
            ->get();

        $tahunData = Target::distinct()->get(['tahun']);

        // $revenueData = DB::table('laporan_finance')
        //     ->select(
        //         DB::raw('YEAR(created_at) as year'),
        //         DB::raw('MONTH(created_at) as month'),
        //         DB::raw('SUM(nilai) as total_nilai')
        //     )
        //     ->where('jenis_laporan', '=', 'REVENUE')
        //     ->groupBy('year', 'month')
        //     ->orderBy('year', 'asc')
        //     ->orderBy('month', 'asc')
        //     ->get();

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
        
        $year1 = '2023';
        $TotalRealisasiKKP = LaporanFinance::whereRaw("SUBSTRING_INDEX(tanggal, '-', 1) = ?", [$year1])
            ->sum('nilai');

        $year2 = '2022';
        $TotalRealisasiKKP2 = LaporanFinance::whereRaw("SUBSTRING_INDEX(tanggal, '-', 1) = ?", [$year2])
            ->sum('nilai');

        $kenaikanRealisasi = ($TotalRealisasiKKP - $TotalRealisasiKKP2)/$TotalRealisasiKKP2 * 100;

        $account = Auth::guard('account')->user();
        if ($account->role == "Finance") {
            return view('finance.dashboard.chart', [
                "title" => "KKP",
                "kkpData" => $kkpData,
                'tahunData' => $tahunData,
                "TotalRealisasiKKP" => $TotalRealisasiKKP,
                "kenaikanRealisasi" => $kenaikanRealisasi,
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
                // "revenueData" => $revenueData,
                "targetData" => $targetData
            ]);
        }
    }
}