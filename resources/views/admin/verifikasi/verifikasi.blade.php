<?php
$title = 'Verifikasi » ' . Str::ucfirst(Auth::user()->getRoleNames()->first());
$breadcrumb = 'Verifikasi » Data Disabilitas';
?>

@extends('layout.template')

@section('content')
  <div class="card">
    <div class="card-header">
      <h4 class="card-title">Tab with icon</h4>
    </div>
    <div class="card-body">
      <!-- Nav tabs -->
      <ul class="nav nav-tabs" role="tablist">
        <li class="nav-item">
          <a class="nav-link active" data-bs-toggle="tab" href="#diterima">
            <span>
              <i class="ti-home"></i>
            </span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-bs-toggle="tab" href="#diproses">
            <span>
              <i class="ti-user"></i>
            </span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-bs-toggle="tab" href="#direvisi">
            <span>
              <i class="ti-email"></i>
            </span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-bs-toggle="tab" href="#ditolak">
            <span>
              <i class="ti-email"></i>
            </span>
          </a>
        </li>
      </ul>
      <!-- Tab panes -->
      <div class="tab-content tabcontent-border">
        <div class="tab-pane fade show active" id="diterima" role="tabpanel">
          <div class="pt-4">
            <div class="table-responsive">
              <table id="example4" class="display min-w850">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>NIK</th>
                    <th>Nama</th>
                    <th>Usia</th>
                    <th>Tingkat Kecacatan</th>
                    <th>Jenis Cacat</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>01</td>
                    <td>Tiger Nixon</td>
                    <td>#54605</td>
                    <td>Library</td>
                    <td>Cash</td>
                    <td><span class="badge light badge-success">Paid</span></td>
                    <td>2011/04/25</td>
                    <td><strong>120$</strong></td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
        <div class="tab-pane fade" id="diproses" role="tabpanel">
          <div class="pt-4">
            <h4>This is icon title</h4>
            <p>Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua, retro
              synth master cleanse. Mustache cliche tempor.
            </p>
            <p>Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua, retro
              synth master cleanse. Mustache cliche tempor.
            </p>
          </div>
        </div>
        <div class="tab-pane fade" id="direvisi" role="tabpanel">
          <div class="pt-4">
            <h4>This is icon title</h4>
            <p>Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua, retro
              synth master cleanse. Mustache cliche tempor.
            </p>
            <p>Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua, retro
              synth master cleanse. Mustache cliche tempor.
            </p>
          </div>
        </div>
        <div class="tab-pane fade" id="ditolak" role="tabpanel">
          <div class="pt-4">
            <h4>This is icon title</h4>
            <p>Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua, retro
              synth master cleanse. Mustache cliche tempor.
            </p>
            <p>Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua, retro
              synth master cleanse. Mustache cliche tempor.
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>
  </div>
@endsection
