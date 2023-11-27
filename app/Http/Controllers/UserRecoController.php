<?php

namespace App\Http\Controllers;

use App\Models\UserReco;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

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
        $validator = Validator::make($request->all(), UserReco::$rules, UserReco::$messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        
        UserReco::insert([
            "nama_user_reco" => $request->nama_user_reco,
        ]);
        return redirect()->intended(route('admin.dashboard.user_reco'))->with("success", "Berhasil menambahkan User Laporan");
    }

    public function deleteUserReco($id)
    {
        try {
            DB::beginTransaction();

            $user_reco = UserReco::find($id);

            // Jika tidak ada pengecualian, hapus User Laporan
            $user_reco->delete();

            DB::commit();

            return redirect()->intended(route('admin.dashboard.user_reco'))->with("success", "Berhasil menghapus User Laporan");
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
        // Ambil aturan validasi dari model
        $rules = UserReco::$rules;
        $messages = UserReco::$messages;

        // Modifikasi aturan validasi untuk keperluan update
        $rules['nama_user_reco'] = 'unique:user_reco,nama_user_reco,'.$id.',id';

        // Buat validator dengan aturan validasi yang telah dimodifikasi
        $validator = Validator::make($request->all(), $rules, $messages);

        // Lakukan validasi
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        
        UserReco::where('id', $id)->update([
            "nama_user_reco" => $request->nama_user_reco,
        ]);

        return redirect()->intended(route('admin.dashboard.user_reco'))->with("success", "Berhasil mengubah User Laporan");
    }
}