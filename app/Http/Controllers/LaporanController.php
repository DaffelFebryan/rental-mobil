<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Mobil;
use App\Models\Pengembalian;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $dariTanggal = $request->dari ?? now()->startOfMonth()->format('Y-m-d');
        $sampaiTanggal = $request->sampai ?? now()->endOfMonth()->format('Y-m-d');

        $bookings = Booking::with('mobil', 'pengembalian')
            ->whereBetween('tgl_mulai', [$dariTanggal, $sampaiTanggal])
            ->latest('tgl_mulai')
            ->get();

        $totalPendapatan = $bookings->where('status', 'selesai')->sum('total_harga')
            + Pengembalian::whereHas('booking', function ($q) use ($dariTanggal, $sampaiTanggal) {
                $q->whereBetween('tgl_mulai', [$dariTanggal, $sampaiTanggal]);
            })->sum('denda');

        $ringkasan = [
            'total_mobil'      => Mobil::count(),
            'mobil_tersedia'   => Mobil::where('status', 'tersedia')->count(),
            'mobil_disewa'     => Mobil::where('status', 'disewa')->count(),
            'total_booking'    => $bookings->count(),
            'booking_selesai'  => $bookings->where('status', 'selesai')->count(),
            'booking_berjalan' => $bookings->whereIn('status', ['disetujui', 'berlangsung'])->count(),
            'total_pendapatan' => $totalPendapatan,
        ];

        return view('laporan.index', compact('bookings', 'ringkasan', 'dariTanggal', 'sampaiTanggal'));
    }
}
