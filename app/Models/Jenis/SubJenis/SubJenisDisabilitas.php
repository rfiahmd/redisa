<?php

namespace App\Models\Jenis\SubJenis;

use App\Models\Jenis\JenisDisabilitas;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubJenisDisabilitas extends Model
{
    use HasFactory;

    protected $fillable = [
        'token_sub_jenis',
        'jenis_disabilitas_id',
        'nama_sub_jenis',
        'keterangan',
    ];

    public function jenisDisabilitas()
    {
        return $this->belongsTo(JenisDisabilitas::class, 'jenis_disabilitas_id');
    }
}
