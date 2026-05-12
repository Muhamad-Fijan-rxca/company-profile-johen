@extends('admin.layout')
@section('title', 'Kelola Lowongan')

@section('content')
<div class="page-header">
    <h2>Kelola Lowongan</h2>
    <a href="{{ route('admin.lowongan.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Tambah Lowongan</a>
</div>

<div class="card">
    <div class="table-wrap">
        <table>
            <thead><tr><th>#</th><th>Posisi</th><th>Departemen</th><th>Tipe</th><th>Status</th><th>Tanggal</th><th>Aksi</th></tr></thead>
            <tbody>
                @forelse($lowongan as $l)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td><strong>{{ $l->posisi }}</strong></td>
                    <td>{{ $l->departemen }}</td>
                    <td><span class="badge badge-primary">{{ $l->tipe }}</span></td>
                    <td>@if($l->aktif)<span class="badge badge-success">Aktif</span>@else<span class="badge badge-danger">Nonaktif</span>@endif</td>
                    <td>{{ $l->created_at->format('d M Y') }}</td>
                    <td>
                        <div style="display:flex;gap:6px">
                            <a href="{{ route('admin.lowongan.edit', $l) }}" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
                            <form action="{{ route('admin.lowongan.destroy', $l) }}" method="POST" onsubmit="return confirm('Hapus lowongan ini?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="7" style="text-align:center;color:var(--text-muted);padding:48px">Belum ada lowongan.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
