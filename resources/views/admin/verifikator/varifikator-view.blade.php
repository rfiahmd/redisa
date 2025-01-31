<?php
$title = 'Data Verifikator » ' . Str::ucfirst(Auth::user()->name);
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
              <label class="text-label form-label required" for="validationCustomUsername">Nama</label>
              <div class="input-group validate-username">
                <span class="input-group-text search_icon"> <i class="fa fa-user"></i>
                </span>
                <input type="text" class="form-control br-style" id="validationCustomUsername"
                  placeholder="Masukkan Nama Anda.." required>
                <div class="invalid-feedback">
                  Masukkan Nama Anda
                </div>
              </div>
            </div>
            <div class="mb-3 vertical-radius">
              <label class="text-label form-label required" for="validationCustomUsername">Email</label>
              <div class="input-group validate-username">
                <span class="input-group-text search_icon"> <i class="fa fa-user"></i>
                </span>
                <input type="email" class="form-control br-style" id="validationCustomUsername"
                  placeholder="Masukkan Email Anda.." required>
                <div class="invalid-feedback">
                  Harap Masukkan Email Dengan Benar
                </div>
              </div>
            </div>
            <div class="mb-3 vertical-radius">
              <label class="text-label form-label required" for="validationCustomUsername">Jabatan</label>
              <div class="input-group validate-username">
                <span class="input-group-text search_icon"> <i class="fa fa-user"></i>
                </span>
                <input type="text" class="form-control br-style" id="validationCustomUsername"
                  placeholder="Masukkan Jabatan Anda.." required>
                <div class="invalid-feedback">
                  Masukkan Jabatan Anda
                </div>
              </div>
            </div>
            <div class="mb-3 vertical-radius ">
              <label class="text-label form-label required" for="dz-password">Desa</label>
              <div class="input-group transparent-append  validate-password">
                <select class="multi-select form-control" name="states[]" multiple="multiple">
									<option value="AL">Alabama</option>
									<option value="WY">Wyoming</option>
									<option value="UI">dlf</option>
								</select>
              </div>
            </div>
            <div class="mb-3">
              <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" id="invalidCheck2" required>
                <label class="form-check-label" for="invalidCheck2">
                  Check Me out
                </label>
              </div>
            </div>
            <button type="submit" class="btn me-2 btn-primary">Submit</button>
            <button type="submit" class="btn btn-danger light">Cancel</button>
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
