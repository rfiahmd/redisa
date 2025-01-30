<!-- Required vendors -->
<script src="{{ asset('assets') }}/vendor/global/global.min.js"></script>
<script src="{{ asset('assets') }}/vendor/bootstrap-select/dist/js/bootstrap-select.min.js"></script>

<script src="{{ asset('assets') }}/vendor/chart-js/chart.bundle.min.js"></script>
<script src="{{ asset('assets') }}/vendor/owl-carousel/owl.carousel.js"></script>

<!-- Chart piety plugin files -->
<script src="{{ asset('assets') }}/vendor/peity/jquery.peity.min.js"></script>

<!-- Apex Chart -->
<script src="{{ asset('assets') }}/vendor/apexchart/apexchart.js"></script>

<!-- Dashboard 1 -->
<script src="{{ asset('assets') }}/js/dashboard/dashboard-1.js"></script>

<!-- Datatable -->
<script src="{{ asset('assets') }}/vendor/datatables/js/jquery.dataTables.min.js"></script>
<script src="{{ asset('assets') }}/vendor/datatables/responsive/responsive.js"></script>
<script src="{{ asset('assets') }}/js/plugins-init/datatables.init.js"></script>

<!-- Jquery Validation -->
<script src="{{ asset('assets') }}/vendor/jquery-validation/jquery.validate.min.js"></script>
<!-- Form validate init -->
<script src="{{ asset('assets') }}/js/plugins-init/jquery.validate-init.js"></script>

<script src="{{ asset('assets') }}/js/custom.min.js"></script>
<script src="{{ asset('assets') }}/js/deznav-init.js"></script>
<script src="{{ asset('assets') }}/js/demo.js"></script>
<script src="{{ asset('assets') }}/js/styleSwitcher.js"></script>

<!-- Daterangepicker -->
<!-- momment js is must -->
<script src="{{ asset('assets') }}/vendor/moment/moment.min.js"></script>
<script src="{{ asset('assets') }}/vendor/bootstrap-daterangepicker/daterangepicker.js"></script>
<!-- clockpicker -->
<script src="{{ asset('assets') }}/vendor/clockpicker/js/bootstrap-clockpicker.min.js"></script>
<!-- asColorPicker -->
<!-- asColorPicker -->
<script src="{{ asset('assets') }}/vendor/jquery-asColor/jquery-asColor.min.js"></script>
<script src="{{ asset('assets') }}/vendor/jquery-asGradient/jquery-asGradient.min.js"></script>
<script src="{{ asset('assets') }}/vendor/jquery-asColorPicker/js/jquery-asColorPicker.min.js"></script>
<!-- Material color picker -->
<script src="{{ asset('assets') }}/vendor/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js">
</script>
<!-- pickdate -->
<script src="{{ asset('assets') }}/vendor/pickadate/picker.js"></script>
<script src="{{ asset('assets') }}/vendor/pickadate/picker.time.js"></script>
<script src="{{ asset('assets') }}/vendor/pickadate/picker.date.js"></script>

<!-- SheetJS untuk Excel -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>

<!-- jsPDF untuk PDF -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.28/jspdf.plugin.autotable.min.js"></script>


<!-- Daterangepicker -->
<script src="{{ asset('assets') }}/js/plugins-init/bs-daterange-picker-init.js"></script>
<!-- Clockpicker init -->
<script src="{{ asset('assets') }}/js/plugins-init/clock-picker-init.js"></script>
<!-- asColorPicker init -->
<script src="{{ asset('assets') }}/js/plugins-init/jquery-ascolorpicker.init.js"></script>
<!-- Material color picker init -->
<script src="{{ asset('assets') }}/js/plugins-init/material-date-picker-init.js"></script>
<!-- Pickdate -->
<script src="{{ asset('assets') }}/js/plugins-init/pickadate-init.js"></script>

<!-- Toastr -->
<script src="{{ asset('assets') }}/vendor/toastr/js/toastr.min.js"></script>

<!-- All init script -->
<script src="{{ asset('assets') }}/js/plugins-init/toastr-init.js"></script>

<script>
  function carouselReview() {
    /*  testimonial one function by = owl.carousel.js */
    jQuery('.testimonial-one').owlCarousel({
      loop: true,
      margin: 10,
      autoplay: true,
      nav: false,
      center: true,
      rtl: true,
      dots: false,
      navText: ['<i class="fas fa-caret-left"></i>', '<i class="fas fa-caret-right"></i>'],
      responsive: {
        0: {
          items: 2
        },
        400: {
          items: 3
        },
        700: {
          items: 5
        },
        991: {
          items: 6
        },

        1200: {
          items: 4
        },
        1600: {
          items: 5
        }
      }
    })
  }

  jQuery(window).on('load', function() {
    setTimeout(function() {
      carouselReview();

    }, 1000);
  });


  // jQuery(document).ready(function(){
  // 	setTimeout(function(){
  // 		dezSettingsOptions.version = 'light';
  // 		new dezSettings(dezSettingsOptions);

  // 		setCookie('version','light');

  // 	},1500)
  // });
</script>
