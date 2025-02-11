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
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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

{{-- customer cervice --}}
<script>
  document.addEventListener("DOMContentLoaded", function() {
    const btnTambahCS = document.getElementById("btnTambahCS");
    const formTambahCS = document.getElementById("formTambahCS");
    const inputRole = document.getElementById("role");
    const extraVerifikator = document.getElementById("extraVerifikator");

    // Definisikan action endpoint untuk setiap role
    const actionURLs = {
      "admin": "/customer-service/admin/store",
      "verifikator": "/customer-service/verifikator/store",
      "petugasdesa": "/customer-service/petugasdesa/store",
      "kadis": "/customer-service/kadis/store"
    };

    btnTambahCS.addEventListener("click", function() {
      // Cari tab yang aktif
      let activeTab = document.querySelector(".nav-tabs .nav-link.active");

      if (activeTab) {
        let role = activeTab.getAttribute("href").replace("#", ""); // Ambil ID tab
        inputRole.value = role; // Set role ke input hidden

        // Ubah action form sesuai role yang dipilih
        formTambahCS.action = actionURLs[role];

        // Tampilkan tambahan jika role = 'verifikator'
        if (role === "verifikator") {
          extraVerifikator.style.display = "block";
        } else {
          extraVerifikator.style.display = "none";
        }
      }
    });
  });

  // tabbah form desa
  // $(document).ready(function() {
  //   $("#tambah-desa").click(function() {
  //     let desaForm = `
  //           <div class="mb-3 vertical-radius desa-group">
  //               <label class="text-label form-label required">Desa</label>
  //               <div class="input-group">
  //                   <select class="form-control" name="desa[]">
  //                       <option value="AL">Alabama</option>
  //                       <option value="WY">Wyoming</option>
  //                       <option value="UI">dlf</option>
  //                   </select>
  //                   <button type="button" class="btn btn-danger remove-desa ms-2">Hapus</button>
  //               </div>
  //           </div>
  //       `;
  //     $("#desa-container").append(desaForm);
  //   });
  //   $(document).on("click", ".remove-desa", function() {
  //     $(this).closest(".desa-group").remove();
  //   });
  // });
</script>
