@extends('admin.layout')
@section('title', 'Kelola Konten Digital')

@section('content')
<div class="page-header">
    <h2>Kelola Konten Digital</h2>
    <a href="{{ route('admin.konten-digital.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Tambah Konten</a>
</div>

<div class="card">
    <div class="table-wrap">
        <table>
            <thead>
                <tr><th>#</th><th>Gambar</th><th>Judul</th><th>Kategori</th><th>Urutan</th><th>Status</th><th>Aksi</th></tr>
            </thead>
            <tbody>
                @forelse($konten as $k)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>
                        @if($k->gambar)
                            <img src="{{ Storage::url($k->gambar) }}" style="width:70px;height:44px;object-fit:cover;border-radius:6px" alt="{{ $k->judul }}">
                        @else
                            <div style="width:70px;height:44px;background:var(--bg);border-radius:6px;display:flex;align-items:center;justify-content:center;font-size:20px">
                                {{ $k->kategori === 'Live Commerce' ? '📺' : '🎬' }}
                            </div>
                        @endif
                    </td>
                    <td><strong>{{ $k->judul }}</strong></td>
                    <td>
                        <span class="badge {{ $k->kategori === 'Live Commerce' ? 'badge-warning' : 'badge-primary' }}">
                            {{ $k->kategori }}
                        </span>
                    </td>
                    <td>{{ $k->urutan }}</td>
                    <td>
                        @if($k->aktif)<span class="badge badge-success">Aktif</span>@else<span class="badge badge-danger">Nonaktif</span>@endif
                        @if($k->unggulan)<span class="badge badge-warning" style="margin-left:4px">Unggulan</span>@endif
                    </td>
                    <td>
                        <div style="display:flex;gap:6px">
                            <a href="{{ route('admin.konten-digital.edit', $k) }}" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
                            <form action="{{ route('admin.konten-digital.destroy', $k) }}" method="POST" onsubmit="return confirm('Hapus konten ini?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="7" style="text-align:center;color:var(--text-muted);padding:48px">Belum ada konten digital.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
