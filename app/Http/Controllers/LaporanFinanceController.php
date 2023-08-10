<?php

namespace App\Http\Controllers;

use App\Models\CostPlan;
use App\Models\LaporanFinance;
use App\Models\Portofolio;
use App\Models\Program;
use App\Models\City;
use App\Models\Peruntukan;
use App\Models\UserReco;
use Illuminate\Http\Request;

class LaporanFinanceController extends Controller
{
    public function index()
    {

        $portofolio_id = array();
        foreach (Portofolio::all() as $porto) {
            $portofolio_id[$porto->id] = $porto->nama_portofolio;
        }

        $program_id = array();
        foreach (Program::all() as $program) {
            $program_id[$program->id] = $program->nama_program;
        }

        $cost_plan_id = array();
        foreach (CostPlan::all() as $costp) {
            $cost_plan_id[$costp->id] = $costp->nama_cost_plan;
        }

        $user_id = array();
        foreach (UserReco::all() as $user) {
            $user_id[$user->id] = $user->nama_user_reco;
        }

        $peruntukan_id = array();
        foreach (Peruntukan::all() as $peruntukan) {
            $peruntukan_id[$peruntukan->id] = $peruntukan->nama_peruntukan;
        }

        $citys = array();
        foreach (City::all() as $item) {
            $citys[$item->id] = $item->nama_city;
        }

        //
        return view('finance.dashboard.index', [
            "title" => "Laporan Finance",
            "laporan_finance" => LaporanFinance::all(),
            "portofolio_id" => $portofolio_id,
            "program_id" => $program_id,
            "cost_plan_id" => $cost_plan_id,
            "user_id" => $user_id,
            "peruntukan_id" => $peruntukan_id,
            "citys" => $citys
        ]);
    }
}
