@extends('admin.layout')
@section('title', 'Kelola Produk')

@section('content')
<div class="page-header">
    <h2>Kelola Produk</h2>
    <a href="{{ route('admin.produk.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Tambah Produk</a>
</div>

<div class="card">
    <div class="table-wrap">
        <table>
            <thead>
                <tr><th>#</th><th>Gambar</th><th>Nama</th><th>Kategori</th><th>Harga</th><th>Urutan</th><th>Status</th><th>Aksi</th></tr>
            </thead>
            <tbody>
                @forelse($produk as $p)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>
                        @if($p->gambar)
                            <img src="{{ Storage::url($p->gambar) }}" style="width:60px;height:40px;object-fit:cover;border-radius:6px" alt="{{ $p->nama }}">
                        @else
                            <div style="width:60px;height:40px;background:var(--bg);border-radius:6px;display:flex;align-items:center;justify-content:center;font-size:20px">🎮</div>
                        @endif
                    </td>
                    <td><strong>{{ $p->nama }}</strong></td>
                    <td><span class="badge badge-primary">{{ $p->kategori }}</span></td>
                    <td>{{ $p->harga ?? '-' }}</td>
                    <td>{{ $p->urutan }}</td>
                    <td>
                        @if($p->aktif)<span class="badge badge-success">Aktif</span>@else<span class="badge badge-danger">Nonaktif</span>@endif
                        @if($p->unggulan)<span class="badge badge-warning" style="margin-left:4px">Unggulan</span>@endif
                    </td>
                    <td>
                        <div style="display:flex;gap:6px">
                            <a href="{{ route('admin.produk.edit', $p) }}" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
                            <form action="{{ route('admin.produk.destroy', $p) }}" method="POST" onsubmit="return confirm('Hapus produk ini?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="8" style="text-align:center;color:var(--text-muted);padding:48px">Belum ada produk. <a href="{{ route('admin.produk.create') }}">Tambah sekarang</a></td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
