@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="fw-bold text-success">Riwayat Peminjaman</h2>
        <p class="text-muted small">Daftar aktivitas peminjaman barang inventaris</p>
    </div>

    @if(Auth::user()->email !== 'admin@gmail.com')
        <button class="btn btn-success rounded-pill px-4 fw-bold shadow-sm" data-bs-toggle="modal" data-bs-target="#modalPinjam">
            + Pinjam Barang
        </button>
    @else
        <span class="badge bg-secondary px-3 py-2 rounded-pill">Mode Admin: Read Only</span>
    @endif
</div>

@if(session('success')) <div class="alert alert-success border-0 rounded-4 shadow-sm mb-4">{{ session('success') }}</div> @endif
@if(session('error')) <div class="alert alert-danger border-0 rounded-4 shadow-sm mb-4">{{ session('error') }}</div> @endif

<div class="card border-0 shadow-sm" style="border-radius: 20px; overflow: hidden;">
    <table class="table mb-0 align-middle">
        <thead class="table-dark">
            <tr>
                <th class="ps-4 py-3">TGL PINJAM</th>
                <th>PEMINJAM</th>
                <th>BARANG</th>
                <th class="text-center">JUMLAH</th>
                <th class="text-center">STATUS</th>
            </tr>
        </thead>
        <tbody>
            @forelse($peminjamans as $p)
            <tr>
                <td class="ps-4">{{ $p->tgl_pinjam }}</td>
                <td class="fw-bold">{{ $p->nama_peminjam }}</td>
                <td>{{ $p->barang->nama_barang ?? 'N/A' }}</td>
                <td class="text-center">{{ $p->jumlah_pinjam }}</td>
                <td class="text-center">
                    <span class="badge bg-warning text-dark px-3 rounded-pill">{{ $p->status }}</span>
                </td>
            </tr>
            @empty
            <tr><td colspan="5" class="text-center py-5 text-muted">Belum ada riwayat peminjaman.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>

@if(Auth::user()->email !== 'admin@gmail.com')
<div class="modal fade" id="modalPinjam" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0" style="border-radius: 25px;">
            <form action="{{ route('peminjaman.store') }}" method="POST">
                @csrf
                <div class="modal-body p-4">
                    <h5 class="fw-bold mb-4 text-center">Form Peminjaman Barang</h5>
                    <div class="mb-3">
                        <label class="small fw-bold mb-2">Pilih Barang</label>
                        <select name="barang_id" class="form-select rounded-3" required>
                            <option value="" disabled selected>-- Pilih Barang --</option>
                            @foreach($barangs as $b)
                            <option value="{{ $b->id }}">{{ $b->nama_barang }} (Tersedia: {{ $b->stok }})</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="small fw-bold mb-2">Nama Lengkap Peminjam</label>
                        <input type="text" name="nama_peminjam" class="form-control rounded-3" placeholder="Masukkan nama peminjam" required>
                    </div>
                    <div class="row">
                        <div class="col-6 mb-3">
                            <label class="small fw-bold mb-2">Jumlah</label>
                            <input type="number" name="jumlah_pinjam" class="form-control rounded-3" min="1" required>
                        </div>
                        <div class="col-6 mb-3">
                            <label class="small fw-bold mb-2">Tanggal</label>
                            <input type="date" name="tgl_pinjam" class="form-control rounded-3" value="{{ date('Y-m-d') }}" required>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success w-100 rounded-3 fw-bold py-2 mt-2">Konfirmasi Peminjaman</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endif
@endsection