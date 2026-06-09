@extends('layouts.app')
@section('title', 'Konten Digital')

@push('styles')
<style>
    /* TAB FILTER */
    .tab-wrap { display: flex; gap: 0; background: white; border-radius: 14px; padding: 6px; box-shadow: var(--shadow-md); display: inline-flex; margin-bottom: 48px; }
    .tab-btn {
        padding: 12px 28px; border-radius: 10px; border: none; cursor: pointer;
        font-family: 'Poppins', sans-serif; font-size: 14px; font-weight: 600;
        color: var(--text-muted); background: transparent;
        transition: all 0.3s cubic-bezier(0.4,0,0.2,1);
        display: flex; align-items: center; gap: 8px;
    }
    .tab-btn.active { background: var(--gradient); color: white; box-shadow: 0 4px 16px rgba(26,63,168,0.3); }
    .tab-btn:hover:not(.active) { color: var(--primary); background: var(--primary-light); }

    /* KONTEN SECTION */
    .konten-section { display: none; }
    .konten-section.active { display: block; }

    /* CARD */
    .konten-card { position: relative; }
    .konten-card .img-wrap {
        width: 100%; aspect-ratio: 16/9;
        background: var(--gradient);
        display: flex; align-items: center; justify-content: center;
        font-size: 56px; overflow: hidden;
    }
    .konten-card .img-wrap img { width: 100%; height: 100%; object-fit: cover; }
    .konten-card .card-body { padding: 28px; }
    .konten-card .card-body h3 { font-size: 18px; font-weight: 700; margin-bottom: 12px; color: var(--text); }
    .konten-card .card-body p { font-size: 14px; color: var(--text-muted); line-height: 1.8; margin-bottom: 20px; }
    .konten-card .unggulan-badge {
        position: absolute; top: 16px; right: 16px;
        background: var(--accent); color: white;
        font-size: 11px; font-weight: 700;
        padding: 4px 12px; border-radius: 100px;
        letter-spacing: 0.5px;
    }
    .konten-card .cta-wrap { display: flex; gap: 12px; }

    /* HERO SECTION KONTEN */
    .konten-hero {
        background: var(--gradient);
        padding: 80px 24px 56px;
        text-align: center; color: white;
        position: relative; overflow: hidden;
    }
    .konten-hero::before {
        content: '';
        position: absolute; inset: 0;
        background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none'%3E%3Cg fill='%23ffffff' fill-opacity='0.04'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
    }
    .konten-hero h1 { font-size: clamp(28px,5vw,48px); font-weight: 800; margin-bottom: 14px; position: relative; }
    .konten-hero p { font-size: 16px; opacity: 0.85; max-width: 560px; margin: 0 auto 32px; position: relative; line-height: 1.7; }
    .konten-hero .tab-wrap { position: relative; }

    /* EMPTY STATE */
    .empty-state { text-align: center; padding: 80px 24px; color: var(--text-muted); }
    .empty-state .icon { font-size: 64px; margin-bottom: 16px; }

    @media(max-width:768px) {
        .tab-wrap { width: 100%; }
        .tab-btn { flex: 1; justify-content: center; padding: 12px 16px; font-size: 13px; }
    }
</style>
@endpush

@section('content')

{{-- HERO --}}
<div class="konten-hero page-hero">
    <h1>Konten Digital & Live Commerce</h1>
    <p>Layanan digital kreatif dan live streaming interaktif dari PT. Johen Sukses Abadi untuk kebutuhan gaming Anda.</p>
    <div style="display:flex;justify-content:center">
        <div class="tab-wrap" id="tabWrap">
            <button class="tab-btn active" onclick="switchTab('live')" id="tabLive">
                <i class="fas fa-video"></i> Live Commerce
            </button>
            <button class="tab-btn" onclick="switchTab('konten')" id="tabKonten">
                <i class="fas fa-photo-video"></i> Konten Digital
            </button>
        </div>
    </div>
</div>

