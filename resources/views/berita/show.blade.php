@extends('layouts.app')
@section('title', $berita->judul)

@push('styles')
<style>
    .article-wrap { max-width: 800px; margin: 0 auto; }
    .article-header { margin-bottom: 32px; }
    .article-header h1 { font-size: clamp(24px, 4vw, 40px); font-weight: 800; line-height: 1.2; margin-bottom: 16px; }
    .article-meta { display: flex; align-items: center; gap: 16px; color: var(--text-muted); font-size: 14px; }
    .article-thumbnail { width: 100%; aspect-ratio: 16/9; object-fit: cover; border-radius: var(--radius); margin-bottom: 32px; }
    .article-thumbnail-placeholder { width: 100%; aspect-ratio: 16/9; background: var(--gradient); border-radius: var(--radius); display: flex; align-items: center; justify-content: center; font-size: 80px; margin-bottom: 32px; }
    .article-body { font-size: 16px; line-height: 1.9; color: var(--text); }
    .article-body p { margin-bottom: 20px; }
    .article-body h2, .article-body h3 { font-weight: 700; margin: 32px 0 16px; }
    .article-body strong { color: var(--primary); }
    .sidebar-title { font-size: 16px; font-weight: 700; margin-bottom: 20px; padding-bottom: 12px; border-bottom: 2px solid var(--border); }
    .sidebar-berita { display: flex; gap: 12px; margin-bottom: 16px; text-decoration: none; color: var(--text); }
    .sidebar-berita:hover h4 { color: var(--primary); }
    .sidebar-berita .thumb { width: 72px; height: 56px; border-radius: 8px; object-fit: cover; flex-shrink: 0; background: var(--gradient); display: flex; align-items: center; justify-content: center; font-size: 20px; }
    .sidebar-berita h4 { font-size: 13px; font-weight: 600; line-height: 1.4; margin-bottom: 4px; transition: color 0.2s; }
    .sidebar-berita span { font-size: 11px; color: var(--text-muted); }
    .article-layout { display: grid; grid-template-columns: 1fr 300px; gap: 48px; align-items: start; }
    @media(max-width:768px) { 
        .article-layout { grid-template-columns: 1fr; }
        .article-header h1 { font-size: clamp(20px, 6vw, 32px); }
        .article-body { font-size: 15px; }
    }
</style>
@endpush

@section('content')
<section class="section" style="background:var(--bg)">
    <div class="container">
        <div style="margin-bottom:24px">
            <a href="{{ route('berita') }}" style="color:var(--primary);text-decoration:none;font-size:14px;font-weight:500"><i class="fas fa-arrow-left"></i> Kembali ke Berita</a>
        </div>
        <div class="article-layout">
            <article>
                <div class="article-header">
                    <h1>{{ $berita->judul }}</h1>
                    <div class="article-meta">
                        <span><i class="fas fa-calendar-alt"></i> {{ $berita->created_at->format('d M Y') }}</span>
                        <span><i class="fas fa-clock"></i> {{ $berita->created_at->diffForHumans() }}</span>
                    </div>
                </div>
                @if($berita->thumbnail)
                    <img src="{{ Storage::url($berita->thumbnail) }}" alt="{{ $berita->judul }}" class="article-thumbnail">
                @else
                    <div class="article-thumbnail-placeholder">📰</div>
                @endif
                <div class="article-body">{!! $berita->isi !!}</div>
            </article>

            <aside>
                <div class="card" style="padding:24px;position:sticky;top:96px">
                    <div class="sidebar-title">Berita Lainnya</div>
                    @foreach($lainnya as $l)
                    <a href="{{ route('berita.show', $l->slug) }}" class="sidebar-berita">
                        @if($l->thumbnail)
                            <img src="{{ Storage::url($l->thumbnail) }}" alt="{{ $l->judul }}" class="thumb" style="border-radius:8px">
                        @else
                            <div class="thumb">📰</div>
                        @endif
                        <div>
                            <h4>{{ Str::limit($l->judul, 60) }}</h4>
                            <span>{{ $l->created_at->format('d M Y') }}</span>
                        </div>
                    </a>
                    @endforeach
                    <div style="margin-top:20px">
                        <a href="{{ route('berita') }}" class="btn btn-outline" style="width:100%;justify-content:center">Semua Berita</a>
                    </div>
                </div>
            </aside>
        </div>
    </div>
</section>
@endsection
