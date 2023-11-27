@extends('layouts.admin-master')

@section('title')
Dashboard
@endsection

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Target Management</h1>
    </div>

    <div class="section-body">
        <section class="section">
            <div class="section-header">
                <h1>Target Commerce</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item"><a href="#">Target Management</a></div>
                    <div class="breadcrumb-item active">Target Commerce</div>
                </div>
            </div>

            <div class="section-body">
                <h2 class="section-title">Tabel Target Commerce</h2>
                <p class="section-lead">
                    Kelola Target Commerce. Target Commerce disini akan mempengaruhi capaian bulanan Dashboard COGS, Revenue dan GPM
                </p>

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
                            <!-- ADD Target -->
                            <div class="card-header">
                                <div class="col-8">
                                    <h4>Target Commerce</h4>
                                </div>
                                <div class="col-4 d-flex justify-content-end">
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">Add Target Commerce</button>
                                </div>
                            </div>

                            <!-- Tambah Target -->
                            <div class="modal fade" tabindex="-1" role="dialog" id="exampleModal" data-backdrop="static">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Tambah Target Commerce</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="closeTarget1">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form class="form-validation" id="targetForm" action="{{route('admin.storeTarget')}}" method="POST">
                                            @csrf
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label for="jumlah" class="col-form-label">Jumlah: </label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text">
                                                                Rp.
                                                            </div>
                                                        </div>
                                                        <input type="text" id="jumlah" name="jumlah" class="required-input form-control" onkeyup="formatCurrency(this)">
                                                    </div>
                                                    <span class="error-message" id="jumlah_error" style="display: none; color: red;">Field Jumlah harus diisi!</span>
                                                </div>
                                                <div class="form-group">
                                                    <label for="jenis_laporan" class="col-form-label">Jenis Laporan: </label>
                                                    <select class="required-input form-control" name="jenis_laporan" id="jenis_laporan">
                                                        <option value="">-- Pilih Jenis Laporan --</option>
                                                        <option value="COGS">COGS</option>
                                                        <option value="REVENUE">REVENUE</option>
                                                    </select>
                                                    <span class="error-message" id="bulan_error" style="display: none; color: red;">Field Jenis Laporan harus dipilih!</span>
                                                </div>

                                                <div class="form-group">
                                                    <label for="id_portofolio" class="col-form-label">Portofolio: </label>
                                                    <select class="id_portofolio required-input form-control" name="id_portofolio" id="id_portofolio">
                                                        <option value="" selected>-- Pilih Portofolio --</option>
                                                        @foreach ($addportofolio as $portofolio)
                                                        <option value={{ $portofolio->id }}>{{ $portofolio->nama_portofolio }}</option>
                                                        @endforeach
                                                    </select>
                                                    <span class="error-message" id="portofolio_error" style="display: none; color: red;">Field Portofolio harus dipilih!</span>
                                                </div>

                                                
                                                <div class="form-group">
                                                    <label for="bulan" class="col-form-label">Bulan: </label>
                                                    {{-- <input type="text" id="bulan-test" class="required-input form-control" name="bulan" required /> --}}
                                                    <select class="required-input form-control" name="bulan" id="bulan">
                                                        <option value="">-- Pilih Bulan --</option>
                                                        <option value="Januari">Januari</option>
                                                        <option value="Februari">Februari</option>
                                                        <option value="Maret">Maret</option>
                                                        <option value="April">April</option>
                                                        <option value="Mei">Mei</option>
                                                        <option value="Juni">Juni</option>
                                                        <option value="Juli">Juli</option>
                                                        <option value="Agustus">Agustus</option>
                                                        <option value="September">September</option>
                                                        <option value="Oktober">Oktober</option>
                                                        <option value="November">November</option>
                                                        <option value="Desember">Desember</option>
                                                    </select>
                                                    <span class="error-message" id="bulan_error" style="display: none; color: red;">Field Bulan harus dipilih!</span>
                                                </div>
                                                <div class="form-group">
                                                    <div class="form-group">
                                                        <label for="tahun" class="col-form-label">Tahun: </label>
                                                        <input type="text" id="tahun" class="required-input form-control" name="tahun" required />
                                                        {{-- <input type="text" id="tahun" name="tahun" class="form-control" value="{{ old('tahun')}}" required> --}}
                                                        <span class="error-message" id="tahun_error" style="display: none; color: red;">Field Jumlah harus diisi!</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer bg-whitesmoke br">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal" id="closeTarget2">Close</button>
                                                <button type="submit" class="btn btn-primary" value="Simpan Data">Save changes</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <div class="card-body">
                                <table class="table" id="table-2">
                                    <thead>
                                        <tr>
                                            <th scope="col">No</th>
                                            <th scope="col">Jenis Laporan</th>
                                            <th scope="col">Portofolio</th>
                                            <th scope="col">Jumlah</th>
                                            <th scope="col">Bulan</th>
                                            <th scope="col">Tahun</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1 ?>
                                        @foreach ($target as $admins)
                                        <tr>
                                            <th scope="row">{{$i++}}</th>
                                            <td>{{ $admins ->jenis_laporan}}</td>
                                            <td>{{ $portofolio_id[$admins ->id_portofolio]}}</td>
                                            <td>{{ $admins ->jumlah}}</td>
                                            <td>{{ $admins ->bulan}}</td>
                                            <td>{{ $admins ->tahun}}</td>
                                            <td>
                                                <a href="#" class="btn btn-success btn-sm rounded-0" type="button" data-toggle="modal" data-target="#editTargetModal-{{$admins->id}}">
                                                    <i class="fa fa-edit"></i></a>
                                                <a class="btn btn-danger btn-sm rounded-0" style="color: white" type="button" data-toggle="modal" data-target="#deleteTargetModal{{ $admins->id }}">
                                                    <i class="fa fa-trash"></i></a>
                                                <!-- MODAL DELETE -->
                                                <div class="modal fade" tabindex="-1" role="dialog" id="deleteTargetModal{{ $admins->id }}" data-backdrop="static">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Hapus Target Commerce</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="closeTarget1">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            @csrf
                                                            <div class="modal-body">
                                                                Pilih "Delete" dibawah ini jika Anda yakin menghapus Target Commerce yang dipilih.
                                                            </div>
                                                            <div class="modal-footer bg-whitesmoke br">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal" id="closeTarget2">Cancel</button>
                                                                <a class="btn btn-danger" href="{{ route('admin.deleteTarget', [$admins->id]) }}" value="Delete">Delete</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                {{-- <a class="btn btn-sm btn-warning" href="#">Edit</a> --}}

                                                <!-- UPDATE Target -->
                                                <div class="modal fade" tabindex="-1" role="dialog" id="editTargetModal-{{$admins->id}}" data-backdrop="static">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Ubah Target Commerce</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="closeTarget1">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <form id="TargetUpdateForm" class="form-validation" action="{{route('admin.updateTarget', [$admins->id])}}" method="POST">
                                                                @csrf
                                                                <div class="modal-body">
                                                                    <div class="form-group">
                                                                        <div class="form-group">
                                                                            <label for="jumlah" class="col-form-label">Jumlah: </label>
                                                                            <div class="input-group">
                                                                                <div class="input-group-prepend">
                                                                                    <div class="input-group-text">
                                                                                        Rp.
                                                                                    </div>
                                                                                </div>
                                                                                <input type="text" id="jumlah" name="jumlah" class="form-control" value="{{ old('jumlah', $admins->jumlah) }}" onkeyup="formatCurrency(this)" required>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="jenis_laporan" class="col-form-label">Jenis Laporan: </label>
                                                                            <select class="form-control" name="jenis_laporan" id="jenis_laporan" required>
                                                                                <option value="COGS" {{ $admins->jenis_laporan === 'COGS' ? 'selected' : '' }}>COGS</option>
                                                                                <option value="REVENUE" {{ $admins->jenis_laporan === 'REVENUE' ? 'selected' : '' }}>REVENUE</option>
                                                                                <option value="KKP" {{ $admins->jenis_laporan === 'KKP' ? 'selected' : '' }}>KKP</option>
                                                                            </select>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="id_portofolio_edit" class="col-form-label">Portofolio: </label>
                                                                            <select class="id_portofolio_edit form-control" name="id_portofolio" id="id_portofolio_edit" required>
                                                                                @foreach ($addportofolio as $portofolio)
                                                                                    <option value="{{ $portofolio->id }}" {{ $admins->id_portofolio == $portofolio->id ? 'selected' : '' }}>
                                                                                        {{ $portofolio->nama_portofolio }}
                                                                                    </option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label for="bulan" class="col-form-label">Bulan: </label>
                                                                        <select class="form-control" name="bulan" id="bulan" required>
                                                                            <option value="Januari" {{ $admins->bulan === 'Januari' ? 'selected' : '' }}>Januari</option>
                                                                            <option value="Februari" {{ $admins->bulan === 'Februari' ? 'selected' : '' }}>Februari</option>
                                                                            <option value="Maret" {{ $admins->bulan === 'Maret' ? 'selected' : '' }}>Maret</option>
                                                                            <option value="April" {{ $admins->bulan === 'April' ? 'selected' : '' }}>April</option>
                                                                            <option value="Mei" {{ $admins->bulan === 'Mei' ? 'selected' : '' }}>Mei</option>
                                                                            <option value="Juni" {{ $admins->bulan === 'Juni' ? 'selected' : '' }}>Juni</option>
                                                                            <option value="Juli" {{ $admins->bulan === 'Juli' ? 'selected' : '' }}>Juli</option>
                                                                            <option value="Agustus" {{ $admins->bulan === 'Agustus' ? 'selected' : '' }}>Agustus</option>
                                                                            <option value="September" {{ $admins->bulan === 'September' ? 'selected' : '' }}>September</option>
                                                                            <option value="Oktober" {{ $admins->bulan === 'Oktober' ? 'selected' : '' }}>Oktober</option>
                                                                            <option value="November" {{ $admins->bulan === 'November' ? 'selected' : '' }}>November</option>
                                                                            <option value="Desember" {{ $admins->bulan === 'Desember' ? 'selected' : '' }}>Desember</option>
                                                                        </select>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <div class="form-group">
                                                                            <label for="tahun" class="col-form-label">Tahun: </label>
                                                                            <input type="text" id="tahun" name="tahun" class="form-control" value="{{ old('tahun', $admins->tahun) }}" required>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer bg-whitesmoke br">
                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal" id="closeUpdateTarget">Close</button>
                                                                    <button type="submit" class="btn btn-primary" value="Simpan Data">Save changes</button>
                                                                </div>
                                                            </form>
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
    </div>
</section>
<style>
    .is-invalid {
        border-color: red;
        /* Atau atur properti lainnya untuk mengubah tampilan field input menjadi merah */
    }
</style>
<script>
    function formatCurrency(input) {
        // Menghilangkan semua karakter selain angka
        let rawValue = input.value.replace(/[^\d]/g, '');

        // Memastikan input tidak kosong
        if (rawValue) {
            // Mengubah angka menjadi format uang dengan pemisah ribuan (.)
            let formattedValue = Number(rawValue).toLocaleString('id-ID');

            // Menampilkan hasil format uang di input
            input.value = formattedValue;
        }
    }
</script>
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    $('#table-2').DataTable({
        "columnDefs": [
            {
                "targets": [6], // 7th column (Action)
                "searchable": false, // Disable searching for this column
                "orderable": false,
            }
        ]
    });
});
</script>
@endpush