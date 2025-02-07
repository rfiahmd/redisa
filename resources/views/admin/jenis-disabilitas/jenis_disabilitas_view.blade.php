<?php
$title = 'Jenis Disabilitas » ' . Str::ucfirst(Auth::user()->getRoleNames()->first());
$breadcrumb = 'Jenis Disabilitas';
?>

@extends('layout.template')

@section('content')
  <div class="card">
    <div class="card-header">
      <h3>Data Jenis Disabilitas</h3>
      <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight"
        aria-controls="offcanvasRight">+ Tambah Data</button>

      {{-- offcanvas --}}
      <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
        <div class="offcanvas-header">
          <h5 class="offcanvas-title" id="offcanvasRightLabel">Form Tambah</h5>
          <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
          <form action="{{ route('jenis.store') }}" method="POST" class="form-valide-with-icon needs-validation"
            novalidate>
            @csrf
            <div class="mb-3 vertical-radius">
              <label class="text-label form-label required">Nama Jenis</label>
              <div class="input-group">
                <span class="input-group-text"> <i class="fa fa-wheelchair"></i></span>
                <input type="text" class="form-control" name="nama_jenis" placeholder="Contoh: Fisik, Sensorik, dll."
                  required>
              </div>
              <div class="invalid-feedback">Masukkan Nama Jenis Disabilitas</div>
            </div>

            <div class="mb-3 vertical-radius">
              <label class="text-label form-label">Keterangan</label>
              <div class="input-group">
                <span class="input-group-text"><i class="fa fa-info-circle"></i></span>
                <textarea class="form-control" name="keterangan" placeholder="Keterangan tambahan" rows="3"></textarea>
              </div>
              <div class="invalid-feedback">Masukkan Keterangan Disabilitas</div>
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
          </form>
        </div>
      </div>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table id="example" class="display min-w850">
          <thead>
            <tr>
              <th>#</th>
              <th>Jenis Disabilitas</th>
              <th>Keterangan</th>
              <th>Sub Jenis</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($data as $index => $jenis)
              <tr>
                <td>{{ $index + 1 }}.</td>
                <td>{{ $jenis->nama_jenis }}</td>
                <td>{{ $jenis->keterangan ?? '-' }}</td>
                <td>
                  @php
                    $subJenisList = $jenis->subJenis->take(3);
                  @endphp

                  @if ($subJenisList->isEmpty())
                    <a href="{{ route('subjenis.index', $jenis) }}" class="btn btn-link"
                      style="font-size: 12px; margin: 0; padding: 0;">+ Tambah Sub Jenis</a>
                  @else
                    @foreach ($subJenisList->take(2) as $subJenis)
                      {{ $subJenis->nama_sub_jenis }}
                      @if (!$loop->last)
                        ,
                      @endif
                    @endforeach

                    @if ($subJenisList->count() > 2)
                      , . . .
                    @endif
                  @endif
                </td>
                <td>
                  <div class="d-flex">
                    <a class="btn btn-info shadow btn-xs sharp me-1" href="{{ route('subjenis.index', $jenis) }}">
                      <i class="fas fa-eye"></i>
                    </a>
                    <a class="btn btn-primary shadow btn-xs sharp me-1" data-bs-toggle="offcanvas"
                      data-bs-target="#offcanvasEdit{{ $jenis->id }}"><i class="fas fa-pencil-alt"></i></a>
                    <a href="javascript:void(0);" class="btn btn-danger shadow btn-xs sharp"
                      onclick="deleteEntity('jenis', '{{ $jenis->token_jenis }}', '{{ $jenis->nama_jenis }}', null, '{{ $jenis->subJenis->count() > 0 ? 'true' : 'false' }}')">
                      <i class="fas fa-trash-alt"></i>
                    </a>
                    </a>
                  </div>
                </td>
              </tr>
              {{-- Offcanvas untuk Edit --}}
              <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasEdit{{ $jenis->id }}"
                aria-labelledby="offcanvasRightLabel">
                <div class="offcanvas-header">
                  <h5 class="offcanvas-title" id="offcanvasRightLabel">Form Edit Jenis Disabilitas</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                  <form action="{{ route('jenis.update', ['jenisDisabilitas' => $jenis->id]) }}" method="POST"
                    class="needs-validation" novalidate>
                    @csrf
                    @method('PUT')
                    <div class="mb-3 vertical-radius">
                      <label class="text-label form-label required">Nama Jenis</label>
                      <div class="input-group">
                        <span class="input-group-text"> <i class="fa fa-wheelchair"></i></span>
                        <input type="text" class="form-control" name="nama_jenis" value="{{ $jenis->nama_jenis }}"
                          required>
                      </div>
                      <div class="invalid-feedback">Masukkan Nama Jenis Disabilitas</div>
                    </div>

                    <div class="mb-3 vertical-radius">
                      <label class="text-label form-label">Keterangan</label>
                      <div class="input-group">
                        <span class="input-group-text"><i class="fa fa-info-circle"></i></span>
                        <textarea class="form-control" name="keterangan" rows="3">{{ $jenis->keterangan }}</textarea>
                      </div>
                      <div class="invalid-feedback">Masukkan Keterangan Disabilitas</div>
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
              <th>Jenis Disabilitas</th>
              <th>Keterangan</th>
              <th>Sub Jenis</th>
              <th>Action</th>
            </tr>
          </tfoot>
        </table>
      </div>
    </div>
  </div>
@endsection
