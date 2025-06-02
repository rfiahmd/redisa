<?php
$title = 'Customer Service » ' . Str::ucfirst(Auth::user()->getRoleNames()->first());
$breadcrumb = 'Customer Service » Verifikator';
?>

@extends('layout.template')

@section('content')
  <ul class="nav nav-tabs style-2 mb-4" id="pills-tab" role="tablist">
    @if (auth()->user()->hasRole('superadmin'))
      <li class="nav-item" role="presentation">
        <a href="{{ route('users.adminpusat') }}" class="nav-link">
          <i class="la la-user-shield me-2 text-primary"></i>
          Admin
        </a>
      </li>
    @endif
    <li class="nav-item" role="presentation">
      <a href="{{ route('users.verifikator') }}" class="nav-link active bg-primary text-white">
        <i class="la la-user-check me-2 text-white"></i>
        Verifikator
      </a>
    </li>
    <li class="nav-item" role="presentation">
      <a href="{{ route('users.petugasdesa') }}" class="nav-link">
        <i class="la la-user-friends me-2 text-primary"></i>
        Petugas Desa
      </a>
    </li>
    <li class="nav-item" role="presentation">
      <a href="{{ route('users.kadis') }}" class="nav-link">
        <i class="la la-user-tie me-2 text-primary"></i>
        Kepala Dinas
      </a>
    </li>
    <li class="nav-item" role="presentation">
      <a type="button" class="nav-link bg-primary-subtle bg-gradient" data-bs-toggle="offcanvas"
        data-bs-target="#tambahVerifikator">
        + Tambah Verifikator
      </a>
    </li>
  </ul>
  <div class="offcanvas offcanvas-end" tabindex="-1" id="tambahVerifikator" aria-labelledby="offcanvasLabel">
    <div class="offcanvas-header">
      <h5 class="offcanvas-title" id="offcanvasLabel">Tambah CS-Verifikator</h5>
      <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
      <!-- Form Verifikator (Dengan Jabatan & Desa) -->
      <form method="POST" action="{{ route('users.store') }}" class="form-valide-with-icon needs-validation" novalidate>
        @csrf
        <input type="hidden" name="role" value="verifikator">
        <input type="hidden" name="password" id="password">

        <div class="mb-3 vertical-radius">
          <label class="text-label form-label required">Nama</label>
          <div class="input-group">
            <span class="input-group-text"><i class="fa fa-user"></i></span>
            <input type="text" name="nama_lengkap" class="form-control" placeholder="Masukkan Nama Anda.." required>
          </div>
          <div class="invalid-feedback">Masukkan Nama Anda</div>
        </div>

        <div class="mb-3 vertical-radius">
          <label class="text-label form-label required">Email</label>
          <div class="input-group">
            <span class="input-group-text"><i class="fa fa-envelope"></i></span>
            <input type="email" name="email" class="form-control" placeholder="Masukkan Email Anda.." required>
          </div>
          <div class="invalid-feedback">Harap Masukkan Email Dengan Benar</div>
        </div>

        <div class="mb-3 vertical-radius">
          <label class="text-label form-label required">Jabatan</label>
          <div class="input-group">
            <span class="input-group-text"><i class="fa fa-briefcase"></i></span>
            <input type="text" name="jabatan" class="form-control" placeholder="Masukkan Jabatan Anda.." required>
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
  <div class="card" style="margin-top: -25px">
    <div class="card-body">
      <div class="table-responsive table-hover">
        <table id="example3" class="display min-w850 mb-4 border-bottom border-top">
          <thead>
            <tr>
              <th>No</th>
              <th>Nama</th>
              <th>Email</th>
              <th>Jabatan</th>
              <th>Desa</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($verifikator as $user)
              <tr>
                <td>{{ $loop->iteration }}.</td>
                <td>@formatNama($user->nama_lengkap)</td>
                <td>{{ $user->email }}</td>

                @php
                  $jabatan = optional($user->verifikatorDesa->first())->jabatan ?? '-';
                  $desaArray = $user->verifikatorDesa->pluck('desa.nama_desa')->toArray();
                  $desaList =
                      count($desaArray) > 2
                          ? implode(', ', array_slice($desaArray, 0, 2)) . ' ...'
                          : implode(', ', $desaArray);
                @endphp

                <td>{{ $jabatan }}</td>
                <td>{{ $desaList }}</td>

                <td>
                  <a type="button" class="btn btn-primary shadow btn-xs sharp me-1 btn-edit" data-bs-toggle="offcanvas"
                    data-bs-target="#editCSverifikator{{ $user->id }}">
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
                  <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                  <!-- Edit CS Form -->
                  <form method="POST" action="{{ route('users.update', $user->id) }}"
                    class="form-valide-with-icon needs-validation" novalidate>
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                      <label class="form-label required">Nama</label>
                      <div class="input-group">
                        <span class="input-group-text"><i class="fa fa-user"></i></span>
                        <input type="text" name="nama_lengkap" class="form-control"
                          value="{{ old('nama_lengkap', $user->nama_lengkap) }}" required>
                      </div>
                      <div class="invalid-feedback">Masukkan Nama Anda</div>
                    </div>

                    <div class="mb-3">
                      <label class="form-label required">Username</label>
                      <div class="input-group">
                        <span class="input-group-text"><i class="fa fa-user"></i></span>
                        <input type="text" name="username" class="form-control"
                          value="{{ old('username', $user->username) }}" required>
                      </div>
                      <div class="invalid-feedback">Masukkan Username Anda</div>
                    </div>

                    <div class="mb-3">
                      <label class="form-label required">Email</label>
                      <div class="input-group">
                        <span class="input-group-text"><i class="fa fa-envelope"></i></span>
                        <input type="email" name="email" class="form-control"
                          value="{{ old('email', $user->email) }}" required>
                      </div>
                      <div class="invalid-feedback">Harap Masukkan Email Dengan Benar</div>
                    </div>

                    <div class="mb-3">
                      <label class="form-label required">Jabatan</label>
                      <div class="input-group">
                        <span class="input-group-text"><i class="fa fa-briefcase"></i></span>
                        <input type="text" name="jabatan" class="form-control"
                          value="{{ optional($user->verifikatorDesa->first())->jabatan }}" required>
                      </div>
                      <div class="invalid-feedback">Masukkan Jabatan Anda</div>
                    </div>

                    <div class="mb-3">
                      <label class="form-label required">Desa</label>
                      <select class="js-example-basic-multiple form-control" name="desa_id[]" multiple>
                        @foreach ($datadesa as $desa)
                          @php
                            $sudahDimiliki = in_array($desa->id, $desa_terpilih);
                            $milikUserIni = in_array(
                                $desa->id,
                                $verifikator_desa->where('user_id', $user->id)->pluck('desa_id')->toArray(),
                            );
                          @endphp

                          <option value="{{ $desa->id }}" @if ($milikUserIni) selected @endif
                            @if ($sudahDimiliki && !$milikUserIni) disabled @endif>
                            {{ $desa->nama_desa }} - {{ $desa->nama_kecamatan }}
                          </option>
                        @endforeach
                      </select>
                    </div>

                    <div class="form-check mb-3">
                      <input class="form-check-input" type="checkbox" id="ubahSandi{{ $user->id }}"
                        onchange="togglePasswordInput({{ $user->id }})">
                      <label class="form-check-label" for="ubahSandi{{ $user->id }}">Ubah Sandi</label>
                    </div>

                    <div class="mb-3" id="passwordInput{{ $user->id }}" style="display: none;">
                      <label class="form-label">Password Baru</label>
                      <div class="input-group">
                        <span class="input-group-text"><i class="fa fa-lock"></i></span>
                        <input type="password" name="password" class="form-control"
                          placeholder="Masukkan Password Baru">
                      </div>
                    </div>

                    <button type="submit" class="btn btn-primary w-100 mt-3"
                      onclick="this.form.submit()">Update</button>
                  </form>
                </div>
              </div>
            @endforeach
          </tbody>
        </table>

      </div>
    </div>
  </div>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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

    function generateRandomPassword() {
      const characters = 'abcdefghijklmnopqrstuvwxyz1234567890';
      let password = '';
      for (let i = 0; i < 8; i++) {
        password += characters.charAt(Math.floor(Math.random() * characters.length));
      }
      document.getElementById('password').value = password;
    }

    generateRandomPassword();

    function togglePasswordInput(userId) {
      let passwordInput = document.getElementById('passwordInput' + userId);
      if (passwordInput) {
        passwordInput.style.display = passwordInput.style.display === 'none' ? 'block' : 'none';
      }
    }
  </script>
  {{-- <x-cs.scriptcs></x-cs.scriptcs> --}}
@endsection
