@extends('layouts.app')
@section('title', 'Tentang Kami')

@push('styles')
<style>
    .about-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 64px; align-items: center; }
    .about-img { border-radius: var(--radius); overflow: hidden; aspect-ratio: 4/3; background: var(--gradient); display: flex; align-items: center; justify-content: center; font-size: 80px; }
    .about-img img { width: 100%; height: 100%; object-fit: cover; }
    .about-text .section-tag { text-align: left; }
    .about-text h2 { font-size: clamp(24px, 3vw, 36px); font-weight: 700; margin-bottom: 16px; }
    .about-text p { color: var(--text-muted); line-height: 1.8; margin-bottom: 16px; }
    .vm-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 24px; }
    .vm-card { padding: 32px; }
    .vm-card .vm-icon { font-size: 40px; margin-bottom: 16px; }
    .vm-card h3 { font-size: 20px; font-weight: 700; margin-bottom: 12px; }
    .vm-card p, .vm-card li { color: var(--text-muted); font-size: 15px; line-height: 1.8; }
    .vm-card ul { padding-left: 20px; }
    .keunggulan-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 24px; }
    .keunggulan-item { text-align: center; padding: 32px 24px; }
    .keunggulan-item .icon { font-size: 48px; margin-bottom: 16px; }
    .keunggulan-item h3 { font-size: 16px; font-weight: 600; margin-bottom: 8px; }
    .keunggulan-item p { font-size: 14px; color: var(--text-muted); }
    .timeline { position: relative; padding-left: 32px; }
    .timeline::before { content: ''; position: absolute; left: 8px; top: 0; bottom: 0; width: 2px; background: var(--gradient); }
    .timeline-item { position: relative; margin-bottom: 32px; }
    .timeline-item::before { content: ''; position: absolute; left: -28px; top: 4px; width: 12px; height: 12px; border-radius: 50%; background: var(--gradient); }
    .timeline-item .year { font-size: 12px; font-weight: 700; color: var(--primary); text-transform: uppercase; letter-spacing: 1px; }
    .timeline-item h4 { font-size: 16px; font-weight: 600; margin: 4px 0; }
    .timeline-item p { font-size: 14px; color: var(--text-muted); }
    @media(max-width:768px) { 
        .about-grid, .vm-grid, .keunggulan-grid { grid-template-columns: 1fr; }
        .about-img { aspect-ratio: 16/9; font-size: 48px; }
        .about-text h2 { font-size: clamp(20px, 6vw, 28px); }
        .keunggulan-grid { grid-template-columns: 1fr 1fr; }
    }
    @media(max-width:480px) {
        .keunggulan-grid { grid-template-columns: 1fr; }
        .vm-card { padding: 24px 20px; }
        .keunggulan-item { padding: 24px 16px; }
    }
</style>
@endpush

@section('content')
<div class="page-hero">
    <h1>Tentang Kami</h1>
    <p>Mengenal lebih dekat PT. Johen Sukses Abadi (JOHEN GAMING) — perusahaan digital gaming commerce terpercaya dari Bandung.</p>
</div>

