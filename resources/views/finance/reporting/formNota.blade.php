@extends('layouts.finance-master')

@section('title', 'Reporting')

@section('content')
<section class="section">
    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    {{-- ADD LAPORAN --}}
                    <div class="card-body d-flex justify-content-start" style="padding-bottom:0; margin-bottom:0;">
                        <div class="breadcrumb-item"><a href="{{ route('nota.dashboard.index') }}">KKP Operasional</a>
                        </div>
                        <div class="breadcrumb-item active">Buat Nota </div>
                    </div>
                    <div class="card-header" style="padding-bottom:0;">
                        <div class="col-12">
                            <h3>Reporting</h3>
                        </div>
                    </div>

                    <p style="padding-left: 43px; padding-bottom:10px">Buat Laporan sesuai dengan ketentuan dan SOP yang
                        berlaku di Telkom Akses. Anda dapat mengubah laporan ini nanti.</p>
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
                                    <input type="text" id="pid_finance" name="pid_finance"
                                        class="form-control @error('pid_finance') is-invalid @enderror mb-2"
                                        value="{{ old('pid_finance') }}">
                                    @error('pid_finance')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror --}}

                                    <label for="pid_nota" class="col-form-label">PID Nota: </label>
                                    <select class="pid_nota form-control @error('pid_nota') is-invalid @enderror mb-2"
                                        name="pid_nota" value="{{ old('pid_nota') }}">
                                        <option value="" selected>-- Pilih PID Nota --</option>
                                        @foreach ($addfinance as $finance)
                                        <option value={{ $finance->pid_finance }}
                                            @selected(old('pid_nota')==$finance->pid_finance)>{{ $finance->pid_finance
                                            }}</option>
                                        @endforeach
                                    </select>
                                    @error('pid_nota')
                                    <div class="invalid-feedback">
                                        Field PID Finance harus diisi!
                                    </div>
                                    @enderror

                                    <label for="id_user" class="col-form-label">User: </label>
                                    <select class="id_user form-control @error('id_user') is-invalid @enderror mb-2"
                                        name="id_user" value="{{ old('id_user') }}">
                                        <option value="" selected>-- Pilih User --</option>
                                        @foreach ($adduser as $user)
                                        <option value={{ $user->id }} @selected(old('id_user')==$user->id)>{{
                                            $user->nama_user_reco }}</option>
                                        @endforeach
                                    </select>
                                    <span id="user_error" style="display: none; color: red;">Field User harus
                                        diisi!</span>
                                    @error('id_user')
                                    <div class="invalid-feedback">
                                        Field User harus diisi!
                                    </div>
                                    @enderror

                                    <label for="id_peruntukan" class="col-form-label">Peruntukan: </label>
                                    <select
                                        class="id_peruntukan form-control @error('id_peruntukan') is-invalid @enderror mb-2"
                                        name="id_peruntukan" value="{{ old('id_peruntukan') }}">
                                        <option value="" selected>-- Pilih Peruntukan --</option>
                                        @foreach ($addperuntukan as $peruntukan)
                                        <option value={{ $peruntukan->id }}
                                            @selected(old('id_peruntukan')==$peruntukan->id)>{{
                                            $peruntukan->nama_peruntukan}}</option>
                                        @endforeach
                                    </select>
                                    <span id="id_peruntukan_error" style="display: none; color: red;">Field Peruntukan
                                        harus diisi!</span>
                                    @error('id_peruntukan')
                                    <div class="invalid-feedback">
                                        Field Peruntukan harus diisi!
                                    </div>
                                    @enderror

                                    <label for="monthYearPicker" class="col-form-label">Bulan dan Tahun:</label>
                                    <input type="month" id="monthYearPicker" onchange="handleDateChange(this)"
                                        name="tanggal" value="{{ old('tanggal') }}"
                                        class="form-control @error('tanggal') is-invalid @enderror mb-2">
                                    @error('tanggal')
                                    <div class="invalid-feedback">
                                        Field Bulan dan Tahun harus diisi!
                                    </div>
                                    @enderror

                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group pt-4 pb-0 pr-5 mb-0">

                                    <label for="nilai_awal" class="col-form-label">Nilai Awal: </label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                Rp.
                                            </div>
                                        </div>
                                        <input type="text" id="nilai_awal" name="nilai_awal"
                                            value="{{ old('nilai_awal') }}"
                                            class="form-control nilai_awal @error('nilai_awal') is-invalid @enderror mb-2"
                                            onchange="formatCurrency(this)">
                                    </div>
                                    {{-- <span id="nilai_awal_error" style="display: none; color: red;">Field Nilai
                                        harus diisi!</span> --}}
                                    @error('nilai_awal')
                                    <div class="invalid-feedback">
                                        Field Nilai harus diisi!
                                    </div>
                                    @enderror

                                    <label for="pph" class="col-form-label">PPH: </label>
                                    <select id="pph" class="pph form-control @error('pph') is-invalid @enderror mb-2"
                                        name="pph">
                                        <option value="" selected>-- Apakah Ada PPH --</option>
                                        <option value="Ya" @if(old('pph')=='Ya' ) selected @endif>Ya</option>
                                        <option value="Tidak" @if(old('pph')=='Tidak' ) selected @endif>Tidak</option>
                                    </select>
                                    {{-- <span id="pph_error" style="display: none; color: red;">Field PPH harus
                                        dipilih!</span> --}}
                                    @error('pph')
                                    <div class="invalid-feedback">
                                        Field PPH harus dipilih!
                                    </div>
                                    @enderror

                                    <label for="persentase" class="col-form-label">Persentase: </label>
                                    <div class="input-group">
                                        {{-- <input type="text" id="persentase" name="persentase"
                                            value="{{ old('persentase') }}"
                                            class="form-control @error('persentase') is-invalid @enderror mb-2"
                                            placeholder="Gunakan titik"
                                            disabled> --}}
                                            <select class="persentase form-control @error('persentase') is-invalid @enderror mb-2" name="persentase"
                                                value="{{ old('persentase') }}" id="persentase" disabled>
                                                <option value="" selected>-- Pilih Persentase --</option>
                                                @foreach ($addpersentase as $pph)
                                                <option value={{ $pph->id }} data-persentase={{ $pph->nilai_pph }}
                                                    @selected(old('persentase')==$pph->id)
                                                    >{{$pph->nama_pph}}</option>
                                                @endforeach
                                            </select>
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                %
                                            </div>
                                        </div>
                                    </div>
                                    {{-- <span id="persentase_error" style="display: none; color: red;">Field Nilai
                                        harus diisi!</span> --}}
                                    @error('persentase')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror

                                    <label for="nilai_akhir" class="col-form-label">Nilai Akhir: </label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                Rp.
                                            </div>
                                        </div>
                                        <input type="text" id="nilai_akhir" name="nilai_akhir"
                                            value="{{ old('nilai_akhir') }}"
                                            class="form-control @error('nilai_akhir') is-invalid @enderror mb-2"
                                            onchange="formatCurrency(this)">
                                    </div>
                                    {{-- <span id="nilai_akhir_error" style="display: none; color: red;">Field Nilai
                                        harus diisi!</span> --}}
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
                                <input type="text" id="keterangan" name="keterangan" value="{{ old('keterangan') }}"
                                    class="form-control @error('keterangan') is-invalid @enderror mb-2"
                                    placeholder="dd/mm/yyyy - keterangan">
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
{{--
<script>

</script> --}}
<script>
    function handleDateChange(input) {
            const selectedDate = new Date(input.value);
            const selectedMonth = selectedDate.getMonth() + 1; // Adding 1 because months are zero-based
            const selectedYear = selectedDate.getFullYear();
        }
