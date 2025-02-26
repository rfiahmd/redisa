<!DOCTYPE html>
<html lang="en">

<head>
  <!--Title-->
  <title>ReDisa » {{ $title }}</title>

  <!-- MOBILE SPECIFIC -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">


  <style>
    datalist {
      max-height: 100px;
      /* Batasi tinggi maksimal */
      overflow-y: auto;
      /* Tambahkan scroll jika terlalu panjang */
    }

    textarea {
      resize: none !important;
      overflow: auto;
    }

    .swal2-select {
      display: none !important;
    }

    .logo-abbr,
    .logo-compact,
    .brand-title {
      height: auto !important;
      max-width: none !important;
      max-height: none !important;
    }

    .logo-abbr {
      margin-left: -8px !important;
      width: 63px !important;
      height: auto !important;
    }

    .logo-compact {
      width: 200px !important;
      height: auto !important;
    }

    .brand-title {
      margin-left: -10px !important;
      width: 160px !important;
      height: auto !important;
    }
  </style>

  <x-link></x-link>

</head>

<body>

  <!--*******************
        Preloader start
    ********************-->
  <div id="preloader">
    <div class="sk-three-bounce">
      <div class="sk-child sk-bounce1"></div>
      <div class="sk-child sk-bounce2"></div>
      <div class="sk-child sk-bounce3"></div>
    </div>
  </div>
  <!--*******************
        Preloader end
    ********************-->

  <!--**********************************
        Main wrapper start
    ***********************************-->
  <div id="main-wrapper">

    <!--**********************************
            Nav header start
        ***********************************-->
    <div class="nav-header">
      <a type="button" class="brand-logo">
        <img class="logo-abbr" src="{{ asset('assets') }}/images/logo1.png" alt="">
        <img class="logo-compact" src="{{ asset('assets') }}/images/text.png" alt="">
        <img class="brand-title" src="{{ asset('assets') }}/images/text.png" alt="">
      </a>

      <div class="nav-control">
        <div class="hamburger">
          <span class="line"></span><span class="line"></span><span class="line"></span>
        </div>
      </div>
    </div>
    <!--**********************************
            Nav header end
        ***********************************-->

    <!--**********************************
            Header start
        ***********************************-->
    <x-header></x-header>
    <!--**********************************
            Header end ti-comment-alt
        ***********************************-->

    <!--**********************************
            Seeder start
        ***********************************-->
    <x-seeder></x-seeder>
    <!--**********************************
            Seeder end
        ***********************************-->

    <!--**********************************
            Content body start
        ***********************************-->
    <div class="content-body default-height">
      <!-- row -->
      <div class="container-fluid">
        <div class="form-head mb-4">
          <h2 class="text-black font-w600 mb-0">{{ $breadcrumb }}</h2>
        </div>
        {{-- Content --}}
        @yield('content')
      </div>
    </div>
    <!--**********************************
            Content body end
        ***********************************-->

    <!--**********************************
            Footer start
        ***********************************-->
    <div class="footer">
      <div class="copyright">
        <p>Copyright © Designed &amp; Developed by <a href="http://turbo-main.com/" target="_blank">TurboMain</a>
          <span class="current-year">{{ date('Y') }}</span>
        </p>
      </div>
    </div>
    <!--**********************************
            Footer end
        ***********************************-->

    <!--**********************************
           Support ticket button start
        ***********************************-->

    <!--**********************************
           Support ticket button end
        ***********************************-->


  </div>
  <!--**********************************
        Main wrapper end
    ***********************************-->

  <!--**********************************
        Scripts
    ***********************************-->
  <x-alert></x-alert>
  <x-datetime></x-datetime>
  <x-delete></x-delete>
  <x-script></x-script>
  @yield('script')

</body>

</html>
