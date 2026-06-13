@extends('admin.layout')
@section('title', 'Kelola Partner')

@section('content')
<div class="page-header">
    <h2>Kelola Partner</h2>
    <a href="{{ route('admin.partner.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Tambah Partner</a>
</div>

<div class="card">
    <div class="table-wrap">
        <table>
            <thead>
                <tr><th>#</th><th>Gambar</th><th>Nama</th><th>Role</th><th>Followers</th><th>Urutan</th><th>Status</th><th>Aksi</th></tr>
            </thead>
            <tbody>
                @forelse($partners as $k)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>
                        @if($k->gambar)
                            <img src="{{ Storage::url($k->gambar) }}" style="width:70px;height:44px;object-fit:cover;border-radius:6px" alt="{{ $k->judul }}">
                        @else
                            <div style="width:70px;height:44px;background:var(--bg);border-radius:6px;display:flex;align-items:center;justify-content:center;font-size:20px">🤝</div>
                        @endif
                    </td>
                    <td><strong>{{ $k->judul }}</strong></td>
                    <td>{{ $k->role ?? '-' }}</td>
                    <td>{{ $k->followers ?? '-' }}</td>
                    <td>{{ $k->urutan }}</td>
                    <td>
                        @if($k->aktif)<span class="badge badge-success">Aktif</span>@else<span class="badge badge-danger">Nonaktif</span>@endif
                    </td>
                    <td>
                        <div style="display:flex;gap:6px">
                            <a href="{{ route('admin.partner.edit', $k) }}" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
                            <form action="{{ route('admin.partner.destroy', $k) }}" method="POST" onsubmit="return confirm('Hapus partner ini?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="8" style="text-align:center;color:var(--text-muted);padding:48px">Belum ada partner.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
