<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    public function index()
    {
        $tickets = Ticket::latest()->get();
        return view('tickets.index', compact('tickets'));
    }

    public function create()
    {
        return view('tickets.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_pembeli' => 'required|string|max:255',
            'kategori'     => 'required|string',
            'harga'        => 'required|numeric',
            'kuota'        => 'required|numeric',
            'fasilitas'    => 'nullable|array',
        ]);

        $benefit = $request->has('fasilitas') ? implode(', ', $request->fasilitas) : '-';

        Ticket::create([
            'nama_pembeli' => $request->nama_pembeli,
            'tipe_tiket'   => $request->kategori,
            'harga'        => $request->harga,
            'kuota'        => $request->kuota,
            'benefit'      => $benefit,
        ]);

        return redirect()->route('tickets.index')->with('success', 'Tiket berhasil ditambahkan!');
    }

    public function show(Ticket $ticket)
    {
        return view('tickets.show', compact('ticket'));
    }

    public function edit(Ticket $ticket)
    {
        return view('tickets.edit', compact('ticket'));
    }

    public function update(Request $request, Ticket $ticket)
    {
        $request->validate([
            'nama_pembeli' => 'required|string|max:255',
            'kategori'     => 'required|string',
            'harga'        => 'required|numeric',
            'kuota'        => 'required|numeric',
            'fasilitas'    => 'nullable|array',
        ]);

        $benefit = $request->has('fasilitas') ? implode(', ', $request->fasilitas) : '-';

        $ticket->update([
            'nama_pembeli' => $request->nama_pembeli,
            'tipe_tiket'   => $request->kategori,
            'harga'        => $request->harga,
            'kuota'        => $request->kuota,
            'benefit'      => $benefit,
        ]);

        return redirect()->route('tickets.index')->with('success', 'Data tiket berhasil diperbarui!');
    }

    public function destroy(Ticket $ticket)
    {
        $ticket->delete();
        return redirect()->route('tickets.index')->with('success', 'Data tiket berhasil dihapus!');
    }
}