<style>
    .navbar {
        position: fixed; top: 0; left: 0; right: 0; z-index: 1000;
        background: transparent;
        border-bottom: 1px solid transparent;
        transition: background 0.4s ease, border-color 0.4s ease,
                    box-shadow 0.4s ease, backdrop-filter 0.4s ease;
        height: 90px;
    }
    .navbar.scrolled {
        background: #041640;
        backdrop-filter: blur(16px);
        -webkit-backdrop-filter: blur(16px);
        border-bottom: 1px solid rgba(0,212,255,0.08);
        box-shadow: 0 4px 24px rgba(0,0,0,0.3);
    }
    .nav-inner {
        width: 100%;
        padding: 0 40px; height: 100%;
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
        height: 50px; width: auto;
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
        display: flex; align-items: center; gap: 14px;
        list-style: none;
        margin-left: auto;
        flex-shrink: 0;
    }
    .dropdown-arrow {
        display: inline-block;
        width: 7px;
        height: 7px;
        border-right: 2px solid currentColor;
        border-bottom: 2px solid currentColor;
        transform: rotate(45deg);
        margin-left: 6px;
        transition: transform 0.3s ease, border-color 0.3s ease;
        position: relative;
        top: -3px;
    }
    .nav-dropdown:hover .dropdown-arrow,
    .nav-dropdown.open .dropdown-arrow {
        transform: rotate(-135deg);
        border-right-color: #7035CC;
        border-bottom-color: #0668C0;
    }

    /* ── DROPDOWN SUBMENU ── */
    .nav-dropdown { position: relative; }
    .submenu {
        position: absolute;
        top: calc(100% - 4px);
        left: 0;
        min-width: 210px;
        background: #041640;
        backdrop-filter: blur(16px);
        -webkit-backdrop-filter: blur(16px);
        border-radius: 12px;
        padding: 8px;
        box-shadow: 0 8px 32px rgba(0,0,0,0.3);
        opacity: 0;
        visibility: hidden;
        transform: translateY(8px);
        transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
        list-style: none;
        z-index: 100;
        border: 1px solid rgba(255,255,255,0.06);
    }
    .nav-dropdown:hover .submenu {
        opacity: 1;
        visibility: visible;
        transform: translateY(0);
    }
    .submenu li a {
        display: block;
        padding: 10px 16px;
        font-size: 14px;
        color: rgba(255,255,255,0.85) !important;
        border-radius: 8px;
        white-space: nowrap;
        border-bottom: none;
    }
    .submenu li a::after {
        bottom: 2px;
        left: 16px;
        right: 16px;
    }
    .submenu li:last-child a { border-bottom: none; }
    .nav-menu li { animation: navFadeIn 0.5s cubic-bezier(0.4, 0, 0.2, 1) both; }
    .nav-menu li:nth-child(1) { animation-delay: 0.15s; }
    .nav-menu li:nth-child(2) { animation-delay: 0.22s; }
    .nav-menu li:nth-child(3) { animation-delay: 0.29s; }
    .nav-menu li:nth-child(4) { animation-delay: 0.36s; }
    .nav-menu li:nth-child(5) { animation-delay: 0.43s; }
    .nav-menu li:nth-child(6) { animation-delay: 0.50s; }
    .nav-menu li:nth-child(7) { animation-delay: 0.57s; }
    .nav-menu li a {
        display: block; padding: 12px 22px;
        font-size: 16px; font-weight: 500;
        color: var(--text-muted);
        text-decoration: none; border-radius: 100px;
        transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
        white-space: nowrap; position: relative;
    }
    /* Underline animasi — semua state */
    .nav-menu li:not(.nav-cta) a::after {
        content: '';
        position: absolute;
        bottom: 4px; left: 18px; right: 18px;
        height: 2px;
        border-radius: 1px; transform: scaleX(0);
        transform-origin: center;
        transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }
    .navbar:not(.scrolled) .nav-menu li:not(.nav-cta) a::after { background: linear-gradient(90deg, #0668C0, #7035CC); }
    .navbar.scrolled .nav-menu li:not(.nav-cta) a::after { background: linear-gradient(90deg, #0668C0, #7035CC); }
    .nav-menu li:not(.nav-cta) a:hover::after,
    .nav-menu li:not(.nav-cta) a.active::after { transform: scaleX(1); }

    /* Transparan (belum scroll) */
    .navbar:not(.scrolled) .nav-menu li a { color: rgba(255,255,255,0.85); }
    .navbar:not(.scrolled) .nav-menu li:not(.nav-cta) a:hover {
        background: linear-gradient(90deg, #0668C0, #7035CC);
        -webkit-background-clip: text;
        background-clip: text;
        -webkit-text-fill-color: transparent;
    }
    .navbar:not(.scrolled) .nav-menu li:not(.nav-cta) a.active {
        background: linear-gradient(90deg, #0668C0, #7035CC);
        -webkit-background-clip: text;
        background-clip: text;
        -webkit-text-fill-color: transparent;
    }
    .navbar:not(.scrolled) .hamburger span { background: white; }
    .navbar:not(.scrolled) .nav-menu li.nav-cta a:hover,
    .navbar:not(.scrolled) .nav-menu li.nav-cta a.active { color: white; }

    /* Sudah scroll */
    .navbar.scrolled .nav-menu li a { color: rgba(255,255,255,0.85); }
    .navbar.scrolled .nav-menu li:not(.nav-cta) a:hover {
        background: linear-gradient(90deg, #0668C0, #7035CC);
        -webkit-background-clip: text;
        background-clip: text;
        -webkit-text-fill-color: transparent;
    }
    .navbar.scrolled .nav-menu li:not(.nav-cta) a.active {
        background: linear-gradient(90deg, #0668C0, #7035CC);
        -webkit-background-clip: text;
        background-clip: text;
        -webkit-text-fill-color: transparent;
    }
    .navbar.scrolled .nav-menu li.nav-cta a:hover,
    .navbar.scrolled .nav-menu li.nav-cta a.active { color: white; }
    .navbar.scrolled .hamburger span { background: white; }

    /* CTA */
    .nav-menu li.nav-cta a {
        position: relative;
        display: inline-flex;
        align-items: center;
        border-radius: 100px;
        font-weight: 600;
        font-size: 16px;
        box-shadow: 0 4px 20px rgba(112,53,204,0.25);
        background: linear-gradient(90deg, #0668C0, #7035CC, #7035CC, #0668C0);
        background-size: 200% 100%;
        background-position: 0% 0%;
        border: 1px solid rgba(6,104,192,0.15);
        color: white;
        text-decoration: none;
        padding: 12px 28px 12px 44px;
        transition: padding 0.35s cubic-bezier(0.4, 0, 0.2, 1),
                    background-position 0.5s ease;
        overflow: hidden;
    }
    .nav-menu li.nav-cta a:hover {
        padding: 12px 44px 12px 28px;
        background-position: 100% 0%;
    }
    .cta-icon {
        position: absolute;
        top: 50%;
        left: 5px;
        transform: translateY(-50%);
        transition: left 0.35s cubic-bezier(0.4, 0, 0.2, 1);
        width: 28px;
        height: 28px;
        background: white;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .nav-menu li.nav-cta a:hover .cta-icon {
        left: calc(100% - 33px);
    }
    .cta-img {
        width: 14px;
        height: 14px;
        object-fit: contain;
        display: block;
    }

    /* HAMBURGER */
    .hamburger {
        display: none; flex-direction: column; gap: 5px;
        cursor: pointer; padding: 8px; border: none; background: none;
        border-radius: 8px; transition: background 0.2s;
        animation: navSlideDown 0.7s cubic-bezier(0.4, 0, 0.2, 1) 0.2s both;
        flex-shrink: 0;
        margin-left: auto;
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

    /* MOBILE / TABLET */
    @media (max-width: 1024px) {
        .navbar { height: 76px; }
        .nav-inner { padding: 0 20px; }
        .nav-logo img { height: 40px; }
        .hamburger { display: flex; }
        .nav-menu {
            display: none; position: fixed;
            top: 68px; left: 0; right: 0;
            background: rgba(1,32,60,0.97);
            backdrop-filter: blur(20px); -webkit-backdrop-filter: blur(20px);
            flex-direction: column; align-items: stretch;
            padding: 16px 16px 24px; gap: 2px;
            border-bottom: 1px solid rgba(255,255,255,0.08);
            box-shadow: 0 16px 40px rgba(0,0,0,0.3);
            margin-left: 0;
        }
        .nav-menu.open { display: flex; }
        .nav-menu li { animation: none; }
        .nav-menu li a {
            padding: 12px 22px;
            font-size: 16px; font-weight: 500;
            color: rgba(255,255,255,0.85);
            border-radius: 100px;
            border-bottom: none;
        }
        .nav-menu li:not(.nav-cta) a::after { display: block; }
        .nav-menu li:not(.nav-cta) a:hover,
        .nav-menu li:not(.nav-cta) a.active {
            background: linear-gradient(90deg, #0668C0, #7035CC);
            -webkit-background-clip: text;
            background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        .nav-menu li:last-child a { border-bottom: none; }
        .submenu {
            position: static;
            opacity: 0; visibility: hidden; transform: none;
            max-height: 0; overflow: hidden;
            transition: opacity 0.25s ease, max-height 0.35s ease;
            background: rgba(4,22,64,0.95);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid rgba(255,255,255,0.06);
            border-radius: 12px;
            padding: 0 8px;
            margin: 4px 0 0 0;
            min-width: auto;
            box-shadow: 0 8px 32px rgba(0,0,0,0.3);
        }
        .submenu.open {
            opacity: 1; visibility: visible;
            max-height: 300px;
            padding: 8px;
        }
        .submenu li a {
            font-size: 14px; padding: 10px 16px;
            color: rgba(255,255,255,0.75);
            border-bottom: none;
        }
        .submenu li a:hover,
        .submenu li a.active {
            background: linear-gradient(90deg, #0668C0, #7035CC);
            -webkit-background-clip: text;
            background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        .nav-menu li.nav-cta { margin-top: 8px; }
        .nav-menu li.nav-cta a .cta-icon {
            width: 28px;
            height: 28px;
        }
        .nav-menu li.nav-cta a .cta-img {
            width: 14px;
            height: 14px;
        }
    }
</style>

<nav class="navbar" id="navbar">
    <div class="nav-inner">
        <a href="{{ route('home') }}" class="nav-logo">
            <img src="{{ asset('img/logo/johen_logo.png') }}" alt="Johen Gaming" height="44">
        </a>

        <ul class="nav-menu" id="navMenu">
            <li><a href="{{ route('home') }}"   class="{{ request()->routeIs('home')    ? 'active' : '' }}">Beranda</a></li>
            <li><a href="{{ route('tentang') }}" class="{{ request()->routeIs('tentang') ? 'active' : '' }}">Tentang</a></li>
            <li class="nav-dropdown">
                <a href="{{ route('produk') }}" class="{{ request()->routeIs('produk*') ? 'active' : '' }}">Produk <span class="dropdown-arrow"></span></a>
                <ul class="submenu">
                    <li><a href="{{ route('produk.top-up') }}" class="{{ request()->routeIs('produk.top-up') ? 'active' : '' }}">Topup Game</a></li>
                    <li><a href="{{ route('produk.joki-ml') }}" class="{{ request()->routeIs('produk.joki-ml') ? 'active' : '' }}">Joki Mobile Legend</a></li>
                    <li><a href="{{ route('produk.jual-beli-akun') }}" class="{{ request()->routeIs('produk.jual-beli-akun') ? 'active' : '' }}">Jual Beli Akun</a></li>
                    <li><a href="{{ route('produk.live-commerce') }}" class="{{ request()->routeIs('produk.live-commerce') ? 'active' : '' }}">Live Commerce</a></li>
                </ul>
            </li>
            <li><a href="{{ route('berita') }}"  class="{{ request()->routeIs('berita*') ? 'active' : '' }}">Berita</a></li>
            <li><a href="{{ route('konten-digital') }}" class="{{ request()->routeIs('konten-digital') ? 'active' : '' }}">Partner</a></li>
            <li><a href="{{ route('karir') }}"   class="{{ request()->routeIs('karir')   ? 'active' : '' }}">Karir</a></li>
            <li class="nav-cta"><a href="https://wa.me/62812347070" target="_blank" rel="noopener"><span class="cta-icon"><img src="{{ asset('img/icon/telpon.png') }}" alt="Phone" class="cta-img"></span> Hubungi Kami</a></li>
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
        document.querySelector('.submenu')?.classList.remove('open');
        document.querySelector('.nav-dropdown')?.classList.remove('open');
    });

    navMenu.addEventListener('click', function(e) {
        const link = e.target.closest('a');
        if (!link) return;

        const isMobile = window.innerWidth <= 1024;

        if (isMobile && link.closest('.nav-dropdown') && !link.closest('.submenu')) {
            e.preventDefault();
            e.stopPropagation();
            const sub = link.nextElementSibling;
            sub?.classList.toggle('open');
            link.closest('.nav-dropdown')?.classList.toggle('open');
            return;
        }

        hamburger.classList.remove('open');
        navMenu.classList.remove('open');
        document.querySelector('.submenu')?.classList.remove('open');
        document.querySelector('.nav-dropdown')?.classList.remove('open');
    });
</script>