{{-- TENTANG PERUSAHAAN --}}
<section class="section" style="background:var(--bg)">
    <div class="container">
        <div class="about-grid">
            <div class="about-img reveal">
                <div style="font-size:80px;color:white">🏢</div>
            </div>
            <div class="about-text reveal">
                <span class="section-tag">Tentang Perusahaan</span>
                <h2>PT. Johen Sukses Abadi (JOHEN GAMING)</h2>
                <p>Johen adalah perusahaan startup yang bergerak di bidang <strong>digital gaming commerce</strong> dan pengembangan ekosistem bisnis berbasis industri game online di Indonesia. Berdiri sejak tahun <strong>2022</strong>, perusahaan hadir sebagai solusi terpercaya dalam menyediakan berbagai layanan kebutuhan pemain game dan komunitas digital.</p>
                <p>Fokus bisnis kami meliputi <strong>jual beli akun game online</strong> (PUBG Mobile, Mobile Legends, Free Fire, Roblox, eFootball, dan game lainnya), <strong>top up game</strong>, <strong>jasa joki game</strong>, <strong>live commerce gaming</strong>, serta <strong>pengelolaan konten digital</strong>.</p>
                <p>Johen berkomitmen membangun bisnis yang aman, profesional, berkelanjutan, inovatif, dan berorientasi pada kepuasan pelanggan. Dengan kantor operasional di <strong>Ruko Topaz No 60, Summarecon Bandung</strong>, kami siap melayani seluruh gamer Indonesia.</p>
                <div class="timeline" style="margin-top:32px">
                    <div class="timeline-item">
                        <span class="year">2022</span>
                        <h4>Pendirian PT. Johen Sukses Abadi</h4>
                        <p>Berdiri sebagai perusahaan digital gaming commerce yang berfokus pada jual beli akun game online dan top up game.</p>
                    </div>
                    <div class="timeline-item">
                        <span class="year">2024</span>
                        <h4>Pengembangan Layanan Live Commerce</h4>
                        <p>Meluncurkan live streaming penjualan dan produksi konten digital gaming untuk jangkauan lebih luas.</p>
                    </div>
                    <div class="timeline-item">
                        <span class="year">2025</span>
                        <h4>Ekspansi Divisi Store & Tim Profesional</h4>
                        <p>Mengembangkan divisi store (Johen MLBB, Johen Roblox, Johen PUBG, Monkey PUBG) dan memperkuat tim profesional dengan struktur organisasi lengkap.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- VISI MISI --}}
<section class="section" style="background:var(--bg)">
    <div class="container">
        <div class="section-header reveal">
            <span class="section-tag">Visi & Misi</span>
            <h2 class="section-title">Arah & Tujuan Kami</h2>
        </div>
        <div class="vm-grid">
            <div class="card vm-card reveal">
                <div class="vm-icon">🎯</div>
                <h3>Visi</h3>
                <p>Menjadi perusahaan nomor 1 di Bandung dan Indonesia sebagai pusat jual beli akun semua game online yang terpercaya, dengan pelayanan terbaik dan standar keamanan akun terbaik, serta menjadi pelopor utama industri gaming commerce di tingkat nasional dan internasional.</p>
            </div>
            <div class="card vm-card reveal" style="transition-delay:0.1s">
                <div class="vm-icon">🚀</div>
                <h3>Misi</h3>
                <ul>
                    <li>Memberikan layanan terbaik kepada pelanggan.</li>
                    <li>Menjaga dan meningkatkan standar keamanan akun.</li>
                    <li>Mengembangkan live commerce dan konten digital.</li>
                    <li>Membangun tim yang profesional, disiplin, dan berintegritas.</li>
                    <li>Mengembangkan bisnis yang inovatif dan berkelanjutan.</li>
                </ul>
            </div>
        </div>
    </div>
</section>

{{-- KEUNGGULAN --}}
<section class="section" style="background:var(--white)">
    <div class="container">
        <div class="section-header reveal">
            <span class="section-tag">Keunggulan</span>
            <h2 class="section-title">Mengapa Memilih JOHEN?</h2>
            <p class="section-subtitle">Kami hadir dengan standar layanan tertinggi untuk kepuasan Anda.</p>
        </div>
        <div class="keunggulan-grid">
            @foreach([
                ['📋','Sistem Kerja Terstruktur','Sistem kerja yang terstruktur dan profesional untuk setiap layanan yang kami berikan.'],
                ['🔒','Standar Keamanan Tinggi','Standar keamanan akun yang tinggi dengan verifikasi berlapis di setiap transaksi.'],
                ['⚡','Pelayanan Cepat & Responsif','Tim siap melayani dengan cepat dan responsif untuk setiap kebutuhan pelanggan.'],
                ['🎮','Tim Berpengalaman','Tim yang berpengalaman dan profesional di industri gaming commerce.'],
                ['🏢','Kantor Operasional Fisik','Memiliki kantor operasional fisik di Summarecon Bandung untuk pelayanan langsung.'],
                ['✅','Fokus Kepuasan Pelanggan','Fokus pada kepuasan pelanggan dan keberlanjutan bisnis yang bertanggung jawab.'],
            ] as [$icon, $title, $desc])
            <div class="card keunggulan-item reveal">
                <div class="icon">{{ $icon }}</div>
                <h3>{{ $title }}</h3>
                <p>{{ $desc }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endsection
