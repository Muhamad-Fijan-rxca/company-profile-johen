@extends('layouts.app')
@section('title', 'Jual Beli Akun Game')

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

.hero-topup-content .mulai-label {
    font-size: 12px;
    color: #FFFFFF;
    text-transform: uppercase;
    letter-spacing: 1px;
    margin-bottom: 2px;
}

.hero-topup-content .harga-besar {
    font-size: clamp(24px, 3vw, 36px);
    font-weight: 600;
    background: linear-gradient(90deg, #1a8cff, #7c3aed, #7c3aed);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    margin: 0 0 20px;
}

.btn-topup-cta {
    position: relative;
    display: inline-flex;
    align-items: center;
    padding: 13px 28px;
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
    justify-content: center;
}
.btn-topup-cta:hover {
    background-position: 100% 0%;
    color: white;
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

/* ── GAME STRIP ── */
.game-strip {
    background: #0A1E50;
    border: 1px solid rgba(255,255,255,0.05);
    border-radius: 16px;
    padding: 28px 32px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 16px;
    flex-wrap: wrap;
    margin-bottom: 64px;
}

.game-item {
    display: flex;
    flex-direction: column;
    align-items: center;
    text-align: center;
    gap: 4px;
    flex: 1;
    min-width: 80px;
}

.game-item img {
    height: 36px;
    width: auto;
    object-fit: contain;
    margin-bottom: 12px;
    filter: brightness(1.3) drop-shadow(0 0 8px rgba(255,255,255,0.1));
}

.game-item h4 {
    font-size: 14px;
    font-weight: 600;
    color: #FFFFFF;
    margin: 0;
}

.game-item .game-count {
    font-size: 12px;
    color: #0987F5;
}

/* ── ALUR TRANSAKSI (step cards) ── */
.alur-row {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 32px;
    margin-bottom: 80px;
}

.alur-card {
    background: transparent;
    border: 1.5px solid #0987F5;
    border-radius: 16px;
    padding: 36px 40px;
}

.alur-card .alur-num {
    display: inline;
    font-size: 20px;
    font-weight: 700;
    line-height: 1.2;
    background: linear-gradient(90deg, #1a8cff, #7c3aed, #7c3aed);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

.alur-card .alur-num::after {
    content: ' | ';
    font-size: 16px;
    font-weight: 300;
    color: white;
}

.alur-card h4 {
    display: inline;
    margin: 0;
    font-size: 20px;
    font-weight: 700;
    background: linear-gradient(90deg, #1a8cff, #7c3aed, #7c3aed);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

.alur-card p {
    font-size: 13px;
    color: #9CA3AF;
    line-height: 1.6;
    margin: 12px 0 0;
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
    width: 100px;
    height: 100px;
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

@media (max-width: 992px) {
    .grid-4-topup { grid-template-columns: repeat(2, 1fr); }
    .game-strip { flex-direction: column; align-items: flex-start; }
    .alur-row { grid-template-columns: repeat(2, 1fr); }
    .faq-row { grid-template-columns: 1fr; }
}

@media (max-width: 576px) {
    .grid-4-topup { grid-template-columns: 1fr; }
    .grid-game { grid-template-columns: 1fr; }
    .alur-row { grid-template-columns: 1fr; }
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
            <h1>Jual Beli Akun Game</h1>
            <p>Platform jual beli akun game online terpercaya. Proses cepat, aman, dan transparan dengan harga terbaik.</p>
            <div class="mulai-label">Mulai dari</div>
            <div class="harga-besar">Rp 100.000</div>
            <a href="https://wa.me/62812347070" target="_blank" rel="noopener" class="btn-topup-cta">
                Lihat Akun Tersedia
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
                <span class="white">Jual Beli Akun Game Online</span><br>
                <span class="blue">Aman, Cepat, dan Terpercaya</span>
            </h2>
        </div>

        {{-- 2B — GAME YANG DIDUKUNG --}}
        <span class="section-label">Game yang Tersedia</span>
        <div class="game-strip">
            <div class="game-item">
                <img src="{{ asset('img/logo/mobile-legend.png') }}" alt="Mobile Legends">
                <h4>Mobile Legends</h4>
                <span class="game-count">120+ akun</span>
            </div>
            <div class="game-item">
                <img src="{{ asset('img/logo/pubg.png') }}" alt="PUBG">
                <h4>PUBG Mobile</h4>
                <span class="game-count">80+ akun</span>
            </div>
            <div class="game-item">
                <img src="{{ asset('img/logo/freefire.png') }}" alt="Free Fire">
                <h4>Free Fire</h4>
                <span class="game-count">95+ akun</span>
            </div>
            <div class="game-item">
                <img src="{{ asset('img/logo/valorant.png') }}" alt="Valorant">
                <h4>Valorant</h4>
                <span class="game-count">60+ akun</span>
            </div>
            <div class="game-item">
                <img src="{{ asset('img/logo/roblox.png') }}" alt="Roblox">
                <h4>Roblox</h4>
                <span class="game-count">70+ akun</span>
            </div>
            <div class="game-item">
                <img src="{{ asset('img/logo/efootball.png') }}" alt="eFootball">
                <h4>eFootball</h4>
                <span class="game-count">40+ akun</span>
            </div>
        </div>

        {{-- 2C — KEUNGGULAN --}}
        <span class="section-label">Keunggulan Jual Beli Akun di Johen Gaming</span>
        <div class="grid-4-topup">
            <div class="card-topup">
                <div class="icon-wrap"><img src="{{ asset('img/icon/aman.png') }}" alt="Terpercaya"></div>
                <h4>Terpercaya</h4>
                <p>Platform jual beli akun game resmi dengan kantor operasional fisik dan legalitas perusahaan</p>
            </div>
            <div class="card-topup">
                <div class="icon-wrap"><img src="{{ asset('img/icon/petir.png') }}" alt="Proses Cepat"></div>
                <h4>Proses Cepat</h4>
                <p>Transaksi jual beli akun diproses dalam hitungan menit setelah pembayaran diverifikasi</p>
            </div>
            <div class="card-topup">
                <div class="icon-wrap"><img src="{{ asset('img/icon/stikps.png') }}" alt="Akun Terverifikasi"></div>
                <h4>Akun Terverifikasi</h4>
                <p>Setiap akun telah melalui proses verifikasi untuk memastikan keaslian data dan keamanannya</p>
            </div>
            <div class="card-topup">
                <div class="icon-wrap"><img src="{{ asset('img/icon/cs2.png') }}" alt="Garansi Aman"></div>
                <h4>Garansi Aman</h4>
                <p>Garansi keamanan transaksi dengan sistem escrow — dana aman sampai akun diterima pembeli</p>
            </div>
        </div>

        {{-- 2D — ALUR TRANSAKSI --}}
        <span class="section-label">Alur Transaksi Jual Beli Akun</span>
        <div class="alur-row">
            <div class="alur-card">
                <span class="alur-num">01</span>
                <h4>Pilih Akun</h4>
                <p>Telusuri daftar akun game yang tersedia dan pilih sesuai kebutuhanmu</p>
            </div>
            <div class="alur-card">
                <span class="alur-num">02</span>
                <h4>Negosiasi</h4>
                <p>Hubungi admin untuk negosiasi harga dan konsultasi detail akun</p>
            </div>
            <div class="alur-card">
                <span class="alur-num">03</span>
                <h4>Pembayaran</h4>
                <p>Lakukan pembayaran melalui metode transfer atau e-wallet yang tersedia</p>
            </div>
            <div class="alur-card">
                <span class="alur-num">04</span>
                <h4>Akun Diterima</h4>
                <p>Data akun dikirimkan setelah pembayaran dikonfirmasi dan diverifikasi</p>
            </div>
        </div>

        {{-- 2E — TIPS AMAN --}}
        <span class="section-label">Tips Aman Jual Beli Akun</span>
        <div class="grid-4-topup" style="margin-bottom:80px">
            <div class="card-topup">
                <div class="icon-wrap"><img src="{{ asset('img/icon/petir.png') }}" alt="Cek Reputasi"></div>
                <h4>Cek Reputasi</h4>
                <p>Pastikan platform memiliki track record dan testimoni positif dari pembeli sebelumnya</p>
            </div>
            <div class="card-topup">
                <div class="icon-wrap"><img src="{{ asset('img/icon/aman.png') }}" alt="Verifikasi Akun"></div>
                <h4>Verifikasi Akun</h4>
                <p>Minta screenshot atau video bukti kepemilikan akun sebelum melakukan transaksi</p>
            </div>
            <div class="card-topup">
                <div class="icon-wrap"><img src="{{ asset('img/icon/cs2.png') }}" alt="Platform Resmi"></div>
                <h4>Platform Resmi</h4>
                <p>Bertransaksilah melalui perusahaan resmi yang memiliki kantor operasional fisik</p>
            </div>
            <div class="card-topup">
                <div class="icon-wrap"><img src="{{ asset('img/icon/stikps.png') }}" alt="Dokumentasi"></div>
                <h4>Dokumentasi</h4>
                <p>Simpan bukti transaksi dan komunikasi sebagai dokumentasi jika terjadi masalah</p>
            </div>
        </div>

        {{-- 2F — FAQ --}}
        <div class="faq-row">
            <div>
                <span class="section-label">FAQ</span>
                <div class="faq-item" onclick="this.classList.toggle('open')">
                    <div class="faq-question">
                        Bagaimana cara menjual akun game saya?
                        <span class="faq-arrow"><i class="fas fa-chevron-down"></i></span>
                    </div>
                    <div class="faq-answer">
                        Hubungi admin kami via WhatsApp dengan menyertakan detail akun yang ingin dijual (game, rank, skin, screenshot). Tim kami akan melakukan verifikasi dan membantu proses penjualan.
                    </div>
                </div>
                <div class="faq-item" onclick="this.classList.toggle('open')">
                    <div class="faq-question">
                        Apakah aman membeli akun di Johen Gaming?
                        <span class="faq-arrow"><i class="fas fa-chevron-down"></i></span>
                    </div>
                    <div class="faq-answer">
                        Sangat aman. Johen Gaming adalah perusahaan resmi dengan kantor operasional fisik. Setiap transaksi menggunakan sistem escrow dan akun telah diverifikasi sebelum dijual.
                    </div>
                </div>
                <div class="faq-item" onclick="this.classList.toggle('open')">
                    <div class="faq-question">
                        Apa yang terjadi jika akun yang dibeli tidak sesuai?
                        <span class="faq-arrow"><i class="fas fa-chevron-down"></i></span>
                    </div>
                    <div class="faq-answer">
                        Kami memberikan garansi kepuasan. Jika akun yang diterima tidak sesuai dengan deskripsi, anda berhak mendapatkan refund penuh atau akun pengganti yang setara.
                    </div>
                </div>
            </div>
            <div class="cta-card-topup">
                <div class="topup-icon"><img src="{{ asset('img/rank/ml/5imo.png') }}" alt="Akun"></div>
                <div class="cta-content">
                    <h3 class="cta-title">Jual Beli Akun Sekarang</h3>
                    <p class="cta-subtitle">Dapatkan akun game impianmu dengan harga terbaik dan proses terpercaya.</p>
                    <a href="https://wa.me/62812347070" target="_blank" rel="noopener" class="btn-topup-cta">
                        Hubungi Admin
                    </a>
                </div>
            </div>
        </div>

    </div>
</section>

@endsection
