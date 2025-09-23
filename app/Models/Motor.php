<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Motor extends Model
{
    use HasFactory;

    protected $fillable = [
        'pemilik_id',
        'merk',
        'tipe_cc',
        'no_plat',
        'status',
        'photo',
        'dokumen_kepemilikan',
    ];

    public function pemilik()
    {
        return $this->belongsTo(User::class, 'pemilik_id');
    }

    public function tarif()
    {
        return $this->hasOne(TarifRental::class, 'motor_id');
    }

    public function penyewaans()
    {
        return $this->hasMany(Penyewaan::class);
    }

     public function tarifRental()
    {
        return $this->hasOne(TarifRental::class, 'motor_id');
    }
    
    
   

}
