<?php

namespace App\Http\Controllers;

use App\Models\Program;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProgramController extends Controller
{
    //
    public function index()
    {
        $program = array();
        $roles = DB::table('role')
            ->select('*')
            ->where('nama_role', '!=', "Admin")
            ->where('nama_role', '!=', "GM")
            ->get();

        return view('admin.dashboard.program', [
            "title" => "Program",
            "program" => Program::all(),
            "roles" => $roles,
        ]);
    }

    public function storeProgram(Request $request)
    {
        Program::insert([
            "nama_program" => $request->nama_program,
            "kode_program" => $request->kode_program,
            "role" => $request->role,
        ]);
        return redirect()->intended(route('admin.dashboard.program'))->with("success", "Berhasil menambahkan Program");
    }

    public function deleteProgram($id)
    {
        try {
            DB::beginTransaction();

            $program = Program::find($id);

            // Jika tidak ada pengecualian, hapus akun
            $program->delete();

            DB::commit();

            return redirect()->intended(route('admin.dashboard.program'))->with("success", "Berhasil menghapus Program");
        } catch (QueryException $e) {
            DB::rollback();

            // Tangkap pengecualian QueryException jika terjadi kesalahan database
            return redirect()->intended(route('admin.dashboard.program'))->with("error", "Terjadi kesalahan database. Silakan coba lagi.");
        } catch (\Exception $e) {
            DB::rollback();

            // Tangkap pengecualian umum dan tampilkan pesan error
            return redirect()->intended(route('admin.dashboard.program'))->with("error", $e->getMessage());
        }
    }

    public function updateProgram(Request $request, $id)
    {
        Program::where('id', $id)->update([
            "nama_program" => $request->nama_program,
            "kode_program" => $request->kode_program,
            "role" => $request->role,
        ]);

        return redirect()->intended(route('admin.dashboard.program'))->with("success", "Berhasil mengubah Program");
    }
}