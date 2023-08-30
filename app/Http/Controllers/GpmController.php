<?php

namespace App\Http\Controllers;

use App\Models\Target;
use Illuminate\Http\Request;
use App\Models\LaporanCommerce;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class GpmController extends Controller
{
    //
    public function index()
    {
        //======== CHART REALISASI KKP OPERASIONAL ==========
        $realisasiDataRevenue = DB::table('laporan_commerce')
            ->select(
                DB::raw('YEAR(tanggal) as year'),
                DB::raw('MONTH(tanggal) as month'),
                DB::raw('SUM(nilai) as total_nilai')
            )
            ->groupBy('year', 'month')
            ->orderBy('year', 'asc')
            ->orderBy('month', 'asc')
            ->where('jenis_laporan', '=', 'REVENUE')
            ->get();

        $realisasiDataCOGS = DB::table('laporan_commerce')
            ->select(
                DB::raw('YEAR(tanggal) as year'),
                DB::raw('MONTH(tanggal) as month'),
                DB::raw('SUM(nilai) as total_nilai')
            )
            ->groupBy('year', 'month')
            ->orderBy('year', 'asc')
            ->orderBy('month', 'asc')
            ->where('jenis_laporan', '=', 'COGS')
            ->get();

        // $tahunData = Target::distinct()->where('jenis_laporan', '=', 'COGS')->get(['tahun']);
        $query ="
                    SELECT DISTINCT YEAR(tanggal) AS year
                    FROM laporan_commerce
                    WHERE jenis_laporan = 'REVENUE'
                    ORDER BY year DESC
                ";

        $tahunData = DB::select(DB::raw($query));
        
        // dd($tahunData);
        
        $gpmData1 = [];

        foreach ($realisasiDataRevenue as $revenueItem) {
            foreach ($realisasiDataCOGS as $cogsItem) {
                if ($revenueItem->year == $cogsItem->year && $revenueItem->month == $cogsItem->month) {
                    $gpmData1[] = [
                        'year' => $revenueItem->year,
                        'month' => $revenueItem->month,
                        'gpm' => $revenueItem->total_nilai - $cogsItem->total_nilai,
                    ];
                    break;
                }
            }
        }

        $gpmData2 = [];

        foreach ($realisasiDataRevenue as $revenueItem) {
            foreach ($realisasiDataCOGS as $cogsItem) {
                if ($revenueItem->year == $cogsItem->year && $revenueItem->month == $cogsItem->month) {
                    $gpmData2[] = [
                        'year' => $revenueItem->year,
                        'month' => $revenueItem->month,
                        'gpm' => (($revenueItem->total_nilai - $cogsItem->total_nilai)/$revenueItem->total_nilai) * 100,
                    ];
                    break;
                }
            }
        }

        // dd($gpmData2);

        
        
        //======== CARD STATISTIC ==========
        $newestYear = LaporanCommerce::max(DB::raw('YEAR(tanggal)'));
        $TotalRealisasiKKP = LaporanCommerce::whereYear("tanggal", [$newestYear])
            ->sum('nilai');

        $lastYear = $newestYear-1;
        $TotalRealisasiKKP2 = LaporanCommerce::whereYear("tanggal", [$lastYear])
            ->sum('nilai');


        if ($TotalRealisasiKKP2 != 0) {
            $kenaikanRealisasi = ($TotalRealisasiKKP - $TotalRealisasiKKP2) / $TotalRealisasiKKP2 * 100;
        } else {
            $kenaikanRealisasi = 0;
        }

        $account = Auth::guard('account')->user();
        if ($account->role == "Commerce") {
            return view('commerce.dashboard.gpm', [
                "title" => "KKP",
                "gpmData1" => $gpmData1,
                "gpmData2" => $gpmData2,
                'tahunData' => $tahunData,
                "TotalRealisasiKKP" => $TotalRealisasiKKP,
                "kenaikanRealisasi" => $kenaikanRealisasi,
            ]);
        }
        else{
            return view('admin.dashboard.gpm', [
                "title" => "GPM",
                "gpmData1" => $gpmData1,
                "gpmData2" => $gpmData2,
                'tahunData' => $tahunData,
                "TotalRealisasiKKP" => $TotalRealisasiKKP,
                "kenaikanRealisasi" => $kenaikanRealisasi,
            ]);
        }
    }
}