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
                        <div class="breadcrumb-item"><a href="{{ route('nota.dashboard.index') }}">KKP Operasional</a></div>
                        <div class="breadcrumb-item active">Buat Nota </div>
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
                    <div class="px-5 pt-4" style="font-size: 140%"><b>Buat Nota</b></div>
                    <div class="px-5 pt-2 pb-0">Sesuaikan data yang dibutuhkan dalam membuat laporan</div>
                    <form action="{{route('nota.storeLaporanNota')}}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group pt-4 pb-0 pl-5 mb-0 pb-0">
                                    {{-- <label for="pid_finance" class="col-form-label">PID Finance: </label>
                                    <input type="text" id="pid_finance" name="pid_finance" class="form-control @error('pid_finance') is-invalid @enderror mb-2" value="{{ old('pid_finance') }}">
                                    @error('pid_finance')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror --}}

                                    <label for="pid_nota" class="col-form-label">PID Nota: </label>
                                    <select class="pid_nota form-control @error('pid_nota') is-invalid @enderror mb-2" name="pid_nota" value="{{ old('pid_nota') }}">
                                        <option value="" selected>-- Pilih PID Nota --</option>
                                        @foreach ($addfinance as $finance)
                                        <option value={{ $finance->pid_finance }} @selected(old('pid_nota')==$finance->pid_finance)>{{ $finance->pid_finance }}</option>
                                        @endforeach
                                    </select>
                                    @error('pid_nota')
                                    <div class="invalid-feedback">
                                        Field PID Finance harus diisi!
                                    </div>
                                    @enderror
                                    
                                    <label for="id_user" class="col-form-label">User: </label>
                                    <select class="id_user form-control @error('id_user') is-invalid @enderror mb-2" name="id_user" value="{{ old('id_user') }}">
                                        <option value="" selected>-- Pilih User --</option>
                                        @foreach ($adduser as $user)
                                        <option value={{ $user->id }} @selected(old('id_user')==$user->id)>{{ $user->nama_user_reco }}</option>
                                        @endforeach
                                    </select>
                                    <span id="user_error" style="display: none; color: red;">Field User harus diisi!</span>
                                    @error('id_user')
                                    <div class="invalid-feedback">
                                        Field User harus diisi!
                                    </div>
                                    @enderror

                                    <label for="id_peruntukan" class="col-form-label">Peruntukan: </label>
                                    <select class="id_peruntukan form-control @error('id_peruntukan') is-invalid @enderror mb-2" name="id_peruntukan" value="{{ old('id_peruntukan') }}">
                                        <option value="" selected>-- Pilih Peruntukan --</option>
                                        @foreach ($addperuntukan as $peruntukan)
                                        <option value={{ $peruntukan->id }} @selected(old('id_peruntukan')==$peruntukan->id)>{{ $peruntukan->nama_peruntukan}}</option>
                                        @endforeach
                                    </select>
                                    <span id="id_peruntukan_error" style="display: none; color: red;">Field Peruntukan harus diisi!</span>
                                    @error('id_peruntukan')
                                    <div class="invalid-feedback">
                                        Field Peruntukan harus diisi!
                                    </div>
                                    @enderror

                                    <label for="monthYearPicker" class="col-form-label">Bulan dan Tahun:</label>
                                    <input type="month" id="monthYearPicker" onchange="handleDateChange(this)" name="tanggal" value="{{ old('tanggal') }}" class="form-control @error('tanggal') is-invalid @enderror mb-2">
                                    @error('tanggal')
                                    <div class="invalid-feedback">
                                        Field Bulan dan Tahun harus diisi!
                                    </div>
                                    @enderror

                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group pt-4 pb-0 pr-5 mb-0">
                                    
                                    <label for="nilai" class="col-form-label">Nilai Awal: </label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                Rp.
                                            </div>
                                        </div>
                                        <input type="text" id="nilai_awal" name="nilai_awal" value="{{ old('nilai_awal') }}" class="form-control @error('nilai_awal') is-invalid @enderror mb-2" oninput="formatCurrency(this)">
                                    </div>
                                    {{-- <span id="nilai_awal_error" style="display: none; color: red;">Field Nilai harus diisi!</span> --}}
                                    @error('nilai_awal')
                                    <div class="invalid-feedback">
                                        Field Nilai harus diisi!
                                    </div>
                                    @enderror

                                    <label for="pph" class="col-form-label">PPH: </label>
                                    <select class="pph form-control @error('pph') is-invalid @enderror mb-2" name="pph">
                                        <option value="" selected>-- Apakah Ada PPH --</option>
                                        <option value="Ya" @if(old('pph')=='Ya' ) selected @endif>Ya</option>
                                        <option value="Tidak" @if(old('pph')=='Tidak' ) selected @endif>Tidak</option>
                                    </select>
                                    {{-- <span id="pph_error" style="display: none; color: red;">Field PPH harus dipilih!</span> --}}
                                    @error('pph')
                                    <div class="invalid-feedback">
                                        Field PPH harus dipilih!
                                    </div>
                                    @enderror

                                    <label for="persentase" class="col-form-label">Persentase: </label>
                                    <div class="input-group">
                                        <input type="text" id="persentase" name="persentase" value="{{ old('persentase') }}" class="form-control @error('persentase') is-invalid @enderror mb-2" oninput="formatCurrency(this)">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                %
                                            </div>
                                        </div>
                                    </div>
                                    {{-- <span id="persentase_error" style="display: none; color: red;">Field Nilai harus diisi!</span> --}}
                                    @error('persentase')
                                    <div class="invalid-feedback">
                                        Field Nilai harus diisi!
                                    </div>
                                    @enderror

                                    <label for="nilai_akhir" class="col-form-label">Nilai Akhir: </label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                Rp.
                                            </div>
                                        </div>
                                        <input type="text" id="nilai_akhir" name="nilai_akhir" value="{{ old('nilai_akhir') }}" class="form-control @error('nilai_akhir') is-invalid @enderror mb-2" oninput="formatCurrency(this)">
                                    </div>
                                    {{-- <span id="nilai_akhir_error" style="display: none; color: red;">Field Nilai harus diisi!</span> --}}
                                    @error('nilai_akhir')
                                    <div class="invalid-feedback">
                                        Field Nilai harus diisi!
                                    </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row mb-lg-5">
                            <div class="col-lg-12" style="padding: 0 62px">
                                <label for="keterangan" class="col-form-label">Keterangan:</label>
                                    <input type="text" id="keterangan" name="keterangan" value="{{ old('keterangan') }}" class="form-control @error('keterangan') is-invalid @enderror mb-2">
                                    @error('keterangan')
                                    <div class="invalid-feedback">
                                        Keterangan wajib diisi!
                                    </div>
                                    @enderror
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
        function handleDateChange(input) {
            const selectedDate = new Date(input.value);
            const selectedMonth = selectedDate.getMonth() + 1; // Adding 1 because months are zero-based
            const selectedYear = selectedDate.getFullYear();
        }
</script>