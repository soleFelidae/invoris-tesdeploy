<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>INVORIS | Inventory System</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --si-dark: #0b1315;
            --si-green: #10b981;
            --si-bg: #f4f7f6;
            --si-text-muted: #94a3b8;
        }

        /* Reset & Layout Dasar */
        html, body {
            height: 100%;
            margin: 0;
            background-color: var(--si-bg);
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        /* SIDEBAR CUSTOM */
        .sidebar { 
            width: 260px; 
            height: 100vh; 
            position: fixed; 
            top: 0; 
            left: 0;
            background-color: var(--si-dark); 
            color: #fff; 
            padding: 50px 20px; /* Padding atas sidebar ditingkatkan */
            z-index: 1000; 
            display: flex; 
            flex-direction: column; 
        }

        .sidebar .brand { 
            font-size: 1.8rem; 
            font-weight: 800; 
            color: #fff; 
            text-decoration: none; 
            margin-bottom: 80px; /* JARAK LOGO KE MENU: Ditambah agar menu lebih turun */
            display: block; 
            padding-left: 10px;
        }
        .sidebar .brand span { color: var(--si-green); }

        /* NAVIGASI */
        .nav-menu { 
            list-style: none; 
            padding: 0; 
            margin: 0;
            flex-grow: 1; 
        }

        .nav-link { 
            color: var(--si-text-muted); 
            padding: 14px 20px; 
            border-radius: 12px; 
            text-decoration: none; 
            display: block; 
            margin-bottom: 15px; 
            font-weight: 600; 
            transition: 0.3s; 
            cursor: pointer;
        }

        .nav-link:hover { 
            color: var(--si-green); 
            background: rgba(16, 185, 129, 0.05); 
        }

        .nav-link.active { 
            background: var(--si-green) !important; 
            color: #fff !important; 
            box-shadow: 0 4px 15px rgba(16, 185, 129, 0.2);
        }

        /* TOMBOL KELUAR DI BAWAH */
        .nav-logout-container {
            margin-top: auto; 
            padding-top: 20px;
            border-top: 1px solid rgba(255, 255, 255, 0.05);
        }

        /* KONTEN UTAMA */
        .main-content { 
            margin-left: 260px; 
            min-height: 100vh; 
            display: flex; 
            flex-direction: column; 
        }

        .top-nav { 
            background: #fff; 
            padding: 20px 40px; 
            display: flex; 
            justify-content: space-between; 
            align-items: center; 
            border-bottom: 1px solid #eee; 
        }

        .content-padding { 
            padding: 40px; 
        }
    </style>
</head>
<body>

    <div class="sidebar">
        <a href="{{ route('home') }}" class="brand">INV<span>ORIS</span></a>
        
        <ul class="nav-menu">
            <li>
                <a href="{{ route('home') }}" class="nav-link {{ request()->is('home') ? 'active' : '' }}">
                    Dashboard
                </a>
            </li>
            <li>
                <a href="{{ route('barang.index') }}" class="nav-link {{ request()->is('barang*') ? 'active' : '' }}">
                    Data Barang
                </a>
            </li>
            <li>
                <a href="{{ route('peminjaman.index') }}" class="nav-link {{ request()->is('peminjaman*') ? 'active' : '' }}">
                    Peminjaman
                </a>
            </li>
        </ul>

        <div class="nav-logout-container">
            <a href="{{ route('logout') }}" class="nav-link text-danger" 
               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
               Keluar
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </div>
    </div>

    <div class="main-content">
        <div class="top-nav">
            <div class="fw-bold text-success">
                INVORIS | <span class="text-muted fw-normal">Inventory System</span>
            </div>
            <div class="d-flex align-items-center gap-3">
                <small class="text-muted">{{ date('d M Y') }}</small>
                <div class="fw-bold small text-dark">{{ Auth::user()->name ?? 'User' }}</div>
                <div style="width: 35px; height: 35px; background: var(--si-dark); border-radius: 50%;"></div>
            </div>
        </div>

        <div class="content-padding">
            @yield('content')
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>