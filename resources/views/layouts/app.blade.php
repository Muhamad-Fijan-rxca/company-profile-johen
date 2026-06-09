<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'PT. Johen Sukses Abadi') | JOHEN GAMING</title>
    <meta name="description" content="@yield('meta_desc', 'PT. Johen Sukses Abadi (JOHEN GAMING) - Perusahaan digital gaming commerce terpercaya di Bandung. Jual beli akun game online, top up game, jasa joki, live commerce, dan konten digital gaming.')">
    <link rel="icon" href="{{ asset('favicon.svg') }}" type="image/svg+xml">
    <link rel="apple-touch-icon" href="{{ asset('favicon.svg') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --primary:       #2563eb;
            --primary-dark:  #1a4a9e;
            --primary-light: rgba(37,99,235,0.15);
            --accent:        #00d4ff;
            --accent-hover:  #00b8e6;
            --purple:        #7c3aed;
            --gradient:      linear-gradient(135deg, #2563eb 0%, #7c3aed 100%);
            --text:          #f0f4ff;
            --text-muted:    #a0aec0;
            --bg:            #01203c;
            --white:         #052a48;
            --border:        rgba(37,99,235,0.15);
            --shadow-sm:     0 2px 8px rgba(0,0,0,0.3);
            --shadow-md:     0 4px 24px rgba(0,0,0,0.4);
            --shadow-lg:     0 12px 48px rgba(0,0,0,0.5);
            --radius:        16px;
            --radius-sm:     8px;
        }

        html { scroll-behavior: smooth; }
        body {
            font-family: 'Poppins', sans-serif;
            font-size: 16px;
            color: var(--text);
            background: var(--white);
            line-height: 1.6;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }

        /* ── TYPOGRAPHY ── */
        h1, h2, h3, h4, h5, h6 { 
            font-weight: 700; 
            line-height: 1.2; 
            letter-spacing: -0.02em;
            margin: 0;
        }
        h1 { font-size: clamp(32px, 5vw, 56px); font-weight: 900; letter-spacing: -0.03em; }
        h2 { font-size: clamp(28px, 4vw, 42px); font-weight: 800; }
        h3 { font-size: clamp(20px, 3vw, 28px); font-weight: 700; }
        h4 { font-size: clamp(18px, 2.5vw, 22px); font-weight: 600; }
        p { margin: 0 0 16px; line-height: 1.75; }
        strong { font-weight: 700; color: var(--accent); }
        a { transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1); }
        a:hover { transform: translateY(-1px); }

        /* ── LAYOUT ── */
        main { padding-top: 0; }
        .container { max-width: 1200px; margin: 0 auto; padding: 0 24px; }
        .section { padding: 80px 0; }
        .section-sm { padding: 48px 0; }

        /* ── SECTION HEADER ── */
        .section-header { text-align: center; margin-bottom: 56px; }
        .section-tag {
            display: inline-flex; align-items: center; gap: 8px;
            background: rgba(0,212,255,0.08);
            color: var(--accent);
            font-size: 11px; font-weight: 800;
            padding: 7px 18px; border-radius: 100px;
            margin-bottom: 16px;
            letter-spacing: 2px; text-transform: uppercase;
            border: 1px solid rgba(0,212,255,0.2);
        }
        .section-tag::before {
            content: '';
            width: 6px; height: 6px;
            background: var(--accent);
            border-radius: 50%;
            display: inline-block;
        }
        .section-title {
            font-size: clamp(28px, 4vw, 42px);
            font-weight: 900; color: var(--text);
            margin-bottom: 16px; line-height: 1.15;
            letter-spacing: -0.03em;
        }
        .section-title span { 
            color: var(--primary);
            position: relative;
        }
        .section-title span::after {
            content: '';
            position: absolute;
            bottom: -4px; left: 0; right: 0;
            height: 3px;
            background: var(--gradient);
            border-radius: 2px;
            transform: scaleX(0);
            transform-origin: left;
            transition: transform 0.6s cubic-bezier(0.4, 0, 0.2, 1) 0.3s;
        }
        .section-header.visible .section-title span::after { transform: scaleX(1); }
        .section-subtitle {
            color: var(--text-muted); font-size: 16px;
            max-width: 560px; margin: 0 auto; line-height: 1.8;
            font-weight: 400;
        }
        .divider {
            width: 56px; height: 4px;
            background: var(--gradient);
            border-radius: 2px;
            margin: 20px auto 0;
        }

        /* ── CARD ── */
        .card {
            background: var(--white);
            border-radius: var(--radius);
            box-shadow: var(--shadow-md);
            overflow: hidden;
            transition: transform 0.4s cubic-bezier(0.4, 0, 0.2, 1), 
                        box-shadow 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            will-change: transform;
        }
        .card:hover {
            transform: translateY(-8px);
            box-shadow: var(--shadow-lg);
        }
        .card::after {
            content: '';
            position: absolute;
            inset: 0;
            border-radius: var(--radius);
            border: 1.5px solid transparent;
            transition: border-color 0.3s;
            pointer-events: none;
        }
        .card:hover::after { border-color: rgba(0,212,255,0.2); }

        /* ── GRID ── */
        .grid-4 { display: grid; grid-template-columns: repeat(4,1fr); gap: 24px; }
        .grid-3 { display: grid; grid-template-columns: repeat(3,1fr); gap: 24px; }
        .grid-2 { display: grid; grid-template-columns: repeat(2,1fr); gap: 24px; }

        /* ── BUTTONS ── */
        .btn {
            display: inline-flex; align-items: center; gap: 8px;
            padding: 13px 28px; border-radius: 100px;
            font-family: 'Poppins', sans-serif;
            font-size: 14px; font-weight: 700;
            text-decoration: none; cursor: pointer;
            border: none; 
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            letter-spacing: 0.3px;
            position: relative; overflow: hidden;
        }
        .btn::before {
            content: '';
            position: absolute; inset: 0;
            background: rgba(255,255,255,0);
            transition: background 0.3s;
        }
        .btn:hover::before { background: rgba(255,255,255,0.12); }
        .btn i { transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1); }
        .btn:hover i { transform: translateX(3px); }
        .btn-primary {
            background: var(--gradient);
            color: white;
            box-shadow: 0 4px 20px rgba(124,58,237,0.35);
        }
        .btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 32px rgba(124,58,237,0.45);
        }
        .btn-accent {
            background: var(--gradient);
            color: white;
            box-shadow: 0 4px 20px rgba(124,58,237,0.35);
        }
        .btn-accent:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 32px rgba(124,58,237,0.45);
        }
        .btn-outline {
            background: transparent;
            color: var(--accent);
            border: 2px solid var(--accent);
        }
        .btn-outline:hover {
            background: rgba(0,212,255,0.1);
            color: var(--accent);
            transform: translateY(-3px);
            box-shadow: 0 8px 24px rgba(0,212,255,0.2);
        }
        .btn-white {
            background: rgba(255,255,255,0.12);
            color: white;
            border: 1.5px solid rgba(255,255,255,0.25);
            backdrop-filter: blur(8px);
        }
        .btn-white:hover { 
            background: rgba(255,255,255,0.2);
            transform: translateY(-3px);
            box-shadow: 0 10px 32px rgba(0,0,0,0.3);
        }
        .btn-lg { padding: 16px 36px; font-size: 15px; }
        .btn-sm { padding: 8px 18px; font-size: 13px; }

        /* ── BADGE ── */
        .badge {
            display: inline-block; padding: 4px 14px;
            border-radius: 100px; font-size: 12px; font-weight: 600;
        }
        .badge-primary { background: rgba(0,212,255,0.12); color: var(--accent); }
        .badge-success { background: rgba(16,185,129,0.15); color: #6ee7b7; }
        .badge-warning { background: rgba(245,166,35,0.15); color: #fbbf24; }
        .badge-danger  { background: rgba(239,68,68,0.15); color: #fca5a5; }

        /* ── ALERT ── */
        .alert {
            padding: 14px 20px; border-radius: var(--radius-sm);
            margin-bottom: 24px; font-size: 14px;
            display: flex; align-items: center; gap: 10px;
        }
        .alert-success { background: rgba(16,185,129,0.12); color: #6ee7b7; border-left: 4px solid #10b981; }
        .alert-error   { background: rgba(239,68,68,0.12); color: #fca5a5; border-left: 4px solid #ef4444; }

        /* ── FORM ── */
        .form-group { margin-bottom: 20px; }
        .form-label { display: block; font-size: 14px; font-weight: 600; margin-bottom: 7px; color: var(--text); }
        .form-control {
            width: 100%; padding: 12px 16px;
            border: 1.5px solid var(--border);
            border-radius: var(--radius-sm);
            font-family: 'Poppins', sans-serif;
            font-size: 14px; color: var(--text);
            background: rgba(255,255,255,0.06); outline: none;
            transition: border-color 0.2s, box-shadow 0.2s;
        }
        .form-control:focus {
            border-color: var(--accent);
            box-shadow: 0 0 0 3px rgba(0,212,255,0.1);
        }
        .form-control.is-invalid { border-color: #ef4444; }
        .invalid-feedback { color: #ef4444; font-size: 12px; margin-top: 4px; }
        textarea.form-control { resize: vertical; min-height: 120px; }
        .form-check { display: flex; align-items: center; gap: 8px; cursor: pointer; }
        .form-check input { width: 16px; height: 16px; cursor: pointer; accent-color: var(--primary); }
        .form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; }

        /* ── PAGE HERO (inner pages) ── */
        .page-hero {
            background:
                radial-gradient(ellipse 60% 50% at 70% 50%, rgba(37,99,235,0.12) 0%, transparent 70%),
                radial-gradient(ellipse 40% 60% at 20% 30%, rgba(124,58,237,0.08) 0%, transparent 70%),
                linear-gradient(160deg, #01203c 0%, #052a48 50%, #0a3050 100%);
            color: white; 
            padding: 152px 24px 72px;
            text-align: center; position: relative; overflow: hidden;
        }
        .page-hero::after {
            content: '';
            position: absolute;
            top: 0; right: 0;
            width: 50%; height: 100%;
            background: repeating-linear-gradient(-55deg,
                transparent, transparent 60px,
                rgba(255,255,255,0.015) 60px,
                rgba(255,255,255,0.015) 61px);
            pointer-events: none;
        }
        .page-hero::before {
            content: '';
            position: absolute; inset: 0;
            background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.04'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        }
        .page-hero h1 { font-size: clamp(28px, 5vw, 48px); font-weight: 800; margin-bottom: 14px; position: relative; }
        .page-hero p  { font-size: 16px; opacity: 0.85; max-width: 520px; margin: 0 auto; position: relative; line-height: 1.7; }

        /* ── SCROLL REVEAL ── */
        .reveal { 
            opacity: 0; 
            transform: translateY(40px);
            transition: opacity 0.8s cubic-bezier(0.4, 0, 0.2, 1), 
                        transform 0.8s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .reveal.visible { 
            opacity: 1; 
            transform: translateY(0); 
        }
        /* Stagger animation untuk grid items */
        .grid-3 .reveal:nth-child(1) { transition-delay: 0s; }
        .grid-3 .reveal:nth-child(2) { transition-delay: 0.1s; }
        .grid-3 .reveal:nth-child(3) { transition-delay: 0.2s; }
        .grid-3 .reveal:nth-child(4) { transition-delay: 0.3s; }
        .grid-3 .reveal:nth-child(5) { transition-delay: 0.4s; }
        .grid-3 .reveal:nth-child(6) { transition-delay: 0.5s; }
        
        /* Fade in from left */
        .reveal-left {
            opacity: 0;
            transform: translateX(-40px);
            transition: opacity 0.8s cubic-bezier(0.4, 0, 0.2, 1),
                        transform 0.8s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .reveal-left.visible {
            opacity: 1;
            transform: translateX(0);
        }
        
        /* Fade in from right */
        .reveal-right {
            opacity: 0;
            transform: translateX(40px);
            transition: opacity 0.8s cubic-bezier(0.4, 0, 0.2, 1),
                        transform 0.8s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .reveal-right.visible {
            opacity: 1;
            transform: translateX(0);
        }
        
        /* Scale in */
        .reveal-scale {
            opacity: 0;
            transform: scale(0.9);
            transition: opacity 0.6s cubic-bezier(0.4, 0, 0.2, 1),
                        transform 0.6s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .reveal-scale.visible {
            opacity: 1;
            transform: scale(1);
        }

        /* ── FLOATING BUTTONS ── */
        /* ── RESPONSIVE ── */
        @media (max-width: 1024px) {
            .grid-4 { grid-template-columns: repeat(2,1fr); }
            .grid-3 { grid-template-columns: repeat(2,1fr); }
            .container { padding: 0 20px; }
        }
        @media (max-width: 768px) {
            .grid-4, .grid-3, .grid-2 { grid-template-columns: 1fr; }
            .section { padding: 48px 0; }
            .section-header { margin-bottom: 36px; }
            .section-title { font-size: clamp(22px, 6vw, 32px); }
            .section-subtitle { font-size: 14px; }
            .form-row { grid-template-columns: 1fr; }
            .container { padding: 0 16px; }
            .btn-lg { padding: 14px 28px; font-size: 14px; }
            .page-hero { padding: 120px 16px 56px; }
            .page-hero h1 { font-size: clamp(24px, 7vw, 36px); }
            .page-hero p { font-size: 14px; }
            /* Card hover disabled di mobile (touch) */
            .card:hover { transform: none; box-shadow: var(--shadow-md); }
        }
        @media (max-width: 480px) {
            .grid-4, .grid-3, .grid-2 { grid-template-columns: 1fr; gap: 16px; }
            .section { padding: 40px 0; }
            .btn { padding: 11px 20px; font-size: 13px; }
            .btn-lg { padding: 13px 24px; font-size: 14px; }
        }
    </style>
    @stack('styles')
</head>
<body>

    @include('partials.header')

    <main>@yield('content')</main>

    @include('partials.cta')

    @include('partials.footer')

    <script>
        // Scroll reveal - semua variants
        const revealObserver = new IntersectionObserver(entries => {
            entries.forEach(e => {
                if (e.isIntersecting) {
                    e.target.classList.add('visible');
                    revealObserver.unobserve(e.target);
                }
            });
        }, { threshold: 0.12 });
        document.querySelectorAll('.reveal, .reveal-left, .reveal-right, .reveal-scale, .section-header')
            .forEach(el => revealObserver.observe(el));

        // Counter animasi untuk angka statistik
        function animateCounter(el) {
            const target = el.dataset.target;
            if (target.includes('/')) { el.textContent = target; return; }
            const isDecimal = target.includes('.');
            const num = parseFloat(target.replace(/[^0-9.]/g, ''));
            const suffix = target.replace(/[0-9.]/g, '');
            const decimals = isDecimal ? (target.split('.')[1]?.length || 1) : 0;
            let start = 0;
            const duration = 2000;
            const step = (timestamp) => {
                if (!start) start = timestamp;
                const progress = Math.min((timestamp - start) / duration, 1);
                const eased = 1 - Math.pow(1 - progress, 3);
                const current = eased * num;
                el.textContent = (isDecimal ? current.toFixed(decimals) : Math.floor(current)) + suffix;
                if (progress < 1) requestAnimationFrame(step);
            };
            requestAnimationFrame(step);
        }
        const counterObserver = new IntersectionObserver(entries => {
            entries.forEach(e => {
                if (e.isIntersecting && !e.target.dataset.counted) {
                    e.target.dataset.counted = true;
                    animateCounter(e.target);
                }
            });
        }, { threshold: 0.5 });
        document.querySelectorAll('[data-target]').forEach(el => counterObserver.observe(el));

        // Parallax ringan pada hero
        const heroSection = document.querySelector('.hero');
        if (heroSection) {
            window.addEventListener('scroll', () => {
                const scrolled = window.scrollY;
                const heroVisual = document.querySelector('.hero-visual-main');
                if (heroVisual && scrolled < window.innerHeight) {
                    heroVisual.style.transform = `scale(${1 + scrolled * 0.00005}) translateY(${scrolled * 0.08}px)`;
                }
            }, { passive: true });
        }
    </script>
    @stack('scripts')
</body>
</html>
