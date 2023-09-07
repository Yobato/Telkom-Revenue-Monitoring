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
                        <h4>Laporan KKP</h4>
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
                                    <th scope="col">Tanggal</th>
                                    <th scope="col">Keterangan</th>
                                    <th scope="col">Updated at</th>
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
                                    <td>{{ \Carbon\Carbon::parse($admins->tanggal)->format('F Y') }}</td>
                                    <td>{{ $admins->keterangan }}</td>
                                    <td>{{ $admins ->updated_at}}</td>
                                    <td>
                                        @if($admins->editable == 0)
                                            <a href={{ route('admin.editableFinance', [$admins->pid_finance]) }} class="btn btn-primary btn-sm rounded-0" type="button">
                                            <i class="fa fa-edit"></i> Open Edit</a>
                                        @endif
                                        @if($admins->editable == 1)
                                            <a href={{ route('admin.uneditableFinance', [$admins->pid_finance]) }} class="btn btn-danger btn-sm rounded-0" type="button">
                                            <i class="fa fa-edit"></i> Close Edit</a>
                                        @endif

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
