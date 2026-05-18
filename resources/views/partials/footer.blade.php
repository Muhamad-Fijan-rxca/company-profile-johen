<style>
    .footer-wave {
        display: block;
        width: 100%;
        overflow: hidden;
        line-height: 0;
        margin-bottom: -2px;
        background: linear-gradient(135deg, #1a3fa8 0%, #2b3b90 60%, #6a1b9a 100%);
        position: relative;
    }
    /* Pattern + sama persis dengan CTA section */
    .footer-wave::before {
        content: '';
        position: absolute; inset: 0;
        background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none'%3E%3Cg fill='%23ffffff' fill-opacity='0.05'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        pointer-events: none;
        z-index: 0;
    }
    .footer-wave svg {
        display: block;
        width: 100%;
        height: 180px;
        position: relative;
        z-index: 1;
    }
    /* Animasi wave bergerak pelan */
    .footer-wave svg path:nth-child(1) {
        animation: waveMove 8s ease-in-out infinite alternate;
        transform-origin: center;
    }
    .footer-wave svg path:nth-child(2) {
        animation: waveMove 6s ease-in-out infinite alternate-reverse;
        transform-origin: center;
    }
    .footer-wave svg path:nth-child(3) {
        animation: waveMove 10s ease-in-out infinite alternate;
        transform-origin: center;
    }
    @keyframes waveMove {
        0%   { d: path("M0,145 C160,90 320,165 480,120 C640,75 800,155 960,110 C1120,65 1300,145 1440,115 L1440,180 L0,180 Z"); }
        100% { d: path("M0,115 C180,160 360,80 540,130 C720,175 900,85 1080,135 C1260,175 1380,100 1440,145 L1440,180 L0,180 Z"); }
    }
    footer {
        background: linear-gradient(180deg, #0a1128 0%, #0d1b4b 100%);
        color: rgba(255,255,255,0.7);
        padding: 0;
        position: relative;
        overflow: hidden;
    }
    footer::before {
        content: '';
        position: absolute;
        top: 0; left: 0; right: 0;
        height: 1px;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.15), transparent);
    }
    footer::after {
        content: '';
        position: absolute;
        inset: 0;
        background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none'%3E%3Cg fill='%23ffffff' fill-opacity='0.015'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        pointer-events: none;
    }

    /* MAIN CONTENT */
    .footer-main {
        max-width: 1200px; margin: 0 auto; padding: 80px 24px 48px;
        display: grid;
        grid-template-columns: 2.5fr 1fr 1fr 1.5fr;
        gap: 56px;
        position: relative; z-index: 1;
    }

    /* BRAND SECTION */
    .footer-brand .logo-wrap {
        display: inline-flex; align-items: center; gap: 12px;
        margin-bottom: 20px; text-decoration: none;
        transition: transform 0.3s;
    }
    .footer-brand .logo-wrap:hover { transform: translateX(4px); }
    .footer-brand .logo-wrap img {
        height: 48px;
        width: auto;
        object-fit: contain;
        display: block;
        filter: brightness(1.1);
    }
    .footer-brand .logo-tagline {
        font-size: 11px; font-weight: 600;
        color: rgba(255,255,255,0.5);
        letter-spacing: 1.5px;
        text-transform: uppercase;
        margin-bottom: 16px;
    }
    .footer-brand p {
        font-size: 14px; line-height: 1.85;
        color: rgba(255,255,255,0.6);
        margin-bottom: 28px;
        font-weight: 400;
    }

    /* SOCIAL MEDIA */
    .footer-social { display: flex; gap: 12px; flex-wrap: wrap; }
    .footer-social a {
        width: 42px; height: 42px;
        background: rgba(255,255,255,0.06);
        border: 1.5px solid rgba(255,255,255,0.12);
        border-radius: 12px;
        display: flex; align-items: center; justify-content: center;
        color: rgba(255,255,255,0.6); font-size: 16px;
        text-decoration: none;
        transition: all 0.35s cubic-bezier(0.4, 0, 0.2, 1);
        position: relative; overflow: hidden;
    }
    .footer-social a::before {
        content: '';
        position: absolute; inset: 0;
        background: var(--gradient);
        opacity: 0;
        transition: opacity 0.35s;
    }
    .footer-social a i { position: relative; z-index: 1; }
    .footer-social a:hover {
        border-color: transparent;
        color: white;
        transform: translateY(-4px);
        box-shadow: 0 8px 24px rgba(26,63,168,0.4);
    }
    .footer-social a:hover::before { opacity: 1; }

    /* COLUMNS */
    .footer-col h4 {
        color: white; font-size: 15px; font-weight: 800;
        margin-bottom: 24px; letter-spacing: -0.01em;
        position: relative;
        padding-bottom: 12px;
    }
    .footer-col h4::after {
        content: '';
        position: absolute;
        bottom: 0; left: 0;
        width: 32px; height: 3px;
        background: var(--gradient);
        border-radius: 2px;
    }
    .footer-col ul { list-style: none; }
    .footer-col ul li { margin-bottom: 12px; }
    .footer-col ul li a {
        color: rgba(255,255,255,0.6); text-decoration: none;
        font-size: 14px; font-weight: 500;
        transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
        display: inline-flex; align-items: center; gap: 8px;
        position: relative;
    }
    .footer-col ul li a::before {
        content: '';
        width: 4px; height: 4px;
        background: var(--accent);
        border-radius: 50%;
        opacity: 0;
        transform: translateX(-8px);
        transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
    }
    .footer-col ul li a:hover {
        color: white;
        transform: translateX(6px);
    }
    .footer-col ul li a:hover::before {
        opacity: 1;
        transform: translateX(0);
    }

    /* CONTACT ITEMS */
    .footer-contact-item {
        display: flex; gap: 14px; margin-bottom: 18px;
        font-size: 14px; font-weight: 500;
        color: rgba(255,255,255,0.6);
        transition: all 0.3s;
    }
    .footer-contact-item:hover {
        color: rgba(255,255,255,0.9);
        transform: translateX(4px);
    }
    .footer-contact-item .icon {
        width: 36px; height: 36px; flex-shrink: 0;
        background: rgba(255,255,255,0.08);
        border: 1px solid rgba(255,255,255,0.12);
        border-radius: 10px;
        display: flex; align-items: center; justify-content: center;
        font-size: 14px;
        transition: all 0.3s;
    }
    .footer-contact-item:hover .icon {
        background: var(--gradient);
        border-color: transparent;
        color: white;
        box-shadow: 0 4px 16px rgba(26,63,168,0.3);
    }
    .footer-contact-item .icon i { color: #93c5fd; transition: color 0.3s; }
    .footer-contact-item:hover .icon i { color: white; }
    .footer-contact-item span { line-height: 1.6; padding-top: 8px; }

    /* DIVIDER */
    .footer-divider {
        max-width: 1200px; margin: 0 auto; padding: 0 24px;
        position: relative; z-index: 1;
    }
    .footer-divider-line {
        height: 1px;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.1), transparent);
    }

    /* BOTTOM BAR */
    .footer-bottom {
        max-width: 1200px; margin: 0 auto;
        padding: 28px 24px;
        display: flex; justify-content: space-between; align-items: center;
        font-size: 13px; font-weight: 500;
        color: rgba(255,255,255,0.45);
        position: relative; z-index: 1;
    }
    .footer-bottom-left { display: flex; align-items: center; gap: 16px; }
    .footer-bottom-right { display: flex; align-items: center; gap: 20px; }
    .footer-bottom a { 
        color: rgba(255,255,255,0.55); 
        text-decoration: none; 
        transition: color 0.25s;
        font-weight: 500;
    }
    .footer-bottom a:hover { color: white; }
    .footer-bottom .divider-dot {
        width: 3px; height: 3px;
        background: rgba(255,255,255,0.3);
        border-radius: 50%;
    }

    /* BADGE */
    .footer-badge {
        display: inline-flex; align-items: center; gap: 6px;
        background: rgba(255,255,255,0.06);
        border: 1px solid rgba(255,255,255,0.1);
        padding: 6px 12px; border-radius: 100px;
        font-size: 12px; font-weight: 600;
        color: rgba(255,255,255,0.7);
    }
    .footer-badge i { color: #ef4444; font-size: 11px; }

    /* RESPONSIVE */
    @media (max-width: 1024px) {
        .footer-main { grid-template-columns: 1fr 1fr; gap: 40px; padding: 64px 24px 40px; }
    }
    @media (max-width: 768px) {
        .footer-main { grid-template-columns: 1fr 1fr; gap: 32px; padding: 56px 20px 32px; }
        .footer-wave svg { height: 120px; }
    }
    @media (max-width: 600px) {
        .footer-main { grid-template-columns: 1fr; gap: 32px; padding: 48px 16px 28px; }
        .footer-brand .logo-wrap img { height: 40px; }
        .footer-bottom { flex-direction: column; gap: 12px; text-align: center; padding: 20px 16px; }
        .footer-bottom-left, .footer-bottom-right { flex-direction: column; gap: 6px; }
        .footer-bottom .divider-dot { display: none; }
        .footer-wave svg { height: 80px; }
    }
</style>

{{-- WAVE --}}
<div class="footer-wave" id="footerWave">
    <svg viewBox="0 0 1440 180" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg">
        <!-- Layer 1: paling belakang -->
        <path d="M0,120 C120,60 240,160 360,100 C480,40 600,140 720,90 C840,40 960,130 1080,80 C1200,30 1320,110 1440,70 L1440,180 L0,180 Z"
              fill="#0a1128" opacity="0.4"/>
        <!-- Layer 2: tengah -->
        <path d="M0,130 C200,60 400,160 600,100 C800,40 1000,150 1200,90 C1320,60 1400,120 1440,100 L1440,180 L0,180 Z"
              fill="#0a1128" opacity="0.7"/>
        <!-- Layer 3: depan solid -->
        <path d="M0,145 C160,90 320,165 480,120 C640,75 800,155 960,110 C1120,65 1300,145 1440,115 L1440,180 L0,180 Z"
              fill="#0a1128"/>
    </svg>
</div>

<footer>
    <div class="footer-main">
        {{-- BRAND --}}
        <div class="footer-brand">
            <a href="{{ route('home') }}" class="logo-wrap">
                <img src="{{ asset('img/logo/johen_logo.png') }}" alt="Johen Gaming">
            </a>
            <div class="logo-tagline">Digital Gaming Commerce</div>
            <p>PT. Johen Sukses Abadi — Perusahaan digital gaming commerce terpercaya di Bandung. Spesialisasi jual beli akun game online, top up game, jasa joki, live commerce, dan konten digital gaming dengan standar keamanan tertinggi.</p>
            <div class="footer-social">
                <a href="https://www.instagram.com/johengaming.id?igsh=MW90MGFydmE4cDRndg==" target="_blank" rel="noopener" aria-label="Instagram">
                    <i class="fab fa-instagram"></i>
                </a>
                <a href="https://wa.me/62812347070" target="_blank" rel="noopener" aria-label="WhatsApp">
                    <i class="fab fa-whatsapp"></i>
                </a>
                <a href="https://www.tiktok.com/@johengaming.offline_?_r=1&_t=ZS-96Oki6CA8ws" target="_blank" rel="noopener" aria-label="TikTok">
                    <i class="fab fa-tiktok"></i>
                </a>
                <a href="https://www.linkedin.com/company/johen-gaming/" target="_blank" rel="noopener" aria-label="LinkedIn">
                    <i class="fab fa-linkedin"></i>
                </a>
                <a href="https://www.johengaming.com/id-id" target="_blank" rel="noopener" aria-label="Top Up Store">
                    <i class="fas fa-gamepad"></i>
                </a>
            </div>
        </div>

        {{-- NAVIGASI --}}
        <div class="footer-col">
            <h4>Navigasi</h4>
            <ul>
                <li><a href="{{ route('home') }}">Home</a></li>
                <li><a href="{{ route('tentang') }}">Tentang Kami</a></li>
                <li><a href="{{ route('produk') }}">Produk & Layanan</a></li>
                <li><a href="{{ route('berita') }}">Johen News</a></li>
                <li><a href="{{ route('karir') }}">Karir</a></li>
                <li><a href="{{ route('kontak') }}">Kontak</a></li>
            </ul>
        </div>

        {{-- LAYANAN --}}
        <div class="footer-col">
            <h4>Layanan</h4>
            <ul>
                <li><a href="{{ route('produk') }}?kategori=Jual+Beli+Akun">Jual Beli Akun</a></li>
                <li><a href="{{ route('produk') }}?kategori=Top+Up">Top Up Game</a></li>
                <li><a href="{{ route('produk') }}?kategori=Jasa+Joki">Jasa Joki Game</a></li>
                <li><a href="{{ route('produk') }}?kategori=Live+Commerce">Live Commerce</a></li>
                <li><a href="{{ route('produk') }}?kategori=Konten+Digital">Konten Digital</a></li>
                <li><a href="https://www.johengaming.com/id-id" target="_blank" rel="noopener">Top Up Store <i class="fas fa-external-link-alt" style="font-size:10px;opacity:0.6"></i></a></li>
            </ul>
        </div>

        {{-- KONTAK --}}
        <div class="footer-col">
            <h4>Kontak Kami</h4>
            <div class="footer-contact-item">
                <div class="icon"><i class="fas fa-map-marker-alt"></i></div>
                <span>Ruko Topaz No 60, Summarecon Bandung, Bandung 40295</span>
            </div>
            <div class="footer-contact-item">
                <div class="icon"><i class="fas fa-envelope"></i></div>
                <span>corporate@johengaming.store</span>
            </div>
            <div class="footer-contact-item">
                <div class="icon"><i class="fab fa-whatsapp"></i></div>
                <span>0812-3470-70</span>
            </div>

            {{-- GARIS PEMISAH CORPORATE & CS --}}
            <div style="display:flex;align-items:center;gap:10px;margin:4px 0 16px">
                <div style="flex:1;height:1px;background:rgba(255,255,255,0.1)"></div>
                <span style="font-size:10px;font-weight:700;letter-spacing:1.5px;text-transform:uppercase;color:rgba(255,255,255,0.35);white-space:nowrap">Customer Service</span>
                <div style="flex:1;height:1px;background:rgba(255,255,255,0.1)"></div>
            </div>

            <div class="footer-contact-item">
                <div class="icon"><i class="fas fa-envelope"></i></div>
                <span>cs@johengaming.store</span>
            </div>
            <div class="footer-contact-item">
                <div class="icon"><i class="fab fa-whatsapp"></i></div>
                <span>0822-6070-7012</span>
            </div>
        </div>
    </div>

    <div class="footer-divider">
        <div class="footer-divider-line"></div>
    </div>

    <div class="footer-bottom">
        <div class="footer-bottom-left">
            <span>&copy; {{ date('Y') }} PT. Johen Sukses Abadi</span>
            <span class="divider-dot"></span>
            <span>All rights reserved</span>
        </div>
        <div class="footer-bottom-right">
            <span class="footer-badge">
                Made with <i class="fas fa-heart"></i> for Gamers
            </span>
        </div>
    </div>
</footer>
