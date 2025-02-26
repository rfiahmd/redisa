<script>
  function deleteEntity(entity, token, name, param3 = null, param4 = null) {
    let entityName = '';
    let entityRoute = '';
    let warningText = '';

    // Menentukan entity dan route
    if (entity === 'jenis') {
      entityName = 'Jenis Disabilitas';
      entityRoute = '/jenis/' + token + '/delete';

      // Jika parameter ke-4 ada (hasSubJenis)
      if (param4 !== null && param4 === 'true') {
        warningText = entityName + " '" + name +
          "' akan dihapus secara permanen! Semua Sub Jenis yang terkait juga akan dihapus!";
      } else {
        warningText = entityName + " '" + name + "' akan dihapus secara permanen!";
      }

    } else if (entity === 'subjenis') {
      entityName = 'Sub Jenis Disabilitas';
      entityRoute = '/subjenis/' + param3 + '/' + token + '/delete';
      warningText = entityName + " '" + name + "' akan dihapus secara permanen!";
    } else if (entity === 'desa') {
      entityName = 'Desa';
      entityRoute = '/desa/delete/' + token;
      warningText = entityName + " '" + name + "' akan dihapus secara permanen!";
    } else if (entity === 'disabilitas') {
      entityName = 'Data Disabilitas';
      entityRoute = '/disabilitas-delete/' + token;
      warningText = entityName + " '" + name + "' akan dihapus secara permanen!";
    } else if (entity === 'users') {
      entityName = 'Users';
      entityRoute = '/users/' + token + '/delete';
      warningText = entityName + " '" + name + "' akan dihapus secara permanen!";
    } else if (entity === 'bantuan') {
      entityName = 'Bantuan';
      entityRoute = '/bantuan/' + token + '/delete';
      warningText = entityName + " '" + name + "' akan dihapus secara permanen!";
    }

    // Konfirmasi penghapusan
    Swal.fire({
      title: 'Apakah Anda yakin?',
      text: warningText,
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Ya, hapus!',
      cancelButtonText: 'Batal'
    }).then((result) => {
      if (result.isConfirmed) {
        window.location.href = entityRoute;
      } else {
        Swal.fire(
          'Dibatalkan',
          'Penghapusan ' + entityName + ' dibatalkan.',
          'info'
        );
      }
    });
  }

  // Jika ada session sukses
  @if (session('delete_success'))
    Swal.fire(
      'Terhapus!',
      '{{ session('delete_success') }}',
      'success'
    );
  @endif

  // Jika ada session error
  @if (session('delete_error'))
    Swal.fire(
      'Gagal!',
      '{{ session('delete_error') }}',
      'error'
    );
  @endif
</script>
