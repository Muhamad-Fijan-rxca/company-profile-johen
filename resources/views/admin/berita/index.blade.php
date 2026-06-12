@extends('admin.layout')
@section('title', 'Kelola Berita')

@section('content')
<div class="page-header">
    <h2>Kelola Berita</h2>
    <a href="{{ route('admin.berita.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Tambah Berita</a>
</div>

<div class="card">
    <div class="table-wrap">
        <table>
            <thead>
                <tr><th>#</th><th>Thumbnail</th><th>Judul</th><th>Status</th><th>Tanggal</th><th>Aksi</th></tr>
            </thead>
            <tbody>
                @forelse($berita as $b)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>
                        @if($b->thumbnail)
                            <img src="{{ str_starts_with($b->thumbnail, 'img/') ? asset($b->thumbnail) : Storage::url($b->thumbnail) }}" style="width:80px;height:50px;object-fit:cover;border-radius:6px" alt="{{ $b->judul }}">
                        @else
                            <div style="width:80px;height:50px;background:var(--bg);border-radius:6px;display:flex;align-items:center;justify-content:center;font-size:20px">📰</div>
                        @endif
                    </td>
                    <td>
                        <strong>{{ Str::limit($b->judul, 60) }}</strong>
                        <div style="font-size:11px;color:var(--text-muted);margin-top:2px">/berita/{{ $b->slug }}</div>
                    </td>
                    <td>@if($b->aktif)<span class="badge badge-success">Aktif</span>@else<span class="badge badge-danger">Draft</span>@endif</td>
                    <td>{{ $b->created_at->format('d M Y') }}</td>
                    <td>
                        <div style="display:flex;gap:6px">
                            <a href="{{ route('berita.show', $b->slug) }}" class="btn btn-secondary btn-sm" target="_blank"><i class="fas fa-eye"></i></a>
                            <a href="{{ route('admin.berita.edit', $b) }}" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
                            <form action="{{ route('admin.berita.destroy', $b) }}" method="POST" onsubmit="return confirm('Hapus berita ini?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="6" style="text-align:center;color:var(--text-muted);padding:48px">Belum ada berita.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
