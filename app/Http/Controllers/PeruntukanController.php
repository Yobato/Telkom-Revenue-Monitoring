<?php

namespace App\Http\Controllers;

use App\Models\Peruntukan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;

class PeruntukanController extends Controller
{
    //
    public function index()
    {
        $peruntukan = array();
        return view('admin.dashboard.peruntukan', [
            "title" => "Peruntukan",
            "peruntukan" => Peruntukan::all(),
        ]);
    }

    public function storePeruntukan(Request $request)
    {
        Peruntukan::insert([
            "nama_peruntukan" => $request->nama_peruntukan,
        ]);
        return redirect()->intended(route('admin.dashboard.peruntukan'))->with("success", "Berhasil menambahkan Peruntukan");
    }

    public function deletePeruntukan($id)
    {
        try {
            DB::beginTransaction();

            $peruntukan = Peruntukan::find($id);

            // Jika tidak ada pengecualian, hapus kota
            $peruntukan->delete();

            DB::commit();

            return redirect()->intended(route('admin.dashboard.peruntukan'))->with("success", "Berhasil menghapus Peruntukan");
        } catch (QueryException $e) {
            DB::rollback();

            // Tangkap pengecualian QueryException jika terjadi kesalahan database
            return redirect()->intended(route('admin.dashboard.peruntukan'))->with("error", "Terjadi kesalahan database. Silakan coba lagi.");
        } catch (\Exception $e) {
            DB::rollback();

            // Tangkap pengecualian umum dan tampilkan pesan error
            return redirect()->intended(route('admin.dashboard.peruntukan'))->with("error", $e->getMessage());
        }
    }

    public function updatePeruntukan(Request $request, $id)
    {
        Peruntukan::where('id', $id)->update([
            "nama_peruntukan" => $request->nama_peruntukan,
        ]);

        return redirect()->intended(route('admin.dashboard.peruntukan'))->with("success", "Berhasil mengubah Peruntukan");
    }
}
