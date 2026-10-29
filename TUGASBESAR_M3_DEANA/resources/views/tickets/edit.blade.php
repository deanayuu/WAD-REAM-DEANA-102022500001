@extends('layouts.app')

@section('title', 'Edit Tiket - Modul C')

@section('content')
@php
    $fasilitas_selected = explode(', ', $ticket->benefit ?? '');
@endphp

<div class="card border-0 shadow-sm mx-auto p-4" style="max-width: 600px; border-radius: 12px;">
    <h3 class="text-center mb-4 fw-bold">Edit Tipe Tiket</h3>

    @if ($errors->any())
        <div class="alert alert-danger">Semua field wajib diisi dengan benar!</div>
    @endif

    <form action="{{ route('tickets.update', $ticket) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="mb-3">
            <label class="form-label fw-semibold">Nama Pemesan / Pembeli</label>
            <input type="text" name="nama_pembeli" class="form-control" value="{{ old('nama_pembeli', $ticket->nama_pembeli) }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label fw-semibold">Kategori Tiket</label>
            <select name="kategori" class="form-select" required>
                <option value="Regular" {{ old('kategori', $ticket->tipe_tiket) == 'Regular' ? 'selected' : '' }}>Regular</option>
                <option value="Early Bird" {{ old('kategori', $ticket->tipe_tiket) == 'Early Bird' ? 'selected' : '' }}>Early Bird</option>
                <option value="VIP" {{ old('kategori', $ticket->tipe_tiket) == 'VIP' ? 'selected' : '' }}>VIP</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label fw-semibold">Harga Tiket</label>
            <input type="number" name="harga" class="form-control" value="{{ old('harga', $ticket->harga) }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label fw-semibold">Kuota Tiket</label>
            <input type="number" name="kuota" class="form-control" value="{{ old('kuota', $ticket->kuota) }}" required>
        </div>

        <div class="mb-4">
            <label class="form-label fw-semibold">Fasilitas / Benefit Included:</label>
            <div class="form-check">
                <input type="checkbox" class="form-check-input" name="fasilitas[]" value="E-Certificate" {{ in_array('E-Certificate', $fasilitas_selected) ? 'checked' : '' }}> E-Certificate Resmi
            </div>
            <div class="form-check">
                <input type="checkbox" class="form-check-input" name="fasilitas[]" value="Akses Materi" {{ in_array('Akses Materi', $fasilitas_selected) ? 'checked' : '' }}> Akses Modul & Slide Materi
            </div>
            <div class="form-check">
                <input type="checkbox" class="form-check-input" name="fasilitas[]" value="Lunch & Coffee Break" {{ in_array('Lunch & Coffee Break', $fasilitas_selected) ? 'checked' : '' }}> Lunch & Coffee Break
            </div>
            <div class="form-check">
                <input type="checkbox" class="form-check-input" name="fasilitas[]" value="Merchandise Kit" {{ in_array('Merchandise Kit', $fasilitas_selected) ? 'checked' : '' }}> Merchandise / Seminar Kit
            </div>
            <div class="form-check">
                <input type="checkbox" class="form-check-input" name="fasilitas[]" value="Front Row Seat" {{ in_array('Front Row Seat', $fasilitas_selected) ? 'checked' : '' }}> Duduk Barisan Depan (VIP)
            </div>
        </div>

        <button type="submit" class="btn btn-warning w-100 py-2 fw-bold text-dark">Perbarui Tiket</button>
        <div class="text-center mt-3">
            <a href="{{ route('tickets.index') }}" class="text-decoration-none text-muted">← Kembali ke Daftar Tiket</a>
        </div>
    </form>
</div>
@endsection
