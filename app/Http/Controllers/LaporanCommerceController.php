<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LaporanCommerce;
use App\Models\Program;
use App\Models\Portofolio;
use App\Models\SubGrupAkun;
use App\Models\City;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;
use App\Exports\UsersExportC;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Excel as ExcelExcel;

class LaporanCommerceController extends Controller
{
    //
    public function index()
    {
        $account = Auth::guard('account')->user();
        $commerce = DB::table('laporan_commerce');

        $program_id = array();
        foreach (Program::all() as $program) {
            $program_id[$program->id] = $program->nama_program;
        }
        $kode_program_id = array();
        foreach (Program::all() as $kodeprogram) {
            $kode_program_id[$kodeprogram->id] = $kodeprogram->kode_program;
        }

        $portofolio_id = array();
        foreach (Portofolio::all() as $porto) {
            $portofolio_id[$porto->id] = $porto->nama_portofolio;
        }
        $sub_grup_akun_id = array();
        foreach (SubGrupAkun::all() as $sub_grup_akun) {
            $sub_grup_akun_id[$sub_grup_akun->id] = $sub_grup_akun->nama_sub;
        }
        $citys = array();
        foreach (City::all() as $item) {
            $citys[$item->id] = $item->nama_city;
        }

        $account = Auth::guard('account')->user();
        if ($account->role == "Commerce") {
            return view('commerce.dashboard.index', [
                "commerce" => LaporanCommerce::all(),
                "title" => "Laporan Commerce",
                "laporan_commerce" => LaporanCommerce::all(),
                "program_id" => $program_id,
                "kode_program_id" => $kode_program_id,
                "portofolio_id" => $portofolio_id,
                "sub_grup_akun_id" => $sub_grup_akun_id,
                "citys" => $citys
            ]);
        } elseif ($account->role == "GM"){
            return view('manager.dashboard.laporanCommerce', [
                "commerce" => LaporanCommerce::all(),
                "title" => "Laporan Commerce",
                "laporan_commerce" => LaporanCommerce::all(),
                "program_id" => $program_id,
                "kode_program_id" => $kode_program_id,
                "portofolio_id" => $portofolio_id,
                "sub_grup_akun_id" => $sub_grup_akun_id,
                "citys" => $citys
            ]);
        } else {
            return view('admin.dashboard.laporanCommerce', [
                "commerce" => LaporanCommerce::all(),
                "title" => "Laporan Commerce",
                "laporan_commerce" => LaporanCommerce::all(),
                "program_id" => $program_id,
                "kode_program_id" => $kode_program_id,
                "portofolio_id" => $portofolio_id,
                "sub_grup_akun_id" => $sub_grup_akun_id,
                "citys" => $citys
            ]);
        }
    }
    public function export() 
    {
        return Excel::download(new UsersExportC, 'expor_commerce.xlsx', ExcelExcel::XLSX);
    }

    public function indexChart()
    {
        return view('commerce.dashboard.chart', [
            "title" => "Dashboard Commerce",
        ]);
    }


    public function addLaporanCommerce(Request $request)
    {
        return view('commerce.reporting.cogs-form', [
            "title" => "Buat Laporan Commerce",
            "addcity" =>  City::all(),
            "addprogram" => Program::all()->where("role", "=", "Commerce"),
            "addportofolio" => Portofolio::all()->where("role", "=", "Commerce"),
            "addsubgrupakun" => SubGrupAkun::all(),
            
        ]);
    }

    public function storeLaporanCommerce(Request $request)
    {


        $commerce = DB::table('laporan_commerce');
        $account = Auth::guard('account')->user();

        $messages = [
            'required' => "Field wajib diisi!",
            "unique" => "Nilai sudah ada",
        ];

        $this->validate($request, [
            'id_commerce' => 'required|unique:laporan_commerce',
            'nilai' => 'required',
            'keterangan' => 'required',
            'id_program' => 'required',
            'kode_program' => 'required',
            'id_portofolio' => 'required',
            'id_sub_grup_akun' => 'required',
            'jenis_laporan' => 'required',
            'tanggal' => 'required'
        ], $messages);


        LaporanCommerce::insert([
            'id_commerce' => $request->id_commerce,
            'nilai' => str_replace('.', '', $request->nilai),
            'keterangan' => $request->keterangan,
            'id_program' => $request->id_program,
            'kode_program' => $request->kode_program,
            'jenis_laporan' => $request->jenis_laporan,
            'id_portofolio' => $request->id_portofolio,
            'id_sub_grup_akun' => $request->id_sub_grup_akun,
            'kota' => $account->kota,
            'created_at' => Carbon::now(),
            'tanggal' => $request->tanggal . '-01'
        ]);
        return redirect()->intended(route('commerce.dashboard.index'))->with("success", "Berhasil menambahkan Laporan COGS");
    }



