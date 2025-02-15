<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VerifikatorDesa extends Model
{
    use HasFactory;

    protected $table = 'verifikator_desa';
    protected $fillable = ['user_id','desa_id', 'token_verifikator', 'jabatan', 'desa'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
