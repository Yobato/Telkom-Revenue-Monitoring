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
            <h1>User</h1>
            <div class="section-header-breadcrumb">
              <div class="breadcrumb-item"><a href="#">Dropdown</a></div>
              <div class="breadcrumb-item active">User</div>
            </div>
          </div>

          <div class="section-body">
            <h2 class="section-title">Tabel User</h2>
            <p class="section-lead">
              Kelola User pada sistem. User disini akan memengaruhi interaksi Anda pada sistem seperti filter dan search!
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
                  <!-- ADD User -->
                  <div class="card-header">
                    <div class="col-8">
                      <h4>Simple</h4>
                    </div>
                    <div class="col-4 d-flex justify-content-end">
                      <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">Add User</button>
                    </div>
                  </div>

                  <!-- TAMBAH User -->
                  <div class="modal fade" tabindex="-1" role="dialog" id="exampleModal" data-backdrop="static">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title">Tambah User</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="closeUserReco1">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <form class="form-validation" id="userrecoForm" action="{{route('admin.storeUserReco')}}" method="POST">
                        @csrf
                          <div class="modal-body">
                            <div class="form-group">
                              <label for="nama_user_reco" class="col-form-label">Nama User: </label>
                              <input type="text" id="nama_user_reco" name="nama_user_reco" class="required-input form-control">
                              <span class="error-message" id="nama_user_reco_error" style="display: none; color: red;">Field Nama User harus diisi!</span>
                              {{-- @if($errors->has('nama_user_reco'))
                                <span class="invalid-feedback">{{ $errors->first('nama_user_reco') }}</span>
                              @endif --}}
                            </div>
                          </div>
                          <div class="modal-footer bg-whitesmoke br">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal" id="closeUserReco2">Close</button>
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
                          <th scope="col" class="w-50">Nama User</th>
                          <th scope="col">Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php $i=1 ?>
                        @foreach ($user_reco as $admins)
                        <tr>
                          <th scope="row">{{$i++}}</th>
                          <td>{{ $admins ->nama_user_reco}}</td>
                          <td>
                            <!-- UPDATE User -->
                            <a class="btn btn-sm btn-success btn-sm rounded-0" data-toggle="modal" data-target="#editUserRecoModal-{{$admins->id}}" style="color: white" 
                            ><i class="fa fa-edit"></i></a>
                            
                            {{-- MODAL EDIT --}}
                            <div class="modal fade" tabindex="-1" role="dialog" id="editUserRecoModal-{{$admins->id}}" data-backdrop="static">
                              <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title">Ubah User</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="closeUserReco1">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                  </div>
                                  <form id="user_recoUpdateForm" class="form-validation" action="{{route('admin.updateUserReco', [$admins->id])}}" method="POST">
                                  @csrf
                                    <div class="modal-body">
                                      <div class="form-group">
                                        <label for="nama_update_user_reco" class="col-form-label">Nama User: </label>
                                        <input type="text" id="nama_update_user_reco" name="nama_user_reco" class="form-control" value="{{ $admins->nama_user_reco }}" required>
                                        <!-- <span id="nama_user_reco_error" class="error-message">Field Nama User harus diisi!</span> -->
                                      </div>
                                    </div>
                                    <div class="modal-footer bg-whitesmoke br">
                                      <button type="button" class="btn btn-secondary" data-dismiss="modal" id="closeUpdateUserReco">Close</button>
                                      <button type="submit" class="btn btn-primary" value="Simpan Data">Save changes</button>
                                    </div>
                                  </form>
                                </div>
                              </div>
                            </div>

                            {{-- DELETE User --}}
                            <a class="btn btn-sm btn-danger btn-sm rounded-0" 
                            style="color: white"
                            data-toggle="modal" data-target="#deleteUserRecoModal{{ $admins->id }}"
                            ><i class="fa fa-trash"></i></a>

                            {{-- MODAL DELETE --}}
                            <div class="modal fade" tabindex="-1" role="dialog" id="deleteUserRecoModal{{ $admins->id }}" data-backdrop="static">
                                <div class="modal-dialog" role="document">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <h5 class="modal-title">Hapus User</h5>
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="closeUserReco1">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                    </div>
                                    @csrf
                                      <div class="modal-body">
                                        Pilih "Delete" dibawah ini jika Anda yakin menghapus User yang dipilih.
                                      </div>
                                      <div class="modal-footer bg-whitesmoke br">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal" id="closeUserReco2">Cancel</button>
                                        <a class="btn btn-danger" href="{{ route('admin.deleteUserReco', [$admins->id]) }}" value="Delete">Delete</a>
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

@push('scripts')
<script>
$(document).ready(function() {
    $('#table-1').DataTable({
        "columnDefs": [
            {
                "targets": [2], // 4th column (Action)
                "searchable": false, // Disable searching for this column
                "orderable": false,
            }
        ]
    });
});
</script>
@endpush