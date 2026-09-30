<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'mobil_id', 'nama_penyewa', 'no_hp', 'alamat', 'tgl_mulai', 'tgl_selesai', 'total_harga', 'status',
    ];

    public function mobil()
    {
        return $this->belongsTo(Mobil::class);
    }

    public function pengembalian()
    {
        return $this->hasOne(Pengembalian::class);
    }
}