</script>
<script>
    function formatCurrency(input) {
        let formattedValue;
        
        if (!input) return;
        
        if (!input.value) return;
        
        const inputValue = Number(input.value);
        
        // Mengubah angka menjadi format uang dengan pemisah ribuan (.)
        let formattedCurrency = inputValue.toLocaleString('id-ID', { style: 'currency', currency: 'IDR' });
        
        // Menghilangkan simbol "Rp" dan spasi kosong di awal nilai
        let currencyWithoutSymbolAndSpace = formattedCurrency.replace('Rp', '').trim();
        
        // Menampilkan hasil format uang di input
        input.value = currencyWithoutSymbolAndSpace;
    }

    function totalPajak() {
        // Mendapatkan nilai awal, persentase, dan nilai akhir
        let nilaiAwalInput = document.getElementById('nilai_awal');
        let persentaseInput = document.getElementById('persentase');
        let nilaiAkhirInput = document.getElementById('nilai_akhir');
        
        console.log("Elemen nilai_awal:", nilaiAwalInput.value);
        console.log("Elemen persentase:", persentaseInput.options[persentaseInput.selectedIndex].dataset.persentase);
        console.log("Elemen nilai_akhir:", nilaiAkhirInput.value);

        let nilaiPph = persentaseInput.options[persentaseInput.selectedIndex].dataset.persentase;
        
        if (nilaiAwalInput && persentaseInput && nilaiAkhirInput) {
            let nilaiAwal = nilaiAwalInput.value // Menghilangkan karakter selain angka
            let persentase = parseFloat(nilaiPph?.replace(/[^\d.]/g, '')); // Menghilangkan karakter selain angka dan titik
            
            formatNilaiAwal = nilaiAwal.replace(/\./g, ''); // remove dot
            formatNilaiAwal = formatNilaiAwal.replace(',', '.'); // replace comma with dot
            const resultNilaiAwal = parseFloat(formatNilaiAwal);
            console.log(nilaiAwal, "haha")
            
            // Memastikan nilai awal dan persentase adalah angka yang valid
            if (!isNaN(resultNilaiAwal) && !isNaN(persentase)) {
            // Menghitung hasil pajak
            
            let hasilPajak = (resultNilaiAwal * persentase) / 100;
            
            console.log(resultNilaiAwal, "Awall")
            // Menghitung nilai akhir
            let nilaiAkhir = Math.floor(resultNilaiAwal + hasilPajak);
            
            console.log(hasilPajak, "hasilPajak");
            console.log(nilaiAkhir, "hasilakhir");
            
            
            nilaiAkhirInput.value = nilaiAkhir
            
            formatCurrency(nilaiAkhirInput)
            
            } else if(nilaiAwalInput&&nilaiAkhirInput){
            nilaiAkhirInput.value = nilaiAwalInput.value;
            } else{
            // Jika nilai awal atau persentase tidak valid, reset nilai akhir
            nilaiAkhirInput.value = '';
            }
        }
    }

    document.addEventListener('DOMContentLoaded', function () {
        // Mendapatkan elemen dropdown PPH dan field persentase
        var pphDropdown = document.getElementById('pph');
        var persentaseInput = document.getElementById('persentase');
        let nilaiAwalInput = document.getElementById('nilai_awal');
        let nilaiAkhirInput = document.getElementById('nilai_akhir');

        // Menambahkan event listener untuk mengikuti perubahan pada dropdown PPH
        pphDropdown.addEventListener('change', function () {
            if (pphDropdown.value === 'Ya') {
                // Jika dipilih "Ya", aktifkan field persentase dan tambahkan event listener
                persentaseInput.removeAttribute('disabled');
                nilaiAwalInput.addEventListener('change', totalPajak);
                persentaseInput.addEventListener('input', totalPajak);
            } else {
                // Jika dipilih "Tidak" atau opsi kosong, nonaktifkan field persentase dan hapus event listener
                persentaseInput.setAttribute('disabled', 'disabled');
                persentaseInput.removeEventListener('input', totalPajak);
                persentaseInput.value = ''; // Menghapus nilai input persentase
                nilaiAkhirInput.value =  nilaiAwalInput.value;
                nilaiAwalInput.addEventListener('change', totalPajak);
            }
        });
    });
</script>