@extends('layouts.app')

@section('title', 'Detail Tiket - Modul C')

@section('content')
<div class="card border-0 shadow-sm mx-auto p-4" style="max-width: 500px; border-radius: 12px;">
    <h3 class="text-center mb-4 fw-bold">Detail Pemesanan Tiket</h3>

    <div class="bg-light p-4 rounded-3 mb-4">
        <div class="mb-3 border-bottom pb-2">
            <small class="text-muted d-block fw-semibold">Nama Pemesan / Pembeli</small>
            <span class="fs-5 fw-bold text-dark">{{ $ticket->nama_pembeli ?? '-' }}</span>
        </div>

        <div class="mb-3 border-bottom pb-2">
            <small class="text-muted d-block fw-semibold">Kategori Tiket</small>
            <span class="badge bg-info text-dark fs-6 fw-semibold">{{ $ticket->tipe_tiket }}</span>
        </div>

        <div class="mb-3 border-bottom pb-2">
            <small class="text-muted d-block fw-semibold">Harga Tiket</small>
            <span class="fs-5 fw-bold text-primary">Rp {{ number_format($ticket->harga, 0, ',', '.') }}</span>
        </div>

        <div class="mb-3 border-bottom pb-2">
            <small class="text-muted d-block fw-semibold">Kuota Tersedia</small>
            <span class="badge bg-white text-dark border px-2 py-1">{{ $ticket->kuota }} Kursi</span>
        </div>

        <div class="mb-2">
            <small class="text-muted d-block mb-2 fw-semibold">Fasilitas / Benefit Included</small>
            @if(!empty($ticket->benefit) && $ticket->benefit !== '-')
                @foreach(explode(', ', $ticket->benefit) as $item)
                    <span class="badge bg-white text-dark border me-1 mb-1 p-2 shadow-sm" style="font-size: 13px;">
                        ✓ {{ $item }}
                    </span>
                @endforeach
            @else
                <span class="text-muted fst-italic">- Tidak Ada Benefit -</span>
            @endif
        </div>
    </div>

    <div class="d-flex justify-content-between align-items-center">
        <a href="{{ route('tickets.index') }}" class="text-decoration-none text-muted fw-semibold">← Kembali</a>
        <a href="{{ route('tickets.edit', $ticket) }}" class="btn btn-warning text-dark fw-bold px-4" style="border-radius: 8px;">Edit Tiket</a>
    </div>
</div>
@endsection