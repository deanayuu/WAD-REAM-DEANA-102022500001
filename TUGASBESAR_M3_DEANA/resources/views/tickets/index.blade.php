@extends('layouts.app')

@section('title', 'Sistem Pengelolaan Event - Tiket')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="fw-bold mb-1">Pengelolaan Tiket</h4>
    </div>
    <a href="{{ route('tickets.create') }}" class="btn btn-primary px-3 py-2 rounded-3 shadow-sm">
        <i class="bi bi-plus-lg"></i> Tambah Tiket
    </a>
</div>

<div class="card border-0 shadow-sm">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="bg-light">
                <tr>
                    <th class="ps-4">NO</th>
                    <th>NAMA PEMBELI</th>
                    <th>TIPE TIKET</th>
                    <th>HARGA</th>
                    <th>KUOTA</th>
                    <th>BENEFIT</th>
                    <th class="text-end pe-4">AKSI</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($tickets as $ticket)
                    <tr>
                        <td class="ps-4 text-muted small">{{ $loop->iteration }}</td>
                        <td><span class="fw-bold text-dark">{{ $ticket->nama_pembeli ?? '-' }}</span></td>
                        <td><span class="badge bg-info text-dark fw-semibold">{{ $ticket->tipe_tiket }}</span></td>
                        <td><span class="fw-bold text-primary">Rp {{ number_format($ticket->harga, 0, ',', '.') }}</span></td>
                        <td><span class="badge bg-light text-dark border fw-normal px-2 py-1">{{ $ticket->kuota }} Kursi</span></td>
                        <td class="text-muted small">
                            @if(!empty($ticket->benefit) && $ticket->benefit !== '-')
                                @foreach(explode(', ', $ticket->benefit) as $item)
                                    <span class="badge bg-light text-dark border me-1 mb-1">{{ $item }}</span>
                                @endforeach
                            @else
                                <span class="text-muted">-</span>
                            @endif
                        </td>
                        <td class="text-end pe-4">
                            <a href="{{ route('tickets.show', $ticket) }}" class="btn btn-outline-info btn-action me-1" title="Lihat Detail">
                                <i class="bi bi-eye"></i>
                            </a>
                            <a href="{{ route('tickets.edit', $ticket) }}" class="btn btn-outline-warning btn-action me-1" title="Edit Data">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <form action="{{ route('tickets.destroy', $ticket) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus tiket ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-danger btn-action" title="Hapus Data">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center py-5 text-muted">Belum ada data tiket. Klik tombol "Tambah Tiket" untuk menambahkan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection