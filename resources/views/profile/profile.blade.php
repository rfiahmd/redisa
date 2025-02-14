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
            <div class="profile-photo"
              style="margin: -30px 0 0 10px; width: 110px; height: 100px; border-radius: 50%; display: flex; align-items: center; justify-content: center; 
                      background-color: {{ '#' . substr(md5(preg_replace('/[^a-zA-Z0-9. ]/', '', Auth::user()->nama_lengkap)), 0, 6) }}; 
                      color: white; font-weight: bold; font-size: 45px; border: 8px solid #fff;">
              @php
                $nama_bersih = preg_replace('/[^a-zA-Z0-9. ]/', '', Auth::user()->nama_lengkap);
                $nama = explode(' ', $nama_bersih);
                $initials = strtoupper(substr($nama[0], 0, 1));
                if (count($nama) > 1) {
                    $initials .= strtoupper(substr($nama[1], 0, 1));
                }
              @endphp
              {{ $initials }}
            </div>
            <div class="profile-details">
              <div class="profile-name px-3 pt-2">
                <h4 class="text-primary mb-0">@cptl(Auth::user()->nama_lengkap)</h4>
                <p>@cptl(Auth::user()->getRoleNames()->first())</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-xl-6">
      {{-- row pertama --}}
      <div class="row">
        <div class="col-xl-12">
          <div class="card">
            <div class="card-body">
              <h2 class="text-primary">Profile</h2>
              <form action="{{ route('profil.update') }}" method="POST">
                @csrf
                <div class="mb-3 vertical-radius">
                  <label class="text-label form-label">Nama Lengkap</label>
                  <div class="input-group">
                    <span class="input-group-text"> <i class="fa fa-user"></i></span>
                    <input type="text" name="nama_lengkap" class="form-control" value="{{ $user->nama_lengkap }}"
                      @if(Auth::user()->hasRole('petugasdesa')) readonly @endif required>
                  </div>
                </div>
                <div class="mb-3 vertical-radius">
                  <label class="text-label form-label">Username</label>
                  <div class="input-group">
                    <span class="input-group-text"> <i class="fa fa-user"></i></span>
                    <input type="text" name="username" class="form-control" value="{{ $user->username }}" required>
                  </div>
                </div>
                <div class="mb-3 vertical-radius">
                  <label class="text-label form-label">Email</label>
                  <div class="input-group">
                    <span class="input-group-text"> <i class="fa-regular fa-envelope"></i></span>
                    <input type="email" name="email" class="form-control" value="{{ $user->email }}" required>
                  </div>
                </div>
                <button class="btn btn-primary" type="submit">Simpan</button>
              </form>

            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-xl-6">
      <div class="card h-auto">
        <div class="card-body">
          <div class="profile-tab">
            <h2 class="text-primary">Ubah Password</h2>
            <form action="{{ route('profil.update-password') }}" method="POST" id="passwordForm">
              @csrf

              <div class="mb-3 vertical-radius">
                <label class="text-label form-label">Masukkan Password Lama</label>
                <div class="input-group">
                  <span class="input-group-text"><i class="fa-solid fa-lock"></i></span>
                  <input type="password" name="current_password"
                    class="form-control @error('current_password') is-invalid @enderror" required>
                </div>
                @error('current_password')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>

              <div class="mb-3 vertical-radius">
                <label class="text-label form-label">Masukkan Password Baru</label>
                <div class="input-group">
                  <span class="input-group-text"><i class="fa-solid fa-lock"></i></span>
                  <input type="password" name="new_password" id="new_password"
                    class="form-control @error('new_password') is-invalid @enderror" required>
                </div>
                @error('new_password')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>

              <div class="mb-3 vertical-radius">
                <label class="text-label form-label">Konfirmasi Password Baru</label>
                <div class="input-group">
                  <span class="input-group-text"><i class="fa-solid fa-lock"></i></span>
                  <input type="password" name="new_password_confirmation" id="confirm_password"
                    class="form-control @error('new_password_confirmation') is-invalid @enderror" required>
                </div>
                <div id="passwordMismatch" class="invalid-feedback d-none">
                  Konfirmasi password tidak sesuai!
                </div>
              </div>

              <!-- Checkbox untuk melihat password -->
              <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="showPassword">
                <label class="form-check-label" for="showPassword">Tampilkan Password</label>
              </div>

              <button class="btn btn-primary" type="submit">Simpan</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script>
    document.addEventListener("DOMContentLoaded", function() {
      const newPassword = document.getElementById("new_password");
      const confirmPassword = document.getElementById("confirm_password");
      const passwordMismatch = document.getElementById("passwordMismatch");
      const form = document.getElementById("passwordForm");

      confirmPassword.addEventListener("input", function() {
        if (newPassword.value !== confirmPassword.value) {
          confirmPassword.classList.add("is-invalid");
          passwordMismatch.classList.remove("d-none");
        } else {
          confirmPassword.classList.remove("is-invalid");
          passwordMismatch.classList.add("d-none");
        }
      });

      document.getElementById("showPassword").addEventListener("change", function() {
        const type = this.checked ? "text" : "password";
        newPassword.type = type;
        confirmPassword.type = type;
        document.querySelector("input[name='current_password']").type = type;
      });

      form.addEventListener("submit", function(event) {
        if (newPassword.value !== confirmPassword.value) {
          event.preventDefault(); // Mencegah submit jika password tidak cocok
          confirmPassword.classList.add("is-invalid");
          passwordMismatch.classList.remove("d-none");
        }
      });
    });
  </script>
@endsection
