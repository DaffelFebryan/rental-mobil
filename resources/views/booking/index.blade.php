@extends('layouts.app')
@section('title', 'Booking & Status Sewa')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h3>Booking &amp; Status Sewa</h3>
    <a href="{{ route('booking.create') }}" class="btn btn-primary"><i class="bi bi-plus-lg"></i> Booking Baru</a>
</div>
<div class="card p-3 mb-3">
    <form method="GET" class="row g-2">
        <div class="col-md-3">
            <select name="status" class="form-select" onchange="this.form.submit()">
                <option value="">Semua Status</option>
                @foreach (['pending','disetujui','berlangsung','selesai','dibatalkan'] as $s)
                    <option value="{{ $s }}" @selected(request('status') == $s)>{{ ucfirst($s) }}</option>
                @endforeach
            </select>
        </div>
    </form>
</div>
<div class="card p-3">
    <table class="table table-hover align-middle">
        <thead>
            <tr><th>#</th><th>Penyewa</th><th>Mobil</th><th>Tgl Mulai</th><th>Tgl Selesai</th><th>Total</th><th>Status</th><th class="text-end">Aksi</th></tr>
        </thead>
        <tbody>
        @forelse ($bookings as $booking)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $booking->nama_penyewa }}</td>
                <td>{{ $booking->mobil->nama_mobil }}</td>
                <td>{{ $booking->tgl_mulai }}</td>
                <td>{{ $booking->tgl_selesai }}</td>
                <td>Rp {{ number_format($booking->total_harga, 0, ',', '.') }}</td>
                <td>
                    @php
                        $badge = ['pending'=>'warning','disetujui'=>'info','berlangsung'=>'primary','selesai'=>'success','dibatalkan'=>'danger'][$booking->status];
                    @endphp
                    <span class="badge bg-{{ $badge }}">{{ $booking->status }}</span>
                </td>
                <td class="text-end">
                    <a href="{{ route('booking.show', $booking) }}" class="btn btn-sm btn-outline-primary"><i class="bi bi-eye"></i></a>
                    <a href="{{ route('booking.edit', $booking) }}" class="btn btn-sm btn-outline-secondary"><i class="bi bi-pencil"></i></a>
                    <form action="{{ route('booking.destroy', $booking) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus booking ini?')">
                        @csrf @method('DELETE')
                        <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                    </form>
                </td>
            </tr>
        @empty
            <tr><td colspan="8" class="text-center text-muted">Belum ada booking.</td></tr>
        @endforelse
        </tbody>
    </table>
    {{ $bookings->links() }}
</div>
@endsection