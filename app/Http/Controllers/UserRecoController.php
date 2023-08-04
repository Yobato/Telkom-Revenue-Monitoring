<?php

namespace App\Http\Controllers;

use App\Models\UserReco;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;

class UserRecoController extends Controller
{
    //
    public function index()
    {
        $user_reco = array();
        return view('admin.dashboard.user_reco', [
            "title" => "User Reco",
            "user_reco" => UserReco::all(),
        ]);
    }

    public function storeUserReco(Request $request)
    {
        UserReco::insert([
            "nama_user_reco" => $request->nama_user_reco,
        ]);
        return redirect()->intended(route('admin.dashboard.user_reco'))->with("success", "Berhasil menambahkan Cost Plan");
    }

    public function deleteUserReco($id)
    {
        try {
            DB::beginTransaction();

            $user_reco = UserReco::find($id);

            // Jika tidak ada pengecualian, hapus Cost Plan
            $user_reco->delete();

            DB::commit();

            return redirect()->intended(route('admin.dashboard.user_reco'))->with("success", "Berhasil menghapus Cost Plan");
        } catch (QueryException $e) {
            DB::rollback();

            // Tangkap pengecualian QueryException jika terjadi kesalahan database
            return redirect()->intended(route('admin.dashboard.user_reco'))->with("error", "Terjadi kesalahan database. Silakan coba lagi.");
        } catch (\Exception $e) {
            DB::rollback();

            // Tangkap pengecualian umum dan tampilkan pesan error
            return redirect()->intended(route('admin.dashboard.user_reco'))->with("error", $e->getMessage());
        }
    }

    public function updateUserReco(Request $request, $id)
    {
        UserReco::where('id', $id)->update([
            "nama_user_reco" => $request->nama_user_reco,
        ]);

        return redirect()->intended(route('admin.dashboard.user_reco'))->with("success", "Berhasil mengubah Cost Plan");
    }
}
