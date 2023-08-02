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
            <h1>Sub Grup Akun</h1>
            <div class="section-header-breadcrumb">
              <div class="breadcrumb-item"><a href="#">Dropdown</a></div>
              <div class="breadcrumb-item active">Sub Grup Akun</div>
            </div>
          </div>

          <div class="section-body">
            <h2 class="section-title">Tabel Sub Grup Akun</h2>
            <p class="section-lead">
              Kelola Sub Grup Akun pada sistem. Sub Grup Akun disini akan memengaruhi interaksi Anda pada sistem seperti filter dan search!
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
                  <!-- ADD CITY -->
                  <div class="card-header">
                    <div class="col-8">
                      <h4>Simple</h4>
                    </div>
                    <div class="col-4 d-flex justify-content-end">
                      <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">Add Sub Grup Akun</button>
                    </div>
                  </div>

                  <!-- TAMBAH Sub Grup Akun -->
                  <div class="modal fade" tabindex="-1" role="dialog" id="exampleModal" data-backdrop="static">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title">Tambah Sub Grup Akun</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="closeSubGrupAkun1">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <form class="form-validation" id="subForm" action="{{route('admin.storeSub')}}" method="POST">
                        @csrf
                          <div class="modal-body">
                            <div class="form-group">
                              <label for="nama_sub" class="col-form-label">Nama Sub Grup Akun: </label>
                              <input type="text" id="nama_sub" name="nama_sub" class="required-input form-control">
                              <span class="error-message" id="nama_sub_error" style="display: none; color: red;">Field Nama Sub Grup Akun harus diisi!</span>
                              {{-- @if($errors->has('nama_sub'))
                                <span class="invalid-feedback">{{ $errors->first('nama_city') }}</span>
                              @endif --}}
                            </div>
                          </div>
                          <div class="modal-footer bg-whitesmoke br">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal" id="closeSubGrupAkun2">Close</button>
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
                          <th scope="col" class="w-50">Nama Sub Grup Akun</th>
                          <th scope="col">Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php $i=1 ?>
                        @foreach ($sub_grup_akun as $admins)
                        <tr>
                          <th scope="row">{{$i++}}</th>
                          <td>{{ $admins ->nama_sub}}</td>
                          <td>
                            <a class="btn btn-sm btn-danger" 
                            {{-- data-toggle="modal" data-target="#deleteModal{{$admins->id}}" --}}
                            style="color: white"
                            data-toggle="modal" data-target="#deleteSubModal{{ $admins->id }}"
                            >Delete</a>
                            <!-- MODAL DELETE -->
                            <div class="modal fade" tabindex="-1" role="dialog" id="deleteSubModal{{ $admins->id }}" data-backdrop="static">
                                <div class="modal-dialog" role="document">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <h5 class="modal-title">Hapus Sub Grup Akun</h5>
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="closeSub1">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                    </div>
                                    @csrf
                                      <div class="modal-body">
                                        Pilih "Delete" dibawah ini jika Anda yakin menghapus Sub Grup Akun yang dipilih.
                                      </div> 
                                      <div class="modal-footer bg-whitesmoke br">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal" id="closeSub2">Cancel</button>
                                        <a class="btn btn-danger" href="{{ route('admin.deleteSub', [$admins->id]) }}" value="Delete">Delete</a>
                                      </div>
                                  </div>
                                </div>
                            </div>
                            {{-- <a class="btn btn-sm btn-warning" href="#">Edit</a> --}}

                            <!-- UPDATE Sub Grup Akun -->
                            <a class="btn btn-sm btn-warning" data-toggle="modal" data-target="#editSubModal-{{$admins->id}}" style="color: white" 
                            >Edit</a>
                            <div class="modal fade" tabindex="-1" role="dialog" id="editSubModal-{{$admins->id}}" data-backdrop="static">
                              <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title">Ubah Sub Grup Akun</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="closeSub1">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                  </div>
                                  <form id="subUpdateForm" class="form-validation" action="{{route('admin.updateSub', [$admins->id])}}" method="POST">
                                  @csrf
                                    <div class="modal-body">
                                      <div class="form-group">
                                        <label for="nama_update_sub" class="col-form-label">Nama Sub Grup Akun: </label>
                                        <input type="text" id="nama_update_sub" name="nama_sub" class="form-control" value="{{ $admins->nama_sub }}" required>
                                        {{-- <span id="nama_sub_error" class="error-message">Field Nama Sub Grup Akun harus diisi!</span> --}}
                                      </div>
                                    </div>
                                    <div class="modal-footer bg-whitesmoke br">
                                      <button type="button" class="btn btn-secondary" data-dismiss="modal" id="closeUpdateSub">Close</button>
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
@endsection

<!-- @push('scripts')
<script>
    $(document).ready(function() {
        $('#table-1').dataTable();
    });
</script>
@endpush -->