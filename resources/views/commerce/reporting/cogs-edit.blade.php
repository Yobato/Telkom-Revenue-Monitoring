@extends('layouts.admin-master')

@section('content')
<section class="section">
    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    {{-- ADD LAPORAN COMMERCE --}}
                    <div class="card-body d-flex justify-content-start" style="padding-bottom:0; margin-bottom:0;">
                        <div class="breadcrumb-item"><a href="{{ route('commerce.dashboard.index') }}">Laporan Commerce</a></div>
                        <div class="breadcrumb-item active">Buat Laporan Commerce</div>
                    </div>
                    <div class="card-header" style="padding-bottom:0;">
                        <div class="col-12">
                            <h3>Commerce Report</h3>
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
                    @foreach ($commerce as $laporan)
                    <form action="{{route('commerce.updateLaporanCommerce', [$id])}}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group pt-4 pb-0 pl-5 mb-0 pb-0">
                                    <label for="id_commerce" class="col-form-label">PID Commerce: </label>
                                    <input type="text" id="id_commerce" name="id_commerce" class="form-control @error('id_commerce') is-invalid @enderror mb-2" value="{{ old('id_commerce', $id) }}" readonly>
                                    @error('id_commerce')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror

                                    <label for="id_program" class="col-form-label">Nama Program: </label>
                                    <select class="id_program form-control @error('id_program') is-invalid @enderror mb-2" name="id_program" value="{{ old('id_program', $laporan->id_program) }}">
                                        <option value="" selected>-- Pilih Nama Program --</option>
                                        @foreach ($addprogram as $program)
                                        <option value="{{ $program->id }}" {{ old('id_program', $laporan->id_program) == $program->id ? 'selected' : '' }}>{{ $program->nama_program }}</option>
                                        @endforeach
                                    </select>
                                    @error('id_program')
                                    <div class="invalid-feedback">
                                        Field Nama Program harus diisi!
                                    </div>
                                    @enderror

                                    <label for="kode_program" class="col-form-label">Kode Program: </label>
                                    <select class="kode_program form-control @error('kode_program') is-invalid @enderror mb-2" name="kode_program" value="{{ old('kode_program', $laporan->kode_program) }}">
                                        <option value="" selected>-- Pilih Kode Program --</option>
                                        @foreach ($addprogram as $program)
                                        <option value="{{ $program->id }}" {{ old('id_program', $laporan->id_program) == $program->id ? 'selected' : '' }}>{{ $program->nama_program }}</option>
                                        @endforeach
                                    </select>
                                    @error('id_program')
                                    <div class="invalid-feedback">
                                        Field Kode Program harus diisi!
                                    </div>
                                    @enderror


                                    

                                    <label for="id_portofolio" class="col-form-label">Portofolio: </label>
                                    <select class="id_portofolio form-control @error('id_portofolio') is-invalid @enderror mb-2" name="id_portofolio" value="{{ old('id_portofolio', $laporan->id_portofolio) }}">
                                        <option value="" selected>-- Pilih Portofolio --</option>
                                        @foreach ($addportofolio as $portofolio)
                                        <option value="{{ $portofolio->id }}" {{ old('id_portofolio', $laporan->id_portofolio) == $portofolio->id ? 'selected' : '' }}>{{ $portofolio->nama_portofolio }}</option>                                        
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
                                    <label for="id_sub_grup_akun" class="col-form-label">Sub Grup Akun: </label>
                                    <select class="id_sub_grup_akun form-control @error('id_sub_grup_akun') is-invalid @enderror mb-2" name="id_sub_grup_akun" value="{{ old('id_sub_grup_akun', $laporan->id_sub_grup_akun) }}">
                                        <option value="" selected>-- Pilih Sub Grup Akun --</option>
                                        @foreach ($addsubgrupakun as $subgrupakun)
                                        <option value="{{ $subgrupakun->id }}" {{ old('id_sub_grup_akun', $laporan->id_sub_grup_akun) == $subgrupakun->id ? 'selected' : '' }}>{{ $subgrupakun->nama_sub }}</option>                                        
                                        @endforeach
                                    </select>
                                    <span id="sub_grup_akun_error" style="display: none; color: red;">Field Sub Grup Akun harus diisi!</span>
                                    @error('id_sub_grup_akun')
                                    <div class="invalid-feedback">
                                        Field Sub Grup Akun harus diisi!
                                    </div>
                                    @enderror

                                    <label for="jenis_laporan" class="col-form-label">Jenis Laporan: </label>
                                    <select class="jenis_laporan form-control @error('jenis_laporan') is-invalid @enderror mb-2" name="jenis_laporan" value="{{ old('jenis_laporan', $laporan->jenis_laporan) }}">    
                                    <option value="COGS" {{ $laporan->jenis_laporan === 'COGS' ? 'selected' : '' }}>COGS</option>
                                        <option value="Revenue" {{ $laporan->jenis_laporan === 'Revenue' ? 'selected' : '' }}>Revenue</option>
                                        
                                    </select>
                                    <span id="jenis_laporan_error" style="display: none; color: red;">Field Jenis Laporan harus diisi!</span>
                                    @error('jenis_laporan')
                                    <div class="invalid-feedback">
                                        Field Jenis Laporan harus diisi!
                                    </div>
                                    @enderror

                                    <label for="nilai" class="col-form-label">Nilai: </label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                Rp.
                                            </div>
                                        </div>
                                        <input type="text" id="nilai" name="nilai" value="{{ old('nilai', $laporan->nilai) }}" class="form-control @error('nilai') is-invalid @enderror mb-2" oninput="formatCurrency(this)">
                                    </div>
                                    <span id="nilai_error" style="display: none; color: red;">Field Nilai harus diisi!</span>
                                    @error('nilai')
                                    <div class="invalid-feedback">
                                        Field Nilai harus diisi!
                                    </div>
                                    @enderror

                                    <label for="keterangan" class="col-form-label">Keterangan:</label>
                                    <input type="text" id="keterangan" name="keterangan" value="{{ old('keterangan', $laporan->keterangan) }}" class="form-control @error('keterangan') is-invalid @enderror mb-2">
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