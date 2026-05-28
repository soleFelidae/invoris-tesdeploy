<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;
use App\Models\Peminjaman;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        // Mengambil statistik data
        $totalBarang = Barang::count();
        $totalStok = Barang::sum('stok');
        $barangPinjam = Peminjaman::where('status', 'Dipinjam')->count();
        
        // Mengambil riwayat aktivitas terbaru
        $recentActivities = Peminjaman::with('barang')->latest()->take(5)->get();

        return view('home', compact('totalBarang', 'totalStok', 'barangPinjam', 'recentActivities'));
    }
}