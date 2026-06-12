@extends('layouts.app')
@section('title', 'Produk & Layanan')

@push('styles')
<style>
    /* ── HERO (sama persis dengan about-hero) ── */
    .produk-hero {
        min-height: 55vh;
        display: flex; align-items: center; justify-content: center;
        position: relative; overflow: hidden;
        background: #020D2E;
        padding: 110px 24px 80px;
    }
    .produk-hero-bg {
        position: absolute; inset: 0; z-index: 0;
        background: url('{{ asset("img/bg/bg1.jpeg") }}') center/cover no-repeat;
        opacity: 0.3;
    }
    .produk-hero::before {
        content: '';
        position: absolute; inset: 0;
        background: linear-gradient(135deg,
            rgba(1,32,60,0.85) 0%,
            rgba(5,42,72,0.75) 45%,
            rgba(10,48,80,0.80) 100%
        );
        z-index: 1;
    }
    .produk-hero-content {
        position: relative;
        z-index: 2;
        text-align: center;
        max-width: 720px;
    }
    .produk-hero-content h1 {
        font-size: clamp(40px, 5.5vw, 62px);
        font-weight: 900;
        margin-bottom: 20px;
        letter-spacing: -0.5px;
        background: linear-gradient(90deg, #1a8cff, #7c3aed, #7c3aed);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        filter: drop-shadow(0 0 20px rgba(26,140,255,0.3)) drop-shadow(0 0 40px rgba(124,58,237,0.15));
    }
    .produk-hero-content p {
        font-size: 18px;
        color: rgba(255,255,255,0.85);
        line-height: 1.8;
        max-width: 700px;
        margin: 0 auto;
    }

    /* ── SECTION 2 — SOLUSI GAMING ── */
    .solusi-section {
        background: #04102E;
        padding: 80px 0;
    }
    .solusi-section .container {
        max-width: 1320px;
    }
    .solusi-header {
        text-align: center;
        margin-bottom: 56px;
    }
    .solusi-header h2 {
        font-size: clamp(28px, 4vw, 42px);
        font-weight: 800;
        color: white;
        line-height: 1.2;
    }
    .solusi-header h2 .highlight-blue,
    .solusi-header h2 .highlight-cyan {
        background: linear-gradient(90deg, #0987F5, #854DEA);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }
    .solusi-header h2 .highlight-white {
        color: white;
    }

    /* ── PRODUCT CARDS — sama persis dengan PRODUK UNGGULAN di home ── */
    .produk-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 32px; }
    .produk-card {
        background: #0A1E50;
        border: 1px solid rgba(0,212,255,0.12);
        border-radius: 20px;
        padding: 44px 30px 38px;
        display: flex; flex-direction: column;
        transition: border-color 0.3s, transform 0.3s;
    }
    .produk-card:hover {
        border-color: rgba(0,212,255,0.35);
        transform: translateY(-4px);
    }
    .produk-card .p-icon {
        position: relative;
        width: 56px; height: 56px;
        border-radius: 50%;
        background: transparent;
        display: flex; align-items: center; justify-content: center;
        font-size: 24px;
        margin-bottom: 22px;
    }
    .produk-card .p-icon::before {
        content: '';
        position: absolute; inset: 0;
        border-radius: 50%;
        padding: 1.5px;
        background: linear-gradient(135deg, #00d4ff, #7c3aed);
        -webkit-mask: linear-gradient(#fff 0 0) content-box, linear-gradient(#fff 0 0);
        -webkit-mask-composite: xor;
        mask-composite: exclude;
        pointer-events: none;
    }
    .produk-card h3 { font-size: 19px; font-weight: 700; color: white; margin: 0 0 11px; }
    .produk-card .p-desc { font-size: 14px; color: var(--text-muted); line-height: 1.65; margin: 0 0 26px; flex: 1; border-bottom: 1px solid rgba(0,212,255,0.1); padding-bottom: 26px; }
    .produk-card .p-price-label { font-size: 13px; color: var(--text-muted); margin-bottom: 3px; }
    .produk-card .p-price { font-size: 34px; font-weight: 500; margin-bottom: 22px; font-family: 'Poppins', sans-serif; background: linear-gradient(90deg, #1a8cff, #7c3aed, #7c3aed); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; }
    .produk-card .p-btn {
        position: relative;
        display: inline-flex; align-items: center;
        padding: 11px 26px 11px 50px;
        border: 1px solid rgba(6,104,192,0.15);
        border-radius: 100px;
        font-family: 'Poppins', sans-serif; font-size: 13px; font-weight: 600;
        color: white;
        text-decoration: none;
        background: linear-gradient(90deg, #0668C0, #7035CC, #7035CC, #0668C0);
        background-size: 200% 100%;
        background-position: 0% 0%;
        box-shadow: 0 4px 20px rgba(112,53,204,0.25);
        overflow: hidden;
        align-self: flex-start;
        transition: padding 0.35s cubic-bezier(0.4, 0, 0.2, 1),
                    background-position 0.5s ease;
    }
    .produk-card .p-btn:hover {
        padding: 11px 50px 11px 26px;
        background-position: 100% 0%;
    }
    .produk-card .p-btn .p-btn-icon {
        position: absolute;
        top: 50%; left: 5px;
        transform: translateY(-50%) rotate(0deg);
        width: 30px; height: 30px; border-radius: 50%;
        background: white;
        display: flex; align-items: center; justify-content: center;
        font-size: 13px; color: #7035CC;
        transition: left 0.35s cubic-bezier(0.4, 0, 0.2, 1),
                    transform 0.35s cubic-bezier(0.4, 0, 0.2, 1);
    }
    .produk-card .p-btn:hover .p-btn-icon {
        left: calc(100% - 35px);
        transform: translateY(-50%) rotate(45deg);
    }

    /* ── STATS BAR (sama persis dengan hero-stats di home) ── */
    .stats-bar {
        max-width: 1320px;
        margin: 56px auto 0;
        padding: 0 24px;
    }
    .stats-bar-inner {
        width: 100%;
        display: grid;
        grid-template-columns: repeat(5, 1fr);
        background: #041640;
        border-radius: 16px;
        padding: 24px 24px 16px;
        gap: 16px;
        position: relative;
        box-shadow:
            0 0 40px rgba(0,212,255,0.1),
            inset 0 2px 0 rgba(0,212,255,0.35),
            inset 0 -2px 0 rgba(0,212,255,0.2),
            inset 2px 0 0 rgba(0,212,255,0.15),
            inset -2px 0 0 rgba(0,212,255,0.15);
    }
    .stat-item {
        display: flex; flex-direction: column;
        align-items: center; text-align: center;
        padding: 4px 12px;
    }
    .stat-number {
        font-size: 30px; font-weight: 900;
        background: linear-gradient(90deg, #4FC3F7, #7C4DFF);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        line-height: 1; margin-bottom: 4px;
        font-family: 'Poppins', sans-serif;
    }
    .stat-label {
        font-size: 13px; color: rgba(255,255,255,0.7);
        font-weight: 500;
    }
    @media (max-width: 768px) {
        .stats-bar-inner { grid-template-columns: repeat(2, 1fr); padding: 16px 12px; gap: 8px; }
        .stat-number { font-size: 24px; }
        .stat-label { font-size: 11px; }
        .stat-item:last-child { grid-column: 1 / -1; }
    }

    /* ── RESPONSIVE ── */
    @media (max-width: 1100px) { .produk-grid { grid-template-columns: repeat(2, 1fr); } }
    @media (max-width: 600px)  { .produk-grid { grid-template-columns: 1fr; } }
    @media (max-width: 640px) {
        .produk-hero { padding: 100px 16px 60px; min-height: 40vh; }
        .produk-hero-content h1 { font-size: clamp(28px, 8vw, 40px); }
        .produk-hero-content p { font-size: 15px; }
        .solusi-section { padding: 48px 0; }
    }
</style>
@endpush

@section('content')
{{-- HERO --}}
<section class="produk-hero">
    <div class="produk-hero-bg"></div>
    <div class="produk-hero-content">
        <h1>Produk</h1>
        <p>Produk digital gaming commerce lengkap dari Johen Gaming:<br>Jual beli akun game online, top up game, jasa joki, dan live commerce.</p>
    </div>
</section>

{{-- SECTION SOLUSI GAMING --}}
<section class="solusi-section">
    <div class="container">
        <div class="solusi-header">
            <h2>
                <span class="highlight-blue">Solusi Gaming</span>
                <span class="highlight-white"> untuk</span><br>
                <span class="highlight-white">Setiap </span>
                <span class="highlight-cyan">Kebutuhan</span>
            </h2>
        </div>

        <div class="produk-grid">
        <div class="produk-card">
            <div class="p-icon"><img src="{{ asset('img/icon/wallet.png') }}" alt="Top Up" style="width:26px;height:26px;object-fit:contain;"></div>
            <h3>Top Up Games</h3>
            <p class="p-desc">Isi ulang berbagai game favorit kamu dengan harga termurah dan proses cepat.</p>
            <div class="p-price-label">Mulai dari</div>
            <div class="p-price">Rp 5.000</div>
            <a href="{{ route('produk.top-up') }}" class="p-btn">
                <span class="p-btn-icon"><img src="{{ asset('img/icon/petunjuk.png') }}" alt="→" style="width:12px;height:12px;object-fit:contain;"></span>
                Lihat Selengkapnya
            </a>
        </div>
        <div class="produk-card">
            <div class="p-icon"><img src="{{ asset('img/icon/gamepad.png') }}" alt="Joki" style="width:26px;height:26px;object-fit:contain;"></div>
            <h3>Joki Mobile Legends</h3>
            <p class="p-desc">Tingkatkan rank Mobile Legends kamu dengan jasa joki profesional dan terpercaya.</p>
            <div class="p-price-label">Mulai dari</div>
            <div class="p-price">Rp 10.000</div>
            <a href="{{ route('produk.joki-ml') }}" class="p-btn">
                <span class="p-btn-icon"><img src="{{ asset('img/icon/petunjuk.png') }}" alt="→" style="width:12px;height:12px;object-fit:contain;"></span>
                Lihat Selengkapnya
            </a>
        </div>
        <div class="produk-card">
            <div class="p-icon"><img src="{{ asset('img/icon/tasicon.png') }}" alt="Jual Beli" style="width:26px;height:26px;object-fit:contain;"></div>
            <h3>Jual Beli Akun Games</h3>
            <p class="p-desc">Tempat terbaik untuk jual atau beli akun game favorit dengan harga terbaik.</p>
            <div class="p-price-label">Mulai dari</div>
            <div class="p-price">Rp 100.000</div>
            <a href="{{ route('produk.jual-beli-akun') }}" class="p-btn">
                <span class="p-btn-icon"><img src="{{ asset('img/icon/petunjuk.png') }}" alt="→" style="width:12px;height:12px;object-fit:contain;"></span>
                Lihat Selengkapnya
            </a>
        </div>
        <div class="produk-card">
            <div class="p-icon"><img src="{{ asset('img/icon/camvid.png') }}" alt="Live Commerce" style="width:26px;height:26px;object-fit:contain;"></div>
            <h3>Live Commerce</h3>
            <p class="p-desc">Nikmati pengalaman belanja langsung melalui siaran直播 dengan host berpengalaman.</p>
            <div class="p-price-label">Mulai dari</div>
            <div class="p-price">Rp 10.000</div>
            <a href="{{ route('produk.live-commerce') }}" class="p-btn">
                <span class="p-btn-icon"><img src="{{ asset('img/icon/petunjuk.png') }}" alt="→" style="width:12px;height:12px;object-fit:contain;"></span>
                Lihat Selengkapnya
            </a>
        </div>
    </div>
    </div>

    {{-- STATS BAR --}}
    <div class="stats-bar">
        <div class="stats-bar-inner">
            <div class="stat-item">
                <div class="stat-number">10.000+</div>
                <div class="stat-label">Transaksi Berhasil</div>
            </div>
            <div class="stat-item">
                <div class="stat-number">10.000+</div>
                <div class="stat-label">Pelanggan Aktif</div>
            </div>
            <div class="stat-item">
                <div class="stat-number">5+</div>
                <div class="stat-label">Divisi Store</div>
            </div>
            <div class="stat-item">
                <div class="stat-number">4.9 ★</div>
                <div class="stat-label">Rating Rata Rata</div>
            </div>
            <div class="stat-item">
                <div class="stat-number">100%</div>
                <div class="stat-label">Keamanan Terjamin</div>
            </div>
        </div>
    </div>
</section>
@endsection
