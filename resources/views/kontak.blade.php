@extends('layouts.app')
@section('title', 'Kontak')

@push('styles')
<style>
    .kontak-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 48px; }
    .info-item { display: flex; gap: 16px; margin-bottom: 24px; }
    .info-icon { width: 48px; height: 48px; background: var(--gradient-light); border-radius: 12px; display: flex; align-items: center; justify-content: center; color: var(--primary); font-size: 18px; flex-shrink: 0; }
    .info-item h4 { font-size: 14px; font-weight: 600; margin-bottom: 4px; }
    .info-item p { font-size: 14px; color: var(--text-muted); }
    .map-wrap { border-radius: var(--radius); overflow: hidden; margin-top: 24px; }
    .map-wrap iframe { width: 100%; height: 280px; border: none; display: block; }
    .form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; }
    @media(max-width:768px) { 
        .kontak-grid { grid-template-columns: 1fr; }
        .form-row { grid-template-columns: 1fr; }
    }
</style>
@endpush

@section('content')
<div class="page-hero">
    <h1>Hubungi Kami</h1>
    <p>PT. Johen Sukses Abadi (JOHEN GAMING) — Silakan hubungi tim kami untuk konsultasi, transaksi, atau informasi lebih lanjut.</p>
</div>

{{-- BAGIAN 1: CONTACT PT --}}
<section class="section" style="background:white">
    <div class="container">
        <div class="section-header reveal">
            <span class="section-tag">Informasi Perusahaan</span>
            <h2 class="section-title">Kantor Pusat</h2>
            <p class="section-subtitle">Kunjungi kantor operasional kami di Summarecon Bandung atau hubungi melalui kontak di bawah ini.</p>
        </div>
        <div class="kontak-grid">
            <div class="reveal">
                <div class="info-item">
                    <div class="info-icon"><i class="fas fa-map-marker-alt"></i></div>
                    <div>
                        <h4>Alamat Kantor</h4>
                        <p>Ruko Topaz No 60, Summarecon Bandung,<br>Bandung 40295, Jawa Barat, Indonesia</p>
                    </div>
                </div>
                <div class="info-item">
                    <div class="info-icon"><i class="fas fa-envelope"></i></div>
                    <div>
                        <h4>Email Resmi</h4>
                        <p>corporate@johengaming.store</p>
                    </div>
                </div>
                <div class="info-item">
                    <div class="info-icon"><i class="fab fa-whatsapp"></i></div>
                    <div>
                        <h4>WhatsApp / Telepon</h4>
                        <p>0812-3470-70</p>
                    </div>
                </div>
                <div class="info-item">
                    <div class="info-icon"><i class="fas fa-hashtag"></i></div>
                    <div>
                        <h4>Media Sosial</h4>
                        <p>@johengaming.mlbb<br>@johengaming.pubg<br>@johengaming.offline</p>
                    </div>
                </div>
            </div>
            <div class="reveal" style="transition-delay:0.1s">
                <div class="map-wrap">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3960.8!2d107.619!3d-6.933!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e68e9d0f8b8b8b9%3A0x0!2sSummarecon%20Bandung!5e0!3m2!1sid!2sid!4v1234567890"
                        allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"
                        title="Lokasi PT. Johen Sukses Abadi - Summarecon Bandung">
                    </iframe>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- BAGIAN 2: CONTACT US FORM --}}
<section class="section" style="background:var(--bg)">
    <div class="container">
        <div class="section-header reveal">
            <span class="section-tag">Contact Us</span>
            <h2 class="section-title">Kirim <span>Pesan</span> ke CS</h2>
            <p class="section-subtitle">Ada pertanyaan, keluhan, atau butuh bantuan? Tim Customer Service kami siap membantu Anda.</p>
        </div>

        <div style="max-width:680px;margin:0 auto" class="reveal">
            @if(session('success'))
            <div class="alert alert-success"><i class="fas fa-check-circle"></i> {{ session('success') }}</div>
            @endif

            <div class="card" style="padding:40px">

                {{-- INFO CS --}}
                <div style="display:flex;gap:16px;background:var(--primary-light);border:1px solid rgba(26,63,168,0.15);border-radius:12px;padding:16px 20px;margin-bottom:28px;align-items:flex-start">
                    <div style="width:40px;height:40px;background:var(--gradient);border-radius:10px;display:flex;align-items:center;justify-content:center;flex-shrink:0">
                        <i class="fas fa-headset" style="color:white;font-size:16px"></i>
                    </div>
                    <div>
                        <div style="font-size:13px;font-weight:700;color:var(--primary);margin-bottom:4px">Customer Service Johen Gaming</div>
                        <div style="font-size:13px;color:var(--text-muted);line-height:1.6">
                            <i class="fas fa-envelope" style="width:16px"></i> cs@johengaming.store &nbsp;·&nbsp;
                            <i class="fab fa-whatsapp" style="width:16px;color:#25d366"></i> 0822-6070-7012
                        </div>
                    </div>
                </div>

                <form action="{{ route('kontak.kirim') }}" method="POST">
                    @csrf
                    <input type="hidden" name="tujuan" value="cs">
                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">Nama Lengkap *</label>
                            <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror" value="{{ old('nama') }}" placeholder="Nama Anda" required>
                            @error('nama')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="form-group">
                            <label class="form-label">Email *</label>
                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" placeholder="email@contoh.com" required>
                            @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label">No. HP / WhatsApp *</label>
                        <input type="text" name="no_hp" class="form-control @error('no_hp') is-invalid @enderror" value="{{ old('no_hp') }}" placeholder="08xxxxxxxxxx" required>
                        @error('no_hp')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="form-group">
                        <label class="form-label">Subjek *</label>
                        <select name="nama_game" class="form-control @error('nama_game') is-invalid @enderror" required>
                            <option value="" disabled {{ old('nama_game') ? '' : 'selected' }}>-- Pilih Subjek --</option>
                            <option value="Pertanyaan Umum" {{ old('nama_game') == 'Pertanyaan Umum' ? 'selected' : '' }}>Pertanyaan Umum</option>
                            <option value="Keluhan Transaksi" {{ old('nama_game') == 'Keluhan Transaksi' ? 'selected' : '' }}>Keluhan Transaksi</option>
                            <option value="Keluhan Produk" {{ old('nama_game') == 'Keluhan Produk' ? 'selected' : '' }}>Keluhan Produk</option>
                            <option value="Permintaan Refund" {{ old('nama_game') == 'Permintaan Refund' ? 'selected' : '' }}>Permintaan Refund</option>
                            <option value="Saran & Masukan" {{ old('nama_game') == 'Saran & Masukan' ? 'selected' : '' }}>Saran & Masukan</option>
                            <option value="Lainnya" {{ old('nama_game') == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                        </select>
                        @error('nama_game')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="form-group">
                        <label class="form-label">Pesan / Keluhan *</label>
                        <textarea name="deskripsi" class="form-control @error('deskripsi') is-invalid @enderror" rows="5" placeholder="Tuliskan pesan atau keluhan Anda secara detail..." required>{{ old('deskripsi') }}</textarea>
                        @error('deskripsi')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <button type="submit" class="btn btn-primary" style="width:100%;justify-content:center">
                        <i class="fas fa-paper-plane"></i> Kirim Pesan
                    </button>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection


