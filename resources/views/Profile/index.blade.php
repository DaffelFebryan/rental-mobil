@extends('public.layout')
@section('title', 'Profil Saya')
@section('content')

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-7">
            <h3 class="section-title">Profil Saya</h3>

            <div class="card border-0 shadow-sm p-4 mb-4">
                <div class="d-flex align-items-center mb-4">
                    <div style="width:56px; height:56px; background:#2563eb; border-radius:50%; display:flex; align-items:center; justify-content:center; color:#fff; font-size:1.4rem; font-weight:700;">
                        {{ strtoupper(substr($user->name, 0, 1)) }}
                    </div>
                    <div class="ms-3">
                        <h5 class="mb-0">{{ $user->name }}</h5>
                        <span class="badge bg-secondary text-uppercase">{{ $user->role }}</span>
                    </div>
                </div>

                <h6 class="fw-bold mb-3">Ubah Data Diri</h6>
                <form action="{{ route('profile.update-info') }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label class="form-label">Nama Lengkap</label>
                        <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}" required>
                    </div>
                    <button class="btn btn-cta">Simpan Perubahan</button>
                </form>
            </div>

            <div class="card border-0 shadow-sm p-4">
                <h6 class="fw-bold mb-3">Ubah Password</h6>
                <form action="{{ route('profile.update-password') }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label class="form-label">Password Saat Ini</label>
                        <input type="password" name="current_password" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Password Baru</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Konfirmasi Password Baru</label>
                        <input type="password" name="password_confirmation" class="form-control" required>
                    </div>
                    <button class="btn btn-outline-primary">Ubah Password</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection