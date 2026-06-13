@extends('admin.layout')
@section('title', 'Kelola Sosial Media')

@section('content')
<div class="page-header">
    <h2>Kelola Sosial Media</h2>
    <a href="{{ route('admin.sosmed.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Tambah Akun</a>
</div>

<div class="card">
    <div class="table-wrap">
        <table>
            <thead>
                <tr><th>#</th><th>Platform</th><th>Nama Akun</th><th>Username</th><th>Followers</th><th>Urutan</th><th>Status</th><th>Aksi</th></tr>
            </thead>
            <tbody>
                @forelse($sosmed as $s)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>
                        @if($s->platform === 'ig')
                            <span style="color:#E1306C"><i class="fab fa-instagram"></i> Instagram</span>
                        @else
                            <span style="color:#25F4EE"><i class="fab fa-tiktok"></i> TikTok</span>
                        @endif
                    </td>
                    <td><strong>{{ $s->name }}</strong></td>
                    <td>{{ $s->username }}</td>
                    <td>{{ $s->followers }}</td>
                    <td>{{ $s->urutan }}</td>
                    <td>
                        @if($s->aktif)<span class="badge badge-success">Aktif</span>@else<span class="badge badge-danger">Nonaktif</span>@endif
                    </td>
                    <td>
                        <div style="display:flex;gap:6px">
                            <a href="{{ route('admin.sosmed.edit', $s) }}" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
                            <form action="{{ route('admin.sosmed.destroy', $s) }}" method="POST" onsubmit="return confirm('Hapus akun ini?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="8" style="text-align:center;color:var(--text-muted);padding:48px">Belum ada akun sosial media.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
