@extends('layouts.finance-master')

@section('title', 'Reporting')

@push('style')
<!-- CSS Libraries -->
@endpush

@section('content')

<section class="section">
    <div class="section-header">
        <h1>Pelaporan</h1>
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
                        <h4>PID Finance</h4>
                        <div class="card-header-form">
                            <div class="col-12 float-end">
                                <a class="btn btn-outline-primary mr-3"
                                    href="{{ route('finance.dashboard.export') }}">Export</a>
                                <a href="{{ route('finance.reporting.form') }}"
                                    class="btn btn-primary mb-3 mt-3 shadow rounded">
                                    <i class="bi bi-file-earmark-plus" style="padding-right: 10px"></i>Buat PID Finance
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table" id="table-1">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">PID Finance</th>
                                    <th scope="col">Portofolio</th>
                                    <th scope="col">Nama Program</th>
                                    <th scope="col">Cost Plan</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1 ?>
                                @foreach ($laporan_finance as $admins)
                                <tr>
                                    <th scope="row">{{$i++}}</th>
                                    <td>{{ $admins->pid_finance}}</td>
                                    <td>{{ $portofolio_id[$admins->id_portofolio]}}</td>
                                    <td>{{ $program_id[$admins->id_program]}}</td>
                                    <td>{{ $cost_plan_id[$admins->id_cost_plan]}}</td>
                                    <td>
                                        @if(Auth::user()->role == "Finance" && $admins->editable == 1)
                                        <a href={{ route('finance.editLaporanFinance', [$admins->slug]) }} class="btn
                                            btn-success btn-sm rounded-0" type="button">
                                            <i class="fa fa-edit"></i></a>
                                        @endif

                                        {{-- DELETE --}}
                                        <a class="btn btn-sm btn-danger rounded-0" style="color: white"
                                            data-toggle="modal"
                                            data-target="#deleteLaporanFinanceModal{{ $admins->slug }}"><i
                                                class="fa fa-trash"></i></a>
                                        <div class="modal fade" tabindex="-1" role="dialog"
                                            id="deleteLaporanFinanceModal{{ $admins->slug }}" data-backdrop="static">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Hapus PID Finance</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close" id="closeLaporanFinance1">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    @csrf
                                                    <div class="modal-body">
                                                        Pilih "Delete" dibawah ini jika Anda yakin menghapus PID Finance
                                                        yang dipilih.
                                                    </div>
                                                    <div class="modal-footer bg-whitesmoke br">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal"
                                                            id="closeLaporanFinance2">Batal</button>
                                                        <a class="btn btn-danger"
                                                            href="{{ route('finance.deleteLaporanFinance', [$admins->slug]) }}"
                                                            value="Delete">Hapus</a>
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