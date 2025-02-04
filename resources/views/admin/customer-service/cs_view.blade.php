<?php
$title = 'Customer Service » ' . Str::ucfirst(Auth::user()->nama_lengkap);
$breadcrumb = 'Customer Service';
?>

@extends('layout.template')

@section('content')
  <div class="card">
    <div class="card-body">
      <div class="default-tab">
        <ul class="nav nav-tabs" role="tablist">
          <li class="nav-item">
            <a class="nav-link active" data-bs-toggle="tab" href="#admin">
              <i class="la la-user-shield me-2 text-primary"></i> Admin
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-success" data-bs-toggle="tab" href="#verifikator">
              <i class="la la-user-check me-2 text-success"></i> Verifikator
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-warning" data-bs-toggle="tab" href="#petugasdesa">
              <i class="la la-user-friends me-2 text-warning"></i> Petugas Desa
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-danger" data-bs-toggle="tab" href="#kadis">
              <i class="la la-user-tie me-2 text-danger"></i> Kepala Dinas
            </a>
          </li>
          <li class="nav-item ms-auto mb-2 me-3">
            <a class="btn btn-primary" href="javascript:void(0);" id="btnTambahCS" data-bs-toggle="offcanvas"
              data-bs-target="#offcanvasTambahCS">+ Tambah CS</a>
          </li>
        </ul>
        <div class="tab-content">
          <div class="tab-pane fade show active" id="admin" role="tabpanel">
            <div class="pt-4">
              <div class="table-responsive table-hover">
                <table id="example3" class="display min-w850 mb-4 border-bottom border-top">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Nama</th>
                      <th>Email</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td>
                        <a href="javascript:void(0);" class="btn btn-primary shadow btn-xs sharp me-1"><i
                            class="fas fa-pencil-alt"></i></a>
                        <a href="javascript:void(0);" class="btn btn-danger shadow btn-xs sharp"><i
                            class="fas fa-trash-alt"></i></a>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <div class="tab-pane fade" id="verifikator">
            <div class="pt-4">
              <div class="table-responsive table-hover">
                <table id="example3" class="display min-w850 mb-4 border-bottom border-top">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Nama</th>
                      <th>Email</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td>
                        <a href="javascript:void(0);" class="btn btn-primary shadow btn-xs sharp me-1"><i
                            class="fas fa-pencil-alt"></i></a>
                        <a href="javascript:void(0);" class="btn btn-danger shadow btn-xs sharp"><i
                            class="fas fa-trash-alt"></i></a>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <div class="tab-pane fade" id="petugasdesa">
            <div class="pt-4">
              <div class="table-responsive table-hover">
                <table id="example3" class="display min-w850 mb-4 border-bottom border-top">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Nama</th>
                      <th>Email</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td>
                        <a href="javascript:void(0);" class="btn btn-primary shadow btn-xs sharp me-1"><i
                            class="fas fa-pencil-alt"></i></a>
                        <a href="javascript:void(0);" class="btn btn-danger shadow btn-xs sharp"><i
                            class="fas fa-trash-alt"></i></a>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <div class="tab-pane fade" id="kadis">
            <div class="pt-4">
              <div class="table-responsive table-hover">
                <table id="example3" class="display min-w850 mb-4 border-bottom border-top">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Nama</th>
                      <th>Email</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td>
                        <a href="javascript:void(0);" class="btn btn-primary shadow btn-xs sharp me-1"><i
                            class="fas fa-pencil-alt"></i></a>
                        <a href="javascript:void(0);" class="btn btn-danger shadow btn-xs sharp"><i
                            class="fas fa-trash-alt"></i></a>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  {{-- offcanvas tambah cs --}}
  <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasTambahCS" aria-labelledby="offcanvasLabel">
    <div class="offcanvas-header">
      <h5 class="offcanvas-title" id="offcanvasLabel">Tambah CS</h5>
      <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
      <!-- Form dengan action dinamis -->
      <form id="formTambahCS" method="POST" class="form-valide-with-icon needs-validation" novalidate>
        @csrf
        <input type="hidden" name="role" id="role"> <!-- Role disimpan di sini -->

        <div class="mb-3 vertical-radius">
              <label class="text-label form-label required">Nama</label>
              <div class="input-group">
                <span class="input-group-text"> <i class="fa fa-user"></i></span>
                <input type="text" class="form-control" placeholder="Masukkan Nama Anda.." required>
              </div>
              <div class="invalid-feedback">Masukkan Nama Anda</div>
            </div>

            <div class="mb-3 vertical-radius">
              <label class="text-label form-label required">Email</label>
              <div class="input-group">
                <span class="input-group-text"> <i class="fa fa-envelope"></i></span>
                <input type="email" class="form-control" placeholder="Masukkan Email Anda.." required>
              </div>
              <div class="invalid-feedback">Harap Masukkan Email Dengan Benar</div>
            </div>

        <!-- Tambahan khusus untuk Verifikator -->
        <div id="extraVerifikator" style="display: none;">
          <div class="mb-3 vertical-radius">
            <label class="text-label form-label required">Jabatan</label>
            <div class="input-group">
              <span class="input-group-text"> <i class="fa fa-briefcase"></i></span>
              <input type="text" class="form-control" placeholder="Masukkan Jabatan Anda.." required>
            </div>
            <div class="invalid-feedback">Masukkan Jabatan Anda</div>
          </div>

          <!-- Wrapper untuk Select Desa -->
          <div id="desa-container">
            <div class="mb-3 vertical-radius desa-group">
              <label class="text-label form-label required">Desa</label>
              <div class="input-group">
                <select class="form-control" name="desa[]">
                  <option value="AL">Alabama</option>
                  <option value="WY">Wyoming</option>
                  <option value="UI">dlf</option>
                </select>
                <button type="button" class="btn btn-danger remove-desa ms-2 d-none">Hapus</button>
              </div>
            </div>
          </div>
          <!-- Tombol Tambah Desa -->
          <button type="button" id="tambah-desa" class="btn btn-success">Tambah Desa</button>
        </div>


        <button type="submit" class="btn btn-primary w-100 mt-3">Simpan</button>
      </form>
    </div>
  </div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

@endsection
