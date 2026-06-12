@extends('layouts.app')
@section('title', $berita->judul)
@section('meta_desc', Str::limit(strip_tags($berita->isi), 160))

@php
$words = str_word_count(strip_tags($berita->isi));
$estBaca = max(1, ceil($words / 200));
@endphp

@push('styles')
<style>

/* ── HERO ARTICLE ── */
.hero-article {
    position: relative;
    min-height: 420px;
    display: flex;
    align-items: flex-end;
    padding: 60px 0 48px;
    overflow: hidden;
    background: #020D2E;
}

.hero-article::before {
    content: '';
    position: absolute;
    inset: 0;
    background: url("{{ $berita->thumbnail ? Storage::url($berita->thumbnail) : asset('img/bg/bg1.jpeg') }}") center center / cover no-repeat;
    z-index: 1;
}

.hero-article::after {
    content: '';
    position: absolute;
    inset: 0;
    background: linear-gradient(0deg, #0D1226 0%, rgba(13,18,38,0.75) 35%, rgba(13,18,38,0.3) 70%, rgba(13,18,38,0.1) 100%);
    z-index: 2;
}


.hero-article-content {
    position: relative;
    z-index: 3;
    max-width: 800px;
}

.hero-article-content .label-kategori {
    font-size: 12px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 2px;
    color: #06B6D4;
    margin-bottom: 12px;
    display: block;
}

.hero-article-content h1 {
    font-size: clamp(28px, 4vw, 44px);
    font-weight: 900;
    color: #FFFFFF;
    line-height: 1.2;
    margin: 0 0 20px;
}

.hero-article-meta {
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
    font-size: 13px;
    color: rgba(255,255,255,0.7);
}

.hero-article-meta span {
    display: flex;
    align-items: center;
    gap: 6px;
}

.hero-article-meta i {
    font-size: 12px;
    color: rgba(255,255,255,0.5);
}

/* ── MAIN LAYOUT ── */
.article-main-section {
    background: #0D1226;
    padding: 48px 0;
}

.article-layout {
    display: grid;
    grid-template-columns: 1fr 320px;
    gap: 48px;
    align-items: start;
}

/* ── ARTICLE BODY ── */
.article-body-wrap .featured-img {
    width: 100%;
    aspect-ratio: 16/9;
    object-fit: cover;
    border-radius: 16px;
    margin-bottom: 32px;
    display: block;
}

.featured-img-placeholder {
    width: 100%;
    aspect-ratio: 16/9;
    border-radius: 16px;
    background: linear-gradient(135deg, #111827, #1A2035);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 64px;
    color: rgba(255,255,255,0.1);
    margin-bottom: 32px;
}

.article-body {
    font-size: 16px;
    line-height: 1.9;
    color: #D1D5DB;
}

.article-body p {
    margin-bottom: 20px;
}

.article-body h2,
.article-body h3 {
    font-weight: 700;
    color: #FFFFFF;
    margin: 36px 0 16px;
}

.article-body h2 { font-size: 22px; }
.article-body h3 { font-size: 18px; }

/* ── BLOCKQUOTE ── */
.blockquote-card {
    background: #111827;
    border-left: 4px solid #7C3AED;
    border-radius: 12px;
    padding: 28px 32px;
    margin: 32px 0;
    position: relative;
}

.blockquote-card .quote-icon {
    font-size: 32px;
    color: rgba(124,58,237,0.3);
    margin-bottom: 8px;
}

.blockquote-card blockquote {
    font-size: 17px;
    font-style: italic;
    color: #FFFFFF;
    line-height: 1.7;
    margin: 0;
}

/* ── SHARE BUTTONS ── */
.share-section {
    margin-top: 40px;
    padding-top: 28px;
    border-top: 1px solid rgba(255,255,255,0.06);
}

.share-label {
    font-size: 12px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 1.5px;
    color: #6B7280;
    margin-bottom: 12px;
}

.share-buttons {
    display: flex;
    gap: 10px;
}

.share-btn {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    text-decoration: none;
    font-size: 16px;
    transition: transform 0.3s, opacity 0.3s;
}

.share-btn:hover {
    transform: translateY(-2px);
    opacity: 0.9;
    color: white;
}

.share-btn.wa { background: #25D366; }
.share-btn.fb { background: #1877F2; }
.share-btn.tt { background: #1a1a2e; }

/* ── SIDEBAR ── */
.sidebar-card {
    background: #111827;
    border: 1px solid rgba(255,255,255,0.05);
    border-radius: 16px;
    padding: 24px;
    position: sticky;
    top: 100px;
}

.sidebar-title {
    font-size: 15px;
    font-weight: 700;
    color: #FFFFFF;
    margin-bottom: 20px;
    padding-bottom: 12px;
    border-bottom: 1px solid rgba(255,255,255,0.06);
}

.sidebar-item {
    display: flex;
    gap: 12px;
    margin-bottom: 16px;
    text-decoration: none;
    color: inherit;
}

.sidebar-item:last-child { margin-bottom: 0; }

.sidebar-item .thumb {
    width: 64px;
    height: 64px;
    border-radius: 10px;
    object-fit: cover;
    flex-shrink: 0;
    background: linear-gradient(135deg, #1A2035, #2A3045);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 20px;
    color: rgba(255,255,255,0.15);
}

.sidebar-item .info h4 {
    font-size: 13px;
    font-weight: 600;
    color: #FFFFFF;
    line-height: 1.4;
    margin: 0 0 4px;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
    transition: color 0.2s;
}

.sidebar-item:hover .info h4 {
    color: #3B82F6;
}

.sidebar-item .info .date {
    font-size: 11px;
    color: #6B7280;
    display: flex;
    align-items: center;
    gap: 4px;
}

.sidebar-item .info .date i { font-size: 10px; }

/* ── CAROUSEL SECTION ── */
.carousel-section {
    background: #0D1226;
    padding: 0 0 60px;
}

.carousel-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 24px;
}

.carousel-header h2 {
    font-size: 20px;
    font-weight: 700;
    color: #FFFFFF;
    margin: 0;
}

.carousel-nav {
    display: flex;
    gap: 8px;
}

.carousel-nav button {
    width: 36px;
    height: 36px;
    border-radius: 50%;
    border: 1px solid rgba(255,255,255,0.1);
    background: #111827;
    color: #9CA3AF;
    font-size: 16px;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s;
}

.carousel-nav button:hover {
    border-color: #3B82F6;
    color: #3B82F6;
    background: rgba(59,130,246,0.1);
}

.carousel-track-wrap {
    overflow: hidden;
    position: relative;
}

.carousel-track {
    display: flex;
    gap: 20px;
    overflow-x: auto;
    scroll-behavior: smooth;
    -ms-overflow-style: none;
    scrollbar-width: none;
    padding-bottom: 8px;
}

.carousel-track::-webkit-scrollbar { display: none; }

.carousel-track > * {
    flex-shrink: 0;
}

/* ── DOKUMENTASI CARD ── */
.doku-card {
    width: 280px;
    aspect-ratio: 16/10;
    border-radius: 14px;
    overflow: hidden;
    flex-shrink: 0;
}

.doku-card img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

/* ── BERITA CARD (carousel) ── */
.berita-carousel-card {
    width: 300px;
    aspect-ratio: 16/11;
    border-radius: 14px;
    overflow: hidden;
    position: relative;
    flex-shrink: 0;
    text-decoration: none;
    display: block;
    border: 1px solid rgba(255,255,255,0.05);
    transition: border-color 0.3s;
}

.berita-carousel-card:hover {
    border-color: rgba(59,130,246,0.3);
}

.berita-carousel-card img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    position: absolute;
    inset: 0;
}

.berita-carousel-card .overlay {
    position: absolute;
    inset: 0;
    background: linear-gradient(0deg, rgba(0,0,0,0.85) 0%, rgba(0,0,0,0.2) 50%, transparent 100%);
    z-index: 1;
}

.berita-carousel-card .info {
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    padding: 18px;
    z-index: 2;
}

.berita-carousel-card .info h4 {
    font-size: 14px;
    font-weight: 700;
    color: #FFFFFF;
    margin: 0 0 4px;
    line-height: 1.3;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.berita-carousel-card .info .date {
    font-size: 11px;
    color: rgba(255,255,255,0.6);
    display: flex;
    align-items: center;
    gap: 4px;
}

.berita-carousel-card .info .date i { font-size: 10px; }

/* ── BACK LINK ── */
.back-link {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    font-size: 13px;
    font-weight: 500;
    color: #9CA3AF;
    text-decoration: none;
    margin-bottom: 24px;
    transition: color 0.2s;
}

.back-link:hover { color: #3B82F6; }

@media (max-width: 992px) {
    .article-layout { grid-template-columns: 1fr; gap: 32px; }
    .hero-article { min-height: 360px; }
}

@media (max-width: 576px) {
    .hero-article { min-height: 300px; padding: 40px 0 32px; }
    .hero-article-content h1 { font-size: clamp(22px, 6vw, 30px); }
    .hero-article-meta { flex-direction: column; gap: 8px; }
    .doku-card { width: 220px; }
    .berita-carousel-card { width: 240px; }
}

</style>
@endpush

@section('content')

{{-- SECTION 1 — HERO ARTICLE --}}
<section class="hero-article">
    <div class="container" style="width:100%">
        <div class="hero-article-content">
            <span class="label-kategori">Johen News</span>
            <h1>{{ $berita->judul }}</h1>
            <div class="hero-article-meta">
                <span><i class="fas fa-calendar-alt"></i> {{ $berita->created_at->format('d M Y') }}</span>
                <span><i class="fas fa-pencil-alt"></i> Johen Gaming Team</span>
                <span><i class="fas fa-clock"></i> {{ $estBaca }} Menit Membaca</span>
            </div>
        </div>
    </div>
</section>

{{-- SECTION 2 — KONTEN ARTIKEL + SIDEBAR --}}
<section class="article-main-section">
    <div class="container">
        <a href="{{ route('berita') }}" class="back-link">
            <i class="fas fa-arrow-left"></i> Kembali ke Berita
        </a>

        <div class="article-layout">
            {{-- LEFT COLUMN — ARTIKEL --}}
            <div class="article-body-wrap">
                @if($berita->thumbnail)
                    <img src="{{ Storage::url($berita->thumbnail) }}" alt="{{ $berita->judul }}" class="featured-img">
                @else
                    <div class="featured-img-placeholder">📰</div>
                @endif

                <div class="article-body">
                    {!! $berita->isi !!}
                </div>

                {{-- Blockquote --}}
                <div class="blockquote-card">
                    <div class="quote-icon"><i class="fas fa-quote-left"></i></div>
                    <blockquote>
                        Peresmian ini menjadi tonggak awal perjalanan kami dalam membangun platform digital gaming yang aman, nyaman, dan terpercaya bagi seluruh gamer di Indonesia.
                    </blockquote>
                </div>

                {{-- Share --}}
                <div class="share-section">
                    <div class="share-label">Bagikan Artikel</div>
                    <div class="share-buttons">
                        <a href="https://wa.me/?text={{ urlencode($berita->judul . ' ' . url()->current()) }}" target="_blank" class="share-btn wa"><i class="fab fa-whatsapp"></i></a>
                        <a href="https://facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}" target="_blank" class="share-btn fb"><i class="fab fa-facebook-f"></i></a>
                        <a href="https://www.tiktok.com/" target="_blank" class="share-btn tt"><i class="fab fa-tiktok"></i></a>
                    </div>
                </div>
            </div>

            {{-- RIGHT COLUMN — SIDEBAR --}}
            <aside>
                <div class="sidebar-card">
                    <div class="sidebar-title">Berita Terbaru</div>
                    @forelse($lainnya as $l)
                    <a href="{{ route('berita.show', $l->slug) }}" class="sidebar-item">
                        @if($l->thumbnail)
                            <img src="{{ Storage::url($l->thumbnail) }}" alt="{{ $l->judul }}" class="thumb">
                        @else
                            <div class="thumb">📰</div>
                        @endif
                        <div class="info">
                            <h4>{{ $l->judul }}</h4>
                            <div class="date">
                                <i class="fas fa-calendar-alt"></i>
                                {{ $l->created_at->format('d M Y') }}
                            </div>
                        </div>
                    </a>
                    @empty
                    <p style="font-size:13px;color:#6B7280">Belum ada berita lain.</p>
                    @endforelse
                </div>
            </aside>
        </div>
    </div>
</section>

{{-- SECTION 3 — DOKUMENTASI KEGIATAN --}}
<section class="carousel-section">
    <div class="container">
        <div class="carousel-header">
            <h2>Dokumentasi Kegiatan</h2>
            <div class="carousel-nav">
                <button onclick="scrollCarousel('dokuTrack', -1)" aria-label="Sebelumnya"><i class="fas fa-chevron-left"></i></button>
                <button onclick="scrollCarousel('dokuTrack', 1)" aria-label="Selanjutnya"><i class="fas fa-chevron-right"></i></button>
            </div>
        </div>
        <div class="carousel-track-wrap">
            <div class="carousel-track" id="dokuTrack">
                <div class="doku-card"><img src="{{ asset('img/bg/bg1.jpeg') }}" alt="Dokumentasi 1"></div>
                <div class="doku-card"><img src="{{ asset('img/bg/bg2.jpeg') }}" alt="Dokumentasi 2"></div>
                <div class="doku-card"><img src="{{ asset('img/bg/bg1.jpeg') }}" alt="Dokumentasi 3"></div>
                <div class="doku-card"><img src="{{ asset('img/bg/bg2.jpeg') }}" alt="Dokumentasi 4"></div>
                <div class="doku-card"><img src="{{ asset('img/bg/bg1.jpeg') }}" alt="Dokumentasi 5"></div>
                <div class="doku-card"><img src="{{ asset('img/bg/bg2.jpeg') }}" alt="Dokumentasi 6"></div>
            </div>
        </div>
    </div>
</section>

{{-- SECTION 4 — BERITA LAINNYA --}}
<section class="carousel-section" style="padding-bottom:80px">
    <div class="container">
        <div class="carousel-header">
            <h2>Berita Lainnya</h2>
            <div class="carousel-nav">
                <button onclick="scrollCarousel('beritaCarouselTrack', -1)" aria-label="Sebelumnya"><i class="fas fa-chevron-left"></i></button>
                <button onclick="scrollCarousel('beritaCarouselTrack', 1)" aria-label="Selanjutnya"><i class="fas fa-chevron-right"></i></button>
            </div>
        </div>
        <div class="carousel-track-wrap">
            <div class="carousel-track" id="beritaCarouselTrack">
                @forelse($beritaLainnya as $bl)
                <a href="{{ route('berita.show', $bl->slug) }}" class="berita-carousel-card">
                    <img src="{{ $bl->thumbnail ? Storage::url($bl->thumbnail) : asset('img/bg/bg1.jpeg') }}" alt="{{ $bl->judul }}">
                    <div class="overlay"></div>
                    <div class="info">
                        <h4>{{ $bl->judul }}</h4>
                        <div class="date">
                            <i class="fas fa-calendar-alt"></i>
                            {{ $bl->created_at->format('d M Y') }}
                        </div>
                    </div>
                </a>
                @empty
                <p style="font-size:13px;color:#6B7280">Belum ada berita lain.</p>
                @endforelse
            </div>
        </div>
    </div>
</section>

@endsection

@push('scripts')
<script>
function scrollCarousel(id, dir) {
    const el = document.getElementById(id);
    if (!el) return;
    const w = el.children[0]?.offsetWidth + 20 || 0;
    el.scrollBy({ left: w * dir, behavior: 'smooth' });
}
</script>
@endpush
