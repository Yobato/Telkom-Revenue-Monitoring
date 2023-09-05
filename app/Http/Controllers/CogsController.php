<?php

namespace App\Http\Controllers;

use App\Models\LaporanCommerce;
use App\Models\Target;
use App\Models\Portofolio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class CogsController extends Controller
{
    public function index()
    {
        $tahunData = Target::distinct()->where('jenis_laporan', '=', 'COGS')->get(['tahun']);
        $commerceData = DB::table('laporan_commerce')
            ->select(
                DB::raw('YEAR(tanggal) as year'),
                DB::raw('MONTH(tanggal) as month'),
                DB::raw('SUM(nilai) as total_nilai')
            )
            ->where('jenis_laporan', '=', 'COGS')
            ->groupBy('year', 'month')
            ->orderBy('year', 'asc')
            ->orderBy('month', 'asc')
            ->get();

        $targetData = DB::table('target')
            ->select(
                DB::raw('tahun as year'),
                DB::raw('bulan as month'),
                DB::raw('SUM(jumlah) as total_nilai')
            )
            ->where('jenis_laporan', '=', 'COGS')
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
        ->where('jenis_laporan', '=', 'COGS')
        ->groupBy('tahun', 'bulan')
        ->orderBy('tahun', 'asc')
        ->orderBy('bulan', 'asc')
        ->get()
        ->map(function ($item) use ($monthMapping) {
            $item->month = $monthMapping[$item->month];
            return $item;
        });

        $gapData = [];


        foreach ($commerceData as $cogsItem) {
            foreach ($targetGap as $targetItem) {
                if ($cogsItem->year == $targetItem->year && $cogsItem->month == $targetItem->month) {
                    $gapData[] = [
                        'year' => $cogsItem->year,
                        'month' => $cogsItem->month,
                        'gap' => $targetItem->total_nilai - $cogsItem->total_nilai,
                    ];
                    break;
                }
            }
        }

            //======== CARD STATISTIC ==========
        $newestYear = LaporanCommerce::max(DB::raw('YEAR(tanggal)'));
        $TotalRealisasiCOGS = LaporanCommerce::whereYear("tanggal", [$newestYear])->where('jenis_laporan', '=', 'COGS')
            ->sum('nilai');

        $lastYear = $newestYear-1;
        $TotalRealisasiCOGS2 = LaporanCommerce::whereYear("tanggal", [$lastYear])->where('jenis_laporan', '=', 'COGS')
            ->sum('nilai');


        if ($TotalRealisasiCOGS2 != 0) {
            $kenaikanRealisasi = ($TotalRealisasiCOGS - $TotalRealisasiCOGS2) / $TotalRealisasiCOGS2 * 100;
        } else {
            $kenaikanRealisasi = 0;
        }

        $TotalTarget1 = Target::where("tahun", [$newestYear])->where('jenis_laporan', '=', 'COGS')
        ->sum('jumlah');

        $TotalTarget2 = Target::where("tahun", [$lastYear])->where('jenis_laporan', '=', 'COGS')
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

        //======== STATISTIC TOP USER ==========
        $portofolioData = DB::table('laporan_commerce')
        ->select(
            'id_portofolio',
            DB::raw('YEAR(tanggal) as year'),
            DB::raw('MONTH(tanggal) as month'),
            DB::raw('SUM(nilai) as total_nilai')
        )
        ->where('jenis_laporan', '=', 'COGS')
        ->groupBy('id_portofolio', 'year', 'month')
        ->orderBy('year', 'asc')
        ->orderBy('month', 'asc')
        ->get();

        $gapPortofolio = [];

        foreach ($portofolioData as $portofolioItem) {
            foreach ($targetGap as $targetItem) {
                if ($portofolioItem->year == $targetItem->year && $portofolioItem->month == $targetItem->month) {
                    $gapPortofolio[] = [
                        'portofolio' => $portofolioItem->id_portofolio,
                        'year' => $portofolioItem->year,
                        'month' => $portofolioItem->month,
                        'gap' => $targetItem->total_nilai - $portofolioItem->total_nilai,
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
        })->filter()->sortBy('gap')->first(); // Menggunakan filter() untuk menghapus nilai null
        
        

        if ($smallestGapPortofolio !== null && isset($smallestGapPortofolio['portofolio'])) {
            $TopPortofolio = Portofolio::find($smallestGapPortofolio['portofolio']);
            $TopCOGS = $TopPortofolio->nama_portofolio;
        } else {
            // Handle the case where $biggestGPUser is null or 'gpm' key is not set
            $TopCOGS = "Belum ada data"; // Set a default value or handle the error gracefully
        }

        $account = Auth::guard('account')->user();
        if ($account->role == "Commerce") {
            return view('commerce.dashboard.cogs', [
                "title" => "COGS",
                "cogsData" => $commerceData,
                "targetData" => $targetData,
                "TotalRealisasiCOGS" => $TotalRealisasiCOGS,
                "kenaikanRealisasi" => $kenaikanRealisasi,
                "kenaikanTarget" => $kenaikanTarget,
                "TotalTarget1" => $TotalTarget1,
                "gapData" => $gapData,
                "gapSum1" => $gapSum1,
                "kenaikanGap" => $kenaikanGap,
                'tahunData' => $tahunData,
                "TopCOGS" => $TopCOGS,
                "GapTop" => $smallestGapPortofolio['gap'] ?? null
            ]);
        } else {
            return view('admin.dashboard.cogs', [
                "title" => "COGS",
                "cogsData" => $commerceData,
                "targetData" => $targetData,
                "TotalRealisasiCOGS" => $TotalRealisasiCOGS,
                "kenaikanRealisasi" => $kenaikanRealisasi,
                "kenaikanTarget" => $kenaikanTarget,
                "TotalTarget1" => $TotalTarget1,
                "gapData" => $gapData,
                "gapSum1" => $gapSum1,
                "kenaikanGap" => $kenaikanGap,
                'tahunData' => $tahunData,
                "TopCOGS" => $TopCOGS,
                "GapTop" => $smallestGapPortofolio['gap'] ?? null
            ]);
        }
    }

}