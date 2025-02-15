<?php
$title = 'Customer Service » ' . Str::ucfirst(Auth::user()->getRoleNames()->first());
$breadcrumb = 'Customer Service';
?>

@extends('layout.template')

@section('content')
  <style>
    table {
      min-width: 850px;
    }
  </style>
  <div class="card">
    <div class="card-body">
      <div class="default-tab">
        <ul class="nav nav-tabs" role="tablist">
          <li class="nav-item">
            <a class="nav-link active" data-bs-toggle="tab" href="#adminpusat">
              <i class="la la-user-shield me-2 text-primary"></i> Admin
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-success" data-bs-toggle="tab" href="#verifikator">
              <i class="la la-user-check me-2 text-success"></i> Verifikator
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-warning" data-bs-toggle="tab" href="#petugasdesa">
              <i class="la la-user-friends me-2 text-warning"></i> Petugas Desa
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-danger" data-bs-toggle="tab" href="#kadis">
              <i class="la la-user-tie me-2 text-danger"></i> Kepala Dinas
            </a>
          </li>
          <li class="nav-item ms-auto mb-2 me-3">
            <a class="btn btn-primary" href="javascript:void(0);" id="btnTambahCS" data-bs-toggle="offcanvas"
              data-bs-target="#offcanvasTambahCS">+ Tambah CS</a>
          </li>
        </ul>
        <div class="tab-content">
          <div class="tab-pane fade show active" id="adminpusat" role="tabpanel">
            <div class="pt-4">
              <div class="table-responsive table-hover">
                <table id="example3" class="display min-w850 mb-4 border-bottom border-top">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Nama</th>
                      <th>Email</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($adminpusat as $user)
                      <tr>
                        <td>{{ $loop->iteration }}.</td>
                        <td>@formatNama($user->nama_lengkap)</td>
                        <td>{{ $user->email }}</td>
                        <td>
                          <a type="button" class="btn btn-primary shadow btn-xs sharp me-1 btn-edit"
                            data-bs-toggle="offcanvas" data-bs-target="#editCSadmin{{ $user->id }}">
                            <i class="fas fa-pencil-alt"></i>
                          </a>
                          <a href="javascript:void(0);" class="btn btn-danger shadow btn-xs sharp">
                            <i class="fas fa-trash-alt"></i>
                          </a>
                        </td>
                      </tr>
                      <div class="offcanvas offcanvas-end" tabindex="-1" id="editCSadmin{{ $user->id }}"
                        aria-labelledby="offcanvasLabel">
                        <div class="offcanvas-header">
                          <h5 class="offcanvas-title" id="offcanvasLabel">Edit CS</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="offcanvas"
                            aria-label="Close"></button>
                        </div>
                        <div class="offcanvas-body">
                          <form method="POST" action="{{ route('users.update', $user->id) }}" class="needs-validation"
                            novalidate>
                            @csrf
                            <input type="hidden" name="role" value="{{ auth()->user()->getRoleNames()->first() }}">

                            <div class="mb-3">
                              <label class="form-label">Nama</label>
                              <input type="text" name="nama_lengkap" class="form-control"
                                value="{{ $user->nama_lengkap }}" required>
                            </div>
                            
                            <div class="mb-3">
                              <label class="form-label">Username</label>
                              <input type="text" name="username" class="form-control"
                                value="{{ $user->username }}" required>
                            </div>

                            <div class="mb-3">
                              <label class="form-label">Email</label>
                              <input type="email" name="email" class="form-control" value="{{ $user->email }}"
                                required>
                            </div>

                            <div class="form-check mb-3">
                              <input class="form-check-input" type="checkbox" id="ubahSandi{{ $user->id }}"
                                onchange="togglePasswordInput({{ $user->id }})">
                              <label class="form-check-label" for="ubahSandi{{ $user->id }}">
                                Ubah Sandi
                              </label>
                            </div>

                            <div class="mb-3" id="passwordInput{{ $user->id }}" style="display: none;">
                              <label class="form-label">Password Baru</label>
                              <input type="password" name="password" class="form-control">
                            </div>

                            <button type="submit" class="btn btn-primary w-100">Simpan</button>
                          </form>
                        </div>
                      </div>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <div class="tab-pane fade" id="verifikator">
            <div class="pt-4">
              <div class="table-responsive table-hover">
                <table id="example3" class="display min-w850 mb-4 border-bottom border-top">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Nama</th>
                      <th>Email</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($verifikator as $user)
                      <tr>
                        <td>{{ $loop->iteration }}.</td>
                        <td>@formatNama($user->nama_lengkap)</td>
                        <td>{{ $user->email }}</td>
                        <td>
                          <a href="javascript:void(0);" class="btn btn-primary shadow btn-xs sharp me-1 btn-edit"
                            data-user='@json($user)'>
                            <i class="fas fa-pencil-alt"></i>
                          </a>
                          <a href="javascript:void(0);" class="btn btn-danger shadow btn-xs sharp"><i
                              class="fas fa-trash-alt"></i></a>
                        </td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <div class="tab-pane fade" id="petugasdesa">
            <div class="pt-4">
              <div class="table-responsive table-hover">
                <table id="example3" class="display min-w850 mb-4 border-bottom border-top">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Nama</th>
                      <th>Email</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($petugasdesa as $user)
                      <tr>
                        <td>{{ $loop->iteration }}.</td>
                        <td>@formatNama($user->nama_lengkap)</td>
                        <td>{{ $user->email }}</td>
                        <td>
                          <a href="javascript:void(0);" class="btn btn-primary shadow btn-xs sharp me-1 btn-edit"
                            data-user='@json($user)'>
                            <i class="fas fa-pencil-alt"></i>
                          </a>
                          <a href="javascript:void(0);" class="btn btn-danger shadow btn-xs sharp"><i
                              class="fas fa-trash-alt"></i></a>
                        </td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <div class="tab-pane fade" id="kadis">
            <div class="pt-4">
              <div class="table-responsive table-hover">
                <table id="example3" class="display min-w850 mb-4 border-bottom border-top">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Nama</th>
                      <th>Email</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($kadis as $user)
                      <tr>
                        <td>{{ $loop->iteration }}.</td>
                        <td>@formatNama($user->nama_lengkap)</td>
                        <td>{{ $user->email }}</td>
                        <td>
                          <a href="javascript:void(0);" class="btn btn-primary shadow btn-xs sharp me-1 btn-edit"
                            data-user='@json($user)'>
                            <i class="fas fa-pencil-alt"></i>
                          </a>
                          <a href="javascript:void(0);" class="btn btn-danger shadow btn-xs sharp"><i
                              class="fas fa-trash-alt"></i></a>
                        </td>
                      </tr>
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

  <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasTambahCS" aria-labelledby="offcanvasLabel">
    <div class="offcanvas-header">
      <h5 class="offcanvas-title" id="offcanvasLabel">Tambah CS</h5>
      <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
      <!-- Form Default (Admin, Petugas Desa, Kepala Dinas) -->
      <form method="POST" action="{{ route('users.store') }}" id="form-default"
        class="form-valide-with-icon needs-validation" novalidate>
        @csrf
        <input type="hidden" name="role" id="role">
        <input type="hidden" name="password" id="password">

        <div class="mb-3 vertical-radius">
          <label class="text-label form-label required">Nama</label>
          <div class="input-group">
            <span class="input-group-text"><i class="fa fa-user"></i></span>
            <input type="text" name="nama_lengkap" id="nama_lengkap" class="form-control"
              placeholder="Masukkan Nama Anda.." value="{{ old('nama_lengkap') }}">
          </div>
          @error('nama_lengkap')
            <div class="text-danger">{{ $message }}</div>
          @enderror
          <div class="invalid-feedback">Masukkan Nama Anda</div>
        </div>

        <div class="mb-3 vertical-radius">
          <label class="text-label form-label required">Email</label>
          <div class="input-group">
            <span class="input-group-text"><i class="fa fa-envelope"></i></span>
            <input type="email" name="email" id="email" class="form-control"
              placeholder="Masukkan Email Anda.." value="{{ old('email') }}">
          </div>
          @error('email')
            <div class="text-danger">{{ $message }}</div>
          @enderror
          <div class="invalid-feedback">Harap Masukkan Email Dengan Benar</div>
        </div>

        <button type="submit" class="btn btn-primary w-100 mt-3">Simpan</button>
      </form>

      <!-- Form Verifikator (Dengan Jabatan & Desa) -->
      <form method="POST" action="{{ route('users.store') }}" id="form-verifikator"
        class="form-valide-with-icon needs-validation" novalidate style="display: none;">
        @csrf
        <input type="hidden" name="role" id="role-verifikator" value="verifikator">
        <input type="hidden" name="password" id="password-verifikator">

        <div class="mb-3 vertical-radius">
          <label class="text-label form-label required">Nama</label>
          <div class="input-group">
            <span class="input-group-text"><i class="fa fa-user"></i></span>
            <input type="text" name="nama_lengkap" id="nama_lengkap_verifikator" class="form-control"
              placeholder="Masukkan Nama Anda.." required>
          </div>
          <div class="invalid-feedback">Masukkan Nama Anda</div>
        </div>

        <div class="mb-3 vertical-radius">
          <label class="text-label form-label required">Email</label>
          <div class="input-group">
            <span class="input-group-text"><i class="fa fa-envelope"></i></span>
            <input type="email" name="email" id="email_verifikator" class="form-control"
              placeholder="Masukkan Email Anda.." required>
          </div>
          <div class="invalid-feedback">Harap Masukkan Email Dengan Benar</div>
        </div>

        <div class="mb-3 vertical-radius">
          <label class="text-label form-label required">Jabatan</label>
          <div class="input-group">
            <span class="input-group-text"><i class="fa fa-briefcase"></i></span>
            <input type="text" name="jabatan" id="jabatan" class="form-control"
              placeholder="Masukkan Jabatan Anda.." required>
          </div>
          <div class="invalid-feedback">Masukkan Jabatan Anda</div>
        </div>

        <div class="mb-3 vertical-radius">
          <label class="text-label form-label required">Desa</label>
          <div class="input-group">
            <span class="input-group-text"><i class="fa fa-map-marker"></i></span>
            <input type="text" id="search-desa" class="form-control" placeholder="Cari desa..."
              autocomplete="off">
          </div>
          <div id="desa-list" class="dropdown-menu show" style="display: none; width: 100%;"></div>
          <div id="selected-desa" class="mt-2"></div>
          <div id="selected-desa-container"></div>
        </div>

        <button type="submit" class="btn btn-primary w-100 mt-3">Simpan</button>
      </form>
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <x-cs.scriptcs></x-cs.scriptcs>
@endsection
