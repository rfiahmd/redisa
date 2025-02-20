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
            <span><i class="ti-home"></i> Diproses</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-bs-toggle="tab" href="#direvisi">
            <span><i class="ti-user"></i> Direvisi</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-bs-toggle="tab" href="#ditolak">
            <span><i class="ti-email"></i> Ditolak</span>
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
                        <td>@formatNama($data->nama)</td>
                        <td>{{ $data->usia }}th</td>
                        <td>{{ $data->jenisDisabilitas->nama_jenis }} » {{ $data->subJenisDisabilitas->nama_sub_jenis }}
                        </td>
                        @if (!isset($key))
                          <td>@cptl($data->desa->nama_desa)</td>
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
