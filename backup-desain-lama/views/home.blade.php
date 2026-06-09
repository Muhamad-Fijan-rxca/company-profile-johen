@extends('layouts.app')
@section('title', 'Home')

@push('styles')
<style>
    /* ── HERO ── */
    .hero {
        min-height: 100vh;
        background: linear-gradient(135deg, #0f2878 0%, #1a3fa8 45%, #6a1b9a 100%);
        display: flex; align-items: center;
        position: relative; overflow: hidden;
        padding: 120px 0 80px;
    }
    /* Background foto slideshow */
    .hero-bg {
        position: absolute; inset: 0;
        z-index: 0;
    }
    .hero-bg-slide {
        position: absolute; inset: 0;
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        opacity: 0;
        transition: opacity 2s ease-in-out;
        will-change: opacity;
    }
    .hero-bg-slide.active { opacity: 1; }
    .hero-bg-slide:nth-child(1) { background-image: url('{{ asset("img/bg/bg1.jpeg") }}'); }
    .hero-bg-slide:nth-child(2) { background-image: url('{{ asset("img/bg/bg2.jpeg") }}'); }

    /* Overlay global — selalu ada, warna dasar gelap agar teks terbaca */
    .hero-overlay {
        position: absolute; inset: 0;
        background: linear-gradient(
            135deg,
            rgba(15, 40, 120, 0.75) 0%,
            rgba(26, 63, 168, 0.65) 45%,
            rgba(106, 27, 154, 0.70) 100%
        );
        z-index: 1;
    }

    /* Overlay kiri — ikut fade in/out bersama foto, hanya di sisi kiri (area teks) */
    .hero-overlay-left {
        position: absolute; inset: 0;
        background: linear-gradient(
            to right,
            rgba(5, 15, 60, 1) 0%,
            rgba(5, 15, 60, 0.95) 20%,
            rgba(5, 15, 60, 0.7) 40%,
            rgba(5, 15, 60, 0.2) 60%,
            transparent 75%
        );
        z-index: 2;
        opacity: 0;
        transition: opacity 2s ease-in-out;
        will-change: opacity;
        pointer-events: none;
    }
    .hero-overlay-left.active { opacity: 1; }

    .hero-container {
        width: 100%;
        padding: 0 32px 0 64px;
        display: grid; grid-template-columns: 55fr 45fr;
        gap: 48px; align-items: center;
        position: relative; z-index: 2;
    }

    /* LEFT */
    .hero-tag {
        display: inline-flex; align-items: center; gap: 8px;
        background: rgba(255,255,255,0.12);
        border: 1.5px solid rgba(255,255,255,0.25);
        color: white;
        padding: 8px 18px; border-radius: 100px;
        font-size: 13px; font-weight: 600;
        margin-bottom: 24px;
        backdrop-filter: blur(8px);
    }
    .hero-tag i { color: #fbbf24; }
    .hero-content h1 {
        font-size: clamp(36px, 5vw, 56px);
        font-weight: 900; color: white;
        line-height: 1.15; margin-bottom: 20px;
        letter-spacing: -0.5px;
    }
    .hero-content h1 .highlight { color: #c4b5fd; }
    .hero-content h1 .accent    { color: #fbbf24; }
    .hero-desc {
        font-size: 17px; color: rgba(255,255,255,0.8);
        line-height: 1.8; margin-bottom: 32px;
        max-width: 520px;
    }
    .hero-actions { display: flex; gap: 14px; flex-wrap: wrap; margin-bottom: 48px; }
    .btn-hero-outline {
        display: inline-flex; align-items: center; gap: 8px;
        padding: 16px 36px; border-radius: 100px;
        font-family: 'Poppins', sans-serif; font-size: 15px; font-weight: 700;
        background: rgba(255,255,255,0.15);
        color: white;
        border: 2px solid rgba(255,255,255,0.4);
        backdrop-filter: blur(8px);
        text-decoration: none; cursor: pointer;
        transition: all 0.25s;
    }
    .btn-hero-outline:hover {
        background: rgba(255,255,255,0.25);
        border-color: white;
        transform: translateY(-2px);
    }
    .hero-stats {
        display: flex; gap: 40px; flex-wrap: wrap;
        padding-top: 32px;
        border-top: 1px solid rgba(255,255,255,0.15);
    }
    .hero-stat { display: flex; flex-direction: column; }
    .hero-stat .num  { font-size: 32px; font-weight: 900; color: #fbbf24; line-height: 1; margin-bottom: 6px; }
    .hero-stat .label { font-size: 13px; color: rgba(255,255,255,0.65); font-weight: 500; }

    /* RIGHT: Visual */
    .hero-visual {
        position: relative;
        display: flex; align-items: center; justify-content: center;
        padding-right: 32px;
    }
    .hero-visual-main {
        position: relative;
        width: 100%; max-width: 460px; aspect-ratio: 1;
        background: rgba(255,255,255,0.12);
        border: 2px solid rgba(255,255,255,0.2);
        border-radius: 50%;
        display: flex; align-items: center; justify-content: center;
        backdrop-filter: blur(12px);
        box-shadow: 0 24px 64px rgba(0,0,0,0.2);
        animation: pulse 4s ease-in-out infinite;
    }
    @keyframes pulse {
        0%, 100% { transform: scale(1); }
        50%       { transform: scale(1.03); }
    }
    .hero-visual-icon { font-size: 120px; filter: drop-shadow(0 8px 24px rgba(0,0,0,0.3)); }
    .hero-visual-float {
        position: absolute;
        background: white; border-radius: 16px;
        padding: 14px 18px;
        box-shadow: 0 8px 32px rgba(0,0,0,0.15);
        display: flex; align-items: center; gap: 10px;
        animation: floatCard 3s ease-in-out infinite;
    }
    @keyframes floatCard {
        0%, 100% { transform: translateY(0); }
        50%       { transform: translateY(-10px); }
    }
    .hero-visual-float.f1 { top: 8%; left: 8%; animation-delay: 0s; }
    .hero-visual-float.f2 { top: 55%; right: 8%; animation-delay: 1s; }
    .hero-visual-float.f3 { bottom: 8%; left: 18%; animation-delay: 2s; }
    .hero-visual-float .ficon {
        width: 38px; height: 38px;
        background: var(--primary-light); border-radius: 10px;
        display: flex; align-items: center; justify-content: center;
        font-size: 18px;
    }
    .hero-visual-float .ftext { font-size: 13px; font-weight: 700; color: var(--text); white-space: nowrap; }

    /* ── FEATURES ── */
    .features { background: white; }
    .feature-card {
        padding: 32px 28px; text-align: center;
        border: 1.5px solid var(--border);
        transition: all 0.3s;
    }
    .feature-card:hover { border-color: var(--primary); background: var(--primary-light); }
    .feature-icon {
        width: 72px; height: 72px;
        background: var(--gradient); border-radius: 18px;
        display: flex; align-items: center; justify-content: center;
        margin: 0 auto 20px; font-size: 32px;
        box-shadow: 0 8px 24px rgba(26,63,168,0.2);
    }
    .feature-card h3 { font-size: 17px; font-weight: 700; margin-bottom: 10px; }
    .feature-card p  { font-size: 14px; color: var(--text-muted); line-height: 1.7; }

    /* ── PRODUK ── */
    .produk-section { background: var(--bg); }
    .produk-card .img-wrap {
        width: 100%; aspect-ratio: 16/9;
        background: var(--gradient);
        display: flex; align-items: center; justify-content: center;
        font-size: 56px; overflow: hidden;
    }
    .produk-card .img-wrap img { width: 100%; height: 100%; object-fit: cover; }
    .produk-card .card-body { padding: 24px; }
    .produk-card .card-body h3 { font-size: 17px; font-weight: 700; margin: 10px 0 8px; }
    .produk-card .card-body p  { font-size: 14px; color: var(--text-muted); line-height: 1.6; margin-bottom: 16px; }
    .produk-card .card-footer {
        padding: 16px 24px; border-top: 1px solid var(--border);
    }

    /* ── BERITA ── */
    .berita-section { background: white; }
    .berita-card .img-wrap {
        width: 100%; aspect-ratio: 16/9;
        background: var(--gradient);
        display: flex; align-items: center; justify-content: center;
        font-size: 56px; overflow: hidden;
    }
    .berita-card .img-wrap img { width: 100%; height: 100%; object-fit: cover; }
    .berita-card .card-body { padding: 24px; }
    .berita-card .card-meta { font-size: 12px; color: var(--text-muted); margin-bottom: 12px; display: flex; align-items: center; gap: 8px; }
    .berita-card .card-body h3 { font-size: 16px; font-weight: 700; margin-bottom: 10px; line-height: 1.4; }
    .berita-card .card-body p  { font-size: 14px; color: var(--text-muted); margin-bottom: 16px; line-height: 1.6; }
    .read-more {
        font-size: 13px; font-weight: 700; color: var(--primary);
        text-decoration: none; display: inline-flex; align-items: center; gap: 6px;
        transition: gap 0.2s;
    }
    .read-more:hover { gap: 10px; }

    /* ── CTA ── */
    .cta-section {
        background: var(--gradient);
        padding: 80px 24px; text-align: center;
        color: white; position: relative; overflow: hidden;
    }
    .cta-section::before {
        content: '';
        position: absolute; inset: 0;
        background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none'%3E%3Cg fill='%23ffffff' fill-opacity='0.05'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
    }
    .cta-section .container { position: relative; z-index: 1; }
    .cta-section h2 { font-size: clamp(28px, 4vw, 42px); font-weight: 900; margin-bottom: 16px; }
    .cta-section p  { font-size: 17px; opacity: 0.9; max-width: 520px; margin: 0 auto 32px; line-height: 1.7; }

    /* ── HERO ENTRANCE ANIMATIONS ── */
    @keyframes heroFadeUp {
        from { opacity: 0; transform: translateY(32px); }
        to   { opacity: 1; transform: translateY(0); }
    }
    @keyframes heroFadeIn {
        from { opacity: 0; }
        to   { opacity: 1; }
    }
    .hero-tag     { animation: heroFadeUp 0.7s cubic-bezier(0.4,0,0.2,1) 0.2s both; }
    .hero-content h1   { animation: heroFadeUp 0.7s cubic-bezier(0.4,0,0.2,1) 0.35s both; }
    .hero-desc    { animation: heroFadeUp 0.7s cubic-bezier(0.4,0,0.2,1) 0.5s both; }
    .hero-actions { animation: heroFadeUp 0.7s cubic-bezier(0.4,0,0.2,1) 0.65s both; }
    .hero-stats   { animation: heroFadeUp 0.7s cubic-bezier(0.4,0,0.2,1) 0.8s both; }
    .hero-visual  { animation: heroFadeIn 1s cubic-bezier(0.4,0,0.2,1) 0.4s both; }
    @media (max-width: 1100px) {
        .hero-container { padding: 0 24px 0 40px; }
    }
    @media (max-width: 900px) {
        .hero-container { grid-template-columns: 1fr; gap: 48px; text-align: center; padding: 0 24px; }
        .hero-desc { margin-left: auto; margin-right: auto; }
        .hero-actions { justify-content: center; }
        .hero-stats { justify-content: center; }
        .hero-visual { justify-content: center; padding-right: 0; }
        .hero-visual-float { scale: 0.85; }
        .hero-visual-float.f1 { top: -6%; left: -4%; }
        .hero-visual-float.f2 { top: auto; bottom: 0; right: -4%; }
        .hero-visual-float.f3 { bottom: 12%; left: -2%; }
    }
</style>
@endpush

@section('content')

{{-- HERO --}}
<section class="hero">
    {{-- Background slideshow --}}
    <div class="hero-bg">
        <div class="hero-bg-slide active"></div>
        <div class="hero-bg-slide"></div>
    </div>
    {{-- Overlay global --}}
    <div class="hero-overlay"></div>
    {{-- Overlay kiri ikut fade bersama foto --}}
    <div class="hero-overlay-left active" id="heroOverlayLeft"></div>
    <div class="hero-container">
        <div class="hero-content">
            <div class="hero-tag">
                <i class="fas fa-trophy"></i>
                Digital Gaming Commerce Terpercaya di Bandung
            </div>
            <h1>
                <span class="highlight">Pusat Jual Beli Akun</span><br>
                <span class="accent">Game Online</span><br>
                Terpercaya
            </h1>
            <p class="hero-desc">
                PT. Johen Sukses Abadi (JOHEN GAMING) — Solusi lengkap untuk jual beli akun game online, top up game, jasa joki, live commerce, dan konten digital gaming. Proses cepat, aman, dan transparan.
            </p>
            <div class="hero-actions">
                <a href="{{ route('kontak') }}" class="btn btn-accent btn-lg">
                    <i class="fas fa-headset"></i> Konsultasi Sekarang
                </a>
                <a href="{{ route('produk') }}" class="btn-hero-outline">
                    <i class="fas fa-th-large"></i> Lihat Produk
                </a>
            </div>
            <div class="hero-stats">
                <div class="hero-stat"><span class="num" data-target="2022">0</span><span class="label">Berdiri Sejak</span></div>
                <div class="hero-stat"><span class="num" data-target="5+">0</span><span class="label">Divisi Store</span></div>
                <div class="hero-stat"><span class="num" data-target="20+">0</span><span class="label">Tim Profesional</span></div>
                <div class="hero-stat"><span class="num" data-target="100%">0</span><span class="label">Keamanan Terjamin</span></div>
            </div>
        </div>

        <div class="hero-visual">
            <div class="hero-visual-main">
                <img src="{{ asset('img/icon/icon_mengambang_logo.png') }}" alt="Johen Gaming" style="width:80%;height:80%;object-fit:contain;position:relative;z-index:1;filter:drop-shadow(0 8px 24px rgba(0,0,0,0.3));">
            </div>
            <div class="hero-visual-float f1">
                <div class="ficon" style="background:none;"><img src="{{ asset('img/icon/stopwatch.gif') }}" alt="Proses Instan" style="width:38px;height:38px;object-fit:contain;"></div><span class="ftext">Proses Instan</span>
            </div>
            <div class="hero-visual-float f2">
                <div class="ficon" style="background:none;"><img src="{{ asset('img/icon/shield.gif') }}" alt="100% Aman" style="width:38px;height:38px;object-fit:contain;"></div><span class="ftext">100% Aman</span>
            </div>
            <div class="hero-visual-float f3">
                <div class="ficon" style="background:none;"><img src="{{ asset('img/icon/dollar.gif') }}" alt="Harga Terbaik" style="width:38px;height:38px;object-fit:contain;"></div><span class="ftext">Harga Terbaik</span>
            </div>
        </div>
    </div>
</section>

{{-- FEATURES --}}
<section class="section features">
    <div class="container">
        <div class="grid-3">
            <div class="card feature-card reveal-left">
                <div class="feature-icon">🔒</div>
                <h3>Keamanan Akun Terbaik</h3>
                <p>Standar keamanan akun tertinggi dengan sistem verifikasi berlapis untuk setiap transaksi jual beli akun game.</p>
            </div>
            <div class="card feature-card reveal-scale" style="transition-delay:.15s">
                <div class="feature-icon">⚡</div>
                <h3>Proses Cepat & Transparan</h3>
                <p>Transaksi diproses cepat dengan sistem yang transparan dan dapat dilacak oleh pelanggan setiap saat.</p>
            </div>
            <div class="card feature-card reveal-right" style="transition-delay:.3s">
                <div class="feature-icon">🏢</div>
                <h3>Kantor Operasional Fisik</h3>
                <p>Memiliki kantor operasional di Ruko Topaz, Summarecon Bandung untuk pelayanan langsung yang lebih terpercaya.</p>
            </div>
        </div>
    </div>
</section>

{{-- PRODUK UNGGULAN --}}
<section class="section produk-section">
    <div class="container">
        <div class="section-header reveal">
            <span class="section-tag">Produk Unggulan</span>
            <h2 class="section-title">Layanan <span>Unggulan</span> Kami</h2>
            <p class="section-subtitle">Layanan digital gaming commerce terbaik yang kami sediakan untuk kebutuhan game Anda.</p>
            <div class="divider"></div>
        </div>
        <div class="grid-3">
            @forelse($produkUnggulan as $p)
            <div class="card produk-card reveal" style="transition-delay:{{ $loop->index * 0.1 }}s">
                <div class="img-wrap">
                    @if($p->gambar)
                        <img src="{{ Storage::url($p->gambar) }}" alt="{{ $p->nama }}">
                    @else
                        🎮
                    @endif
                </div>
                <div class="card-body">
                    <span class="badge badge-primary">{{ $p->kategori }}</span>
                    <h3>{{ $p->nama }}</h3>
                    <p>{{ Str::limit($p->deskripsi, 100) }}</p>
                </div>
                <div class="card-footer">
                    <a href="{{ route('kontak') }}" class="btn btn-primary btn-sm">Pesan Sekarang</a>
                </div>
            </div>
            @empty
            <div style="grid-column:1/-1;text-align:center;color:var(--text-muted);padding:48px">Belum ada produk unggulan.</div>
            @endforelse
        </div>
        <div style="text-align:center;margin-top:48px">
            <a href="{{ route('produk') }}" class="btn btn-outline btn-lg">Lihat Semua Produk <i class="fas fa-arrow-right"></i></a>
        </div>
    </div>
</section>

{{-- BERITA TERBARU --}}
<section class="section berita-section">
    <div class="container">
        <div class="section-header reveal">
            <span class="section-tag">Johen News</span>
            <h2 class="section-title">Berita & <span>Update</span> Terbaru</h2>
            <p class="section-subtitle">Informasi terkini seputar dunia gaming dan update dari PT Johen Gaming.</p>
            <div class="divider"></div>
        </div>
        <div class="grid-3">
            @forelse($beritaTerbaru as $b)
            <div class="card berita-card reveal" style="transition-delay:{{ $loop->index * 0.1 }}s">
                <div class="img-wrap">
                    @if($b->thumbnail)
                        <img src="{{ Storage::url($b->thumbnail) }}" alt="{{ $b->judul }}">
                    @else
                        📰
                    @endif
                </div>
                <div class="card-body">
                    <div class="card-meta"><i class="fas fa-calendar-alt"></i> {{ $b->created_at->format('d M Y') }}</div>
                    <h3>{{ $b->judul }}</h3>
                    <p>{{ $b->ringkasan }}</p>
                    <a href="{{ route('berita.show', $b->slug) }}" class="read-more">Baca Selengkapnya <i class="fas fa-arrow-right"></i></a>
                </div>
            </div>
            @empty
            <div style="grid-column:1/-1;text-align:center;color:var(--text-muted);padding:48px">Belum ada berita.</div>
            @endforelse
        </div>
        <div style="text-align:center;margin-top:48px">
            <a href="{{ route('berita') }}" class="btn btn-outline btn-lg">Lihat Semua Berita <i class="fas fa-arrow-right"></i></a>
        </div>
    </div>
</section>

{{-- CTA --}}
<section class="cta-section">
    <div class="container reveal">
        <h2>Siap Bertransaksi?</h2>
        <p>Kunjungi kantor kami di Summarecon Bandung atau hubungi tim Johen Gaming sekarang juga.</p>
        <a href="{{ route('kontak') }}" class="btn btn-white btn-lg">
            <i class="fas fa-headset"></i> Hubungi Kami Sekarang
        </a>
    </div>
</section>

@push('scripts')
<script>
    const slides = document.querySelectorAll('.hero-bg-slide');
    const overlayLeft = document.getElementById('heroOverlayLeft');
    let current = 0;

    setInterval(() => {
        const next = (current + 1) % slides.length;

        // Fade OUT foto + overlay kiri bersamaan
        slides[current].classList.remove('active');
        overlayLeft.classList.remove('active');

        // Setelah fade out selesai (2s), fade IN foto + overlay kiri bersamaan
        setTimeout(() => {
            slides[next].classList.add('active');
            overlayLeft.classList.add('active');
            current = next;
        }, 2000);

    }, 8000);
</script>
@endpush
