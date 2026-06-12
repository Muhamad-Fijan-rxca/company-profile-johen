@extends('layouts.app')
@section('title', 'Top Up Games')

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
    max-width: 600px;
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
    margin-bottom: 12px;
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

.step-row h4 {
    display: inline;
    margin: 0;
    font-size: 20px;
    line-height: 1.2;
}

.card-topup.step {
    background: transparent;
    border: 1.5px solid #0987F5;
    padding: 36px 40px;
}

/* ── GAME STRIP ── */
.game-strip {
    background: #0A1E50;
    border-radius: 16px;
    padding: 28px 40px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 24px;
    flex-wrap: wrap;
    margin-bottom: 64px;
}
.game-strip img {
    height: 48px;
    width: auto;
    object-fit: contain;
    transition: transform 0.3s;
    filter: brightness(1.3) drop-shadow(0 0 8px rgba(255,255,255,0.1));
}
.game-strip img:hover {
    transform: translateY(-3px);
    filter: brightness(1.5) drop-shadow(0 0 12px rgba(255,255,255,0.2));
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
    .faq-row { grid-template-columns: 1fr; }
    .game-strip { flex-direction: column; align-items: flex-start; }
}

@media (max-width: 576px) {
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
            <h1>Top Up Games</h1>
            <p>Isi ulang diamond, skin, dan item game favoritmu dengan harga termurah dan proses tercepat. Banyak pilihan game populer!</p>
            <div class="mulai-label">Mulai dari</div>
            <div class="harga-besar">Rp 10.000</div>
            <a href="https://www.johengaming.com/id-id" target="_blank" rel="noopener" class="btn-topup-cta">
                <span class="btn-icon"><img src="{{ asset('img/icon/petunjuk.png') }}" alt="→" style="width:12px;height:12px;object-fit:contain;"></span>
                Top Up Sekarang
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
                <span class="white">Top Up Games by Johen Gaming</span><br>
                <span class="blue">Murah, Cepat, dan Terpercaya</span>
            </h2>
        </div>

        {{-- 2B — GAME YANG DIDUKUNG --}}
        <span class="section-label">Game yang Didukung</span>
        <div class="game-strip">
            <img src="{{ asset('img/logo/mobile-legend.png') }}" alt="Mobile Legends">
            <img src="{{ asset('img/logo/pubg.png') }}" alt="PUBG Mobile">
            <img src="{{ asset('img/logo/freefire.png') }}" alt="Free Fire">
            <img src="{{ asset('img/logo/valorant.png') }}" alt="Valorant">
            <img src="{{ asset('img/logo/roblox.png') }}" alt="Roblox">
            <img src="{{ asset('img/logo/efootball.png') }}" alt="eFootball">
        </div>

        {{-- 2C — KEUNGGULAN --}}
        <span class="section-label">Keunggulan Top Up di Johen Gaming</span>
        <div class="grid-4-topup">
            <div class="card-topup">
                <div class="icon-wrap green"><img src="{{ asset('img/icon/petir.png') }}" alt="Proses Cepat"></div>
                <h4>Proses Cepat</h4>
                <p>Top up langsung masuk dalam hitungan menit setelah pembayaran dikonfirmasi</p>
            </div>
            <div class="card-topup">
                <div class="icon-wrap blue"><img src="{{ asset('img/icon/aman.png') }}" alt="Aman"></div>
                <h4>Aman & Terpercaya</h4>
                <p>Transaksi aman dengan sistem terenkripsi dan sudah dipercaya ribuan pelanggan</p>
            </div>
            <div class="card-topup">
                <div class="icon-wrap red"><img src="{{ asset('img/icon/payy.png') }}" alt="Harga Termurah"></div>
                <h4>Harga Termurah</h4>
                <p>Harga bersaing dengan promo dan diskon spesial setiap minggunya</p>
            </div>
            <div class="card-topup">
                <div class="icon-wrap purple"><img src="{{ asset('img/icon/stikps.png') }}" alt="Customer Service"></div>
                <h4>24/7 Customer Service</h4>
                <p>CS ramah siap membantu kapan saja via WhatsApp jika ada kendala</p>
            </div>
        </div>

        {{-- 2D — CARA ORDER --}}
        <span class="section-label">Cara Melakukan Top Up</span>
        <div class="grid-4-topup">
            <div class="card-topup step">
                <div class="step-row">
                    <div class="step-number">01</div>
                    <h4>Pilih Game</h4>
                </div>
                <p>Tentukan game yang ingin di-top up dan pilih item atau jumlah diamond yang diinginkan</p>
            </div>
            <div class="card-topup step">
                <div class="step-row">
                    <div class="step-number">02</div>
                    <h4>Masukan Data</h4>
                </div>
                <p>Hubungi admin via WhatsApp dengan menyebutkan game, item, dan ID akun kamu</p>
            </div>
            <div class="card-topup step">
                <div class="step-row">
                    <div class="step-number">03</div>
                    <h4>Pembayaran</h4>
                </div>
                <p>Bayar melalui transfer bank atau e-wallet sesuai total yang sudah disepakati</p>
            </div>
            <div class="card-topup step">
                <div class="step-row">
                    <div class="step-number">04</div>
                    <h4>Berhasil</h4>
                </div>
                <p>Diamond atau item akan masuk ke akun game kamu dalam waktu singkat</p>
            </div>
        </div>

        {{-- 2E — FAQ --}}
        <div class="faq-row">
            <div>
                <span class="section-label">FAQ</span>
                <div class="faq-item" onclick="this.classList.toggle('open')">
                    <div class="faq-question">
                        Apakah top up aman untuk akun game saya?
                        <span class="faq-arrow"><i class="fas fa-chevron-down"></i></span>
                    </div>
                    <div class="faq-answer">
                        Sangat aman. Kami hanya membutuhkan ID atau username game kamu — tidak perlu memberikan password. Proses top up dilakukan melalui metode resmi yang tersedia di masing-masing game.
                    </div>
                </div>
                <div class="faq-item" onclick="this.classList.toggle('open')">
                    <div class="faq-question">
                        Berapa lama diamond masuk setelah pembayaran?
                        <span class="faq-arrow"><i class="fas fa-chevron-down"></i></span>
                    </div>
                    <div class="faq-answer">
                        Diamond/item biasanya masuk dalam 1-5 menit setelah pembayaran dikonfirmasi. Jika lebih dari 30 menit belum masuk, kamu bisa menghubungi CS kami untuk bantuan.
                    </div>
                </div>
                <div class="faq-item" onclick="this.classList.toggle('open')">
                    <div class="faq-question">
                        Apa yang harus dilakukan jika top up tidak masuk?
                        <span class="faq-arrow"><i class="fas fa-chevron-down"></i></span>
                    </div>
                    <div class="faq-answer">
                        Jika top up tidak masuk dalam waktu yang wajar, segera hubungi admin via WhatsApp dengan menyertakan bukti pembayaran. Kami akan mengecek dan menyelesaikan masalah secepat mungkin.
                    </div>
                </div>
            </div>
            <div class="cta-card-topup">
                <div class="topup-icon"><img src="{{ asset('img/icon/diamon.png') }}" alt="Diamond"></div>
                <div class="cta-content">
                    <h3 class="cta-title">Top Up Game Favoritmu</h3>
                    <p class="cta-subtitle">Harga terbaik, proses cepat, dan pembayaran lengkap.</p>
                    <a href="https://wa.me/62812347070" target="_blank" rel="noopener" class="btn-topup-cta" style="justify-content:center;padding:13px 28px;">
                        Mulai Top Up Sekarang
                    </a>
                </div>
            </div>
        </div>

    </div>
</section>

@endsection
