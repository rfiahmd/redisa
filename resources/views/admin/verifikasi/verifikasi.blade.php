<?php
$title = 'Verifikasi » ' . Str::ucfirst(Auth::user()->getRoleNames()->first());
$breadcrumb = 'Verifikasi » Data Disabilitas';
?>

@extends('layout.template')

@section('content')
  <div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
      <h4 class="card-title">Verifikasi Desa
        @isset($key)
          : {{ $key->desa->nama_desa }}
        @endisset
      </h4>
      <div>
        <a class="btn btn-success btn-sm" href="javascript:void(0);" id="accept-all">Terima Semua</a>
        <a class="btn btn-danger btn-sm" href="javascript:void(0);" id="reject-all">Tolak Semua</a>
        <a class="btn btn-warning btn-sm" href="javascript:void(0);" id="revise-all">Revisi Semua</a>
      </div>
    </div>
    <div class="card-body">
      <ul class="nav nav-tabs" role="tablist">
        <li class="nav-item">
          <a class="nav-link active" data-bs-toggle="tab" href="#diproses">
            <span><i class="ti-timer"></i> Diproses</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-bs-toggle="tab" href="#direvisi">
            <span><i class="ti-pencil"></i> Direvisi</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-bs-toggle="tab" href="#ditolak">
            <span><i class="ti-close"></i> Ditolak</span>
          </a>
        </li>
      </ul>

      <div class="tab-content tabcontent-border">
        @foreach (['diproses' => 'diproses', 'direvisi' => 'direvisi', 'ditolak' => 'ditolak'] as $tab => $status)
          <div class="tab-pane fade show @if ($loop->first) active @endif" id="{{ $tab }}"
            role="tabpanel">
            <div class="pt-4">
              <div class="table-responsive">
                <table id="example4" class="display min-w850">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>NIK</th>
                      <th>Nama</th>
                      <th>Usia</th>
                      <th>Tingkat Kecacatan</th>
                      @if (!isset($key))
                        <th>Desa</th>
                      @endif
                      <th>Status</th>
                      @if ($status == 'diproses' || $status == 'direvisi')
                        <th>Action</th>
                      @endif
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($disabilitas->where('status', $status) as $index => $data)
                      <tr>
                        <td>{{ $index + 1 }}.</td>
                        <td>{{ $data->nik }}</td>
                        <td>
                          <strong>@formatNama($data->nama)</strong>
                          <a role="button" data-bs-toggle="modal" data-bs-target="#detail{{ $data->nik }}"
                            class="text-primary">Selengkapnya...</a>
                        </td>
                        <td>{{ $data->usia }}th</td>
                        <td>{{ $data->jenisDisabilitas->nama_jenis }} » {{ $data->subJenisDisabilitas->nama_sub_jenis }}
                        </td>
                        @if (!isset($key))
                          <td>@cptl($data->desa->nama_desa) - @cptl($data->desa->nama_kecamatan)</td>
                        @endif
                        <td>
                          <span
                            class="badge light badge-{{ $status == 'diproses' ? 'warning' : ($status == 'direvisi' ? 'secondary' : 'danger') }}">
                            {{ $status == 'diproses' ? 'Diproses' : ($status == 'direvisi' ? 'Direvisi' : 'Ditolak') }}
                          </span>
                        </td>
                        @if ($status == 'diproses' || $status == 'direvisi')
                          <td>
                            <div class="d-flex">
                              @if ($status == 'diproses')
                                <a href="javascript:void(0);"
                                  class="btn btn-success shadow btn-xs sharp me-1 accept-button"
                                  data-id="{{ $data->id }}" data-name="{{ $data->nama }}">
                                  <i class="fas fa-check"></i>
                                </a>
                                <a href="javascript:void(0);"
                                  class="btn btn-danger shadow btn-xs sharp me-1 reject-button"
                                  data-id="{{ $data->id }}" data-name="{{ $data->nama }}">
                                  <i class="fas fa-times"></i>
                                </a>
                                <a href="javascript:void(0);"
                                  class="btn btn-warning shadow btn-xs sharp me-1 revise-button"
                                  data-id="{{ $data->id }}" data-name="{{ $data->nama }}">
                                  <i class="fas fa-edit"></i>
                                </a>
                              @elseif ($status == 'direvisi')
                                <a href="javascript:void(0);"
                                  class="btn btn-primary shadow btn-xs sharp me-1 edit-revision-button"
                                  data-id="{{ $data->id }}" data-name="{{ $data->nama }}"
                                  data-keterangan="{{ $data->keterangan }}">
                                  <i class="fas fa-pencil-alt"></i>
                                </a>
                              @endif
                            </div>
                          </td>
                        @endif
                      </tr>

                      {{-- Modal Detail --}}
                      <div class="modal fade" id="detail{{ $data->nik }}" tabindex="-1"
                        aria-labelledby="modalLabel{{ $data->nik }}" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                          <div class="modal-content">
                            <div class="modal-header bg-primary">
                              <h3 class="modal-title text-light" id="modalLabel{{ $data->nik }}">Detail Data
                                {{ $data->nama }}</h3>
                              <button type="button" class="btn-close text-white" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                              <div class="card shadow">
                                <div class="card-body">
                                  <div class="row">
                                    <div class="col-md-6">
                                      <p><strong>NIK:</strong> {{ $data->nik }}</p>
                                      <p><strong>Alamat:</strong> {{ $data->alamat }}</p>
                                      <p><strong>Usia:</strong> {{ $data->usia }} Tahun</p>
                                      <p><strong>Jenis Kelamin:</strong> {{ $data->kelamin }}</p>
                                    </div>
                                    <div class="col-md-6">
                                      <p><strong>Tingkat Cacat:</strong> {{ $data->tingkat_disabilitas }}</p>
                                      <p><strong>Jenis Cacat:</strong> {{ $data->jenisDisabilitas->nama_jenis }},
                                        {{ $data->subJenisDisabilitas->nama_sub_jenis }}</p>
                                      <p><strong>Jenjang Pendidikan:</strong>
                                        @if ($data->pendidikan == 'tidak')
                                          Tidak Dalam Pendidikan
                                        @else
                                          {{ $data->pendidikan }}
                                        @endif
                                      </p>
                                      <p><strong>Keterangan:</strong>
                                        @if ($data->keterangan == null)
                                          Tidak Ada Keterangan
                                        @else
                                          {{ $data->keterangan }}
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
        @endforeach
      </div>
    </div>
  </div>
  <x-verifikasi.script></x-verifikasi.script>
@endsection
