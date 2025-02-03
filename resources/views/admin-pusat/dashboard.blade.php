<?php
$title = 'Dashboard » ' . Str::ucfirst(Auth::user()->nama_lengkap);
$breadcrumb = 'Dashboard';
?>

@extends('layout.template')

@section('content')
    <h1>admin pusat</h1>
@endsection