@extends('layouts.admin-master')

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
                                <a class="btn btn-outline-primary mr-3"
                                    href="{{ route('admin.nota.dashboard.export') }}">Export</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table" id="table-4">
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
                                    <td>{{ $admins->persentase}}</td>
                                    {{-- <td>{{ $admins->nilai_awal}}</td> --}}
                                    <td>{{ \Carbon\Carbon::parse($admins->tanggal)->format('F Y') }}</td>
                                    <td class="currency-field">{{ $admins->nilai_akhir}}</td>
                                    <td>{{ $admins->keterangan}}</td>

                                    <td>
                                        @if($admins->editable == 0)
                                        <a href={{ route('admin.editableNota', [$admins->id]) }} class="btn btn-primary
                                            btn-sm rounded-0" type="button">
                                            <i class="fa fa-edit"></i> Open Edit</a>
                                        @endif
                                        @if($admins->editable == 1)
                                        <a href={{ route('admin.uneditableNota', [$admins->id]) }} class="btn btn-danger
                                            btn-sm rounded-0" type="button">
                                            <i class="fa fa-edit"></i> Close Edit</a>
                                        @endif
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