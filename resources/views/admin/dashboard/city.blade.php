@extends('layouts.admin-master')

@section('title')
Dashboard
@endsection

@section('content')
<section class="section">
  <div class="section-header">
    <h1>Dropdown</h1>
  </div>

  <div class="section-body">
        <section class="section">
          <div class="section-header">
            <h1>Kota</h1>
            <div class="section-header-breadcrumb">
              <div class="breadcrumb-item"><a href="#">Dropdown</a></div>
              <div class="breadcrumb-item active">Kota</div>
            </div>
          </div>

          <div class="section-body">
            <h2 class="section-title">Tabel Kota</h2>
            <p class="section-lead">
              Kelola kota pada sistem. Kota disini akan memengaruhi interaksi Anda pada sistem seperti filter dan search!
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
                  {{-- ADD CITY --}}
                  <div class="card-header">
                    <div class="col-8">
                      <h4>Simple</h4>
                    </div>
                    <div class="col-4 d-flex justify-content-end">
                      <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">Add City</button>
                    </div>
                  </div>

                  <!-- TAMBAH CITY -->
                  <div class="modal fade" tabindex="-1" role="dialog" id="exampleModal" data-backdrop="static">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title">Tambah Kota</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="closeCity1">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <form class="form-validation" id="cityForm" action="{{route('admin.storeCity')}}" method="POST">
                        @csrf
                          <div class="modal-body">
                            <div class="form-group">
                              <label for="nama_city" class="col-form-label">Nama Kota: </label>
                              <input type="text" id="nama_city" name="nama_city" class="required-input form-control">
                              <span class="error-message" id="nama_city_error" style="display: none; color: red;">Field Nama Kota harus diisi!</span>
                              {{-- @if($errors->has('nama_city'))
                                <span class="invalid-feedback">{{ $errors->first('nama_city') }}</span>
                              @endif --}}
                            </div>
                          </div>
                          <div class="modal-footer bg-whitesmoke br">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal" id="closeCity2">Close</button>
                            <button type="submit" class="btn btn-primary" value="Simpan Data">Save changes</button>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>

                  <div class="card-body">
                    <table class="table" id="table-1">
                      <thead>
                        <tr>
                          <th scope="col">No</th>
                          <th scope="col" class="w-50">Nama Kota</th>
                          <th scope="col">Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php $i=1 ?>
                        @foreach ($city as $admins)
                        <tr>
                          <th scope="row">{{$i++}}</th>
                          <td>{{ $admins ->nama_city}}</td>
                          <td>
                            {{-- UPDATE CITY --}}
                            <a class="btn btn-sm btn-success btn-sm rounded-0" data-toggle="modal" data-target="#editCityModal-{{$admins->id}}" style="color: white"><i class="fa fa-edit"></i></a>

                            {{-- MODAL CITY --}}
                            <div class="modal fade" tabindex="-1" role="dialog" id="editCityModal-{{$admins->id}}" data-backdrop="static">
                              <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title">Ubah Kota</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="closeCity1">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                  </div>
                                  <form id="cityUpdateForm" class="form-validation" action="{{route('admin.updateCity', [$admins->id])}}" method="POST">
                                  @csrf
                                    <div class="modal-body">
                                      <div class="form-group">
                                        <label for="nama_update_city" class="col-form-label">Nama Kota: </label>
                                        <input type="text" id="nama_update_city" name="nama_city" class="form-control" value="{{ $admins->nama_city }}" required>
                                        {{-- <span id="nama_city_error" class="error-message">Field Nama Kota harus diisi!</span> --}}
                                      </div>
                                    </div>
                                    <div class="modal-footer bg-whitesmoke br">
                                      <button type="button" class="btn btn-secondary" data-dismiss="modal" id="closeUpdateCity">Close</button>
                                      <button type="submit" class="btn btn-primary" value="Simpan Data">Save changes</button>
                                    </div>
                                  </form>
                                </div>
                              </div>
                            </div>
          
                            {{-- DELETE CITY --}}
                            <a class="btn btn-sm btn-danger btn-sm rounded-0"
                            style="color: white"
                            data-toggle="modal" data-target="#deleteCityModal{{ $admins->id }}"
                            ><i class="fa fa-trash"></i></a>
                            
                            {{-- MODAL DELETE --}}
                            <div class="modal fade" tabindex="-1" role="dialog" id="deleteCityModal{{ $admins->id }}" data-backdrop="static">
                                <div class="modal-dialog" role="document">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <h5 class="modal-title">Hapus Kota</h5>
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="closeCity1">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                    </div>
                                    @csrf
                                      <div class="modal-body">
                                        Pilih "Delete" dibawah ini jika Anda yakin menghapus Kota yang dipilih.
                                      </div>
                                      <div class="modal-footer bg-whitesmoke br">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal" id="closeCity2">Cancel</button>
                                        <a class="btn btn-danger" href="{{ route('admin.deleteCity', [$admins->id]) }}" value="Delete">Delete</a>
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
  </div>
</section>
<style>
  .is-invalid {
    border-color: red;
    /* Atau atur properti lainnya untuk mengubah tampilan field input menjadi merah */
  }
</style>
@endsection

{{-- @push('scripts')
<script>
    $(document).ready(function() {
        $('#table-1').dataTable();
    });
</script>
@endpush --}}