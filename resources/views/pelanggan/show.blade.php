@extends('layouts.app')
@section('title', 'Detail Pelanggan')
@section('content')
<h3 class="mb-4">Detail Pelanggan</h3>
<div class="card p-4">
    <table class="table">
        <tr><th style="width:200px">Nama</th><td>{{ $pelanggan->nama }}</td></tr>
        <tr><th>No HP</th><td>{{ $pelanggan->no_hp }}</td></tr>
        <tr><th>Email</th><td>{{ $pelanggan->email ?? '-' }}</td></tr>
        <tr><th>No KTP</th><td>{{ $pelanggan->no_ktp ?? '-' }}</td></tr>
        <tr><th>Alamat</th><td>{{ $pelanggan->alamat ?? '-' }}</td></tr>
        <tr><th>Catatan</th><td>{{ $pelanggan->catatan ?? '-' }}</td></tr>
    </table>
    <a href="{{ route('pelanggan.index') }}" class="btn btn-light">Kembali</a>
</div>
@endsection