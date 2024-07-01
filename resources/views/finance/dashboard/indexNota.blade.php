@extends('layouts.finance-master')

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
                        <h4>Laporan Nota</h4>
                        <div class="card-header-form">
                            <div class="col-12 float-end">
                                <a class="btn btn-outline-primary mr-3" href="{{ route('nota.dashboard.export') }}">Export</a>
                                <a href="{{ route('nota.reporting.form') }}" class="btn btn-primary mb-3 mt-3 shadow rounded">
                                    <i class="bi bi-file-earmark-plus" style="padding-right: 10px"></i>Buat Laporan
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table w-100" id="table-2">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">PID Nota</th>
                                    <th scope="col">Peruntukan</th>
                                    <th scope="col">User</th>
                                    <th scope="col">PPH</th>
                                    <th scope="col">Persentase</th>
                                    {{-- <th scope="col">Nilai Awal</th> --}}
                                    <th scope="col">Tanggal</th>
                                    <th scope="col">Nilai Akhir</th>
                                    <th scope="col">Keterangan</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1 ?>
                                @foreach ($laporan_nota as $admins)
                                <tr>
                                    <th scope="row">{{$i++}}</th>
                                    <td>{{ $admins->pid_nota}}</td>
                                    <td>{{ $peruntukan_id[$admins->id_peruntukan]}}</td>
                                    <td>{{ $user_id[$admins->id_user]}}</td>
                                    <td>{{ $admins->pph}}</td>
                                    <td>{{ $pph_id[$admins->id_pph]}}</td>
                                    {{-- <td>{{ $admins->nilai_awal}}</td> --}}
                                    <td>{{ \Carbon\Carbon::parse($admins->tanggal)->format('F Y') }}</td>
                                    <td class="currency-field">{{ $admins->nilai_akhir}}</td>
                                    <td>{{ $admins->keterangan}}</td>
                                    
                                    <td>
                                        @if(Auth::user()->role == "Finance" && $admins->editable == 1)
                                        <a href={{ route('nota.editLaporanNota', [$admins->id]) }} class="btn btn-success btn-sm rounded-0" type="button">
                                            <i class="fa fa-edit"></i></a>
                                        @endif
                                        
                                        {{-- DELETE  --}}
                                        <a class="btn btn-sm btn-danger rounded-0" style="color: white" 
                                        data-toggle="modal" data-target="#deleteLaporanFinanceModal{{ $admins->id }}"><i class="fa fa-trash"></i></a>
                                        <div class="modal fade" tabindex="-1" role="dialog" 
                                        id="deleteLaporanFinanceModal{{ $admins->id }}" data-backdrop="static">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Hapus Laporan Finance</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="closeLaporanFinance1">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    @csrf
                                                    <div class="modal-body">
                                                        Pilih "Delete" dibawah ini jika Anda yakin menghapus Laporan Finance yang dipilih.
                                                    </div>
                                                    <div class="modal-footer bg-whitesmoke br">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal" id="closeLaporanFinance2">Cancel</button>
                                                        <a class="btn btn-danger" href="{{ route('nota.deleteLaporanNota', [$admins->id]) }}" value="Delete">Delete</a>
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

@endsection

@push('scripts')
<!-- JS Libraies -->
<script src="{{ asset('library/jquery-ui-dist/jquery-ui.min.js') }}"></script>

<!-- Page Specific JS File -->
<script src="{{ asset('js/page/components-table.js') }}"></script>

@endpush