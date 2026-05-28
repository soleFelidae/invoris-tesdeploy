@extends('layouts.app')

@section('content')
<div class="mb-4">
    <h2 class="fw-bold text-dark">Dashboard Overview</h2>
    <p class="text-muted">Selamat datang kembali, <strong>{{ Auth::user()->name }}</strong>!</p>
</div>

<div class="row g-4 mb-5">
    <div class="col-md-4">
        <div class="card border-0 shadow-sm p-4" style="border-radius: 20px; background: #fff;">
            <div class="d-flex align-items-center">
                <div class="rounded-circle bg-success bg-opacity-10 p-3 me-3">
                    <span class="text-success fw-bold">📦</span>
                </div>
                <div>
                    <h6 class="text-muted mb-1 small fw-bold">Total Jenis Barang</h6>
                    <h3 class="fw-bold mb-0 text-dark">{{ $totalBarang }}</h3>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card border-0 shadow-sm p-4" style="border-radius: 20px; background: #fff;">
            <div class="d-flex align-items-center">
                <div class="rounded-circle bg-primary bg-opacity-10 p-3 me-3">
                    <span class="text-primary fw-bold">📊</span>
                </div>
                <div>
                    <h6 class="text-muted mb-1 small fw-bold">Total Unit Stok</h6>
                    <h3 class="fw-bold mb-0 text-dark">{{ $totalStok }}</h3>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card border-0 shadow-sm p-4" style="border-radius: 20px; background: #fff;">
            <div class="d-flex align-items-center">
                <div class="rounded-circle bg-warning bg-opacity-10 p-3 me-3">
                    <span class="text-warning fw-bold">⏳</span>
                </div>
                <div>
                    <h6 class="text-muted mb-1 small fw-bold">Transaksi Aktif</h6>
                    <h3 class="fw-bold mb-0 text-dark">{{ $barangPinjam }}</h3>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card border-0 shadow-sm" style="border-radius: 20px;">
    <div class="card-body p-4">
        <h5 class="fw-bold mb-4">Aktivitas Peminjaman Terbaru</h5>
        <div class="table-responsive">
            <table class="table align-middle">
                <thead class="text-muted small">
                    <tr>
                        <th>PEMINJAM</th>
                        <th>BARANG</th>
                        <th>TANGGAL</th>
                        <th>STATUS</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($recentActivities as $activity)
                    <tr>
                        <td class="fw-bold text-dark">{{ $activity->nama_peminjam }}</td>
                        <td>{{ $activity->barang->nama_barang ?? 'N/A' }}</td>
                        <td>{{ \Carbon\Carbon::parse($activity->tgl_pinjam)->format('d M Y') }}</td>
                        <td>
                            <span class="badge bg-warning bg-opacity-10 text-warning px-3 py-2 rounded-pill">
                                {{ $activity->status }}
                            </span>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center py-4 text-muted small">Belum ada aktivitas terbaru.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection