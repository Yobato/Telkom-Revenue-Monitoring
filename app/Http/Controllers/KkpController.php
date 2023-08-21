<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LaporanFinance;
use Illuminate\Support\Facades\DB;

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

        return view('admin.dashboard.kkp', [
            "title" => "KKP",
            "kkpData" => $kkpData,
            // "revenueData" => $revenueData,
            "targetData" => $targetData
        ]);
    }
}