@extends('layouts.app')
@section('title', 'Partner Kami')

@push('styles')
<style>

/* ── HERO ── */
.page-hero-partner {
    position: relative;
    min-height: 220px;
    display: flex;
    align-items: center;
    justify-content: center;
    text-align: center;
    padding: 40px 0;
    overflow: hidden;
    background: #020D2E;
}

.page-hero-partner::before {
    content: '';
    position: absolute;
    inset: 0;
    background: url("{{ asset('img/figma/hero-building.jpg') }}") center center / cover no-repeat;
    opacity: 0.25;
    z-index: 1;
}

.page-hero-partner::after {
    content: '';
    position: absolute;
    inset: 0;
    background: linear-gradient(90deg, rgba(2,13,46,0.85) 0%, rgba(2,13,46,0.7) 50%, rgba(2,13,46,0.85) 100%);
    z-index: 2;
}

.hero-partner-watermark {
    position: absolute;
    left: 50%;
    top: 50%;
    transform: translate(-50%, -50%);
    font-size: clamp(64px, 10vw, 120px);
    font-weight: 900;
    color: rgba(255,255,255,0.04);
    white-space: nowrap;
    letter-spacing: 8px;
    z-index: 0;
    pointer-events: none;
    user-select: none;
    display: flex;
    align-items: center;
    gap: 20px;
}

.hero-partner-watermark i {
    font-size: clamp(48px, 7vw, 80px);
    opacity: 0.6;
}

.hero-partner-content {
    position: relative;
    z-index: 3;
}

.hero-partner-content h1 {
    font-size: clamp(32px, 5vw, 48px);
    font-weight: 900;
    background: linear-gradient(90deg, #0987F5, #854DEA);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    margin: 0 0 12px;
}

.hero-partner-content p {
    font-size: 15px;
    color: #9CA3AF;
    line-height: 1.7;
    margin: 0 auto;
    max-width: 520px;
}

/* ── MAIN SECTION ── */
.partner-section {
    background: #0D1226;
    padding: 48px 0 80px;
}

/* ── TAB NAV ── */
.tab-nav-wrap {
    display: flex;
    gap: 12px;
    margin-bottom: 40px;
}

.tab-nav-btn {
    padding: 10px 28px;
    border-radius: 100px;
    border: 1.5px solid rgba(255,255,255,0.1);
    background: transparent;
    color: #9CA3AF;
    font-family: 'Poppins', sans-serif;
    font-size: 14px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s;
}

.tab-nav-btn:hover {
    border-color: #3B82F6;
    color: #3B82F6;
}

.tab-nav-btn.active {
    background: #3B82F6;
    border-color: #3B82F6;
    color: white;
}

/* ── HEADING ── */
.partner-heading {
    text-align: center;
    margin-bottom: 48px;
}

.partner-heading h2 {
    font-size: clamp(22px, 3vw, 32px);
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
    gap: 20px;
}

/* ── PARTNER CARD ── */
.partner-card {
    border-radius: 16px;
    overflow: hidden;
    border: 1px solid rgba(6,182,212,0.2);
    transition: border-color 0.3s, transform 0.3s;
    background: #0A0E1A;
}

.partner-card:hover {
    border-color: rgba(6,182,212,0.5);
    transform: translateY(-4px);
}

.partner-card .card-art {
    background: linear-gradient(180deg, #0D1B3E, #0A0E1A);
    padding: 28px 20px 20px;
    text-align: center;
    position: relative;
    min-height: 200px;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
}

.partner-card .card-art .brand-text {
    line-height: 1;
}

.partner-card .card-art .brand-partner {
    font-size: 28px;
    font-weight: 900;
    color: #FFFFFF;
    letter-spacing: 6px;
    display: block;
}

.partner-card .card-art .brand-johen {
    font-size: 40px;
    font-weight: 900;
    background: linear-gradient(90deg, #0987F5, #854DEA);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    letter-spacing: 4px;
    display: block;
    margin-top: -4px;
}

.partner-card .card-art .char-icon {
    font-size: 56px;
    margin-bottom: 12px;
    opacity: 0.8;
    line-height: 1;
}

.partner-card .card-info {
    background: #0A0E1A;
    padding: 18px 20px 20px;
    border-top: 1px solid rgba(6,182,212,0.1);
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
    border-radius: 100px;
    background: linear-gradient(90deg, #7C3AED, #6D28D9);
    color: white;
    font-size: 13px;
    font-weight: 600;
    text-decoration: none;
    transition: opacity 0.3s;
    border: none;
    cursor: pointer;
}

.btn-partner-detail:hover {
    opacity: 0.9;
    color: white;
}

/* ── SOSMED CARD ── */
.grid-2-sosmed {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 24px;
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
    <div class="hero-partner-watermark">
        <i class="fas fa-shield-alt"></i>
        <span>JOHEN GAMING</span>
    </div>
    <div class="container">
        <div class="hero-partner-content">
            <h1>Partner Kami</h1>
            <p>Layanan digital kreatif dari PT. Johen Sukses Abadi untuk kebutuhan gaming anda.</p>
        </div>
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
                @php
                $partners = [
                    ['name' => 'XCRORE | JOHEN GAMING', 'role' => 'PUBG Mobile Creator', 'followers' => '247.8K Followers'],
                    ['name' => 'YAKUZA | JOHEN GAMING', 'role' => 'PUBG Mobile Creator', 'followers' => '819K Followers'],
                    ['name' => 'MAS IPENN | JOHEN GAMING', 'role' => 'PUBG Mobile Creator', 'followers' => '248K Followers'],
                    ['name' => 'OXIICORE | JOHEN GAMING', 'role' => 'PUBG Mobile Creator', 'followers' => '146.5K Followers'],
                    ['name' => 'KAPTENVICTOR | JOHEN GAMING', 'role' => 'PUBG Mobile Creator', 'followers' => '563.4K Followers'],
                    ['name' => 'AS GAME | JOHEN GAMING', 'role' => 'PUBG Mobile Creator', 'followers' => '248K Followers'],
                    ['name' => 'GENSZSAMA | JOHEN GAMING', 'role' => 'PUBG Mobile Creator', 'followers' => '68.8K Followers'],
                    ['name' => 'RAVONISME | JOHEN GAMING', 'role' => 'PUBG Mobile Creator', 'followers' => '256.2K Followers'],
                ];
                @endphp

                @foreach($partners as $p)
                <div class="partner-card reveal" style="transition-delay:{{ ($loop->index % 4) * 0.08 }}s">
                    <div class="card-art">
                        <div class="char-icon">🎮</div>
                        <div class="brand-text">
                            <span class="brand-partner">PARTNER</span>
                            <span class="brand-johen">JOHEN</span>
                        </div>
                    </div>
                    <div class="card-info">
                        <div class="partner-name">{{ $p['name'] }}</div>
                        <div class="partner-role">{{ $p['role'] }}</div>
                        <div class="partner-followers">
                            <i class="fab fa-tiktok"></i>
                            {{ $p['followers'] }}
                        </div>
                        <a href="https://wa.me/62812347070" target="_blank" rel="noopener" class="btn-partner-detail">
                            Lihat Detail <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
                @endforeach
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
