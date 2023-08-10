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
                        <h4>Laporan KKP</h4>
                        <div class="card-header-form">
                            <div class="col-12 float-end">
                                <a href="{{ route('finance.reporting.form') }}" class="btn btn-primary mb-3 mt-3 shadow rounded">
                                    <i class="bi bi-file-earmark-plus" style="padding-right: 10px"></i>Buat Laporan
                                </a>
                            </div>
                        </div>
                        <div class="card-header-form">
                            <form>
                                <div class="input-group">
                                    <input type="text"
                                        class="form-control"
                                        placeholder="Search">
                                    <div class="input-group-btn">
                                        <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table-striped table">
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">PID Finance</th>
                                    <th scope="col">Portofolio</th>
                                    <th scope="col">Nama Program</th>
                                    <th scope="col">Cost Plan</th>
                                    <th scope="col">Peruntukan</th>
                                    <th scope="col">User</th>
                                    <th scope="col">Nilai</th>
                                    <th scope="col">Keterangan</th>
                                    <th scope="col">Action</th>
                                </tr>
                                <?php $i = 1 ?>
                                @foreach ($laporan_finance as $admins)
                                <tr>
                                    <th scope="row">{{$i++}}</th>
                                    <td>{{ $admins->pid_finance}}</td>
                                    <td>{{ $portofolio_id[$admins->id_portofolio]}}</td>
                                    <td>{{ $program_id[$admins->id_program]}}</td>
                                    <td>{{ $cost_plan_id[$admins->id_cost_plan]}}</td>
                                    <td>{{ $peruntukan_id[$admins->id_peruntukan]}}</td>
                                    <td>{{ $user_id[$admins->id_user]}}</td>
                                    <td>{{ $admins->nilai}}</td>
                                    <td>{{ $admins->keterangan }}</td>
                                    <td>
                                        <button a href="#" class="btn btn-success btn-sm rounded-0" type="button">
                                        <i class="fa fa-edit"></i></button> 
                                        {{-- <button class="btn btn-danger btn-sm rounded-0" type="button" data-confirm="Hapus Data?" >
                                        <i class="fa fa-trash"></i></button> --}}
                                        <a class="btn btn-sm btn-danger rounded-0" style="color: white" data-toggle="modal" data-target="#deleteLaporanFinanceModal{{ $admins->pid_finance }}"><i class="fa fa-trash"></i></a>

                                        <div class="modal fade" tabindex="-1" role="dialog" id="deleteLaporanFinanceModal{{ $admins->pid_finance }}" data-backdrop="static">
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
                                                        <a class="btn btn-danger" href="{{ route('finance.deleteLaporanFinance', [$admins->pid_finance]) }}" value="Delete">Delete</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </table>
                        </div>
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
