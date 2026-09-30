<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Mobil;

class MobilSeeder extends Seeder
{
    public function run(): void
    {
        $mobils = [
            [
                'nama_mobil' => 'Avanza',
                'merk'       => 'Toyota',
                'no_polisi'  => 'B 1234 ABC',
                'tahun'      => 2022,
                'harga_sewa' => 300000,
                'status'     => 'tersedia',
            ],
            [
                'nama_mobil' => 'Xenia',
                'merk'       => 'Daihatsu',
                'no_polisi'  => 'B 5678 DEF',
                'tahun'      => 2021,
                'harga_sewa' => 280000,
                'status'     => 'tersedia',
            ],
            [
                'nama_mobil' => 'Innova Reborn',
                'merk'       => 'Toyota',
                'no_polisi'  => 'B 9012 GHI',
                'tahun'      => 2023,
                'harga_sewa' => 500000,
                'status'     => 'tersedia',
            ],
            [
                'nama_mobil' => 'Brio',
                'merk'       => 'Honda',
                'no_polisi'  => 'B 3456 JKL',
                'tahun'      => 2020,
                'harga_sewa' => 250000,
                'status'     => 'maintenance',
            ],
            [
                'nama_mobil' => 'HR-V',
                'merk'       => 'Honda',
                'no_polisi'  => 'B 7890 MNO',
                'tahun'      => 2022,
                'harga_sewa' => 450000,
                'status'     => 'tersedia',
            ],
        ];

        foreach ($mobils as $mobil) {
            Mobil::create($mobil);
        }
    }
}