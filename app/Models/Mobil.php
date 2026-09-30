<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mobil extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_mobil', 'merk', 'no_polisi', 'tahun', 'harga_sewa', 'status', 'foto',
    ];

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}