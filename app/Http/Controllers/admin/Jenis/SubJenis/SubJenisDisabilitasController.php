<?php

namespace App\Http\Controllers\admin\Jenis\SubJenis;

use App\Http\Controllers\Controller;
use App\Http\Requests\Jenis\SubJenis\SubJenisDisabilitasRequest;
use App\Models\DisabilitasModel;
use App\Models\Jenis\JenisDisabilitas;
use App\Models\Jenis\SubJenis\SubJenisDisabilitas;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SubJenisDisabilitasController extends Controller
{
    public function index(JenisDisabilitas $jenisDisabilitas)
    {
        $data = $jenisDisabilitas->subJenis;

        return view('admin.jenis-disabilitas.sub-jenis.sub_jenis_view', compact('data', 'jenisDisabilitas'));
    }

    public function store(SubJenisDisabilitasRequest $request, JenisDisabilitas $jenisDisabilitas)
    {
        $subJenis = new SubJenisDisabilitas();
        $subJenis->token_sub_jenis = Str::uuid()->toString();
        $subJenis->jenis_disabilitas_id = $jenisDisabilitas->id;
        $subJenis->fill($request->validated());
        $subJenis->save();

        return redirect()->route('subjenis.index', $jenisDisabilitas)->with('success', 'Sub Jenis Disabilitas berhasil ditambahkan');
    }

    public function update(SubJenisDisabilitasRequest $request, JenisDisabilitas $jenisDisabilitas, SubJenisDisabilitas $subJenisDisabilitas)
    {
        $subJenisDisabilitas->update($request->validated());

        return redirect()->route('subjenis.index', $jenisDisabilitas)->with('success', 'Sub Jenis Disabilitas berhasil diperbarui');
    }

    public function destroy(JenisDisabilitas $jenisDisabilitas, $token)
    {
        $subJenisDisabilitas = SubJenisDisabilitas::where('token_sub_jenis', $token)->firstOrFail();

        // Cek apakah sub jenis disabilitas masih digunakan di data_disabilitas
        $isUsedInDataDisabilitas = DisabilitasModel::where('id_sub_jenis_disabilitas', $subJenisDisabilitas->id)->exists();

        if ($isUsedInDataDisabilitas) {
            return redirect()->route('subjenis.index', $jenisDisabilitas)
                ->with('delete_error', 'Sub Jenis Disabilitas ini sedang digunakan dalam data disabilitas dan tidak bisa dihapus.');
        }

        $subJenisDisabilitas->delete();

        return redirect()->route('subjenis.index', $jenisDisabilitas)->with('delete_success', 'Sub Jenis Disabilitas berhasil dihapus.');
    }
}
