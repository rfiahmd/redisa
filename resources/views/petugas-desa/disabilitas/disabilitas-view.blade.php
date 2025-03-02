<?php
$title = 'Data Disabilitas » ' . Str::ucfirst(Auth::user()->nama_lengkap);
$breadcrumb = 'Data Disabilitas';
?>

@extends('layout.template')

@section('content')
  @unless (auth()->user()->hasRole(['verifikator', 'petugasdesa']))
    <div class="row">
      <div class="col-xl-12">
        <div class="filter cm-content-box box-primary">
          <div class="content-title SlideToolHeader">
            <div class="cpa">
              <i class="fa-sharp fa-solid fa-filter me-2"></i>Filter
            </div>
            <div class="tools">
              <a href="javascript:void(0);" class="expand handle"><i class="fal fa-angle-down"></i></a>
            </div>
          </div>
          <div class="cm-content-body form excerpt">
            <div class="card-body">
              <form method="GET" action="{{ route('disabilitas') }}">
                <div class="row">
                  <div class="col-xl-4 col-sm-6 mb-3 mb-xl-0">
                    <label for="desaFilter" class="form-label">Desa</label>
                    <input class="form-control" list="desaOptions" id="desaFilter" name="desa" placeholder="Cari Desa..."
                      value="{{ request('desa') }}">
                    <datalist id="desaOptions">
                      @foreach ($desaList as $desa)
                        <option value="{{ $desa->nama_desa }}">
                      @endforeach
                    </datalist>
                  </div>
                  <div class="col-xl-4 col-sm-6 mb-3 mb-xl-0">
                    <label for="kecamatanFilter" class="form-label">Kecamatan</label>
                    <input class="form-control" list="kecamatanOptions" id="kecamatanFilter" name="kecamatan"
                      placeholder="Cari Kecamatan..." value="{{ request('kecamatan') }}">
                    <datalist id="kecamatanOptions">
                      @foreach ($kecamatanList as $kecamatan)
                        <option value="{{ $kecamatan->nama_kecamatan }}">
                      @endforeach
                    </datalist>
                  </div>
                  <div class="col-xl-3 col-sm-6 align-self-end">
                    <button class="btn btn-primary me-2" type="submit"><i class="fa fa-filter me-1"></i>Filter</button>
                    <a href="{{ route('disabilitas') }}" class="btn btn-danger light">Remove Filter</a>
                  </div>
                </div>
              </form>

            </div>
          </div>
        </div>
      </div>
    </div>
  @endunless
  <div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
      <h3>Data Disabilitas</h3>
      <div class="d-flex align-items-center">
        <button type="button" class="btn light btn-danger btn-sm me-2" style="padding: 6px 9px;">
          <i class="fas fa-file-pdf" style="font-size: 20px;"></i>
        </button>
        <a href="{{ route('disabilitas.download') }}" class="btn light btn-success btn-sm me-2" style="padding: 6px 9px;">
          <i class="fas fa-file-excel" style="font-size: 20px;"></i>
        </a>
        @if (Auth::user()->hasRole('petugasdesa'))
          <a class="btn btn-primary btn-sm" href="{{ route('disabilitas.create') }}">+ Tambah Data</a>
        @endif
      </div>
    </div>

    <div class="card-body">
      <div class="table-responsive">
        <table id="example" class="display min-w850">
          <thead>
            <tr>
              <th>No</th>
              <th>NIK</th>
              <th>Nama</th>
              <th>Usia</th>
              <th>Tingkat Kecacatan</th>
              @if (!Auth::user()->hasRole('petugasdesa'))
                <th>Desa</th>
              @endif
              <th>Status</th>
              @if (Auth::user()->hasRole('superadmin') || Auth::user()->hasRole('petugasdesa') || Auth::user()->hasRole('verifikator'))
                <th>Action</th>
              @endif
            </tr>
          </thead>
          <tbody>
            @foreach ($disabilitas as $get)
              <tr>
                <td>{{ $loop->iteration }}.</td>
                <td>{{ $get->nik }}</td>
                <td>
                  <strong>{{ $get->nama }}</strong><br>
                  <a role="button" data-bs-toggle="modal" data-bs-target="#detail{{ $get->nik }}"
                    class="text-primary">Selengkapnya...</a>
                </td>
                <td>{{ $get->usia }} tahun</td>
                <td>{{ $get->tingkat_disabilitas }}</td>
                @if (!Auth::user()->hasRole('petugasdesa'))
                  <td>{{ $get->desa->nama_desa }} - {{ $get->desa->nama_kecamatan }}</td>
                @endif
                <td>
                  @if ($get->status == 'diproses')
                    <p><span class="bg-warning text-light px-2" style="border-radius: 5px;">Diproses</span></p>
                  @elseif ($get->status == 'diterima')
                    <p><span class="bg-success text-light px-2" style="border-radius: 5px;">Diterima</span></p>
                  @elseif ($get->status == 'ditolak')
                    <p><span class="bg-danger text-light px-2" style="border-radius: 5px;">Ditolak</span></p>
                  @else
                    <p><span class="bg-info text-light px-2" style="border-radius: 5px;">Direvisi</span></p>
                  @endif
                </td>
                @if (Auth::user()->hasRole('superadmin') || Auth::user()->hasRole('petugasdesa') || Auth::user()->hasRole('verifikator'))
                  <td>
                    <div class="d-flex">
                      @if (Auth::user()->hasRole('superadmin') || Auth::user()->hasRole('petugasdesa'))
                        <a href="{{ route('disabilitas.edit', $get->nik) }}"
                          class="btn btn-primary shadow btn-xs sharp me-1">
                          <i class="fas fa-pencil-alt"></i>
                        </a>
                        <a onclick="deleteEntity('disabilitas', '{{ $get->nik }}', '{{ $get->nama }}', null, null)"
                          class="btn btn-danger shadow btn-xs sharp me-1">
                          <i class="fas fa-trash-alt"></i>
                        </a>
                        @if ($get->keterangan != null)
                          <a role="button" data-bs-toggle="modal" data-bs-target="#revisi{{ $get->nik }}"
                            class="btn btn-warning shadow btn-xs sharp">
                            <i class="fas fa-edit"></i>
                          </a>

                          <!-- Modal -->
                          <div class="modal fade" id="revisi{{ $get->nik }}" tabindex="-1"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h1 class="modal-title fs-5" id="exampleModalLabel">Data Yang Direvisi</h1>
                                  <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                  <h4>Revisi Data:</h4>
                                  <h5>{{ $get->keterangan }}</h5>
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-secondary"
                                    data-bs-dismiss="modal">Close</button>
                                </div>
                              </div>
                            </div>
                          </div>
                        @endif
                      @else
                        <a href="javascript:void(0);" class="btn btn-danger shadow btn-xs sharp me-1 reject-button"
                          data-id="{{ $get->id }}" data-name="{{ $get->nama }}">
                          <i class="fas fa-times"></i>
                        </a>
                        <a href="javascript:void(0);" class="btn btn-warning shadow btn-xs sharp me-1 revise-button"
                          data-id="{{ $get->id }}" data-name="{{ $get->nama }}">
                          <i class="fas fa-edit"></i>
                        </a>
                      @endif
                    </div>
                  </td>
                @endif
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
  <x-verifikasi.script></x-verifikasi.script>
@endsection

@section('script')
  <script src="{{ asset('assets') }}/js/dashboard/cms.js"></script>
  <script>
    document.querySelector("form").addEventListener("submit", function(event) {
      let desa = document.getElementById("desaFilter").value.trim();
      let kecamatan = document.getElementById("kecamatanFilter").value.trim();

      if (!desa) {
        document.getElementById("desaFilter").removeAttribute("name");
      }
      if (!kecamatan) {
        document.getElementById("kecamatanFilter").removeAttribute("name");
      }
    });
  </script>
@endsection
