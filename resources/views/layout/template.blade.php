<!doctype html>
<html lang="en">

<!-- Mirrored from techzaa.in/reback/admin/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 30 Jan 2025 01:28:55 GMT -->

<head>
  <!-- Title Meta -->
  <meta charset="utf-8" />
  <title>Analytics | Reback - Responsive Admin Dashboard Template</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="description" content="A fully responsive premium admin dashboard template" />
  <meta name="author" content="Techzaa" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />

  <x-link></x-link>

</head>

<body>
  <!-- START Wrapper -->
  <div class="wrapper">

    <x-header></x-header>

    <x-theme></x-theme>

    <x-sidebar></x-sidebar>

    <!-- ==================================================== -->
    <!-- Start right Content here -->
    <!-- ==================================================== -->
    <div class="page-content">
      <!-- Start Container -->
      <div class="container-xxl">
        <!-- ========== Page Title Start ========== -->
        <div class="row">
          <div class="col-12">
            <div class="page-title-box">
              <h4 class="mb-0 fw-semibold">Analytics</h4>
              <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item">
                  <a href="javascript: void(0);">Dashboards</a>
                </li>
                <li class="breadcrumb-item active">Analytics</li>
              </ol>
            </div>
          </div>
        </div>
        <!-- ========== Page Title End ========== -->

        <!-- ========== Start Content ========== -->
        @yield('content')
        <!-- ========== End Content ========== -->

      </div>
      <!-- End Container -->

      <!-- ========== Footer Start ========== -->
      <footer class="footer">
        <div class="container-fluid">
          <div class="row">
            <div class="col-12 text-center">
              <script>
                document.write(new Date().getFullYear())
              </script>
              &copy; Reback. Crafted by
              <iconify-icon icon="iconamoon:heart-duotone" class="fs-18 align-middle text-danger"></iconify-icon>
              <a href="https://1.envato.market/techzaa" class="fw-bold footer-text" target="_blank">Techzaa</a>
            </div>
          </div>
        </div>
      </footer>
      <!-- ========== Footer End ========== -->

    </div>
    <!-- ==================================================== -->
    <!-- End Page Content -->
    <!-- ==================================================== -->
  </div>
  <!-- END Wrapper -->

  <x-script></x-script>

</body>

<!-- Mirrored from techzaa.in/reback/admin/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 30 Jan 2025 01:29:44 GMT -->

</html>
