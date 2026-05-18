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
        background: rgba(15, 40, 120, 0.85);
        backdrop-filter: blur(16px);
        -webkit-backdrop-filter: blur(16px);
        border-bottom: 1px solid rgba(255,255,255,0.08);
        box-shadow: 0 4px 24px rgba(0,0,0,0.2);
    }
    .nav-inner {
        width: 100%;
        padding: 0 32px 0 32px; height: 100%;
        display: flex; align-items: center;
    }

    /* ── ANIMASI ENTRANCE ── */
    @keyframes navSlideDown {
        from { opacity: 0; transform: translateY(-24px); }
        to   { opacity: 1; transform: translateY(0); }
    }
    @keyframes navFadeIn {
        from { opacity: 0; transform: translateY(-12px); }
        to   { opacity: 1; transform: translateY(0); }
    }

    /* LOGO — mentok kiri */
    .nav-logo {
        display: flex; flex-direction: row; align-items: center; gap: 10px;
        text-decoration: none; flex-shrink: 0;
        animation: navSlideDown 0.7s cubic-bezier(0.4, 0, 0.2, 1) 0.1s both;
    }
    .nav-logo img {
        height: 44px; width: auto;
        object-fit: contain; display: block;
        transition: opacity 0.3s;
    }
    .nav-logo:hover img { opacity: 0.85; }
    .nav-logo-tagline {
        font-size: 10px; font-weight: 500;
        color: var(--text-muted);
        display: block; line-height: 1; white-space: nowrap;
    }
    .navbar:not(.scrolled) .nav-logo-tagline { color: rgba(255,255,255,0.65); }
    .navbar.scrolled .nav-logo-tagline { color: rgba(255,255,255,0.6); }

    /* MENU — mentok kanan via margin-left: auto */
    .nav-menu {
        display: flex; align-items: center; gap: 4px;
        list-style: none;
        margin-left: auto;
        flex-shrink: 0;
    }
    .nav-menu li { animation: navFadeIn 0.5s cubic-bezier(0.4, 0, 0.2, 1) both; }
    .nav-menu li:nth-child(1) { animation-delay: 0.15s; }
    .nav-menu li:nth-child(2) { animation-delay: 0.22s; }
    .nav-menu li:nth-child(3) { animation-delay: 0.29s; }
    .nav-menu li:nth-child(4) { animation-delay: 0.36s; }
    .nav-menu li:nth-child(5) { animation-delay: 0.43s; }
    .nav-menu li:nth-child(6) { animation-delay: 0.50s; }
    .nav-menu li:nth-child(7) { animation-delay: 0.57s; }
    .nav-menu li a {
        display: block; padding: 9px 16px;
        font-size: 14px; font-weight: 500;
        color: var(--text-muted);
        text-decoration: none; border-radius: 100px;
        transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
        white-space: nowrap; position: relative;
    }
    /* Underline animasi */
    .navbar.scrolled .nav-menu li:not(.nav-cta) a::after {
        content: '';
        position: absolute;
        bottom: 4px; left: 16px; right: 16px;
        height: 2px; background: rgba(255,255,255,0.6);
        border-radius: 1px; transform: scaleX(0);
        transform-origin: center;
        transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }
    .navbar.scrolled .nav-menu li:not(.nav-cta) a:hover::after,
    .navbar.scrolled .nav-menu li:not(.nav-cta) a.active::after { transform: scaleX(1); }

    /* Transparan (belum scroll) */
    .navbar:not(.scrolled) .nav-menu li a { color: rgba(255,255,255,0.85); }
    .navbar:not(.scrolled) .nav-menu li a:hover { color: white; background: rgba(255,255,255,0.15); }
    .navbar:not(.scrolled) .nav-menu li a.active { color: white; background: rgba(255,255,255,0.2); }
    .navbar:not(.scrolled) .hamburger span { background: white; }

    /* Sudah scroll */
    .navbar.scrolled .nav-menu li a { color: rgba(255,255,255,0.85); }
    .navbar.scrolled .nav-menu li a:hover { color: white; background: rgba(255,255,255,0.12); }
    .navbar.scrolled .nav-menu li a.active { color: white; font-weight: 700; background: rgba(255,255,255,0.15); }
    .navbar.scrolled .hamburger span { background: white; }

    /* CTA */
    .nav-menu li.nav-cta a {
        background: var(--accent); color: white;
        padding: 10px 22px; border-radius: 100px;
        font-weight: 700; box-shadow: 0 4px 14px rgba(245,166,35,0.4);
    }
    .nav-menu li.nav-cta a:hover {
        background: var(--accent-hover); transform: translateY(-1px);
        box-shadow: 0 6px 20px rgba(245,166,35,0.5);
    }

    /* HAMBURGER */
    .hamburger {
        display: none; flex-direction: column; gap: 5px;
        cursor: pointer; padding: 8px; border: none; background: none;
        border-radius: 8px; transition: background 0.2s;
        animation: navSlideDown 0.7s cubic-bezier(0.4, 0, 0.2, 1) 0.2s both;
        flex-shrink: 0;
    }
    .hamburger:hover { background: rgba(255,255,255,0.15); }
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
        .navbar { height: 68px; }
        .nav-inner { padding: 0 16px; }
        .nav-logo img { height: 36px; }
        .nav-logo-tagline { font-size: 9px; }
        .hamburger { display: flex; }
        .nav-menu {
            display: none; position: fixed;
            top: 68px; left: 0; right: 0;
            background: rgba(10, 25, 80, 0.97);
            backdrop-filter: blur(20px); -webkit-backdrop-filter: blur(20px);
            flex-direction: column; align-items: stretch;
            padding: 16px 16px 24px; gap: 4px;
            border-bottom: 1px solid rgba(255,255,255,0.08);
            box-shadow: 0 16px 40px rgba(0,0,0,0.3);
            margin-left: 0;
        }
        .nav-menu.open { display: flex; }
        .nav-menu li { animation: none; }
        .nav-menu li a {
            border-radius: 12px; padding: 14px 18px;
            color: rgba(255,255,255,0.85) !important;
            font-size: 15px; font-weight: 500;
            border-bottom: 1px solid rgba(255,255,255,0.06);
        }
        .nav-menu li:last-child a { border-bottom: none; }
        .nav-menu li a:hover, .nav-menu li a.active {
            background: rgba(255,255,255,0.1) !important;
            color: white !important;
        }
        .nav-menu li.nav-cta { margin-top: 8px; }
        .nav-menu li.nav-cta a {
            text-align: center;
            background: var(--accent) !important;
            border-radius: 100px !important;
            border-bottom: none !important;
            box-shadow: 0 4px 16px rgba(245,166,35,0.4);
        }
    }
</style>

<nav class="navbar" id="navbar">
    <div class="nav-inner">
        <a href="{{ route('home') }}" class="nav-logo">
            <img src="{{ asset('img/logo/johen_logo.png') }}" alt="Johen Gaming" height="44">
            <span class="nav-logo-tagline">Bermain game lebih seru bersama johen gaming</span>
        </a>

        <ul class="nav-menu" id="navMenu">
            <li><a href="{{ route('home') }}"   class="{{ request()->routeIs('home')    ? 'active' : '' }}">Home</a></li>
            <li><a href="{{ route('tentang') }}" class="{{ request()->routeIs('tentang') ? 'active' : '' }}">Tentang</a></li>
            <li><a href="{{ route('produk') }}"  class="{{ request()->routeIs('produk')  ? 'active' : '' }}">Produk</a></li>
            <li><a href="{{ route('berita') }}"  class="{{ request()->routeIs('berita*') ? 'active' : '' }}">Johen News</a></li>
            <li><a href="{{ route('konten-digital') }}" class="{{ request()->routeIs('konten-digital') ? 'active' : '' }}">Konten Digital</a></li>
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
