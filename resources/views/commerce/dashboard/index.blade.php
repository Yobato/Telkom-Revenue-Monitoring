@extends('layouts.commerce-master')

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
                            <div class="col-12 float-end">
                                <a class="btn btn-outline-primary mr-3" href="{{ route('commerce.dashboard.export') }}">Export</a>
                                <a href="{{ route('commerce.reporting.form') }}" class="btn btn-primary mb-3 mt-3 shadow rounded">
                                    <i class="bi bi-file-earmark-plus" style="padding-right: 10px"></i>Buat Laporan
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table w-100" id="table-1">
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
                                    <th scope="col">Action</th>
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
                                    <td class="currency-field">{{ $admins ->nilai}}</td>
                                    <td>{{ $admins ->keterangan}}</td>
                                    <td>{{ \Carbon\Carbon::parse($admins->tanggal)->format('F Y') }}</td>
                                    <td>
                                        @if(Auth::user()->role == "Commerce" && $admins->editable == 1)
                                        <a href={{ route('commerce.editLaporanCommerce', [$admins->slug]) }} class="btn btn-success btn-sm rounded-0" type="button">
                                            <i class="fa fa-edit"></i></a>
                                        @endif
                                        <a class="btn btn-sm btn-danger rounded-0" style="color: white" data-toggle="modal" data-target="#deleteLaporanCommerceModal{{ $admins->slug }}"><i class="fa fa-trash"></i></a>
                                        <div class="modal fade" tabindex="-1" role="dialog" id="deleteLaporanCommerceModal{{ $admins->slug }}" data-backdrop="static">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Hapus Laporan Commerce</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="closeLaporanCommerce1">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    @csrf
                                                    <div class="modal-body">
                                                        Pilih "Delete" dibawah ini jika Anda yakin menghapus Laporan Commerce yang dipilih.
                                                    </div>
                                                    <div class="modal-footer bg-whitesmoke br">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal" id="closeLaporanCommerce2">Cancel</button>
                                                        <a class="btn btn-danger" href="{{ route('commerce.deleteLaporanCommerce', [$admins->slug]) }}" value="Delete">Delete</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
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

{{-- <script>
    

</script> --}}
@endsection

@push('scripts')
<!-- JS Libraies -->
<script src="{{ asset('library/jquery-ui-dist/jquery-ui.min.js') }}"></script>

<!-- Page Specific JS File -->
<script src="{{ asset('js/page/components-table.js') }}"></script>


@endpush