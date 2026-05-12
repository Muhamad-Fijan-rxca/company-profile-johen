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
    @media(max-width:768px) { .about-grid,.vm-grid,.keunggulan-grid { grid-template-columns: 1fr; } }
</style>
@endpush

@section('content')
<div class="page-hero">
    <h1>Tentang PT Johen Gaming</h1>
    <p>Mengenal lebih dekat perusahaan gaming terpercaya pilihan para gamer Indonesia.</p>
</div>

{{-- SEJARAH --}}
<section class="section" style="background:white">
    <div class="container">
        <div class="about-grid">
            <div class="about-img reveal">
                <img src="https://images.unsplash.com/photo-1511512578047-dfb367046420?w=800&q=80" alt="PT Johen Gaming Office">
            </div>
            <div class="about-text reveal">
                <span class="section-tag">Sejarah Kami</span>
                <h2>Dari Passion Gaming Menjadi Bisnis Terpercaya</h2>
                <p>PT Johen Gaming didirikan pada tahun 2020 oleh sekelompok gamer berpengalaman yang memiliki visi untuk menciptakan ekosistem gaming yang aman, terpercaya, dan terjangkau bagi seluruh gamer Indonesia.</p>
                <p>Berawal dari layanan top up sederhana, kami terus berkembang dan kini melayani ribuan transaksi setiap harinya, mencakup top up game, jual beli akun, boost rank, dan berbagai layanan gaming lainnya.</p>
                <p>Dengan tim yang berdedikasi dan teknologi terkini, kami berkomitmen untuk terus berinovasi demi memberikan pengalaman gaming terbaik bagi pelanggan kami.</p>
                <div class="timeline" style="margin-top:32px">
                    <div class="timeline-item">
                        <span class="year">2020</span>
                        <h4>Pendirian PT Johen Gaming</h4>
                        <p>Mulai beroperasi dengan layanan top up Mobile Legends dan Free Fire.</p>
                    </div>
                    <div class="timeline-item">
                        <span class="year">2021</span>
                        <h4>Ekspansi Layanan Jual Beli Akun</h4>
                        <p>Meluncurkan platform jual beli akun game dengan sistem escrow pertama.</p>
                    </div>
                    <div class="timeline-item">
                        <span class="year">2023</span>
                        <h4>10.000+ Transaksi Terpenuhi</h4>
                        <p>Mencapai milestone 10 ribu transaksi dengan tingkat kepuasan 98%.</p>
                    </div>
                    <div class="timeline-item">
                        <span class="year">2025</span>
                        <h4>Platform Digital Terintegrasi</h4>
                        <p>Meluncurkan website resmi dan memperluas layanan ke 50+ judul game.</p>
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
                <p>Menjadi platform gaming terpercaya dan terdepan di Indonesia yang menghubungkan jutaan gamer dengan layanan berkualitas tinggi, aman, dan terjangkau pada tahun 2030.</p>
            </div>
            <div class="card vm-card reveal" style="transition-delay:0.1s">
                <div class="vm-icon">🚀</div>
                <h3>Misi</h3>
                <ul>
                    <li>Menyediakan layanan gaming yang cepat, aman, dan terpercaya.</li>
                    <li>Menghadirkan harga terbaik dengan kualitas layanan premium.</li>
                    <li>Membangun ekosistem gaming yang sehat dan menguntungkan semua pihak.</li>
                    <li>Terus berinovasi mengikuti perkembangan industri gaming.</li>
                    <li>Memberikan lapangan kerja bagi talenta muda Indonesia.</li>
                </ul>
            </div>
        </div>
    </div>
</section>

{{-- KEUNGGULAN --}}
<section class="section" style="background:white">
    <div class="container">
        <div class="section-header reveal">
            <span class="section-tag">Keunggulan</span>
            <h2 class="section-title">Mengapa Memilih Johen Gaming?</h2>
            <p class="section-subtitle">Kami hadir dengan standar layanan tertinggi untuk kepuasan Anda.</p>
        </div>
        <div class="keunggulan-grid">
            @foreach([
                ['⚡','Proses Super Cepat','Transaksi diproses dalam hitungan menit, bahkan detik untuk top up otomatis.'],
                ['🔒','Keamanan Terjamin','Sistem enkripsi data dan verifikasi berlapis untuk setiap transaksi.'],
                ['💰','Harga Kompetitif','Harga terbaik di pasaran dengan jaminan price match.'],
                ['🎮','50+ Game Tersedia','Melayani top up dan jual beli akun untuk lebih dari 50 judul game populer.'],
                ['📞','Support 24/7','Tim customer service siap membantu Anda kapan saja dan di mana saja.'],
                ['✅','Garansi Kepuasan','Jaminan uang kembali jika transaksi tidak sesuai dengan yang dijanjikan.'],
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
