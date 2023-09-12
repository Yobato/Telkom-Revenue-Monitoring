@extends('layouts.admin-master')

@section('title', 'User Management')

@push('style')
    <!-- CSS Libraries -->
@endpush

@section('content')

<section class="section">
    <div class="section-header">
        <h1>User</h1>
    </div>

    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Kelola General Manager</h4>
                        <div class="card-header-form">
                            <div class="col-12 float-end">
                                <a href="{{ route('create-user') }}" class="btn btn-primary mb-3 mt-3 shadow rounded">
                                    <i class="bi bi-file-earmark-plus" style="padding-right: 10px"></i>Tambah User
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
                                    <th>NIK</th>
                                    <th>Nama</th>
                                    <th>Jabatan</th>
                                    <th>Penempatan</th>
                                    <th>Keterangan</th>
                                    <th>Action</th>
                                </tr>
                                <tr>
                                    <td>278012018</td>
                                    <td>Emmanuel Bagas Agustha</td>
                                    <td>Telkom Akses</td>
                                    <td>Semarang</td>
                                    <td>2017-01-09</td>
                                    <td>
                                        <button a href="#" class="btn btn-success btn-sm rounded-0" type="button">
                                            <i class="fa fa-edit"></i></button> 
                                        <button class="btn btn-danger btn-sm rounded-0" type="button" data-confirm="Hapus Data?" >
                                            <i class="fa fa-trash"></i></button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>278012018</td>
                                    <td>Emmanuel Bagas Agustha</td>
                                    <td>Telkom Akses</td>
                                    <td>Semarang</td>
                                    <td>2017-01-09</td>
                                    <td>
                                        <button a href="#" class="btn btn-success btn-sm rounded-0" type="button">
                                            <i class="fa fa-edit"></i></button> 
                                        <button class="btn btn-danger btn-sm rounded-0" type="button" data-confirm="Hapus Data?" >
                                            <i class="fa fa-trash"></i></button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>278012018</td>
                                    <td>Emmanuel Bagas Agustha</td>
                                    <td>Telkom Akses</td>
                                    <td>Semarang</td>
                                    <td>2017-01-09</td>
                                    <td>
                                        <button a href="#" class="btn btn-success btn-sm rounded-0" type="button">
                                            <i class="fa fa-edit"></i></button> 
                                        <button class="btn btn-danger btn-sm rounded-0" type="button" data-confirm="Hapus Data?" >
                                            <i class="fa fa-trash"></i></button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>278012018</td>
                                    <td>Emmanuel Bagas Agustha</td>
                                    <td>Telkom Akses</td>
                                    <td>Semarang</td>
                                    <td>2017-01-09</td>
                                    <td>
                                        <button a href="#" class="btn btn-success btn-sm rounded-0" type="button">
                                            <i class="fa fa-edit"></i></button> 
                                        <button class="btn btn-danger btn-sm rounded-0" type="button" data-confirm="Hapus Data?" >
                                            <i class="fa fa-trash"></i></button>
                                    </td>
                                </tr>
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
