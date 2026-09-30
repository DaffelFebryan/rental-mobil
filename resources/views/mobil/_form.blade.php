@php $mobil = $mobil ?? null; @endphp
<div class="row g-3">
    <div class="col-md-6">
        <label class="form-label">Nama Mobil</label>
        <input type="text" name="nama_mobil" class="form-control" value="{{ old('nama_mobil', $mobil->nama_mobil ?? '') }}" required>
    </div>
    <div class="col-md-6">
        <label class="form-label">Merk</label>
        <input type="text" name="merk" class="form-control" value="{{ old('merk', $mobil->merk ?? '') }}" required>
    </div>
    <div class="col-md-4">
        <label class="form-label">No Polisi</label>
        <input type="text" name="no_polisi" class="form-control" value="{{ old('no_polisi', $mobil->no_polisi ?? '') }}" required>
    </div>
    <div class="col-md-4">
        <label class="form-label">Tahun</label>
        <input type="number" name="tahun" class="form-control" value="{{ old('tahun', $mobil->tahun ?? date('Y')) }}" required>
    </div>
    <div class="col-md-4">
        <label class="form-label">Harga Sewa / Hari (Rp)</label>
        <input type="number" name="harga_sewa" class="form-control" value="{{ old('harga_sewa', $mobil->harga_sewa ?? '') }}" required>
    </div>
    <div class="col-md-6">
        <label class="form-label">Status</label>
        <select name="status" id="statusMobil" class="form-select" onchange="toggleBiayaServis()">
            @foreach (['tersedia', 'disewa', 'maintenance'] as $s)
                <option value="{{ $s }}" @selected(old('status', $mobil->status ?? '') == $s)>{{ ucfirst($s) }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-md-6">
        <label class="form-label">Foto Mobil</label>
        <input type="file" name="foto" class="form-control">
    </div>

    <div class="col-md-12" id="wrapperBiayaServis" style="display:none;">
        <div class="alert alert-warning mb-2">
            <i class="bi bi-tools"></i> Mobil ini sedang/akan maintenance. Isi biaya servis di bawah untuk
            <strong>otomatis mencatatnya sebagai Pengeluaran</strong> (akan mengurangi Laba Bersih di Dashboard).
        </div>
        <label class="form-label">Biaya Servis / Perbaikan (Rp)</label>
        <input type="number" name="biaya_servis" class="form-control" min="0" placeholder="Kosongkan kalau tidak ada biaya / tidak mau dicatat">
        <div class="form-text">Setiap kali disimpan dengan status Maintenance dan kolom ini diisi, akan tercatat sebagai pengeluaran baru.</div>
    </div>
</div>

<script>
    function toggleBiayaServis() {
        var status = document.getElementById('statusMobil').value;
        var wrapper = document.getElementById('wrapperBiayaServis');
        wrapper.style.display = (status === 'maintenance') ? 'block' : 'none';
    }
    // Jalankan sekali saat halaman dimuat (untuk kasus edit yang statusnya sudah maintenance)
    document.addEventListener('DOMContentLoaded', toggleBiayaServis);
</script>