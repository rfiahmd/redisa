<?php
$title = 'Profil » ' . Str::ucfirst(Auth::user()->getRoleNames()->first());
$breadcrumb = ' Profil';
?>

@extends('layout.template')

@section('content')
  <!-- row -->
  <div class="row">
    <div class="col-lg-12">
      <div class="profile card card-body px-3 pt-3 pb-0">
        <div class="profile-head">
          <div class="photo-content">
            <div class="cover-photo rounded"></div>
          </div>
          <div class="profile-info">
            <div class="profile-photo">
              <img src="{{ asset('assets') }}/images/profile/profile.png" class="img-fluid rounded-circle" alt="">
            </div>
            <div class="profile-details">
              <div class="profile-name px-3 pt-2">
                <h4 class="text-primary mb-0">@cptl(Auth::user()->nama_lengkap)</h4>
                <p>Desa Bangkal</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-xl-4">
      {{-- row pertama --}}
      <div class="row">
        <div class="col-xl-12">
          <div class="card">
            <div class="card-body">
              <h2 class="text-primary">Profile</h2>
              <form action="">
                <div class="mb-3 vertical-radius">
                  <label class="text-label form-label">Nama Lengkap</label>
                  <div class="input-group">
                    <span class="input-group-text"> <i class="fa fa-user"></i></span>
                    <input type="text" class="form-control" placeholder="Masukkan Nama Lengkap" value="{{ $user->nama_lengkap }}">
                  </div>
                </div>
                <div class="mb-3 vertical-radius">
                  <label class="text-label form-label">Username</label>
                  <div class="input-group">
                    <span class="input-group-text"> <i class="fa fa-user"></i></span>
                    <input type="text" class="form-control" placeholder="Masukkan Username Baru" value="{{ $user->username }}">
                  </div>
                </div>
                <div class="mb-3 vertical-radius">
                  <label class="text-label form-label">Email</label>
                  <div class="input-group">
                    <span class="input-group-text"> <i class="fa-regular fa-envelope"></i></span>
                    <input type="text" class="form-control" placeholder="Masukkan Email Baru" value="{{ $user->email }}">
                  </div>
                </div>
                <button class="btn btn-primary">Simpan</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-xl-8">
      <div class="card h-auto">
        <div class="card-body">
          <div class="profile-tab">
            <h2 class="text-primary">Ubah Password</h2>
            <form action="">
                <div class="mb-3 vertical-radius">
                  <label class="text-label form-label">Masukkan Password Lama</label>
                  <div class="input-group">
                    <span class="input-group-text"> <i class="fa-solid fa-lock"></i></span>
                    <input type="text" class="form-control" placeholder="Masukkan Password Lama">
                  </div>
                </div>
                <div class="mb-3 vertical-radius">
                  <label class="text-label form-label">Masukkan Password Baru</label>
                  <div class="input-group">
                    <span class="input-group-text"> <i class="fa-solid fa-lock"></i></span>
                    <input type="text" class="form-control" placeholder="Masukkan Password baru">
                  </div>
                </div>
                <div class="mb-3 vertical-radius">
                  <label class="text-label form-label">Konfirmasi Password Baru</label>
                  <div class="input-group">
                    <span class="input-group-text"> <i class="fa-solid fa-lock"></i></span>
                    <input type="text" class="form-control" placeholder="Konfirmasi Password Baru">
                  </div>
                </div>
                <button class="btn btn-primary">Simpan</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
