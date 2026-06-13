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
    background: linear-gradient(180deg, #061F59 25%, #020D2E 55%);
    position: relative;
    transition: box-shadow 0.3s ease, border-color 0.3s ease, transform 0.3s ease;
}
.partner-card::before {
    content: '';
    position: absolute;
    inset: 0;
    background: url("{{ asset('img/bg/grid.png') }}") center / cover no-repeat;
    opacity: 0.40;
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
    z-index: 3;
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
    height: 250px;
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
    height: 295px;
    opacity: 1;
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
    top: 33%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 64px;
    height: 64px;
    transition: transform 0.4s cubic-bezier(0.4, 0, 0.2, 1), filter 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    z-index: 1;
    object-fit: contain;
    filter: drop-shadow(0 0 0 transparent);
}
.partner-card:hover .card-art .badge-wrap .logo-shield {
    transform: translate(-50%, -110%) scale(1.25);
    filter: drop-shadow(0 0 18px rgba(0, 207, 255, 0.7)) drop-shadow(0 0 40px rgba(124, 58, 237, 0.4));
}
.partner-card .card-art .badge-wrap .badge-img {
    position: relative;
    z-index: 2;
    width: 250px;
    margin-top: 20px;
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
    background: #041640;
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
    color: rgba(255, 255, 255, 0.7);
    margin: 0 0 10px;
}

.partner-card .card-info .partner-followers {
    font-size: 12px;
    color: #FFFFFF;
    display: flex;
    align-items: center;
    gap: 6px;
    margin-bottom: 14px;
    padding-bottom: 14px;
    border-bottom: 1px solid rgba(30, 58, 95, 0.6);
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
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
}

.sosmed-card .card-header .icon-circle img {
    width: 100%;
    height: 100%;
    object-fit: contain;
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
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(0, 1fr));
    gap: 4px;
    padding: 0 20px 16px;
}

.sosmed-card .thumb-strip .thumb-item {
    aspect-ratio: 1 / 1;
    border-radius: 8px;
    background: linear-gradient(135deg, #1A2035, #2A3045);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 18px;
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
                @php $maxIdx = max($sosmedIg->count(), $sosmedTt->count()); @endphp
                @for($i = 0; $i < $maxIdx; $i++)
                    @if(isset($sosmedIg[$i]))
                        @php $s = $sosmedIg[$i]; @endphp
                        <div class="sosmed-card reveal" style="transition-delay:{{ ($i % 2) * 0.1 }}s">
                            <div class="card-header">
                                <div class="left">
                                    <div class="icon-circle">
                                        <img src="{{ asset('img/logo/instagramapk.png') }}" alt="Instagram">
                                    </div>
                                    <div class="account-info">
                                        <div class="name">{{ $s->name }}</div>
                                        <div class="username">{{ $s->username }}</div>
                                    </div>
                                </div>
                                <div class="right">
                                    <span class="followers-count">{{ $s->followers }}</span>
                                    <span class="followers-label">Followers</span>
                                </div>
                            </div>
                            <div class="thumb-strip">
                                @forelse($s->thumbnails ?? [] as $thumb)
                                <div class="thumb-item">
                                    @php $thumbUrl = str_starts_with($thumb, 'sosmed/') ? Storage::url($thumb) : asset($thumb); @endphp
                                    <img src="{{ $thumbUrl }}" alt="Thumbnail">
                                </div>
                                @empty
                                <div class="thumb-item" style="font-size:24px">📸</div>
                                @endforelse
                            </div>
                            <div class="card-footer-sosmed">
                                <div class="desc">{{ $s->desc }}</div>
                                <a href="{{ $s->url }}" target="_blank" rel="noopener" class="btn-follow">
                                    {{ $s->btn_text }} <i class="fas fa-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    @endif
                    @if(isset($sosmedTt[$i]))
                        @php $s = $sosmedTt[$i]; @endphp
                        <div class="sosmed-card reveal" style="transition-delay:{{ ($i % 2) * 0.1 }}s">
                            <div class="card-header">
                                <div class="left">
                                    <div class="icon-circle">
                                        <img src="{{ asset('img/logo/tiktokapk.png') }}" alt="TikTok">
                                    </div>
                                    <div class="account-info">
                                        <div class="name">{{ $s->name }}</div>
                                        <div class="username">{{ $s->username }}</div>
                                    </div>
                                </div>
                                <div class="right">
                                    <span class="followers-count">{{ $s->followers }}</span>
                                    <span class="followers-label">Followers</span>
                                </div>
                            </div>
                            <div class="thumb-strip">
                                @forelse($s->thumbnails ?? [] as $thumb)
                                <div class="thumb-item">
                                    @php $thumbUrl = str_starts_with($thumb, 'sosmed/') ? Storage::url($thumb) : asset($thumb); @endphp
                                    <img src="{{ $thumbUrl }}" alt="Thumbnail">
                                </div>
                                @empty
                                <div class="thumb-item" style="font-size:24px">🎬</div>
                                @endforelse
                            </div>
                            <div class="card-footer-sosmed">
                                <div class="desc">{{ $s->desc }}</div>
                                <a href="{{ $s->url }}" target="_blank" rel="noopener" class="btn-follow">
                                    {{ $s->btn_text }} <i class="fas fa-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    @endif
                @endfor
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
