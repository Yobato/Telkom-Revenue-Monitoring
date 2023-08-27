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
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;
use App\Exports\UsersExportF;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Excel as ExcelExcel;
use Carbon\Carbon;


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

        $account = Auth::guard('account')->user();
        if ($account->role == "Finance") {
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
        } else {
            return view('admin.dashboard.laporanFinance', [
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
        //
    }
    public function export() 
    {
        return Excel::download(new UsersExportF, 'expor_finance.xlsx', ExcelExcel::XLSX);
    }

    public function indexChart()
    {
        return view('finance.dashboard.chart', [
            "title" => "Dashboard Finance",
        ]);
    }

    public function addLaporanFinance(Request $request)
    {
        return view('finance.reporting.form', [
            "title" => "Buat Laporan Finance",
            "addcity" => City::all(),
            "addportofolio" => Portofolio::all()->where("role", "=", "Finance"),
            "addprogram" => Program::all()->where("role", "=", "Finance"),
            "addcostplan" => CostPlan::all(),
            "adduser" => UserReco::all(),
            "addperuntukan" => Peruntukan::all(),
        ]);
    }

    public function storeLaporanFinance(Request $request)
    {

        $account = Auth::guard('account')->user();

        $messages = [
            'required' => 'Field wajib diisi',
            'unique' => 'Nilai sudah ada',
        ];
        
        

        $this->validate($request, [
            'pid_finance' => 'required|unique:laporan_finance',
            'nilai' => 'required',
            'keterangan' => 'required',
            'id_portofolio' => 'required',
            'id_program' => 'required',
            'id_cost_plan' => 'required',
            'id_peruntukan' => 'required',
            'id_user' => 'required',
            'tanggal' => 'required'
        ], $messages);

        LaporanFinance::insert([
            'pid_finance' => $request->pid_finance,
            'nilai' => str_replace('.', '', $request->nilai),
            'keterangan' => $request->keterangan,
            'id_portofolio' => $request->id_portofolio,
            'id_program' => $request->id_program,
            'id_cost_plan' => $request->id_cost_plan,
            'id_peruntukan' => $request->id_peruntukan,
            'id_user' => $request->id_user,
            'kota' => $account->kota,
            'created_at' => Carbon::now(),
       
            'tanggal' => $request->tanggal . '-01'


        ]);
        return redirect()->intended(route('finance.dashboard.index'))->with("success", "Berhasil menambahkan Laporan KKP");
    }

    public function deleteLaporanFinance($id)
    {
        try {
            $account = Auth::guard('account')->user();
            DB::beginTransaction();

            $laporan_finance = LaporanFinance::find($id);

            // Jika tidak ada pengecualian, hapus kota
            $laporan_finance->delete();

            DB::commit();

            return redirect()->intended(route('finance.dashboard.index'))->with("success", "Berhasil menghapus Laporan Finance");
        } catch (QueryException $e) {
            DB::rollback();

            // Tangkap pengecualian QueryException jika terjadi kesalahan database
            return redirect()->intended(route('finance.dashboard.index'))->with("error", $e->getMessage());
        } catch (\Exception $e) {
            DB::rollback();

            // Tangkap pengecualian umum dan tampilkan pesan error
            return redirect()->intended(route('finance.dashboard.index'))->with("error", $e->getMessage());
        }
    }

    public function editLaporanFinance($id)
    {
        return view('finance.reporting.formEdit', [
            "title" => "Edit Laporan Finance",
            "finance" => LaporanFinance::where("pid_finance", "=", $id)->get(),
            "addcity" => City::all(),
            "addportofolio" => Portofolio::all()->where("role", "=", "Finance"),
            "addprogram" => Program::all()->where("role", "=", "Finance"),
            "addcostplan" => CostPlan::all(),
            "adduser" => UserReco::all(),
            "addperuntukan" => Peruntukan::all(),
            "id" => $id,
        ]);
    }

    public function updateLaporanFinance(Request $request, $id)
    {
        $messages = [
            'required' => ':Field wajib diisi',
            'unique' => 'Nilai sudah ada',
        ];

        $this->validate($request, [
            'nilai' => 'required',
            'keterangan' => 'required',
            'id_portofolio' => 'required',
            'id_program' => 'required',
            'id_cost_plan' => 'required',
            'id_peruntukan' => 'required',
            'id_user' => 'required',
            'tanggal' => 'required'
        ], $messages);

        $account = Auth::guard('account')->user();
        LaporanFinance::where('pid_finance', $id)->update([
            'nilai' => str_replace('.', '', $request->nilai),
            'keterangan' => $request->keterangan,
            'id_portofolio' => $request->id_portofolio,
            'id_program' => $request->id_program,
            'id_cost_plan' => $request->id_cost_plan,
            'id_peruntukan' => $request->id_peruntukan,
            'id_user' => $request->id_user,
            'kota' => $account->kota,
            'tanggal' => $request->tanggal . '-01'

        ]);
        return redirect()->intended(route('finance.dashboard.index'))->with("success", "Berhasil mengubah Laporan Finance");
    }

    public function Editable($id)
    {
        $account = Auth::guard('account')->user();
        LaporanFinance::where('pid_finance', $id)->update([
            "editable" => 1
        ]);

        if ($account->role == "Finance") {
            return redirect()->intended(route('finance.dashboard.index'))->with("success", "Berhasil memberi akses edit pada Laporan Finance");
        } else if ($account->role == "Admin") {
            return redirect()->intended(route('admin.dashboard.finance'))->with("success", "Berhasil memberi akses edit pada Laporan Finance");
        }
    }

    public function Uneditable($id)
    {
        $account = Auth::guard('account')->user();
        LaporanFinance::where('pid_finance', $id)->update([
            "editable" => 0
        ]);

        if ($account->role == "Finance") {
            return redirect()->intended(route('finance.dashboard.index'))->with("success", "Berhasil menghapus akses edit pada Laporan Finance");
        } else if ($account->role == "Admin") {
            return redirect()->intended(route('admin.dashboard.finance'))->with("success", "Berhasil menghapus akses edit pada Laporan Finance");
        }
    }
}