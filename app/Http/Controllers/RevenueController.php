<?php

namespace App\Http\Controllers;

use App\Models\LaporanCommerce;
use App\Models\Portofolio;
use App\Models\TargetCommerce;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RevenueController extends Controller
{
    //
    public function index()
    {
        $account = Auth::guard('account')->user();
        // $tahunData = TargetCommerce::distinct()->where('jenis_laporan', '=', 'REVENUE')->get(['tahun']);
        $tahunData = DB::table('laporan_commerce')
                    ->select(DB::raw('YEAR(tanggal) as tahun'))
                    ->where('jenis_laporan', '=', 'REVENUE')
                    ->distinct()
                    ->get();
        $filterPortofolio = DB::table('laporan_commerce')
            ->join('portofolio', 'laporan_commerce.id_portofolio', '=', 'portofolio.id')
            ->where('laporan_commerce.jenis_laporan', 'REVENUE')
            ->select('portofolio.id', 'portofolio.nama_portofolio')
            ->distinct()
            ->get();

        if ($account->role == 'Admin' || $account->role == 'GM') {
            $revenueData = DB::table('laporan_commerce')
                ->select(
                    'id_portofolio',
                    DB::raw('YEAR(tanggal) as year'),
                    DB::raw('MONTH(tanggal) as month'),
                    DB::raw('SUM(nilai) as total_nilai')
                )
                ->where('jenis_laporan', '=', 'REVENUE')
                ->groupBy('id_portofolio', 'year', 'month')
                ->orderBy('year', 'asc')
                ->orderBy('month', 'asc')
                ->get();
        } else {
            $revenueData = DB::table('laporan_commerce')
                ->select(
                    'id_portofolio',
                    DB::raw('YEAR(tanggal) as year'),
                    DB::raw('MONTH(tanggal) as month'),
                    DB::raw('SUM(nilai) as total_nilai')
                )
                ->where('kota', '=', $account->kota)
                ->where('jenis_laporan', '=', 'REVENUE')
                ->groupBy('id_portofolio', 'year', 'month')
                ->orderBy('year', 'asc')
                ->orderBy('month', 'asc')
                ->get();
        }


        $totalRevenueData = DB::table('laporan_commerce')
            ->select(
                DB::raw('YEAR(tanggal) as year'),
                DB::raw('MONTH(tanggal) as month'),
                DB::raw('SUM(nilai) as total_nilai')
            )
            ->where('jenis_laporan', '=', 'REVENUE')
            ->groupBy(DB::raw('YEAR(tanggal), MONTH(tanggal)'))
            ->orderBy('year', 'asc')
            ->orderBy('month', 'asc')
            ->get();

        $targetData = DB::table('target_commerce')
            ->select(
                'id_portofolio',
                DB::raw('tahun as year'),
                DB::raw('bulan as month'),
                DB::raw('SUM(jumlah) as total_nilai')
            )
            ->where('jenis_laporan', '=', 'REVENUE')
            ->groupBy('id_portofolio', 'tahun', 'bulan')
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

        $targetGap = DB::table('target_commerce')
            ->select(
                'id_portofolio',
                DB::raw('tahun as year'),
                DB::raw('bulan as month'),
                DB::raw('SUM(jumlah) as total_nilai')
            )
            ->where('jenis_laporan', '=', 'Revenue')
            ->groupBy('id_portofolio', 'tahun', 'bulan')
            ->orderBy('tahun', 'asc')
            ->orderBy('bulan', 'asc')
            ->get()
            ->map(function ($item) use ($monthMapping) {
                $item->month = $monthMapping[$item->month];
                return $item;
            });

        $gapData = [];

        foreach ($revenueData as $revenueItem) {
            foreach ($targetGap as $targetItem) {
                if ($revenueItem->year == $targetItem->year && $revenueItem->month == $targetItem->month && $revenueItem->id_portofolio == $targetItem->id_portofolio) {
                    $gapData[] = [
                        'id_portofolio' => $revenueItem->id_portofolio,
                        'year' => $revenueItem->year,
                        'month' => $revenueItem->month,
                        'gap' =>  $revenueItem->total_nilai - $targetItem->total_nilai,
                    ];
                    break;
                }
            }
        }

        //======== CARD STATISTIC ==========

        //======== STATISTIC TOTAL REALISASI ==========
        if ($account->role == 'Admin' || $account->role == 'GM') {
            $newestYear = LaporanCommerce::max(DB::raw('YEAR(tanggal)'));
            $TotalRealisasiRevenue = LaporanCommerce::whereYear("tanggal", [$newestYear])->where('jenis_laporan', '=', 'REVENUE')
                ->sum('nilai');

            $lastYear = $newestYear - 1;
            $TotalRealisasiRevenue2 = LaporanCommerce::whereYear("tanggal", [$lastYear])->where('jenis_laporan', '=', 'REVENUE')
                ->sum('nilai');
        } else {
            $newestYear = LaporanCommerce::where('kota', '=', $account->kota)->max(DB::raw('YEAR(tanggal)'));
            $TotalRealisasiRevenue = LaporanCommerce::whereYear("tanggal", [$newestYear])->where('jenis_laporan', '=', 'REVENUE')
                ->where('kota', '=', $account->kota)->sum('nilai');

            $lastYear = $newestYear - 1;
            $TotalRealisasiRevenue2 = LaporanCommerce::whereYear("tanggal", [$lastYear])->where('jenis_laporan', '=', 'REVENUE')
                ->where('kota', '=', $account->kota)->sum('nilai');
        }

        if ($TotalRealisasiRevenue2 != 0) {
            $kenaikanRealisasi = ($TotalRealisasiRevenue - $TotalRealisasiRevenue2) / $TotalRealisasiRevenue2 * 100;
        } else {
            $kenaikanRealisasi = 0;
        }

        //======== STATISTIC TOTAL TARGET ==========
        $TotalTarget1 = TargetCommerce::where("tahun", [$newestYear])->where('jenis_laporan', '=', 'REVENUE')
            ->sum('jumlah');

        $TotalTarget2 = TargetCommerce::where("tahun", [$lastYear])->where('jenis_laporan', '=', 'REVENUE')
            ->sum('jumlah');

        if ($TotalTarget2 != 0) {
            $kenaikanTarget = ($TotalTarget1 - $TotalTarget2) / $TotalTarget2 * 100;
        } else {
            $kenaikanTarget = 0;
        }

        $gapSum1 = 0;
        $gapSum2 = 0;

        foreach ($gapData as $data) {
            if ($data["year"] === $newestYear) {
                $gapSum1 += $data["gap"];
            }
        }

        foreach ($gapData as $data) {
            if ($data["year"] === $lastYear) {
                $gapSum2 += $data["gap"];
            }
        }

        if ($gapSum2 != 0) {
            $kenaikanGap = ($gapSum1 - $gapSum2) / abs($gapSum2) * 100;
        } else {
            $kenaikanGap = 0;
        }

        // dd($gapSum2);

        // dd($kenaikanGap);

        //======== STATISTIC TOP USER ==========
        if ($account->role == 'Admin' || $account->role == 'GM') {
            $portofolioData = DB::table('laporan_commerce')
                ->select(
                    'id_portofolio',
                    DB::raw('YEAR(tanggal) as year'),
                    DB::raw('MONTH(tanggal) as month'),
                    DB::raw('SUM(nilai) as total_nilai')
                )
                ->where('jenis_laporan', '=', 'Revenue')
                ->groupBy('id_portofolio', 'year', 'month')
                ->orderBy('year', 'asc')
                ->orderBy('month', 'asc')
                ->get();
        } else {
            $portofolioData = DB::table('laporan_commerce')
                ->select(
                    'id_portofolio',
                    DB::raw('YEAR(tanggal) as year'),
                    DB::raw('MONTH(tanggal) as month'),
                    DB::raw('SUM(nilai) as total_nilai')
                )
                ->where('kota', '=', $account->kota)
                ->where('jenis_laporan', '=', 'Revenue')
                ->groupBy('id_portofolio', 'year', 'month')
                ->orderBy('year', 'asc')
                ->orderBy('month', 'asc')
                ->get();
        }

        $gapPortofolio = [];

        foreach ($portofolioData as $portofolioItem) {
            foreach ($targetGap as $targetItem) {
                if ($portofolioItem->id_portofolio == $targetItem->id_portofolio && $portofolioItem->year == $targetItem->year && $portofolioItem->month == $targetItem->month) {
                    $gapPortofolio[] = [
                        'portofolio' => $portofolioItem->id_portofolio,
                        'year' => $portofolioItem->year,
                        'month' => $portofolioItem->month,
                        'gap' =>  $portofolioItem->total_nilai - $targetItem->total_nilai,
                    ];
                    break;
                }
            }
        }

        // dd($gapPortofolio);

        $collection = collect($gapPortofolio);

        $smallestGapPortofolio = $collection->groupBy('portofolio')->map(function ($portofolioEntries, $portofolioId) {
            if ($portofolioEntries->isEmpty()) {
                return null; // Tidak ada data gap untuk portofolio ini
            }

            $smallestGapEntry = $portofolioEntries->sortBy('gap')->first();
            return [
                'portofolio' => $portofolioId,
                'gap' => $smallestGapEntry['gap'],
            ];
        })->filter()->sortByDesc('gap')->first(); // Menggunakan filter() untuk menghapus nilai null

        if ($smallestGapPortofolio !== null && isset($smallestGapPortofolio['portofolio'])) {
            $TopPortofolio = Portofolio::find($smallestGapPortofolio['portofolio']);
            $TopRevenue = $TopPortofolio->nama_portofolio;
        } else {
            // Handle the case where $biggestGPUser is null or 'gpm' key is not set
            $TopRevenue = "Belum ada data"; // Set a default value or handle the error gracefully
        }

        if ($account->role == "Commerce") {
            return view('commerce.dashboard.revenue', [
                "title" => "Revenue",
                "revenueData" => $revenueData,
                "targetData" => $targetData,
                "TotalRealisasiRevenue" => $TotalRealisasiRevenue,
                "kenaikanRealisasi" => $kenaikanRealisasi,
                "kenaikanTarget" => $kenaikanTarget,
                "TotalTarget1" => $TotalTarget1,
                "gapData" => $gapData,
                "gapSum1" => $gapSum1,
                "kenaikanGap" => $kenaikanGap,
                'tahunData' => $tahunData,
                "TopRevenue" => $TopRevenue,
                "GapTop" => $smallestGapPortofolio['gap'] ?? null,
                "filterPortofolio" => $filterPortofolio,
            ]);
        } elseif ($account->role == "GM") {
            return view('manager.dashboard.revenue', [
                "title" => "Revenue",
                "revenueData" => $revenueData,
                "targetData" => $targetData,
                "totalRevenueData" => $totalRevenueData,
                "TotalRealisasiRevenue" => $TotalRealisasiRevenue,
                "kenaikanRealisasi" => $kenaikanRealisasi,
                "kenaikanTarget" => $kenaikanTarget,
                "TotalTarget1" => $TotalTarget1,
                "gapData" => $gapData,
                "gapSum1" => $gapSum1,
                "kenaikanGap" => $kenaikanGap,
                'tahunData' => $tahunData,
                "TopRevenue" => $TopRevenue,
                "GapTop" => $smallestGapPortofolio['gap'] ?? null,
                "filterPortofolio" => $filterPortofolio,
                "gapPortofolio" => $smallestGapPortofolio,
            ]);
        } else {
            return view('admin.dashboard.revenue', [
                "title" => "Revenue",

                "revenueData" => $revenueData,
                "targetData" => $targetData,
                "TotalRealisasiRevenue" => $TotalRealisasiRevenue,
                "kenaikanRealisasi" => $kenaikanRealisasi,
                "kenaikanTarget" => $kenaikanTarget,
                "TotalTarget1" => $TotalTarget1,
                "gapData" => $gapData,
                "gapSum1" => $gapSum1,
                "kenaikanGap" => $kenaikanGap,
                'tahunData' => $tahunData,
                "TopRevenue" => $TopRevenue,
                "GapTop" => $smallestGapPortofolio['gap'] ?? null,
                "filterPortofolio" => $filterPortofolio,
            ]);
        }
    }

}