<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function dssuperadmin()
    {
        return view('admin.dashboard');
    }

    public function dsadminpusat()
    {
        return view('admin-pusat.dashboard');
    }

    public function dsverifikator()
    {
        return view('verifikator.dashboard');
    }

    public function dspetugasdesa()
    {
        return view('petugas-desa.dashboard');
    }

    public function dskadis()
    {
        return view('kadis.dashboard');
    }
}
