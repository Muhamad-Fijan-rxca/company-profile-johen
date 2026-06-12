@extends('layouts.app')
@section('title', 'Jasa Joki Mobile Legends')

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

/* ── RANK CARDS ── */
.grid-rank {
    display: grid;
    grid-template-columns: repeat(5, 1fr);
    gap: 28px;
    margin-bottom: 64px;
}

.card-rank {
    background: #0A1E50;
    border: 1px solid rgba(255,255,255,0.05);
    border-radius: 16px;
    padding: 44px 28px;
    text-align: left;
    width: 85%;
    justify-self: center;
    margin: 0 auto;
}

.card-rank .rank-icon {
    width: 110px;
    height: 110px;
    margin: 0 auto 14px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.card-rank .rank-icon img {
    width: 100%;
    height: 100%;
    object-fit: contain;
}

.card-rank h4 {
    font-size: 17px;
    font-weight: 500;
    color: #FFFFFF;
    margin: 0 0 12px;
}

.card-rank .mulai-label {
    font-size: 12px;
    color: #9CA3AF;
    margin-bottom: 4px;
}

.card-rank .rank-harga {
    font-size: 26px;
    font-weight: 700;
    background: linear-gradient(90deg, #1a8cff, #7c3aed);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
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
    .grid-rank { grid-template-columns: repeat(3, 1fr); }
    .faq-row { grid-template-columns: 1fr; }
    .game-strip { flex-direction: column; align-items: flex-start; }
}

@media (max-width: 576px) {
    .grid-4-topup { grid-template-columns: 1fr; }
    .grid-rank { grid-template-columns: 1fr; }
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
            <h1>Joki Mobile Legends</h1>
            <p>Naikkan rank Mobile Legends-mu dengan bantuan joki profesional dan terpercaya. Proses cepat, aman, dan pasti naik.</p>
            <div class="mulai-label">Mulai dari</div>
            <div class="harga-besar">Rp 50.000</div>
            <a href="https://wa.me/62812347070" target="_blank" rel="noopener" class="btn-topup-cta">
                <span class="btn-icon"><img src="{{ asset('img/icon/petunjuk.png') }}" alt="→" style="width:12px;height:12px;object-fit:contain;"></span>
                Pesan Joki Sekarang
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
                <span class="white">Joki Mobile Legends by Johen Gaming</span><br>
                <span class="blue">Rank Aman, Cepat, dan Terpercaya</span>
            </h2>
        </div>

        {{-- 2B — PILIH RANK --}}
        <span class="section-label">Pilih Rank Tujuan</span>
        <div class="grid-rank">
            <div class="card-rank">
                <div class="rank-icon"><img src="{{ asset('img/rank/ml/1epik.png') }}" alt="Epic"></div>
                <h4>Epic</h4>
                <div class="mulai-label">Mulai dari</div>
                <div class="rank-harga">50.000</div>
            </div>
            <div class="card-rank">
                <div class="rank-icon"><img src="{{ asset('img/rank/ml/2grm.png') }}" alt="Grandmaster"></div>
                <h4>Epic - Grandmaster</h4>
                <div class="mulai-label">Mulai dari</div>
                <div class="rank-harga">75.000</div>
            </div>
            <div class="card-rank">
                <div class="rank-icon"><img src="{{ asset('img/rank/ml/3mytik.png') }}" alt="Mythic"></div>
                <h4>Grandmaster - Mythic</h4>
                <div class="mulai-label">Mulai dari</div>   
                <div class="rank-harga">100.000</div>
            </div>
            <div class="card-rank">
                <div class="rank-icon"><img src="{{ asset('img/rank/ml/4honor.png') }}" alt="Honor"></div>
                <h4>Mythic - Honor</h4>
                <div class="mulai-label">Mulai dari</div>
                <div class="rank-harga">150.000</div>
            </div>
            <div class="card-rank">
                <div class="rank-icon"><img src="{{ asset('img/rank/ml/5imo.png') }}" alt="Immortal"></div>
                <h4>Honor - Immortal</h4>
                <div class="mulai-label">Mulai dari</div>
                <div class="rank-harga">200.000</div>
            </div>
        </div>

        {{-- 2C — KEUNGGULAN --}}
        <span class="section-label">Keunggulan Jasa Joki Kami</span>
        <div class="grid-4-topup">
            <div class="card-topup">
                <div class="icon-wrap"><img src="{{ asset('img/icon/user.png') }}" alt="Berpengalaman"></div>
                <h4>Berpengalaman</h4>
                <p>Tim joki profesional dengan pengalaman ribuan match di berbagai rank</p>
            </div>
            <div class="card-topup">
                <div class="icon-wrap"><img src="{{ asset('img/icon/aman.png') }}" alt="Garansi Keamanan"></div>
                <h4>Garansi Keamanan</h4>
                <p>Akun anda aman dengan sistem anti-detection dan mode duo/trio</p>
            </div>
            <div class="card-topup">
                <div class="icon-wrap"><img src="{{ asset('img/icon/eye.png') }}" alt="Tracking Joki"></div>
                <h4>Tracking Joki</h4>
                <p>Pantau progres joki secara real-time dan terima notifikasi setiap update</p>
            </div>
            <div class="card-topup">
                <div class="icon-wrap"><img src="{{ asset('img/icon/cs2.png') }}" alt="Garansi"></div>
                <h4>Garansi Naik</h4>
                <p>Rank pasti naik sesuai target atau uang kembali — syarat & ketentuan berlaku</p>
            </div>
        </div>

        {{-- 2D — CARA MELAKUKAN JOKI --}}
        <span class="section-label">Cara Melakukan Joki</span>
        <div class="grid-4-topup">
            <div class="card-topup step">
                <div class="step-row">
                    <div class="step-number">01</div>
                    <h4>Pilih Paket</h4>
                </div>
                <p>Tentukan target rank dan paket joki yang sesuai kebutuhanmu</p>
            </div>
            <div class="card-topup step">
                <div class="step-row">
                    <div class="step-number">02</div>
                    <h4>Hubungi Kami</h4>
                </div>
                <p>Hubungi admin via WhatsApp untuk konsultasi dan konfirmasi ketersediaan</p>
            </div>
            <div class="card-topup step">
                <div class="step-row">
                    <div class="step-number">03</div>
                    <h4>Pembayaran</h4>
                </div>
                <p>Lakukan pembayaran melalui metode yang tersedia (transfer/ewallet)</p>
            </div>
            <div class="card-topup step">
                <div class="step-row">
                    <div class="step-number">04</div>
                    <h4>Proses Joki</h4>
                </div>
                <p>Tim joki kami akan mengerjakan target rank sesuai pesananmu</p>
            </div>
        </div>

        {{-- 2E — FAQ --}}
        <div class="faq-row">
            <div>
                <span class="section-label">FAQ</span>
                <div class="faq-item" onclick="this.classList.toggle('open')">
                    <div class="faq-question">
                        Apakah joki MLBB aman untuk akun saya?
                        <span class="faq-arrow"><i class="fas fa-chevron-down"></i></span>
                    </div>
                    <div class="faq-answer">
                        Kami menggunakan mode duo/trio agar akun anda tetap aman tanpa perlu memberikan password. Tim joki kami juga menggunakan sistem anti-detection untuk menghindari risiko banned.
                    </div>
                </div>
                <div class="faq-item" onclick="this.classList.toggle('open')">
                    <div class="faq-question">
                        Berapa lama proses joki selesai?
                        <span class="faq-arrow"><i class="fas fa-chevron-down"></i></span>
                    </div>
                    <div class="faq-answer">
                        Waktu pengerjaan tergantung pada target rank yang dipilih. Rata-rata 1-3 hari untuk 1 divisi rank (misal Epic ke Legend), tergantung antrian dan performa tim.
                    </div>
                </div>
                <div class="faq-item" onclick="this.classList.toggle('open')">
                    <div class="faq-question">
                        Bagaimana jika rank tidak naik sesuai target?
                        <span class="faq-arrow"><i class="fas fa-chevron-down"></i></span>
                    </div>
                    <div class="faq-answer">
                        Kami memberikan garansi rank naik sesuai target. Jika dalam waktu yang disepakati rank belum mencapai target, anda berhak mendapatkan refund atau joki tambahan gratis.
                    </div>
                </div>
            </div>
            <div class="cta-card-topup">
                <div class="topup-icon"><img src="{{ asset('img/rank/ml/5imo.png') }}" alt="Immortal"></div>
                <div class="cta-content">
                    <h3 class="cta-title">Mulai Joki Sekarang</h3>
                    <p class="cta-subtitle">Rank impianmu tinggal beberapa langkah lagi. Hubungi kami sekarang!</p>
                    <a href="https://wa.me/62812347070" target="_blank" rel="noopener" class="btn-topup-cta" style="justify-content:center;padding:13px 28px;">
                        Pesan Joki Sekarang
                    </a>
                </div>
            </div>
        </div>

    </div>
</section>

@endsection
