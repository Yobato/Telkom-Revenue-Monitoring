@extends('layouts.commerce-master')

@section('title', 'Reporting')

@section('content')
<section class="section">
    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    {{-- ADD LAPORAN --}}
                    <div class="card-body d-flex justify-content-start" style="padding-bottom:0; margin-bottom:0;">
                        <div class="breadcrumb-item"><a href="{{ route('commerce.dashboard.index') }}">Dashboard</a>
                        </div>
                        <div class="breadcrumb-item active">Create Report </div>
                    </div>
                    <div class="card-header" style="padding-bottom:0;">
                        <div class="col-12">
                            <h3>Reporting</h3>
                        </div>
                    </div>

                    <p style="padding-left: 43px; padding-bottom:10px">Create reports in accordance with the provisions
                        and SOPs that apply at Telkom Access. You can change this report later.</p>
                </div>
            </div>
        </div>
    </div>

    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="px-5 pt-4" style="font-size: 140%"><b>Create Report</b></div>
                    <div class="px-5 pt-2 pb-0">Adjust the data needed to create a report</div>
                    <form action="{{route('commerce.storeLaporanCommerce')}}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group pt-4 pb-0 pl-5 mb-0 pb-0">
                                    <label for="id_commerce" class="col-form-label">PID Commerce: </label>
                                    <input type="text" id="id_commerce" name="id_commerce"
                                        class="form-control @error('id_commerce') is-invalid @enderror mb-2"
                                        value="{{ old('id_commerce') }}">
                                    @error('id_commerce')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror

                                    <label for="id_program" class="col-form-label">Program Name: </label>
                                    <select
                                        class="id_program form-control @error('id_program') is-invalid @enderror mb-2"
                                        name="id_program" value="{{ old('id_program') }}">
                                        <option value="" selected>-- Choose Program Name --</option>
                                        @foreach ($addprogram as $program)
                                        <option value={{ $program->id }} @selected(old('id_program')==$program->id)>{{
                                            $program->nama_program }}</option>
                                        @endforeach
                                    </select>
                                    @error('id_program')
                                    <div class="invalid-feedback">
                                        Program Name Field is required!
                                    </div>
                                    @enderror

                                    <label for="id_portofolio" class="col-form-label">Portofolio: </label>
                                    <select
                                        class="id_portofolio form-control @error('id_portofolio') is-invalid @enderror mb-2"
                                        name="id_portofolio" value="{{ old('id_portofolio') }}">
                                        <option value="" selected>-- Choose Portofolio --</option>
                                        @foreach ($addportofolio as $portofolio)
                                        <option value={{ $portofolio->id }}
                                            @selected(old('id_portofolio')==$portofolio->id)>{{
                                            $portofolio->nama_portofolio }}</option>
                                        @endforeach
                                    </select>
                                    <span id="id_portofolio_error" style="display: none; color: red;">Field Portofolio
                                        harus diisi!</span>
                                    @error('id_portofolio')
                                    <div class="invalid-feedback">
                                        Portofolio Name Field is required!
                                    </div>
                                    @enderror

                                    <label for="keterangan" class="col-form-label">Description:</label>
                                    <input type="text" id="keterangan" name="keterangan" value="{{ old('keterangan') }}"
                                        class="form-control @error('keterangan') is-invalid @enderror mb-2">
                                    @error('keterangan')
                                    <div class="invalid-feedback">
                                        Description Field is required!
                                    </div>
                                    @enderror

                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group pt-4 pb-0 pr-5 mb-0">
                                    <label for="id_sub_grup_akun" class="col-form-label">Sub Grup Akun: </label>
                                    <select
                                        class="id_sub_grup_akun form-control @error('id_sub_grup_akun') is-invalid @enderror mb-2"
                                        name="id_sub_grup_akun" value="{{ old('id_sub_grup_akun') }}">
                                        <option value="" selected>-- Choose Sub Grup Akun --</option>
                                        @foreach ($addsubgrupakun as $subgrupakun)
                                        <option value={{ $subgrupakun->id }}
                                            @selected(old('id_sub_grup_akun')==$subgrupakun->id)>{{
                                            $subgrupakun->nama_sub}}</option>
                                        @endforeach
                                    </select>
                                    <span id="sub_grup_akun_error" style="display: none; color: red;">Field Sub Grup
                                        Akun harus diisi!</span>
                                    @error('id_sub_grup_akun')
                                    <div class="invalid-feedback">
                                        Sub Grup Akun Field is required!
                                    </div>
                                    @enderror

                                    <label for="jenis_laporan" class="col-form-label">Report Type: </label>
                                    <select
                                        class="jenis_laporan form-control @error('jenis_laporan') is-invalid @enderror mb-2"
                                        name="jenis_laporan">
                                        <option value="" selected>-- Choose Report Type --</option>
                                        <option value="COGS" @if(old('jenis_laporan')=='COGS' ) selected @endif>COGS
                                        </option>
                                        <option value="REVENUE" @if(old('jenis_laporan')=='REVENUE' ) selected @endif>
                                            REVENUE</option>
                                    </select>
                                    <span id="jenis_laporan_error" style="display: none; color: red;">Field Report Type
                                        harus diisi!</span>
                                    @error('jenis_laporan')
                                    <div class="invalid-feedback">
                                        Report Type Field is required!
                                    </div>
                                    @enderror

                                    <label for="nilai" class="col-form-label">Amount: </label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                Rp.
                                            </div>
                                        </div>
                                        <input type="text" id="nilai" name="nilai" value="{{ old('nilai') }}"
                                            class="form-control @error('nilai') is-invalid @enderror mb-2"
                                            oninput="formatCurrency(this)">
                                    </div>
                                    <span id="nilai_error" style="display: none; color: red;">Field Nilai harus
                                        diisi!</span>
                                    @error('nilai')
                                    <div class="invalid-feedback">
                                        Amount Field is required!
                                    </div>
                                    @enderror

                                    <label for="monthYearPicker" class="col-form-label">Month and Year:</label>
                                    <input type="month" id="monthYearPicker" onchange="handleDateChange(this)"
                                        name="tanggal" value="{{ old('tanggal') }}"
                                        class="form-control @error('tanggal') is-invalid @enderror mb-2">
                                    @error('tanggal')
                                    <div class="invalid-feedback">
                                        Month and Year Field is required!
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
                            <button class="btn btn-primary" value="Simpan Data" type="submit">Create Report</button>
                        </div>
                    </form>
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