@extends('layouts.admin-master')

@section('title')
Create User
@endsection

@section('content')
<section class="section">
  <div class="section-header">
    <h1>Add User</h1>
  </div>
  <div class="section-body">
      <div class="row">
          <div class="col-10">
              <div class="card">

                  <div class="row">
                      <div class="card-body">
                          <div class="form-row">
                              <div class="form-group col-md-6">
                                  <div class="col-sm-8">
                                      <label>NIK</label>
                                      <input type="text" class="form-control">
                                  </div>
                              </div>
                          </div>
                          <div class="form-row">
                              <div class="form-group col-md-6">
                                  <div class="col-sm-8">
                                      <label>Nama</label>
                                      <input type="text" class="form-control">
                                  </div>
                              </div>
                          </div>
                          <div class="form-row">
                              <div class="form-group col-md-6">
                                  <div class="col-sm-8">
                                      <label>Jabatan</label>
                                      <input type="text" class="form-control">
                                  </div>
                              </div>
                          </div>
                          <div class="form-row">
                              <div class="form-group col-md-6">
                                  <div class="col-sm-8">
                                      <label>Penempatan</label>
                                      <select class="form-control">
                                          <option>Semarang</option>
                                          <option>Pekalongan</option>
                                      </select>
                                  </div>
                              </div>
                          </div>
                          <div class="form-row">
                            <div class="form-group col-md-6">
                              <div class="col-sm-8">
                                  <label>Role</label>
                                  <select class="form-control">
                                      <option>Commerce</option>
                                      <option>Finance</option>
                                      <option>General Manager</option>
                                  </select>
                              </div>
                            </div>
                          </div>
                          <div class="form-row">
                              <div class="form-group col-md-9">
                                  <div class="col-sm-8">
                                      
                                  </div>
                              </div>
                              <div class="form-group col-md-3">
                                  <div class="col-sm-8">
                                      
                                  </div>
                              </div>
                          </div>
                          <div class="form-row">
                              <div class="form-group col-md-4">
                                  <div class="col-sm-8">
                                      
                                  </div>
                              </div>
                              <div class="form-group col-md-8">
                                  <div class="col-sm-8">
                                      <div class="col-12 float-end">
                                          <a href="{{ route('create-user') }}" class="btn btn-primary mb-3 mt-3 shadow rounded">
                                              <i class="bi bi-file-earmark-plus" style="padding-right: 10px"></i>Tambah User
                                          </a>
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div> 
      </div>
  </div>
</section>
@endsection
