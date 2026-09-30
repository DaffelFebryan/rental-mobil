@extends('layouts.app')
@section('title', 'Dashboard')
@section('content')
<h3 class="mb-4">Dashboard</h3>

<div class="row g-3 mb-3">
    <div class="col-md-3"><div class="card p-3"><div class="text-muted small">Total Mobil</div><div class="fs-3 fw-bold">{{ $totalMobil }}</div></div></div>
    <div class="col-md-3"><div class="card p-3"><div class="text-muted small">Mobil Tersedia</div><div class="fs-3 fw-bold text-success">{{ $mobilTersedia }}</div></div></div>
    <div class="col-md-3"><div class="card p-3"><div class="text-muted small">Mobil Disewa</div><div class="fs-3 fw-bold text-danger">{{ $mobilDisewa }}</div></div></div>
    <div class="col-md-3"><div class="card p-3"><div class="text-muted small">Booking Pending</div><div class="fs-3 fw-bold text-warning">{{ $bookingPending }}</div></div></div>
</div>

<h5 class="mb-3 mt-4">Ringkasan Keuangan — {{ \Carbon\Carbon::now()->translatedFormat('F Y') }}</h5>
<div class="row g-3 mb-4">
    <div class="col-md-4">
        <div class="card p-3" style="border-left: 4px solid #16a34a;">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <div class="text-muted small">Uang Masuk (Pendapatan)</div>
                    <div class="fs-4 fw-bold text-success">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</div>
                </div>
                <i class="bi bi-arrow-down-circle-fill text-success fs-3"></i>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card p-3" style="border-left: 4px solid #dc2626;">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <div class="text-muted small">Uang Keluar (Pengeluaran)</div>
                    <div class="fs-4 fw-bold text-danger">Rp {{ number_format($totalPengeluaran, 0, ',', '.') }}</div>
                </div>
                <i class="bi bi-arrow-up-circle-fill text-danger fs-3"></i>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card p-3" style="border-left: 4px solid {{ $labaBersih >= 0 ? '#2563eb' : '#dc2626' }};">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <div class="text-muted small">Laba Bersih</div>
                    <div class="fs-4 fw-bold {{ $labaBersih >= 0 ? 'text-primary' : 'text-danger' }}">
                        Rp {{ number_format($labaBersih, 0, ',', '.') }}
                    </div>
                </div>
                <i class="bi bi-wallet2 {{ $labaBersih >= 0 ? 'text-primary' : 'text-danger' }} fs-3"></i>
            </div>
        </div>
    </div>
</div>

<div class="card p-3">
    <h5 class="mb-3">Booking Terbaru</h5>
    <table class="table table-hover align-middle">
        <thead><tr><th>Penyewa</th><th>Mobil</th><th>Tgl Mulai</th><th>Tgl Selesai</th><th>Status</th></tr></thead>
        <tbody>
        @forelse ($bookingTerbaru as $b)
            <tr>
                <td>{{ $b->nama_penyewa }}</td>
                <td>{{ $b->mobil->nama_mobil }}</td>
                <td>{{ $b->tgl_mulai }}</td>
                <td>{{ $b->tgl_selesai }}</td>
                <td><span class="badge bg-secondary">{{ $b->status }}</span></td>
            </tr>
        @empty
            <tr><td colspan="5" class="text-center text-muted">Belum ada booking.</td></tr>
        @endforelse
        </tbody>
    </table>
</div>
@endsection