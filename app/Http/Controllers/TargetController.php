<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\Portofolio;
use App\Models\TargetCommerce;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;

class TargetController extends Controller
{
    //
    public function index()
    {
        $portofolio_id = array();
        foreach (Portofolio::all() as $porto) {
            $portofolio_id[$porto->id] = $porto->nama_portofolio;
        }
        
         $account = Auth::guard('account')->user();
        if ($account->role == "Admin") {
            return view('admin.dashboard.target', [
                "title" => "Target",
                "target" => TargetCommerce::all(),
                "roles" => Role::all(),
                "portofolio_id" => $portofolio_id,
                "addportofolio" => Portofolio::all()->where("role", "=", "Commerce"),
            ]);
        } elseif($account->role == "GM"){
            return view('manager.dashboard.target', [
                "title" => "Target",
                "target" => TargetCommerce::all(),
                "roles" => Role::all(),
                "portofolio_id" => $portofolio_id,
            ]);
        }
    }

    public function storeTarget(Request $request)
    {
        TargetCommerce::insert([
            "bulan" => $request->bulan,
            "jumlah"=> str_replace('.','',$request->jumlah),
            'jenis_laporan' => $request->jenis_laporan,
            'id_portofolio' => $request->id_portofolio,
            'tahun' => $request->tahun,
        ]);
        return redirect()->intended(route('admin.dashboard.target'))->with("success", "Berhasil menambahkan Target Commerce");
    }

    public function deleteTarget($id)
    {
        try {
            DB::beginTransaction();

            $target = TargetCommerce::find($id);

            // Jika tidak ada pengecualian, hapus kota
            $target->delete();

            DB::commit();

            return redirect()->intended(route('admin.dashboard.target'))->with("success", "Berhasil menghapus Target Commerce");
        } catch (QueryException $e) {
            DB::rollback();

            // Tangkap pengecualian QueryException jika terjadi kesalahan database
            return redirect()->intended(route('admin.dashboard.target'))->with("error", $e->getMessage());
        } catch (\Exception $e) {
            DB::rollback();

            // Tangkap pengecualian umum dan tampilkan pesan error
            return redirect()->intended(route('admin.dashboard.target'))->with("error", $e->getMessage());
        }
    }

    public function updateTarget(Request $request, $id)
    {
        TargetCommerce::where('id', $id)->update([
            "bulan" => $request->bulan,
            "jumlah"=> str_replace('.','',$request->jumlah),
            'jenis_laporan' => $request->jenis_laporan,
            'id_portofolio' => $request->id_portofolio,
            'tahun' => $request->tahun,
        ]);

        return redirect()->intended(route('admin.dashboard.target'))->with("success", "Berhasil mengubah Target Commerce");
    }
}