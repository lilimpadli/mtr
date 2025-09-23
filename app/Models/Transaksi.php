<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Transaksi extends Model
{
    use HasFactory;

    protected $fillable = [
        'penyewaan_id',
        'jumlah',
        'metode_pembayaran',
        'status',
        'tanggal',
    ];

    public function penyewaan()
    {
        return $this->belongsTo(Penyewaan::class);
    }
}
