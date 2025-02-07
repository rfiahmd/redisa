<?php
$title = 'Customer Service » ' . Str::ucfirst(Auth::user()->getRoleNames()->first());
$breadcrumb = 'Customer Service';
?>

@extends('layout.template')

@section('content')
  <style>
    table {
      min-width: 850px;
    }
  </style>
  <div class="card">
    <div class="card-body">
      <div class="default-tab">
        <ul class="nav nav-tabs" role="tablist">
          <li class="nav-item">
            <a class="nav-link active" data-bs-toggle="tab" href="#adminpusat">
              <i class="la la-user-shield me-2 text-primary"></i> Admin
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-success" data-bs-toggle="tab" href="#verifikator">
              <i class="la la-user-check me-2 text-success"></i> Verifikator
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-warning" data-bs-toggle="tab" href="#petugasdesa">
              <i class="la la-user-friends me-2 text-warning"></i> Petugas Desa
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-danger" data-bs-toggle="tab" href="#kadis">
              <i class="la la-user-tie me-2 text-danger"></i> Kepala Dinas
            </a>
          </li>
          <li class="nav-item ms-auto mb-2 me-3">
            <a class="btn btn-primary" href="javascript:void(0);" id="btnTambahCS" data-bs-toggle="offcanvas"
              data-bs-target="#offcanvasTambahCS">+ Tambah CS</a>
          </li>
        </ul>
        <div class="tab-content">
          <div class="tab-pane fade show active" id="adminpusat" role="tabpanel">
            <div class="pt-4">
              <div class="table-responsive table-hover">
                <table id="example3" class="display min-w850 mb-4 border-bottom border-top">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Nama</th>
                      <th>Email</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($adminpusat as $user)
                      <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $user->nama_lengkap }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                          <a href="javascript:void(0);" class="btn btn-primary shadow btn-xs sharp me-1">
                            <i class="fas fa-pencil-alt"></i></a>
                          <a href="javascript:void(0);" class="btn btn-danger shadow btn-xs sharp">
                            <i class="fas fa-trash-alt"></i></a>
                        </td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <div class="tab-pane fade" id="verifikator">
            <div class="pt-4">
              <div class="table-responsive table-hover">
                <table id="example3" class="display min-w850 mb-4 border-bottom border-top">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Nama</th>
                      <th>Email</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($verifikator as $user)
                      <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $user->nama_lengkap }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                          <a href="javascript:void(0);" class="btn btn-primary shadow btn-xs sharp me-1"><i
                              class="fas fa-pencil-alt"></i></a>
                          <a href="javascript:void(0);" class="btn btn-danger shadow btn-xs sharp"><i
                              class="fas fa-trash-alt"></i></a>
                        </td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <div class="tab-pane fade" id="petugasdesa">
            <div class="pt-4">
              <div class="table-responsive table-hover">
                <table id="example3" class="display min-w850 mb-4 border-bottom border-top">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Nama</th>
                      <th>Email</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($petugasdesa as $user)
                      <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $user->nama_lengkap }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                          <a href="javascript:void(0);" class="btn btn-primary shadow btn-xs sharp me-1"><i
                              class="fas fa-pencil-alt"></i></a>
                          <a href="javascript:void(0);" class="btn btn-danger shadow btn-xs sharp"><i
                              class="fas fa-trash-alt"></i></a>
                        </td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <div class="tab-pane fade" id="kadis">
            <div class="pt-4">
              <div class="table-responsive table-hover">
                <table id="example3" class="display min-w850 mb-4 border-bottom border-top">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Nama</th>
                      <th>Email</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($kadis as $user)
                      <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $user->nama_lengkap }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                          <a href="javascript:void(0);" class="btn btn-primary shadow btn-xs sharp me-1"><i
                              class="fas fa-pencil-alt"></i></a>
                          <a href="javascript:void(0);" class="btn btn-danger shadow btn-xs sharp"><i
                              class="fas fa-trash-alt"></i></a>
                        </td>
                      </tr>
                      @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  {{-- offcanvas tambah cs --}}
  <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasTambahCS" aria-labelledby="offcanvasLabel">
    <div class="offcanvas-header">
      <h5 class="offcanvas-title" id="offcanvasLabel">Tambah CS</h5>
      <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
      <!-- Form dengan action dinamis -->
      <form method="POST" action="{{ route('users.store') }}" class="form-valide-with-icon needs-validation" novalidate>
        @csrf

        <input type="hidden" name="role" id="role">
        <input type="hidden" name="password" id="password">

        <div class="mb-3 vertical-radius">
          <label class="text-label form-label required">Nama</label>
          <div class="input-group">
            <span class="input-group-text"> <i class="fa fa-user"></i></span>
            <input type="text" name="nama_lengkap" id="nama_lengkap" class="form-control"
              placeholder="Masukkan Nama Anda.." required>
          </div>
          <div class="invalid-feedback">Masukkan Nama Anda</div>
        </div>

        <div class="mb-3 vertical-radius">
          <label class="text-label form-label required">Email</label>
          <div class="input-group">
            <span class="input-group-text"> <i class="fa fa-envelope"></i></span>
            <input type="email" name="email" id="email" class="form-control"
              placeholder="Masukkan Email Anda.." required>
          </div>
          <div class="invalid-feedback">Harap Masukkan Email Dengan Benar</div>
        </div>

        <button type="submit" class="btn btn-primary w-100 mt-3">Simpan</button>
      </form>

    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <script>
    $(document).ready(function() {
      $('.nav-link').on('click', function() {
        var role = $(this).attr('href').replace('#', '');
        $('#role').val(role);
      });

      $('#role').val('adminpusat');
    });

    function generateRandomPassword() {
      const characters = 'abcdefghijklmnopqrstuvwxyz1234567890';
      let password = '';
      for (let i = 0; i < 8; i++) {
        password += characters.charAt(Math.floor(Math.random() * characters.length));
      }
      document.getElementById('password').value = password;
    }

    generateRandomPassword();
  </script>
@endsection
