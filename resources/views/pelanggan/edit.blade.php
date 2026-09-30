@extends('layouts.app')
@section('title', 'Edit Pelanggan')
@section('content')
<h3 class="mb-4">Edit Pelanggan</h3>
<div class="card p-4">
    <form action="{{ route('pelanggan.update', $pelanggan) }}" method="POST">
        @csrf @method('PUT')
        @include('pelanggan._form')
        <button class="btn btn-primary mt-3">Update</button>
        <a href="{{ route('pelanggan.index') }}" class="btn btn-light mt-3">Batal</a>
    </form>
</div>
@endsection