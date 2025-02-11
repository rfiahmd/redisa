<?php
$title = 'Data Verifikator » ' . Str::ucfirst(Auth::user()->nama_lengkap);
$breadcrumb = ' Verifikator';
?>

@extends('layout.template')

@section('content')
  <div class="card">
    <div class="card-header">
      <h3>Data Disabilitas</h3>
      <a class="btn btn-primary" href="{{ route('disabilitas.create') }}">Tambah Data</a>
    </div>
    <div class="card-body">
      <div class="table-resonsive">
        <table id="example" class="display min-w850">
          <thead>
            <tr>
              <th>#</th>
              <th>NIK</th>
              <th>Nama</th>
              <th>Usia</th>
              <th>Asal Desa</th>
              <th>Tingkat Kecacatan</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>1</td>
              <td>123459473</td>
              <td>
                <strong>jeki seryodi</strong><br>
                <a role="button" data-bs-toggle="modal" data-bs-target="#exampleModal">Selengkapnya...</a>
              </td>
              <td>34 tahun</td>
              <td>Lobuk</td>
              <td>Berat</td>
              <td>
                <div class="d-flex">
                  <a href="{{ route('disabilitas.edit') }}" class="btn btn-primary shadow btn-xs sharp me-1"><i
                      class="fas fa-pencil-alt"></i></a>
                  <a href="javascript:void(0);" class="btn btn-danger shadow btn-xs sharp"><i
                      class="fas fa-trash-alt"></i></a>
                </div>
              </td>
              {{-- modal detail --}}
              <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h3 class="modal-title" id="exampleModalLabel">Detail Data Jeki Seryodi</h3>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <div class="row">
                        <div class="col-md-6">
                          <h6><strong>NIK:</strong> 1193819831</h6>
                          <h6><strong>Alamat:</strong> kqdkwjdq</h6>
                          <h6><strong>Jenjang Pendidikan:</strong> SD</h6>
                          <h6><strong>Usia:</strong> 25 Tahun</h6>
                          <h6><strong>Jenis Kelamin:</strong> Laki-laki</h6>
                          <h6><strong>Jenis Cacat:</strong> Kecil</h6>
                          <h6><strong>Tingkat Cacat:</strong> Sedang</h6>
                        </div>
                        <div class="col-md-6">
                          <h6><Strong>Keterangan:</Strong></h6>
                            <h6>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, voluptatem
                              consequatur. Quisquam, voluptatem consequatur.</h6>
                        </div>
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                      <button type="button" class="btn btn-primary">Save changes</button>
                    </div>
                  </div>
                </div>
              </div>
            </tr>
          </tbody>
          <tfoot>
            <tr>
              <th>#</th>
              <th>NIK</th>
              <th>Nama</th>
              <th>Usia</th>
              <th>Asal Desa</th>
              <th>Tingkat Kecacatan</th>
              <th>Action</th>
            </tr>
          </tfoot>
        </table>
      </div>
    </div>
  </div>
@endsection
