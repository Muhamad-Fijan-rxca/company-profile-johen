@extends('admin.layout')
@section('title', 'Pesan Kontak')

@section('content')
<div class="page-header">
    <h2>Pesan Kontak</h2>
    <div style="display:flex;gap:8px">
        <a href="{{ route('admin.pesan.index') }}" class="btn {{ !request('tujuan') ? 'btn-primary' : 'btn-secondary' }} btn-sm">Semua</a>
        <a href="{{ route('admin.pesan.index') }}?tujuan=jual" class="btn {{ request('tujuan') === 'jual' ? 'btn-primary' : 'btn-secondary' }} btn-sm">Jual Akun</a>
        <a href="{{ route('admin.pesan.index') }}?tujuan=beli" class="btn {{ request('tujuan') === 'beli' ? 'btn-primary' : 'btn-secondary' }} btn-sm">Beli Akun</a>
    </div>
</div>

<div class="card">
    <div class="table-wrap">
        <table>
            <thead><tr><th>#</th><th>Nama</th><th>Email</th><th>No. HP</th><th>Tujuan</th><th>Status</th><th>Waktu</th><th>Aksi</th></tr></thead>
            <tbody>
                @forelse($pesan as $p)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>
                        @if(!$p->sudah_dibaca)<span style="display:inline-block;width:8px;height:8px;background:#ef4444;border-radius:50%;margin-right:6px"></span>@endif
                        <strong>{{ $p->nama }}</strong>
                    </td>
                    <td>{{ $p->email }}</td>
                    <td>{{ $p->no_hp }}</td>
                    <td><span class="badge {{ $p->tujuan === 'jual' ? 'badge-warning' : 'badge-primary' }}">{{ strtoupper($p->tujuan) }}</span></td>
                    <td>@if($p->sudah_dibaca)<span class="badge badge-success">Dibaca</span>@else<span class="badge badge-danger">Baru</span>@endif</td>
                    <td>{{ $p->created_at->format('d M Y H:i') }}</td>
                    <td>
                        <div style="display:flex;gap:6px">
                            <a href="{{ route('admin.pesan.show', $p) }}" class="btn btn-secondary btn-sm"><i class="fas fa-eye"></i></a>
                            <form action="{{ route('admin.pesan.destroy', $p) }}" method="POST" onsubmit="return confirm('Hapus pesan ini?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="8" style="text-align:center;color:var(--text-muted);padding:48px">Belum ada pesan.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
