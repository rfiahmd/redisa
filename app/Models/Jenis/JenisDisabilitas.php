<?php

namespace App\Models\Jenis;

use App\Models\DisabilitasModel;
use App\Models\Jenis\SubJenis\SubJenisDisabilitas;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisDisabilitas extends Model
{
    use HasFactory;

    protected $fillable = [
        'token_jenis',
        'nama_jenis',
        'keterangan',
    ];

    public function subJenis()
    {
        return $this->hasMany(SubJenisDisabilitas::class, 'jenis_disabilitas_id');
    }

    public function dataDisabilitas(){
        return $this->hasOne(DisabilitasModel::class, 'id_jenis_disabilitas', 'id');
    }
}
