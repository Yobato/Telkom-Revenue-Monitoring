<?php

namespace App\Http\Controllers;

use App\Models\CostPlan;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;

class CostPlanController extends Controller
{
    //
    public function index()
    {
        $cost_plan = array();
        return view('admin.dashboard.cost_plan', [
            "title" => "Cost Plan",
            "cost_plan" => CostPlan::all(),
        ]);
    }

    public function storeCostPlan(Request $request)
    {
        CostPlan::insert([
            "nama_cost_plan" => $request->nama_cost_plan,
        ]);
        return redirect()->intended(route('admin.dashboard.cost_plan'))->with("success", "Berhasil menambahkan Cost Plan");
    }

    public function deleteCostPlan($id)
    {
        try {
            DB::beginTransaction();

            $cost_plan = CostPlan::find($id);

            // Jika tidak ada pengecualian, hapus Cost Plan
            $cost_plan->delete();

            DB::commit();

            return redirect()->intended(route('admin.dashboard.cost_plan'))->with("success", "Berhasil menghapus Cost Plan");
        } catch (QueryException $e) {
            DB::rollback();

            // Tangkap pengecualian QueryException jika terjadi kesalahan database
            return redirect()->intended(route('admin.dashboard.cost_plan'))->with("error", "Terjadi kesalahan database. Silakan coba lagi.");
        } catch (\Exception $e) {
            DB::rollback();

            // Tangkap pengecualian umum dan tampilkan pesan error
            return redirect()->intended(route('admin.dashboard.cost_plan'))->with("error", $e->getMessage());
        }
    }

    public function updateCostPlan(Request $request, $id)
    {
        CostPlan::where('id', $id)->update([
            "nama_cost_plan" => $request->nama_cost_plan,
        ]);

        return redirect()->intended(route('admin.dashboard.cost_plan'))->with("success", "Berhasil mengubah Cost Plan");
    }
}
