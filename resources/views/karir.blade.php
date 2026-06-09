@extends('layouts.app')
@section('title', 'Karir')

@push('styles')
<style>
    .lowongan-card { padding: 32px; display: flex; justify-content: space-between; align-items: flex-start; gap: 24px; }
    .lowongan-info h3 { font-size: 18px; font-weight: 700; margin-bottom: 8px; }
    .lowongan-meta { display: flex; gap: 12px; flex-wrap: wrap; margin-bottom: 12px; }
    .lowongan-meta span { font-size: 13px; color: var(--text-muted); display: flex; align-items: center; gap: 6px; }
    .lowongan-desc { font-size: 14px; color: var(--text-muted); line-height: 1.6; max-width: 600px; }
    .lowongan-action { flex-shrink: 0; }
    .modal-overlay { display: none; position: fixed; inset: 0; background: rgba(0,0,0,0.5); z-index: 2000; align-items: center; justify-content: center; padding: 24px; }
    .modal-overlay.open { display: flex; }
    .modal { background: var(--white); border-radius: var(--radius); padding: 40px; max-width: 560px; width: 100%; max-height: 90vh; overflow-y: auto; position: relative; }
    .modal-close { position: absolute; top: 16px; right: 16px; background: none; border: none; font-size: 20px; cursor: pointer; color: var(--text-muted); padding: 8px; border-radius: 8px; }
    .modal-close:hover { background: var(--bg); }
    .modal h2 { font-size: 22px; font-weight: 700; margin-bottom: 8px; }
    .modal .posisi-badge { margin-bottom: 24px; }
    @media(max-width:768px) { 
        .lowongan-card { flex-direction: column; gap: 16px; padding: 24px 20px; }
        .lowongan-action { width: 100%; }
        .lowongan-action .btn { width: 100%; justify-content: center; }
        .modal { padding: 28px 20px; }
    }
</style>
@endpush

@section('content')
<div class="page-hero">
    <h1>Karir di JOHEN GAMING</h1>
    <p>Bergabunglah dengan tim profesional PT. Johen Sukses Abadi dan jadilah bagian dari industri digital gaming commerce Indonesia.</p>
</div>

<section class="section">
    <div class="container">
        @if(session('success'))
        <div class="alert alert-success"><i class="fas fa-check-circle"></i> {{ session('success') }}</div>
        @endif

        @if($lowongan->isEmpty())
        <div style="text-align:center;padding:80px;color:var(--text-muted)">
            <div style="font-size:64px;margin-bottom:16px">💼</div>
            <h3>Belum ada lowongan aktif</h3>
            <p>Pantau terus halaman ini untuk update lowongan terbaru.</p>
        </div>
        @else
        <div style="display:flex;flex-direction:column;gap:16px">
            @foreach($lowongan as $l)
            <div class="card lowongan-card reveal">
                <div class="lowongan-info">
                    <h3>{{ $l->posisi }}</h3>
                    <div class="lowongan-meta">
                        <span><i class="fas fa-building"></i> {{ $l->departemen }}</span>
                        <span><i class="fas fa-briefcase"></i> {{ $l->tipe }}</span>
                        <span><i class="fas fa-map-marker-alt"></i> Bandung</span>
                    </div>
                    <p class="lowongan-desc">{{ Str::limit($l->deskripsi, 180) }}</p>
                </div>
                <div class="lowongan-action">
                    <button class="btn btn-primary" onclick="openModal({{ $l->id }}, '{{ addslashes($l->posisi) }}')">
                        <i class="fas fa-paper-plane"></i> Lamar
                    </button>
                </div>
            </div>
            @endforeach
        </div>
        @endif
    </div>
</section>

{{-- MODAL LAMARAN --}}
<div class="modal-overlay" id="modalOverlay">
    <div class="modal">
        <button class="modal-close" onclick="closeModal()"><i class="fas fa-times"></i></button>
        <h2>Form Lamaran</h2>
        <div class="posisi-badge"><span class="badge badge-primary" id="modalPosisi"></span></div>

        <form action="{{ route('karir.lamar') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="lowongan_id" id="modalLowonganId">
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
            <div class="form-group">
                <label class="form-label">No. HP / WhatsApp *</label>
                <input type="text" name="no_hp" class="form-control @error('no_hp') is-invalid @enderror" value="{{ old('no_hp') }}" required>
                @error('no_hp')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="form-group">
                <label class="form-label">Posisi yang Dilamar *</label>
                <input type="text" name="posisi" id="modalPosisiInput" class="form-control" readonly>
            </div>
            <div class="form-group">
                <label class="form-label">Upload CV (PDF/DOC, maks 2MB) *</label>
                <input type="file" name="cv" class="form-control @error('cv') is-invalid @enderror" accept=".pdf,.doc,.docx" required>
                @error('cv')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <button type="submit" class="btn btn-primary" style="width:100%;justify-content:center">
                <i class="fas fa-paper-plane"></i> Kirim Lamaran
            </button>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
    function openModal(id, posisi) {
        document.getElementById('modalLowonganId').value = id;
        document.getElementById('modalPosisi').textContent = posisi;
        document.getElementById('modalPosisiInput').value = posisi;
        document.getElementById('modalOverlay').classList.add('open');
        document.body.style.overflow = 'hidden';
    }
    function closeModal() {
        document.getElementById('modalOverlay').classList.remove('open');
        document.body.style.overflow = '';
    }
    document.getElementById('modalOverlay').addEventListener('click', function(e) {
        if (e.target === this) closeModal();
    });
    @if($errors->any())
        @foreach($lowongan as $l)
            @if(old('lowongan_id') == $l->id)
                openModal({{ $l->id }}, '{{ addslashes($l->posisi) }}');
            @endif
        @endforeach
    @endif
</script>
@endpush
