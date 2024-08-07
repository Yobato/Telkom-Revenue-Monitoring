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
            <h1>Program</h1>
            <div class="section-header-breadcrumb">
              <div class="breadcrumb-item"><a href="#">Dropdown</a></div>
              <div class="breadcrumb-item active">Program</div>
            </div>
          </div>

          <div class="section-body">
            <h2 class="section-title">Tabel Program</h2>
            <p class="section-lead">
              Kelola dropdown program. Dropdown Program akan muncul pada pengguna Commerce dan Finance!
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

            @error('nama_program')
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
                      <h4>Simple</h4>
                    </div>
                    <div class="col-4 d-flex justify-content-end">
                      <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#programAddModal">Add Program</button>
                    </div>
                  </div>

                  <!-- TAMBAH PORTOFOLIO-->
                  <div class="modal fade" tabindex="-1" role="dialog" id="programAddModal" data-backdrop="static">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title">Tambah Program</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="closeProgram1">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <form class="form-validation" id="programForm" action="{{route('admin.storeProgram')}}" method="POST">
                        @csrf
                          <div class="modal-body">
                            <div class="form-group">
                              
                              <label for="nama" class="col-form-label">Nama Program: </label>
                              <input type="text" id="nama_program" name="nama_program" class="required-input form-control">
                              <span class="error-message" id="error_nama_program" style="display: none; color: red;">Field Nama Program harus diisi!</span>

                              <label for="kode" class="col-form-label">Kode Program: </label>
                              <input type="text" id="kode_program" name="kode_program" class="required-input form-control">
                              <span class="error-message" id="error_kode_program" style="display: none; color: red;">Field Kode Program harus diisi!</span>

                              <label for="role" class="col-form-label">Role: </label>
                              <select class="required-input role form-control" id="roless" name="role" onchange="getPorto()">
                                <option value="" selected>-- Pilih Role --</option>
                                @foreach ($roles as $role)
                                    <option value=<?= $role->nama_role ?>>{{ $role->nama_role }}</option>
                                @endforeach
                              </select>
                              <span class="error-message" id="role_error" style="display: none; color: red;">Field Role harus diisi!</span>

                              <label for="ketentuan" class="col-form-label">Apakah program harus sesuai portofolio: </label>
                              <select id="ketentuan" class="ketentuan form-control @error('ketentuan') is-invalid @enderror mb-2" name="ketentuan">
                                <option value="" selected>-- Pilih ketentuan program --</option>
                                <option value="Ya" @if(old('ketentuan')=='Ya' ) selected @endif>Ya</option>
                                <option value="Tidak" @if(old('ketentuan')=='Tidak' ) selected @endif>Tidak</option>
                              </select>
                              <span class="error-message" id="ketentuan_error" style="display: none; color: red;">Field ini harus diisi!</span>

                              <label for="portofolio" class="col-form-label">Portofolio: </label>
                              <select id="id_portofolios" class="id_portofolio form-control" name="id_portofolio" disabled>
                                <option value="" selected>-- Pilih Portofolio --</option>
                                {{-- @foreach ($portofolios as $portofolio)
                                <option value=
                                <.?=$portofolio->id ?>
                                >{{ $portofolio->nama_portofolio }}</option>
                                @endforeach --}}
                              </select>

                            </div>
                          </div>
                          <div class="modal-footer bg-whitesmoke br">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal" id="closeProgram2">Close</button>
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
                          <th scope="col">Nama Program</th>
                          <th scope="col">Kode Program</th>
                          <th scope="col">Role</th>
                          <th scope="col">Portofolio</th>
                          <th scope="col">Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php $i=1 ?>
                        @foreach ($program as $admins)
                        <tr>
                          <th scope="row">{{$i++}}</th>
                          <td>{{ $admins ->nama_program}}</td>
                          <td>{{ $admins ->kode_program}}</td>
                          <td>{{ $admins ->role}}</td>
                          <td>{{ $portofolio_id[$admins ->id_portofolio] ?? 'Portofolio tidak dipilih'}}</td>
                          <td>
                            {{-- UPDATE PROGRAM --}}
                            <a class="btn btn-sm btn-success btn-sm rounded-0" data-toggle="modal" data-target="#editProgramModal-{{$admins->id}}" style="color: white" 
                            ><i class="fa fa-edit"></i></a>

                            {{-- MODAL EDIT --}}
                            <div class="modal fade" tabindex="-1" role="dialog" id="editProgramModal-{{$admins->id}}" data-backdrop="static">
                              <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title">Ubah Program</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="closeProgram1">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                  </div>
                                  <form id="programUpdateForm" class="form-validation" action="{{route('admin.updateProgram', [$admins->id])}}" method="POST">
                                  @csrf
                                    <div class="modal-body">
                                      <div class="form-group">
                                        <label for="nama_program" class="col-form-label">Nama Program: </label>
                                        <input type="text" id="nama_program_update" name="nama_program" class="form-control" value="{{ $admins->nama_program }}" required>
                                        <span id="nama_program_update_error" style="display: none; color: red;">Field Nama harus diisi!</span>
  
                                        <label for="kode" class="col-form-label">Kode Program: </label>
                                        <input type="text" id="kode_program_update" name="kode_program" class="form-control" value="{{ $admins->kode_program }}" required>
                                        <span class="error-message" id="error_kode_program_update" style="display: none; color: red;">Field Kode Program harus diisi!</span>
  
                                        <label for="role" class="col-form-label">Role: </label>
                                        <select class="role form-control" name="role" required>
                                          <option value="{{$admins->role}}" selected>{{$admins->role}}</option>
                                          @foreach ($roles as $role)
                                              @if ($role->nama_role !== $admins->role)
                                                  <option value="{{ $role->nama_role }}">{{ $role->nama_role }}</option>
                                              @endif
                                          @endforeach
                                        </select>
                                        <span id="role_error" style="display: none; color: red;">Field Role harus diisi!</span>
                                        
                                        <label for="id_portofolio_edit" class="col-form-label">Portofolio: </label>
                                        <select class="id_portofolio_edit form-control" name="id_portofolio" id="id_portofolio_edit">
                                          <option value="" {{ $admins->id_portofolio == "" ? 'selected' : '' }}>-- Pilih Portofolio --</option>
                                          @foreach ($portofolios as $portofolio)
                                            @if ($admins->id_portofolio !== "")
                                            <option value="{{ $portofolio->id }}" {{ $admins->id_portofolio == $portofolio->id ? 'selected' : '' }}>
                                              {{ $portofolio->nama_portofolio }}
                                            </option>
                                            @endif
                                          @endforeach
                                        </select>
                                        <p style="font-size: 8pt">**tidak wajib dipilih</p>

                                      </div>
                                    </div>
                                    <div class="modal-footer bg-whitesmoke br">
                                      <button type="button" class="btn btn-secondary" data-dismiss="modal" id="closeUpdateProgram">Close</button>
                                      <button type="submit" class="btn btn-primary" value="Simpan Data">Save changes</button>
                                    </div>
                                  </form>
                                </div>
                              </div>
                            </div>

                            {{-- DELETE PROGRAM --}}
                            <a class="btn btn-sm btn-danger btn-sm rounded-0" 
                            style="color: white"
                            data-toggle="modal" data-target="#deleteProgramModal{{ $admins->id }}"
                            ><i class="fa fa-trash"></i></a>

                            {{-- MODAL DELETE --}}
                            <div class="modal fade" tabindex="-1" role="dialog" id="deleteProgramModal{{ $admins->id }}" data-backdrop="static">
                                <div class="modal-dialog" role="document">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <h5 class="modal-title">Hapus Program</h5>
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="closeProgram1">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                    </div>
                                    @csrf
                                      <div class="modal-body">
                                        Pilih "Delete" dibawah ini jika Anda yakin menghapus Program yang dipilih.
                                      </div>
                                      <div class="modal-footer bg-whitesmoke br">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal" id="closeProgram2">Cancel</button>
                                        <a class="btn btn-danger" href="{{ route('admin.deleteProgram', [$admins->id]) }}" value="Delete">Delete</a>
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
                "targets": [4], // 4th column (Action)
                "searchable": false, // Disable searching for this column
                "orderable": false,
            }
        ]
    });
});
</script>

