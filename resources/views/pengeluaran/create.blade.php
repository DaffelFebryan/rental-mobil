@extends('layouts.app')
@section('title', 'Tambah Pengeluaran')
@section('content')
<h3 class="mb-4">Tambah Pengeluaran</h3>
<div class="card p-4">
    <form action="{{ route('pengeluaran.store') }}" method="POST">
        @csrf
        <div class="row g-3">
            <div class="col-md-6">
                <label class="form-label">Kategori</label>
                <select name="kategori" class="form-select" required>
                    <option value="">-- Pilih Kategori --</option>
                    <option value="Perawatan Mobil">Perawatan Mobil</option>
                    <option value="BBM">BBM</option>
                    <option value="Gaji Karyawan">Gaji Karyawan</option>
                    <option value="Asuransi">Asuransi</option>
                    <option value="Pajak Kendaraan">Pajak Kendaraan</option>
                    <option value="Lainnya">Lainnya</option>
                </select>
            </div>
            <div class="col-md-6">
                <label class="form-label">Tanggal</label>
                <input type="date" name="tanggal" class="form-control" value="{{ old('tanggal', date('Y-m-d')) }}" required>
            </div>
            <div class="col-md-12">
                <label class="form-label">Keterangan</label>
                <input type="text" name="keterangan" class="form-control" placeholder="Contoh: Servis rutin Avanza B 1234 ABC" value="{{ old('keterangan') }}" required>
            </div>
            <div class="col-md-6">
                <label class="form-label">Jumlah (Rp)</label>
                <input type="number" name="jumlah" class="form-control" min="0" value="{{ old('jumlah') }}" required>
            </div>
        </div>
        <button class="btn btn-primary mt-3">Simpan</button>
        <a href="{{ route('pengeluaran.index') }}" class="btn btn-light mt-3">Batal</a>
    </form>
</div>
@endsection