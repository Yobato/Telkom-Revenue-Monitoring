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
            <h1>Peruntukan</h1>
            <div class="section-header-breadcrumb">
              <div class="breadcrumb-item"><a href="#">Dropdown</a></div>
              <div class="breadcrumb-item active">Peruntukan</div>
            </div>
          </div>

          <div class="section-body">
            <h2 class="section-title">Peruntukan Table</h2>
            <p class="section-lead">
              Manage peruntukan in the system. The peruntukan here will be dropdown data in laporan nota
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

            @error('nama_peruntukan')
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
                  <!-- ADD Peruntukan -->
                  <div class="card-header">
                    <div class="col-8">
                      <h4>Peruntukan</h4>
                    </div>
                    <div class="col-4 d-flex justify-content-end">
                      <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">Add Peruntukan</button>
                    </div>
                  </div>

                  <!-- TAMBAH Peruntukan -->
                  <div class="modal fade" tabindex="-1" role="dialog" id="exampleModal" data-backdrop="static">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title">Add Peruntukan</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="closePeruntukan1">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <form class="form-validation" id="peruntukanForm" action="{{route('admin.storePeruntukan')}}" method="POST">
                        @csrf
                          <div class="modal-body">
                            <div class="form-group">
                              <label for="nama_peruntukan" class="col-form-label">Peruntukan Name: </label>
                              <input type="text" id="nama_peruntukan" name="nama_peruntukan" class="required-input form-control">
                              <span class="error-message" id="nama_peruntukan_error" style="display: none; color: red;">Peruntukan Name field is required!</span>
                              <!-- @if($errors->has('nama_peruntukan'))
                                <span class="invalid-feedback">{{ $errors->first('nama_peruntukan') }}</span>
                              @endif -->
                            </div>
                          </div>
                          <div class="modal-footer bg-whitesmoke br">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal" id="closePeruntukan2">Close</button>
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
                          <th scope="col" class="w-50">Peruntukan Name</th>
                          <th scope="col">Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php $i=1 ?>
                        @foreach ($peruntukan as $admins)
                        <tr>
                          <th scope="row">{{$i++}}</th>
                          <td>{{ $admins ->nama_peruntukan}}</td>
                          <td>
                            {{-- UPDATE Peruntukan --}}
                            <a class="btn btn-sm btn-success btn-sm rounded-0" data-toggle="modal" data-target="#editPeruntukanModal-{{$admins->id}}" style="color: white" 
                            ><i class="fa fa-edit"></i></a>
                            
                            {{-- MODAL EDIT --}}
                            <div class="modal fade" tabindex="-1" role="dialog" id="editPeruntukanModal-{{$admins->id}}" data-backdrop="static">
                              <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title">Change Peruntukan</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="closePeruntukan1">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                  </div>
                                  <form id="peruntukanUpdateForm" class="form-validation" action="{{route('admin.updatePeruntukan', [$admins->id])}}" method="POST">
                                  @csrf
                                    <div class="modal-body">
                                      <div class="form-group">
                                        <label for="nama_update_peruntukan" class="col-form-label">Peruntukan Name: </label>
                                        <input type="text" id="nama_update_peruntukan" name="nama_peruntukan" class="form-control" value="{{ $admins->nama_peruntukan }}" required>
                                        {{-- <span id="nama_peruntukan_error" class="error-message">Field Nama Peruntukan harus diisi!</span> --}}
                                      </div>
                                    </div>
                                    <div class="modal-footer bg-whitesmoke br">
                                      <button type="button" class="btn btn-secondary" data-dismiss="modal" id="closeUpdatePeruntukan">Close</button>
                                      <button type="submit" class="btn btn-primary" value="Simpan Data">Save changes</button>
                                    </div>
                                  </form>
                                </div>
                              </div>
                            </div>

                            {{-- DELETE Peruntukan --}}
                            <a class="btn btn-sm btn-danger btn-sm rounded-0" 
                            style="color: white"
                            data-toggle="modal" data-target="#deletePeruntukanModal{{ $admins->id }}"
                            ><i class="fa fa-trash"></i></a>

                            {{-- MODAL DELETE --}}
                            <div class="modal fade" tabindex="-1" role="dialog" id="deletePeruntukanModal{{ $admins->id }}" data-backdrop="static">
                                <div class="modal-dialog" role="document">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <h5 class="modal-title">Delete Peruntukan</h5>
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="closePeruntukan1">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                    </div>
                                    @csrf
                                      <div class="modal-body">
                                        Choose "Delete" below if you are sure to delete the selected Peruntukan.
                                      </div>
                                      <div class="modal-footer bg-whitesmoke br">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal" id="closePeruntukan2">Cancel</button>
                                        <a class="btn btn-danger" href="{{ route('admin.deletePeruntukan', [$admins->id]) }}" value="Delete">Delete</a>
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