<?php
$title = 'Data Verifikator » ' . Str::ucfirst(Auth::user()->nama_lengkap);
$breadcrumb = ' Verifikator';
?>

@extends('layout.template')

@section('content')
  <div class="card">
    <div class="card-header">
      <h3>Data Disabilitas</h3>
      <a class="btn btn-primary" href="{{ route('disabilitas.create') }}">Tambah Data</a>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table id="example" class="display min-w850">
          <thead>
            <tr>
              <th>#</th>
              <th>NIK</th>
              <th>Nama</th>
              <th>Usia</th>
              <th>Tingkat Kecacatan</th>
              <th>Status</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($disabilitas as $get)
              <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $get->nik }}</td>
                <td>
                  <strong>{{ $get->nama }}</strong><br>
                  <a role="button" data-bs-toggle="modal" data-bs-target="#detail{{ $get->nik }}"
                    class="text-primary">Selengkapnya...</a>
                </td>
                <td>{{ $get->usia }} tahun</td>
                <td>{{ $get->tingkat_disabilitas }}</td>
                <td>Lobuk</td>
                <td>
                  <div class="d-flex">
                    <a href="{{ route('disabilitas.edit') }}" class="btn btn-primary shadow btn-xs sharp me-1">
                      <i class="fas fa-pencil-alt"></i>
                    </a>
                    <a href="javascript:void(0);" class="btn btn-danger shadow btn-xs sharp">
                      <i class="fas fa-trash-alt"></i>
                    </a>
                  </div>
                </td>
              </tr>

              {{-- Modal Detail (Tanpa Tabel) --}}
              <div class="modal fade" id="detail{{ $get->nik }}" tabindex="-1"
                aria-labelledby="modalLabel{{ $get->nik }}" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                  <div class="modal-content">
                    <div class="modal-header bg-primary">
                      <h3 class="modal-title text-light" id="modalLabel{{ $get->nik }}">Detail Data
                        {{ $get->nama }}</h3>
                      <button type="button" class="btn-close text-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <div class="card shadow">
                        <div class="card-body">
                          <div class="row">
                            <div class="col-md-6">
                              <p><strong>NIK:</strong> {{ $get->nik }}</p>
                              <p><strong>Alamat:</strong> {{ $get->alamat }}</p>
                              <p><strong>Usia:</strong> {{ $get->usia }} Tahun</p>
                              <p><strong>Jenis Kelamin:</strong> {{ $get->kelamin }}</p>
                            </div>
                            <div class="col-md-6">
                              <p><strong>Tingkat Cacat:</strong> {{ $get->tingkat_disabilitas }}</p>
                              <p><strong>Jenis Cacat:</strong> {{ $get->jenisDisabilitas->nama_jenis }},
                                {{ $get->subJenisDisabilitas->nama_sub_jenis }}</p>
                              <p><strong>Jenjang Pendidikan:</strong>
                                @if ($get->pendidikan == 'tidak')
                                  Tidak Dalam Pendidikan
                                @else
                                  {{ $get->pendidikan }}
                                @endif
                              </p>
                              <p><strong>Keterangan:</strong>
                                @if ($get->keterangan == null)
                                  Tidak Ada Keterangan
                                @else
                                  {{ $get->keterangan }}
                                @endif
                              </p>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    </div>
                  </div>
                </div>
              </div>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
@endsection
