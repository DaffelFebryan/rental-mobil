@extends('layouts.app')
@section('title', 'Edit Mobil')
@section('content')
<h3 class="mb-4">Edit Mobil</h3>
<div class="card p-4">
    <form action="{{ route('mobil.update', $mobil) }}" method="POST" enctype="multipart/form-data">
        @csrf @method('PUT')
        @include('mobil._form')
        <button class="btn btn-primary mt-3">Update</button>
        <a href="{{ route('mobil.index') }}" class="btn btn-light mt-3">Batal</a>
    </form>
</div>
@endsection