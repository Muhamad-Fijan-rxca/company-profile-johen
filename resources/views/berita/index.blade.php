@extends('layouts.app')
@section('title', 'Berita')

@push('styles')
<style>

.page-hero-berita {
    min-height: 55vh;
    display: flex;
    align-items: center;
    justify-content: center;
    position: relative;
    overflow: hidden;
    background: #020D2E;
    padding: 110px 24px 80px;
}
.page-hero-berita .hero-bg {
    position: absolute;
    inset: 0;
    z-index: 0;
    background: url("{{ asset('img/bg/bg1.jpeg') }}") center/cover no-repeat;
    opacity: 0.3;
}
.page-hero-berita::before {
    content: '';
    position: absolute;
    inset: 0;
    background: linear-gradient(135deg,
        rgba(1,32,60,0.85) 0%,
        rgba(5,42,72,0.75) 45%,
        rgba(10,48,80,0.80) 100%
    );
    z-index: 1;
}
.hero-berita-content {
    position: relative;
    z-index: 2;
    text-align: center;
    max-width: 720px;
}
.hero-berita-content h1 {
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
.hero-berita-content p {
    font-size: 18px;
    color: rgba(255,255,255,0.85);
    line-height: 1.8;
    max-width: 580px;
    margin: 0 auto;
    text-shadow: 0 4px 20px rgba(0,0,0,0.5), 0 0 30px rgba(0,212,255,0.1);
}

/* ── BERITA GRID ── */
.berita-section {
    background: #0D1226;
    padding: 80px 0;
}

.berita-section .container {
    max-width: 87%;
    padding: 0 80px;
}

.berita-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 48px;
}

.berita-card {
    border-radius: 16px;
    overflow: hidden;
    position: relative;
    aspect-ratio: 4/3;
    cursor: pointer;
    transition: box-shadow 0.35s ease;
    display: block;
    text-decoration: none;
}
.berita-card:hover {
    box-shadow: 0 0 0 2px rgba(0,212,255,0.5), 0 0 24px rgba(0,212,255,0.3);
}
.berita-card img {
    width: 100%; height: 100%; object-fit: cover;
    display: block;
    transition: transform 0.4s ease;
}
.berita-card:hover img { transform: scale(1.08); }
.berita-card .berita-overlay {
    position: absolute; inset: 0;
    background: linear-gradient(0deg, rgba(0,0,0,0.85) 0%, rgba(0,0,0,0.1) 60%, transparent 100%);
    pointer-events: none;
    transition: opacity 0.35s ease;
    z-index: 1;
}
.berita-card .berita-hover-top {
    position: absolute; top: 0; left: 0; right: 0; height: 55%;
    background: linear-gradient(180deg, rgba(0,0,0,0.85) 0%, transparent 100%);
    pointer-events: none;
    opacity: 0;
    transition: opacity 0.4s ease;
    z-index: 2;
}
.berita-card:hover .berita-hover-top { opacity: 1; }
.berita-card .berita-hover-bottom {
    position: absolute; bottom: 0; left: 0; right: 0; height: 70%;
    background: linear-gradient(0deg, rgba(0,100,200,1) 0%, transparent 100%);
    pointer-events: none;
    opacity: 0;
    transition: opacity 0.4s ease;
    z-index: 2;
}
.berita-card:hover .berita-overlay { opacity: 0; }
.berita-card:hover .berita-hover-top { opacity: 1; }
.berita-card:hover .berita-hover-bottom { opacity: 1; }
.berita-card .berita-info {
    position: absolute;
    bottom: 0; left: 0; right: 0;
    padding: 24px 20px 20px;
    pointer-events: none;
    z-index: 3;
}
.berita-card .berita-info h3 {
    font-size: 15px; font-weight: 700; color: white;
    margin: 0 0 6px; line-height: 1.4;
    transition: opacity 0.3s ease;
}
.berita-card:hover .berita-info h3 { opacity: 0; }
.berita-card .berita-info .berita-date {
    font-size: 12px; color: rgba(255,255,255,0.7);
    display: flex; align-items: center; gap: 6px;
}
.berita-card .berita-desc {
    position: absolute;
    top: 22%; left: 24px; right: 24px;
    font-size: 13px; color: white;
    line-height: 1.6; text-align: left;
    opacity: 0;
    transition: opacity 0.35s ease 0.1s;
    pointer-events: none;
    z-index: 3;
}
.berita-card:hover .berita-desc { opacity: 1; }

/* ── PAGINATION ── */
.pagination-wrap {
    display: flex;
    justify-content: center;
    margin-top: 56px;
    gap: 8px;
}

.pagination-wrap a,
.pagination-wrap span {
    padding: 10px 20px;
    border-radius: 10px;
    font-size: 15px;
    font-weight: 500;
    text-decoration: none;
    border: 1.5px solid rgba(255,255,255,0.08);
    color: #9CA3AF;
    transition: all 0.2s;
}

.pagination-wrap a:hover {
    border-color: #3B82F6;
    color: #3B82F6;
}

.pagination-wrap .active {
    background: linear-gradient(90deg, #0987F5, #854DEA);
    color: white;
    border-color: transparent;
}

@media (max-width: 992px) {
    .berita-grid { grid-template-columns: repeat(2, 1fr); }
}

@media (max-width: 576px) {
    .berita-grid { grid-template-columns: 1fr; }
}

</style>
@endpush

@section('content')

{{-- SECTION 1 — HERO --}}
<section class="page-hero-berita">
    <div class="hero-bg"></div>
    <div class="hero-berita-content">
        <h1>Berita</h1>
        <p>Berita terkini seputar dunia games dan update dari PT. Johen Sukses Abadi (Johen Gaming)</p>
    </div>
</section>

{{-- SECTION 2 — GRID ARTIKEL --}}
<section class="berita-section">
    <div class="container">
        @if($berita->isEmpty())
        <div style="text-align:center;padding:80px;color:#9CA3AF">
            <div style="font-size:64px;margin-bottom:16px">📰</div>
            <h3>Belum ada berita</h3>
        </div>
        @else
        <div class="berita-grid">
            @foreach($berita as $b)
            <a href="{{ route('berita.show', $b->slug) }}" class="berita-card">
                <img src="{{ $b->thumbnail ? Storage::url($b->thumbnail) : asset('img/bg/bg1.jpeg') }}" alt="{{ $b->judul }}">
                <div class="berita-overlay"></div>
                <div class="berita-hover-top"></div>
                <div class="berita-hover-bottom"></div>
                <div class="berita-info">
                    <h3>{{ $b->judul }}</h3>
                    <div class="berita-date">
                        <i class="fas fa-calendar-alt"></i>
                        {{ $b->created_at->format('d M Y') }}
                    </div>
                </div>
                <div class="berita-desc">{{ $b->ringkasan }}</div>
            </a>
            @endforeach
        </div>
        <div class="pagination-wrap">
            {{ $berita->links('vendor.pagination.simple') }}
        </div>
        @endif
    </div>
</section>

@endsection
