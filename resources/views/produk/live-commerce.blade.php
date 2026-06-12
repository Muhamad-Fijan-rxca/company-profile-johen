@extends('layouts.app')
@section('title', 'Live Commerce')

@push('styles')
<style>

.page-hero-topup {
    min-height: 55vh;
    display: flex;
    align-items: center;
    position: relative;
    overflow: hidden;
    background: #020D2E;
    padding: 110px 24px 80px;
}

.page-hero-topup .hero-bg {
    position: absolute;
    inset: 0;
    z-index: 0;
    background: url('{{ asset("img/bg/bg1.jpeg") }}') center/cover no-repeat;
    opacity: 0.3;
}

.page-hero-topup::before {
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

.hero-watermark {
    position: absolute;
    right: -20px;
    top: 50%;
    transform: translateY(-50%);
    font-size: clamp(64px, 10vw, 120px);
    font-weight: 900;
    color: rgba(255,255,255,0.04);
    white-space: nowrap;
    letter-spacing: 8px;
    z-index: 0;
    pointer-events: none;
    user-select: none;
}

.hero-topup-content {
    position: relative;
    z-index: 3;
    max-width: 700px;
    padding-left: 80px;
}

.page-hero-topup .container {
    margin-left: 0;
    margin-right: 0;
    width: 100%;
}

.hero-topup-content h1 {
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

.hero-topup-content p {
    font-size: 18px;
    color: rgba(255,255,255,0.85);
    line-height: 1.8;
    margin: 0 0 20px;
    max-width: 640px;
}

.btn-topup-cta {
    position: relative;
    display: inline-flex;
    align-items: center;
    padding: 13px 28px 13px 50px;
    border: 1px solid rgba(6,104,192,0.15);
    border-radius: 100px;
    font-family: 'Poppins', sans-serif;
    font-size: 14px;
    font-weight: 600;
    color: white;
    text-decoration: none;
    background: linear-gradient(90deg, #0668C0, #7035CC, #7035CC, #0668C0);
    background-size: 200% 100%;
    background-position: 0% 0%;
    box-shadow: 0 4px 20px rgba(112,53,204,0.25);
    overflow: hidden;
    transition: padding 0.35s cubic-bezier(0.4, 0, 0.2, 1),
                background-position 0.5s ease;
}
.btn-topup-cta:hover {
    padding: 13px 50px 13px 28px;
    background-position: 100% 0%;
    color: white;
}
.btn-topup-cta .btn-icon {
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
.btn-topup-cta:hover .btn-icon {
    left: calc(100% - 35px);
    transform: translateY(-50%) rotate(45deg);
}

/* ── MAIN CONTENT ── */
.main-content-topup {
    background: #020D2E;
    padding: 60px 0;
}

.main-content-topup .container {
    max-width: 97%;
    padding: 0 80px;
}

.section-label {
    font-size: 13px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 2px;
    color: #FFFFFF;
    margin-bottom: 16px;
    display: block;
}

.tagline-center {
    text-align: center;
    margin-bottom: 48px;
}

.tagline-center h2 {
    font-size: clamp(26px, 3.5vw, 38px);
    font-weight: 800;
    line-height: 1.3;
    margin: 0;
}

.tagline-center h2 .white {
    color: #FFFFFF;
}

.tagline-center h2 .blue {
    background: linear-gradient(90deg, #0987F5, #854DEA);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

/* ── 3-COLUMN GRID ── */
.grid-3-topup {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 32px;
    margin-bottom: 80px;
}

/* ── 4-COLUMN GRID ── */
.grid-4-topup {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 32px;
    margin-bottom: 80px;
}

.card-topup {
    background: #0A1E50;
    border: 1px solid rgba(255,255,255,0.05);
    border-radius: 16px;
    padding: 44px 40px;
}

.card-topup .icon-wrap {
    width: 56px;
    height: 56px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 16px;
}
.card-topup .icon-wrap img {
    width: 52px;
    height: 52px;
    object-fit: contain;
}

.card-topup h4 {
    font-size: 16px;
    font-weight: 700;
    background: linear-gradient(90deg, #1a8cff, #7c3aed, #7c3aed);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    margin: 0 0 8px;
}

.card-topup p {
    font-size: 13px;
    color: #9CA3AF;
    line-height: 1.6;
    margin: 0;
}

/* ── STEP CARDS ── */
.step-row {
    display: flex;
    align-items: baseline;
    gap: 10px;
    margin-bottom: 12px;
}

.step-row h4 {
    margin: 0;
    font-size: 20px;
}

.step-number {
    display: inline;
    font-size: 20px;
    font-weight: 700;
    line-height: 1.2;
    background: linear-gradient(90deg, #1a8cff, #7c3aed, #7c3aed);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

.step-number::after {
    content: ' | ';
    font-size: 16px;
    font-weight: 300;
    color: white;
}

.card-topup.step {
    background: transparent;
    border: 1.5px solid #0987F5;
    padding: 36px 40px;
}

/* ── PLATFORM STRIP ── */
.platform-strip {
    background: #0A1E50;
    border: 1px solid rgba(255,255,255,0.05);
    border-radius: 16px;
    padding: 28px 32px;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 40px;
    flex-wrap: wrap;
    margin-bottom: 64px;
}

.platform-item {
    display: flex;
    align-items: center;
    gap: 12px;
}

.platform-item .plat-icon {
    width: 40px;
    height: 40px;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 20px;
    color: white;
}

.platform-item .plat-icon.ig { background: linear-gradient(135deg, #f09433, #bc1888); }
.platform-item .plat-icon.tt { background: #1a1a2e; color: #25F4EE; }
.platform-item .plat-icon.yt { background: #FF0000; }
.platform-item .plat-icon.fb { background: #1877F2; }

.platform-item .plat-info .plat-name {
    font-size: 13px;
    font-weight: 600;
    color: #FFFFFF;
    margin: 0;
}

.platform-item .plat-info .plat-user {
    font-size: 11px;
    color: #9CA3AF;
    margin: 0;
}

/* ── FAQ SECTION ── */
.faq-row {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 56px;
}

.faq-item {
    background: #0A1E50;
    border: 1px solid rgba(255,255,255,0.05);
    border-radius: 12px;
    padding: 18px 20px;
    margin-bottom: 16px;
    cursor: pointer;
    transition: border-color 0.3s;
}

.faq-item:hover {
    border-color: rgba(16,185,129,0.2);
}

.faq-question {
    display: flex;
    justify-content: space-between;
    align-items: center;
    font-size: 14px;
    font-weight: 600;
    color: #FFFFFF;
}

.faq-question .faq-arrow {
    font-size: 14px;
    color: #6B7280;
    transition: transform 0.3s;
}

.faq-item.open .faq-arrow {
    transform: rotate(180deg);
}

.faq-answer {
    max-height: 0;
    overflow: hidden;
    transition: max-height 0.3s ease, padding 0.3s ease;
    padding: 0;
    font-size: 13px;
    color: #9CA3AF;
    line-height: 1.6;
}

.faq-item.open .faq-answer {
    max-height: 200px;
    padding-top: 12px;
}

/* ── CTA CARD RIGHT ── */
.cta-card-topup {
    background: #0A1E50;
    border: 1px solid rgba(255,255,255,0.05);
    border-radius: 20px;
    padding: 10px 28px;
    display: flex;
    flex-direction: row;
    align-items: center;
    gap: 20px;
    text-align: left;
}

.cta-card-topup .topup-icon {
    flex-shrink: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    width: 140px;
    height: 140px;
}

.cta-card-topup .topup-icon img {
    width: 100%;
    height: 100%;
    object-fit: contain;
}

.cta-card-topup .cta-content {
    flex: 1;
    display: flex;
    flex-direction: column;
    gap: 8px;
}

.cta-card-topup .cta-title {
    font-size: 22px;
    font-weight: 800;
    color: #FFFFFF;
    line-height: 1.2;
    margin: 0;
}

.cta-card-topup .cta-subtitle {
    font-size: 13px;
    color: #9CA3AF;
    line-height: 1.5;
    margin: 0;
    white-space: nowrap;
}

.cta-card-topup .btn-topup-cta {
    width: 100%;
    justify-content: center;
    margin-top: 4px;
}

/* ── JADWAL CARDS ── */
.card-jadwal {
    background: #0A1E50;
    border: 1px solid rgba(255,255,255,0.05);
    border-radius: 16px;
    padding: 24px 28px;
    position: relative;
}
.card-jadwal .jadwal-header {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    margin-bottom: 12px;
}
.card-jadwal .jadwal-sesi {
    font-size: 20px;
    font-weight: 800;
    color: #FFFFFF;
}
.card-jadwal .jadwal-icon {
    position: absolute;
    top: 4px;
    right: 36px;
    width: 120px;
    height: 120px;
    pointer-events: none;
    z-index: 0;
}
.card-jadwal .jadwal-icon img {
    width: 100%;
    height: 100%;
    object-fit: contain;
}
.card-jadwal .jadwal-hari {
    font-size: 15px;
    font-weight: 400;
    color: rgba(255,255,255,0.7);
    margin-bottom: 4px;
}
.card-jadwal .jadwal-jam {
    font-size: 16px;
    font-weight: 700;
    color: #FFFFFF;
    display: flex;
    align-items: center;
    gap: 6px;
    margin-bottom: 8px;
}
.card-jadwal .jadwal-jam img {
    width: 18px;
    height: 18px;
    object-fit: contain;
    margin-left: 6px;
}
.card-jadwal .jadwal-desc {
    font-size: 13px;
    color: rgba(255,255,255,0.7);
    line-height: 1.6;
    margin: 0;
}

@media (max-width: 992px) {
    .grid-3-topup { grid-template-columns: repeat(2, 1fr); }
    .grid-4-topup { grid-template-columns: repeat(2, 1fr); }
    .faq-row { grid-template-columns: 1fr; }
    .platform-strip { gap: 20px; }
}

@media (max-width: 576px) {
    .grid-3-topup { grid-template-columns: 1fr; }
    .grid-4-topup { grid-template-columns: 1fr; }
    .hero-watermark { display: none; }
}

</style>
@endpush

@section('content')

{{-- SECTION 1 — HERO BANNER --}}
<section class="page-hero-topup">
    <div class="hero-bg"></div>
    <div class="hero-watermark">JOHEN GAMING</div>
    <div class="container">
        <div class="hero-topup-content">
            <h1>Live Commerce</h1>
            <p>Belanja lebih interaktif dan transparan melalui live streaming. Lihat langsung produk yang dijual dan bertanya secara real-time.</p>
            <a href="https://wa.me/62812347070" target="_blank" rel="noopener" class="btn-topup-cta">
                <span class="btn-icon"><img src="{{ asset('img/icon/petunjuk.png') }}" alt="→" style="width:12px;height:12px;object-fit:contain;"></span>
                Tonton Live Streaming
            </a>
        </div>
    </div>
</section>

{{-- SECTION 2 — MAIN CONTENT --}}
<section class="main-content-topup">
    <div class="container">

        {{-- 2A — TAGLINE --}}
        <div class="tagline-center">
            <h2>
                <span class="white">Pengalaman Belanja Gaming</span><br>
                <span class="blue">Lebih Interaktif & Transparan</span>
            </h2>
        </div>



        {{-- 2C — LAYANAN LIVE --}}
        <span class="section-label">Layanan Live Commerce</span>
        <div class="grid-4-topup">
            <div class="card-topup">
                <div class="icon-wrap"><img src="{{ asset('img/icon/give.png') }}" alt="Give Away"></div>
                <h4>Give Away</h4>
                <p>Ikuti live streaming dan dapatkan kesempatan memenangkan hadiah menarik seperti diamond, skin, dan akun game gratis.</p>
            </div>
            <div class="card-topup">
                <div class="icon-wrap"><img src="{{ asset('img/icon/diskon.png') }}" alt="Promo Exclusive"></div>
                <h4>Promo Exclusive</h4>
                <p>Nikmati harga spesial dan diskon eksklusif yang hanya tersedia selama sesi live berlangsung.</p>
            </div>
            <div class="card-topup">
                <div class="icon-wrap"><img src="{{ asset('img/icon/interaksi.png') }}" alt="Interaksi Langsung"></div>
                <h4>Interaksi Langsung</h4>
                <p>Bertanya langsung kepada host, lihat detail produk secara real-time, dan dapatkan rekomendasi sesuai kebutuhan.</p>
            </div>
            <div class="card-topup">
                <div class="icon-wrap"><img src="{{ asset('img/icon/sale.png') }}" alt="Flash Sale"></div>
                <h4>Flash Sale</h4>
                <p>Dapatkan penawaran flash sale dengan harga termurah untuk top up, akun, dan jasa joki selama sesi live.</p>
            </div>
        </div>

        {{-- 2D — JADWAL LIVE --}}
        <span class="section-label">Jadwal Live Streaming</span>
        <div class="grid-4-topup">
            <div class="card-jadwal">
                <div class="jadwal-header">
                    <div class="jadwal-sesi">Sesi 1</div>
                    <div class="jadwal-icon"><img src="{{ asset('img/icon/live.png') }}" alt="Live"></div>
                </div>
                <div class="jadwal-hari">Setiap Hari</div>
                <div class="jadwal-jam">07.00 - 12.00 WIB <img src="{{ asset('img/icon/tiktok.png') }}" alt="TikTok"></div>
                <p class="jadwal-desc">Live setiap hari dengan berbagai promo menarik untukmu</p>
            </div>
            <div class="card-jadwal">
                <div class="jadwal-header">
                    <div class="jadwal-sesi">Sesi 2</div>
                    <div class="jadwal-icon"><img src="{{ asset('img/icon/live.png') }}" alt="Live"></div>
                </div>
                <div class="jadwal-hari">Setiap Hari</div>
                <div class="jadwal-jam">12.00 - 17.00 WIB <img src="{{ asset('img/icon/tiktok.png') }}" alt="TikTok"></div>
                <p class="jadwal-desc">Live setiap hari dengan berbagai promo menarik untukmu</p>
            </div>
            <div class="card-jadwal">
                <div class="jadwal-header">
                    <div class="jadwal-sesi">Sesi 3</div>
                    <div class="jadwal-icon"><img src="{{ asset('img/icon/live.png') }}" alt="Live"></div>
                </div>
                <div class="jadwal-hari">Setiap Hari</div>
                <div class="jadwal-jam">17.00 - 21.00 WIB <img src="{{ asset('img/icon/tiktok.png') }}" alt="TikTok"></div>
                <p class="jadwal-desc">Live setiap hari dengan berbagai promo menarik untukmu</p>
            </div>
            <div class="card-jadwal">
                <div class="jadwal-header">
                    <div class="jadwal-sesi">Sesi 4</div>
                    <div class="jadwal-icon"><img src="{{ asset('img/icon/live.png') }}" alt="Live"></div>
                </div>
                <div class="jadwal-hari">Setiap Hari</div>
                <div class="jadwal-jam">21.00 - 23.00 WIB <img src="{{ asset('img/icon/tiktok.png') }}" alt="TikTok"></div>
                <p class="jadwal-desc">Live setiap hari dengan berbagai promo menarik untukmu</p>
            </div>
        </div>

        {{-- 2E — FAQ --}}
        <div class="faq-row">
            <div>
                <span class="section-label">FAQ</span>
                <div class="faq-item" onclick="this.classList.toggle('open')">
                    <div class="faq-question">
                        Kapan jadwal live streaming Johen Gaming?
                        <span class="faq-arrow"><i class="fas fa-chevron-down"></i></span>
                    </div>
                    <div class="faq-answer">
                        Jadwal live streaming diumumkan secara berkala melalui story Instagram dan postingan TikTok. Follow akun media sosial Johen Gaming untuk notifikasi jadwal terbaru.
                    </div>
                </div>
                <div class="faq-item" onclick="this.classList.toggle('open')">
                    <div class="faq-question">
                        Apakah bisa bertransaksi di luar sesi live?
                        <span class="faq-arrow"><i class="fas fa-chevron-down"></i></span>
                    </div>
                    <div class="faq-answer">
                        Ya, anda tetap bisa bertransaksi di luar jam live melalui WhatsApp. Live commerce adalah layanan tambahan untuk pengalaman belanja yang lebih interaktif dan transparan.
                    </div>
                </div>
                <div class="faq-item" onclick="this.classList.toggle('open')">
                    <div class="faq-question">
                        Bagaimana cara order saat live streaming?
                        <span class="faq-arrow"><i class="fas fa-chevron-down"></i></span>
                    </div>
                    <div class="faq-answer">
                        Saat live berlangsung, anda bisa menyebutkan produk yang diminati di kolom komentar atau langsung menghubungi nomor WhatsApp yang tertera di layar live untuk proses transaksi cepat.
                    </div>
                </div>
            </div>
            <div class="cta-card-topup">
                <div class="topup-icon"><img src="{{ asset('img/icon/livestream.png') }}" alt="Live"></div>
                <div class="cta-content">
                    <h3 class="cta-title">Ikuti Live Streaming</h3>
                    <p class="cta-subtitle">Jangan lewatkan sesi live seru dengan penawaran spesial dan diskon eksklusif!</p>
                    <a href="https://wa.me/62812347070" target="_blank" rel="noopener" class="btn-topup-cta">
                        Dapatkan Info Live
                    </a>
                </div>
            </div>
        </div>

    </div>
</section>

@endsection
