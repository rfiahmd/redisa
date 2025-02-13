<?php
$title = 'Data Verifikator » ' . Str::ucfirst(Auth::user()->nama_lengkap);
$breadcrumb = ' Verifikator';
?>

@extends('layout.template')

@section('content')
  <div class="card">
    <div class="card-header">
      <h3>Data Disabilitas</h3>
    </div>
    <div class="card-body">
      <form action="{{ route('disabilitas.store') }}" method="POST">
        @csrf
        <div class="row">
          <!-- Bagian Kiri -->
          <div class="col-md-6">
            <div class="mb-3">
              <label class="text-label form-label required">Masukkan NIK</label>
              <div class="input-group">
                <span class="input-group-text"><i class="fa fa-user"></i></span>
                <input type="text" class="form-control" placeholder="Masukkan NIK.." name="nik" required>
              </div>
            </div>

            <div class="mb-3">
              <label class="text-label form-label required">Masukkan Nama</label>
              <div class="input-group">
                <span class="input-group-text"><i class="fa fa-user"></i></span>
                <input type="text" class="form-control" name="nama" placeholder="Masukkan Nama.." required>
              </div>
            </div>

            <div class="mb-3">
              <label class="text-label form-label required">Pilih Jenis Kelamin</label>
              <div class="input-group">
                <div class="form-check me-3">
                  <input class="form-check-input" value="laki-laki" type="radio" name="jeniskelamin" id="laki-laki">
                  <label class="form-check-label" for="laki-laki">Laki-laki</label>
                </div>
                <div class="form-check">
                  <input class="form-check-input" type="radio" value="perempuan" name="jeniskelamin" id="perempuan">
                  <label class="form-check-label" for="perempuan">Perempuan</label>
                </div>
              </div>
            </div>

            <div class="mb-3">
              <label class="text-label form-label required">Masukkan Alamat</label>
              <div class="input-group">
                <span class="input-group-text"><i class="fa-solid fa-house"></i></span>
                <input type="text" class="form-control" name="alamat" placeholder="Masukkan Alamat.." required>
              </div>
            </div>

            <div class="mb-3">
              <label class="text-label form-label required">Masukkan Usia</label>
              <div class="input-group">
                <span class="input-group-text"><i class="fa-solid fa-calendar-days"></i></span>
                <input type="number" class="form-control" name="usia" placeholder="Masukkan Usia.." required>
              </div>
            </div>

            <div class="mb-3">
              <label class="text-label form-label required">Pilih Jenjang Pendidikan</label>
              <div class="input-group">
                <span class="input-group-text"><i class="fa-solid fa-school"></i></span>
                <select class="form-control" name="pendidikan" required>
                  <option value="">-- Pilih Jenjang Pendidikan --</option>
                  <option value="PAUD">PAUD</option>
                  <option value="TK">TK</option>
                  <option value="SD">SD</option>
                  <option value="SMP">SMP</option>
                  <option value="SMA">SMA</option>
                  <option value="S1">S1</option>
                  <option value="S2">S2</option>
                  <option value="S3">S3</option>
                  <option value="D1">D1</option>
                  <option value="D2">D2</option>
                  <option value="D3">D3</option>
                  <option value="Tidak">Tidak Dalam Pendidikan</option>
                </select>
              </div>
            </div>

          </div>

          <!-- Bagian Kanan -->
          <div class="col-md-6">
            <div class="mb-3">
              <label class="text-label form-label required">Tingkat Disabilitas</label>
              <div class="input-group">
                <span class="input-group-text"><i class="fa-solid fa-wheelchair"></i></span>
                <select class="form-control" name="tingkat" required>
                  <option value="">-- Pilih Tingkat Disabilitas --</option>
                  <option value="Kecil">Kecil</option>
                  <option value="Sedang">Sedang</option>
                  <option value="Besar">Besar</option>
                </select>
              </div>
            </div>

            <div class="mb-3">
              <label class="text-label form-label required">Jenis Disabilitas</label>
              <div class="input-group">
                <span class="input-group-text"><i class="fa-solid fa-wheelchair"></i></span>
                <select class="form-control" name="jenis" id="jenis">
                  <option value="">-- Pilih Jenis Disabilitas --</option>
                  @foreach ($jenis as $get)
                    <option value="{{ $get->id }}">{{ $get->nama_jenis }}</option>
                  @endforeach
                </select>
              </div>
            </div>

            <div class="mb-3">
              <label class="text-label form-label required">Sub Jenis Disabilitas</label>
              <div class="input-group">
                <span class="input-group-text"><i class="fa-solid fa-wheelchair"></i></span>
                <select class="form-control" name="subjenis" required id="subjenis">
                  <option value="">-- Pilih Sub Jenis Disabilitas --</option>
                </select>
              </div>
            </div>

            <div class="mb-3">
              <label class="text-label form-label required">Masukkan Keterangan</label>
              <div class="input-group">
                <span class="input-group-text"><i class="fa-solid fa-exclamation"></i></span>
                <textarea name="keterangan" class="form-control" rows="9" placeholder="Masukkan Keterangan"></textarea>
              </div>
            </div>
          </div>
        </div>

        <div class="text-end mt-3">
          <button class="btn btn-primary" type="submit">Submit</button>
        </div>
      </form>
    </div>
  </div>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
    integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script>
    $(function() {
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
    })

    $('#jenis').on('change', function() {
      let id_jenis = $('#jenis').val();

      $.ajax({
        type: 'POST',
        url: "{{ route('getSubJenis') }}",
        data: {
          id_jenis: id_jenis
        },
        cache: false,

        success: function(msg) {
          console.log(msg)
          $('#subjenis').html(msg);
          $('#subjenis').selectpicker('refresh');
        },
        error: function(data) {
          console.log('error:', data);
        },

      })
    })
  </script>
@endsection
