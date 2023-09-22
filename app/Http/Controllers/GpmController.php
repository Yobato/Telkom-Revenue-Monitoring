<?php

namespace App\Http\Controllers;

// use App\Models\Target;
use App\Models\LaporanCommerce;
use App\Models\Portofolio;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class GpmController extends Controller
{
    //
    public function index()
    {
        //======== CHART Gross Profit ==========
        $account = Auth::guard('account')->user();
        if ($account->role == 'Admin' || $account->role == 'GM') {
            // $realisasiDataRevenue = DB::table('laporan_commerce')
            //     ->select(
            //         DB::raw('YEAR(tanggal) as year'),
            //         DB::raw('MONTH(tanggal) as month'),
            //         DB::raw('SUM(nilai) as total_nilai')
            //     )
            //     ->groupBy('year', 'month')
            //     ->orderBy('year', 'asc')
            //     ->orderBy('month', 'asc')
            //     ->where('jenis_laporan', '=', 'REVENUE')
            //     ->get();

            // $realisasiDataCOGS = DB::table('laporan_commerce')
            //     ->select(
            //         DB::raw('YEAR(tanggal) as year'),
            //         DB::raw('MONTH(tanggal) as month'),
            //         DB::raw('SUM(nilai) as total_nilai')
            //     )
            //     ->groupBy('year', 'month')
            //     ->orderBy('year', 'asc')
            //     ->orderBy('month', 'asc')
            //     ->where('jenis_laporan', '=', 'COGS')
            //     ->get();

            $realisasiDataRevenuePortofolio = DB::table('laporan_commerce')
                ->select(
                    'id_portofolio',
                    DB::raw('YEAR(tanggal) as year'),
                    DB::raw('MONTH(tanggal) as month'),
                    DB::raw('SUM(nilai) as total_nilai')
                )
                ->groupBy('id_portofolio', 'year', 'month')
                ->orderBy('year', 'asc')
                ->orderBy('month', 'asc')
                ->where('jenis_laporan', '=', 'REVENUE')
                ->get();

            $realisasiDataCOGSPortofolio = DB::table('laporan_commerce')
                ->select(
                    'id_portofolio',
                    DB::raw('YEAR(tanggal) as year'),
                    DB::raw('MONTH(tanggal) as month'),
                    DB::raw('SUM(nilai) as total_nilai')
                )
                ->groupBy('id_portofolio', 'year', 'month')
                ->orderBy('year', 'asc')
                ->orderBy('month', 'asc')
                ->where('jenis_laporan', '=', 'COGS')
                ->get();
        } else {
            // $realisasiDataRevenue = DB::table('laporan_commerce')
            //     ->select(
            //         DB::raw('YEAR(tanggal) as year'),
            //         DB::raw('MONTH(tanggal) as month'),
            //         DB::raw('SUM(nilai) as total_nilai')
            //     )
            //     ->groupBy('year', 'month')
            //     ->orderBy('year', 'asc')
            //     ->orderBy('month', 'asc')
            //     ->where('kota', '=', $account->kota)
            //     ->where('jenis_laporan', '=', 'REVENUE')
            //     ->get();

            // $realisasiDataCOGS = DB::table('laporan_commerce')
            //     ->select(
            //         DB::raw('YEAR(tanggal) as year'),
            //         DB::raw('MONTH(tanggal) as month'),
            //         DB::raw('SUM(nilai) as total_nilai')
            //     )
            //     ->groupBy('year', 'month')
            //     ->orderBy('year', 'asc')
            //     ->orderBy('month', 'asc')
            //     ->where('kota', '=', $account->kota)
            //     ->where('jenis_laporan', '=', 'COGS')
            //     ->get();

            $realisasiDataRevenuePortofolio = DB::table('laporan_commerce')
                ->select(
                    'id_portofolio',
                    DB::raw('YEAR(tanggal) as year'),
                    DB::raw('MONTH(tanggal) as month'),
                    DB::raw('SUM(nilai) as total_nilai')
                )
                ->groupBy('id_portofolio', 'year', 'month')
                ->orderBy('year', 'asc')
                ->orderBy('month', 'asc')
                ->where('kota', '=', $account->kota)
                ->where('jenis_laporan', '=', 'REVENUE')
                ->get();

            $realisasiDataCOGSPortofolio = DB::table('laporan_commerce')
                ->select(
                    'id_portofolio',
                    DB::raw('YEAR(tanggal) as year'),
                    DB::raw('MONTH(tanggal) as month'),
                    DB::raw('SUM(nilai) as total_nilai')
                )
                ->groupBy('id_portofolio', 'year', 'month')
                ->orderBy('year', 'asc')
                ->orderBy('month', 'asc')
                ->where('kota', '=', $account->kota)
                ->where('jenis_laporan', '=', 'COGS')
                ->get();
        }

        // dd($realisasiDataRevenue);

        //======== Fungsi Filter Berdasarkan Tahun laporan Revenue==========
        if ($account->role == 'Admin' || $account->role == 'GM') {
            $query = "
                        SELECT DISTINCT YEAR(tanggal) AS year
                        FROM laporan_commerce
                        WHERE jenis_laporan = 'REVENUE'
                        ORDER BY year DESC
                    ";
        } else {
            $query = "
                        SELECT DISTINCT YEAR(tanggal) AS year
                        FROM laporan_commerce
                        WHERE jenis_laporan = 'REVENUE' AND kota = $account->kota
                        ORDER BY year DESC
                    ";
        }

        $tahunData = DB::select(DB::raw($query));

        //======== Fungsi Filter Portofolio berdasarkan Laporan Revenue==========
        $filterPortofolio = DB::table('laporan_commerce')
            ->join('portofolio', 'laporan_commerce.id_portofolio', '=', 'portofolio.id')
            ->where('laporan_commerce.jenis_laporan', 'REVENUE')
            ->select('portofolio.id', 'portofolio.nama_portofolio')
            ->distinct()
            ->get();

        //======== RUMUS CHART Gross Profit ==========
        $gpmData1 = [];
        foreach ($realisasiDataRevenuePortofolio as $revenueItem) {
            foreach ($realisasiDataCOGSPortofolio as $cogsItem) {
                if ($revenueItem->year == $cogsItem->year && $revenueItem->month == $cogsItem->month && $revenueItem->id_portofolio == $cogsItem->id_portofolio) {
                    $gpmData1[] = [
                        'id_portofolio' => $revenueItem->id_portofolio,
                        'year' => $revenueItem->year,
                        'month' => $revenueItem->month,
                        'gpm' => $revenueItem->total_nilai - $cogsItem->total_nilai,
                    ];
                    break;
                }
            }
        }

        $PortfolioGPM = [];
        foreach ($realisasiDataRevenuePortofolio as $revenueItem) {
            foreach ($realisasiDataCOGSPortofolio as $cogsItem) {
                if ($revenueItem->year == $cogsItem->year && $revenueItem->month == $cogsItem->month && $revenueItem->id_portofolio == $cogsItem->id_portofolio) {
                    $PortfolioGPM[] = [
                        'id_portofolio' => $revenueItem->id_portofolio,
                        'year' => $revenueItem->year,
                        'month' => $revenueItem->month,
                        'gpm' => $revenueItem->total_nilai - $cogsItem->total_nilai,
                    ];
                    break;
                }
            }
        }

        //======== RUMUS CHART Gross Margin ==========
        $gpmData2 = [];

        foreach ($realisasiDataRevenuePortofolio as $revenueItem) {
            foreach ($realisasiDataCOGSPortofolio as $cogsItem) {
                if ($revenueItem->year == $cogsItem->year && $revenueItem->month == $cogsItem->month && $revenueItem->id_portofolio == $cogsItem->id_portofolio) {
                    $gpmData2[] = [
                        'id_portofolio' => $revenueItem->id_portofolio,
                        'year' => $revenueItem->year,
                        'month' => $revenueItem->month,
                        'gpm' => (($revenueItem->total_nilai - $cogsItem->total_nilai) / $revenueItem->total_nilai) * 100,
                    ];
                    break;
                }
            }
        }

        // dd($gpmData2);

        //======== CARD STATISTIC ==========
        if ($account->role == 'Admin' || $account->role == 'GM') {
            $newestYear = LaporanCommerce::max(DB::raw('YEAR(tanggal)'));
        } else {
            $newestYear = LaporanCommerce::where('kota', '=', $account->kota)->max(DB::raw('YEAR(tanggal)'));
        }
        $lastYear = $newestYear - 1;

        //======== TOTAL Gross Profit TAHUN INI ==========
        $cumulativeGPM = 0;
        foreach ($gpmData1 as $entryGPM) {
            if ($entryGPM['year'] == $newestYear) {
                $cumulativeGPM += $entryGPM['gpm'];
            }
        }

        //======== TOTAL Gross Profit TAHUN SEBELUMNYA ==========
        $cumulativeGPM2 = 0;
        foreach ($gpmData1 as $entryGPM2) {
            if ($entryGPM2['year'] == $lastYear) {
                $cumulativeGPM2 += $entryGPM2['gpm'];
            }
        }

        //================================================================================================

        if ($cumulativeGPM2 != 0) {
            $kenaikanGPM = ($cumulativeGPM - $cumulativeGPM2) / abs($cumulativeGPM2) * 100;
        } else {
            $kenaikanGPM = 0;
        }

        //======== TOTAL Gross Margin TAHUN INI ==========
        $cumulativeGM = 0;
        foreach ($gpmData2 as $entryGM) {
            if ($entryGM['year'] == $newestYear) {
                $cumulativeGM += $entryGM['gpm'];
            }
        }

        //======== TOTAL Gross Margin TAHUN SEBELUMNYA ==========
        $cumulativeGM2 = 0;
        foreach ($gpmData2 as $entryGM2) {
            if ($entryGM2['year'] == $lastYear) {
                $cumulativeGM2 += $entryGM2['gpm'];
            }
        }

        if ($cumulativeGM2 != 0) {
            $kenaikanGM = ($cumulativeGM - $cumulativeGM2) / abs($cumulativeGM2) * 100;
        } else {
            $kenaikanGM = 0;
        }

        // dd($PortfolioGPM);

        if ($PortfolioGPM != null && !empty($PortfolioGPM)) {
            $collectionTop = collect($PortfolioGPM);
            $biggestGPUser = $collectionTop->groupBy('id_portofolio')->map(function ($portofolioEntries, $portofolioId) {
                if ($portofolioEntries->isEmpty()) {
                    return null; // Tidak ada data gap untuk portofolio ini
                }

                $biggestGPEntry = $portofolioEntries->sortByDesc('gpm')->first();
                return [
                    'id_portofolio' => $portofolioId,
                    'gpm' => $biggestGPEntry['gpm'],
                ];
            })->filter()->sortByDesc('gpm')->first(); // Menggunakan filter() untuk menghapus nilai null
        } else {
            $biggestGPUser = [
                'id_portofolio' => 0,
                'gpm' => 0,
            ];
        }

        // dd($biggestGPUser);

        if ($biggestGPUser['id_portofolio'] == 0) {
            $TopGP = "Belum ada data";
        } else {
            $TopUserGPM = Portofolio::find($biggestGPUser['id_portofolio']);
            $TopGP = $TopUserGPM->nama_portofolio;
        }

        if ($account->role == "Commerce") {
            return view('commerce.dashboard.gpm', [
                "title" => "GPM",
                "gpmData1" => $gpmData1,
                "gpmData2" => $gpmData2,
                'tahunData' => $tahunData,
                "cumulativeGPM" => $cumulativeGPM,
                "kenaikanGPM" => $kenaikanGPM,
                "cumulativeGM" => $cumulativeGM,
                "kenaikanGM" => $kenaikanGM,
                'filterPortofolio' => $filterPortofolio,
                "TopGP" => $TopGP,
                "biggestGPUser" => $biggestGPUser['gpm'] ?? null,
            ]);
        } elseif ($account->role == "GM") {
            return view('manager.dashboard.gpm', [
                "title" => "GPM",
                "gpmData1" => $gpmData1,
                "gpmData2" => $gpmData2,
                'tahunData' => $tahunData,
                "cumulativeGPM" => $cumulativeGPM,
                "kenaikanGPM" => $kenaikanGPM,
                "cumulativeGM" => $cumulativeGM,
                "kenaikanGM" => $kenaikanGM,
                'filterPortofolio' => $filterPortofolio,
                "TopGP" => $TopGP,
                "biggestGPUser" => $biggestGPUser['gpm'] ?? null,
            ]);
        } else {
            return view('admin.dashboard.gpm', [
                "title" => "GPM",
                "gpmData1" => $gpmData1,
                "gpmData2" => $gpmData2,
                'tahunData' => $tahunData,
                "cumulativeGPM" => $cumulativeGPM,
                "kenaikanGPM" => $kenaikanGPM,
                "cumulativeGM" => $cumulativeGM,
                "kenaikanGM" => $kenaikanGM,
                'filterPortofolio' => $filterPortofolio,
                "TopGP" => $TopGP,
                "biggestGPUser" => $biggestGPUser['gpm'] ?? null,
            ]);
        }
    }
}
