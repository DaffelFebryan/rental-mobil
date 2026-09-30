<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengembalian extends Model
{
    use HasFactory;

    protected $fillable = [
        'booking_id', 'tgl_kembali', 'denda', 'kondisi_mobil', 'keterangan',
    ];

    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }
}