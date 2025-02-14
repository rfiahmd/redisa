<?php
$title = 'Data Disabilitas » ' . Str::ucfirst(Auth::user()->nama_lengkap);
$breadcrumb = 'Data Disabilitas';
?>

@extends('layout.template')

@section('content')
  <div class="row">
    <div class="col-xl-12">
      <div class="filter cm-content-box box-primary">
        <div class="content-title SlideToolHeader">
          <div class="cpa">
            <i class="fa-sharp fa-solid fa-filter me-2"></i>Filter
          </div>
          <div class="tools">
            <a href="javascript:void(0);" class="expand handle"><i class="fal fa-angle-down"></i></a>
          </div>
        </div>
        <div class="cm-content-body form excerpt">
          <div class="card-body">
            <div class="row">
              <div class="col-xl-3 col-sm-6">
                <label class="form-label">Title</label>
                <input type="text" class="form-control mb-xl-0 mb-3" id="exampleFormControlInput1" placeholder="Title">
              </div>
              <div class="col-xl-3  col-sm-6 mb-3 mb-xl-0">
                <label class="form-label">Status</label>
                <select class="form-control default-select h-auto wide" aria-label="Default select example">
                  <option selected>Select Status</option>
                  <option value="1">Published</option>
                  <option value="2">Draft</option>
                  <option value="3">Trash</option>
                  <option value="4">Private</option>
                  <option value="5">Pending</option>
                </select>
              </div>
              <div class="col-xl-3 col-sm-6">
                <label class="form-label">Date</label>
                <div class="input-hasicon mb-sm-0 mb-3">
                  <input name="datepicker" class="form-control bt-datepicker">
                  <div class="icon"><i class="far fa-calendar"></i></div>
                </div>
              </div>
              <div class="col-xl-3 col-sm-6 align-self-end">
                <div>
                  <button class="btn btn-primary me-2" title="Click here to Search" type="button"><i
                      class="fa fa-filter me-1"></i>Filter</button>
                  <button class="btn btn-danger light" title="Click here to remove filter" type="button">Remove
                    Filter</button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="mb-4 pb-3">
        <a href="content-add.html" class="btn btn-primary btn-sm">Add Content</a>
      </div>
      <div class="filter cm-content-box box-primary">
        <div class="content-title SlideToolHeader">
          <div class="cpa">
            <i class="fa-solid fa-file-lines me-1"></i>Contact List
          </div>
          <div class="tools">
            <a href="javascript:void(0);" class="expand handle"><i class="fal fa-angle-down"></i></a>
          </div>
        </div>
        <div class="cm-content-body form excerpt">
          <div class="card-body pb-4">
            <div class="table-responsive">
              <table class="table">
                <thead>
                  <tr>
                    <th>S.No</th>
                    <th>Title</th>
                    <th>Status</th>
                    <th>Modified</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>1</td>
                    <td>About Us</td>
                    <td>Published</td>
                    <td>18 Feb, 2024</td>
                    <td class="text-nowrap">
                      <a href="javascript:void(0);" class="btn btn-warning btn-sm content-icon">
                        <i class="fa fa-edit"></i>
                      </a>
                      <a href="javascript:void(0);" class="btn btn-danger btn-sm content-icon">
                        <i class="fa fa-times"></i>
                      </a>
                    </td>
                  </tr>
                  <tr>
                    <td>2</td>
                    <td>FAQ</td>
                    <td>Published</td>
                    <td>13 Jan, 2024</td>
                    <td class="text-nowrap">

                      <a href="javascript:void(0);" class="btn btn-warning btn-sm content-icon">
                        <i class="fa fa-edit"></i>
                      </a>
                      <a href="javascript:void(0);" class="btn btn-danger btn-sm content-icon">
                        <i class="fa fa-times"></i>
                      </a>
                    </td>
                  </tr>
                  <tr>
                    <td>3</td>
                    <td>Pricing</td>
                    <td>Published</td>
                    <td>13 Jan, 2024</td>
                    <td class="text-nowrap">

                      <a href="javascript:void(0);" class="btn btn-warning btn-sm content-icon">
                        <i class="fa fa-edit"></i>
                      </a>
                      <a href="javascript:void(0);" class="btn btn-danger btn-sm content-icon">
                        <i class="fa fa-times"></i>
                      </a>
                    </td>
                  </tr>
                  <tr>
                    <td>4</td>
                    <td>Schedule</td>
                    <td>Published</td>
                    <td>13 Jan, 2024</td>
                    <td class="text-nowrap">

                      <a href="javascript:void(0);" class="btn btn-warning btn-sm content-icon">
                        <i class="fa fa-edit"></i>
                      </a>
                      <a href="javascript:void(0);" class="btn btn-danger btn-sm content-icon">
                        <i class="fa fa-times"></i>
                      </a>
                    </td>
                  </tr>
                  <tr>
                    <td>5</td>
                    <td>Under Maintenance</td>
                    <td>Published</td>
                    <td>25 Jan, 2024</td>
                    <td class="text-nowrap">

                      <a href="javascript:void(0);" class="btn btn-warning btn-sm content-icon">
                        <i class="fa fa-edit"></i>
                      </a>
                      <a href="javascript:void(0);" class="btn btn-danger btn-sm content-icon">
                        <i class="fa fa-times"></i>
                      </a>
                    </td>
                  </tr>
                </tbody>
              </table>
              <div class="d-flex align-items-center justify-content-between flex-wrap">
                <small class="mb-2 me-3">Page 1 of 5, showing 2 records out of 8 total, starting
                  on record 1, ending on 2</small>
                <nav aria-label="Page navigation example mb-2">
                  <ul class="pagination mb-2 mb-sm-0">
                    <li class="page-item"><a class="page-link" href="javascript:void(0);"><i
                          class="fa-solid fa-angle-left"></i></a></li>
                    <li class="page-item"><a class="page-link" href="javascript:void(0);">1</a></li>
                    <li class="page-item"><a class="page-link" href="javascript:void(0);">2</a></li>
                    <li class="page-item"><a class="page-link" href="javascript:void(0);">3</a></li>
                    <li class="page-item"><a class="page-link " href="javascript:void(0);"><i
                          class="fa-solid fa-angle-right"></i></a></li>
                  </ul>
                </nav>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="card">
    <div class="card-header">
      <h3>Data Disabilitas</h3>
      <a class="btn btn-primary" href="{{ route('disabilitas.create') }}">Tambah Data</a>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table id="example" class="display min-w850">
          <thead>
            <tr>
              <th>#</th>
              <th>NIK</th>
              <th>Nama</th>
              <th>Usia</th>
              <th>Tingkat Kecacatan</th>
              <th>Status</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($disabilitas as $get)
              <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $get->nik }}</td>
                <td>
                  <strong>{{ $get->nama }}</strong><br>
                  <a role="button" data-bs-toggle="modal" data-bs-target="#detail{{ $get->nik }}"
                    class="text-primary">Selengkapnya...</a>
                </td>
                <td>{{ $get->usia }} tahun</td>
                <td>{{ $get->tingkat_disabilitas }}</td>
                <td>
                  @if ($get->status == 'diproses')
                    <p><span class="bg-warning text-light px-2" style="border-radius: 5px;">Diproses</span></p>
                  @elseif ($get->status == 'diterima')
                    <p><span class="bg-success text-light px-2" style="border-radius: 5px;">Diterima</span></p>
                  @elseif ($get->status == 'ditolak')
                    <p><span class="bg-danger text-light px-2" style="border-radius: 5px;">Ditolak</span></p>
                  @else
                    <p><span class="bg-info text-light px-2" style="border-radius: 5px;">Direvisi</span></p>
                  @endif
                </td>
                <td>
                  <div class="d-flex">
                    <a href="{{ route('disabilitas.edit') }}" class="btn btn-primary shadow btn-xs sharp me-1">
                      <i class="fas fa-pencil-alt"></i>
                    </a>
                    <a href="javascript:void(0);" class="btn btn-danger shadow btn-xs sharp">
                      <i class="fas fa-trash-alt"></i>
                    </a>
                  </div>
                </td>
              </tr>

              {{-- Modal Detail (Tanpa Tabel) --}}
              <div class="modal fade" id="detail{{ $get->nik }}" tabindex="-1"
                aria-labelledby="modalLabel{{ $get->nik }}" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                  <div class="modal-content">
                    <div class="modal-header bg-primary">
                      <h3 class="modal-title text-light" id="modalLabel{{ $get->nik }}">Detail Data
                        {{ $get->nama }}</h3>
                      <button type="button" class="btn-close text-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <div class="card shadow">
                        <div class="card-body">
                          <div class="row">
                            <div class="col-md-6">
                              <p><strong>NIK:</strong> {{ $get->nik }}</p>
                              <p><strong>Alamat:</strong> {{ $get->alamat }}</p>
                              <p><strong>Usia:</strong> {{ $get->usia }} Tahun</p>
                              <p><strong>Jenis Kelamin:</strong> {{ $get->kelamin }}</p>
                            </div>
                            <div class="col-md-6">
                              <p><strong>Tingkat Cacat:</strong> {{ $get->tingkat_disabilitas }}</p>
                              <p><strong>Jenis Cacat:</strong> {{ $get->jenisDisabilitas->nama_jenis }},
                                {{ $get->subJenisDisabilitas->nama_sub_jenis }}</p>
                              <p><strong>Jenjang Pendidikan:</strong>
                                @if ($get->pendidikan == 'tidak')
                                  Tidak Dalam Pendidikan
                                @else
                                  {{ $get->pendidikan }}
                                @endif
                              </p>
                              <p><strong>Keterangan:</strong>
                                @if ($get->keterangan == null)
                                  Tidak Ada Keterangan
                                @else
                                  {{ $get->keterangan }}
                                @endif
                              </p>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    </div>
                  </div>
                </div>
              </div>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
@endsection
