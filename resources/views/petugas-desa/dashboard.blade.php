<?php
$title = 'Dashboard » ' . Str::ucfirst(Auth::user()->getRoleNames()->first());
$breadcrumb = 'Dashboard';
?>

@extends('layout.template')

@section('content')
    <h1>petugas desa</h1>
@endsection