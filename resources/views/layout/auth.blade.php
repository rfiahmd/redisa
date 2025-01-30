<!DOCTYPE html>
<html lang="en" class="h-100">

<head>
  <!--Title-->
  <title>Login</title>

  <!-- Meta -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="author" content="TurboMain">
  <meta name="robots" content="index, follow">

  <meta name="twitter:image" content="social-image.png">
  <meta name="twitter:card" content="summary_large_image">

  <!-- MOBILE SPECIFIC -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Favicon icon -->
  <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('') }}assets/images/favicon.png">
  <link href="{{ asset('') }}assets/vendor/sweetalert2/dist/sweetalert2.min.css" rel="stylesheet">
  <link href="{{ asset('') }}assets/vendor/bootstrap-select/dist/css/bootstrap-select.min.css" rel="stylesheet">
  <link class="main-css" href="{{ asset('') }}assets/css/style.css" rel="stylesheet">
	
</head>

<body class="h-100">
    <div class="login-account">
		<div class="row h-100">
			<div class="col-lg-6 align-self-start">
				<div class="account-info-area" style="background-image: url({{ asset('') }}assets/images/rainbow.gif)">
					<div class="login-content">
						<p class="sub-title">Log in to your admin dashboard with your credentials</p>
						<h1 class="title">The Evolution of <span>Mophy</span></h1>
						<p class="text">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt</p>
					</div>
				</div>
			</div>
			<div class="col-lg-6 col-md-7 col-sm-12 mx-auto align-self-center">
				<div class="login-form">
					<div class="login-head">
						<h3 class="title">Welcome Back</h3>
						<p>Login page allows users to enter login credentials for authentication and access to secure content.</p>
					</div>
					@yield('form')
				</div>
			</div>
		</div>
	</div>


    <!--**********************************
        Scripts
    ***********************************-->
    <!-- Required vendors -->
  <script src="{{ asset('') }}assets/vendor/global/global.min.js"></script>
  <script src="{{ asset('') }}assets/vendor/bootstrap-select/dist/js/bootstrap-select.min.js"></script>
  <script src="{{ asset('') }}assets/vendor/sweetalert2/dist/sweetalert2.min.js"></script>
  <script src="{{ asset('') }}assets/js/custom.min.js"></script>
  <script src="{{ asset('') }}assets/js/deznav-init.js"></script>
  <script src="{{ asset('') }}assets/js/demo.js"></script>
  <script src="{{ asset('') }}assets/js/styleSwitcher.js"></script>

</body>

</html>