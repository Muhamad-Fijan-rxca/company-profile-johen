@extends('layouts.app')
@section('title', 'Partner Kami')

@push('styles')
<style>

/* ── HERO ── */
.page-hero-partner {
    min-height: 55vh;
    display: flex; align-items: center; justify-content: center;
    position: relative; overflow: hidden;
    background: #020D2E;
    padding: 110px 24px 80px;
}
.page-hero-partner::before {
    content: '';
    position: absolute; inset: 0; z-index: 1;
    background: url('{{ asset("img/bg/bg1.jpeg") }}') center/cover no-repeat;
    opacity: 0.3;
}
.page-hero-partner::after {
    content: '';
    position: absolute; inset: 0;
    background: linear-gradient(135deg,
        rgba(1,32,60,0.85) 0%,
        rgba(5,42,72,0.75) 45%,
        rgba(10,48,80,0.80) 100%
    );
    z-index: 2;
}

.hero-partner-content {
    position: relative;
    z-index: 3;
    text-align: center;
    max-width: 720px;
}

.hero-partner-content h1 {
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

.hero-partner-content p {
    font-size: 18px;
    color: rgba(255,255,255,0.85);
    line-height: 1.8;
    max-width: 580px;
    margin: 0 auto;
    text-shadow: 0 4px 20px rgba(0,0,0,0.5), 0 0 30px rgba(0,212,255,0.1);
}

/* ── MAIN SECTION ── */
.partner-section {
    background: #060b18;
    padding: 48px 0 80px;
    position: relative;
}
.partner-section::before {
    content: '';
    position: absolute;
    inset: 0;
    background-image:
        radial-gradient(rgba(30,58,95,0.4) 1px, transparent 1px);
    background-size: 24px 24px;
    pointer-events: none;
    z-index: 0;
}
.partner-section .container {
    max-width: 1320px;
    position: relative;
    z-index: 1;
}

/* ── TAB NAV ── */
.tab-nav-wrap {
    display: flex;
    gap: 12px;
    margin-bottom: 40px;
}

.tab-nav-btn {
    padding: 12px 32px;
    border-radius: 8px;
    border: 1.5px solid rgba(255,255,255,0.1);
    background: transparent;
    color: #9CA3AF;
    font-family: 'Poppins', sans-serif;
    font-size: 15px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.4s ease;
}

.tab-nav-btn:hover {
    border-color: #3B82F6;
    color: #3B82F6;
}

.tab-nav-btn.active {
    background: linear-gradient(90deg, #0668C0, #7035CC, #7035CC, #0668C0);
    background-size: 200% 100%;
    background-position: 0% 0%;
    border: none;
    color: white;
    transition: all 0.4s ease;
}

/* ── HEADING ── */
.partner-heading {
    text-align: center;
    margin-bottom: 48px;
}

.partner-heading h2 {
    font-size: clamp(26px, 3.5vw, 38px);
    font-weight: 800;
    line-height: 1.3;
    margin: 0;
}

.partner-heading h2 .white {
    color: #FFFFFF;
}

.partner-heading h2 .blue {
    background: linear-gradient(90deg, #0987F5, #854DEA);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

/* ── PARTNER GRID (default active) ── */
.partner-tab-content {
    display: none;
}

.partner-tab-content.active {
    display: block;
}

.partner-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 24px;
}

/* ── PARTNER CARD ── */
.partner-card {
    border-radius: 16px;
    overflow: hidden;
    border: 1px solid #1e3a5f;
    background: linear-gradient(180deg, #061F59, #020D2E);
    position: relative;
    transition: box-shadow 0.3s ease, border-color 0.3s ease, transform 0.3s ease;
}
.partner-card::before {
    content: '';
    position: absolute;
    inset: 0;
    background: url("{{ asset('img/bg/grid.png') }}") center / cover no-repeat;
    opacity: 0.15;
    pointer-events: none;
    z-index: 0;
}
.partner-card:hover {
    box-shadow: 0 0 20px #00cfff, 0 0 40px #7b3fe4;
    border-color: #00cfff;
    transform: translateY(-4px);
}

/* ── ART / ILUSTRASI ── */
.partner-card .card-art {
    position: relative;
    z-index: 1;
    min-height: 260px;
    background: transparent;
    display: flex;
    align-items: flex-end;
    justify-content: center;
    padding: 0 0 16px;
    overflow: hidden;
}
.partner-card .card-art .card-overlay-top {
    position: absolute;
    top: 0; left: 0; right: 0;
    height: 50%;
    background: linear-gradient(180deg, rgba(6,31,89,0.9) 0%, rgba(6,31,89,0.3) 50%, transparent 100%);
    z-index: 2;
    pointer-events: none;
    transition: opacity 0.35s ease;
}
.partner-card .card-art .card-overlay-bottom {
    position: absolute;
    bottom: 0; left: 0; right: 0;
    height: 55%;
    background: linear-gradient(0deg, rgba(6,31,89,0.85) 0%, rgba(6,31,89,0.2) 50%, transparent 100%);
    z-index: 2;
    pointer-events: none;
    transition: opacity 0.35s ease;
}
.partner-card:hover .card-art .card-overlay-top {
    opacity: 0.6;
}
.partner-card:hover .card-art .card-overlay-bottom {
    opacity: 0.6;
}

.partner-card .card-art .char-illustration {
    position: absolute;
    inset: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0;
}
.partner-card .card-art .char-illustration .char-img {
    width: auto;
    height: 220px;
    object-fit: contain;
    object-position: center bottom;
    opacity: 0.85;
    margin: 0;
    display: block;
    margin-top: 40px;
    position: relative;
}
.partner-card .card-art .char-illustration .char-img:first-child {
    margin-right: -60px;
    z-index: 1;
}
.partner-card .card-art .char-illustration .char-img:last-child {
    z-index: 2;
}
.partner-card .card-art .char-placeholder {
    width: 100%;
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 64px;
    opacity: 0.3;
    background: radial-gradient(ellipse at 50% 100%, rgba(0,207,255,0.08) 0%, transparent 70%);
}

/* ── BADGE OVERLAY ── */
.partner-card .card-art .badge-wrap {
    position: relative;
    z-index: 3;
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 0;
}
.partner-card .card-art .badge-wrap .logo-shield {
    position: absolute;
    bottom: 100%;
    left: 50%;
    transform: translateX(-50%) translateY(0);
    width: 48px;
    height: 48px;
    transition: transform 0.3s ease;
    z-index: 1;
    margin-bottom: 4px;
    object-fit: contain;
}
.partner-card:hover .card-art .badge-wrap .logo-shield {
    transform: translateX(-50%) translateY(-16px);
}
.partner-card .card-art .badge-wrap .badge-img {
    position: relative;
    z-index: 2;
    width: 160px;
    height: auto;
    object-fit: contain;
    display: block;
    transition: filter 0.3s ease;
}
.partner-card:hover .card-art .badge-wrap .badge-img {
    filter: brightness(1.2) drop-shadow(0 0 12px rgba(0,207,255,0.5));
}

/* ── CARD INFO ── */
.partner-card .card-info {
    position: relative;
    z-index: 1;
    padding: 16px 20px 20px;
    border-top: 1px solid rgba(30,58,95,0.5);
}

.partner-card .card-info .partner-name {
    font-size: 13px;
    font-weight: 700;
    color: #FFFFFF;
    margin: 0 0 2px;
    line-height: 1.3;
}

.partner-card .card-info .partner-role {
    font-size: 11px;
    color: #6B7280;
    margin: 0 0 10px;
}

.partner-card .card-info .partner-followers {
    font-size: 12px;
    color: #FFFFFF;
    display: flex;
    align-items: center;
    gap: 6px;
    margin-bottom: 14px;
}

.partner-card .card-info .partner-followers i {
    font-size: 14px;
    color: #FFFFFF;
}

.btn-partner-detail {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 6px;
    width: 100%;
    padding: 10px 0;
    border-radius: 8px;
    background: linear-gradient(to right, #7b3fe4, #3b82f6);
    color: white;
    font-size: 13px;
    font-weight: 700;
    text-decoration: none;
    transition: opacity 0.3s, box-shadow 0.3s;
    border: none;
    cursor: pointer;
}

.btn-partner-detail:hover {
    opacity: 0.92;
    box-shadow: 0 0 12px rgba(59,130,246,0.4);
    color: white;
}

/* ── SOSMED CARD ── */
.grid-2-sosmed {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 28px;
}

.sosmed-card {
    background: #111827;
    border: 1px solid rgba(6,182,212,0.12);
    border-radius: 16px;
    overflow: hidden;
    transition: border-color 0.3s, transform 0.3s;
}

.sosmed-card:hover {
    border-color: rgba(6,182,212,0.3);
    transform: translateY(-4px);
}

.sosmed-card .card-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 20px 20px 16px;
}

.sosmed-card .card-header .left {
    display: flex;
    align-items: center;
    gap: 12px;
}

.sosmed-card .card-header .icon-circle {
    width: 44px;
    height: 44px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 20px;
    color: white;
    flex-shrink: 0;
}

.sosmed-card .card-header .icon-circle.ig {
    background: linear-gradient(135deg, #f09433, #e6683c, #dc2743, #cc2366, #bc1888);
}

.sosmed-card .card-header .icon-circle.tt {
    background: #1a1a2e;
    color: #25F4EE;
}

.sosmed-card .card-header .account-info .name {
    font-size: 14px;
    font-weight: 700;
    color: #FFFFFF;
    margin: 0;
    line-height: 1.2;
}

.sosmed-card .card-header .account-info .username {
    font-size: 11px;
    color: #6B7280;
    margin: 0;
}

.sosmed-card .card-header .right {
    text-align: right;
}

.sosmed-card .card-header .right .followers-count {
    font-size: 22px;
    font-weight: 900;
    color: #FFFFFF;
    line-height: 1;
    display: block;
}

.sosmed-card .card-header .right .followers-label {
    font-size: 10px;
    color: #6B7280;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.sosmed-card .thumb-strip {
    display: flex;
    gap: 4px;
    padding: 0 20px 16px;
    overflow-x: auto;
    -ms-overflow-style: none;
    scrollbar-width: none;
}

.sosmed-card .thumb-strip::-webkit-scrollbar { display: none; }

.sosmed-card .thumb-strip .thumb-item {
    width: 72px;
    height: 72px;
    border-radius: 8px;
    flex-shrink: 0;
    background: linear-gradient(135deg, #1A2035, #2A3045);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 18px;
    object-fit: cover;
    overflow: hidden;
}

.sosmed-card .thumb-strip .thumb-item img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.sosmed-card .card-footer-sosmed {
    padding: 0 20px 20px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 16px;
}

.sosmed-card .card-footer-sosmed .desc {
    font-size: 12px;
    color: #6B7280;
    line-height: 1.5;
    flex: 1;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.btn-follow {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 10px 22px;
    border-radius: 100px;
    background: #3B82F6;
    color: white;
    font-size: 13px;
    font-weight: 600;
    text-decoration: none;
    white-space: nowrap;
    transition: background 0.3s;
    flex-shrink: 0;
}

.btn-follow:hover {
    background: #2563EB;
    color: white;
}

.empty-state {
    text-align: center;
    padding: 80px 24px;
    color: #9CA3AF;
}

.empty-state .icon { font-size: 64px; margin-bottom: 16px; }

@media (max-width: 992px) {
    .partner-grid { grid-template-columns: repeat(2, 1fr); }
    .grid-2-sosmed { grid-template-columns: 1fr; }
}

@media (max-width: 576px) {
    .partner-grid { grid-template-columns: 1fr; }
    .grid-2-sosmed { grid-template-columns: 1fr; }
    .tab-nav-wrap { flex-direction: column; }
    .sosmed-card .card-footer-sosmed { flex-direction: column; align-items: stretch; }
    .btn-follow { justify-content: center; }
}

</style>
@endpush

@section('content')

{{-- SECTION 1 — HERO --}}
<section class="page-hero-partner">
    <div class="hero-partner-content">
        <h1>Partner Kami</h1>
        <p>Layanan digital kreatif dari PT. Johen Sukses Abadi untuk kebutuhan gaming anda.</p>
    </div>
</section>

{{-- SECTION 2 — CONTENT --}}
<section class="partner-section">
    <div class="container">

        {{-- 2A — TAB NAV --}}
        <div class="tab-nav-wrap">
            <button class="tab-nav-btn active" onclick="switchPartnerTab('partner')">Partner Johen</button>
            <button class="tab-nav-btn" onclick="switchPartnerTab('konten')">Konten Digital</button>
        </div>

        {{-- 2B — PARTNER TAB (default active) --}}
        <div class="partner-tab-content active" id="tabPartner">

            <div class="partner-heading">
                <h2>
                    <span class="white">Ikuti Aktivitas Kami di</span><br>
                    <span class="blue">Berbagai Platform Digital</span>
                </h2>
            </div>

            {{-- 2C — GRID PARTNER --}}
            <div class="partner-grid">
                @forelse($partners as $p)
                <div class="partner-card reveal" style="transition-delay:{{ ($loop->index % 4) * 0.08 }}s">
                    <div class="card-art">
                        <div class="card-overlay-top"></div>
                        <div class="card-overlay-bottom"></div>
                        <div class="char-illustration">
                            @if($p->mascot_influencer)
                                @php $mascotUrl = str_starts_with($p->mascot_influencer, 'maskot/') ? Storage::url($p->mascot_influencer) : asset($p->mascot_influencer); @endphp
                                <img src="{{ $mascotUrl }}" alt="{{ $p->judul }}" class="char-img">
                            @else
                                <div class="char-placeholder">🎮</div>
                            @endif
                            <img src="{{ asset('img/maskot/maskotjohen.png') }}" alt="Johen" class="char-img">
                        </div>
                        <div class="badge-wrap">
                            <img src="{{ asset('img/logo/logo_web.png') }}" alt="Johen" class="logo-shield">
                            <img src="{{ asset('img/icon/partner.png') }}" alt="Partner Johen" class="badge-img">
                        </div>
                    </div>
                    <div class="card-info">
                        <div class="partner-name">{{ $p->judul }}</div>
                        <div class="partner-role">{{ $p->role }}</div>
                        <div class="partner-followers">
                            <i class="fab fa-tiktok"></i>
                            {{ $p->followers }}
                        </div>
                        <a href="https://wa.me/62812347070" target="_blank" rel="noopener" class="btn-partner-detail">
                            Lihat Detail <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
                @empty
                <div class="empty-state" style="grid-column:1/-1">
                    <div class="icon">🤝</div>
                    <p>Belum ada partner.</p>
                </div>
                @endforelse
            </div>
        </div>

        {{-- KONTEN DIGITAL TAB --}}
        <div class="partner-tab-content" id="tabKonten">

            <div class="partner-heading">
                <h2>
                    <span class="white">Ikuti Aktivitas Kami di</span><br>
                    <span class="blue">Berbagai Platform Digital</span>
                </h2>
            </div>

            <div class="grid-2-sosmed">
                @php
                $sosmed = [
                    [
                        'platform' => 'ig',
                        'name' => 'JOHEN GAMING OFFICIAL',
                        'username' => '@johengaming.id',
                        'followers' => '124K',
                        'thumbnails' => ['🎮','📱','🎯','🔥','👑'],
                        'desc' => 'Konten seru seputar gaming, top up, joki, dan giveaway menarik! Follow sekarang biar gak ketinggalan info terbaru.',
                        'url' => 'https://www.instagram.com/johengaming.id/',
                        'btn' => 'Follow Instagram',
                    ],
                    [
                        'platform' => 'tt',
                        'name' => 'JOHEN GAMING OFFLINE',
                        'username' => '@johengaming.offline_',
                        'followers' => '113.2K',
                        'thumbnails' => ['🎬','🎪','🎯','🔥','💎'],
                        'desc' => 'Konten seru seputar gaming, top up, joki, dan giveaway menarik! Follow sekarang biar gak ketinggalan info terbaru.',
                        'url' => 'https://www.tiktok.com/@johengaming.offline_',
                        'btn' => 'Follow TikTok',
                    ],
                    [
                        'platform' => 'ig',
                        'name' => 'JOHEN GAMING OFFICIAL',
                        'username' => '@johengaming.id',
                        'followers' => '124K',
                        'thumbnails' => ['🎮','📱','🎯','🔥','👑'],
                        'desc' => 'Konten seru seputar gaming, top up, joki, dan giveaway menarik! Follow sekarang biar gak ketinggalan info terbaru.',
                        'url' => 'https://www.instagram.com/johengaming.id/',
                        'btn' => 'Follow Instagram',
                    ],
                    [
                        'platform' => 'tt',
                        'name' => 'JOHEN GAMING | PUBG #1 🎮',
                        'username' => '@johenofficial',
                        'followers' => '246.2K',
                        'thumbnails' => ['🎯','🔥','👑','💎','🎪'],
                        'desc' => 'Konten seru seputar gaming, top up, joki, dan giveaway menarik! Follow sekarang biar gak ketinggalan info terbaru.',
                        'url' => 'https://www.tiktok.com/@johenofficial',
                        'btn' => 'Follow TikTok',
                    ],
                ];
                @endphp

                @foreach($sosmed as $s)
                <div class="sosmed-card reveal" style="transition-delay:{{ ($loop->index % 2) * 0.1 }}s">
                    <div class="card-header">
                        <div class="left">
                            <div class="icon-circle {{ $s['platform'] }}">
                                <i class="fab fa-{{ $s['platform'] == 'ig' ? 'instagram' : 'tiktok' }}"></i>
                            </div>
                            <div class="account-info">
                                <div class="name">{{ $s['name'] }}</div>
                                <div class="username">{{ $s['username'] }}</div>
                            </div>
                        </div>
                        <div class="right">
                            <span class="followers-count">{{ $s['followers'] }}</span>
                            <span class="followers-label">Followers</span>
                        </div>
                    </div>
                    <div class="thumb-strip">
                        @foreach($s['thumbnails'] as $thumb)
                        <div class="thumb-item">{{ $thumb }}</div>
                        @endforeach
                    </div>
                    <div class="card-footer-sosmed">
                        <div class="desc">{{ $s['desc'] }}</div>
                        <a href="{{ $s['url'] }}" target="_blank" rel="noopener" class="btn-follow">
                            {{ $s['btn'] }} <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

    </div>
</section>

@endsection

@push('scripts')
<script>
function switchPartnerTab(tab) {
    document.querySelectorAll('.tab-nav-btn').forEach(b => b.classList.remove('active'));
    document.querySelectorAll('.partner-tab-content').forEach(s => s.classList.remove('active'));
    document.querySelector(`.tab-nav-btn[onclick*="'${tab}'"]`).classList.add('active');
    document.getElementById('tab' + tab.charAt(0).toUpperCase() + tab.slice(1)).classList.add('active');
}
</script>
@endpush
