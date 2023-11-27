<?php

namespace App\Http\Controllers;

use App\Models\Portofolio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

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
        // Lakukan validasi menggunakan Validator di dalam kontroller
        $validator = Validator::make($request->all(), [
            'nama_portofolio' => [
                Rule::unique('portofolio')->where(function ($query) use ($request) {
                    return $query->where('nama_portofolio', $request->nama_portofolio)
                                ->where('role', $request->role);
                }),
            ],
        ], [
            'nama_portofolio.unique' => 'Kombinasi Nama Portofolio dan Role sudah ada dalam database.',
        ]);

        
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } 
        
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

    // public function updatePortofolio(Request $request, $id)
    // {
    //     Portofolio::where('id', $id)->update([
    //         "nama_portofolio" => $request->nama_portofolio,
    //         "role" => $request->role,
    //     ]);

    //     return redirect()->intended(route('admin.dashboard.portofolio'))->with("success", "Berhasil mengubah Portofolio");
    // }

    public function updatePortofolio(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nama_portofolio' => [
                Rule::unique('portofolio')->where(function ($query) use ($request, $id) {
                    return $query->where('nama_portofolio', $request->nama_portofolio)
                        ->where('role', $request->role)
                        ->where('id', '!=', $id); // Tambahkan kondisi untuk memeriksa id
                }),
            ],
            // ... definisi validasi untuk field lainnya
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $portofolio = Portofolio::find($id);
        $portofolio->nama_portofolio = $request->nama_portofolio;
        $portofolio->role = $request->role;
        $portofolio->save();
        
        Portofolio::where('id', $id)->update([
            "nama_portofolio" => $request->nama_portofolio,
            "role" => $request->role,
        ]);

        return redirect()->intended(route('admin.dashboard.portofolio'))->with("success", "Berhasil mengubah Portofolio");
    }
}