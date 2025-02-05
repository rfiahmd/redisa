<?php
$title = 'Data Desa » ' . Str::ucfirst(Auth::user()->nama_lengkap);
$breadcrumb = ' Verifikator';
?>

@extends('layout.template')

@section('content')
  <div class="card">
    <div class="card-header">
      <h3>Data Jenjang Pendidikan</h3>
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
              <label class="text-label form-label required">Nama Jenjang Pendidikan</label>
              <div class="input-group">
                <span class="input-group-text"> <i class="fa-solid fa-location-dot"></i></span>
                <input type="text" name="pendidikan" class="form-control" placeholder="Masukkan Nama Jenjang Pendidikan.." required>
              </div>
              <div class="invalid-feedback">Masukkan Nama Jenjang Pendidikan</div>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
            <button type="button" class="btn btn-danger light" data-bs-dismiss="modal">Cancel</button>
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
              <th>Nama Jenjang Pendidikan</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>1</td>
              <td>jeki seryodi</td>
              <td>
                <div class="d-flex">
                  <a role="button" class="btn btn-primary shadow btn-xs sharp me-1" data-bs-toggle="offcanvas"
                    data-bs-target="#offcanvasEdit" aria-controls="offcanvasRight"><i class="fas fa-pencil-alt"></i></a>
                  {{-- offcanvas edit --}}
                  <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasEdit"
                    aria-labelledby="offcanvasRightLabel">
                    <div class="offcanvas-header">
                      <h5 class="offcanvas-title" id="offcanvasRightLabel">Form Edit</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body">
                      <form class="form-valide-with-icon needs-validation" novalidate>
                        <div class="mb-3 vertical-radius">
                          <label class="text-label form-label required">Nama Jenjang Pendidikan</label>
                          <div class="input-group">
                            <span class="input-group-text"> <i class="fa-solid fa-location-dot"></i></span>
                            <input type="text" name="pendidikan" class="form-control" placeholder="Masukkan Nama Jenjang Pendidikan.."
                              required>
                          </div>
                          <div class="invalid-feedback">Masukkan Nama Jenjang Pendidikan</div>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <button type="button" class="btn btn-danger light" data-bs-dismiss="modal">Cancel</button>
                      </form>
                    </div>
                  </div>
                  <a href="javascript:void(0);" class="btn btn-danger shadow btn-xs sharp"><i
                      class="fas fa-trash-alt"></i></a>
                </div>
              </td>
            </tr>
          </tbody>
          <tfoot>
            <tr>
              <th>#</th>
              <th>Nama Jenjang Pendidikan</th>
              <th>Action</th>
            </tr>
          </tfoot>
        </table>
      </div>
    </div>
  </div>
@endsection
