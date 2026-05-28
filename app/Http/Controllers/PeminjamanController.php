<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use App\Models\Barang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PeminjamanController extends Controller
{
    public function index()
    {
        $peminjamans = Peminjaman::with('barang')->latest()->get();
        $barangs = Barang::where('stok', '>', 0)->get();
        
        return view('peminjaman.index', compact('peminjamans', 'barangs'));
    }

    public function store(Request $request)
    {
        // PROTEKSI: Jika admin mencoba meminjam, gagalkan
        if (Auth::user()->email === 'admin@gmail.com') {
            return redirect()->back()->with('error', 'Akses ditolak: Admin hanya diperbolehkan memantau data.');
        }

        $request->validate([
            'barang_id' => 'required',
            'nama_peminjam' => 'required',
            'jumlah_pinjam' => 'required|numeric|min:1',
            'tgl_pinjam' => 'required|date',
        ]);

        $barang = Barang::findOrFail($request->barang_id);

        if ($barang->stok < $request->jumlah_pinjam) {
            return redirect()->back()->with('error', 'Maaf, stok barang tidak mencukupi!');
        }

        Peminjaman::create([
            'barang_id' => $request->barang_id,
            'nama_peminjam' => $request->nama_peminjam,
            'jumlah_pinjam' => $request->jumlah_pinjam,
            'tgl_pinjam' => $request->tgl_pinjam,
            'status' => 'Dipinjam'
        ]);

        $barang->decrement('stok', $request->jumlah_pinjam);

        return redirect()->back()->with('success', 'Peminjaman berhasil dicatat!');
    }
}