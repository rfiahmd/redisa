  <script>
    // start per - id
    document.addEventListener("DOMContentLoaded", function() {
      // Terima
      document.querySelectorAll(".accept-button").forEach(button => {
        button.addEventListener("click", function() {
          let id = this.dataset.id;
          let name = this.dataset.name;

          Swal.fire({
            title: "Konfirmasi",
            text: `Apakah Anda yakin ingin menerima data ${name}?`,
            icon: "question",
            showCancelButton: true,
            confirmButtonText: "Ya, Terima",
            cancelButtonText: "Batal"
          }).then(result => {
            if (result.isConfirmed) {
              processAction(id, "terima");
            }
          });
        });
      });

      // Tolak
      document.querySelectorAll(".reject-button").forEach(button => {
        button.addEventListener("click", function() {
          let id = this.dataset.id;
          let name = this.dataset.name;

          Swal.fire({
            title: "Konfirmasi",
            text: `Apakah Anda yakin ingin menolak data ${name}?`,
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Ya, Tolak",
            cancelButtonText: "Batal"
          }).then(result => {
            if (result.isConfirmed) {
              processAction(id, "tolak");
            }
          });
        });
      });

      // Revisi dengan input keterangan
      document.querySelectorAll(".revise-button").forEach(button => {
        button.addEventListener("click", function() {
          let id = this.dataset.id;
          let name = this.dataset.name;

          Swal.fire({
            title: "Revisi Data",
            text: `Masukkan Catatan revisi untuk ${name}:`,
            input: "text",
            inputPlaceholder: "Masukkan alasan revisi...",
            showCancelButton: true,
            confirmButtonText: "Kirim Revisi",
            cancelButtonText: "Batal",
            preConfirm: (keterangan) => {
              if (!keterangan) {
                Swal.showValidationMessage("Keterangan harus diisi!");
              }
              return keterangan;
            }
          }).then(result => {
            if (result.isConfirmed) {
              processAction(id, "revisi", result.value);
            }
          });
        });
      });

      function processAction(id, action, keterangan = "") {
        fetch(`/verifikasi/${id}/${action}`, {
            method: "POST",
            headers: {
              "Content-Type": "application/json",
              "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify({
              keterangan
            })
          })
          .then(response => response.json())
          .then(data => {
            if (data.success) {
              Swal.fire("Berhasil!", data.message, "success").then(() => {
                location.reload();
              });
            } else {
              Swal.fire("Gagal!", data.message, "error");
            }
          })
          .catch(error => {
            Swal.fire("Error!", "Terjadi kesalahan pada server.", "error");
          });
      }
    });

    document.addEventListener("DOMContentLoaded", function() {
      document.querySelectorAll(".edit-revision-button").forEach(button => {
        button.addEventListener("click", function() {
          let id = this.dataset.id;
          let name = this.dataset.name;
          let previousValue = this.dataset.keterangan || "";

          Swal.fire({
            title: "Edit Revisi",
            text: `Masukkan keterangan revisi untuk ${name}:`,
            input: "text",
            inputValue: previousValue,
            inputPlaceholder: "Masukkan alasan revisi...",
            showCancelButton: true,
            confirmButtonText: "Simpan",
            cancelButtonText: "Batal",
            preConfirm: (keterangan) => {
              if (!keterangan) {
                Swal.showValidationMessage("Keterangan harus diisi!");
                return false;
              }
              return keterangan;
            }
          }).then((result) => {
            if (result.isConfirmed) {
              let keterangan = result.value;

              fetch("/update-revision", {
                  method: "POST",
                  headers: {
                    "Content-Type": "application/json",
                    "Accept": "application/json",
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]')?.content || ''
                  },
                  body: JSON.stringify({
                    id: id,
                    keterangan: keterangan
                  })
                })
                .then(response => response.json())
                .then(data => {
                  if (data.success) {
                    Swal.fire("Berhasil!", "Revisi telah diperbarui.", "success").then(() => {
                      location.reload();
                    });
                  } else {
                    Swal.fire("Gagal!", data.message, "error");
                  }
                })
                .catch(error => {
                  Swal.fire("Error!", "Terjadi kesalahan pada server.", "error");
                });
            }
          });
        });
      });
    });
    // end per - id

    // start all
    document.addEventListener("DOMContentLoaded", function() {
      // Terima Semua
      document.getElementById("accept-all").addEventListener("click", function() {
        Swal.fire({
          title: "Konfirmasi",
          text: "Apakah Anda yakin ingin menerima semua data?",
          icon: "question",
          showCancelButton: true,
          confirmButtonText: "Ya, Terima Semua",
          cancelButtonText: "Batal",
        }).then((result) => {
          if (result.isConfirmed) {
            processBulkAction("terima");
          }
        });
      });

      // Tolak Semua
      document.getElementById("reject-all").addEventListener("click", function() {
        Swal.fire({
          title: "Konfirmasi",
          text: "Apakah Anda yakin ingin menolak semua data?",
          icon: "warning",
          showCancelButton: true,
          confirmButtonText: "Ya, Tolak Semua",
          cancelButtonText: "Batal",
        }).then((result) => {
          if (result.isConfirmed) {
            processBulkAction("tolak");
          }
        });
      });

      // Revisi Semua dengan input keterangan
      document.getElementById("revise-all").addEventListener("click", function() {
        Swal.fire({
          title: "Revisi Semua Data",
          text: "Masukkan keterangan revisi untuk semua data:",
          input: "text",
          inputPlaceholder: "Masukkan alasan revisi...",
          showCancelButton: true,
          confirmButtonText: "Kirim Revisi Semua",
          cancelButtonText: "Batal",
          preConfirm: (keterangan) => {
            if (!keterangan) {
              Swal.showValidationMessage("Keterangan harus diisi!");
            }
            return keterangan;
          },
        }).then((result) => {
          if (result.isConfirmed) {
            processBulkAction("revisi", result.value);
          }
        });
      });

      function processBulkAction(action, keterangan = "") {
        fetch(`/verifikasi-all/${action}`, {
            method: "POST",
            headers: {
              "Content-Type": "application/json",
              "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content,
            },
            body: JSON.stringify({
              keterangan
            }),
          })
          .then((response) => response.json())
          .then((data) => {
            if (data.success) {
              Swal.fire({
                title: "Berhasil!",
                text: data.message,
                icon: "success",
              }).then(() => {
                location.reload();
              });
            } else {
              Swal.fire({
                title: "Peringatan!",
                text: data.message,
                icon: "warning",
              });
            }
          })
          .catch((error) => {
            Swal.fire({
              title: "Error!",
              text: "Terjadi kesalahan pada server.",
              icon: "error",
            });
          });
      }
    });
    // end all
  </script>
