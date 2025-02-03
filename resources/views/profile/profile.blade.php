<?php
$title = 'Data Verifikator » ' . Str::ucfirst(Auth::user()->name);
$breadcrumb = ' Verifikator';
?>

@extends('layout.template')

@section('content')
  <!-- row -->
  <div class="row">
    <div class="col-lg-12">
      <div class="profile card card-body px-3 pt-3 pb-0">
        <div class="profile-head">
          <div class="photo-content">
            <div class="cover-photo rounded"></div>
          </div>
          <div class="profile-info">
            <div class="profile-photo">
              <img src="{{ asset('assets') }}/images/profile/profile.png" class="img-fluid rounded-circle" alt="">
            </div>
            <div class="profile-details">
              <div class="profile-name px-3 pt-2">
                <h4 class="text-primary mb-0">@cptl(Auth::user()->nama_lengkap)</h4>
                <p>Desa Bangkal</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-xl-4">
        {{-- row pertama --}}
      <div class="row">
        <div class="col-xl-12">
          <div class="card">
            <div class="card-body">
                <h2 class="text-primary">Profile</h2>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-xl-8">
      <div class="card h-auto">
        <div class="card-body">
          <div class="profile-tab">
            <h1>haloooo</h1>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
