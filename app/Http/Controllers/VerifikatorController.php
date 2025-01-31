<?php

namespace App\Http\Controllers;

use App\Models\Verifikator;
use Illuminate\Http\Request;

class VerifikatorController extends Controller
{
    public function index()
    {
        return view('admin.verifikator.varifikator-view');
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Verifikator $verifikator)
    {
        //
    }

    public function edit(Verifikator $verifikator)
    {
        //
    }

    public function update(Request $request, Verifikator $verifikator)
    {
        //
    }

    public function destroy(Verifikator $verifikator)
    {
        //
    }
}
