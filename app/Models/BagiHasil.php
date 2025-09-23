<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BagiHasil extends Model
{
    use HasFactory;

    protected $fillable = [
        'penyewaan_id',
        'bagi_hasil_pemilik',
        'bagi_hasil_admin',
        'settled_at',
        'tanggal',
    ];

    public function penyewaan()
    {
        return $this->belongsTo(Penyewaan::class);
    }
}
