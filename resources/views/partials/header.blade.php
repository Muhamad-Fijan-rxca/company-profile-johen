<style>
    .navbar {
        position: fixed; top: 0; left: 0; right: 0; z-index: 1000;
        background: transparent;
        border-bottom: 1px solid transparent;
        transition: background 0.4s ease, border-color 0.4s ease,
                    box-shadow 0.4s ease, backdrop-filter 0.4s ease;
        height: 80px;
    }
    .navbar.scrolled {
        background: rgba(255,255,255,0.88);
        backdrop-filter: blur(16px);
        -webkit-backdrop-filter: blur(16px);
        border-bottom: 1px solid rgba(26,63,168,0.08);
        box-shadow: 0 4px 24px rgba(26,63,168,0.10);
    }
    .nav-inner {
        max-width: 1200px; margin: 0 auto;
        padding: 0 24px;
        height: 100%;
        display: flex; align-items: center; justify-content: space-between;
    }

    /* LOGO */
    .nav-logo {
        display: flex; align-items: center; gap: 12px;
        text-decoration: none; flex-shrink: 0;
    }
    .nav-logo-box {
        width: 44px; height: 44px;
        background: var(--gradient);
        border-radius: 12px;
        display: flex; align-items: center; justify-content: center;
        color: white; font-size: 16px; font-weight: 900;
        letter-spacing: -0.5px;
        box-shadow: 0 4px 12px rgba(26,63,168,0.3);
    }
    .nav-logo-text { line-height: 1.2; }
    .nav-logo-text .brand { font-size: 17px; font-weight: 800; color: var(--text); }
    .nav-logo-text .brand span { color: var(--primary); }
    .nav-logo-text .tagline { font-size: 10px; color: var(--text-muted); font-weight: 400; display: block; }

    /* MENU */
    .nav-menu {
        display: flex; align-items: center; gap: 4px;
        list-style: none;
    }
    .nav-menu li a {
        display: block; padding: 9px 16px;
        font-size: 14px; font-weight: 500;
        color: var(--text-muted);
        text-decoration: none;
        border-radius: 100px;
        transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
        white-space: nowrap;
        position: relative;
    }
    /* Underline animasi pada menu item */
    .navbar.scrolled .nav-menu li:not(.nav-cta) a::after {
        content: '';
        position: absolute;
        bottom: 4px; left: 16px; right: 16px;
        height: 2px;
        background: var(--gradient);
        border-radius: 1px;
        transform: scaleX(0);
        transform-origin: center;
        transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }
    .navbar.scrolled .nav-menu li:not(.nav-cta) a:hover::after,
    .navbar.scrolled .nav-menu li:not(.nav-cta) a.active::after { transform: scaleX(1); }
    /* Saat navbar transparan (belum scroll), teks menu jadi putih agar terbaca */
    .navbar:not(.scrolled) .nav-menu li a {
        color: rgba(255,255,255,0.85);
    }
    .navbar:not(.scrolled) .nav-menu li a:hover {
        color: white;
        background: rgba(255,255,255,0.15);
    }
    .navbar:not(.scrolled) .nav-menu li a.active {
        color: white;
        background: rgba(255,255,255,0.2);
    }
    .navbar:not(.scrolled) .nav-logo-text .brand { color: white; }
    .navbar:not(.scrolled) .nav-logo-text .brand span { color: #c4b5fd; }
    .navbar:not(.scrolled) .nav-logo-text .tagline { color: rgba(255,255,255,0.6); }
    .navbar:not(.scrolled) .hamburger span { background: white; }
    /* Saat sudah scroll */
    .navbar.scrolled .nav-menu li a {
        color: var(--text-muted);
    }
    .navbar.scrolled .nav-menu li a:hover {
        color: var(--primary);
        background: var(--primary-light);
    }
    .navbar.scrolled .nav-menu li a.active {
        color: var(--primary);
        font-weight: 700;
        background: var(--primary-light);
    }
    .nav-menu li.nav-cta a {
        background: var(--accent);
        color: white;
        padding: 10px 22px;
        border-radius: 100px;
        font-weight: 700;
        box-shadow: 0 4px 14px rgba(245,166,35,0.4);
    }
    .nav-menu li.nav-cta a:hover {
        background: var(--accent-hover);
        transform: translateY(-1px);
        box-shadow: 0 6px 20px rgba(245,166,35,0.5);
    }

    /* HAMBURGER */
    .hamburger {
        display: none; flex-direction: column; gap: 5px;
        cursor: pointer; padding: 8px; border: none; background: none;
        border-radius: 8px; transition: background 0.2s;
    }
    .hamburger:hover { background: var(--primary-light); }
    .hamburger span {
        display: block; width: 22px; height: 2px;
        background: var(--text); border-radius: 2px;
        transition: all 0.3s;
    }
    .hamburger.open span:nth-child(1) { transform: translateY(7px) rotate(45deg); }
    .hamburger.open span:nth-child(2) { opacity: 0; transform: scaleX(0); }
    .hamburger.open span:nth-child(3) { transform: translateY(-7px) rotate(-45deg); }

    /* MOBILE */
    @media (max-width: 900px) {
        .hamburger { display: flex; }
        .nav-menu {
            display: none;
            position: fixed;
            top: 80px; left: 0; right: 0;
            background: white;
            flex-direction: column; align-items: stretch;
            padding: 12px 16px 20px;
            gap: 2px;
            border-bottom: 1px solid var(--border);
            box-shadow: 0 12px 32px rgba(0,0,0,0.1);
        }
        .nav-menu.open { display: flex; }
        .nav-menu li a { border-radius: 10px; padding: 12px 16px; }
        .nav-menu li.nav-cta { margin-top: 8px; }
        .nav-menu li.nav-cta a { text-align: center; justify-content: center; }
    }
</style>

<nav class="navbar" id="navbar">
    <div class="nav-inner">
        <a href="{{ route('home') }}" class="nav-logo">
            <div class="nav-logo-box">JG</div>
            <div class="nav-logo-text">
                <span class="brand">Johen<span>Gaming</span></span>
                <span class="tagline">Solusi Kebutuhan Game Anda</span>
            </div>
        </a>

        <ul class="nav-menu" id="navMenu">
            <li><a href="{{ route('home') }}"   class="{{ request()->routeIs('home')    ? 'active' : '' }}">Home</a></li>
            <li><a href="{{ route('tentang') }}" class="{{ request()->routeIs('tentang') ? 'active' : '' }}">Tentang</a></li>
            <li><a href="{{ route('produk') }}"  class="{{ request()->routeIs('produk')  ? 'active' : '' }}">Produk</a></li>
            <li><a href="{{ route('berita') }}"  class="{{ request()->routeIs('berita*') ? 'active' : '' }}">Johen News</a></li>
            <li><a href="{{ route('karir') }}"   class="{{ request()->routeIs('karir')   ? 'active' : '' }}">Karir</a></li>
            <li class="nav-cta"><a href="{{ route('kontak') }}">Kontak</a></li>
        </ul>

        <button class="hamburger" id="hamburger" aria-label="Toggle menu">
            <span></span><span></span><span></span>
        </button>
    </div>
</nav>

<script>
    const navbar    = document.getElementById('navbar');
    const hamburger = document.getElementById('hamburger');
    const navMenu   = document.getElementById('navMenu');

    window.addEventListener('scroll', () => {
        navbar.classList.toggle('scrolled', window.scrollY > 10);
    });

    hamburger.addEventListener('click', () => {
        hamburger.classList.toggle('open');
        navMenu.classList.toggle('open');
    });

    navMenu.querySelectorAll('a').forEach(a => {
        a.addEventListener('click', () => {
            hamburger.classList.remove('open');
            navMenu.classList.remove('open');
        });
    });
</script>
