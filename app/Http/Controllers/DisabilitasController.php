<?php

namespace App\Http\Controllers;

use App\Models\Jenis\JenisDisabilitas;
use App\Models\Jenis\SubJenis\SubJenisDisabilitas;
use Illuminate\Http\Request;

class DisabilitasController extends Controller
{
    public function index()
    {
        return view('petugas-desa.disabilitas.disabilitas-view');
    }

    public function create()
    {
        $data = [
            'jenis' => JenisDisabilitas::all(),
        ];
        return view('petugas-desa.disabilitas.disabilitas-create', $data);
    }

    public function getSubJenis(request $request){
        $id_jenis = $request->id_jenis;

        $subjenis = SubJenisDisabilitas::where('jenis_disabilitas_id', $id_jenis)->get();

        foreach ($subjenis as $sub) {
            echo "<option value='$sub->id'>$sub->nama_sub_jenis</option>";
        }
    }
}
