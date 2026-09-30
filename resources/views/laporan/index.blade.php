@extends('layouts.app')
@section('title', 'Laporan Admin')
@section('content')
<h3 class="mb-4">Laporan Admin</h3>

<div class="card p-3 mb-3">
    <form method="GET" class="row g-2 align-items-end">
        <div class="col-md-3">
            <label class="form-label">Dari Tanggal</label>
            <input type="date" name="dari" value="{{ $dariTanggal }}" class="form-control">
        </div>
        <div class="col-md-3">
            <label class="form-label">Sampai Tanggal</label>
            <input type="date" name="sampai" value="{{ $sampaiTanggal }}" class="form-control">
        </div>
        <div class="col-md-2">
            <button class="btn btn-primary">Tampilkan</button>
        </div>
    </form>
</div>

<div class="row g-3 mb-4">
    <div class="col-md-3"><div class="card p-3"><div class="text-muted small">Total Mobil</div><div class="fs-4 fw-bold">{{ $ringkasan['total_mobil'] }}</div></div></div>
    <div class="col-md-3"><div class="card p-3"><div class="text-muted small">Booking Periode Ini</div><div class="fs-4 fw-bold">{{ $ringkasan['total_booking'] }}</div></div></div>
    <div class="col-md-3"><div class="card p-3"><div class="text-muted small">Booking Selesai</div><div class="fs-4 fw-bold text-success">{{ $ringkasan['booking_selesai'] }}</div></div></div>
    <div class="col-md-3"><div class="card p-3"><div class="text-muted small">Total Pendapatan</div><div class="fs-4 fw-bold text-primary">Rp {{ number_format($ringkasan['total_pendapatan'],0,',','.') }}</div></div></div>
</div>

<div class="card p-3">
    <h5 class="mb-3">Rincian Transaksi ({{ $dariTanggal }} s/d {{ $sampaiTanggal }})</h5>
    <table class="table table-hover align-middle">
        <thead>
            <tr><th>#</th><th>Penyewa</th><th>Mobil</th><th>Tgl Mulai</th><th>Tgl Selesai</th><th>Total Sewa</th><th>Denda</th><th>Status</th></tr>
        </thead>
        <tbody>
        @forelse ($bookings as $b)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $b->nama_penyewa }}</td>
                <td>{{ $b->mobil->nama_mobil }}</td>
                <td>{{ $b->tgl_mulai }}</td>
                <td>{{ $b->tgl_selesai }}</td>
                <td>Rp {{ number_format($b->total_harga,0,',','.') }}</td>
                <td>Rp {{ number_format($b->pengembalian->denda ?? 0,0,',','.') }}</td>
                <td><span class="badge bg-secondary">{{ $b->status }}</span></td>
            </tr>
        @empty
            <tr><td colspan="8" class="text-center text-muted">Tidak ada transaksi pada periode ini.</td></tr>
        @endforelse
        </tbody>
    </table>
</div>
@endsection