@extends('layouts.manager-master')

@section('title', 'Reporting')

@push('style')
<!-- CSS Libraries -->
@endpush

@section('content')

<section class="section">
    <div class="section-header">
        <h1>Reporting</h1>
    </div>

    <div class="section-body">

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
                    <div class="card-header">
                        <h4>Laporan COGS dan Revenue</h4>
                        <div class="card-header-form">
                            <form>
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Search">
                                    <div class="input-group-btn">
                                        <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table" id="table-1">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">ID Commerce</th>
                                    <th scope="col">Nama Program</th>
                                    <th scope="col">Kode Program</th>
                                    <th scope="col">Jenis</th>
                                    <th scope="col">Portofolio</th>
                                    <th scope="col">Sub Grup Akun</th>
                                    <th scope="col">Nilai</th>
                                    <th scope="col">Keterangan</th>
                                    <th scope="col">Tanggal</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1 ?>
                                @foreach ($laporan_commerce as $admins)
                                <tr>
                                    <th scope="row">{{$i++}}</th>
                                    <td>{{ $admins ->id_commerce}}</td>
                                    <td>{{ $program_id[$admins ->id_program]}}</td>
                                    <td>{{ $kode_program_id[$admins->id_program]}}</td>
                                    <td>{{ $admins ->jenis_laporan}}</td>
                                    <td>{{ $portofolio_id[$admins ->id_portofolio]}}</td>
                                    <td>{{ $sub_grup_akun_id[$admins ->id_sub_grup_akun]}}</td>
                                    <td>{{ $admins ->nilai}}</td>
                                    <td>{{ $admins ->keterangan}}</td>
                                    <td>{{ \Carbon\Carbon::parse($admins->tanggal)->format('F Y') }}</td>
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

@endsection

@push('scripts')
<!-- JS Libraies -->
<script src="{{ asset('library/jquery-ui-dist/jquery-ui.min.js') }}"></script>

<!-- Page Specific JS File -->
<script src="{{ asset('js/page/components-table.js') }}"></script>
@endpush