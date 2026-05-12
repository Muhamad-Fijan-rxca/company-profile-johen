@extends('admin.layout')
@section('title', 'Dashboard')

@section('content')
<div class="stats-grid">
    <div class="stat-card">
        <div class="stat-icon" style="background:rgba(43,89,195,0.1)">🎮</div>
        <div class="stat-info"><span class="num">{{ $stats['produk'] }}</span><span class="label">Total Produk</span></div>
    </div>
    <div class="stat-card">
        <div class="stat-icon" style="background:rgba(139,92,246,0.1)">📰</div>
        <div class="stat-info"><span class="num">{{ $stats['berita'] }}</span><span class="label">Total Berita</span></div>
    </div>
    <div class="stat-card">
        <div class="stat-icon" style="background:rgba(16,185,129,0.1)">💼</div>
        <div class="stat-info"><span class="num">{{ $stats['lowongan'] }}</span><span class="label">Lowongan Aktif</span></div>
    </div>
    <div class="stat-card">
        <div class="stat-icon" style="background:rgba(239,68,68,0.1)">✉️</div>
        <div class="stat-info">
            <span class="num">{{ $stats['pesan'] }}</span>
            <span class="label">Pesan Masuk @if($stats['pesan_baru'] > 0)<span style="color:#ef4444;font-weight:700">({{ $stats['pesan_baru'] }} baru)</span>@endif</span>
        </div>
    </div>
</div>

<div style="display:grid;grid-template-columns:1fr 1fr;gap:24px">
    {{-- PESAN TERBARU --}}
    <div class="card">
        <div class="card-header">
            <h3>Pesan Terbaru</h3>
            <a href="{{ route('admin.pesan.index') }}" class="btn btn-secondary btn-sm">Lihat Semua</a>
        </div>
        <div class="table-wrap">
            <table>
                <thead><tr><th>Nama</th><th>Tujuan</th><th>Waktu</th><th></th></tr></thead>
                <tbody>
                    @forelse($pesanTerbaru as $p)
                    <tr>
                        <td>
                            @if(!$p->sudah_dibaca)<span style="display:inline-block;width:8px;height:8px;background:#ef4444;border-radius:50%;margin-right:6px"></span>@endif
                            {{ $p->nama }}
                        </td>
                        <td><span class="badge {{ $p->tujuan === 'jual' ? 'badge-warning' : 'badge-primary' }}">{{ strtoupper($p->tujuan) }}</span></td>
                        <td>{{ $p->created_at->diffForHumans() }}</td>
                        <td><a href="{{ route('admin.pesan.show', $p) }}" class="btn btn-secondary btn-sm">Detail</a></td>
                    </tr>
                    @empty
                    <tr><td colspan="4" style="text-align:center;color:var(--text-muted);padding:32px">Belum ada pesan</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- PELAMAR TERBARU --}}
    <div class="card">
        <div class="card-header">
            <h3>Pelamar Terbaru</h3>
            <a href="{{ route('admin.pelamar.index') }}" class="btn btn-secondary btn-sm">Lihat Semua</a>
        </div>
        <div class="table-wrap">
            <table>
                <thead><tr><th>Nama</th><th>Posisi</th><th>Waktu</th></tr></thead>
                <tbody>
                    @forelse($pelamarTerbaru as $p)
                    <tr>
                        <td>{{ $p->nama }}</td>
                        <td>{{ $p->posisi }}</td>
                        <td>{{ $p->created_at->diffForHumans() }}</td>
                    </tr>
                    @empty
                    <tr><td colspan="3" style="text-align:center;color:var(--text-muted);padding:32px">Belum ada pelamar</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
