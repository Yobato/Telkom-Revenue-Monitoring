@extends('layouts.admin-master')

@section('title')
Dashboard
@endsection

@section('content')
<section class="section">
  {{-- <div class="section-header">
    <h1>Dashboard</h1>
  </div> --}}

  <div class="section-body">
        <section class="section">
          <div class="section-header">
            <h1>User Management</h1>
            <div class="section-header-breadcrumb">
              {{-- <div class="breadcrumb-item"><a href="#">Dropdown</a></div> --}}
              <div class="breadcrumb-item active">User Management</div>
            </div>
          </div>

          <div class="section-body">
            <h2 class="section-title">Management Account</h2>
            <p class="section-lead">
              Manage users who can interact with the system in one place!
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
                  {{-- ADD ACCOUNT --}}
                  <div class="card-header">
                    <div class="col-8">
                      <h4>Account</h4>
                    </div>
                    <div class="col-4 d-flex justify-content-end">
                      <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#accountAddModal">Add Account</button>
                    </div>
                  </div>

                  <!-- TAMBAH ACCOUNT-->
                  <div class="modal fade" tabindex="-1" role="dialog" id="accountAddModal" data-backdrop="static">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title">Add Account</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="closeAccount1">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <form class="form-validation" id="accountForm" action="{{route('admin.storeAccount')}}" method="POST">
                        @csrf
                          <div class="modal-body">
                            <div class="form-group">
                              
                              <label for="nama" class="col-form-label">Name: </label>
                              <input type="text" id="nama" name="nama" class="required-input form-control">
                              <span class="error-message" id="nama" style="display: none; color: red;">Name field is required!</span>

                              <label for="nik" class="col-form-label">NIK: </label>
                              <input type="text" id="nik" name="nik" class="required-input form-control">
                              <span class="error-message" id="nik" style="display: none; color: red;">NIK field is required!</span>

                              <label for="password" class="col-form-label">Password: </label>
                              <input type="password" id="password" name="password" class="required-input form-control">
                              <span class="error-message" id="password_error" style="display: none; color: red;">Password field is required!</span>

                              <label for="role" class="col-form-label">Role: </label>
                              <select class="required-input role form-control" name="role">
                                <option value="" selected>-- Choose Role --</option>
                                @foreach ($roles as $role)
                                    <option value=<?= $role->nama_role ?>>{{ $role->nama_role }}</option>
                                @endforeach
                              </select>
                              <span class="error-message" id="role_error" style="display: none; color: red;">Role field is required!</span>

                              <label for="kota" class="col-form-label">City: </label>
                              <select class="required-input kota form-control" name="kota">
                                <option value="" onclick="pushData('kota')" selected>-- Choose City --</option>
                                @foreach ($addcity as $city)
                                    <option value= {{ $city->id }}>{{ $city->nama_city }}</option>
                                @endforeach
                              </select>
                              <span class="error-message" id="kota_error" style="display: none; color: red;">City field is required!</span>

                              <label for="keterangan" class="col-form-label">Description: </label>
                              <input type="text" id="keterangan" name="keterangan" class="required-input form-control">
                              {{-- <textarea id="keterangan" name="keterangan" class="form-control" rows="10" cols="500"></textarea> --}}
                              <span class="error-message" id="keterangan_error" style="display: none; color: red;">Description field is required!</span>
                            </div>
                          </div>
                          <div class="modal-footer bg-whitesmoke br">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal" id="closeAccount2">Close</button>
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
                          <th scope="col">Name</th>
                          <th scope="col">NIK</th>
                          {{-- <th scope="col" class="w-50">Password</th> --}}
                          <th scope="col">Role</th>
                          <th scope="col">City</th>
                          <th scope="col">Description</th>
                          <th scope="col">Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php $i=1 ?>
                        @foreach ($account as $admins)
                        <tr>
                          <th scope="row">{{$i++}}</th>
                          <td>{{ $admins ->nama}}</td>
                          <td>{{ $admins ->nik}}</td>
                          <td>{{ $admins ->role}}</td>
                          <td>{{ $citys[$admins->kota]}}</td>
                          <td>{{ $admins ->keterangan}}</td>

                          <td>

                            {{-- UPDATE Account --}}
                            <a class="btn btn-sm btn-success btn-sm rounded-0" data-toggle="modal" data-target="#editAccountModal-{{$admins->id}}" style="color: white" 
                            ><i class="fa fa-edit"></i></a>

                            {{-- MODAL EDIT --}}
                            <div class="modal fade" tabindex="-1" role="dialog" id="editAccountModal-{{$admins->id}}" data-backdrop="static">
                              <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title">Change Account</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="closeAccount1">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                  </div>
                                  <form id="accountUpdateForm" class="form-validation" action="{{route('admin.updateAccount', [$admins->id])}}" method="POST">
                                  @csrf
                                    <div class="modal-body">
                                      <div class="form-group">
                                        <label for="nama" class="col-form-label">Name: </label>
                                        <input type="text" id="nama" name="nama" class="form-control" value="{{ $admins->nama }}" required>
                                        <span id="nama" style="display: none; color: red;">Name field is required!</span>
  
                                        <label for="nik" class="col-form-label">NIK: </label>
                                        <input type="text" id="nik" name="nik" class="form-control" value="{{ $admins->nik }}" required>
                                        <span id="nik" style="display: none; color: red;">NIK field is required!</span>
  
                                        <label for="password" class="col-form-label">Password: </label>
                                        <input type="password" id="password" name="password" class="form-control" placeholder="Kosong">
                                        <span id="password_error" style="display: none; color: red;">Password field is required!</span>
  
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
  
                                        <label for="kota" class="col-form-label">City: </label>
                                        <select class="kota form-control" name="kota" required>
                                          <option value="{{$admins->kota}}" onclick="pushData('kota')" selected>{{$citys[$admins->kota]}}</option>
                                          @foreach ($addcity as $city)
                                            @if ($citys[$admins->kota] !== $city->nama_city)
                                              <option value= {{ $city->id }}>{{ $city->nama_city }}</option>
                                            @endif
                                          @endforeach
                                        </select>
                                        <span id="kota_error" style="display: none; color: red;">Field City harus diisi!</span>
  
                                        <label for="keterangan" class="col-form-label">Description: </label>
                                        <input type="text" id="keterangan" name="keterangan" class="form-control" value="{{ $admins->keterangan }}" required>
                                        {{-- <textarea id="keterangan" name="keterangan" class="form-control" rows="10" cols="500"></textarea> --}}
                                        <span id="keterangan_error" style="display: none; color: red;">Description field is required!</span>
                                      </div>
                                    </div>
                                    <div class="modal-footer bg-whitesmoke br">
                                      <button type="button" class="btn btn-secondary" data-dismiss="modal" id="closeUpdateAccount">Close</button>
                                      <button type="submit" class="btn btn-primary" value="Simpan Data">Save changes</button>
                                    </div>
                                  </form>
                                </div>
                              </div>
                            </div>
                            
                            {{-- DELETE Account --}}
                            <a class="btn btn-sm btn-danger btn-sm rounded-0" 
                            style="color: white"
                            data-toggle="modal" data-target="#deleteAccountModal{{ $admins->id }}"
                            ><i class="fa fa-trash"></i></a>

                            {{-- MODAL DELETE --}}
                            <div class="modal fade" tabindex="-1" role="dialog" id="deleteAccountModal{{ $admins->id }}" data-backdrop="static">
                                <div class="modal-dialog" role="document">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <h5 class="modal-title">Delete Account</h5>
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="closeAccount1">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                    </div>
                                    @csrf
                                      <div class="modal-body">
                                        Choose "Delete" below if you are sure to delete the selected Account.
                                      </div>
                                      <div class="modal-footer bg-whitesmoke br">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal" id="closeAccount2">Cancel</button>
                                        <a class="btn btn-danger" href="{{ route('admin.deleteAccount', [$admins->id]) }}" value="Delete">Delete</a>
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
                "targets": [6], // 4th column (Action)
                "searchable": false, // Disable searching for this column
                "orderable": false,
            }
        ]
    });
});
</script>
@endpush