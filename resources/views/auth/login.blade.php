@extends('layout.auth')

@section('form')
  <form action="{{route('login')}}" method="post">
    @csrf
    <div class="mb-4">
      <label class="form-label required">Email</label>
      <input type="email" class="form-control" placeholder="hello@example.com" name="email" required>
    </div>
    <div class="mb-4 position-relative">
      <label class="mb-1 form-label required">Password</label>
      <input type="password" id="password-field" class="form-control" placeholder="123456" name="password" required>
    </div>
    <div class="form-row d-flex justify-content-between mt-4 mb-2">
      <div class="mb-4">
        <div class="form-check custom-checkbox mb-3">
          <input type="checkbox" class="form-check-input" id="show-password">
          <label class="form-check-label" for="show-password">Lihat Password</label>
        </div>
      </div>
      <div class="mb-4">
        <a href="page-forgot-password.html" class="btn-link text-primary">Lupa Password?</a>
      </div>
    </div>
    <div class="text-center mb-4">
      <button type="submit" class="btn btn-primary btn-block">Masuk</button>
    </div>
  </form>

  <script>
    document.getElementById("show-password").addEventListener("change", function() {
      let passwordField = document.getElementById("password-field");
      passwordField.type = this.checked ? "text" : "password";
    });
  </script>
@endsection
