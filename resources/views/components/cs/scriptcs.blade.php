  <script>
    $(document).ready(function() {
      $('.nav-link').on('click', function() {
        var role = $(this).attr('href').replace('#', '');
        $('#role').val(role);
      });

      $('#role').val('adminpusat');
    });

    document.addEventListener("DOMContentLoaded", function() {
    let formDefault = document.getElementById("form-default");
    let formVerifikator = document.getElementById("form-verifikator");

    // Cek apakah user adalah admin pusat
    let isAdminPusat = @json(auth()->user()->hasRole('adminpusat'));

    // Jika admin pusat, langsung tampilkan form verifikator
    if (isAdminPusat) {
        formDefault.style.display = "none";
        formVerifikator.style.display = "block";
        generateRandomPassword();
    }

    // Tambahkan event listener untuk tab change
    document.querySelectorAll(".nav-link").forEach(tab => {
        tab.addEventListener("shown.bs.tab", function(event) {
            let targetTab = event.target.getAttribute("href");

            if (targetTab === "#verifikator") {
                formDefault.style.display = "none";
                formVerifikator.style.display = "block";
                generateRandomPassword();
            } else {
                formDefault.style.display = "block";
                formVerifikator.style.display = "none";
            }
        });
    });
});


    function generateRandomPassword() {
      const characters = 'abcdefghijklmnopqrstuvwxyz1234567890';
      let password = '';
      for (let i = 0; i < 8; i++) {
        password += characters.charAt(Math.floor(Math.random() * characters.length));
      }
      document.getElementById('password').value = password;
      document.getElementById('password-verifikator').value = password;
    }

    generateRandomPassword();

    $(document).ready(function() {
      $('.nav-link').on('shown.bs.tab', function(e) {
        if ($(e.target).attr('href') === '#petugasdesa') {
          $('#btnTambahCS').hide(); // Sembunyikan tombol
        } else {
          $('#btnTambahCS').show(); // Tampilkan tombol
        }
      });
    });

    // Multi select 
    $(document).ready(function() {
      $("#search-desa").on("keyup", function() {
        let query = $(this).val();
        if (query.length > 1) {
          $.ajax({
            url: "{{ route('desa.search') }}",
            type: "GET",
            data: {
              q: query
            },
            success: function(data) {
              let desaList = $("#desa-list");
              desaList.empty().show();
              if (data.length > 0) {
                data.forEach(function(desa) {
                  desaList.append(`
                <button type="button" class="dropdown-item desa-option" data-id="${desa.id}" data-name="${desa.nama_desa}" data-kecamatan="${desa.nama_kecamatan}">
                  ${desa.nama_desa} - ${desa.nama_kecamatan}
                </button>
              `);
                });
              } else {
                desaList.append(
                  '<button type="button" class="dropdown-item disabled">Tidak ditemukan</button>');
              }
            },
          });
        } else {
          $("#desa-list").hide();
        }
      });

      // Menangani pemilihan desa
      $(document).on("click", ".desa-option", function() {
        let desaId = $(this).data("id");
        let desaName = $(this).data("name");
        let desaKec = $(this).data("kecamatan");

        let selectedContainer = $("#selected-desa");
        let selectedDesaContainer = $("#selected-desa-container");

        // Cek apakah desa sudah dipilih
        if ($(`.selected-item[data-id="${desaId}"]`).length === 0) {
          selectedContainer.append(`
        <span class="badge bg-primary me-2 selected-item" data-id="${desaId}">
          ${desaName} - ${desaKec}
          <button type="button" class="btn-close btn-close-white remove-desa" data-id="${desaId}" aria-label="Close"></button>
        </span>
      `);

          // Tambahkan input hidden untuk desa yang dipilih
          selectedDesaContainer.append(`
        <input type="hidden" name="desa_id[]" value="${desaId}" id="desa-hidden-${desaId}">
      `);
        }

        $("#desa-list").hide();
        $("#search-desa").val("");
      });

      // Menghapus desa yang dipilih
      $(document).on("click", ".remove-desa", function() {
        let desaId = $(this).data("id");
        $(this).closest(".selected-item").remove();

        // Hapus input hidden desa
        $(`#desa-hidden-${desaId}`).remove();
      });

      // Menutup dropdown jika klik di luar
      $(document).on("click", function(e) {
        if (!$(e.target).closest("#search-desa, #desa-list").length) {
          $("#desa-list").hide();
        }
      });
    });

    $(document).ready(function() {
      // Pencarian desa
      $("#search-desa-edit").on("keyup", function() {
        let query = $(this).val();
        let desaList = $("#desa-list-edit");

        if (query.length > 1) {
          $.ajax({
            url: "{{ route('desa.search.edit') }}",
            type: "GET",
            data: {
              q: query
            },
            success: function(data) {
              desaList.empty(); // Kosongkan list sebelum menambah data baru

              if (data.length > 0) {
                desaList.show(); // Tampilkan dropdown jika ada data
                data.forEach(function(desa) {
                  desaList.append(`
              <button type="button" class="dropdown-item desa-option" data-id="${desa.id}" data-name="${desa.nama_desa}" data-kecamatan="${desa.nama_kecamatan}">
                ${desa.nama_desa} - ${desa.nama_kecamatan}
              </button>
            `);
                });
              } else {
                desaList.hide(); // Sembunyikan dropdown jika tidak ada data
                desaList.append(
                  '<button type="button" class="dropdown-item disabled">Tidak ditemukan</button>');
              }
            },
          });
        } else {
          desaList.hide(); // Sembunyikan dropdown jika query terlalu pendek
        }
      });

      // Menangani pemilihan desa
      $(document).on("click", ".desa-option", function() {
        let desaId = $(this).data("id");
        let desaName = $(this).data("name");
        let desaKec = $(this).data("kecamatan");

        let selectedContainer = $("#selected-desa-edit");

        // Cek apakah desa sudah dipilih
        if ($(`.selected-item-edit[data-id="${desaId}"]`).length === 0) {
          selectedContainer.append(`
        <span class="badge bg-primary me-1 selected-item-edit" data-id="${desaId}">
          ${desaName} - ${desaKec}
          <button type="button" class="btn-close btn-close-white remove-desa-edit" data-id="${desaId}" aria-label="Close"></button>
        </span>
      `);

          // Tambahkan input hidden untuk desa yang dipilih
          selectedContainer.append(`
        <input type="hidden" name="desa_id[]" value="${desaId}" id="desa-hidden-edit-${desaId}">
      `);
        }

        $("#desa-list-edit").hide(); // Sembunyikan dropdown setelah memilih desa
        $("#search-desa-edit").val(""); // Kosongkan input pencarian
      });

      // Menghapus desa yang dipilih
      $(document).on("click", ".remove-desa-edit", function() {
        let desaId = $(this).data("id");

        // Hapus elemen badge dan input hidden yang terkait
        $(this).closest(".selected-item-edit").remove();
        $(`#desa-hidden-edit-${desaId}`).remove();
      });
    });

    function togglePasswordInput(userId) {
      let passwordInput = document.getElementById('passwordInput' + userId);
      if (passwordInput) {
        passwordInput.style.display = passwordInput.style.display === 'none' ? 'block' : 'none';
      }
    }
  </script>
