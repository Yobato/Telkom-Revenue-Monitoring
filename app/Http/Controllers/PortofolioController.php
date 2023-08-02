<?php

namespace App\Http\Controllers;

use App\Models\Portofolio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PortofolioController extends Controller
{
    //
    public function index()
    {
        $portofolio = array();
        $roles = DB::table('role')
            ->select('*')
            ->where('nama_role', '!=', "Admin")
            ->where('nama_role', '!=', "GM")
            ->get();

        return view('admin.dashboard.portofolio', [
            "title" => "Portofolio",
            "portofolio" => Portofolio::all(),
            "roles" => $roles,
        ]);
    }

    public function storePortofolio(Request $request)
    {
        Portofolio::insert([
            "nama_portofolio" => $request->nama_portofolio,
            "role" => $request->role,
        ]);
        return redirect()->intended(route('admin.dashboard.portofolio'))->with("success", "Berhasil menambahkan Portofolio");
    }

    public function deletePortofolio($id)
    {
        try {
            DB::beginTransaction();

            $portofolio = Portofolio::find($id);

            // Jika tidak ada pengecualian, hapus akun
            $portofolio->delete();

            DB::commit();

            return redirect()->intended(route('admin.dashboard.portofolio'))->with("success", "Berhasil menghapus Portofolio");
        } catch (QueryException $e) {
            DB::rollback();

            // Tangkap pengecualian QueryException jika terjadi kesalahan database
            return redirect()->intended(route('admin.dashboard.portofolio'))->with("error", "Terjadi kesalahan database. Silakan coba lagi.");
        } catch (\Exception $e) {
            DB::rollback();

            // Tangkap pengecualian umum dan tampilkan pesan error
            return redirect()->intended(route('admin.dashboard.portofolio'))->with("error", $e->getMessage());
        }
    }

    public function updatePortofolio(Request $request, $id)
    {
        Portofolio::where('id', $id)->update([
            "nama_portofolio" => $request->nama_portofolio,
            "role" => $request->role,
        ]);

        return redirect()->intended(route('admin.dashboard.portofolio'))->with("success", "Berhasil mengubah Portofolio");
    }
}
