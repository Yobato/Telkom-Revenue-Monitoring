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
            <h1>Portofolio</h1>
            <div class="section-header-breadcrumb">
              <div class="breadcrumb-item"><a href="#">Dropdown</a></div>
              <div class="breadcrumb-item active">Portofolio</div>
            </div>
          </div>

          <div class="section-body">
            <h2 class="section-title">Portofolio Table</h2>
            <p class="section-lead">
              Manage portofolio in the system. The portofolio here will be dropdown data in both commerce and finance report.
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

            @error('nama_portofolio')
            <div class="alert alert-danger alert-dismissible fade show">
              {{ $message }}
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            @enderror

            <div class="row">
              <div class="col-12">
                <div class="card">
                  {{-- ADD PORTOFOLIO --}}
                  <div class="card-header">
                    <div class="col-8">
                      <h4>Portofolio</h4>
                    </div>
                    <div class="col-4 d-flex justify-content-end">
                      <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#portofolioAddModal">Add Portofolio</button>
                    </div>
                  </div>

                  <!-- TAMBAH PORTOFOLIO-->
                  <div class="modal fade" tabindex="-1" role="dialog" id="portofolioAddModal" data-backdrop="static">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title">Add Portofolio</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="closePortofolio1">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <form class="form-validation" id="portofolioForm" action="{{route('admin.storePortofolio')}}" method="POST">
                        @csrf
                          <div class="modal-body">
                            <div class="form-group">
                              
                              <label for="nama" class="col-form-label">Portofolio Name: </label>
                              <input type="text" id="nama_portofolio" name="nama_portofolio" class="required-input form-control">
                              <span class="error-message" id="error_nama_portofolio" style="display: none; color: red;">Portofolio Name field is required!</span>

                              <label for="role" class="col-form-label">Role: </label>
                              <select class="required-input role form-control" name="role">
                                <option value="" selected>-- Choose Role --</option>
                                @foreach ($roles as $role)
                                    <option value=<?= $role->nama_role ?>>{{ $role->nama_role }}</option>
                                @endforeach
                              </select>
                              <span class="error-message" id="role_error" style="display: none; color: red;">Role field is required!</span>
                            </div>
                          </div>
                          <div class="modal-footer bg-whitesmoke br">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal" id="closePortofolio2">Close</button>
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
                          <th scope="col">Portofolio Name</th>
                          <th scope="col">Role</th>
                          <th scope="col">Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php $i=1 ?>
                        @foreach ($portofolio as $admins)
                        <tr>
                          <th scope="row">{{$i++}}</th>
                          <td>{{ $admins ->nama_portofolio}}</td>
                          <td>{{ $admins ->role}}</td>
                          <td>
                            {{-- UPDATE PORTOFOLIO --}}
                            <a class="btn btn-sm btn-success btn-sm rounded-0" data-toggle="modal" data-target="#editPortofolioModal-{{$admins->id}}" style="color: white" 
                            ><i class="fa fa-edit"></i></a>

                            {{-- MODAL EDIT --}}
                            <div class="modal fade" tabindex="-1" role="dialog" id="editPortofolioModal-{{$admins->id}}" data-backdrop="static">
                              <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title">Change Portofolio</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="closePortofolio1">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                  </div>
                                  <form id="portofolioUpdateForm" class="form-validation" action="{{route('admin.updatePortofolio', [$admins->id])}}" method="POST">
                                  @csrf
                                    <div class="modal-body">
                                      <div class="form-group">
                                        <label for="nama_portofolio" class="col-form-label">Portofolio Name: </label>
                                        <input type="text" id="nama_portofolio_update" name="nama_portofolio" class="form-control" value="{{ $admins->nama_portofolio }}" required>
                                        <span id="nama_portofolio_update_error" style="display: none; color: red;">Portofolio Name field is required!</span>

                                        <label for="role" class="col-form-label">Role: </label>
                                        <select class="role form-control" name="role" required>
                                          <option value="{{$admins->role}}" selected>{{$admins->role}}</option>
                                          @foreach ($roles as $role)
                                              @if ($role->nama_role !== $admins->role)
                                                  <option value="{{ $role->nama_role }}">{{ $role->nama_role }}</option>
                                              @endif
                                          @endforeach
                                        </select>
                                        <span id="role_error" style="display: none; color: red;">Role field is required!</span>
                                      </div>
                                    </div>
                                    <div class="modal-footer bg-whitesmoke br">
                                      <button type="button" class="btn btn-secondary" data-dismiss="modal" id="closeUpdatePortofolio">Close</button>
                                      <button type="submit" class="btn btn-primary" value="Simpan Data">Save changes</button>
                                    </div>
                                  </form>
                                </div>
                              </div>
                            </div>

                            {{-- DELETE PORTOFOLIO --}}
                            <a class="btn btn-sm btn-danger btn-sm rounded-0" 
                            style="color: white"
                            data-toggle="modal" data-target="#deletePortofolioModal{{ $admins->id }}"
                            ><i class="fa fa-trash"></i></a>

                            {{-- MODAL DELETE --}}
                            <div class="modal fade" tabindex="-1" role="dialog" id="deletePortofolioModal{{ $admins->id }}" data-backdrop="static">
                                <div class="modal-dialog" role="document">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <h5 class="modal-title">Delete Portofolio</h5>
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="closePortofolio1">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                    </div>
                                    @csrf
                                      <div class="modal-body">
                                        Choose "Delete" below if you are sure to delete the selected Portofolio.
                                      </div>
                                      <div class="modal-footer bg-whitesmoke br">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal" id="closePortofolio2">Cancel</button>
                                        <a class="btn btn-danger" href="{{ route('admin.deletePortofolio', [$admins->id]) }}" value="Delete">Delete</a>
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
                "targets": [3], // 4th column (Action)
                "searchable": false, // Disable searching for this column
                "orderable": false,
            }
        ]
    });
});
</script>
@endpush