@extends('layout.auth')

@section('form')
  <form action="{{ route('login') }}" method="post">
    @csrf
    <div class="mb-4">
      <label class="form-label">Email atau Username</label>
      <input type="text" value="{{ old('login') }}" class="form-control @error('login') is-invalid @enderror"
        placeholder="Masukkan email atau username" name="login">
      @error('login')
        <div class="invalid-feedback">{{ $message }}</div>
      @enderror
    </div>
    <div class="mb-4 position-relative">
      <label class="mb-1 form-label">Password</label>
      <div class="position-relative">
        <input type="password" id="password-field" class="form-control @error('password') is-invalid @enderror"
          placeholder="123456" name="password" style="padding-right: 40px;">
        <span class="position-absolute"
          style="right: 10px; top: 50%; transform: translateY(-50%); cursor: pointer; z-index: 10;" id="toggle-password">
          <i class="fa fa-eye" id="eye-icon"></i>
        </span>
      </div>
      @error('password')
        <div class="invalid-feedback">{{ $message }}</div>
      @enderror
    </div>
    {{-- <div class="mb-4">
      <a href="{{ route('password.request') }}" class="btn-link text-primary">Lupa Password?</a>
    </div> --}}
    <div class="row mb-4">
      {{-- <div class="col-6">
        <button type="reset" class="btn btn-light btn-block">Reset</button>
      </div> --}}
      <div class="col-12">
        <button type="submit" class="btn btn-primary btn-block">Masuk</button>
      </div>
    </div>
  </form>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const togglePassword = document.getElementById('toggle-password');
      const passwordField = document.getElementById('password-field');
      const eyeIcon = document.getElementById('eye-icon');

      togglePassword.addEventListener('click', function() {
        const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordField.setAttribute('type', type);

        // Toggle icon
        if (type === 'text') {
          eyeIcon.classList.remove('fa-eye');
          eyeIcon.classList.add('fa-eye-slash');
        } else {
          eyeIcon.classList.remove('fa-eye-slash');
          eyeIcon.classList.add('fa-eye');
        }
      });
    });
  </script>


  @if ($errors->any())
    <script>
      Swal.fire({
        icon: "error",
        title: "Oops...",
        text: "{{ $errors->first() }}",
      });
    </script>
  @endif

  <script>
    document.getElementById("show-password").addEventListener("change", function() {
      let passwordField = document.getElementById("password-field");
      passwordField.type = this.checked ? "text" : "password";
    });
  </script>
@endsection
