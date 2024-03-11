@extends('layouts.manager-master')

@section('title')
Dashboard
@endsection

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Dropdown</h1>
    </div>

    <div class="section-body">
        <section class="section">
            <div class="section-header">
                <h1>Target</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item"><a href="#">Dropdown</a></div>
                    <div class="breadcrumb-item active">Target</div>
                </div>
            </div>

            <div class="section-body">
                <h2 class="section-title">Tabel Target</h2>
                <p class="section-lead">
                    Manage Target Commerce. The Commerce Target here will affect the monthly achievements of the COGS, Revenue and GPM
                    Dashboard
                </p>

                @if(session()->has('success'))
                <div class="alert alert-success alert-dismissible fade show">
                    {{ session('success') }}
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                </div>
                @endif

                @if(session()->has('error'))
                <div class="alert alert-danger alert-dismissible fade show">
                    {{ session('error') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @endif

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <!-- ADD Target -->
                            <div class="card-header">
                                <div class="col-12">
                                    <h4>Target</h4>
                                </div>
                            </div>

                            <div class="card-body">
                                <table class="table" id="table-1">
                                    <thead>
                                        <tr>
                                            <th scope="col">No</th>
                                            <th scope="col">Report Type</th>
                                            <th scope="col">Portofolio</th>
                                            <th scope="col">Amount</th>
                                            <th scope="col">Month</th>
                                            <th scope="col">Year</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1 ?>
                                        @foreach ($target as $admins)
                                        <tr>
                                            <th scope="row">{{$i++}}</th>
                                            <td>{{ $admins ->jenis_laporan}}</td>
                                            <td>{{ $portofolio_id[$admins ->id_portofolio]}}</td>
                                            <td>{{ $admins ->jumlah}}</td>
                                            <td>{{ $admins ->bulan}}</td>
                                            <td>{{ $admins ->tahun}}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</section>
<style>
    .is-invalid {
        border-color: red;
        /* Atau atur properti lainnya untuk mengubah tampilan field input menjadi merah */
    }
</style>
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
@endsection