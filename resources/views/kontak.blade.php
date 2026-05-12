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
    .form-tabs { display: flex; gap: 0; margin-bottom: 32px; border-radius: 12px; overflow: hidden; border: 2px solid var(--border); }
    .form-tab { flex: 1; padding: 14px; text-align: center; font-size: 14px; font-weight: 600; cursor: pointer; border: none; background: white; color: var(--text-muted); transition: all 0.2s; }
    .form-tab.active { background: var(--gradient); color: white; }
    .form-panel { display: none; }
    .form-panel.active { display: block; }
    .form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; }
    @media(max-width:768px) { .kontak-grid { grid-template-columns: 1fr; } .form-row { grid-template-columns: 1fr; } }
</style>
@endpush

@section('content')
<div class="page-hero">
    <h1>Hubungi Kami</h1>
    <p>Ada pertanyaan atau ingin bertransaksi? Kami siap membantu Anda.</p>
</div>

{{-- BAGIAN 1: CONTACT PT --}}
<section class="section" style="background:white">
    <div class="container">
        <div class="section-header reveal">
            <span class="section-tag">Contact PT</span>
            <h2 class="section-title">Informasi Perusahaan</h2>
            <p class="section-subtitle">Temukan kami di sini atau kunjungi kantor kami langsung.</p>
        </div>
        <div class="kontak-grid">
            <div class="reveal">
                <div class="info-item">
                    <div class="info-icon"><i class="fas fa-map-marker-alt"></i></div>
                    <div>
                        <h4>Alamat Kantor</h4>
                        <p>Jl. Gaming No. 1, Kebayoran Baru,<br>Jakarta Selatan, DKI Jakarta 12345</p>
                    </div>
                </div>
                <div class="info-item">
                    <div class="info-icon"><i class="fas fa-envelope"></i></div>
                    <div>
                        <h4>Email Resmi</h4>
                        <p>info@johengaming.com<br>support@johengaming.com</p>
                    </div>
                </div>
                <div class="info-item">
                    <div class="info-icon"><i class="fab fa-whatsapp"></i></div>
                    <div>
                        <h4>WhatsApp / Telepon</h4>
                        <p>+62 812-3456-7890<br>+62 821-9876-5432</p>
                    </div>
                </div>
                <div class="info-item">
                    <div class="info-icon"><i class="fas fa-clock"></i></div>
                    <div>
                        <h4>Jam Operasional</h4>
                        <p>Senin – Jumat: 09.00 – 21.00 WIB<br>Sabtu: 10.00 – 18.00 WIB</p>
                    </div>
                </div>
            </div>
            <div class="reveal" style="transition-delay:0.1s">
                <div class="map-wrap">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.0!2d106.7975!3d-6.2297!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zNsKwMTMnNDYuOSJTIDEwNsKwNDcnNTEuMCJF!5e0!3m2!1sid!2sid!4v1234567890"
                        allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"
                        title="Lokasi PT Johen Gaming">
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
            <h2 class="section-title">Kirim Pesan</h2>
            <p class="section-subtitle">Pilih tujuan pesan Anda dan isi form di bawah ini.</p>
        </div>

        <div style="max-width:680px;margin:0 auto" class="reveal">
            @if(session('success'))
            <div class="alert alert-success"><i class="fas fa-check-circle"></i> {{ session('success') }}</div>
            @endif

            <div class="card" style="padding:40px">
                <div class="form-tabs">
                    <button class="form-tab active" id="tabJual" onclick="switchTab('jual')">
                        <i class="fas fa-tag"></i> Saya ingin MENJUAL Akun
                    </button>
                    <button class="form-tab" id="tabBeli" onclick="switchTab('beli')">
                        <i class="fas fa-shopping-cart"></i> Saya ingin MEMBELI Akun
                    </button>
                </div>

                {{-- FORM JUAL --}}
                <div class="form-panel active" id="panelJual">
                    <form action="{{ route('kontak.kirim') }}" method="POST">
                        @csrf
                        <input type="hidden" name="tujuan" value="jual">
                        <div class="form-row">
                            <div class="form-group">
                                <label class="form-label">Nama Lengkap *</label>
                                <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror" value="{{ old('nama') }}" required>
                                @error('nama')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="form-group">
                                <label class="form-label">Email *</label>
                                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required>
                                @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-label">No. HP / WhatsApp *</label>
                            <input type="text" name="no_hp" class="form-control @error('no_hp') is-invalid @enderror" value="{{ old('no_hp') }}" required>
                            @error('no_hp')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="form-row">
                            <div class="form-group">
                                <label class="form-label">Nama Game *</label>
                                <input type="text" name="nama_game" class="form-control @error('nama_game') is-invalid @enderror" value="{{ old('nama_game') }}" placeholder="cth: Mobile Legends" required>
                                @error('nama_game')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="form-group">
                                <label class="form-label">Level / Rank Akun *</label>
                                <input type="text" name="level_akun" class="form-control @error('level_akun') is-invalid @enderror" value="{{ old('level_akun') }}" placeholder="cth: Mythic 500 Stars" required>
                                @error('level_akun')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Harga Harapan *</label>
                            <input type="text" name="harga_harapan" class="form-control @error('harga_harapan') is-invalid @enderror" value="{{ old('harga_harapan') }}" placeholder="cth: Rp 500.000" required>
                            @error('harga_harapan')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="form-group">
                            <label class="form-label">Deskripsi Akun *</label>
                            <textarea name="deskripsi" class="form-control @error('deskripsi') is-invalid @enderror" placeholder="Jelaskan detail akun Anda (hero, skin, dll)" required>{{ old('deskripsi') }}</textarea>
                            @error('deskripsi')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <button type="submit" class="btn btn-primary" style="width:100%;justify-content:center">
                            <i class="fas fa-paper-plane"></i> Kirim Penawaran
                        </button>
                    </form>
                </div>

                {{-- FORM BELI --}}
                <div class="form-panel" id="panelBeli">
                    <form action="{{ route('kontak.kirim') }}" method="POST">
                        @csrf
                        <input type="hidden" name="tujuan" value="beli">
                        <div class="form-row">
                            <div class="form-group">
                                <label class="form-label">Nama Lengkap *</label>
                                <input type="text" name="nama" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Email *</label>
                                <input type="email" name="email" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-label">No. HP / WhatsApp *</label>
                            <input type="text" name="no_hp" class="form-control" required>
                        </div>
                        <div class="form-row">
                            <div class="form-group">
                                <label class="form-label">Game yang Dicari *</label>
                                <input type="text" name="game_dicari" class="form-control" placeholder="cth: PUBG Mobile" required>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Budget Maksimal *</label>
                                <input type="text" name="budget_maksimal" class="form-control" placeholder="cth: Rp 300.000" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Request Khusus</label>
                            <textarea name="request_khusus" class="form-control" placeholder="Spesifikasi akun yang Anda inginkan (rank, hero, skin, dll)"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary" style="width:100%;justify-content:center">
                            <i class="fas fa-search"></i> Kirim Permintaan
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script>
    function switchTab(tab) {
        document.querySelectorAll('.form-tab').forEach(t => t.classList.remove('active'));
        document.querySelectorAll('.form-panel').forEach(p => p.classList.remove('active'));
        document.getElementById('tab' + tab.charAt(0).toUpperCase() + tab.slice(1)).classList.add('active');
        document.getElementById('panel' + tab.charAt(0).toUpperCase() + tab.slice(1)).classList.add('active');
    }
</script>
@endpush
