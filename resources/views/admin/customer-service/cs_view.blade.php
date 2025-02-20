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
          @if (auth()->user()->hasRole('superadmin'))
            <li class="nav-item">
              <a class="nav-link active" data-bs-toggle="tab" href="#adminpusat">
                <i class="la la-user-shield me-2 text-primary"></i> Admin
              </a>
            </li>
          @endif
          <li class="nav-item">
            <a class="nav-link text-danger @if (auth()->user()->hasRole('adminpusat')) active @endif" data-bs-toggle="tab" href="#kadis">
              <i class="la la-user-tie me-2 text-danger"></i> Kepala Dinas
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-success" data-bs-toggle="tab"
              href="#verifikator">
              <i class="la la-user-check me-2 text-success"></i> Verifikator
            </a>
          </li>
          {{-- @endif --}}
          <li class="nav-item">
            <a class="nav-link text-warning" data-bs-toggle="tab" href="#petugasdesa">
              <i class="la la-user-friends me-2 text-warning"></i> Petugas Desa
            </a>
          </li>
          <li class="nav-item ms-auto mb-2 me-3" style="margin-top: -12px">
            <a class="btn btn-primary btn-sm" href="javascript:void(0);" id="btnTambahCS" data-bs-toggle="offcanvas"
              data-bs-target="#offcanvasTambahCS">+ Tambah CS</a>
          </li>
        </ul>
        <div class="tab-content">
          @if (auth()->user()->hasRole('superadmin'))
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
                            <a href="javascript:void(0);" class="btn btn-danger shadow btn-xs sharp"
                              onclick="deleteEntity('users', '{{ $user->token_users }}', '{{ $user->nama_lengkap }}', null, null)">
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
                            <!-- Edit CS Form -->
                            <form method="POST" action="{{ route('users.update', $user->id) }}"
                              class="form-valide-with-icon needs-validation" novalidate>
                              @csrf
                              @method('PUT')

                              <div class="mb-3 vertical-radius">
                                <label class="text-label form-label required">Nama</label>
                                <div class="input-group">
                                  <span class="input-group-text"><i class="fa fa-user"></i></span>
                                  <input type="text" name="nama_lengkap" class="form-control"
                                    value="{{ $user->nama_lengkap }}" placeholder="Masukkan Nama Anda.." required>
                                </div>
                                @error('nama_lengkap')
                                  <div class="text-danger">{{ $message }}</div>
                                @enderror
                                <div class="invalid-feedback">Masukkan Nama Anda</div>
                              </div>

                              <div class="mb-3 vertical-radius">
                                <label class="text-label form-label required">Username</label>
                                <div class="input-group">
                                  <span class="input-group-text"><i class="fa fa-user"></i></span>
                                  <input type="text" name="username" class="form-control" value="{{ $user->username }}"
                                    placeholder="Masukkan Username Anda.." required>
                                </div>
                                @error('username')
                                  <div class="text-danger">{{ $message }}</div>
                                @enderror
                                <div class="invalid-feedback">Masukkan Username Anda</div>
                              </div>

                              <div class="mb-3 vertical-radius">
                                <label class="text-label form-label required">Email</label>
                                <div class="input-group">
                                  <span class="input-group-text"><i class="fa fa-envelope"></i></span>
                                  <input type="email" name="email" class="form-control" value="{{ $user->email }}"
                                    placeholder="Masukkan Email Anda.." required>
                                </div>
                                @error('email')
                                  <div class="text-danger">{{ $message }}</div>
                                @enderror
                                <div class="invalid-feedback">Harap Masukkan Email Dengan Benar</div>
                              </div>

                              <div class="form-check mb-3">
                                <input class="form-check-input" type="checkbox" id="ubahSandi{{ $user->id }}"
                                  onchange="togglePasswordInput({{ $user->id }})">
                                <label class="form-check-label" for="ubahSandi{{ $user->id }}" class="d-inline">
                                  Ubah Sandi
                                </label>
                                <span class="ms-1 position-relative" data-bs-toggle="tooltip" data-bs-placement="top"
                                  title="Centang jika ingin mengubah sandi, jika tidak biarkan saja."
                                  style="cursor: pointer; top: -3px;">
                                  <i class="fas fa-exclamation-circle text-warning"
                                    style="font-size: 0.7rem; vertical-align: middle;"></i>
                                </span>
                              </div>
                              <div class="mb-3" id="passwordInput{{ $user->id }}" style="display: none;">
                                <label class="text-label form-label">Password Baru</label>
                                <div class="input-group">
                                  <span class="input-group-text"><i class="fa fa-lock"></i></span>
                                  <input type="password" name="password" class="form-control"
                                    placeholder="Masukkan Password Baru">
                                </div>
                              </div>

                              <button type="submit" class="btn btn-primary w-100 mt-3">Simpan</button>
                            </form>
                          </div>
                        </div>
                      @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          @endif
          <div class="tab-pane fade {{ auth()->user()->hasRole('adminpusat') ? 'show active' : '' }}" role="{{ auth()->user()->hasRole('adminpusat') ? 'tabpanel' : '' }}" id="kadis">
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
                          <a type="button" class="btn btn-primary shadow btn-xs sharp me-1 btn-edit"
                            data-bs-toggle="offcanvas" data-bs-target="#editCSkadis{{ $user->id }}">
                            <i class="fas fa-pencil-alt"></i>
                          </a>
                          <a href="javascript:void(0);" class="btn btn-danger shadow btn-xs sharp"
                            onclick="deleteEntity('users', '{{ $user->token_users }}', '{{ $user->nama_lengkap }}', null, null)">
                            <i class="fas fa-trash-alt"></i>
                          </a>
                        </td>
                      </tr>
                      <div class="offcanvas offcanvas-end" tabindex="-1" id="editCSkadis{{ $user->id }}"
                        aria-labelledby="offcanvasLabel">
                        <div class="offcanvas-header">
                          <h5 class="offcanvas-title" id="offcanvasLabel">Edit CS</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="offcanvas"
                            aria-label="Close"></button>
                        </div>
                        <div class="offcanvas-body">
                          <!-- Edit CS Form -->
                          <form method="POST" action="{{ route('users.update', $user->id) }}"
                            class="form-valide-with-icon needs-validation" novalidate>
                            @csrf
                            @method('PUT')

                            <div class="mb-3 vertical-radius">
                              <label class="text-label form-label required">Nama</label>
                              <div class="input-group">
                                <span class="input-group-text"><i class="fa fa-user"></i></span>
                                <input type="text" name="nama_lengkap" class="form-control"
                                  value="{{ $user->nama_lengkap }}" placeholder="Masukkan Nama Anda.." required>
                              </div>
                              @error('nama_lengkap')
                                <div class="text-danger">{{ $message }}</div>
                              @enderror
                              <div class="invalid-feedback">Masukkan Nama Anda</div>
                            </div>

                            <div class="mb-3 vertical-radius">
                              <label class="text-label form-label required">Username</label>
                              <div class="input-group">
                                <span class="input-group-text"><i class="fa fa-user"></i></span>
                                <input type="text" name="username" class="form-control"
                                  value="{{ $user->username }}" placeholder="Masukkan Username Anda.." required>
                              </div>
                              @error('username')
                                <div class="text-danger">{{ $message }}</div>
                              @enderror
                              <div class="invalid-feedback">Masukkan Username Anda</div>
                            </div>

                            <div class="mb-3 vertical-radius">
                              <label class="text-label form-label required">Email</label>
                              <div class="input-group">
                                <span class="input-group-text"><i class="fa fa-envelope"></i></span>
                                <input type="email" name="email" class="form-control" value="{{ $user->email }}"
                                  placeholder="Masukkan Email Anda.." required>
                              </div>
                              @error('email')
                                <div class="text-danger">{{ $message }}</div>
                              @enderror
                              <div class="invalid-feedback">Harap Masukkan Email Dengan Benar</div>
                            </div>

                            <div class="form-check mb-3">
                              <input class="form-check-input" type="checkbox" id="ubahSandi{{ $user->id }}"
                                onchange="togglePasswordInput({{ $user->id }})">
                              <label class="form-check-label" for="ubahSandi{{ $user->id }}" class="d-inline">
                                Ubah Sandi
                              </label>
                              <span class="ms-1 position-relative" data-bs-toggle="tooltip" data-bs-placement="top"
                                title="Centang jika ingin mengubah sandi, jika tidak biarkan saja."
                                style="cursor: pointer; top: -3px;">
                                <i class="fas fa-exclamation-circle text-warning"
                                  style="font-size: 0.7rem; vertical-align: middle;"></i>
                              </span>
                            </div>
                            <div class="mb-3" id="passwordInput{{ $user->id }}" style="display: none;">
                              <label class="text-label form-label">Password Baru</label>
                              <div class="input-group">
                                <span class="input-group-text"><i class="fa fa-lock"></i></span>
                                <input type="password" name="password" class="form-control"
                                  placeholder="Masukkan Password Baru">
                              </div>
                            </div>

                            <button type="submit" class="btn btn-primary w-100 mt-3">Simpan</button>
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
                          <a type="button" class="btn btn-primary shadow btn-xs sharp me-1 btn-edit"
                            data-bs-toggle="offcanvas" data-bs-target="#editCSverifikator{{ $user->id }}">
                            <i class="fas fa-pencil-alt"></i>
                          </a>
                          <a href="javascript:void(0);" class="btn btn-danger shadow btn-xs sharp"
                            onclick="deleteEntity('users', '{{ $user->token_users }}', '{{ $user->nama_lengkap }}', null, null)">
                            <i class="fas fa-trash-alt"></i>
                          </a>
                        </td>
                      </tr>
                      <div class="offcanvas offcanvas-end" tabindex="-1" id="editCSverifikator{{ $user->id }}"
                        aria-labelledby="offcanvasLabel">
                        <div class="offcanvas-header">
                          <h5 class="offcanvas-title" id="offcanvasLabel">Edit CS</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="offcanvas"
                            aria-label="Close"></button>
                        </div>
                        <div class="offcanvas-body">
                          <!-- Edit CS Form -->
                          <form method="POST" action="{{ route('users.update', $user->id) }}"
                            id="form-verifikator-edit" class="form-valide-with-icon needs-validation" novalidate>
                            @csrf
                            @method('PUT')

                            <div class="mb-3 vertical-radius">
                              <label class="text-label form-label required">Nama</label>
                              <div class="input-group">
                                <span class="input-group-text"><i class="fa fa-user"></i></span>
                                <input type="text" name="nama_lengkap" id="nama_lengkap_verifikator_edit"
                                  class="form-control" placeholder="Masukkan Nama Anda.."
                                  value="{{ old('nama_lengkap', $user->nama_lengkap) }}" required>
                              </div>
                              <div class="invalid-feedback">Masukkan Nama Anda</div>
                            </div>

                            <div class="mb-3 vertical-radius">
                              <label class="text-label form-label required">Username</label>
                              <div class="input-group">
                                <span class="input-group-text"><i class="fa fa-user"></i></span>
                                <input type="text" name="username" class="form-control"
                                  value="{{ $user->username }}" placeholder="Masukkan Username Anda.." required>
                              </div>
                              @error('username')
                                <div class="text-danger">{{ $message }}</div>
                              @enderror
                              <div class="invalid-feedback">Masukkan Username Anda</div>
                            </div>

                            <div class="mb-3 vertical-radius">
                              <label class="text-label form-label required">Email</label>
                              <div class="input-group">
                                <span class="input-group-text"><i class="fa fa-envelope"></i></span>
                                <input type="email" name="email" id="email_verifikator_edit" class="form-control"
                                  placeholder="Masukkan Email Anda.." value="{{ old('email', $user->email) }}"
                                  required>
                              </div>
                              <div class="invalid-feedback">Harap Masukkan Email Dengan Benar</div>
                            </div>

                            <div class="mb-3 vertical-radius">
                              <label class="text-label form-label required">Jabatan</label>
                              <div class="input-group">
                                <span class="input-group-text"><i class="fa fa-briefcase"></i></span>
                                <input type="text" name="jabatan" id="jabatan_edit" class="form-control"
                                  placeholder="Masukkan Jabatan Anda.."
                                  value="{{ optional($user->verifikatorDesa)->jabatan }}" required>
                              </div>
                              <div class="invalid-feedback">Masukkan Jabatan Anda</div>
                            </div>

                            <!-- Input untuk pencarian edit -->
                            <div class="mb-3 vertical-radius">
                              <label class="text-label form-label required">Desa</label>
                              <select class="js-example-basic-multiple" name="states[]" multiple="multiple">
                                @foreach ($datadesa as $desa)
                                  @php
                                    // Memeriksa apakah desa sudah dipilih atau tidak
                                    $sudahDipilih = in_array($desa->id, $desa_terpilih);
                                    // Memeriksa apakah desa sudah dimiliki oleh user ini dalam verifikator_desa
                                    $milikUserIni = $verifikator_desa
                                        ->where('user_id', $user->id)
                                        ->pluck('desa_id')
                                        ->contains($desa->id);
                                  @endphp

                                  <option value="{{ $desa->id }}" @if ($sudahDipilih && !$milikUserIni) disabled @endif
                                    @if ($milikUserIni) selected @endif>
                                    {{ $desa->nama_desa }} - {{ $desa->nama_kecamatan }}
                                  </option>
                                @endforeach
                              </select>
                            </div>


                            <div class="form-check mb-3">
                              <input class="form-check-input" type="checkbox" id="ubahSandi{{ $user->id }}"
                                onchange="togglePasswordInput({{ $user->id }})">
                              <label class="form-check-label" for="ubahSandi{{ $user->id }}" class="d-inline">
                                Ubah Sandi
                              </label>
                              <span class="ms-1 position-relative" data-bs-toggle="tooltip" data-bs-placement="top"
                                title="Centang jika ingin mengubah sandi, jika tidak biarkan saja."
                                style="cursor: pointer; top: -3px;">
                                <i class="fas fa-exclamation-circle text-warning"
                                  style="font-size: 0.7rem; vertical-align: middle;"></i>
                              </span>
                            </div>
                            <div class="mb-3" id="passwordInput{{ $user->id }}" style="display: none;">
                              <label class="text-label form-label">Password Baru</label>
                              <div class="input-group">
                                <span class="input-group-text"><i class="fa fa-lock"></i></span>
                                <input type="password" name="password" class="form-control"
                                  placeholder="Masukkan Password Baru">
                              </div>
                            </div>

                            <button type="submit" class="btn btn-primary w-100 mt-3">Update</button>
                          </form>
                        </div>
                      </div>
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
                          <a type="button" class="btn btn-primary shadow btn-xs sharp me-1 btn-edit"
                            data-bs-toggle="offcanvas" data-bs-target="#editCSpetugasdesa{{ $user->id }}">
                            <i class="fas fa-pencil-alt"></i>
                          </a>
                          <a href="javascript:void(0);" class="btn btn-danger shadow btn-xs sharp"
                            onclick="deleteEntity('users', '{{ $user->token_users }}', '{{ $user->nama_lengkap }}', null, null)">
                            <i class="fas fa-trash-alt"></i>
                          </a>
                        </td>
                      </tr>
                      <div class="offcanvas offcanvas-end" tabindex="-1" id="editCSpetugasdesa{{ $user->id }}"
                        aria-labelledby="offcanvasLabel">
                        <div class="offcanvas-header">
                          <h5 class="offcanvas-title" id="offcanvasLabel">Edit CS</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="offcanvas"
                            aria-label="Close"></button>
                        </div>
                        <div class="offcanvas-body">
                          <!-- Edit CS Form -->
                          <form method="POST" action="{{ route('users.update', $user->id) }}"
                            class="form-valide-with-icon needs-validation" novalidate>
                            @csrf
                            @method('PUT')

                            <div class="mb-3 vertical-radius">
                              <label class="text-label form-label required">Nama</label>
                              <div class="input-group">
                                <span class="input-group-text"><i class="fa fa-user"></i></span>
                                <input type="text" name="nama_lengkap" class="form-control"
                                  value="{{ $user->nama_lengkap }}" placeholder="Masukkan Nama Anda.." required>
                              </div>
                              @error('nama_lengkap')
                                <div class="text-danger">{{ $message }}</div>
                              @enderror
                              <div class="invalid-feedback">Masukkan Nama Anda</div>
                            </div>

                            <div class="mb-3 vertical-radius">
                              <label class="text-label form-label required">Username</label>
                              <div class="input-group">
                                <span class="input-group-text"><i class="fa fa-user"></i></span>
                                <input type="text" name="username" class="form-control"
                                  value="{{ $user->username }}" placeholder="Masukkan Username Anda.." required>
                              </div>
                              @error('username')
                                <div class="text-danger">{{ $message }}</div>
                              @enderror
                              <div class="invalid-feedback">Masukkan Username Anda</div>
                            </div>

                            <div class="mb-3 vertical-radius">
                              <label class="text-label form-label required">Email</label>
                              <div class="input-group">
                                <span class="input-group-text"><i class="fa fa-envelope"></i></span>
                                <input type="email" name="email" class="form-control" value="{{ $user->email }}"
                                  placeholder="Masukkan Email Anda.." required>
                              </div>
                              @error('email')
                                <div class="text-danger">{{ $message }}</div>
                              @enderror
                              <div class="invalid-feedback">Harap Masukkan Email Dengan Benar</div>
                            </div>

                            <div class="form-check mb-3">
                              <input class="form-check-input" type="checkbox" id="ubahSandi{{ $user->id }}"
                                onchange="togglePasswordInput({{ $user->id }})">
                              <label class="form-check-label" for="ubahSandi{{ $user->id }}" class="d-inline">
                                Ubah Sandi
                              </label>
                              <span class="ms-1 position-relative" data-bs-toggle="tooltip" data-bs-placement="top"
                                title="Centang jika ingin mengubah sandi, jika tidak biarkan saja."
                                style="cursor: pointer; top: -3px;">
                                <i class="fas fa-exclamation-circle text-warning"
                                  style="font-size: 0.7rem; vertical-align: middle;"></i>
                              </span>
                            </div>
                            <div class="mb-3" id="passwordInput{{ $user->id }}" style="display: none;">
                              <label class="text-label form-label">Password Baru</label>
                              <div class="input-group">
                                <span class="input-group-text"><i class="fa fa-lock"></i></span>
                                <input type="password" name="password" class="form-control"
                                  placeholder="Masukkan Password Baru">
                              </div>
                            </div>

                            <button type="submit" class="btn btn-primary w-100 mt-3">Simpan</button>
                          </form>
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
          <select class="js-example-basic-multiple" name="desa_id[]" multiple="multiple">
            @foreach ($datadesa as $desa)
              <option value="{{ $desa->id }}" @if (in_array($desa->id, $desa_terpilih)) disabled @endif>
                {{ $desa->nama_desa }} - {{ $desa->nama_kecamatan }}
              </option>
            @endforeach
          </select>
        </div>

        <button type="submit" class="btn btn-primary w-100 mt-3">Simpan</button>
      </form>
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>
    document.addEventListener("DOMContentLoaded", function() {
      var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
      var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
      });
    });
  </script>
  <script>
    $(document).ready(function() {
      $('.js-example-basic-multiple').select2({
        placeholder: "Pilih desa...",
        allowClear: true,
        language: {
          noResults: function() {
            return "Tidak ada hasil yang ditemukan";
          }
        }
      });
    });
  </script>
  <x-cs.scriptcs></x-cs.scriptcs>
@endsection
