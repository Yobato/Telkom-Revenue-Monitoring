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
                                        <th scope="col">Action</th>
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
<script>
    $(document).ready(function() {
        $('#table-1').dataTable({
            responsive: true
        });
    });
</script>
@endpush