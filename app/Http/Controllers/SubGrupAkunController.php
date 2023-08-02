<?php

namespace App\Http\Controllers;

use App\Models\SubGrupAkun;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;

class SubGrupAkunController extends Controller
{
    //
    public function index()
    {
        $sub_grup_akun = array();
        return view('admin.dashboard.sub_grup_akun', [
            "title" => "SubGrupAkun",
            "sub_grup_akun" => SubGrupAkun::all(),
        ]);
    }

    public function storeSub(Request $request)
    {
        SubGrupAkun::insert([
            "nama_sub" => $request->nama_sub,
        ]);
        return redirect()->intended(route('admin.dashboard.sub'))->with("success", "Berhasil menambahkan Sub Grup Akun");
    }

    public function deleteSub($id)
    {
        try {
            DB::beginTransaction();

            $sub_grup_akun = SubGrupAkun::find($id);

            // Jika tidak ada pengecualian, hapus kota
            $sub_grup_akun->delete();

            DB::commit();

            return redirect()->intended(route('admin.dashboard.sub'))->with("success", "Berhasil menghapus Sub Grup Akun");
        } catch (QueryException $e) {
            DB::rollback();

            // Tangkap pengecualian QueryException jika terjadi kesalahan database
            return redirect()->intended(route('admin.dashboard.sub'))->with("error", "Terjadi kesalahan database. Silakan coba lagi.");
        } catch (\Exception $e) {
            DB::rollback();

            // Tangkap pengecualian umum dan tampilkan pesan error
            return redirect()->intended(route('admin.dashboard.sub'))->with("error", $e->getMessage());
        }
    }

    public function updateSub(Request $request, $id)
    {
        SubGrupAkun::where('id', $id)->update([
            "nama_sub" => $request->nama_sub,
        ]);

        return redirect()->intended(route('admin.dashboard.sub'))->with("success", "Berhasil mengubah Sub Grup Akun");
    }
}
