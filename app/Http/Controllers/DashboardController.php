<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Mobil;
use App\Models\Pengeluaran;

class DashboardController extends Controller
{
    public function index()
    {
        $totalMobil = Mobil::count();
        $mobilTersedia = Mobil::where('status', 'tersedia')->count();
        $mobilDisewa = Mobil::where('status', 'disewa')->count();
        $bookingPending = Booking::where('status', 'pending')->count();
        $bookingBerjalan = Booking::whereIn('status', ['disetujui', 'berlangsung'])->count();
        $bookingTerbaru = Booking::with('mobil')->latest()->take(5)->get();

        // ==============================================
        // STATISTIK KEUANGAN (Bulan ini)
        // ==============================================
        $bulanIni = now()->format('Y-m');

        // Pendapatan = total harga booking yang statusnya "selesai" bulan ini
        //            + total denda dari pengembalian bulan ini
        $pendapatanBooking = Booking::where('status', 'selesai')
            ->whereYear('updated_at', now()->year)
            ->whereMonth('updated_at', now()->month)
            ->sum('total_harga');

        $pendapatanDenda = \App\Models\Pengembalian::whereYear('tgl_kembali', now()->year)
            ->whereMonth('tgl_kembali', now()->month)
            ->sum('denda');

        $totalPendapatan = $pendapatanBooking + $pendapatanDenda;

        // Pengeluaran bulan ini
        $totalPengeluaran = Pengeluaran::whereYear('tanggal', now()->year)
            ->whereMonth('tanggal', now()->month)
            ->sum('jumlah');

        // Laba bersih
        $labaBersih = $totalPendapatan - $totalPengeluaran;

        return view('dashboard', compact(
            'totalMobil', 'mobilTersedia', 'mobilDisewa', 'bookingPending', 'bookingBerjalan', 'bookingTerbaru',
            'totalPendapatan', 'totalPengeluaran', 'labaBersih'
        ));
    }
}