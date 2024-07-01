<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\Portofolio;
use App\Models\TargetFinance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;

class TargetFinanceController extends Controller
{
    //
    //
    public function index()
    {
        $portofolio_id = array();
        foreach (Portofolio::all() as $porto) {
            $portofolio_id[$porto->id] = $porto->nama_portofolio;
        }
        
         $account = Auth::guard('account')->user();
        if ($account->role == "Admin") {
            return view('admin.dashboard.target_finance', [
                "title" => "Target-Finance",
                "target" => TargetFinance::all(),
                "roles" => Role::all(),
                "portofolio_id" => $portofolio_id,
                "addportofolio" => Portofolio::all()->where("role", "=", "Finance"),
            ]);
        } elseif($account->role == "GM"){
            return view('manager.dashboard.target_finance', [
                "title" => "Target-Finance",
                "target" => TargetFinance::all(),
                "roles" => Role::all(),
                "portofolio_id" => $portofolio_id,
            ]);
        }
    }

    public function storeTargetFinance(Request $request)
    {
        TargetFinance::insert([
            "bulan" => $request->bulan,
            "jumlah"=> str_replace('.','',$request->jumlah),
            'id_portofolio' => $request->id_portofolio,
            'tahun' => $request->tahun,
        ]);
        return redirect()->intended(route('admin.dashboard.target-finance'))->with("success", "Berhasil menambahkan Target Finance");
    }

    public function deleteTargetFinance($id)
    {
        try {
            DB::beginTransaction();

            $target = TargetFinance::find($id);

            // Jika tidak ada pengecualian, hapus kota
            $target->delete();

            DB::commit();

            return redirect()->intended(route('admin.dashboard.target-finance'))->with("success", "Berhasil menghapus Target Finance");
        } catch (QueryException $e) {
            DB::rollback();

            // Tangkap pengecualian QueryException jika terjadi kesalahan database
            return redirect()->intended(route('admin.dashboard.target-finance'))->with("error", $e->getMessage());
        } catch (\Exception $e) {
            DB::rollback();

            // Tangkap pengecualian umum dan tampilkan pesan error
            return redirect()->intended(route('admin.dashboard.target-finance'))->with("error", $e->getMessage());
        }
    }

    public function updateTargetFinance(Request $request, $id)
    {
        TargetFinance::where('id', $id)->update([
            "bulan" => $request->bulan,
            "jumlah"=> str_replace('.','',$request->jumlah),
            'id_portofolio' => $request->id_portofolio,
            'tahun' => $request->tahun,
        ]);

        return redirect()->intended(route('admin.dashboard.target-finance'))->with("success", "Berhasil mengubah Target Finance");
    }
}