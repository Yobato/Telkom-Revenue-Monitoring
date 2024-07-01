<?php

namespace App\Http\Controllers;

use App\Models\Program;
use App\Models\Portofolio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

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
        // Lakukan validasi menggunakan Validator di dalam kontroller
        $validator = Validator::make($request->all(), [
            'nama_program' => [
                Rule::unique('program')->where(function ($query) use ($request) {
                    return $query->where('nama_program', $request->nama_program)
                                ->where('role', $request->role);
                }),
            ],
        ], [
            'nama_program.unique' => 'Kombinasi Nama Program dan Role sudah ada dalam database.',
        ]);

        
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }   
        
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

    // public function updateProgram(Request $request, $id)
    // {
    //     Program::where('id', $id)->update([
    //         "nama_program" => $request->nama_program,
    //         "kode_program" => $request->kode_program,
    //         "role" => $request->role,
    //         "id_portofolio" => $request->id_portofolio,
    //     ]);

    //     return redirect()->intended(route('admin.dashboard.program'))->with("success", "Berhasil mengubah Program");
    // }

    public function updateProgram(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nama_program' => [
                Rule::unique('program')->where(function ($query) use ($request, $id) {
                    return $query->where('nama_program', $request->nama_program)
                        ->where('role', $request->role)
                        ->where('id', '!=', $id); // Tambahkan kondisi untuk memeriksa id
                }),
            ],
            // ... definisi validasi untuk field lainnya
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Proses update data ke dalam database
        $program = Program::find($id);
        $program->nama_program = $request->nama_program;
        $program->kode_program = $request->kode_program;
        $program->role = $request->role;
        $program->id_portofolio = $request->id_portofolio;
        $program->save();

        return redirect()->intended(route('admin.dashboard.program'))->with("success", "Berhasil mengupdate Program");
    }

}