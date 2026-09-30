@extends('layouts.app')
@section('title', 'Detail Booking')
@section('content')
<h3 class="mb-4">Detail Booking</h3>
<div class="card p-4">
    <table class="table">
        <tr><th style="width:200px">Mobil</th><td>{{ $booking->mobil->nama_mobil }} ({{ $booking->mobil->no_polisi }})</td></tr>
        <tr><th>Nama Penyewa</th><td>{{ $booking->nama_penyewa }}</td></tr>
        <tr><th>No HP</th><td>{{ $booking->no_hp }}</td></tr>
        <tr><th>Alamat</th><td>{{ $booking->alamat }}</td></tr>
        <tr><th>Tanggal Mulai</th><td>{{ $booking->tgl_mulai }}</td></tr>
        <tr><th>Tanggal Selesai</th><td>{{ $booking->tgl_selesai }}</td></tr>
        <tr><th>Total Harga</th><td>Rp {{ number_format($booking->total_harga,0,',','.') }}</td></tr>
        <tr><th>Status</th><td><span class="badge bg-secondary">{{ $booking->status }}</span></td></tr>
        @if ($booking->pengembalian)
        <tr><th>Tgl Kembali</th><td>{{ $booking->pengembalian->tgl_kembali }}</td></tr>
        <tr><th>Denda</th><td>Rp {{ number_format($booking->pengembalian->denda,0,',','.') }}</td></tr>
        <tr><th>Kondisi Mobil</th><td>{{ $booking->pengembalian->kondisi_mobil }}</td></tr>
        @endif
    </table>
    <a href="{{ route('booking.index') }}" class="btn btn-light">Kembali</a>
</div>
@endsection