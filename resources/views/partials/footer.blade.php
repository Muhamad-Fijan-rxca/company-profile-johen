<style>
    footer {
        background: #0d1b4b;
        color: rgba(255,255,255,0.7);
        padding: 64px 0 0;
    }
    .footer-inner {
        max-width: 1200px; margin: 0 auto; padding: 0 24px;
        display: grid;
        grid-template-columns: 2.2fr 1fr 1fr 1.4fr;
        gap: 48px;
        padding-bottom: 48px;
        border-bottom: 1px solid rgba(255,255,255,0.08);
    }
    .footer-brand .logo-wrap {
        display: flex; align-items: center; gap: 12px;
        margin-bottom: 16px; text-decoration: none;
    }
    .footer-brand .logo-box {
        width: 44px; height: 44px;
        background: var(--gradient);
        border-radius: 12px;
        display: flex; align-items: center; justify-content: center;
        color: white; font-size: 16px; font-weight: 900;
    }
    .footer-brand .logo-name { font-size: 18px; font-weight: 800; color: white; }
    .footer-brand .logo-name span { color: #93c5fd; }
    .footer-brand p {
        font-size: 14px; line-height: 1.8;
        color: rgba(255,255,255,0.55);
        margin-bottom: 20px;
    }
    .footer-social { display: flex; gap: 10px; }
    .footer-social a {
        width: 38px; height: 38px;
        background: rgba(255,255,255,0.08);
        border: 1px solid rgba(255,255,255,0.1);
        border-radius: 10px;
        display: flex; align-items: center; justify-content: center;
        color: rgba(255,255,255,0.6); font-size: 15px;
        text-decoration: none;
        transition: all 0.2s;
    }
    .footer-social a:hover {
        background: var(--primary);
        border-color: var(--primary);
        color: white;
        transform: translateY(-2px);
    }
    .footer-col h4 {
        color: white; font-size: 14px; font-weight: 700;
        margin-bottom: 18px; letter-spacing: 0.3px;
    }
    .footer-col ul { list-style: none; }
    .footer-col ul li { margin-bottom: 11px; }
    .footer-col ul li a {
        color: rgba(255,255,255,0.55); text-decoration: none;
        font-size: 14px; transition: color 0.2s;
        display: flex; align-items: center; gap: 6px;
    }
    .footer-col ul li a::before {
        content: '›'; color: var(--accent); font-size: 16px; font-weight: 700;
    }
    .footer-col ul li a:hover { color: white; }
    .footer-contact-item {
        display: flex; gap: 12px; margin-bottom: 14px; font-size: 14px;
        color: rgba(255,255,255,0.55);
    }
    .footer-contact-item .icon {
        width: 32px; height: 32px; flex-shrink: 0;
        background: rgba(255,255,255,0.08);
        border-radius: 8px;
        display: flex; align-items: center; justify-content: center;
        color: #93c5fd; font-size: 13px;
    }
    .footer-contact-item span { line-height: 1.5; padding-top: 6px; }

    /* BOTTOM BAR */
    .footer-bottom {
        max-width: 1200px; margin: 0 auto;
        padding: 20px 24px;
        display: flex; justify-content: space-between; align-items: center;
        font-size: 13px; color: rgba(255,255,255,0.4);
    }
    .footer-bottom a { color: rgba(255,255,255,0.55); text-decoration: none; transition: color 0.2s; }
    .footer-bottom a:hover { color: white; }

    @media (max-width: 1024px) {
        .footer-inner { grid-template-columns: 1fr 1fr; gap: 32px; }
    }
    @media (max-width: 600px) {
        .footer-inner { grid-template-columns: 1fr; gap: 28px; }
        .footer-bottom { flex-direction: column; gap: 8px; text-align: center; }
    }
</style>

<footer>
    <div class="footer-inner">
        {{-- Brand --}}
        <div class="footer-brand">
            <a href="{{ route('home') }}" class="logo-wrap">
                <div class="logo-box">JG</div>
                <span class="logo-name">Johen<span>Gaming</span></span>
            </a>
            <p>Platform terpercaya untuk semua kebutuhan gaming Anda. Top up, jual beli akun, dan layanan gaming lainnya dengan harga terbaik.</p>
            <div class="footer-social">
                <a href="#" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
                <a href="#" aria-label="TikTok"><i class="fab fa-tiktok"></i></a>
                <a href="#" aria-label="WhatsApp"><i class="fab fa-whatsapp"></i></a>
                <a href="#" aria-label="YouTube"><i class="fab fa-youtube"></i></a>
                <a href="#" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
            </div>
        </div>

        {{-- Navigasi --}}
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

        {{-- Layanan --}}
        <div class="footer-col">
            <h4>Layanan</h4>
            <ul>
                <li><a href="{{ route('produk') }}?kategori=Top+Up">Top Up Game</a></li>
                <li><a href="{{ route('produk') }}?kategori=Jual+Beli+Akun">Jual Beli Akun</a></li>
                <li><a href="{{ route('produk') }}?kategori=Jasa">Boost Rank</a></li>
                <li><a href="{{ route('kontak') }}">Hubungi Kami</a></li>
            </ul>
        </div>

        {{-- Kontak --}}
        <div class="footer-col">
            <h4>Kontak Kami</h4>
            <div class="footer-contact-item">
                <div class="icon"><i class="fas fa-map-marker-alt"></i></div>
                <span>Jl. Gaming No. 1, Jakarta Selatan, DKI Jakarta 12345</span>
            </div>
            <div class="footer-contact-item">
                <div class="icon"><i class="fas fa-envelope"></i></div>
                <span>info@johengaming.com</span>
            </div>
            <div class="footer-contact-item">
                <div class="icon"><i class="fab fa-whatsapp"></i></div>
                <span>+62 812-3456-7890</span>
            </div>
            <div class="footer-contact-item">
                <div class="icon"><i class="fas fa-clock"></i></div>
                <span>Senin–Sabtu, 09.00–21.00 WIB</span>
            </div>
        </div>
    </div>

    <div class="footer-bottom">
        <span>&copy; {{ date('Y') }} PT Johen Gaming. All rights reserved.</span>
        <span>Made with <i class="fas fa-heart" style="color:#ef4444;margin:0 3px"></i> for Gamers Indonesia</span>
    </div>
</footer>
