@extends('layouts.app')
@section('title', 'Johen News')

@push('styles')
<style>
    .berita-img { width: 100%; aspect-ratio: 16/9; object-fit: cover; }
    .berita-img-placeholder { width: 100%; aspect-ratio: 16/9; background: var(--gradient); display: flex; align-items: center; justify-content: center; font-size: 56px; }
    .card-body { padding: 24px; }
    .card-meta { font-size: 12px; color: var(--text-muted); margin-bottom: 10px; display: flex; align-items: center; gap: 8px; }
    .card-body h3 { font-size: 16px; font-weight: 600; margin-bottom: 10px; line-height: 1.4; }
    .card-body p { font-size: 14px; color: var(--text-muted); margin-bottom: 16px; line-height: 1.6; }
    .read-more { font-size: 13px; font-weight: 600; color: var(--primary); text-decoration: none; display: inline-flex; align-items: center; gap: 6px; transition: gap 0.2s; }
    .read-more:hover { gap: 10px; }
    .pagination-wrap { display: flex; justify-content: center; margin-top: 48px; gap: 8px; }
    .pagination-wrap a, .pagination-wrap span { padding: 8px 16px; border-radius: 8px; font-size: 14px; font-weight: 500; text-decoration: none; border: 1.5px solid var(--border); color: var(--text-muted); transition: all 0.2s; }
    .pagination-wrap a:hover { border-color: var(--primary); color: var(--primary); }
    .pagination-wrap .active { background: var(--gradient); color: white; border-color: transparent; }
</style>
@endpush

@section('content')
<div class="page-hero">
    <h1>Johen News</h1>
    <p>Berita terkini seputar dunia gaming dan update dari PT Johen Gaming.</p>
</div>

<section class="section">
    <div class="container">
        @if($berita->isEmpty())
        <div style="text-align:center;padding:80px;color:var(--text-muted)">
            <div style="font-size:64px;margin-bottom:16px">📰</div>
            <h3>Belum ada berita</h3>
        </div>
        @else
        <div class="grid-3">
            @foreach($berita as $b)
            <div class="card reveal" style="transition-delay:{{ ($loop->index % 3) * 0.1 }}s">
                @if($b->thumbnail)
                    <img src="{{ Storage::url($b->thumbnail) }}" alt="{{ $b->judul }}" class="berita-img">
                @else
                    <div class="berita-img-placeholder">📰</div>
                @endif
                <div class="card-body">
                    <div class="card-meta"><i class="fas fa-calendar-alt"></i> {{ $b->created_at->format('d M Y') }}</div>
                    <h3>{{ $b->judul }}</h3>
                    <p>{{ $b->ringkasan }}</p>
                    <a href="{{ route('berita.show', $b->slug) }}" class="read-more">Baca Selengkapnya <i class="fas fa-arrow-right"></i></a>
                </div>
            </div>
            @endforeach
        </div>
        <div class="pagination-wrap">
            {{ $berita->links('vendor.pagination.simple') }}
        </div>
        @endif
    </div>
</section>
@endsection
