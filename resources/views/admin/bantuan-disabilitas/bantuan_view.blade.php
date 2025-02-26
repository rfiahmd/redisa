<?php
$title = 'Bantuan » ' . Str::ucfirst(Auth::user()->getRoleNames()->first());
$breadcrumb = 'Bantuan';

if (!empty($key)) {
    $desa = DB::table('desa')->join('verifikator_desa', 'desa.id', '=', 'verifikator_desa.desa_id')->where('verifikator_desa.token_verifikator', $key)->select('desa.nama_desa')->first();

    if ($desa) {
        $breadcrumb .= ' » ' . Str::ucfirst($desa->nama_desa);
    }
}

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
      </div>
    </div>
  @endunless
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
                      <th class="text-center">No</th>
                      <th>Nama</th>
                      <th>NIK</th>
                      <th>Jenis Disabilitas</th>
                      <th>Type Bantuan</th>
                      @if (empty($key) && !auth()->user()->hasRole('petugasdesa'))
                        <th>Desa</th>
                      @endif
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($dataMenerima as $index => $data)
                      <tr>
                        <td class="text-center">{{ $index + 1 }}.</td>
                        <td>@formatNama($data->nama)</td>
                        <td>{{ $data->nik }}</td>
                        <td>{{ $data->jenis_disabilitas }}, {{ $data->sub_disabilitas }}</td>
                        <td>@cptl($data->type_bantuan)</td>
                        @if (empty($key) && !auth()->user()->hasRole('petugasdesa'))
                          <td>{{ $data->nama_desa ?? '-' }}</td>
                        @endif
                        <td>
                          <a type="button" class="btn btn-info shadow btn-xs sharp me-1" data-bs-toggle="modal"
                            data-bs-target="#detail{{ $data->id }}">
                            <i class="fas fa-eye"></i>
                          </a>
                          @if (auth()->user()->hasRole(['superadmin', 'verifikator']))
                            <a type="button" class="btn btn-primary shadow btn-xs sharp me-1 btn-edit"
                              data-bs-toggle="modal" data-bs-target="#editBantuan{{ $data->id }}">
                              <i class="fas fa-pencil-alt"></i>
                            </a>
                            <a type="button" class="btn btn-danger shadow btn-xs sharp"
                              onclick="deleteEntity('bantuan', '{{ $data->id }}', '{{ $data->nama }}', null, null)">
                              <i class="fas fa-trash-alt"></i>
                            </a>
                          @endif
                        </td>
                      </tr>
                      <!-- Modal Detail -->
                      <div class="modal fade" id="detail{{ $data->id }}" tabindex="-1"
                        aria-labelledby="modalLabel{{ $data->id }}" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                          <div class="modal-content">
                            <div class="modal-header bg-primary">
                              <h3 class="modal-title text-light" id="modalLabel{{ $data->id }}">Detail Data Bantuan :
                                {{ $data->nama }}</h3>
                              <button type="button" class="btn-close text-white" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                              <div class="card shadow">
                                <div class="card-body">
                                  <div class="row">
                                    <div class="col-md-7">
                                      <p><strong>NIK:</strong> {{ $data->nik }}</p>
                                      <p><strong>Alamat:</strong> {{ $data->alamat }}</p>
                                      <p><strong>Usia:</strong> {{ $data->usia }} Tahun</p>
                                      <p><strong>Jenis Kelamin:</strong> {{ $data->kelamin }}</p>
                                      <p><strong>Tingkat Cacat:</strong> {{ $data->tingkat_disabilitas }}</p>
                                      <p><strong>Jenis Cacat:</strong> {{ $data->jenis_disabilitas }},
                                        {{ $data->sub_disabilitas }}</p>
                                    </div>
                                    <div class="col-md-5">
                                      <p><strong>Jenis Bantuan:</strong> {{ $data->jenis_bantuan }}</p>
                                      <p><strong>Tipe Bantuan:</strong> {{ $data->type_bantuan }}</p>
                                      @if ($data->type_bantuan == 'tunai')
                                        <p><strong>Nominal:</strong> Rp {{ number_format($data->nominal, 0, ',', '.') }}
                                        </p>
                                      @else
                                        <p><strong>Nama Barang:</strong> {{ $data->nama_barang }}</p>
                                        <p><strong>Jumlah Barang:</strong> {{ $data->jumlah_barang }}</p>
                                      @endif
                                      <p><strong>Deskripsi:</strong> {{ $data->deskripsi }}</p>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                          </div>
                        </div>
                      </div>
                      <!-- Modal Edit -->
                      <div class="modal fade" id="editBantuan{{ $data->id }}">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title">Edit Bantuan: @formatNama($data->nama)</h5>
                              <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                              <form class="form-valide-with-icon needs-validation" id="bantuanForm{{ $data->id }}"
                                action="{{ route('bantuan.update', $data->id) }}" method="POST" novalidate>
                                @csrf
                                @method('PUT')

                                <input type="hidden" name="disabilitas_id" value="{{ $data->id }}">

                                <!-- Jenis Bantuan -->
                                <div class="mb-3 vertical-radius">
                                  <label class="text-label form-label required"
                                    for="jenisBantuan{{ $data->id }}">Jenis Bantuan</label>
                                  <div class="input-group">
                                    <span class="input-group-text"><i class="fa fa-hand-holding-heart"></i></span>
                                    <input type="text" class="form-control" id="jenisBantuan{{ $data->id }}"
                                      placeholder="Masukkan jenis bantuan" name="jenis_bantuan"
                                      value="{{ $data->jenis_bantuan }}" required>
                                    <div class="invalid-feedback">Silakan masukkan jenis bantuan.</div>
                                  </div>
                                </div>

                                <!-- Type Bantuan -->
                                <div class="mb-3 vertical-radius">
                                  <label class="text-label form-label required"
                                    for="typeBantuan{{ $data->id }}">Type
                                    Bantuan</label>
                                  <div class="input-group">
                                    <span class="input-group-text"><i class="fa fa-list"></i></span>
                                    <select class="form-control" id="typeBantuan{{ $data->id }}"
                                      name="type_bantuan" required onchange="toggleFields({{ $data->id }})">
                                      <option disabled>Pilih Tipe Bantuan</option>
                                      <option value="tunai" {{ $data->type_bantuan == 'tunai' ? 'selected' : '' }}>
                                        Tunai
                                      </option>
                                      <option value="barang" {{ $data->type_bantuan == 'barang' ? 'selected' : '' }}>
                                        Barang</option>
                                    </select>

                                    <div class="invalid-feedback">Silakan pilih tipe bantuan.</div>
                                  </div>
                                </div>

                                <!-- Nominal (Jika tunai) -->
                                <div class="mb-3 vertical-radius" id="nominalField{{ $data->id }}"
                                  style="display: {{ $data->type_bantuan == 'tunai' ? 'block' : 'none' }};">
                                  <label class="text-label form-label required"
                                    for="nominal{{ $data->id }}">Nominal</label>
                                  <div class="input-group">
                                    <span class="input-group-text"><i class="fa fa-money-bill-wave"></i></span>
                                    <input type="text" id="nominal{{ $data->id }}"
                                      class="form-control nominal-input" placeholder="Masukkan nominal" name="nominal"
                                      value="{{ number_format($data->nominal, 0, ',', '.') }}">
                                    <div class="invalid-feedback">Silakan masukkan nominal bantuan.</div>
                                  </div>
                                </div>

                                <!-- Nama Barang & Jumlah Barang (Jika barang) -->
                                <div id="barangFields{{ $data->id }}"
                                  style="display: {{ $data->type_bantuan == 'barang' ? 'block' : 'none' }};">
                                  <div class="mb-3 vertical-radius">
                                    <label class="text-label form-label required"
                                      for="namaBarang{{ $data->id }}">Nama Barang</label>
                                    <div class="input-group">
                                      <span class="input-group-text"><i class="fa fa-box"></i></span>
                                      <input type="text" class="form-control" id="namaBarang{{ $data->id }}"
                                        placeholder="Masukkan nama barang" name="nama_barang"
                                        value="{{ $data->nama_barang }}">
                                      <div class="invalid-feedback">Silakan masukkan nama barang.</div>
                                    </div>
                                  </div>
                                  <div class="mb-3 vertical-radius">
                                    <label class="text-label form-label required"
                                      for="jumlahBarang{{ $data->id }}">Jumlah Barang</label>
                                    <div class="input-group">
                                      <span class="input-group-text"><i class="fa fa-sort-numeric-up"></i></span>
                                      <input type="number" class="form-control" id="jumlahBarang{{ $data->id }}"
                                        placeholder="Masukkan jumlah barang" name="jumlah_barang"
                                        value="{{ $data->jumlah_barang }}">
                                      <div class="invalid-feedback">Silakan masukkan jumlah barang.</div>
                                    </div>
                                  </div>
                                </div>

                                <!-- Deskripsi -->
                                <div class="mb-3 vertical-radius">
                                  <label class="text-label form-label required"
                                    for="deskripsi{{ $data->id }}">Deskripsi</label>
                                  <div class="input-group">
                                    <span class="input-group-text"><i class="fa fa-file-alt"></i></span>
                                    <textarea class="form-control" id="deskripsi{{ $data->id }}" placeholder="Masukkan deskripsi bantuan"
                                      name="deskripsi" required>{{ $data->deskripsi }}</textarea>
                                    <div class="invalid-feedback">Silakan masukkan deskripsi bantuan.</div>
                                  </div>
                                </div>
                              </form>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                              <button type="button" class="btn btn-primary"
                                onclick="document.getElementById('bantuanForm{{ $data->id }}').submit();">Simpan</button>
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
          <div class="tab-pane fade" id="belum">
            <div class="pt-4">
              <div class="table-responsive table-hover">
                <table id="example3" class="display min-w850 mb-4 border-bottom border-top">
                  <thead>
                    <tr>
                      <th class="text-center">No</th>
                      <th>Nama</th>
                      <th>NIK</th>
                      <th>Jenis Disabilitas</th>
                      <th>Kecacatan</th>
                      @if (empty($key) && !auth()->user()->hasRole('petugasdesa'))
                        <th>Desa</th>
                      @endif
                      @if (auth()->user()->hasRole(['superadmin', 'verifikator']))
                        <th>Action</th>
                      @endif
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($dataBelum as $index => $data)
                      <tr>
                        <td class="text-center">{{ $index + 1 }}.</td>
                        <td>@formatNama($data->nama)</td>
                        <td>{{ $data->nik }}</td>
                        <td>{{ $data->jenis_disabilitas }}, {{ $data->sub_disabilitas }}</td>
                        <td>{{ $data->tingkat_disabilitas }}</td>
                        @if (empty($key) && !auth()->user()->hasRole('petugasdesa'))
                          <td>{{ $data->nama_desa }}, {{ $data->nama_desa }}</td>
                        @endif
                        @if (auth()->user()->hasRole(['superadmin', 'verifikator']))
                          <td>
                            <a type="button" class="btn btn-warning shadow btn-xs sharp me-1" data-bs-toggle="modal"
                              data-bs-target="#addBantuan{{ $data->id }}">
                              <i class="fas fa-hands-helping"></i>
                            </a>
                          </td>
                        @endif
                      </tr>
                      <div class="modal fade" id="addBantuan{{ $data->id }}">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title">Bantuan : @formatNama($data->nama)</h5>
                              <button type="button" class="btn-close" data-bs-dismiss="modal">
                              </button>
                            </div>
                            <div class="modal-body">
                              <form class="form-valide-with-icon needs-validation" id="bantuanForm{{ $data->id }}"
                                action="{{ route('bantuan.store') }}" method="POST" novalidate>
                                @csrf
                                <input type="text" name="disabilitas_id" value="{{ $data->id }}" hidden>
                                <!-- Jenis Bantuan -->
                                <div class="mb-3 vertical-radius">
                                  <label class="text-label form-label required" for="jenisBantuan">Jenis Bantuan</label>
                                  <div class="input-group validate-username">
                                    <span class="input-group-text search_icon"><i
                                        class="fa fa-hand-holding-heart"></i></span>
                                    <input type="text" class="form-control br-style" id="jenisBantuan"
                                      placeholder="Masukkan jenis bantuan" name="jenis_bantuan" required>
                                    <div class="invalid-feedback">Silakan masukkan jenis bantuan.</div>
                                  </div>
                                </div>

                                <!-- Type Bantuan -->
                                <div class="mb-3 vertical-radius">
                                  <label class="text-label form-label required" for="typeBantuan">Type Bantuan</label>
                                  <div class="input-group validate-username">
                                    <span class="input-group-text search_icon"><i class="fa fa-list"></i></span>
                                    <select class="form-control br-style" id="typeBantuan{{ $data->id }}"
                                      name="type_bantuan" required onchange="toggleFields({{ $data->id }})">
                                      <option disabled selected>Pilih Tipe Bantuan</option>
                                      <option value="tunai">Tunai</option>
                                      <option value="barang">Barang</option>
                                    </select>
                                    <div class="invalid-feedback">Silakan pilih tipe bantuan.</div>
                                  </div>
                                </div>

                                <!-- Nominal (Tampil jika tunai dipilih) -->
                                <div class="mb-3 vertical-radius" id="nominalField{{ $data->id }}"
                                  style="display: none;">
                                  <label class="text-label form-label required" for="nominal">Nominal</label>
                                  <div class="input-group validate-username">
                                    <span class="input-group-text search_icon"><i
                                        class="fa fa-money-bill-wave"></i></span>
                                    <input type="text" id="nominal" class="form-control br-style" id="nominal"
                                      placeholder="Masukkan nominal" name="nominal">
                                    <div class="invalid-feedback">Silakan masukkan nominal bantuan.</div>
                                  </div>
                                </div>

                                <!-- Nama Barang dan Jumlah Barang (Tampil jika barang dipilih) -->
                                <div id="barangFields{{ $data->id }}" style="display: none;">
                                  <div class="mb-3 vertical-radius">
                                    <label class="text-label form-label required" for="namaBarang">Nama Barang</label>
                                    <div class="input-group validate-username">
                                      <span class="input-group-text search_icon"><i class="fa fa-box"></i></span>
                                      <input type="text" class="form-control br-style" id="namaBarang"
                                        placeholder="Masukkan nama barang" name="nama_barang">
                                      <div class="invalid-feedback">Silakan masukkan nama barang.</div>
                                    </div>
                                  </div>
                                  <div class="mb-3 vertical-radius">
                                    <label class="text-label form-label required" for="jumlahBarang">Jumlah
                                      Barang</label>
                                    <div class="input-group validate-username">
                                      <span class="input-group-text search_icon"><i
                                          class="fa fa-sort-numeric-up"></i></span>
                                      <input type="number" class="form-control br-style" id="jumlahBarang"
                                        placeholder="Masukkan jumlah barang" name="jumlah_barang">
                                      <div class="invalid-feedback">Silakan masukkan jumlah barang.</div>
                                    </div>
                                  </div>
                                </div>

                                <!-- Deskripsi -->
                                <div class="mb-3 vertical-radius">
                                  <label class="text-label form-label required" for="deskripsi">Deskripsi</label>
                                  <div class="input-group validate-username">
                                    <span class="input-group-text search_icon"><i class="fa fa-file-alt"></i></span>
                                    <textarea class="form-control br-style" id="deskripsi" placeholder="Masukkan deskripsi bantuan" name="deskripsi"
                                      required></textarea>
                                    <div class="invalid-feedback">Silakan masukkan deskripsi bantuan.</div>
                                  </div>
                                </div>
                              </form>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-danger light"
                                data-bs-dismiss="modal">Close</button>
                              <button type="button" class="btn btn-primary"
                                id="submitBantuan{{ $data->id }}">Simpan</button>
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
        </div>
      </div>
    </div>
  </div>
