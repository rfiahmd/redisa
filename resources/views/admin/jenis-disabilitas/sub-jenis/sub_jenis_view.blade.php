<?php
$title = 'Jenis Disabilitas » Sub Jenis Disabilitas';
$breadcrumb = 'Sub Jenis Disabilitas';
?>

@extends('layout.template')

@section('content')
  <div class="card">
    <div class="card-header">
      <h3>Jenis Disabilitas : Fisik</h3>
      <div class="d-flex justify-content-between">
        <button class="btn btn-secondary" style="margin-right: 10px" type="button" onclick="history.back()">Kembali</button>
        <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight"
          aria-controls="offcanvasRight">
          + Tambah Data
        </button>
      </div>

      {{-- offcanvas --}}
      <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
        <div class="offcanvas-header">
          <h5 class="offcanvas-title" id="offcanvasRightLabel">Form Tambah</h5>
          <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
          <form class="form-valide-with-icon needs-validation" novalidate>
            <div class="mb-3 vertical-radius">
              <label class="text-label form-label required">Nama Sub Jenis</label>
              <div class="input-group">
                <span class="input-group-text"> <i class="fa fa-wheelchair"></i></span>
                <input type="text" class="form-control" placeholder="Contoh: Lumpuh, Tuli, dll." required>
              </div>
              <div class="invalid-feedback">Masukkan Nama Sub Jenis Disabilitas</div>
            </div>

            <div class="mb-3 vertical-radius">
              <label class="text-label form-label">Keterangan</label>
              <div class="input-group">
                <span class="input-group-text"><i class="fa fa-info-circle"></i></span>
                <textarea class="form-control" placeholder="Keterangan tambahan" rows="3"></textarea>
              </div>
              <div class="invalid-feedback">Masukkan Keterangan Sub Jenis</div>
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
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
              <th>Sub Jenis</th>
              <th>Keterangan</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>1</td>
              <td>Amputasi</td>
              <td>Kehilangan anggota tubuh</td>
              <td>
                <div class="d-flex">
                  <a href="javascript:void(0);" class="btn btn-primary shadow btn-xs sharp me-1"><i
                      class="fas fa-pencil-alt"></i></a>
                  <a href="javascript:void(0);" class="btn btn-danger shadow btn-xs sharp"><i
                      class="fas fa-trash-alt"></i></a>
                </div>
              </td>
            </tr>
            <tr>
              <td>2</td>
              <td>Lumpuh</td>
              <td>Tidak bisa berjalan</td>
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
              <th>Sub Jenis</th>
              <th>Keterangan</th>
              <th>Action</th>
            </tr>
          </tfoot>
        </table>
      </div>
    </div>
  </div>
@endsection
