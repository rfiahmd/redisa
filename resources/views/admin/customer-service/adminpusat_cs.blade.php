<?php
$title = 'Customer Service » ' . Str::ucfirst(Auth::user()->getRoleNames()->first());
$breadcrumb = 'Customer Service » Admin Pusat';
?>

@extends('layout.template')

@section('content')
  <ul class="nav nav-tabs style-2 mb-4" id="pills-tab" role="tablist">
    @if (auth()->user()->hasRole('superadmin'))
    <li class="nav-item" role="presentation">
      <a href="{{ route('users.adminpusat') }}" class="nav-link active bg-primary text-white">
        <i class="la la-user-shield me-2 text-white"></i>
        Admin
      </a>
    </li>
    @endif
    <li class="nav-item" role="presentation">
      <a href="{{ route('users.verifikator') }}" class="nav-link">
        <i class="la la-user-check me-2 text-primary"></i>
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
        data-bs-target="#tambahAdmin">
        + Tambah Admin
      </a>
    </li>
  </ul>
  <div class="offcanvas offcanvas-end" tabindex="-1" id="tambahAdmin" aria-labelledby="offcanvasLabel">
    <div class="offcanvas-header">
      <h5 class="offcanvas-title" id="offcanvasLabel">Tambah CS-Admin</h5>
      <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
      <form method="POST" action="{{ route('users.store') }}"
        class="form-valide-with-icon needs-validation" novalidate>
        @csrf
        <input type="hidden" name="role" value="adminpusat">
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
            <input type="email" name="email" id="email" class="form-control" placeholder="Masukkan Email Anda.."
              value="{{ old('email') }}">
          </div>
          @error('email')
            <div class="text-danger">{{ $message }}</div>
          @enderror
          <div class="invalid-feedback">Harap Masukkan Email Dengan Benar</div>
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
                  <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
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
  <x-cs.scriptcs></x-cs.scriptcs>
@endsection
