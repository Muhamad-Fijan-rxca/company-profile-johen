<style>
    /* ── PAYMENT MARQUEE + CTA ── */
    .payment-section { background: #041640; }
    .payment-marquee {
        overflow: hidden;
        -webkit-mask-image: linear-gradient(to right, transparent 0%, black 10%, black 90%, transparent 100%);
        mask-image: linear-gradient(to right, transparent 0%, black 10%, black 90%, transparent 100%);
        padding: 40px 0;
    }
    .payment-marquee:hover .marquee-track {
        animation-play-state: paused;
    }
    .marquee-track {
        display: flex; gap: 48px; width: max-content;
        animation: marqueeScroll 25s linear infinite;
    }
    @keyframes marqueeScroll {
        0%   { transform: translateX(0); }
        100% { transform: translateX(-50%); }
    }
    .pay-logo {
        flex-shrink: 0; display: flex; align-items: center; justify-content: center;
        cursor: pointer; text-decoration: none;
    }
    .pay-logo img {
        transition: filter 0.3s ease, transform 0.3s ease;
    }
    .pay-logo:hover img {
        filter: brightness(1.3) drop-shadow(0 0 12px rgba(0,212,255,0.6));
        transform: translateY(-2px);
    }

    .cta-bottom {
        padding: 80px 24px 100px; text-align: center;
    }
    .cta-bottom h2 {
        font-size: clamp(28px, 4vw, 42px); font-weight: 900;
        color: white; margin: 0 0 16px;
    }
    .cta-bottom p {
        font-size: 16px; color: rgba(255,255,255,0.6);
        max-width: 520px; margin: 0 auto 36px; line-height: 1.7;
    }
    .cta-bottom .btn-hubungi {
        position: relative;
        display: inline-flex;
        align-items: center;
        border-radius: 100px;
        font-weight: 700;
        font-size: 18px;
        box-shadow: 0 4px 20px rgba(112,53,204,0.25);
        background: linear-gradient(90deg, #0668C0, #7035CC, #7035CC, #0668C0);
        background-size: 200% 100%;
        background-position: 0% 0%;
        border: 1px solid rgba(6,104,192,0.15);
        color: white;
        text-decoration: none;
        padding: 16px 36px 16px 56px;
        transition: padding 0.35s cubic-bezier(0.4, 0, 0.2, 1),
                    background-position 0.5s ease;
        overflow: hidden;
        cursor: pointer;
    }
    .cta-bottom .btn-hubungi:hover {
        padding: 16px 56px 16px 36px;
        background-position: 100% 0%;
    }
    .cta-bottom .btn-hubungi .btn-icon-wrap {
        position: absolute;
        top: 50%;
        left: 6px;
        transform: translateY(-50%);
        transition: left 0.35s cubic-bezier(0.4, 0, 0.2, 1);
        width: 36px;
        height: 36px;
        background: white;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .cta-bottom .btn-hubungi:hover .btn-icon-wrap {
        left: calc(100% - 42px);
    }
    .cta-bottom .btn-hubungi .btn-icon-wrap img {
        width: 18px;
        height: 18px;
        object-fit: contain;
        display: block;
    }
</style>

<section class="payment-section">
    <div class="payment-marquee">
        <div class="marquee-track">
            <a href="#" class="pay-logo" style="background:none;padding:0;"><img src="{{ asset('img/logo/bri.png') }}" alt="BRI" style="height:48px;width:auto;object-fit:contain;display:block;"></a>
            <a href="#" class="pay-logo" style="background:none;padding:0;"><img src="{{ asset('img/logo/bni.png') }}" alt="BNI" style="height:48px;width:auto;object-fit:contain;display:block;"></a>
            <a href="#" class="pay-logo" style="background:none;padding:0;"><img src="{{ asset('img/logo/bca.png') }}" alt="BCA" style="height:48px;width:auto;object-fit:contain;display:block;"></a>
            <a href="#" class="pay-logo" style="background:none;padding:0;"><img src="{{ asset('img/logo/mandiri.png') }}" alt="Mandiri" style="height:48px;width:auto;object-fit:contain;display:block;"></a>
            <a href="#" class="pay-logo" style="background:none;padding:0;"><img src="{{ asset('img/logo/Gopay.png') }}" alt="GoPay" style="height:48px;width:auto;object-fit:contain;display:block;"></a>
            <a href="#" class="pay-logo" style="background:none;padding:0;"><img src="{{ asset('img/logo/ovo.png') }}" alt="OVO" style="height:48px;width:auto;object-fit:contain;display:block;"></a>
            <a href="#" class="pay-logo" style="background:none;padding:0;"><img src="{{ asset('img/logo/dana.png') }}" alt="DANA" style="height:48px;width:auto;object-fit:contain;display:block;"></a>
            <a href="#" class="pay-logo" style="background:none;padding:0;"><img src="{{ asset('img/logo/shopeepay.png') }}" alt="ShopeePay" style="height:48px;width:auto;object-fit:contain;display:block;"></a>
            <a href="#" class="pay-logo" style="background:none;padding:0;"><img src="{{ asset('img/logo/freefire.png') }}" alt="Free Fire" style="height:48px;width:auto;object-fit:contain;display:block;"></a>
            <a href="#" class="pay-logo" style="background:none;padding:0;"><img src="{{ asset('img/logo/mobile-legend.png') }}" alt="Mobile Legend" style="height:48px;width:auto;object-fit:contain;display:block;"></a>
            <a href="#" class="pay-logo" style="background:none;padding:0;"><img src="{{ asset('img/logo/pubg.png') }}" alt="PUBG" style="height:48px;width:auto;object-fit:contain;display:block;"></a>
            <a href="#" class="pay-logo" style="background:none;padding:0;"><img src="{{ asset('img/logo/valorant.png') }}" alt="Valorant" style="height:54px;width:auto;object-fit:contain;display:block;"></a>
            <a href="#" class="pay-logo" style="background:none;padding:0;"><img src="{{ asset('img/logo/roblox.png') }}" alt="Roblox" style="height:48px;width:auto;object-fit:contain;display:block;"></a>
            <a href="#" class="pay-logo" style="background:none;padding:0;"><img src="{{ asset('img/logo/efootball.png') }}" alt="Efootball" style="height:54px;width:auto;object-fit:contain;display:block;"></a>
            <a href="#" class="pay-logo" style="background:none;padding:0;"><img src="{{ asset('img/logo/bri.png') }}" alt="BRI" style="height:48px;width:auto;object-fit:contain;display:block;"></a>
            <a href="#" class="pay-logo" style="background:none;padding:0;"><img src="{{ asset('img/logo/bni.png') }}" alt="BNI" style="height:48px;width:auto;object-fit:contain;display:block;"></a>
            <a href="#" class="pay-logo" style="background:none;padding:0;"><img src="{{ asset('img/logo/bca.png') }}" alt="BCA" style="height:48px;width:auto;object-fit:contain;display:block;"></a>
            <a href="#" class="pay-logo" style="background:none;padding:0;"><img src="{{ asset('img/logo/mandiri.png') }}" alt="Mandiri" style="height:48px;width:auto;object-fit:contain;display:block;"></a>
            <a href="#" class="pay-logo" style="background:none;padding:0;"><img src="{{ asset('img/logo/Gopay.png') }}" alt="GoPay" style="height:48px;width:auto;object-fit:contain;display:block;"></a>
            <a href="#" class="pay-logo" style="background:none;padding:0;"><img src="{{ asset('img/logo/ovo.png') }}" alt="OVO" style="height:48px;width:auto;object-fit:contain;display:block;"></a>
            <a href="#" class="pay-logo" style="background:none;padding:0;"><img src="{{ asset('img/logo/dana.png') }}" alt="DANA" style="height:48px;width:auto;object-fit:contain;display:block;"></a>
            <a href="#" class="pay-logo" style="background:none;padding:0;"><img src="{{ asset('img/logo/shopeepay.png') }}" alt="ShopeePay" style="height:48px;width:auto;object-fit:contain;display:block;"></a>
            <a href="#" class="pay-logo" style="background:none;padding:0;"><img src="{{ asset('img/logo/freefire.png') }}" alt="Free Fire" style="height:48px;width:auto;object-fit:contain;display:block;"></a>
            <a href="#" class="pay-logo" style="background:none;padding:0;"><img src="{{ asset('img/logo/mobile-legend.png') }}" alt="Mobile Legend" style="height:48px;width:auto;object-fit:contain;display:block;"></a>
            <a href="#" class="pay-logo" style="background:none;padding:0;"><img src="{{ asset('img/logo/pubg.png') }}" alt="PUBG" style="height:48px;width:auto;object-fit:contain;display:block;"></a>
            <a href="#" class="pay-logo" style="background:none;padding:0;"><img src="{{ asset('img/logo/valorant.png') }}" alt="Valorant" style="height:54px;width:auto;object-fit:contain;display:block;"></a>
            <a href="#" class="pay-logo" style="background:none;padding:0;"><img src="{{ asset('img/logo/roblox.png') }}" alt="Roblox" style="height:48px;width:auto;object-fit:contain;display:block;"></a>
            <a href="#" class="pay-logo" style="background:none;padding:0;"><img src="{{ asset('img/logo/efootball.png') }}" alt="Efootball" style="height:54px;width:auto;object-fit:contain;display:block;"></a>
        </div>
    </div>
    <div class="cta-bottom">
        <div class="container">
            <h2>Siap Meningkatkan Pengalaman Gaming-mu?</h2>
            <p>Top up lebih cepat, joki lebih aman, dan jual beli akun dengan proses transparan serta terpercaya.</p>
            <a href="https://wa.me/62812347070" target="_blank" rel="noopener" class="btn-hubungi">
                <span class="btn-icon-wrap"><img src="{{ asset('img/icon/telpon.png') }}" alt="Phone"></span>
                Hubungi Kami
            </a>
        </div>
    </div>
</section>
