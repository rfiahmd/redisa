<!DOCTYPE html>
<html lang="en">

<head>

  <!--Title-->
  <title>Mophy - Payment Admin Dashboard Bootstrap Template + FrontEnd | DexignZone</title>

  <!-- Meta -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="author" content="DexignZone">
  <meta name="robots" content="index, follow">

  <!-- MOBILE SPECIFIC -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Favicon icon -->
  <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets') }}/images/favicon.png">
  <link href="{{ asset('assets') }}/vendor/bootstrap-select/dist/css/bootstrap-select.min.css" rel="stylesheet">
  <link class="main-css" href="{{ asset('assets') }}/css/style.css" rel="stylesheet">

</head>

<body class="h-100">
  <div class="authincation fix-wrapper"
    style="background-image: url({{ asset('assets') }}/images/student-bg.jpg); background-repeat:no-repeat; background-size:cover;">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-lg-6 col-sm-12">
          <div class="form-input-content  error-page">
            <h1 class="error-text text-primary">403</h1>
            <h4> Akses Ditolak!</h4>
            <p>Anda tidak memiliki izin untuk mengakses sumber daya ini.</p>
            <a class="btn btn-primary" href="{{ route(Auth::user()->getRoleNames()->first() . '.dashboard') }}">Kembali
              ke Dashboard</a>
          </div>
        </div>
        <div class="col-lg-6 col-sm-12">
          <img class="w-100" src="{{ asset('assets') }}/images/under-m.png" alt="">
        </div>
      </div>
    </div>
  </div>
  <!--**********************************
    Scripts
  ***********************************-->
  <!-- Required vendors -->
  <script src="{{ asset('assets') }}/vendor/global/global.min.js"></script>
  <script src="{{ asset('assets') }}/vendor/bootstrap-select/dist/js/bootstrap-select.min.js"></script>
  <script src="{{ asset('assets') }}/js/custom.min.js"></script>
  <script src="{{ asset('assets') }}/js/deznav-init.js"></script>
  <script src="{{ asset('assets') }}/js/demo.js"></script>
  <script src="{{ asset('assets') }}/js/styleSwitcher.js"></script>

</body>

</html>