    public function deleteLaporanCommerce($id)
    {
        try {
            $account = Auth::guard('account')->user();
            DB::beginTransaction();

            $laporan_commerce = LaporanCommerce::find($id);

            // Jika tidak ada pengecualian, hapus kota
            $laporan_commerce->delete();

            DB::commit();

            return redirect()->intended(route('commerce.dashboard.index'))->with("success", "Berhasil menghapus Laporan Commerce");  
        } catch (QueryException $e) {
            DB::rollback();

            // Tangkap pengecualian QueryException jika terjadi kesalahan database
            return redirect()->intended(route('commerce.dashboard.index'))->with("error", $e->getMessage());
        } catch (\Exception $e) {
            DB::rollback();

            // Tangkap pengecualian umum dan tampilkan pesan error
            return redirect()->intended(route('commerce.dashboard.index'))->with("error", $e->getMessage());
        }
    }

    public function editLaporanCommerce($id)
    {
        return view('commerce.reporting.cogs-edit', [
            "title" => "Edit Laporan Commerce",
            "commerce" => LaporanCommerce::where("id_commerce", "=", $id)->get(),
            "addcity" => City::all(),
            "addprogram" => Program::all()->where("role", "=", "Commerce"),
            "addportofolio" => Portofolio::all()->where("role", "=", "Commerce"),
            "addsubgrupakun" => SubGrupAkun::all(),
            "id" => $id,
        ]);
    }

    public function updateLaporanCommerce(Request $request, $id)
    {
        $messages = [
            'required' => 'Field wajib diisi',
            'unique' => 'Nilai sudah ada',
        ];

        $this->validate($request, [
            'nilai' => 'required',
            'keterangan' => 'required',
            'id_program' => 'required',
            'id_portofolio' => 'required',
            'id_sub_grup_akun' => 'required',
            'tanggal' => 'required'
        ], $messages);

        // Mengambil nilai dari form
        // $jenisOrder = $request->jenis_order_id;
        // $tipeProvisioning = $request->tipe_provisioning_id;
        // $lokasi = $request->lokasi;

        // $order = JenisOrder::where("id", "=", $jenisOrder)
        //     ->get(["nama_jenis_order"]);
        // $orderObject = json_decode($order[0]);
        // $orderValue = $orderObject->nama_jenis_order;

        // $tipeProv = TipeProvisioning::where("id", "=", $tipeProvisioning)
        //     ->get(["nama_tipe_provisioning"]);
        // $tipeProvObject = json_decode($tipeProv[0]);
        // $tipeProvValue = $tipeProvObject->nama_tipe_provisioning;

        // if ($orderValue == "Konsumer" || $orderValue == "HEM" || $orderValue == "Node B" || $orderValue == "Node B OLO") {
        //     // Menggabungkan nilai autoGenerated dan inputLokasi
        //     $nilaiDitambahkan = $orderValue . " - " . $tipeProvValue . " - " . $lokasi;
        // } else {
        //     $nilaiDitambahkan = $lokasi;
        // }
        $account = Auth::guard('account')->user();
        LaporanCommerce::where('id_commerce', $id)->update([
            'nilai' => str_replace('.', '', $request->nilai),
            'keterangan' => $request->keterangan,
            'id_program' => $request->id_program,
            'id_portofolio' => $request->id_portofolio,
            'id_sub_grup_akun' => $request->id_sub_grup_akun,
            'kota' => $account->kota,
            'tanggal' => $request->tanggal . '-01'
        ]);
        return redirect()->intended(route('commerce.dashboard.index'))->with("success", "Berhasil mengubah Laporan Commerce");
    }

    public function Editable($id)
    {
        $account = Auth::guard('account')->user();
        LaporanCommerce::where('id_commerce', $id)->update([
            "editable" => 1
        ]);

        if ($account->role == "Commerce") {
            return redirect()->intended(route('commerce.dashboard.index'))->with("success", "Berhasil memberi akses edit pada Laporan Commerce");
        } else if ($account->role == "Admin") {
            return redirect()->intended(route('admin.dashboard.commerce'))->with("success", "Berhasil memberi akses edit pada Laporan Commerce");
        }
    }

    public function Uneditable($id)
    {
        $account = Auth::guard('account')->user();
        LaporanCommerce::where('id_commerce', $id)->update([
            "editable" => 0
        ]);

        if ($account->role == "Commerce") {
            return redirect()->intended(route('commerce.dashboard.index'))->with("success", "Berhasil menghapus akses edit pada Laporan Commerce");
        } else if ($account->role == "Admin") {
            return redirect()->intended(route('admin.dashboard.commerce'))->with("success", "Berhasil menghapus akses edit pada Laporan Commerce");
        }
    }
}