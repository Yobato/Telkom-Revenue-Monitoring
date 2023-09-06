<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\Target;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;

class TargetController extends Controller
{
    //
    public function index()
    {
         $account = Auth::guard('account')->user();
        if ($account->role == "Admin") {
            return view('admin.dashboard.target', [
                "title" => "Target",
                "target" => Target::all(),
                "roles" => Role::all(),
            ]);
        } elseif($account->role == "GM"){
            return view('manager.dashboard.target', [
                "title" => "Target",
                "target" => Target::all(),
                "roles" => Role::all(),
            ]);
        }
    }

    public function storeTarget(Request $request)
    {
        Target::insert([
            "bulan" => $request->bulan,
            "jumlah"=> str_replace('.','',$request->jumlah),
            'jenis_laporan' => $request->jenis_laporan,
            'tahun' => $request->tahun,
        ]);
        return redirect()->intended(route('admin.dashboard.target'))->with("success", "Berhasil menambahkan Target");
    }

    public function deleteTarget($id)
    {
        try {
            DB::beginTransaction();

            $target = Target::find($id);

            // Jika tidak ada pengecualian, hapus kota
            $target->delete();

            DB::commit();

            return redirect()->intended(route('admin.dashboard.target'))->with("success", "Berhasil menghapus Target");
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
        Target::where('id', $id)->update([
            "bulan" => $request->bulan,
            "jumlah"=> str_replace('.','',$request->jumlah),
            'jenis_laporan' => $request->jenis_laporan,
            'tahun' => $request->tahun,
        ]);

        return redirect()->intended(route('admin.dashboard.target'))->with("success", "Berhasil mengubah Target");
    }
}