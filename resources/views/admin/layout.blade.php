<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin') | Johen Gaming</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        :root {
            --primary: #2b59c3; --primary-dark: #1e3c72; --secondary: #8b5cf6;
            --gradient: linear-gradient(135deg, #1e3c72 0%, #2b3b90 50%, #6a1b9a 100%);
            --sidebar-w: 260px; --text: #1a1a2e; --text-muted: #6b7280;
            --bg: #f0f2ff; --white: #ffffff; --border: #e5e7eb;
        }
        body { font-family: 'Poppins', sans-serif; font-size: 14px; color: var(--text); background: var(--bg); display: flex; min-height: 100vh; }

        /* SIDEBAR */
        .sidebar { width: var(--sidebar-w); background: var(--gradient); color: white; display: flex; flex-direction: column; position: fixed; top: 0; left: 0; bottom: 0; z-index: 100; transition: transform 0.3s; }
        .sidebar-header { padding: 24px 20px; border-bottom: 1px solid rgba(255,255,255,0.1); }
        .sidebar-logo { display: flex; align-items: center; gap: 10px; text-decoration: none; color: white; }
        .sidebar-logo-icon { width: 36px; height: 36px; background: rgba(255,255,255,0.2); border-radius: 8px; display: flex; align-items: center; justify-content: center; font-weight: 800; font-size: 14px; }
        .sidebar-logo-text { font-size: 16px; font-weight: 700; }
        .sidebar-logo-sub { font-size: 11px; opacity: 0.7; display: block; }
        .sidebar-nav { flex: 1; padding: 16px 12px; overflow-y: auto; }
        .nav-section-title { font-size: 10px; font-weight: 600; text-transform: uppercase; letter-spacing: 1px; opacity: 0.5; padding: 16px 8px 8px; }
        .sidebar-nav a { display: flex; align-items: center; gap: 10px; padding: 10px 12px; border-radius: 10px; color: rgba(255,255,255,0.75); text-decoration: none; font-size: 13px; font-weight: 500; transition: all 0.2s; margin-bottom: 2px; }
        .sidebar-nav a:hover, .sidebar-nav a.active { background: rgba(255,255,255,0.15); color: white; }
        .sidebar-nav a i { width: 18px; text-align: center; }
        .badge-count { margin-left: auto; background: #ef4444; color: white; font-size: 10px; font-weight: 700; padding: 2px 7px; border-radius: 100px; }
        .sidebar-footer { padding: 16px 12px; border-top: 1px solid rgba(255,255,255,0.1); }
        .sidebar-footer form button { display: flex; align-items: center; gap: 10px; width: 100%; padding: 10px 12px; border-radius: 10px; background: rgba(255,255,255,0.1); color: rgba(255,255,255,0.75); border: none; cursor: pointer; font-family: 'Poppins', sans-serif; font-size: 13px; font-weight: 500; transition: all 0.2s; }
        .sidebar-footer form button:hover { background: rgba(239,68,68,0.3); color: white; }

        /* MAIN */
        .main-wrap { margin-left: var(--sidebar-w); flex: 1; display: flex; flex-direction: column; min-height: 100vh; }
        .topbar { background: white; border-bottom: 1px solid var(--border); padding: 0 24px; height: 64px; display: flex; align-items: center; justify-content: space-between; position: sticky; top: 0; z-index: 50; }
        .topbar-title { font-size: 18px; font-weight: 700; }
        .topbar-right { display: flex; align-items: center; gap: 16px; }
        .topbar-user { display: flex; align-items: center; gap: 10px; }
        .topbar-avatar { width: 36px; height: 36px; background: var(--gradient); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-weight: 700; font-size: 14px; }
        .topbar-user-info { font-size: 13px; }
        .topbar-user-info .name { font-weight: 600; }
        .topbar-user-info .role { color: var(--text-muted); font-size: 11px; }
        .view-site { display: flex; align-items: center; gap: 6px; padding: 8px 14px; border-radius: 8px; background: var(--bg); color: var(--text-muted); text-decoration: none; font-size: 12px; font-weight: 500; transition: all 0.2s; }
        .view-site:hover { color: var(--primary); }

        /* CONTENT */
        .content { padding: 24px; flex: 1; }

        /* CARD */
        .card { background: white; border-radius: 12px; box-shadow: 0 2px 12px rgba(43,89,195,0.08); }
        .card-header { padding: 20px 24px; border-bottom: 1px solid var(--border); display: flex; align-items: center; justify-content: space-between; }
        .card-header h3 { font-size: 15px; font-weight: 700; }
        .card-body { padding: 24px; }

        /* STATS */
        .stats-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 16px; margin-bottom: 24px; }
        .stat-card { background: white; border-radius: 12px; padding: 20px; box-shadow: 0 2px 12px rgba(43,89,195,0.08); display: flex; align-items: center; gap: 16px; }
        .stat-icon { width: 48px; height: 48px; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 20px; flex-shrink: 0; }
        .stat-info .num { font-size: 24px; font-weight: 800; display: block; }
        .stat-info .label { font-size: 12px; color: var(--text-muted); }

        /* TABLE */
        .table-wrap { overflow-x: auto; }
        table { width: 100%; border-collapse: collapse; }
        th { background: var(--bg); padding: 12px 16px; text-align: left; font-size: 12px; font-weight: 600; color: var(--text-muted); text-transform: uppercase; letter-spacing: 0.5px; }
        td { padding: 14px 16px; border-bottom: 1px solid var(--border); font-size: 13px; vertical-align: middle; }
        tr:last-child td { border-bottom: none; }
        tr:hover td { background: var(--bg); }

        /* FORM */
        .form-group { margin-bottom: 20px; }
        .form-label { display: block; font-size: 13px; font-weight: 600; margin-bottom: 6px; color: var(--text); }
        .form-control { width: 100%; padding: 10px 14px; border: 1.5px solid var(--border); border-radius: 8px; font-family: 'Poppins', sans-serif; font-size: 13px; color: var(--text); background: white; outline: none; transition: border-color 0.2s, box-shadow 0.2s; }
        .form-control:focus { border-color: var(--primary); box-shadow: 0 0 0 3px rgba(43,89,195,0.1); }
        .form-control.is-invalid { border-color: #ef4444; }
        .invalid-feedback { color: #ef4444; font-size: 11px; margin-top: 4px; }
        textarea.form-control { resize: vertical; min-height: 100px; }
        .form-check { display: flex; align-items: center; gap: 8px; }
        .form-check input { width: 16px; height: 16px; cursor: pointer; }
        .form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; }

        /* BUTTON */
        .btn { display: inline-flex; align-items: center; gap: 6px; padding: 9px 18px; border-radius: 8px; font-family: 'Poppins', sans-serif; font-size: 13px; font-weight: 600; cursor: pointer; border: none; text-decoration: none; transition: all 0.2s; }
        .btn-primary { background: var(--gradient); color: white; }
        .btn-primary:hover { opacity: 0.9; }
        .btn-danger { background: #fee2e2; color: #dc2626; }
        .btn-danger:hover { background: #dc2626; color: white; }
        .btn-secondary { background: var(--bg); color: var(--text-muted); }
        .btn-secondary:hover { background: var(--border); }
        .btn-sm { padding: 6px 12px; font-size: 12px; }
        .btn-warning { background: #fef3c7; color: #92400e; }
        .btn-warning:hover { background: #f59e0b; color: white; }

        /* BADGE */
        .badge { display: inline-block; padding: 3px 10px; border-radius: 100px; font-size: 11px; font-weight: 600; }
        .badge-success { background: #d1fae5; color: #065f46; }
        .badge-danger { background: #fee2e2; color: #991b1b; }
        .badge-warning { background: #fef3c7; color: #92400e; }
        .badge-primary { background: rgba(43,89,195,0.1); color: var(--primary); }

        /* ALERT */
        .alert { padding: 12px 16px; border-radius: 8px; margin-bottom: 20px; font-size: 13px; display: flex; align-items: center; gap: 8px; }
        .alert-success { background: #d1fae5; color: #065f46; border-left: 3px solid #10b981; }
        .alert-error { background: #fee2e2; color: #991b1b; border-left: 3px solid #ef4444; }

        /* PAGINATION */
        .page-header { display: flex; align-items: center; justify-content: space-between; margin-bottom: 24px; }
        .page-header h2 { font-size: 20px; font-weight: 700; }

        /* RESPONSIVE */
        @media(max-width:1024px) { .stats-grid { grid-template-columns: repeat(2, 1fr); } }
        @media(max-width:768px) {
            .sidebar { transform: translateX(-100%); }
            .sidebar.open { transform: translateX(0); }
            .main-wrap { margin-left: 0; }
            .stats-grid { grid-template-columns: 1fr 1fr; }
            .form-row { grid-template-columns: 1fr; }
        }
    </style>
    @stack('styles')
</head>
<body>
    <aside class="sidebar" id="sidebar">
        <div class="sidebar-header">
            <a href="{{ route('admin.dashboard') }}" class="sidebar-logo">
                <div class="sidebar-logo-icon">JG</div>
                <div>
                    <span class="sidebar-logo-text">Johen Gaming</span>
                    <span class="sidebar-logo-sub">Admin Panel</span>
                </div>
            </a>
        </div>
        <nav class="sidebar-nav">
            <div class="nav-section-title">Main</div>
            <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <i class="fas fa-tachometer-alt"></i> Dashboard
            </a>

            <div class="nav-section-title">Konten</div>
            <a href="{{ route('admin.produk.index') }}" class="{{ request()->routeIs('admin.produk*') ? 'active' : '' }}">
                <i class="fas fa-gamepad"></i> Produk
            </a>
            <a href="{{ route('admin.berita.index') }}" class="{{ request()->routeIs('admin.berita*') ? 'active' : '' }}">
                <i class="fas fa-newspaper"></i> Berita
            </a>

            <div class="nav-section-title">Karir</div>
            <a href="{{ route('admin.lowongan.index') }}" class="{{ request()->routeIs('admin.lowongan*') ? 'active' : '' }}">
                <i class="fas fa-briefcase"></i> Lowongan
            </a>
            <a href="{{ route('admin.pelamar.index') }}" class="{{ request()->routeIs('admin.pelamar*') ? 'active' : '' }}">
                <i class="fas fa-users"></i> Pelamar
            </a>

            <div class="nav-section-title">Pesan</div>
            <a href="{{ route('admin.pesan.index') }}" class="{{ request()->routeIs('admin.pesan*') ? 'active' : '' }}">
                <i class="fas fa-envelope"></i> Pesan Kontak
                @php $unread = \App\Models\PesanKontak::where('sudah_dibaca', false)->count(); @endphp
                @if($unread > 0)<span class="badge-count">{{ $unread }}</span>@endif
            </a>
        </nav>
        <div class="sidebar-footer">
            <form action="{{ route('admin.logout') }}" method="POST">
                @csrf
                <button type="submit"><i class="fas fa-sign-out-alt"></i> Logout</button>
            </form>
        </div>
    </aside>

    <div class="main-wrap">
        <header class="topbar">
            <div style="display:flex;align-items:center;gap:16px">
                <button onclick="document.getElementById('sidebar').classList.toggle('open')" style="display:none;background:none;border:none;cursor:pointer;font-size:20px;color:var(--text)" id="sidebarToggle">
                    <i class="fas fa-bars"></i>
                </button>
                <h1 class="topbar-title">@yield('title', 'Dashboard')</h1>
            </div>
            <div class="topbar-right">
                <a href="{{ route('home') }}" class="view-site" target="_blank"><i class="fas fa-external-link-alt"></i> Lihat Website</a>
                <div class="topbar-user">
                    <div class="topbar-avatar">{{ substr(Auth::user()->name, 0, 1) }}</div>
                    <div class="topbar-user-info">
                        <div class="name">{{ Auth::user()->name }}</div>
                        <div class="role">Administrator</div>
                    </div>
                </div>
            </div>
        </header>

        <main class="content">
            @if(session('success'))
            <div class="alert alert-success"><i class="fas fa-check-circle"></i> {{ session('success') }}</div>
            @endif
            @if(session('error'))
            <div class="alert alert-error"><i class="fas fa-exclamation-circle"></i> {{ session('error') }}</div>
            @endif
            @yield('content')
        </main>
    </div>

    <script>
        const toggle = document.getElementById('sidebarToggle');
        if (window.innerWidth <= 768) toggle.style.display = 'block';
        window.addEventListener('resize', () => {
            toggle.style.display = window.innerWidth <= 768 ? 'block' : 'none';
        });
    </script>
    @stack('scripts')
</body>
</html>
