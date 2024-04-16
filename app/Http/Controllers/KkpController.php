<?php

namespace App\Http\Controllers;

use App\Models\LaporanNota;
use App\Models\Portofolio;
use App\Models\TargetFinance;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class KkpController extends Controller
{
    public function index()
    {

        //======== CHART REALISASI KKP OPERASIONAL ==========
        // $tahunData = TargetFinance::distinct()->get(['tahun']);
        $tahunData = DB::table('laporan_nota')
                    ->select(DB::raw('YEAR(tanggal) as tahun'))
                    ->distinct()
                    ->get();  

        $filterPortofolio = DB::table('laporan_finance')
            ->join('portofolio', 'laporan_finance.id_portofolio', '=', 'portofolio.id')
            ->select('portofolio.id', 'portofolio.nama_portofolio')
            ->distinct()
            ->get();

        $account = Auth::guard('account')->user();
        if ($account->role == 'Admin' || $account->role == 'GM') {
            $kkpData = DB::table('laporan_finance')
                ->join('laporan_nota as nota_finance', 'laporan_finance.pid_finance', '=', 'nota_finance.pid_nota')
                ->select(
                    'laporan_finance.id_portofolio',
                    DB::raw('YEAR(nota_finance.tanggal) as year'),
                    DB::raw('MONTH(nota_finance.tanggal) as month'),
                    DB::raw('SUM(nota_finance.nilai_akhir) as total_nilai')
                )
                ->groupBy('laporan_finance.id_portofolio', 'year', 'month')
                ->orderBy('laporan_finance.id_portofolio', 'asc')
                ->orderBy('year', 'asc')
                ->orderBy('month', 'asc')
                ->get();
        } else {
            $kkpData = DB::table('laporan_finance')
                ->join('laporan_nota as nota_finance', 'laporan_finance.pid_finance', '=', 'nota_finance.pid_nota')
                ->select(
                    'laporan_finance.id_portofolio',
                    DB::raw('YEAR(nota_finance.tanggal) as year'),
                    DB::raw('MONTH(nota_finance.tanggal) as month'),
                    DB::raw('SUM(nota_finance.nilai_akhir) as total_nilai')
                )
                ->where('laporan_finance.kota', '=', $account->kota)
                ->groupBy('laporan_finance.id_portofolio', 'year', 'month')
                ->orderBy('laporan_finance.id_portofolio', 'asc')
                ->orderBy('year', 'asc')
                ->orderBy('month', 'asc')
                ->get();

        }

        //======== CHART SELURUH PORTOFOLIO ==============
        $TotalKkpData = DB::table('laporan_nota')
            ->select(
                DB::raw('YEAR(tanggal) as year'),
                DB::raw('MONTH(tanggal) as month'),
                DB::raw('SUM(nilai_akhir) as total_nilai')
            )
            ->groupBy(DB::raw('YEAR(tanggal), MONTH(tanggal)'))
            // ->orderBy('asc')
            ->orderBy('year', 'asc')
            ->orderBy('month', 'asc')
            ->get();

        //======== CHART TARGET KKP OPERASIONAL ==========
        $targetData = DB::table('target_finance')
            ->select(
                'id_portofolio',
                DB::raw('tahun as year'),
                DB::raw('bulan as month'),
                DB::raw('SUM(jumlah) as total_nilai')
            )
        // ->where('jenis_laporan', '=', 'KKP')
            ->groupBy('id_portofolio', 'tahun', 'bulan')
            ->orderBy('tahun', 'asc')
            ->orderBy('bulan', 'asc')
            ->get();

        // dd($targetData);

        //======== CHART GAP KKP OPERASIONAL ==========
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

        $targetGap = DB::table('target_finance')
            ->select(
                'id_portofolio',
                DB::raw('tahun as year'),
                DB::raw('bulan as month'),
                DB::raw('SUM(jumlah) as total_nilai')
            )
        // ->where('jenis_laporan', '=', 'KKP')
            ->groupBy('id_portofolio', 'tahun', 'bulan')
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
                if ($kkpItem->year == $targetItem->year && $kkpItem->month == $targetItem->month && $kkpItem->id_portofolio == $targetItem->id_portofolio) {
                    $gapData[] = [
                        'id_portofolio' => $kkpItem->id_portofolio,
                        'year' => $kkpItem->year,
                        'month' => $kkpItem->month,
                        'gap' =>  $kkpItem->total_nilai - $targetItem->total_nilai,
                    ];
                    break;
                }
            }
        }

        //======== CARD STATISTIC ==========

        //======== STATISTIC TOTAL REALISASI ==========
        if ($account->role == 'Admin' || $account->role == 'GM') {
            $newestYear = LaporanNota::max(DB::raw('YEAR(tanggal)'));
            $TotalRealisasiKKP = LaporanNota::whereYear("tanggal", [$newestYear])
                ->sum('nilai_akhir');

            $lastYear = $newestYear - 1;
            $TotalRealisasiKKP2 = LaporanNota::whereYear("tanggal", [$lastYear])
                ->sum('nilai_akhir');
        } else {
            $newestYear = LaporanNota::where('kota', '=', $account->kota)->max(DB::raw('YEAR(tanggal)'));
            $TotalRealisasiKKP = LaporanNota::whereYear("tanggal", [$newestYear])
                ->where('kota', '=', $account->kota)->sum('nilai_akhir');

            $lastYear = $newestYear - 1;
            $TotalRealisasiKKP2 = LaporanNota::whereYear("tanggal", [$lastYear])
                ->where('kota', '=', $account->kota)->sum('nilai_akhir');
        }

        if ($TotalRealisasiKKP2 != 0) {
            $kenaikanRealisasi = ($TotalRealisasiKKP - $TotalRealisasiKKP2) / $TotalRealisasiKKP2 * 100;
        } else {
            $kenaikanRealisasi = 0;
        }

        //======== STATISTIC TOTAL TARGET ==========
        $TotalTarget1 = TargetFinance::where("tahun", [$newestYear])
        // ->where('jenis_laporan', '=', 'KKP')
            ->sum('jumlah');

        $TotalTarget2 = TargetFinance::where("tahun", [$lastYear])
        // ->where('jenis_laporan', '=', 'KKP')
            ->sum('jumlah');

        if ($TotalTarget2 != 0) {
            $kenaikanTarget = ($TotalTarget1 - $TotalTarget2) / $TotalTarget2 * 100;
        } else {
            $kenaikanTarget = 0;
        }

        //======== STATISTIC TOTAL GAP ==========
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
        if ($account->role == 'Admin' || $account->role == 'GM') {
            $userData = DB::table('laporan_finance')
                ->join('laporan_nota as nota_finance', 'laporan_finance.pid_finance', '=', 'nota_finance.pid_nota')
                ->select(
                    'laporan_finance.id_portofolio',
                    DB::raw('YEAR(nota_finance.tanggal) as year'),
                    DB::raw('MONTH(nota_finance.tanggal) as month'),
                    DB::raw('SUM(nota_finance.nilai_akhir) as total_nilai')
                )
                ->where('laporan_finance.kota', '=', $account->kota)
                ->groupBy('laporan_finance.id_portofolio', 'year', 'month')
                ->orderBy('laporan_finance.id_portofolio', 'asc')
                ->orderBy('year', 'asc')
                ->orderBy('month', 'asc')
                ->get();

        } else {
            $userData = DB::table('laporan_finance')
                ->join('laporan_nota as nota_finance', 'laporan_finance.pid_finance', '=', 'nota_finance.pid_nota')
                ->select(
                    'laporan_finance.id_portofolio',
                    DB::raw('YEAR(nota_finance.tanggal) as year'),
                    DB::raw('MONTH(nota_finance.tanggal) as month'),
                    DB::raw('SUM(nota_finance.nilai_akhir) as total_nilai')
                )
                ->where('laporan_finance.kota', '=', $account->kota)
                ->groupBy('laporan_finance.id_portofolio', 'year', 'month')
                ->orderBy('laporan_finance.id_portofolio', 'asc')
                ->orderBy('year', 'asc')
                ->orderBy('month', 'asc')
                ->get();

        }

        $gapUser = [];

        foreach ($userData as $userItem) {
            foreach ($targetGap as $targetItem) {
                if ($userItem->year == $targetItem->year && $userItem->month == $targetItem->month && $userItem->id_portofolio == $targetItem->id_portofolio) {
                    $gapUser[] = [
                        'portofolio' => $userItem->id_portofolio,
                        'year' => $userItem->year,
                        'month' => $userItem->month,
                        'gap' => $targetItem->total_nilai - $userItem->total_nilai,
                    ];
                    break;
                }
            }
        }

        if ($gapUser != null && !empty($gapUser)) {
            $collection = collect($gapUser);
            $smallestGapUser = $collection->groupBy('portofolio')->map(function ($userEntries, $userId) {
                if ($userEntries->isEmpty()) {
                    return null; // Tidak ada data gap untuk user ini
                }

                $smallestGapEntry = $userEntries->sortBy('gap')->first();
                return [
                    'portofolio' => $userId,
                    'gap' => $smallestGapEntry['gap'],
                ];
            })->filter()->sortBy('gap')->first(); // Menggunakan filter() untuk menghapus nilai null
        } else {
            $smallestGapUser = [
                'portofolio' => 0,
                'gap' => 0,
            ];
        }

        if ($smallestGapUser['portofolio'] != null) {
            $TopUser = Portofolio::find($smallestGapUser['portofolio']);
            $TopKKP = $TopUser->nama_user_reco;
        } else {
            $TopKKP = "Belum ada data";
        }

        if ($account->role == "Finance") {
            return view('finance.dashboard.chart', [
                "title" => "KKP",
                "kkpData" => $kkpData,
                'tahunData' => $tahunData,
                "TotalRealisasiKKP" => $TotalRealisasiKKP,
                "kenaikanRealisasi" => $kenaikanRealisasi,
                "gapData" => $gapData,
                "TotalTarget1" => $TotalTarget1,
                "kenaikanTarget" => $kenaikanTarget,
                "gapSum1" => $gapSum1,
                "kenaikanGap" => $kenaikanGap,
                "TopKKP" => $TopKKP,
                "GapTop" => $smallestGapUser['gap'] ?? null,
                "targetData" => $targetData,
                'filterPortofolio' => $filterPortofolio,
            ]);
        } elseif ($account->role == "GM") {
            return view('manager.dashboard.kkp', [
                "title" => "KKP",
                "kkpData" => $kkpData,
                "TotalKkpData" => $TotalKkpData,
                'tahunData' => $tahunData,
                "TotalRealisasiKKP" => $TotalRealisasiKKP,
                "kenaikanRealisasi" => $kenaikanRealisasi,
                "gapData" => $gapData,
                "TotalTarget1" => $TotalTarget1,
                "kenaikanTarget" => $kenaikanTarget,
                "gapSum1" => $gapSum1,
                "kenaikanGap" => $kenaikanGap,
                "TopKKP" => $TopKKP,
                "GapTop" => $smallestGapUser['gap'] ?? null,
                "targetData" => $targetData,
                'filterPortofolio' => $filterPortofolio,
            ]);
        } else {
            return view('admin.dashboard.kkp', [
                "title" => "KKP",
                "kkpData" => $kkpData,
                'tahunData' => $tahunData,
                "TotalRealisasiKKP" => $TotalRealisasiKKP,
                "kenaikanRealisasi" => $kenaikanRealisasi,
                "gapData" => $gapData,
                "TotalTarget1" => $TotalTarget1,
                "kenaikanTarget" => $kenaikanTarget,
                "gapSum1" => $gapSum1,
                "kenaikanGap" => $kenaikanGap,
                "TopKKP" => $TopKKP,
                "GapTop" => $smallestGapUser['gap'] ?? null,
                "targetData" => $targetData,
                'filterPortofolio' => $filterPortofolio,
            ]);
        }
    }
}