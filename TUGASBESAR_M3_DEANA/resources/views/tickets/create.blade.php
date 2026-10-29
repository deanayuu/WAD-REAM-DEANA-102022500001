@extends('layouts.app')

@section('title', 'Tambah Tiket - Modul C')

@section('content')
<div class="card border-0 shadow-sm mx-auto p-4" style="max-width: 600px; border-radius: 12px;">
    <h3 class="text-center mb-4 fw-bold">Tambah Tipe Tiket</h3>

    @if ($errors->any())
        <div class="alert alert-danger">Semua field wajib diisi dengan benar!</div>
    @endif

    <form action="{{ route('tickets.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label class="form-label fw-semibold">Nama Pemesan / Pembeli</label>
            <input type="text" name="nama_pembeli" class="form-control" placeholder="Contoh: Dea" value="{{ old('nama_pembeli') }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label fw-semibold">Kategori Tiket</label>
            <select name="kategori" class="form-select" required>
                <option value="" disabled selected hidden>Pilih Kategori Tiket</option>
                <option value="Regular" {{ old('kategori') == 'Regular' ? 'selected' : '' }}>Regular</option>
                <option value="Early Bird" {{ old('kategori') == 'Early Bird' ? 'selected' : '' }}>Early Bird</option>
                <option value="VIP" {{ old('kategori') == 'VIP' ? 'selected' : '' }}>VIP</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label fw-semibold">Harga Tiket</label>
            <input type="number" name="harga" class="form-control" placeholder="Contoh: 150000" value="{{ old('harga') }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label fw-semibold">Kuota Tiket</label>
            <input type="number" name="kuota" class="form-control" placeholder="Contoh: 100" value="{{ old('kuota') }}" required>
        </div>

        <div class="mb-4">
            <label class="form-label fw-semibold">Fasilitas / Benefit Included:</label>
            <div class="form-check"><input type="checkbox" class="form-check-input" name="fasilitas[]" value="E-Certificate"> E-Certificate Resmi</div>
            <div class="form-check"><input type="checkbox" class="form-check-input" name="fasilitas[]" value="Akses Materi"> Akses Modul & Slide Materi</div>
            <div class="form-check"><input type="checkbox" class="form-check-input" name="fasilitas[]" value="Lunch & Coffee Break"> Lunch & Coffee Break</div>
            <div class="form-check"><input type="checkbox" class="form-check-input" name="fasilitas[]" value="Merchandise Kit"> Merchandise / Seminar Kit</div>
            <div class="form-check"><input type="checkbox" class="form-check-input" name="fasilitas[]" value="Front Row Seat"> Duduk Barisan Depan (VIP)</div>
        </div>

        <button type="submit" class="btn btn-primary w-100 py-2 fw-bold mb-2">Simpan Tiket</button>
        <a href="{{ route('tickets.index') }}" class="btn btn-outline-secondary w-100 py-2 fw-bold">
            ← Kembali ke Daftar Tiket
        </a>
    </form>
</div>