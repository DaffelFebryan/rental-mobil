@extends('layouts.app')
@section('title', 'Tambah Pelanggan')
@section('content')
<h3 class="mb-4">Tambah Pelanggan</h3>
<div class="card p-4">
    <form action="{{ route('pelanggan.store') }}" method="POST">
        @csrf
        @include('pelanggan._form')
        <button class="btn btn-primary mt-3">Simpan</button>
        <a href="{{ route('pelanggan.index') }}" class="btn btn-light mt-3">Batal</a>
    </form>
</div>
@endsection