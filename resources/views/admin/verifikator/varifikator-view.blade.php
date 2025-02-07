<?php
$title = 'Data Verifikator » ' . Str::ucfirst(Auth::user()->getRoleNames()->first());
$breadcrumb = ' Verifikator';
?>

@extends('layout.template')

@section('content')
  <div class="card">
    <div class="card-header">
      <h3>Data Verifikator</h3>
      <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight"
        aria-controls="offcanvasRight">Tambah Data</button>
      {{-- offcanvas --}}
      <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
        <div class="offcanvas-header">
          <h5 class="offcanvas-title" id="offcanvasRightLabel">Form Tambah</h5>
          <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
          <form class="form-valide-with-icon needs-validation" novalidate>
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

            <div class="mb-3">
              <div class="form-check">
                <input class="form-check-input" type="checkbox" id="invalidCheck2" required>
                <label class="form-check-label" for="invalidCheck2">Check Me out</label>
              </div>
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
            <button type="button" class="btn btn-danger light">Cancel</button>
          </form>
        </div>
      </div>
    </div>
    <div class="card-body">
      <div class="table-resonsive">
        <table id="example" class="display min-w850">
          <thead>
            <tr>
              <th>#</th>
              <th>Nama</th>
              <th>Email</th>
              <th>Jabatan</th>
              <th>Penjab Desa</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>1</td>
              <td>jeki seryodi</td>
              <td>System Architect</td>
              <td>Edinburgh</td>
              <td>61</td>
              <td>
                <div class="d-flex">
                  <a href="javascript:void(0);" class="btn btn-primary shadow btn-xs sharp me-1"><i
                      class="fas fa-pencil-alt"></i></a>
                  <a href="javascript:void(0);" class="btn btn-danger shadow btn-xs sharp"><i
                      class="fas fa-trash-alt"></i></a>
                </div>
              </td>
            </tr>
          </tbody>
          <tfoot>
            <tr>
              <th>#</th>
              <th>Nama</th>
              <th>Email</th>
              <th>Jabatan</th>
              <th>Penjab Desa</th>
              <th>Action</th>
            </tr>
          </tfoot>
        </table>
      </div>
    </div>
  </div>
@endsection
