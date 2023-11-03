<?php

namespace App\Http\Controllers;

use App\Models\Program;
use App\Models\Portofolio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProgramController extends Controller
{
    //
    public function index()
    {

        $portofolio_id = array();
        foreach (Portofolio::all() as $porto) {
            $portofolio_id[$porto->id] = $porto->nama_portofolio;
        }
        
        $program = array();
        $roles = DB::table('role')
            ->select('*')
            ->where('nama_role', '!=', "Admin")
            ->where('nama_role', '!=', "GM")
            ->get();

        $portofolios = DB::table('portofolio')
            ->select('*')
            ->get();

        return view('admin.dashboard.program', [
            "title" => "Program",
            "program" => Program::all(),
            "roles" => $roles,
            "portofolios" => $portofolios,
            "portofolio_id" => $portofolio_id,
        ]);
    }

    public function dependentDropdownRole(Request $request){
        $role = $request->role;

        $addportofolio = DB::table("portofolio")
        ->where('role', $role)
        ->get();

        $output = '';
        foreach($addportofolio as $portofolio){
            $output .= '<option value="' .$portofolio->id. '">' . $portofolio->nama_portofolio . '</option>';
        }

        return $output;
    }

    public function storeProgram(Request $request)
    {
        Program::insert([
            "nama_program" => $request->nama_program,
            "kode_program" => $request->kode_program,
            "role" => $request->role,
            "id_portofolio" => $request->id_portofolio,
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
            "id_portofolio" => $request->id_portofolio,
        ]);

        return redirect()->intended(route('admin.dashboard.program'))->with("success", "Berhasil mengubah Program");
    }
}