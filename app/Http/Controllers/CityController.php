<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class CityController extends Controller
{
    //
    public function index()
    {
        $city = array();
        return view('admin.dashboard.city', [
            "title" => "City",
            "city" => City::all(),
        ]);
    }

    public function storeCity(Request $request)
    {
        $validator = Validator::make($request->all(), City::$rules, City::$messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        
        City::insert([
            "nama_city" => $request->nama_city,
        ]);
        return redirect()->intended(route('admin.dashboard.city'))->with("success", "Berhasil menambahkan Kota");
    }

    public function deleteCity($id)
    {
        try {
            DB::beginTransaction();

            $city = City::find($id);

            // Jika tidak ada pengecualian, hapus kota
            $city->delete();

            DB::commit();

            return redirect()->intended(route('admin.dashboard.city'))->with("success", "Berhasil menghapus Kota");
        } catch (QueryException $e) {
            DB::rollback();

            // Tangkap pengecualian QueryException jika terjadi kesalahan database
            return redirect()->intended(route('admin.dashboard.city'))->with("error", "Terjadi kesalahan database. Silakan coba lagi.");
        } catch (\Exception $e) {
            DB::rollback();

            // Tangkap pengecualian umum dan tampilkan pesan error
            return redirect()->intended(route('admin.dashboard.city'))->with("error", $e->getMessage());
        }
    }

    public function updateCity(Request $request, $id)
    {
        // Ambil aturan validasi dari model
        $rules = City::$rules;
        $messages = City::$messages;

        // Modifikasi aturan validasi untuk keperluan update
        $rules['nama_city'] = 'unique:city,nama_city,'.$id.',id';

        // Buat validator dengan aturan validasi yang telah dimodifikasi
        $validator = Validator::make($request->all(), $rules, $messages);

        // Lakukan validasi
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        
        City::where('id', $id)->update([
            "nama_city" => $request->nama_city,
        ]);

        return redirect()->intended(route('admin.dashboard.city'))->with("success", "Berhasil mengubah Kota");
    }
}