@php $pelanggan = $pelanggan ?? null; @endphp
<div class="row g-3">
    <div class="col-md-6">
        <label class="form-label">Nama</label>
        <input type="text" name="nama" class="form-control" value="{{ old('nama', $pelanggan->nama ?? '') }}" required>
    </div>
    <div class="col-md-6">
        <label class="form-label">No HP</label>
        <input type="text" name="no_hp" class="form-control" value="{{ old('no_hp', $pelanggan->no_hp ?? '') }}" required>
    </div>
    <div class="col-md-6">
        <label class="form-label">Email</label>
        <input type="email" name="email" class="form-control" value="{{ old('email', $pelanggan->email ?? '') }}">
    </div>
    <div class="col-md-6">
        <label class="form-label">No KTP</label>
        <input type="text" name="no_ktp" class="form-control" value="{{ old('no_ktp', $pelanggan->no_ktp ?? '') }}">
    </div>
    <div class="col-md-12">
        <label class="form-label">Alamat</label>
        <textarea name="alamat" class="form-control" rows="2">{{ old('alamat', $pelanggan->alamat ?? '') }}</textarea>
    </div>
    <div class="col-md-12">
        <label class="form-label">Catatan</label>
        <textarea name="catatan" class="form-control" rows="2">{{ old('catatan', $pelanggan->catatan ?? '') }}</textarea>
    </div>
</div>