@extends('layouts.app')
@section('title', 'Edit Booking / Status Sewa')
@section('content')
<h3 class="mb-4">Edit Booking &amp; Status Sewa</h3>
<div class="card p-4">
    <form action="{{ route('booking.update', $booking) }}" method="POST">
        @csrf @method('PUT')
        <div class="row g-3">
            <div class="col-md-6">
                <label class="form-label">Mobil</label>
                <input type="text" class="form-control" value="{{ $booking->mobil->nama_mobil }} ({{ $booking->mobil->no_polisi }})" disabled>
            </div>
            <div class="col-md-6">
                <label class="form-label">Status Sewa</label>
                <select name="status" class="form-select" required>
                    @foreach (['pending','disetujui','berlangsung','selesai','dibatalkan'] as $s)
                        <option value="{{ $s }}" @selected(old('status', $booking->status) == $s)>{{ ucfirst($s) }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-6">
                <label class="form-label">Nama Penyewa</label>
                <input type="text" name="nama_penyewa" class="form-control" value="{{ old('nama_penyewa', $booking->nama_penyewa) }}" required>
            </div>
            <div class="col-md-6">
                <label class="form-label">No HP</label>
                <input type="text" name="no_hp" class="form-control" value="{{ old('no_hp', $booking->no_hp) }}" required>
            </div>
            <div class="col-md-12">
                <label class="form-label">Alamat</label>
                <input type="text" name="alamat" class="form-control" value="{{ old('alamat', $booking->alamat) }}" required>
            </div>
            <div class="col-md-6">
                <label class="form-label">Tanggal Mulai</label>
                <input type="date" name="tgl_mulai" class="form-control" value="{{ old('tgl_mulai', $booking->tgl_mulai) }}" required>
            </div>
            <div class="col-md-6">
                <label class="form-label">Tanggal Selesai</label>
                <input type="date" name="tgl_selesai" class="form-control" value="{{ old('tgl_selesai', $booking->tgl_selesai) }}" required>
            </div>
        </div>
        <button class="btn btn-primary mt-3">Update</button>
        <a href="{{ route('booking.index') }}" class="btn btn-light mt-3">Batal</a>
    </form>
</div>
@endsection