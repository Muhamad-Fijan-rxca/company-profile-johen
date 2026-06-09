@extends('layouts.app')
@section('title', $kategori)

@push('styles')
<style>
    .produk-img { width: 100%; aspect-ratio: 16/9; object-fit: cover; }
    .produk-img-placeholder { width: 100%; aspect-ratio: 16/9; background: var(--gradient); display: flex; align-items: center; justify-content: center; font-size: 56px; }
    .card-body { padding: 24px; }
    .card-body h3 { font-size: 16px; font-weight: 600; margin: 10px 0 8px; }
    .card-body p { font-size: 14px; color: var(--text-muted); line-height: 1.6; margin-bottom: 16px; }
    .card-footer { display: flex; justify-content: space-between; align-items: center; padding: 16px 24px; border-top: 1px solid var(--border); }
    .harga { font-weight: 700; color: var(--accent); font-size: 15px; }
    .empty-state { text-align: center; padding: 80px 24px; color: var(--text-muted); }
    .empty-state .icon { font-size: 64px; margin-bottom: 16px; }
</style>
@endpush

@section('content')
<div class="page-hero">
    <h1>{{ $kategori }}</h1>
    <p>Layanan {{ $kategori }} dari JOHEN GAMING.</p>
</div>

<section class="section">
    <div class="container">
        @if($produk->isEmpty())
        <div class="empty-state">
            <div class="icon">🎮</div>
            <h3>Belum ada produk</h3>
            <p>Produk untuk kategori ini belum tersedia.</p>
        </div>
        @else
        <div class="grid-3">
            @foreach($produk as $p)
            <div class="card reveal" style="transition-delay:{{ ($loop->index % 3) * 0.1 }}s">
                @if($p->gambar)
                    <img src="{{ Storage::url($p->gambar) }}" alt="{{ $p->nama }}" class="produk-img">
                @else
                    <div class="produk-img-placeholder">🎮</div>
                @endif
                <div class="card-body">
                    <span class="badge badge-primary">{{ $p->kategori }}</span>
                    <h3>{{ $p->nama }}</h3>
                    <p>{{ $p->deskripsi }}</p>
                </div>
                <div class="card-footer">
                    <span class="harga">{{ $p->harga ?? 'Hubungi Kami' }}</span>
                    <a href="{{ route('kontak') }}" class="btn btn-primary btn-sm">Pesan Sekarang</a>
                </div>
            </div>
            @endforeach
        </div>
        @endif
    </div>
</section>
@endsection