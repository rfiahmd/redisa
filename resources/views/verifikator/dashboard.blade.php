<?php
$title = 'Dashboard » ' . Str::ucfirst(Auth::user()->name);
$breadcrumb = 'Dashboard';
?>

@extends('layout.template')

@section('content')
    <h1>verifikator</h1>
@endsection