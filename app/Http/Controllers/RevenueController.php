<?php

namespace App\Http\Controllers;

use App\Models\LaporanCommerce;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class RevenueController extends Controller
{
    //
    public function index()
    {
        $commerceData = DB::table('laporan_commerce')
            ->select(
                DB::raw('YEAR(created_at) as year'),
                DB::raw('MONTH(created_at) as month'),
                DB::raw('SUM(nilai) as total_nilai')
            )
            ->where('jenis_laporan', '=', 'COGS')
            ->groupBy('year', 'month')
            ->orderBy('year', 'asc')
            ->orderBy('month', 'asc')
            ->get();

        $revenueData = DB::table('laporan_commerce')
            ->select(
                DB::raw('YEAR(created_at) as year'),
                DB::raw('MONTH(created_at) as month'),
                DB::raw('SUM(nilai) as total_nilai')
            )
            ->where('jenis_laporan', '=', 'REVENUE')
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
            // ->where('jenis_laporan', '=', 'COGS')
            ->groupBy('tahun', 'bulan')
            ->orderBy('tahun', 'asc')
            ->orderBy('bulan', 'asc')
            ->get();

        $account = Auth::guard('account')->user();
        if ($account->role == "Commerce") {
            return view('commerce.dashboard.revenue', [
                "title" => "COGS",
                "commerceData" => $commerceData,
                "revenueData" => $revenueData,
                "targetData" => $targetData
            ]);
        } else{
            return view('admin.dashboard.revenue', [
                "title" => "COGS",
                "commerceData" => $commerceData,
                "revenueData" => $revenueData,
                "targetData" => $targetData
            ]);
        }    

    }
}