<script>
  document.addEventListener('DOMContentLoaded', function () {
    // Mendapatkan elemen dropdown ketentuan dan field persentase
    var ketentuanDropdown = document.getElementById('ketentuan');
    var persentaseInput = document.getElementById('id_portofolios');
    let nilaiAwalInput = document.getElementById('nilai_awal');
    let nilaiAkhirInput = document.getElementById('nilai_akhir');
    
    // Menambahkan event listener untuk mengikuti perubahan pada dropdown ketentuan
    ketentuanDropdown.addEventListener('change', function () {
      if (ketentuanDropdown.value === 'Ya') {
        // Jika dipilih "Ya", aktifkan field persentase dan tambahkan event listener
        persentaseInput.removeAttribute('disabled');
      } else {
        // Jika dipilih "Tidak" atau opsi kosong, nonaktifkan field persentase dan hapus event listener
        persentaseInput.setAttribute('disabled', 'disabled');
        persentaseInput.value = ''; // Menghapus nilai input persentase
        nilaiAkhirInput.value = nilaiAwalInput.value;
      }
    });
  });
</script>

<script>
  function getPorto() {
        let roles = document.getElementById("roless").value;

        if (roles != "") {
            $.ajax({
                type: "POST", // Sesuaikan dengan metode HTTP yang digunakan oleh rute Anda
                headers: {
                    'Accept': 'application/json',
                    'Content-Type': 'application/x-www-form-urlencoded',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                url: '{{ route("admin.getPorto") }}', // Ganti dengan rute yang sesuai untuk mendapatkan program berdasarkan portofolio
                data: {
                    role: roles
                },
                success: function (response) {
                    // Mengisi ulang dropdown Program dengan data yang diterima dari server
                    let portofolioSelect = document.getElementById("id_portofolios");
                    portofolioSelect.innerHTML = "<option value=''>-- Pilih Nama Portofolio --</option>";
                    portofolioSelect.innerHTML += response;
                    console.log(portofolioSelect)
                },
            });
        }
    }
</script>
@endpush
