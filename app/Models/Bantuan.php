<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bantuan extends Model
{
    use HasFactory;

    protected $table = 'bantuan';

    protected $fillable = [
        'token_bantuan',
        'disabilitas_id',
        'jenis_bantuan',
        'type_bantuan',
        'nominal',
        'nama_barang',
        'jumlah_barang',
        'deskripsi',
    ];

    // Relasi ke data disabilitas
    public function disabilitas()
    {
        return $this->belongsTo(DisabilitasModel::class, 'disabilitas_id');
    }
}
