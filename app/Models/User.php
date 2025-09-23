<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'nama',
        'email',
        'no_tlpn',
        'role',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    // Relasi ke Motor (sebagai pemilik)
    public function motors()
    {
        return $this->hasMany(Motor::class, 'pemilik_id');
    }

    // Relasi ke Penyewaan (sebagai penyewa)
    public function penyewaans()
    {
        return $this->hasMany(Penyewaan::class, 'penyewa_id');
    }
}
