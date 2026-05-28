<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | INVORIS HIMSI</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; display: flex; height: 100vh; margin: 0; overflow: hidden; }
        .login-left {
            flex: 1.3; background: linear-gradient(rgba(6, 78, 59, 0.9), rgba(6, 78, 59, 0.9)), 
            url('https://images.unsplash.com/photo-1517245386807-bb43f82c33c4?q=80&w=2070&auto=format&fit=crop');
            background-size: cover; color: white; padding: 60px; display: flex; flex-direction: column; 
            justify-content: center; clip-path: polygon(0 0, 100% 0, 88% 100%, 0% 100%);
        }
        .login-right { flex: 1; display: flex; align-items: center; justify-content: center; background: #f8fafc; }
        .login-card { background: white; padding: 45px; border-radius: 30px; box-shadow: 0 20px 40px rgba(0,0,0,0.05); width: 100%; max-width: 440px; }
        .btn-si { background: #064e3b; color: white; border: none; padding: 12px; border-radius: 12px; font-weight: bold; width: 100%; transition: 0.3s; }
        .btn-si:hover { background: #042f24; transform: translateY(-2px); }
        .form-control { border-radius: 12px; padding: 12px 15px; border: 1px solid #e2e8f0; }
        .icon-lock { width: 60px; height: 60px; background: #ecfdf5; color: #10b981; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 20px; font-size: 1.5rem; }
    </style>
</head>
<body>
    <div class="login-left">
        <div class="mb-5">
            <h2 class="fw-800">INVORIS</h2>
            <p class="opacity-75 small">Inventory Organization Information System</p>
        </div>
        <h1 class="fw-bold mb-4">Sistem Inventaris Barang<br><span style="color: #10b981;">Himpunan Mahasiswa<br>Sistem Informasi</span></h1>
        <p class="opacity-75 mb-5" style="max-width: 500px;">Kelola inventaris organisasi secara digital, terstruktur, dan efisien dalam satu platform terpadu.</p>
        <div class="d-flex gap-4">
            <div class="text-center"><div class="mb-2 fs-3">📦</div><small>Barang</small></div>
            <div class="text-center"><div class="mb-2 fs-3">🔄</div><small>Pinjam</small></div>
            <div class="text-center"><div class="mb-2 fs-3">📊</div><small>Laporan</small></div>
            <div class="text-center"><div class="mb-2 fs-3">🛡️</div><small>Aman</small></div>
        </div>
    </div>
    <div class="login-right">
        <div class="login-card">
            <div class="icon-lock">🔒</div>
            <h3 class="text-center fw-bold">Login</h3>
            <p class="text-center text-muted small mb-4">Masuk untuk mengakses Dashboard</p>
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="mb-3">
                    <label class="small fw-bold text-muted mb-1">Email</label>
                    <input type="email" name="email" class="form-control" placeholder="Email Anda" required autofocus>
                </div>
                <div class="mb-3">
                    <label class="small fw-bold text-muted mb-1">Password</label>
                    <input type="password" name="password" class="form-control" placeholder="Password Anda" required>
                </div>
                <button type="submit" class="btn-si">Login Sekarang</button>
            </form>
            <div class="alert alert-success border-0 mt-4 small d-flex align-items-center gap-2" style="border-radius: 12px; background: #ecfdf5; color: #065f46;">
                <span>🛡️</span> Sistem aman untuk PJ Inventaris.
            </div>
        </div>
    </div>
</body>
</html>