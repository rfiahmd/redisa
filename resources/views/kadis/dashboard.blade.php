<?php
$title = 'Dashboard » ' . Str::ucfirst(Auth::user()->getRoleNames()->first());
$breadcrumb = 'Dashboard';
?>

@extends('layout.template')

@section('content')
  @unless (auth()->user()->hasRole(['verifikator', 'petugasdesa']))
  <div class="row">
  <div class="col-xl-3 col-sm-6">
      <div class="card">
        <div class="card-body">
          <div class="media align-items-center invoice-card">
            <div class="media-body">
              <h2 class="text-black font-w600">{{ $desa_dengan_disabilitas }}</h2>
              <span>Total Desa Yang Menginputkan dari {{ $desa }} Desa</span>
            </div>
            <span class="p-3 border ms-3 rounded-circle">
              <svg width="34" height="34" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path
                  d="M13,2.05V5.08C16.39,5.57 19,8.47 19,12C19,12.9 18.82,13.75 18.5,14.54L21.12,16.07C21.68,14.83 22,13.45 22,12C22,6.82 18.05,2.55 13,2.05M12,19A7,7 0 0,1 5,12C5,8.47 7.61,5.57 11,5.08V2.05C5.94,2.55 2,6.81 2,12A10,10 0 0,0 12,22C15.3,22 18.23,20.39 20.05,17.91L17.45,16.38C16.17,18 14.21,19 12,19Z"
                  fill="#858585" />
              </svg>
            </span>
          </div>
        </div>
      </div>
    </div>
    <div class="col-xl-3 col-sm-6">
      <div class="card">
        <div class="card-body">
          <div class="media align-items-center invoice-card">
            <div class="media-body">
              <h2 class="text-black font-w600">{{ $disabilitasdata }}</h2>
              <span>Total Data Disabilitas Dari Semua Desa Di Sumenep</span>
            </div>
            <span class="p-3 border ms-3 rounded-circle">
              <svg width="34" height="34" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path
                  d="M13,2.05V5.08C16.39,5.57 19,8.47 19,12C19,12.9 18.82,13.75 18.5,14.54L21.12,16.07C21.68,14.83 22,13.45 22,12C22,6.82 18.05,2.55 13,2.05M12,19A7,7 0 0,1 5,12C5,8.47 7.61,5.57 11,5.08V2.05C5.94,2.55 2,6.81 2,12A10,10 0 0,0 12,22C15.3,22 18.23,20.39 20.05,17.91L17.45,16.38C16.17,18 14.21,19 12,19Z"
                  fill="#858585" />
              </svg>
            </span>
          </div>
        </div>
      </div>
    </div>
    <div class="col-xl-3 col-sm-6">
      <div class="card">
        <div class="card-body">
          <div class="media align-items-center invoice-card">
            <div class="media-body">
              <h2 class="text-black font-w600">{{ $verifikator }}</h2>
              <span>Total Verifikator</span>
            </div>
            <span class="p-3 border ms-3 rounded-circle">
              <svg width="34" height="34" viewBox="0 0 34 34" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path
                  d="M32.3668 9.72969C30.9793 6.78884 28.782 4.31932 26.0137 2.58667C22.1634 0.18354 17.6028 -0.579886 13.1815 0.442442C8.7603 1.45813 4.99628 4.14008 2.59315 7.9904C0.183379 11.8407 -0.580047 16.3947 0.44228 20.8226C1.46461 25.2438 4.14656 29.0079 7.99024 31.411C10.6987 33.1038 13.8056 34 16.9854 34H17.1912C20.3577 33.9602 23.438 33.0441 26.1067 31.3579C26.8834 30.8666 27.1091 29.8443 26.6178 29.0676C26.1266 28.2909 25.1043 28.0652 24.3276 28.5564C22.1833 29.9173 19.7005 30.6542 17.1514 30.6874C14.5358 30.7206 11.98 29.997 9.74944 28.6095C6.64927 26.6711 4.49176 23.644 3.67522 20.0857C2.85869 16.5275 3.46943 12.8631 5.40787 9.76288C9.40424 3.37001 17.8617 1.4183 24.2545 5.41467C26.4851 6.80875 28.2509 8.79366 29.3662 11.157C30.4549 13.4605 30.8797 16.0163 30.5943 18.539C30.4947 19.4484 31.1453 20.2716 32.0614 20.3712C32.9709 20.4708 33.794 19.8202 33.8936 18.9041C34.2455 15.7641 33.7144 12.5909 32.3668 9.72969Z"
                  fill="#2BC155" />
                <path
                  d="M22.4914 11.2377L14.4846 19.2445L11.5169 16.2768C10.8663 15.6262 9.81732 15.6262 9.16669 16.2768C8.51605 16.9274 8.51605 17.9764 9.16669 18.6271L13.3095 22.7699C13.6348 23.0952 14.0597 23.2545 14.4846 23.2545C14.9095 23.2545 15.3345 23.0952 15.6598 22.7699L24.8351 13.588C25.4857 12.9373 25.4857 11.8883 24.8351 11.2377C24.1844 10.5937 23.1354 10.5937 22.4914 11.2377Z"
                  fill="#2BC155" />
              </svg>
            </span>
          </div>
        </div>
      </div>
    </div>
    <div class="col-xl-3 col-sm-6">
      <div class="card">
        <div class="card-body">
          <div class="media align-items-center invoice-card">
            <div class="media-body">
              <h2 class="text-black font-w600">{{ $disabilitas_tolak }}</h2>
              <span>Total Data Disabilitas Yang Ditolak</span>
            </div>
            <span class="p-3 border ms-3 rounded-circle">
              <svg width="34" height="34" viewBox="0 0 34 34" fill="none" xmlns="http://www.w3.org/2000/svg">
                <g clip-path="url(#clip0)">
                  <path
                    d="M32.3733 9.72855C30.9854 6.78675 28.7873 4.31644 26.0182 2.58323C22.1666 0.179327 17.6112 -0.584345 13.1819 0.438311C8.75922 1.45433 4.99399 4.13714 2.59008 7.9887C0.179532 11.8403 -0.58414 16.3957 0.438516 20.825C1.46117 25.2477 4.14399 29.0129 7.98891 31.4168C10.6983 33.1102 13.8061 34.0067 16.987 34.0067H17.1928C20.3604 33.9668 23.4416 33.0504 26.1112 31.3637C26.8881 30.8723 27.1139 29.8496 26.6225 29.0727C26.1311 28.2957 25.1084 28.07 24.3315 28.5614C22.1866 29.9227 19.703 30.6598 17.153 30.693C14.5366 30.7262 11.9799 30.0024 9.74867 28.6145C6.6475 26.6754 4.4893 23.6473 3.6725 20.0879C2.8557 16.5153 3.46664 12.8496 5.4057 9.74847C9.40336 3.35355 17.8635 1.4012 24.2584 5.39886C26.4897 6.79339 28.2561 8.77894 29.3717 11.143C30.4608 13.4473 30.8858 16.0039 30.6002 18.5274C30.5006 19.4371 31.1514 20.2606 32.0678 20.3602C32.9776 20.4598 33.801 19.809 33.9006 18.8926C34.2526 15.7649 33.7213 12.5907 32.3733 9.72855Z"
                    fill="#FF2E2E" />
                  <path
                    d="M22.7647 11.2359C22.114 10.5852 21.0647 10.5852 20.414 11.2359L17.0007 14.6559L13.5874 11.2426C12.9366 10.5918 11.8874 10.5918 11.2366 11.2426C10.5858 11.8934 10.5858 12.9426 11.2366 13.5934L14.6499 17.0066L11.2366 20.4199C10.5858 21.0707 10.5858 22.1199 11.2366 22.7707C11.562 23.0961 11.987 23.2555 12.412 23.2555C12.837 23.2555 13.262 23.0961 13.5874 22.7707L17.0007 19.3574L20.414 22.7707C20.7394 23.0961 21.1644 23.2555 21.5894 23.2555C22.0144 23.2555 22.4394 23.0961 22.7647 22.7707C23.4155 22.1199 23.4155 21.0707 22.7647 20.4199L19.3515 17L22.7647 13.5867C23.4155 12.9359 23.4155 11.8867 22.7647 11.2359Z"
                    fill="#FF2E2E" />
                </g>
                <defs>
                  <clipPath id="clip0">
                    <rect width="34" height="34" fill="white" />
                  </clipPath>
                </defs>
              </svg>
            </span>
          </div>
        </div>
      </div>
    </div>

    </div>
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
