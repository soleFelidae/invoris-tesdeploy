@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="fw-bold text-success">Data Barang</h2>
        <p class="text-muted small">Daftar inventaris barang HIMSI</p>
    </div>

    @if(Auth::user()->email === 'admin@gmail.com')
    <button class="btn btn-success rounded-pill px-4 fw-bold shadow-sm" data-bs-toggle="modal" data-bs-target="#tambahBarang">
        + Tambah Barang
    </button>
    @else
    <span class="badge bg-info text-dark px-3 py-2 rounded-pill">Mode Lihat (User)</span>
    @endif
</div>

@if(session('success'))
    <div class="alert alert-success border-0 rounded-4 shadow-sm mb-4">{{ session('success') }}</div>
@endif
@if(session('error'))
    <div class="alert alert-danger border-0 rounded-4 shadow-sm mb-4">{{ session('error') }}</div>
@endif

<div class="card border-0 shadow-sm" style="border-radius: 20px; overflow: hidden;">
    <table class="table mb-0 align-middle">
        <thead style="background: #0b1315; color: white;">
            <tr>
                <th class="ps-4 py-3">KODE</th>
                <th>NAMA BARANG</th>
                <th>KATEGORI</th>
                <th class="text-center">STOK</th>
                <th>KONDISI</th>
                @if(Auth::user()->email === 'admin@gmail.com')
                <th class="pe-4 text-center">AKSI</th>
                @endif
            </tr>
        </thead>
        <tbody>
            @forelse($barangs as $b)
            <tr class="border-bottom">
                <td class="ps-4 fw-bold text-success">{{ $b->kode_barang }}</td>
                <td>{{ $b->nama_barang }}</td>
                <td><span class="badge bg-light text-dark border">{{ $b->kategori }}</span></td>
                <td class="text-center">{{ $b->stok }}</td>
                <td>{{ $b->kondisi }}</td>
                
                @if(Auth::user()->email === 'admin@gmail.com')
                <td class="pe-4 text-center">
                    <form action="{{ route('barang.destroy', $b->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus?')">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-outline-danger border-0">Hapus</button>
                    </form>
                </td>
                @endif
            </tr>
            @empty
            <tr><td colspan="6" class="text-center py-5 text-muted">Data barang kosong.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>

@if(Auth::user()->email === 'admin@gmail.com')
<div class="modal fade" id="tambahBarang" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0" style="border-radius: 25px;">
            <form action="{{ route('barang.store') }}" method="POST">
                @csrf
                <div class="modal-body p-4">
                    <h5 class="fw-bold mb-4 text-center">Tambah Barang Baru</h5>
                    <div class="mb-3">
                        <label class="small fw-bold mb-2">Kode Barang</label>
                        <input type="text" name="kode_barang" class="form-control rounded-3" placeholder="BRG-001" required>
                    </div>
                    <div class="mb-3">
                        <label class="small fw-bold mb-2">Nama Barang</label>
                        <input type="text" name="nama_barang" class="form-control rounded-3" required>
                    </div>
                    <div class="row">
                        <div class="col-6 mb-3">
                            <label class="small fw-bold mb-2">Kategori</label>
                            <select name="kategori" class="form-select rounded-3" required>
                                <option value="Elektronik">Elektronik</option>
                                <option value="Multimedia">Multimedia</option>
                                <option value="Furniture">Furniture</option>
                            </select>
                        </div>
                        <div class="col-6 mb-3">
                            <label class="small fw-bold mb-2">Stok</label>
                            <input type="number" name="stok" class="form-control rounded-3" min="1" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="small fw-bold mb-2">Kondisi</label>
                        <select name="kondisi" class="form-select rounded-3" required>
                            <option value="Ready">Ready</option>
                            <option value="Rusak">Rusak</option>
                        </select>
                    </div>
                    <input type="hidden" name="lokasi" value="Gudang">
                    <button type="submit" class="btn btn-success w-100 rounded-3 fw-bold py-2">Simpan Barang</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endif
@endsection