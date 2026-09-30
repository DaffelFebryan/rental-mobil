@extends('public.layout')
@section('title', 'Beranda')
@section('content')

<section class="hero">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-7">
                <h1 class="fw-bold display-5 mb-3">Sewa Mobil Mudah, Cepat, dan Terpercaya</h1>
                <p class="lead" style="color:#cbd5e1;">Pilih dari {{ $totalMobil }} armada mobil kami, {{ $totalTersedia }} unit siap disewa hari ini. Proses booking online tanpa ribet.</p>
                <div class="d-flex gap-2 mt-4">
                    <a href="{{ route('public.katalog') }}" class="btn btn-light btn-lg fw-semibold">Lihat Katalog Mobil</a>
                    <a href="{{ route('public.booking.form') }}" class="btn btn-cta btn-lg">Booking Sekarang</a>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="container" style="margin-top:-3rem; position:relative; z-index:2;">
    <div class="row g-3">
        <div class="col-md-4">
            <div class="card p-4 text-center shadow-sm border-0">
                <i class="bi bi-car-front-fill fs-2 text-primary mb-2"></i>
                <h4 class="fw-bold mb-0">{{ $totalMobil }}+</h4>
                <p class="text-muted small mb-0">Armada Mobil</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card p-4 text-center shadow-sm border-0">
                <i class="bi bi-shield-check fs-2 text-success mb-2"></i>
                <h4 class="fw-bold mb-0">100%</h4>
                <p class="text-muted small mb-0">Terawat &amp; Terpercaya</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card p-4 text-center shadow-sm border-0">
                <i class="bi bi-headset fs-2 text-warning mb-2"></i>
                <h4 class="fw-bold mb-0">24/7</h4>
                <p class="text-muted small mb-0">Layanan Pelanggan</p>
            </div>
        </div>
    </div>
</div>

<div class="container py-5">
    <h3 class="section-title">Mobil Tersedia untuk Disewa</h3>
    <div class="row g-4">
        @forelse ($mobilUnggulan as $mobil)
            <div class="col-md-4">
                <div class="card car-card">
                    <div class="car-photo">
                        @if ($mobil->foto)
                            <img src="{{ asset('storage/'.$mobil->foto) }}" alt="{{ $mobil->nama_mobil }}" style="width:100%; height:100%; object-fit:cover;">
                        @else
                            <i class="bi bi-car-front"></i>
                        @endif
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start">
                            <h5 class="card-title mb-1">{{ $mobil->nama_mobil }}</h5>
                            <span class="badge bg-success badge-status">Tersedia</span>
                        </div>
                        <p class="text-muted small mb-2">{{ $mobil->merk }} &bull; {{ $mobil->tahun }}</p>
                        <p class="fw-bold text-primary mb-3">Rp {{ number_format($mobil->harga_sewa, 0, ',', '.') }} <span class="fw-normal text-muted small">/ hari</span></p>
                        <a href="{{ route('public.detail', $mobil) }}" class="btn btn-outline-primary w-100 btn-sm">Lihat Detail</a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center text-muted py-5">
                Belum ada mobil tersedia saat ini. Silakan cek kembali nanti.
            </div>
        @endforelse
    </div>
    @if ($mobilUnggulan->isNotEmpty())
        <div class="text-center mt-4">
            <a href="{{ route('public.katalog') }}" class="btn btn-dark">Lihat Semua Mobil</a>
        </div>
    @endif
</div>

@endsection