<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Mobil;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    /**
     * Halaman Beranda.
     */
    public function home()
    {
        $mobilUnggulan = Mobil::where('status', 'tersedia')->latest()->take(6)->get();
        $totalMobil = Mobil::count();
        $totalTersedia = Mobil::where('status', 'tersedia')->count();

        return view('public.home', compact('mobilUnggulan', 'totalMobil', 'totalTersedia'));
    }

    /**
     * Halaman Katalog Mobil (semua mobil, dengan pencarian & filter harga).
     */
    public function katalog(Request $request)
    {
        $mobils = Mobil::query()
            ->when($request->q, function ($query) use ($request) {
                $query->where('nama_mobil', 'like', '%'.$request->q.'%')
                      ->orWhere('merk', 'like', '%'.$request->q.'%');
            })
            ->when($request->status_filter === 'tersedia', function ($query) {
                $query->where('status', 'tersedia');
            })
            ->when($request->harga_max, function ($query) use ($request) {
                $query->where('harga_sewa', '<=', $request->harga_max);
            })
            ->orderBy('harga_sewa')
            ->paginate(9)
            ->withQueryString();

        return view('public.katalog', compact('mobils'));
    }

    /**
     * Halaman Detail Mobil.
     */
    public function detail(Mobil $mobil)
    {
        $mobilLain = Mobil::where('status', 'tersedia')
            ->where('id', '!=', $mobil->id)
            ->take(3)
            ->get();

        return view('public.detail', compact('mobil', 'mobilLain'));
    }

    /**
     * Form Booking Online (untuk pengunjung, tanpa perlu login).
     */
    public function bookingForm(Request $request)
    {
        $mobils = Mobil::where('status', 'tersedia')->get();
        $mobilTerpilih = $request->mobil_id;

        return view('public.booking-form', compact('mobils', 'mobilTerpilih'));
    }

    /**
     * Proses simpan booking online dari pengunjung.
     */
    public function bookingStore(Request $request)
    {
        $validated = $request->validate([
            'mobil_id'     => 'required|exists:mobils,id',
            'nama_penyewa' => 'required|string|max:255',
            'no_hp'        => 'required|string|max:20',
            'alamat'       => 'required|string',
            'tgl_mulai'    => 'required|date|after_or_equal:today',
            'tgl_selesai'  => 'required|date|after_or_equal:tgl_mulai',
        ]);

        $mobil = Mobil::findOrFail($validated['mobil_id']);

        if ($mobil->status !== 'tersedia') {
            return back()->withInput()->with('error', 'Maaf, mobil yang dipilih sudah tidak tersedia. Silakan pilih mobil lain.');
        }

        $lama = \Carbon\Carbon::parse($validated['tgl_mulai'])->diffInDays(\Carbon\Carbon::parse($validated['tgl_selesai'])) + 1;
        $validated['total_harga'] = $lama * $mobil->harga_sewa;
        $validated['status'] = 'pending';

        Booking::create($validated);
        $mobil->update(['status' => 'disewa']);

        return redirect()->route('public.booking.success')
            ->with('success', 'Permintaan booking Anda berhasil dikirim! Tim kami akan segera menghubungi Anda untuk konfirmasi.');
    }

    /**
     * Halaman sukses setelah booking online berhasil dikirim.
     */
    public function bookingSuccess()
    {
        return view('public.booking-success');
    }

    /**
     * Halaman Tentang Kami.
     */
    public function tentang()
    {
        return view('public.tentang');
    }

    /**
     * Halaman Kontak.
     */
    public function kontak()
    {
        return view('public.kontak');
    }
}