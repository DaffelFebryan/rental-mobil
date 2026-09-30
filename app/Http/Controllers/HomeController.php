<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Mobil;

class HomeController extends Controller
{
    /**
     * Menampilkan halaman utama (Dashboard) aplikasi Rental Mobil.
     */
    public function index()
    {
        $totalMobil = Mobil::count();
        $mobilTersedia = Mobil::where('status', 'tersedia')->count();
        $mobilDisewa = Mobil::where('status', 'disewa')->count();
        $bookingPending = Booking::where('status', 'pending')->count();
        $bookingBerjalan = Booking::whereIn('status', ['disetujui', 'berlangsung'])->count();
        $bookingTerbaru = Booking::with('mobil')->latest()->take(5)->get();

        return view('dashboard', compact(
            'totalMobil', 'mobilTersedia', 'mobilDisewa', 'bookingPending', 'bookingBerjalan', 'bookingTerbaru'
        ));
    }
}