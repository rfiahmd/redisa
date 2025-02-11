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
      <form action="" method="">
        @csrf
        <div class="mb-3 vertical-radius">
          <label class="text-label form-label required">Masukkan NIK</label>
          <div class="input-group">
            <span class="input-group-text"> <i class="fa fa-user"></i></span>
            <input type="text" class="form-control" placeholder="Masukkan NIK.." required>
          </div>
          <div class="invalid-feedback">Harap Isi NIK</div>
        </div>
        <div class="mb-3 vertical-radius">
          <label class="text-label form-label required">Masukkan Nama</label>
          <div class="input-group">
            <span class="input-group-text"> <i class="fa fa-user"></i></span>
            <input type="text" class="form-control" placeholder="Masukkan Nama.." required>
          </div>
          <div class="invalid-feedback">Harap Isi Nama</div>
        </div>
        <div class="mb-3 vertical-radius">
          <label class="text-label form-label required">Masukkan Alamat</label>
          <div class="input-group">
            <span class="input-group-text"> <i class="fa-solid fa-house"></i></span>
            <input type="text" class="form-control" placeholder="Masukkan Alamat.." required>
          </div>
          <div class="invalid-feedback">Harap Isi Alamat</div>
        </div>
        <div class="mb-3 vertical-radius">
          <label class="text-label form-label required">Pilih Jenjang Pendidikan</label>
          <div class="input-group">
            <span class="input-group-text"> <i class="fa-solid fa-school"></i></span>
            <select class="form-control" name="jenjang_kategori" required>
              <option value="">-- Pilih Jenjang Pendidikan</option>
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
          <div class="invalid-feedback">Harap Pilih Jenjang Pendidikan</div>
        </div>
        <div class="mb-3 vertical-radius">
          <label class="text-label form-label required">Masukkan Usia</label>
          <div class="input-group">
            <span class="input-group-text"> <i class="fa-solid fa-calendar-days"></i></span>
            <input type="number" class="form-control" placeholder="Masukkan Usia.." required>
          </div>
          <div class="invalid-feedback">Harap Isi usia</div>
        </div>
        <div class="mb-3 vertical-radius">
          <label class="text-label form-label required">Pilih Jenis Kelamin</label>
          <div class="input-group">
            <div class="form-check me-3">
              <input class="form-check-input" type="radio" name="jeniskelamin" id="laki-laki">
              <label class="form-check-label" for="laki-laki">
                Laki-laki
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="jeniskelamin" id="perempuan">
              <label class="form-check-label" for="perempuan">
                Perempuan
              </label>
            </div>
          </div>
          <div class="invalid-feedback">Harap pilih jenis kelamin</div>
        </div>
        <div class="mb-3 vertical-radius">
          <label class="text-label form-label required">Tingkat Disabilitas</label>
          <div class="input-group">
            <span class="input-group-text"><i class="fa-solid fa-wheelchair"></i></span>
            <select class="form-control" name="tingkat" required>
              <option value="">-- Pilih Tingkat Disabilitas --</option>
              <option value="">Kecil</option>
              <option value="">Sedang</option>
              <option value="">Besar</option>
            </select>
          </div>
          <div class="invalid-feedback">Harap Pilih Tingkat Disabilitas</div>
        </div>
        <div class="mb-3 vertical-radius">
          <label class="text-label form-label required">Jenis Disabilitas</label>
          <div class="input-group">
            <span class="input-group-text"> <i class="fa-solid fa-wheelchair"></i></span>
            <select class="form-control" name="jenis" id="jenis">
              <option value="" disabled>-- Pilih Jenis Disabilitas --</option>
              @foreach ($jenis as $get)
              <option value="{{ $get->id }}">{{ $get->nama_jenis }}</option>
              @endforeach
            </select>
          </div>
          <div class="invalid-feedback">Harap Isi Janis Disabilitas</div>
        </div>
        <div class="mb-3 vertical-radius">
          <label class="text-label form-label required">Sub Jenis Disabilitas</label>
          <div class="input-group">
            <span class="input-group-text"> <i class="fa-solid fa-wheelchair"></i></span>
            <select class="form-control" name="subjenis" required id="subjenis">
                <option value="">-- Pilih Sub Jenis Disabilitas --</option>
            </select>
          </div>
          <div class="invalid-feedback">Harap Isi Janis Disabilitas</div>
        </div>
        <div class="mb-3 vertical-radius">
          <label class="text-label form-label required">Masukkan Keterangan</label>
          <div class="input-group">
            <span class="input-group-text"> <i class="fa-solid fa-exclamation"></i></span>
            <textarea name="keterangan" id="" class="form-control" rows="3" placeholder="Masukkan Keterangan"></textarea>
          </div>
          <div class="invalid-feedback">Harap Isi Keterangan</div>
        </div>
        <button class="btn btn-primary" type="submit">Submit</button>
      </form>
    </div>
  </div>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script>
    $(function(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    })

    $('#jenis').on('change', function(){
        let id_jenis = $('#jenis').val();

        $.ajax({
            type : 'POST',
            url : "{{ route('getSubJenis') }}",
            data : {id_jenis : id_jenis},
            cache : false,

            success : function(msg){
                console.log(msg)
                $('#subjenis').html(msg);
                $('#subjenis').selectpicker('refresh');
            },
            error : function(data){
                console.log('error:', data);
            },

        })
    })
  </script>
@endsection
