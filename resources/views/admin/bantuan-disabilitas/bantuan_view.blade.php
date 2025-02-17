<?php
$title = 'Jenis Disabilitas » ' . Str::ucfirst(Auth::user()->getRoleNames()->first());
$breadcrumb = 'Jenis Disabilitas';
?>

@extends('layout.template')

@section('content')
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
        <div class="row">
          <div class="col-xl-4  col-sm-6 mb-3 mb-xl-0">
            <label for="exampleDataList" class="form-label">Desa</label>
            <input class="form-control" list="datalistOptions" id="exampleDataList" placeholder="Cari Desa...">
            <datalist id="datalistOptions">
              <option value="San Francisco">
              <option value="New York">
              <option value="Seattle">
              <option value="Los Angeles">
              <option value="Chicago">
            </datalist>
          </div>
          <div class="col-xl-4  col-sm-6 mb-3 mb-xl-0">
            <label for="exampleDataList" class="form-label">Kecamatan</label>
            <input class="form-control" list="datalistOptions" id="exampleDataList" placeholder="Cari Kecamatan...">
            <datalist id="datalistOptions">
              <option value="San Francisco">
              <option value="New York">
              <option value="Seattle">
              <option value="Los Angeles">
              <option value="Chicago">
            </datalist>
          </div>
          <div class="col-xl-3 col-sm-6 align-self-end">
            <div>
              <button class="btn btn-primary me-2" title="Click here to Search" type="button"><i
                  class="fa fa-filter me-1"></i>Filter</button>
              <button class="btn btn-danger light" title="Click here to remove filter" type="button">Remove
                Filter</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="card">
    <div class="card-body">
      <div class="default-tab">
        <ul class="nav nav-tabs" role="tablist">
          <li class="nav-item">
            <a class="nav-link text-success active" data-bs-toggle="tab" href="#menerima">
              <i class="la la-hand-holding-heart me-2 text-success"></i> Sudah Menerima Bantuan
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-danger" data-bs-toggle="tab" href="#belum">
              <i class="la la-hourglass-half me-2 text-danger"></i> Belum Menerima Bantuan
            </a>
          </li>
        </ul>
        <div class="tab-content">
          <div class="tab-pane fade show active" id="menerima" role="tabpanel">
            <div class="pt-4">
              <div class="table-responsive table-hover">
                <table id="example3" class="display min-w850 mb-4 border-bottom border-top">
                  <thead>
                    <tr>
                      <th class="text-center">#</th>
                      <th>Nama</th>
                      <th>NIK</th>
                      <th>Jenis Disabilitas</th>
                      <th>Jenis Bantuan</th>
                      <th>Tanggal Penerimaan</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $dataMenerima = [
                      ['nama' => 'Andi Setiawan', 'nik' => '1234567890123456', 'disabilitas' => 'Tunanetra', 'bantuan' => 'Bantuan Sosial', 'tanggal' => '10 Juli 2024'],
                      ['nama' => 'Siti Rahma', 'nik' => '9876543210987654', 'disabilitas' => 'Tunadaksa', 'bantuan' => 'Bantuan Keuangan', 'tanggal' => '5 Juli 2024']
                    ];
                    foreach ($dataMenerima as $index => $data) : ?>
                    <tr>
                      <td class="text-center">{{ $index + 1 }}.</td>
                      <td>{{ $data['nama'] }}</td>
                      <td>{{ $data['nik'] }}</td>
                      <td>{{ $data['disabilitas'] }}</td>
                      <td>{{ $data['bantuan'] }}</td>
                      <td>{{ $data['tanggal'] }}</td>
                      <td>
                        <a href="" class="btn btn-info shadow btn-xs sharp me-1">
                          <i class="fas fa-eye"></i></a>
                      </td>
                    </tr>
                    <?php endforeach; ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <div class="tab-pane fade" id="belum">
            <div class="pt-4">
              <div class="table-responsive table-hover">
                <table id="example3" class="display min-w850 mb-4 border-bottom border-top">
                  <thead>
                    <tr>
                      <th class="text-center">#</th>
                      <th>Nama</th>
                      <th>NIK</th>
                      <th>Jenis Disabilitas</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $dataBelum = [
                      ['nama' => 'Budi Santoso', 'nik' => '1122334455667788', 'disabilitas' => 'Tunawicara', 'status' => 'Belum Menerima'],
                      ['nama' => 'Dewi Anggraeni', 'nik' => '9988776655443322', 'disabilitas' => 'Tunarungu', 'status' => 'Belum Menerima']
                    ];
                    foreach ($dataBelum as $index => $data) : ?>
                    <tr>
                      <td class="text-center">{{ $index + 1 }}.</td>
                      <td>{{ $data['nama'] }}</td>
                      <td>{{ $data['nik'] }}</td>
                      <td>{{ $data['disabilitas'] }}</td>
                      <td>{{ $data['status'] }}</td>
                      <td>
                        <a href="" class="btn btn-warning shadow btn-xs sharp me-1">
                          <i class="fas fa-hands-helping"></i>
                        </a>
                      </td>
                    </tr>
                    <?php endforeach; ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  {{-- @foreach ($dataMenerima as $data)
    <div class="modal fade" id="detailModal{{ $index }}" tabindex="-1" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Detail Penerima Bantuan</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <p><strong>Nama:</strong> {{ $data->nama }}</p>
            <p><strong>NIK:</strong> {{ $data->nik }}</p>
            <p><strong>Jenis Disabilitas:</strong> {{ $data->jenis_disabilitas }}</p>
            <p><strong>Jenis Bantuan:</strong> {{ $data->jenis_bantuan }}</p>
            <p><strong>Tanggal Penerimaan:</strong> {{ date('d M Y', strtotime($data->tanggal_penerimaan)) }}</p>
          </div>
        </div>
      </div>
    </div>
  @endforeach

  <!-- Modal Tambah Bantuan -->
  @foreach ($dataBelum as $data)
    <div class="modal fade" id="bantuanModal{{ $data->nik }}" tabindex="-1" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Berikan Bantuan</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form action="{{ route('beri.bantuan', $data->id) }}" method="POST">
              @csrf
              <div class="mb-3">
                <label for="jenisBantuan" class="form-label">Jenis Bantuan</label>
                <select class="form-control" name="jenis_bantuan" required>
                  <option value="Bantuan Sosial">Bantuan Sosial</option>
                  <option value="Bantuan Keuangan">Bantuan Keuangan</option>
                  <option value="Bantuan Medis">Bantuan Medis</option>
                </select>
              </div>
              <div class="mb-3">
                <label for="tanggalPenerimaan" class="form-label">Tanggal Penerimaan</label>
                <input type="date" class="form-control" name="tanggal_penerimaan" required>
              </div>
              <button type="submit" class="btn btn-success">Simpan</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  @endforeach --}}
@endsection

@section('script')
  <script src="{{ asset('assets') }}/js/dashboard/cms.js"></script>
@endsection
