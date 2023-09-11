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
            <h1>Cost Plan</h1>
            <div class="section-header-breadcrumb">
              <div class="breadcrumb-item"><a href="#">Dropdown</a></div>
              <div class="breadcrumb-item active">Cost Plan</div>
            </div>
          </div>

          <div class="section-body">
            <h2 class="section-title">Tabel Cost Plan</h2>
            <p class="section-lead">
              Kelola Cost Plan pada sistem. Cost Plan disini akan memengaruhi interaksi Anda pada sistem seperti filter dan search!
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
                  <!-- ADD COST PLAN -->
                  <div class="card-header">
                    <div class="col-8">
                      <h4>Simple</h4>
                    </div>
                    <div class="col-4 d-flex justify-content-end">
                      <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">Add Cost Plan</button>
                    </div>
                  </div>

                  <!-- TAMBAH Cost Plan -->
                  <div class="modal fade" tabindex="-1" role="dialog" id="exampleModal" data-backdrop="static">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title">Tambah Cost Plan</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="closeCostPlan1">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <form class="form-validation" id="costplanForm" action="{{route('admin.storeCostPlan')}}" method="POST">
                        @csrf
                          <div class="modal-body">
                            <div class="form-group">
                              <label for="nama_cost_plan" class="col-form-label">Nama Cost Plan: </label>
                              <input type="text" id="nama_cost_plan" name="nama_cost_plan" class="required-input form-control">
                              <span class="error-message" id="nama_cost_plan_error" style="display: none; color: red;">Field Nama Cost Plan harus diisi!</span>
                              {{-- @if($errors->has('nama_cost_plan'))
                                <span class="invalid-feedback">{{ $errors->first('nama_cost_plan') }}</span>
                              @endif --}}
                            </div>
                          </div>
                          <div class="modal-footer bg-whitesmoke br">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal" id="closeCostPlan2">Close</button>
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
                          <th scope="col" class="w-50">Nama Cost Plan</th>
                          <th scope="col">Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php $i=1 ?>
                        @foreach ($cost_plan as $admins)
                        <tr>
                          <th scope="row">{{$i++}}</th>
                          <td>{{ $admins ->nama_cost_plan}}</td>
                          <td>
                            <!-- UPDATE Cost Plan -->
                            <a class="btn btn-sm btn-success btn-sm rounded-0" data-toggle="modal" data-target="#editCostPlanModal-{{$admins->id}}" style="color: white" 
                            ><i class="fa fa-edit"></i></a>
                            
                            {{-- MODAL COST PLAN --}}
                            <div class="modal fade" tabindex="-1" role="dialog" id="editCostPlanModal-{{$admins->id}}" data-backdrop="static">
                              <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title">Ubah Cost Plan</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="closeCostPlan1">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                  </div>
                                  <form id="cost_planUpdateForm" class="form-validation" action="{{route('admin.updateCostPlan', [$admins->id])}}" method="POST">
                                  @csrf
                                    <div class="modal-body">
                                      <div class="form-group">
                                        <label for="nama_update_cost_plan" class="col-form-label">Nama Cost Plan: </label>
                                        <input type="text" id="nama_update_cost_plan" name="nama_cost_plan" class="form-control" value="{{ $admins->nama_cost_plan }}" required>
                                        <!-- <span id="nama_cost_plan_error" class="error-message">Field Nama Cost Plan harus diisi!</span> -->
                                      </div>
                                    </div>
                                    <div class="modal-footer bg-whitesmoke br">
                                      <button type="button" class="btn btn-secondary" data-dismiss="modal" id="closeUpdateCostPlan">Close</button>
                                      <button type="submit" class="btn btn-primary" value="Simpan Data">Save changes</button>
                                    </div>
                                  </form>
                                </div>
                              </div>
                            </div>

                            {{-- DELETE COST PLAN --}}
                            <a class="btn btn-sm btn-danger btn-sm rounded-0" 
                            style="color: white"
                            data-toggle="modal" data-target="#deleteCostPlanModal{{ $admins->id }}"
                            ><i class="fa fa-trash"></i></a>

                            {{-- MODAL DELETE --}}
                            <div class="modal fade" tabindex="-1" role="dialog" id="deleteCostPlanModal{{ $admins->id }}" data-backdrop="static">
                                <div class="modal-dialog" role="document">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <h5 class="modal-title">Hapus Cost Plan</h5>
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="closeCostPlan1">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                    </div>
                                    @csrf
                                      <div class="modal-body">
                                        Pilih "Delete" dibawah ini jika Anda yakin menghapus Cost Plan yang dipilih.
                                      </div>
                                      <div class="modal-footer bg-whitesmoke br">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal" id="closeCostPlan2">Cancel</button>
                                        <a class="btn btn-danger" href="{{ route('admin.deleteCostPlan', [$admins->id]) }}" value="Delete">Delete</a>
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