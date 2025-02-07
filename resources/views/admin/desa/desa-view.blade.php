<?php
$title = 'Data Desa » ' . Str::ucfirst(Auth::user()->getRoleNames()->first());
$breadcrumb = ' Data Desa';
?>

@extends('layout.template')

@section('content')
  <div class="card">
    <div class="card-header">
      <h3>Data Desa</h3>
      <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight"
        aria-controls="offcanvasRight">Tambah Data</button>
      {{-- offcanvas --}}
      <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
        <div class="offcanvas-header">
          <h5 class="offcanvas-title" id="offcanvasRightLabel">Form Tambah</h5>
          <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
          <form class="form-valide-with-icon needs-validation" method="POST" action="{{ route('desa.store') }}">
            @csrf
            <div class="mb-3 vertical-radius">
              <label class="text-label form-label required">Nama Desa</label>
              <div class="input-group">
                <span class="input-group-text"> <i class="fa-solid fa-location-dot"></i></span>
                <input type="text" name="desa" class="form-control" placeholder="Masukkan Nama Desa.." required>
              </div>
              <div class="invalid-feedback">Masukkan Nama Desa</div>
            </div>
            <div class="mb-3 vertical-radius">
              <label class="text-label form-label required">Kecamatan Desa</label>
              <div class="input-group">
                <span class="input-group-text"> <i class="fa-solid fa-location-dot"></i></span>
                <input type="text" name="kecamatan" class="form-control" placeholder="Masukkan Kecamatan Desa.."
                  required>
              </div>
              <div class="invalid-feedback">Masukkan Nama Kecamatan</div>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
            <button type="button" class="btn btn-danger light" data-bs-dismiss="offcanvas">Cancel</button>
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
              <th>Nama Desa</th>
              <th>Kecamatan</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($desa as $get)
              <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $get->nama_desa }}</td>
                <td>{{ $get->nama_kecamatan }}</td>
                <td>
                  <div class="d-flex">
                    <a role="button" class="btn btn-primary shadow btn-xs sharp me-1" data-bs-toggle="offcanvas"
                      data-bs-target="#offcanvasEdit{{ $get->kode_desa }}" aria-controls="offcanvasRight"><i
                        class="fas fa-pencil-alt"></i></a>
                    {{-- offcanvas edit --}}
                    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasEdit{{ $get->kode_desa }}"
                      aria-labelledby="offcanvasRightLabel">
                      <div class="offcanvas-header">
                        <h5 class="offcanvas-title" id="offcanvasRightLabel">Form Edit</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                      </div>
                      <div class="offcanvas-body">
                        <form class="form-valide-with-icon needs-validation" method="POST"
                          action="{{ route('desa.update', $get->kode_desa) }}">
                          @csrf
                          <div class="mb-3 vertical-radius">
                            <label class="text-label form-label required">Nama Desa</label>
                            <div class="input-group">
                              <span class="input-group-text"> <i class="fa-solid fa-location-dot"></i></span>
                              <input type="text" name="desa" value="{{ $get->nama_desa }}" class="form-control"
                                placeholder="Masukkan Nama Desa.." required>
                            </div>
                            <div class="invalid-feedback">Masukkan Nama Desa</div>
                          </div>
                          <div class="mb-3 vertical-radius">
                            <label class="text-label form-label required">Kecamatan Desa</label>
                            <div class="input-group">
                              <span class="input-group-text"> <i class="fa-solid fa-location-dot"></i></span>
                              <input type="text" value="{{ $get->nama_kecamatan }}" name="kecamatan"
                                class="form-control" placeholder="Masukkan Kecamatan Desa.." required>
                            </div>
                            <div class="invalid-feedback">Masukkan Nama Kecamatan</div>
                          </div>
                          <button type="submit" class="btn btn-primary">Submit</button>
                          <button type="button" class="btn btn-danger light" data-bs-dismiss="modal">Cancel</button>
                        </form>
                      </div>
                    </div>
                    {{-- <a href="{{ route('desa.delete', $get->kode_desa) }}" class="btn btn-danger shadow btn-xs sharp"><i
                        class="fas fa-trash-alt"></i></a> --}}
                    <a href="javascript:void(0);" class="btn btn-danger shadow btn-xs sharp"
                      onclick="deleteEntity('desa', '{{ $get->kode_desa }}', '{{ $get->nama_desa }}', null, null)">
                      <i class="fas fa-trash-alt"></i>
                    </a>
                  </div>
                </td>
              </tr>
            @endforeach
          </tbody>
          <tfoot>
            <tr>
              <th>#</th>
              <th>Nama Desa</th>
              <th>Kecamatan</th>
              <th>Action</th>
            </tr>
          </tfoot>
        </table>
      </div>
    </div>
  </div>
@endsection