@endsection

@section('script')
  <script src="{{ asset('assets') }}/js/dashboard/cms.js"></script>
  <script>
    function toggleFields(id) {
      var typeBantuan = document.getElementById("typeBantuan" + id).value;

      document.getElementById("nominalField" + id).style.display = (typeBantuan === "tunai") ? "block" : "none";
      document.getElementById("barangFields" + id).style.display = (typeBantuan === "barang") ? "block" : "none";
    }

    document.addEventListener("DOMContentLoaded", function() {
      document.querySelectorAll("[id^=submitBantuan]").forEach(function(button) {
        button.addEventListener("click", function() {
          // Ambil ID unik dari tombol
          let id = this.id.replace("submitBantuan", "");
          // Temukan form yang sesuai dengan ID unik
          let form = document.getElementById("bantuanForm" + id);
          if (form) {
            form.submit();
          }
        });
      });
    });


    document.addEventListener("DOMContentLoaded", function() {
      document.querySelectorAll("input[id^='nominal']").forEach(function(input) {
        // Jika ada nilai awal, format ke Rupiah
        if (input.value) {
          input.value = new Intl.NumberFormat("id-ID").format(input.value.replace(/\D/g, ""));
        }

        // Format angka saat user mengetik
        input.addEventListener("input", function(e) {
          let value = e.target.value.replace(/\D/g, ""); // Hapus semua karakter non-digit
          if (value.length > 15) return; // Batasi 15 digit agar aman
          e.target.value = new Intl.NumberFormat("id-ID").format(value);
        });
      });

      // Hapus titik sebelum submit ke backend
      document.getElementById("bantuanForm").addEventListener("submit", function() {
        document.querySelectorAll("input[id^='nominal']").forEach(function(input) {
          input.value = input.value.replace(/\./g, ""); // Hapus titik sebelum dikirim ke backend
        });
      });
    });
  </script>
@endsection
