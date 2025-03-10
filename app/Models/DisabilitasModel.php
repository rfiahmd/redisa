<?php

namespace App\Models;

use App\Models\Jenis\JenisDisabilitas;
use App\Models\Jenis\SubJenis\SubJenisDisabilitas;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DisabilitasModel extends Model
{
    use HasFactory;

    protected $table = 'data_disabilitas';

    protected $guarded = [];

    public function jenisDisabilitas(){
        return $this->belongsTo(JenisDisabilitas::class, 'id_jenis_disabilitas', 'id');
    }

    public function subJenisDisabilitas(){
        return $this->belongsTo(SubJenisDisabilitas::class, 'id_sub_jenis_disabilitas', 'id');
    }

    public function desa(){
        return $this->belongsTo(Desa::class, 'desa_id', 'id');
    }

    public function bantuan()
{
    return $this->hasMany(Bantuan::class, 'disabilitas_id');
}
}
