@extends('layouts.app')
@section('title', 'Tambah Mobil')
@section('content')
<h3 class="mb-4">Tambah Mobil</h3>
<div class="card p-4">
    <form action="{{ route('mobil.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @include('mobil._form')
        <button class="btn btn-primary mt-3">Simpan</button>
        <a href="{{ route('mobil.index') }}" class="btn btn-light mt-3">Batal</a>
    </form>
</div>
@endsection