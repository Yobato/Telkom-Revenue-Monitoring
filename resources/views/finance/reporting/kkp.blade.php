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
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Laporan KKP</h4>
                        <div class="card-header-form">
                            <div class="col-12 float-end">
                                <a href="{{ route('finance-form') }}" class="btn btn-primary mb-3 mt-3 shadow rounded">
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
                            <table class="table">
                                <tr>
                                    <th>PID Finance</th>
                                    <th>Portofolio</th>
                                    <th>Nama Program</th>
                                    <th>Cost Plan</th>
                                    <th>Pemakaian</th>
                                    <th>User</th>
                                    <th>Nilai</th>
                                    <th>Keterangan</th>
                                    <th>Action</th>
                                </tr>
                                <tr>
                                    <td>278012018</td>
                                    <td>lorem ipsum</td>
                                    <td>Program A</td>
                                    <td>AIK1234</td>
                                    <td>AIK1234</td>
                                    <td>lorem ipsum</td>
                                    <td>Rp. 1.000.000,00</td>
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
                                    <td>lorem ipsum</td>
                                    <td>Program A</td>
                                    <td>AIK1234</td>
                                    <td>AIK1234</td>
                                    <td>lorem ipsum</td>
                                    <td>Rp. 1.000.000,00</td>
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
                                    <td>lorem ipsum</td>
                                    <td>Program A</td>
                                    <td>AIK1234</td>
                                    <td>AIK1234</td>
                                    <td>lorem ipsum</td>
                                    <td>Rp. 1.000.000,00</td>
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
                                    <td>lorem ipsum</td>
                                    <td>Program A</td>
                                    <td>AIK1234</td>
                                    <td>AIK1234</td>
                                    <td>lorem ipsum</td>
                                    <td>Rp. 1.000.000,00</td>
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
