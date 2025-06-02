<?php
$title = 'Dashboard » ' . Str::ucfirst(Auth::user()->getRoleNames()->first());
$breadcrumb = 'Dashboard';
?>

@extends('layout.template')

@section('content')
  <div class="row">
    <div class="col-xl-4 col-sm-6">
      <div class="card">
        <div class="card-body">
          <div class="media align-items-center invoice-card">
            <div class="media-body">
            <h2 class="text-black font-w600">{{ $totalKategori }}</h2>
              <span>Total Jenis Disabilitas</span>
            </div>
            <span class="p-3 border ms-3 rounded-circle">
              <svg width="34" height="34" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path
                  d="M13,2.05V5.08C16.39,5.57 19,8.47 19,12C19,12.9 18.82,13.75 18.5,14.54L21.12,16.07C21.68,14.83 22,13.45 22,12C22,6.82 18.05,2.55 13,2.05M12,19A7,7 0 0,1 5,12C5,8.47 7.61,5.57 11,5.08V2.05C5.94,2.55 2,6.81 2,12A10,10 0 0,0 12,22C15.3,22 18.23,20.39 20.05,17.91L17.45,16.38C16.17,18 14.21,19 12,19Z"
                  fill="#858585" />
              </svg>
            </span>
          </div>
        </div>
      </div>
    </div>
    <div class="col-xl-4 col-sm-6">
      <div class="card">
        <div class="card-body">
          <div class="media align-items-center invoice-card">
            <div class="media-body">
            <h2 class="text-black font-w600">{{ $totalDesa }}</h2>
              <span>Total Desa</span>
            </div>
            <span class="p-3 border ms-3 rounded-circle">
              <svg width="34" height="34" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path
                  d="M13,2.05V5.08C16.39,5.57 19,8.47 19,12C19,12.9 18.82,13.75 18.5,14.54L21.12,16.07C21.68,14.83 22,13.45 22,12C22,6.82 18.05,2.55 13,2.05M12,19A7,7 0 0,1 5,12C5,8.47 7.61,5.57 11,5.08V2.05C5.94,2.55 2,6.81 2,12A10,10 0 0,0 12,22C15.3,22 18.23,20.39 20.05,17.91L17.45,16.38C16.17,18 14.21,19 12,19Z"
                  fill="#858585" />
              </svg>
            </span>
          </div>
        </div>
      </div>
    </div>
    <div class="col-xl-4 col-sm-6">
      <div class="card">
        <div class="card-body">
          <div class="media align-items-center invoice-card">
            <div class="media-body">
            <h2 class="text-black font-w600">{{ $totalVerifikator }}</h2>
              <span>Total Verifikator</span>
            </div>
            <span class="p-3 border ms-3 rounded-circle">
              <svg width="34" height="34" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path
                  d="M13,2.05V5.08C16.39,5.57 19,8.47 19,12C19,12.9 18.82,13.75 18.5,14.54L21.12,16.07C21.68,14.83 22,13.45 22,12C22,6.82 18.05,2.55 13,2.05M12,19A7,7 0 0,1 5,12C5,8.47 7.61,5.57 11,5.08V2.05C5.94,2.55 2,6.81 2,12A10,10 0 0,0 12,22C15.3,22 18.23,20.39 20.05,17.91L17.45,16.38C16.17,18 14.21,19 12,19Z"
                  fill="#858585" />
              </svg>
            </span>
          </div>
        </div>
      </div>
    </div>
    <div class="col-xl-6 col-sm-6">
      <div class="card">
        <div class="card-body">
          <div class="media align-items-center invoice-card">
            <div class="media-body">
            <h2 class="text-black font-w600">{{ $disabilitasDiterima }}</h2>
              <span>Total Data Disabilitas</span>
            </div>
            <span class="p-3 border ms-3 rounded-circle">
              <svg width="34" height="34" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path
                  d="M13,2.05V5.08C16.39,5.57 19,8.47 19,12C19,12.9 18.82,13.75 18.5,14.54L21.12,16.07C21.68,14.83 22,13.45 22,12C22,6.82 18.05,2.55 13,2.05M12,19A7,7 0 0,1 5,12C5,8.47 7.61,5.57 11,5.08V2.05C5.94,2.55 2,6.81 2,12A10,10 0 0,0 12,22C15.3,22 18.23,20.39 20.05,17.91L17.45,16.38C16.17,18 14.21,19 12,19Z"
                  fill="#858585" />
              </svg>
            </span>
          </div>
        </div>
      </div>
    </div>
    <div class="col-xl-6 col-sm-6">
      <div class="card">
        <div class="card-body">
          <div class="media align-items-center invoice-card">
            <div class="media-body">
              <h2 class="text-black font-w600">{{ $totalBantuan }}</h2>
              <span>Total Data Bantuan</span>
            </div>
            <span class="p-3 border ms-3 rounded-circle">
              <svg width="34" height="34" viewBox="0 0 34 34" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path
                  d="M32.3668 9.72969C30.9793 6.78884 28.782 4.31932 26.0137 2.58667C22.1634 0.18354 17.6028 -0.579886 13.1815 0.442442C8.7603 1.45813 4.99628 4.14008 2.59315 7.9904C0.183379 11.8407 -0.580047 16.3947 0.44228 20.8226C1.46461 25.2438 4.14656 29.0079 7.99024 31.411C10.6987 33.1038 13.8056 34 16.9854 34H17.1912C20.3577 33.9602 23.438 33.0441 26.1067 31.3579C26.8834 30.8666 27.1091 29.8443 26.6178 29.0676C26.1266 28.2909 25.1043 28.0652 24.3276 28.5564C22.1833 29.9173 19.7005 30.6542 17.1514 30.6874C14.5358 30.7206 11.98 29.997 9.74944 28.6095C6.64927 26.6711 4.49176 23.644 3.67522 20.0857C2.85869 16.5275 3.46943 12.8631 5.40787 9.76288C9.40424 3.37001 17.8617 1.4183 24.2545 5.41467C26.4851 6.80875 28.2509 8.79366 29.3662 11.157C30.4549 13.4605 30.8797 16.0163 30.5943 18.539C30.4947 19.4484 31.1453 20.2716 32.0614 20.3712C32.9709 20.4708 33.794 19.8202 33.8936 18.9041C34.2455 15.7641 33.7144 12.5909 32.3668 9.72969Z"
                  fill="#2BC155" />
                <path
                  d="M22.4914 11.2377L14.4846 19.2445L11.5169 16.2768C10.8663 15.6262 9.81732 15.6262 9.16669 16.2768C8.51605 16.9274 8.51605 17.9764 9.16669 18.6271L13.3095 22.7699C13.6348 23.0952 14.0597 23.2545 14.4846 23.2545C14.9095 23.2545 15.3345 23.0952 15.6598 22.7699L24.8351 13.588C25.4857 12.9373 25.4857 11.8883 24.8351 11.2377C24.1844 10.5937 23.1354 10.5937 22.4914 11.2377Z"
                  fill="#2BC155" />
              </svg>
            </span>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-xl-12 col-sm-12">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title">Disabilitas Terbaru</h4>
        </div>
        <div class="card-body">
          <table id="responsiveTable" class="display responsive nowrap w-100">
            <thead>
              <tr>
                <th>NIK</th>
                <th>Nama</th>
                <th>Desa</th>
                <th>Alamat</th>
                <th>Kelamin</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($disabilitas as $get)
                <tr>
                  <td>{{ $get->nik }}</td>
                  <td>{{ $get->nama }}</td>
                  <td>{{ $get->desa->nama_desa }}</td>
                  <td>{{ $get->alamat }}</td>
                  <td>{{ $get->kelamin }}</td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
  <x-verifikasi.script></x-verifikasi.script>
@endsection
