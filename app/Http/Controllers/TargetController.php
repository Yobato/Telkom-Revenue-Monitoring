<?php

namespace App\Http\Controllers;

use App\Models\Target;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;

class TargetController extends Controller
{
    //
    public function index()
    {
        return view('admin.dashboard.target', [
            "title" => "Target",
            "target" => Target::all(),
        ]);
    }

    public function storeTarget(Request $request)
    {
        Target::insert([
            "bulan" => $request->bulan,
            "jumlah"=> str_replace('.','',$request->jumlah),
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
        ]);

        return redirect()->intended(route('admin.dashboard.target'))->with("success", "Berhasil mengubah Target");
    }
}

