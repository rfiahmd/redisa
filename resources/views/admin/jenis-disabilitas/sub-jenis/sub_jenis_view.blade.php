<?php
$title = 'Jenis Disabilitas » Sub Jenis Disabilitas » ' . Str::ucfirst(Auth::user()->getRoleNames()->first());
$breadcrumb = 'Sub Jenis Disabilitas';
?>

@extends('layout.template')

@section('content')
  <div class="card">
    <div class="card-header">
      <h3>Jenis Disabilitas : {{ $jenisDisabilitas->nama_jenis }}</h3>
      <div class="d-flex justify-content-between">
        <a class="btn btn-secondary me-2" href="{{ route('jenis.index') }}">Kembali</a>
        <button class="btn btn-primary" data-bs-toggle="offcanvas" data-bs-target="#offcanvasTambah">
          + Tambah Data
        </button>
      </div>
    </div>

    {{-- Offcanvas Tambah Data --}}
    <div class="offcanvas offcanvas-end" id="offcanvasTambah">
      <div class="offcanvas-header">
        <h5 class="offcanvas-title">Tambah Sub Jenis Disabilitas</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
      </div>
      <div class="offcanvas-body">
        <!-- Form Tambah Sub Jenis -->
        <form action="{{ route('subjenis.store', $jenisDisabilitas) }}" method="POST"
          class="form-valide-with-icon needs-validation" novalidate>
          @csrf
          <div class="mb-3 vertical-radius">
            <label class="text-label form-label required">Nama Sub Jenis</label>
            <div class="input-group">
              <span class="input-group-text"><i class="fa fa-wheelchair"></i></span>
              <input type="text" class="form-control @error('nama_sub_jenis') is-invalid @enderror"
                name="nama_sub_jenis" placeholder="Contoh: Fisik, Sensorik, dll." required>
            </div>
            @error('nama_sub_jenis')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          <div class="mb-3 vertical-radius">
            <label class="text-label form-label">Keterangan</label>
            <div class="input-group">
              <span class="input-group-text"><i class="fa fa-info-circle"></i></span>
              <textarea class="form-control @error('keterangan') is-invalid @enderror" name="keterangan"
                placeholder="Keterangan tambahan" rows="3"></textarea>
            </div>
            @error('keterangan')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          <button type="submit" class="btn btn-primary">Submit</button>
        </form>

      </div>
    </div>

    <div class="card-body">
      <div class="table-responsive">
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
            @foreach ($data as $subJenis)
              <tr>
                <td>{{ $loop->iteration }}.</td>
                <td>{{ $subJenis->nama_sub_jenis }}</td>
                <td>{{ $subJenis->keterangan ?? '-' }}</td>
                <td>
                  <div class="d-flex">
                    <a class="btn btn-primary shadow btn-xs sharp me-1" data-bs-toggle="offcanvas"
                      data-bs-target="#offcanvasEdit-{{ $subJenis->id }}">
                      <i class="fas fa-pencil-alt"></i>
                    </a>
                    <a href="javascript:void(0);" class="btn btn-danger shadow btn-xs sharp"
                      onclick="deleteEntity('subjenis', '{{ $subJenis->token_sub_jenis }}', '{{ $subJenis->nama_sub_jenis }}', '{{ $jenisDisabilitas->id }}')">
                      <i class="fas fa-trash-alt"></i>
                    </a>
                  </div>
                </td>
              </tr>

              <!-- Offcanvas Edit Sub Jenis -->
              <div class="offcanvas offcanvas-end" id="offcanvasEdit-{{ $subJenis->id }}">
                <div class="offcanvas-header">
                  <h5 class="offcanvas-title">Edit Sub Jenis Disabilitas</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
                </div>
                <div class="offcanvas-body">
                  <form
                    action="{{ route('subjenis.update', ['jenisDisabilitas' => $subJenis->jenisDisabilitas->id, 'subJenisDisabilitas' => $subJenis->id]) }}"
                    method="POST" class="needs-validation" novalidate>
                    @csrf
                    @method('PUT')

                    <div class="mb-3 vertical-radius">
                      <label class="text-label form-label required">Nama Sub Jenis</label>
                      <div class="input-group">
                        <span class="input-group-text"><i class="fa fa-wheelchair"></i></span>
                        <input type="text" class="form-control @error('nama_sub_jenis') is-invalid @enderror"
                          name="nama_sub_jenis" value="{{ old('nama_sub_jenis', $subJenis->nama_sub_jenis) }}" required>
                      </div>
                      @error('nama_sub_jenis')
                        <div class="invalid-feedback">{{ $message }}</div>
                      @enderror
                    </div>

                    <div class="mb-3 vertical-radius">
                      <label class="text-label form-label">Keterangan</label>
                      <div class="input-group">
                        <span class="input-group-text"><i class="fa fa-info-circle"></i></span>
                        <textarea class="form-control @error('keterangan') is-invalid @enderror" name="keterangan" rows="3">{{ old('keterangan', $subJenis->keterangan) }}</textarea>
                      </div>
                      @error('keterangan')
                        <div class="invalid-feedback">{{ $message }}</div>
                      @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">Update</button>
                  </form>

                </div>
              </div>
            @endforeach
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
