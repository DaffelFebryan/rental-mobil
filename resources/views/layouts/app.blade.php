<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Rental Mobil DPL')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <style>
        body { background:#f4f6f9; }
        .sidebar { min-height:100vh; background:#1e293b; }
        .sidebar a { color:#cbd5e1; text-decoration:none; display:block; padding:.65rem 1.2rem; border-radius:.4rem; }
        .sidebar a.active, .sidebar a:hover { background:#334155; color:#fff; }
        .sidebar .brand { color:#fff; font-weight:700; padding:1rem 1.2rem; font-size:1.2rem; }
        .card { border:none; box-shadow:0 1px 3px rgba(0,0,0,.08); }
        .sidebar .user-box { border-top: 1px solid #334155; margin-top: 1rem; padding-top: 1rem; }
    </style>
</head>
<body>
<div class="d-flex">
    <div class="sidebar p-2 d-flex flex-column justify-content-between" style="width:240px;">
        <div>
            <div class="brand"><i class="bi bi-car-front-fill"></i> Rental Mobil</div>
            <nav class="mt-3 d-flex flex-column gap-1">
                <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}"><i class="bi bi-speedometer2"></i> Dashboard</a>
                <a href="{{ route('mobil.index') }}" class="{{ request()->routeIs('mobil.*') ? 'active' : '' }}"><i class="bi bi-car-front"></i> Daftar Mobil</a>
                <a href="{{ route('pelanggan.index') }}" class="{{ request()->routeIs('pelanggan.*') ? 'active' : '' }}"><i class="bi bi-people"></i> Manajemen Pelanggan</a>
                <a href="{{ route('booking.index') }}" class="{{ request()->routeIs('booking.*') ? 'active' : '' }}"><i class="bi bi-journal-check"></i> Booking &amp; Status Sewa</a>
                <a href="{{ route('pengembalian.index') }}" class="{{ request()->routeIs('pengembalian.*') ? 'active' : '' }}"><i class="bi bi-arrow-return-left"></i> Pengembalian</a>
                @if (auth()->user()->role === 'admin')
                    <a href="{{ route('laporan.index') }}" class="{{ request()->routeIs('laporan.*') ? 'active' : '' }}"><i class="bi bi-bar-chart-line"></i> Laporan Admin</a>
                @endif
            </nav>
        </div>
        <div class="user-box px-2 pb-2">
            <div class="text-light small mb-2">
                <i class="bi bi-person-circle"></i> {{ auth()->user()->name ?? '' }}
            </div>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button class="btn btn-sm btn-outline-light w-100" type="submit">
                    <i class="bi bi-box-arrow-right"></i> Logout
                </button>
            </form>
        </div>
    </div>
    <div class="flex-grow-1 p-4">
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @yield('content')
    </div>
</div>
</body>
</html>