<?php
$title = 'Dashboard » ' . Str::ucfirst(Auth::user()->name);
$breadcrumb = 'Dashboard';
?>

@extends('layout.template')

@section('content')
  <h1>super admin</h1>
@endsection