<section class="section" style="background:var(--bg)">
    <div class="container">

        {{-- LIVE COMMERCE --}}
        <div class="konten-section active" id="sectionLive">
            <div class="section-header reveal">
                <span class="section-tag"><i class="fas fa-circle" style="color:#ef4444;font-size:8px"></i> Live Commerce</span>
                <h2 class="section-title">Belanja Lebih <span>Interaktif & Transparan</span></h2>
                <p class="section-subtitle">Saksikan langsung proses transaksi melalui live streaming kami di media sosial. Tanya, lihat, dan beli secara real-time.</p>
                <div class="divider"></div>
            </div>

            @if($liveCommerce->isEmpty())
            <div class="empty-state"><div class="icon">📺</div><h3>Belum ada layanan Live Commerce</h3></div>
            @else
            <div class="grid-3">
                @foreach($liveCommerce as $item)
                <div class="card konten-card reveal" style="transition-delay:{{ $loop->index * 0.1 }}s">
                    @if($item->unggulan)<span class="unggulan-badge">⭐ Unggulan</span>@endif
                    <div class="img-wrap">
                        @if($item->gambar)
                            <img src="{{ Storage::url($item->gambar) }}" alt="{{ $item->judul }}">
                        @else
                            📺
                        @endif
                    </div>
                    <div class="card-body">
                        <span class="badge badge-primary">{{ $item->kategori }}</span>
                        <h3 style="margin-top:10px">{{ $item->judul }}</h3>
                        <p>{{ $item->deskripsi }}</p>
                        <div class="cta-wrap">
                            <a href="{{ route('kontak') }}" class="btn btn-primary btn-sm">
                                <i class="fas fa-headset"></i> Hubungi Kami
                            </a>
                            <a href="https://wa.me/62812347070" target="_blank" class="btn btn-sm" style="background:#25d366;color:white">
                                <i class="fab fa-whatsapp"></i> WhatsApp
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            @endif
        </div>

        {{-- KONTEN DIGITAL --}}
        <div class="konten-section" id="sectionKonten">
            <div class="section-header reveal">
                <span class="section-tag">Konten Digital</span>
                <h2 class="section-title">Konten Kreatif <span>Berkualitas Tinggi</span></h2>
                <p class="section-subtitle">Layanan produksi konten digital gaming profesional untuk kebutuhan media sosial, promosi, dan branding Anda.</p>
                <div class="divider"></div>
            </div>

            @if($kontenDigital->isEmpty())
            <div class="empty-state"><div class="icon">🎬</div><h3>Belum ada layanan Konten Digital</h3></div>
            @else
            <div class="grid-3">
                @foreach($kontenDigital as $item)
                <div class="card konten-card reveal" style="transition-delay:{{ $loop->index * 0.1 }}s">
                    @if($item->unggulan)<span class="unggulan-badge">⭐ Unggulan</span>@endif
                    <div class="img-wrap">
                        @if($item->gambar)
                            <img src="{{ Storage::url($item->gambar) }}" alt="{{ $item->judul }}">
                        @else
                            🎬
                        @endif
                    </div>
                    <div class="card-body">
                        <span class="badge badge-primary">{{ $item->kategori }}</span>
                        <h3 style="margin-top:10px">{{ $item->judul }}</h3>
                        <p>{{ $item->deskripsi }}</p>
                        <div class="cta-wrap">
                            <a href="{{ route('kontak') }}" class="btn btn-primary btn-sm">
                                <i class="fas fa-headset"></i> Hubungi Kami
                            </a>
                            <a href="https://wa.me/62812347070" target="_blank" class="btn btn-sm" style="background:#25d366;color:white">
                                <i class="fab fa-whatsapp"></i> WhatsApp
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            @endif
        </div>

    </div>
</section>

{{-- CTA --}}
<section style="background:var(--gradient);padding:64px 24px;text-align:center;color:white;position:relative;overflow:hidden">
    <div class="container reveal">
        <h2 style="font-size:clamp(24px,4vw,36px);font-weight:900;margin-bottom:12px">Tertarik dengan Layanan Kami?</h2>
        <p style="font-size:16px;opacity:0.9;max-width:480px;margin:0 auto 28px;line-height:1.7">Hubungi tim Johen Gaming sekarang untuk konsultasi layanan konten digital dan live commerce.</p>
        <a href="{{ route('kontak') }}" class="btn btn-white btn-lg">
            <i class="fas fa-headset"></i> Konsultasi Sekarang
        </a>
    </div>
</section>

@endsection

@push('scripts')
<script>
    function switchTab(tab) {
        document.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active'));
        document.querySelectorAll('.konten-section').forEach(s => s.classList.remove('active'));
        document.getElementById('tab' + tab.charAt(0).toUpperCase() + tab.slice(1)).classList.add('active');
        document.getElementById('section' + tab.charAt(0).toUpperCase() + tab.slice(1)).classList.add('active');
    }
</script>
@endpush
