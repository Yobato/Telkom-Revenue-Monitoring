<?php

namespace App\Http\Controllers;

use App\Models\LaporanNota;
use App\Models\LaporanFinance;
use App\Models\UserReco;
use App\Models\Peruntukan;
use App\Models\City;
use App\Exports\UsersExportN;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Excel as ExcelExcel;
use Carbon\Carbon;

class LaporanNotaController extends Controller
{
    //
    public function index()
    {

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
            return view('finance.dashboard.indexNota', [
                "title" => "Laporan Nota",
                "laporan_nota" => LaporanNota::all()->where('kota', '=', $account->kota),
                "user_id" => $user_id,
                "peruntukan_id" => $peruntukan_id,
                "citys" => $citys
            ]);
        } elseif ($account->role == "GM"){
             return view('manager.dashboard.laporanNota', [
                "title" => "Laporan Nota",
                "laporan_nota" => LaporanNota::all(),
                "user_id" => $user_id,
                "peruntukan_id" => $peruntukan_id,
                "citys" => $citys
            ]);
        } else {
            return view('admin.dashboard.laporanNota', [
                "title" => "Laporan Nota",
                "laporan_nota" => LaporanNota::all(),
                "user_id" => $user_id,
                "peruntukan_id" => $peruntukan_id,
                "citys" => $citys
            ]);
        }
        //
    }

    public function exportNota() 
    {
        return Excel::download(new UsersExportN, 'expor_nota.xlsx', ExcelExcel::XLSX);
    }

    public function addLaporanNota(Request $request)
    {
        return view('finance.reporting.formNota', [
            "title" => "Laporan Nota",
            "addfinance" => LaporanFinance::all(),
            "addcity" => City::all(),
            "adduser" => UserReco::all(),
            "addperuntukan" => Peruntukan::all(),
        ]);
    }

    public function storeLaporanNota(Request $request)
    {

        $account = Auth::guard('account')->user();

        $messages = [
            'required' => 'Field wajib diisi',
            'unique' => 'Nilai sudah ada',
            'persentase.required_if' => 'Field Persentase harus diisi!',
        ];

        $this->validate($request, [
            'pid_nota' => 'required',
            'nilai_awal' => 'required',
            'nilai_akhir' => 'required',
            'pph' => 'required',
            'persentase' => 'required_if:pph,Ya',
            // 'keterangan' => 'required',
            'id_peruntukan' => 'required',
            'id_user' => 'required',
            'tanggal' => 'required'
        ], $messages);

        LaporanNota::insert([
            'pid_nota' => $request->pid_nota,
            'nilai_awal' => str_replace('.', '', $request->nilai_awal),
            'nilai_akhir' => str_replace('.', '', $request->nilai_akhir),
            'pph' => $request->pph,
            'persentase' => $request->persentase,
            'keterangan' => $request->keterangan,
            'id_peruntukan' => $request->id_peruntukan,
            'id_user' => $request->id_user,
            'kota' => $account->kota,
            'created_at' => Carbon::now(),
            'tanggal' => $request->tanggal . '-01'

        ]);
        return redirect()->intended(route('nota.dashboard.index'))->with("success", "Berhasil menambahkan Laporan KKP");
    }

    public function deleteLaporanNota($id)
    {
        try {
            $account = Auth::guard('account')->user();
            DB::beginTransaction();

            $laporan_nota = LaporanNota::find($id);

            // Jika tidak ada pengecualian, hapus kota
            $laporan_nota->delete();

            DB::commit();

            return redirect()->intended(route('nota.dashboard.index'))->with("success", "Berhasil menghapus Laporan Finance");
        } catch (QueryException $e) {
            DB::rollback();

            // Tangkap pengecualian QueryException jika terjadi kesalahan database
            return redirect()->intended(route('nota.dashboard.index'))->with("error", $e->getMessage());
        } catch (\Exception $e) {
            DB::rollback();

            // Tangkap pengecualian umum dan tampilkan pesan error
            return redirect()->intended(route('nota.dashboard.index'))->with("error", $e->getMessage());
        }
    }

    public function editLaporanNota($id)
    {
        return view('finance.reporting.formNotaEdit', [
            "title" => "Laporan Nota",
            "finance" => LaporanNota::where("id", "=", $id)->get(),
            "addcity" => City::all(),
            "addportofolio" => Portofolio::all()->where("role", "=", "Finance"),
            "addprogram" => Program::all()->where("role", "=", "Finance"),
            "addcostplan" => CostPlan::all(),
            "id" => $id,
        ]);
    }

    public function updateLaporanNota(Request $request, $id)
    {
        $messages = [
            'required' => ':Field wajib diisi',
            'unique' => 'Nilai sudah ada',
        ];

        $this->validate($request, [
            'id_portofolio' => 'required',
            'id_program' => 'required',
            'id_cost_plan' => 'required',
            // 'tanggal' => 'required'
        ], $messages);

        $account = Auth::guard('account')->user();
        LaporanNota::where('id', $id)->update([
            'id_portofolio' => $request->id_portofolio,
            'id_program' => $request->id_program,
            'id_cost_plan' => $request->id_cost_plan,
            'kota' => $account->kota,
            // 'tanggal' => $request->tanggal . '-01'

        ]);
        return redirect()->intended(route('nota.dashboard.index'))->with("success", "Berhasil mengubah Laporan Finance");
    }

    public function Editable($id)
    {
        $account = Auth::guard('account')->user();
        LaporanNota::where('id', $id)->update([
            "editable" => 1
        ]);

        if ($account->role == "Finance") {
            return redirect()->intended(route('nota.dashboard.index'))->with("success", "Berhasil memberi akses edit pada Laporan Finance");
        } else if ($account->role == "Admin") {
            return redirect()->intended(route('admin.dashboard.nota'))->with("success", "Berhasil memberi akses edit pada Laporan Finance");
        }
    }

    public function Uneditable($id)
    {
        $account = Auth::guard('account')->user();
        LaporanNota::where('id', $id)->update([
            "editable" => 0
        ]);

        if ($account->role == "Finance") {
            return redirect()->intended(route('nota.dashboard.index'))->with("success", "Berhasil menghapus akses edit pada Laporan Finance");
        } else if ($account->role == "Admin") {
            return redirect()->intended(route('admin.dashboard.nota'))->with("success", "Berhasil menghapus akses edit pada Laporan Finance");
        }
    }
}