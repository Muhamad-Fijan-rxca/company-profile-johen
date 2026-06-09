<style>
    /* ── CONCAVE CURVE + SCROLL TO TOP ── */
    .footer-curve-wrap {
        position: relative;
        width: 100%;
        line-height: 0;
        overflow: visible;
        /* transparan — biar section di atas yang keliatan */
        background: transparent;
    }
    .footer-curve-wrap svg {
        display: block;
        width: 100%;
        height: 100px;
    }
    /* Tombol scroll-to-top duduk di puncak cekungan */
    #scrollTopBtn {
        position: absolute;
        bottom: 0px;
        left: 50%;
        transform: translateX(-50%) translateY(50%);
        width: 52px; height: 52px;
        border-radius: 50%;
        background: linear-gradient(135deg, #0668C0, #7035CC);
        border: 2px solid rgba(0,212,255,0.35);
        display: flex; align-items: center; justify-content: center;
        cursor: pointer;
        z-index: 10;
        box-shadow: 0 0 0 6px rgba(6,104,192,0.12), 0 8px 24px rgba(112,53,204,0.35);
        transition: transform 0.3s cubic-bezier(0.4,0,0.2,1),
                    box-shadow 0.3s cubic-bezier(0.4,0,0.2,1);
        text-decoration: none;
    }
    #scrollTopBtn:hover {
        transform: translateX(-50%) translateY(40%) scale(1.1);
        box-shadow: 0 0 0 8px rgba(6,104,192,0.18), 0 12px 32px rgba(112,53,204,0.5);
    }
    #scrollTopBtn svg {
        width: 20px; height: 20px;
        display: block;
        position: static;
        flex-shrink: 0;
    }
    @media (max-width: 768px) {
        .footer-curve-wrap svg { height: 64px; }
        #scrollTopBtn { width: 44px; height: 44px; }
        #scrollTopBtn svg { width: 16px; height: 16px; }
    }

    /* ── FOOTER BASE ── */
    footer {
        background: #010d28;
        color: rgba(255,255,255,0.65);
        padding: 0;
        position: relative;
        overflow: visible;
    }

    /* Subtle radial glow background */
    footer::before {
        content: '';
        position: absolute;
        top: -80px; left: 50%;
        transform: translateX(-50%);
        width: 900px; height: 400px;
        background: radial-gradient(ellipse at center,
            rgba(0,212,255,0.05) 0%,
            rgba(112,53,204,0.04) 40%,
            transparent 70%
        );
        pointer-events: none;
        z-index: 0;
    }

    /* Grid noise texture overlay */
    footer::after {
        content: '';
        position: absolute; inset: 0;
        background-image:
            linear-gradient(rgba(0,212,255,0.03) 1px, transparent 1px),
            linear-gradient(90deg, rgba(0,212,255,0.03) 1px, transparent 1px);
        background-size: 48px 48px;
        pointer-events: none;
        z-index: 0;
    }

    /* ── TOP GLOW LINE ── */
    .footer-glow-line {
        height: 1px;
        background: linear-gradient(90deg,
            transparent 0%,
            rgba(0,212,255,0.3) 30%,
            rgba(112,53,204,0.3) 70%,
            transparent 100%
        );
        position: relative; z-index: 1;
    }

    /* ── MAIN GRID ── */
    .footer-main {
        max-width: 1280px; margin: 0 auto;
        padding: 72px 40px 56px;
        display: grid;
        grid-template-columns: 2.2fr 1fr 1fr 1.6fr;
        gap: 64px;
        position: relative; z-index: 1;
    }

    /* ── BRAND ── */
    .footer-brand .logo-wrap {
        display: inline-flex; align-items: center; gap: 10px;
        margin-bottom: 16px; text-decoration: none;
        transition: opacity 0.3s;
    }
    .footer-brand .logo-wrap:hover { opacity: 0.85; }
    .footer-brand .logo-wrap img {
        height: 46px; width: auto;
        object-fit: contain; display: block;
    }
    .footer-brand .logo-tagline {
        font-size: 10px; font-weight: 700;
        letter-spacing: 2.5px; text-transform: uppercase;
        background: linear-gradient(90deg, #00d4ff, #7c3aed);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        margin-bottom: 18px;
        display: block;
    }
    .footer-brand p {
        font-size: 14px; line-height: 1.85;
        color: rgba(255,255,255,0.5);
        margin-bottom: 28px;
    }

    /* Social icons */
    .footer-social { display: flex; gap: 10px; flex-wrap: wrap; }
    .footer-social a {
        width: 40px; height: 40px;
        border-radius: 10px;
        display: flex; align-items: center; justify-content: center;
        font-size: 15px; color: rgba(255,255,255,0.5);
        text-decoration: none;
        position: relative;
        background: rgba(255,255,255,0.04);
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        overflow: hidden;
    }
    /* Gradient border via pseudo */
    .footer-social a::before {
        content: '';
        position: absolute; inset: 0;
        border-radius: 10px;
        padding: 1px;
        background: linear-gradient(135deg, rgba(0,212,255,0.25), rgba(112,53,204,0.25));
        -webkit-mask: linear-gradient(#fff 0 0) content-box, linear-gradient(#fff 0 0);
        -webkit-mask-composite: xor;
        mask-composite: exclude;
        transition: opacity 0.3s;
    }
    .footer-social a::after {
        content: '';
        position: absolute; inset: 0;
        border-radius: 10px;
        background: linear-gradient(135deg, rgba(0,212,255,0.15), rgba(112,53,204,0.15));
        opacity: 0;
        transition: opacity 0.3s;
    }
    .footer-social a i { position: relative; z-index: 1; transition: color 0.3s; }
    .footer-social a:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 20px rgba(0,212,255,0.2);
        color: white;
    }
    .footer-social a:hover::after { opacity: 1; }
    .footer-social a:hover::before {
        background: linear-gradient(135deg, rgba(0,212,255,0.6), rgba(112,53,204,0.6));
    }

    /* ── COLUMNS ── */
    .footer-col h4 {
        color: white; font-size: 13px; font-weight: 800;
        letter-spacing: 2px; text-transform: uppercase;
        margin-bottom: 24px;
        position: relative; padding-bottom: 14px;
    }
    .footer-col h4::after {
        content: '';
        position: absolute; bottom: 0; left: 0;
        width: 28px; height: 2px;
        background: linear-gradient(90deg, #00d4ff, #7c3aed);
        border-radius: 2px;
    }
    .footer-col ul { list-style: none; }
    .footer-col ul li { margin-bottom: 11px; }
    .footer-col ul li a {
        color: rgba(255,255,255,0.5); text-decoration: none;
        font-size: 14px; font-weight: 400;
        display: inline-flex; align-items: center; gap: 8px;
        transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
        position: relative;
    }
    .footer-col ul li a::before {
        content: '';
        width: 0; height: 1px;
        background: linear-gradient(90deg, #00d4ff, #7c3aed);
        border-radius: 1px;
        transition: width 0.25s cubic-bezier(0.4, 0, 0.2, 1);
        display: block;
        flex-shrink: 0;
    }
    .footer-col ul li a:hover {
        color: rgba(255,255,255,0.95);
        transform: translateX(4px);
    }
    .footer-col ul li a:hover::before { width: 12px; }

    /* ── CONTACT ITEMS ── */
    .footer-contact-item {
        display: flex; gap: 12px; margin-bottom: 16px; align-items: flex-start;
    }
    .footer-contact-item .fc-icon {
        width: 34px; height: 34px; flex-shrink: 0;
        border-radius: 9px;
        display: flex; align-items: center; justify-content: center;
        font-size: 13px;
        background: rgba(0,212,255,0.06);
        position: relative;
        transition: all 0.3s;
    }
    .footer-contact-item .fc-icon::before {
        content: '';
        position: absolute; inset: 0;
        border-radius: 9px; padding: 1px;
        background: linear-gradient(135deg, rgba(0,212,255,0.2), rgba(112,53,204,0.2));
        -webkit-mask: linear-gradient(#fff 0 0) content-box, linear-gradient(#fff 0 0);
        -webkit-mask-composite: xor;
        mask-composite: exclude;
    }
    .footer-contact-item .fc-icon i { color: #00d4ff; font-size: 12px; }
    .footer-contact-item .fc-text {
        font-size: 13px; color: rgba(255,255,255,0.55);
        line-height: 1.65; padding-top: 7px;
    }
    .footer-contact-item:hover .fc-icon {
        background: rgba(0,212,255,0.12);
        box-shadow: 0 0 12px rgba(0,212,255,0.15);
    }
    .footer-contact-item:hover .fc-text { color: rgba(255,255,255,0.85); }

    .footer-cs-divider {
        display: flex; align-items: center; gap: 10px;
        margin: 8px 0 16px;
    }
    .footer-cs-divider .line {
        flex: 1; height: 1px;
        background: linear-gradient(90deg, transparent, rgba(0,212,255,0.15), transparent);
    }
    .footer-cs-divider span {
        font-size: 9px; font-weight: 800; letter-spacing: 2px;
        text-transform: uppercase; color: rgba(0,212,255,0.4);
        white-space: nowrap;
    }

    /* ── DIVIDER ── */
    .footer-sep {
        max-width: 1280px; margin: 0 auto; padding: 0 40px;
        position: relative; z-index: 1;
    }
    .footer-sep-line {
        height: 1px;
        background: linear-gradient(90deg,
            transparent,
            rgba(0,212,255,0.12) 20%,
            rgba(112,53,204,0.12) 80%,
            transparent
        );
    }

    /* ── BOTTOM BAR ── */
    .footer-bottom {
        max-width: 1280px; margin: 0 auto;
        padding: 24px 40px;
        display: flex; justify-content: space-between; align-items: center;
        position: relative; z-index: 1;
        flex-wrap: wrap; gap: 12px;
    }
    .footer-bottom-left {
        display: flex; align-items: center; gap: 8px;
        font-size: 13px; color: rgba(255,255,255,0.35);
    }
    .footer-bottom-left .dot {
        width: 3px; height: 3px; border-radius: 50%;
        background: rgba(255,255,255,0.2);
    }
    .footer-bottom-right {
        display: flex; align-items: center; gap: 6px;
        font-size: 12px; font-weight: 600;
        color: rgba(255,255,255,0.3);
    }
    .footer-bottom-right .heart {
        background: linear-gradient(90deg, #00d4ff, #7c3aed);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        font-size: 13px;
    }

    /* ── RESPONSIVE ── */
    @media (max-width: 1100px) {
        .footer-main { grid-template-columns: 1fr 1fr; gap: 48px; padding: 64px 32px 48px; }
    }
    @media (max-width: 640px) {
        .footer-main { grid-template-columns: 1fr; gap: 40px; padding: 56px 24px 40px; }
        .footer-sep, .footer-bottom { padding-left: 24px; padding-right: 24px; }
        .footer-bottom { flex-direction: column; align-items: flex-start; padding: 20px 24px; }
        footer::before { width: 100%; }
    }
</style>

<footer>
    {{-- CONCAVE CURVE: berada di dalam footer, SVG fill = warna footer (#041640) --}}
    {{-- Background footer di belakang curve = transparan = warna section sebelumnya terlihat --}}
    <div class="footer-curve-wrap">
        <svg viewBox="0 0 1440 100" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M0,0 L0,30 Q360,100 720,100 Q1080,100 1440,30 L1440,0 Z"
                  fill="#010d28"/>
        </svg>
        <button id="scrollTopBtn" aria-label="Scroll ke atas" onclick="window.scrollTo({top:0,behavior:'smooth'})">
            <svg viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                <polyline points="18 15 12 9 6 15"></polyline>
            </svg>
        </button>
    </div>

    <div class="footer-main">

        {{-- BRAND --}}
        <div class="footer-brand">
            <a href="{{ route('home') }}" class="logo-wrap">
                <img src="{{ asset('img/logo/johen_logo.png') }}" alt="Johen Gaming">
            </a>
            <span class="logo-tagline">Digital Gaming Commerce</span>
            <p>PT. Johen Sukses Abadi — perusahaan digital gaming commerce terpercaya di Bandung. Spesialisasi jual beli akun game online, top up, jasa joki, live commerce, dan konten digital gaming.</p>
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
                <li><a href="{{ route('home') }}">Beranda</a></li>
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
                <li><a href="https://www.johengaming.com/id-id" target="_blank" rel="noopener">Top Up Store <i class="fas fa-external-link-alt" style="font-size:9px;opacity:0.5"></i></a></li>
            </ul>
        </div>

        {{-- KONTAK --}}
        <div class="footer-col">
            <h4>Kontak Kami</h4>
            <div class="footer-contact-item">
                <div class="fc-icon"><i class="fas fa-map-marker-alt"></i></div>
                <div class="fc-text">Ruko Topaz No 60, Summarecon Bandung, Bandung 40295</div>
            </div>
            <div class="footer-contact-item">
                <div class="fc-icon"><i class="fas fa-envelope"></i></div>
                <div class="fc-text">corporate@johengaming.store</div>
            </div>
            <div class="footer-contact-item">
                <div class="fc-icon"><i class="fab fa-whatsapp"></i></div>
                <div class="fc-text">0812-3470-70</div>
            </div>

            <div class="footer-cs-divider">
                <div class="line"></div>
                <span>Customer Service</span>
                <div class="line"></div>
            </div>

            <div class="footer-contact-item">
                <div class="fc-icon"><i class="fas fa-envelope"></i></div>
                <div class="fc-text">cs@johengaming.store</div>
            </div>
            <div class="footer-contact-item">
                <div class="fc-icon"><i class="fab fa-whatsapp"></i></div>
                <div class="fc-text">0822-6070-7012</div>
            </div>
        </div>

    </div>

    <div class="footer-sep">
        <div class="footer-sep-line"></div>
    </div>

    <div class="footer-bottom">
        <div class="footer-bottom-left">
            <span>&copy; {{ date('Y') }} PT. Johen Sukses Abadi</span>
            <span class="dot"></span>
            <span>All rights reserved</span>
        </div>
        <div class="footer-bottom-right">
            Made with <span class="heart">♥</span> for Gamers
        </div>
    </div>

</footer>
