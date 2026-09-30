@extends('public.layout')
@section('title', 'Dashboard Saya')
@section('content')

<div class="container py-5">
    <div class="card border-0 shadow-sm p-4 mb-4" style="background: linear-gradient(135deg, #2563eb, #1d4ed8); color:#fff; border-radius:16px;">
        <h3 class="fw-bold mb-1"><i class="bi bi-person-circle"></i> Halo, {{ $user->name }}!</h3>
        <p class="mb-0" style="opacity:.9;">Selamat datang di Dashboard User. Kelola booking dan jelajahi mobil favoritmu di sini.</p>
    </div>

    <div class="row g-4 mb-4">
        <div class="col-md-4">
            <a href="{{ route('public.katalog') }}" class="text-decoration-none">
                <div class="card border-0 shadow-sm p-4 text-center h-100">
                    <i class="bi bi-car-front-fill fs-2 text-primary mb-2"></i>
                    <h6 class="fw-bold text-dark mb-0">Cari Mobil</h6>
                    <p class="text-muted small mb-0">Lihat katalog mobil tersedia</p>
                </div>
            </a>
        </div>
        <div class="col-md-4">
            <a href="{{ route('public.booking.form') }}" class="text-decoration-none">
                <div class="card border-0 shadow-sm p-4 text-center h-100">
                    <i class="bi bi-calendar-plus fs-2 text-success mb-2"></i>
                    <h6 class="fw-bold text-dark mb-0">Booking Baru</h6>
                    <p class="text-muted small mb-0">Ajukan permintaan sewa mobil</p>
                </div>
            </a>
        </div>
        <div class="col-md-4">
            <a href="{{ route('public.kontak') }}" class="text-decoration-none">
                <div class="card border-0 shadow-sm p-4 text-center h-100">
                    <i class="bi bi-headset fs-2 text-warning mb-2"></i>
                    <h6 class="fw-bold text-dark mb-0">Butuh Bantuan?</h6>
                    <p class="text-muted small mb-0">Hubungi tim kami</p>
                </div>
            </a>
        </div>
    </div>

    <div class="card border-0 shadow-sm p-4">
        <h5 class="fw-bold mb-3">Riwayat Booking Terakhir</h5>
        <p class="text-muted small">
            <i class="bi bi-info-circle"></i> Riwayat dicocokkan berdasarkan nama yang sama dengan akun kamu.
            Kalau kamu booking pakai nama berbeda, riwayat mungkin belum muncul di sini.
        </p>
        <table class="table table-hover align-middle">
            <thead>
                <tr><th>Mobil</th><th>Tgl Mulai</th><th>Tgl Selesai</th><th>Status</th></tr>
            </thead>
            <tbody>
            @forelse ($riwayatBooking as $b)
                <tr>
                    <td>{{ $b->mobil->nama_mobil }}</td>
                    <td>{{ $b->tgl_mulai }}</td>
                    <td>{{ $b->tgl_selesai }}</td>
                    <td>
                        @php
                            $badge = ['pending'=>'warning','disetujui'=>'info','berlangsung'=>'primary','selesai'=>'success','dibatalkan'=>'danger'][$b->status];
                        @endphp
                        <span class="badge bg-{{ $badge }}">{{ $b->status }}</span>
                    </td>
                </tr>
            @empty
                <tr><td colspan="4" class="text-center text-muted">Belum ada riwayat booking.</td></tr>
            @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection