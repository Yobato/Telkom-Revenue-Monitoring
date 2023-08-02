@extends('layouts.commerce-master')

@section('title', 'Reporting')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet"
        href="{{ asset('library/bootstrap-daterangepicker/daterangepicker.css') }}">
    <link rel="stylesheet"
        href="{{ asset('library/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('library/select2/dist/css/select2.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('library/selectric/public/selectric.css') }}">
    <link rel="stylesheet"
        href="{{ asset('library/bootstrap-timepicker/css/bootstrap-timepicker.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('library/bootstrap-tagsinput/dist/bootstrap-tagsinput.css') }}">
@endpush

@section('content')
    <section class="section">
    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    {{-- ADD LAPORAN  --}}
                    <div class="card-body d-flex justify-content-start" style="padding-bottom:0; margin-bottom:0;">
                        <div class="breadcrumb-item"><a href="{{ route('commerce-cogs') }}">COGS</a></div>
                        <div class="breadcrumb-item active">Buat Laporan </div>
                    </div>
                    <div class="card-header" style="padding-bottom:0;">
                        <div class="col-12">
                            <h3>Reporting</h3>
                        </div>
                    </div>
                    
                    <p style="padding-left: 43px; padding-bottom:10px">Buat Laporan sesuai dengan ketentuan dan SOP yang berlaku di Telkom Akses. Anda dapat mengubah laporan ini nanti.</p>
                </div>
            </div>
        </div>
    </div>

    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="px-5 pt-4" style="font-size: 140%"><b>Buat Laporan</b></div>
                    <div class="px-5 pt-2 pb-0">Sesuaikan data yang dibutuhkan dalam membuat laporan</div>
                    <form>
                        @csrf
                        <div class="row">
                            <div class="col-lg-6">
                            <div class="form-group pt-4 pb-0 pl-5 mb-0 pb-0">
                                <label for="ID_commerce" class="col-form-label">ID Commerce: </label>
                                <input type="text" id="ID_commerce" name="ID_commerce" class="form-control @error('ID_commerce') is-invalid @enderror mb-2" value="{{ old('ID_commerce') }}">
                                <span id=" ID_commerce_error" style="display: none; color: red;">Field ID Commerce harus diisi!</span>
                                @error('ID_commerce')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror

                                <label for="jenis_id" class="col-form-label">Jenis: </label>
                                <select class="jenis_id form-control @error('jenis_id') is-invalid @enderror mb-2" name="jenis_id" value="{{ old('jenis_id') }}">
                                    <option value="" selected>-- Pilih Jenis Laporan --</option>
                                    {{-- @foreach ($tipeprov as $tipe_provisioning)
                                        <option value={{ $tipe_provisioning->id }} @selected(old('tipe_provisioning_id') == $tipe_provisioning->id)>{{ $tipe_provisioning->nama_tipe_provisioning }}</option>
                                    @endforeach --}}
                                </select>
                                <span id="jenis_id_error" style="display: none; color: red;">Field Jenis Laporan harus diisi!</span>
                                @error('jenis_id')
                                <div class="invalid-feedback">
                                    Field Jenis Laporan harus diisi!
                                </div>
                                @enderror

                                <label for="kode_program" class="col-form-label">Kode Program: </label>
                                <input type="text" id="kode_program" name="kode_program" value="{{ old('kode_program') }}" class="form-control @error('kode_program') is-invalid @enderror mb-2">
                                <span id="kode_program_error" style="display: none; color: red;">Field Kode Program harus diisi!</span>
                                @error('kode_program')
                                <div class="invalid-feedback">
                                    Field Kode Program harus diisi!
                                </div>
                                @enderror

                                <label for="nama_program" class="col-form-label">Nama Program: </label>
                                <input type="text" id="nama_program" name="nama_program" value="{{ old('nama_program') }}" class="form-control @error('nama_program') is-invalid @enderror mb-2">
                                <span id="nama_program_error" style="display: none; color: red;">Field Nama Program harus diisi!</span>
                                @error('nama_program')
                                <div class="invalid-feedback">
                                    Field Nama Program harus diisi!
                                </div>
                                @enderror

                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group pt-4 pb-0 pr-5 mb-0">
                                    <label for="portofolio_id" class="col-form-label">Portofolio: </label>
                                    <select class="portofolio_id form-control @error('portofolio_id') is-invalid @enderror mb-2" name="portofolio_id" value="{{ old('portofolio_id') }}">
                                        <option value="" selected>-- Pilih Portofolio --</option>
                                        {{-- @foreach ($tipeprov as $tipe_provisioning)
                                            <option value={{ $tipe_provisioning->id }} @selected(old('tipe_provisioning_id') == $tipe_provisioning->id)>{{ $tipe_provisioning->nama_tipe_provisioning }}</option>
                                        @endforeach --}}
                                    </select>
                                    <span id="tipe_provisioning_id_error" style="display: none; color: red;">Field Portofolio harus diisi!</span>
                                    @error('portofolio_id')
                                    <div class="invalid-feedback">
                                        Field Portofolio harus diisi!
                                    </div>
                                    @enderror

                                    <label for="sub_group_plan_id" class="col-form-label">Sub Group Plan: </label>
                                    <select class="sub_group_plan_id form-control @error('sub_group_plan_id') is-invalid @enderror mb-2" name="sub_group_plan_id" value="{{ old('sub_group_plan_id') }}">
                                        <option value="" selected>-- Pilih Sub Group Plan --</option>
                                        {{-- @foreach ($tipeprov as $tipe_provisioning)
                                            <option value={{ $tipe_provisioning->id }} @selected(old('tipe_provisioning_id') == $tipe_provisioning->id)>{{ $tipe_provisioning->nama_tipe_provisioning }}</option>
                                        @endforeach --}}
                                    </select>
                                    <span id="sub_group_plan_id_error" style="display: none; color: red;">Field Sub Group Plan harus diisi!</span>
                                    @error('sub_group_plan_id')
                                    <div class="invalid-feedback">
                                        Field Sub Group Plan harus diisi!
                                    </div>
                                    @enderror

                                    <label for="nilai" class="col-form-label">Nilai: </label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                Rp.
                                            </div>
                                        </div>
                                        <input type="text" id="nilai" name="nilai" value="{{ old('nilai') }}" class="form-control @error('nilai') is-invalid @enderror mb-2" oninput="formatCurrency(this)">  
                                    </div>
                                    <span id="nilai_error" style="display: none; color: red;">Field Nilai harus diisi!</span>
                                    @error('nilai')
                                    <div class="invalid-feedback">
                                        Field Nilai harus diisi!
                                    </div>
                                    @enderror

                                    <label for="keterangan" class="col-form-label">Keterangan:</label>
                                    <input type="text" id="keterangan" name="keterangan" value="{{ old('keterangan') }}" class="form-control @error('keterangan') is-invalid @enderror mb-2">
                                    {{-- <textarea id="keterangan" name="keterangan" class="form-control" rows="10" cols="500"></textarea> --}}
                                    <span id="keterangan_error" style="display: none; color: red;">Field Keterangan harus diisi!</span>
                                    @error('keterangan')
                                    <div class="invalid-feedback">
                                        Field Keterangan harus diisi!
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
                </div>
            </div>
        </div>
    </div>

    </section>

@endsection

@push('scripts')
    {{-- <!-- JS Libraies -->
    <script src="{{ asset('library/cleave.js/dist/cleave.min.js') }}"></script>
    <script src="{{ asset('library/cleave.js/dist/addons/cleave-phone.us.js') }}"></script>
    <script src="{{ asset('library/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
    <script src="{{ asset('library/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js') }}"></script>
    <script src="{{ asset('library/bootstrap-timepicker/js/bootstrap-timepicker.min.js') }}"></script>
    <script src="{{ asset('library/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js') }}"></script>
    <script src="{{ asset('library/select2/dist/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('library/selectric/public/jquery.selectric.min.js') }}"></script>

    <!-- Page Specific JS File -->
    <script src="{{ asset('js/page/forms-advanced-forms.js') }}"></script> --}}
@endpush
