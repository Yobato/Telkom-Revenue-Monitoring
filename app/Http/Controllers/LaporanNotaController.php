<?php

namespace App\Http\Controllers;

use App\Models\LaporanNota;
use App\Models\LaporanFinance;
use App\Models\UserReco;
use App\Models\Peruntukan;
use App\Models\City;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;
use App\Exports\UsersExportN;
use App\Models\Pph;
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

        $pph_id = array();
        foreach(Pph::all() as $item){
            $pph_id[$item->id] = $item->nama_pph;
        }

        $account = Auth::guard('account')->user();
        if ($account->role == "Finance") {
            return view('finance.dashboard.indexNota', [
                "title" => "Laporan Nota",
                "laporan_nota" => LaporanNota::all()->where('kota', '=', $account->kota),
                "user_id" => $user_id,
                "peruntukan_id" => $peruntukan_id,
                "citys" => $citys,
                "pph_id" => $pph_id,
            ]);
        } elseif ($account->role == "GM"){
             return view('manager.dashboard.laporanNota', [
                "title" => "Laporan Nota",
                "laporan_nota" => LaporanNota::all(),
                "user_id" => $user_id,
                "peruntukan_id" => $peruntukan_id,
                "citys" => $citys,
                "pph_id" => $pph_id
            ]);
        } else {
            return view('admin.dashboard.laporanNota', [
                "title" => "Laporan Nota",
                "laporan_nota" => LaporanNota::all(),
                "user_id" => $user_id,
                "peruntukan_id" => $peruntukan_id,
                "citys" => $citys,
                "pph_id" => $pph_id
            ]);
        }
        //
    }

    public function export() 
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
            "addpersentase" => Pph::all(),
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
            'nilai_awal' => str_replace([',00', '.'], '', $request->nilai_awal),
            'nilai_akhir' => str_replace([',00', '.'], '', $request->nilai_akhir),
            'pph' => $request->pph,
            'id_pph' => $request->persentase,
            'keterangan' => $request->keterangan,
            'id_peruntukan' => $request->id_peruntukan,
            'id_user' => $request->id_user,
            'kota' => $account->kota,
            'created_at' => Carbon::now(),
            'tanggal' => $request->tanggal . '-01'

        ]);
        return redirect()->intended(route('nota.dashboard.index'))->with("success", "Berhasil menambahkan Laporan Nota");
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

            return redirect()->intended(route('nota.dashboard.index'))->with("success", "Berhasil menghapus Laporan Nota");
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
            "nota" => LaporanNota::where("id", "=", $id)->get(),
            "addfinance" => LaporanFinance::all(),
            "addcity" => City::all(),
            "adduser" => UserReco::all(),
            "addperuntukan" => Peruntukan::all(),
            "addpersentase" => Pph::all(),
            "id" => $id,
        ]);
    }

    public function updateLaporanNota(Request $request, $id)
    {
        $messages = [
            'required' => ':Field wajib diisi',
            'unique' => 'Nilai sudah ada',
            'persentase.required_if' => 'Field Persentase harus diisi!',
        ];

        $this->validate($request, [
            'pid_nota' => 'required',
            'nilai_awal' => 'required',
            'nilai_akhir' => 'required',
            'pph' => 'required',
            'persentase' => 'required_if:pph,Ya',
            'id_peruntukan' => 'required',
            'id_user' => 'required',
            'tanggal' => 'required'
        ], $messages);

        $account = Auth::guard('account')->user();
        LaporanNota::where('id', $id)->update([
            'pid_nota' => $request->pid_nota,
            'nilai_awal' => str_replace([',00', '.'], '', $request->nilai_awal),
            'nilai_akhir' => str_replace([',00', '.'], '', $request->nilai_akhir),
            'pph' => $request->pph,
            'id_pph' => $request->persentase,
            'keterangan' => $request->keterangan,
            'id_peruntukan' => $request->id_peruntukan,
            'id_user' => $request->id_user,
            'kota' => $account->kota,
            'tanggal' => $request->tanggal . '-01'
        ]);
        return redirect()->intended(route('nota.dashboard.index'))->with("success", "Berhasil mengubah Laporan Nota");
    }

    public function Editable($id)
    {
        $account = Auth::guard('account')->user();
        LaporanNota::where('id', $id)->update([
            "editable" => 1
        ]);

        if ($account->role == "Finance") {
            return redirect()->intended(route('nota.dashboard.index'))->with("success", "Berhasil memberi akses edit pada Laporan Nota");
        } else if ($account->role == "Admin") {
            return redirect()->intended(route('admin.dashboard.nota'))->with("success", "Berhasil memberi akses edit pada Laporan Nota");
        }
    }

    public function Uneditable($id)
    {
        $account = Auth::guard('account')->user();
        LaporanNota::where('id', $id)->update([
            "editable" => 0
        ]);

        if ($account->role == "Finance") {
            return redirect()->intended(route('nota.dashboard.index'))->with("success", "Berhasil menghapus akses edit pada Laporan Nota");
        } else if ($account->role == "Admin") {
            return redirect()->intended(route('admin.dashboard.nota'))->with("success", "Berhasil menghapus akses edit pada Laporan Nota");
        }
    }
}