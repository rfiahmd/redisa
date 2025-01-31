<?php
$title = 'Dashboard » ' . Str::ucfirst(Auth::user()->name);
$breadcrumb = 'Dashboard';
?>

@extends('layout.template')

@section('content')
    <h1>admin pusat</h1>
@endsection