@extends('layouts.finance-master')

@section('title', 'Reporting')

@section('content')
<section class="section">
    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    {{-- ADD LAPORAN  --}}
                    <div class="card-body d-flex justify-content-start" style="padding-bottom:0; margin-bottom:0;">
                        <div class="breadcrumb-item"><a href="{{ route('finance.dashboard.index') }}">KKP Operasional</a></div>
                        <div class="breadcrumb-item active">Edit Laporan </div>
                    </div>
                    <div class="card-header" style="padding-bottom:0;">
                        <div class="col-12">
                            <h3>Reporting</h3>
                        </div>
                    </div>

                    <p style="padding-left: 43px; padding-bottom:10px">Edit Laporan sesuai dengan ketentuan dan SOP yang berlaku di Telkom Akses. Anda dapat mengubah laporan ini nanti.</p>
                </div>
            </div>
        </div>
    </div>

    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="px-5 pt-4" style="font-size: 140%"><b>Edit Laporan</b></div>
                    <div class="px-5 pt-2 pb-0">Sesuaikan data yang dibutuhkan dalam membuat laporan</div>
                    @foreach ($finance as $laporan)
                    <form action="{{route('finance.updateLaporanFinance', [$id])}}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group pt-4 pb-0 pl-5 mb-0 pb-0">
                                    <label for="pid_finance" class="col-form-label">PID Finance: </label>
                                    <input type="text" id="pid_finance" name="pid_finance" class="form-control @error('pid_finance') is-invalid @enderror mb-2" value="{{ old('pid_finance', $laporan->pid_finance) }}" readonly>
                                    @error('pid_finance')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                    
                                    <label for="id_portofolio" class="col-form-label">Portofolio: </label>
                                    <select class="id_portofolio form-control @error('id_portofolio') is-invalid @enderror mb-2" name="id_portofolio" value="{{ old('id_portofolio', $laporan->id_portofolio) }}" id="id_portofolio" onchange="getProgram()">
                                        <option value="" selected>-- Pilih Portofolio --</option>
                                        @foreach ($addportofolio as $portofolio)
                                        <option value="{{ $portofolio->id }}" {{ strcmp($laporan->id_portofolio, "$portofolio->id")==0? 'selected':''; }}>{{ $portofolio->nama_portofolio }}</option>
                                        @endforeach
                                    </select>
                                    <span id="id_portofolio_error" style="display: none; color: red;">Field Portofolio harus diisi!</span>
                                    @error('id_portofolio')
                                    <div class="invalid-feedback">
                                        Field Portofolio harus diisi!
                                    </div>
                                    @enderror
                                    
                                    
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group pt-4 pb-0 pr-5 mb-0">
                                    <label for="id_program" class="col-form-label">Nama Program: </label>
                                    <select class="id_program form-control @error('id_program') is-invalid @enderror mb-2" name="id_program" value="{{ old('id_program', $laporan->id_program) }}" id="id_program">
                                        <option value="" selected>-- Pilih Nama Program --</option>
                                        @foreach ($addprogram as $program)
                                        <option value="{{ $program->id }}" {{ strcmp($laporan->id_program,"$program->id")==0? 'selected':''; }}>{{ $program->nama_program }}</option>
                                        @endforeach
                                    </select>
                                    @error('id_program')
                                    <div class="invalid-feedback">
                                        Field Nama Program harus diisi!
                                    </div>
                                    @enderror
                                    
                                    <label for="id_cost_plan" class="col-form-label">Cost Plan: </label>
                                    <select class="id_cost_plan form-control @error('id_cost_plan') is-invalid @enderror mb-2" name="id_cost_plan" value="{{ old('id_cost_plan', $laporan->id_cost_plan) }}">
                                        <option value="" selected>-- Pilih Cost Plan --</option>
                                        @foreach ($addcostplan as $costplan)
                                        <option value="{{ $costplan->id }}" {{ strcmp($laporan->id_cost_plan, "$costplan->id")==0? 'selected':''; }}>{{ $costplan->nama_cost_plan}}</option>
                                        @endforeach
                                    </select>
                                    <span id="cost_plan_error" style="display: none; color: red;">Field Portofolio harus diisi!</span>
                                    @error('id_cost_plan')
                                    <div class="invalid-feedback">
                                        Field Cost Plan harus diisi!
                                    </div>
                                    @enderror

                                </div>
                            </div>
                        </div>
                        <div class="row mb-lg-5">
                            <div class="col-lg-12" style="padding: 0 62px">

                            </div>
                        </div>
                        <div class="d-flex justify-content-end pr-5 mb-5">
                            <button class="btn btn-primary" value="Simpan Data" type="submit">Buat Laporan</button>
                        </div>
                    </form>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

</section>

@endsection

<script>
    function formatCurrency(input) {
        // Menghilangkan semua karakter selain angka
        let rawValue = input.value.replace(/[^\d]/g, '');

        // Memastikan input tidak kosong
        if (rawValue) {
            // Mengubah angka menjadi format uang dengan pemisah ribuan (.)
            let formattedValue = Number(rawValue).toLocaleString('id-ID');

            // Menampilkan hasil format uang di input
            input.value = formattedValue;
        }
    }
</script>
<script>
    // Panggil fungsi getProgram() saat halaman dimuat
    document.addEventListener("DOMContentLoaded", function () {
        getProgram();
    });

    function getProgram() {
        let portofolioSelect = document.getElementById("id_portofolio");
        let programSelect = document.getElementById("id_program");
        let oldProgramValue = "{{ old('id_program', $laporan->id_program) }}";

        // Simpan oldProgramValue sebagai nilai yang akan dipilih
        programSelect.value = oldProgramValue;

        portofolioSelect.addEventListener("change", function () {
            let portofolio = portofolioSelect.value;

            if (portofolio != "") {
                $.ajax({
                    type: "POST", // Sesuaikan dengan metode HTTP yang digunakan oleh rute Anda
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/x-www-form-urlencoded',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    url: '{{ route("finance.reporting.getProgram") }}', // Ganti dengan rute yang sesuai untuk mendapatkan program berdasarkan portofolio
                    data: {
                        id_portofolio: portofolio
                    },
                    success: function (response) {
                        // Mengisi ulang dropdown Program dengan data yang diterima dari server
                        programSelect.innerHTML = "<option value=''>-- Pilih Nama Program --</option>";
                        programSelect.innerHTML += response;
                    },
                });
            }
        });
    }
</script>
