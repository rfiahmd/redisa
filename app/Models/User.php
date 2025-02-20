<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'token_users',
        'nama_lengkap',
        'username',
        'email',
        'password',
        'email_verified_at', // Ditambahkan jika fitur verifikasi email digunakan
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = ['password', 'remember_token'];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Mutator: Enkripsi password secara otomatis saat diubah.
     */
    public function setPasswordAttribute($value)
    {
        if (!empty($value)) {
            $this->attributes['password'] = Hash::make($value);
        }
    }

    public function desa(){
        return $this->hasOne(Desa::class, 'user_id', 'id');
    }

    public function verifikatorDesa()
    {
        return $this->hasOne(VerifikatorDesa::class, 'user_id', 'id');
    }

    /**
     * Event: Beri role default saat user baru dibuat.
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($user) {
            // if (!$user->hasRole('adminpusat')) {
            //     $user->assignRole('adminpusat'); // Ganti sesuai role default yang diinginkan
            // }
        });
    }
}
