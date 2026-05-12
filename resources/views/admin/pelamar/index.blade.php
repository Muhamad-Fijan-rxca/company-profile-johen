@extends('admin.layout')
@section('title', 'Data Pelamar')

@section('content')
<div class="page-header">
    <h2>Data Pelamar</h2>
    <span style="color:var(--text-muted);font-size:13px">Total: {{ $pelamar->count() }} pelamar</span>
</div>

<div class="card">
    <div class="table-wrap">
        <table>
            <thead><tr><th>#</th><th>Nama</th><th>Email</th><th>No. HP</th><th>Posisi</th><th>Lowongan</th><th>Tanggal</th><th>CV</th><th>Aksi</th></tr></thead>
            <tbody>
                @forelse($pelamar as $p)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td><strong>{{ $p->nama }}</strong></td>
                    <td>{{ $p->email }}</td>
                    <td>{{ $p->no_hp }}</td>
                    <td>{{ $p->posisi }}</td>
                    <td>{{ $p->lowongan?->posisi ?? '-' }}</td>
                    <td>{{ $p->created_at->format('d M Y') }}</td>
                    <td>
                        <a href="{{ Storage::url($p->cv_file) }}" class="btn btn-secondary btn-sm" target="_blank">
                            <i class="fas fa-file-download"></i> Unduh CV
                        </a>
                    </td>
                    <td>
                        <form action="{{ route('admin.pelamar.destroy', $p) }}" method="POST" onsubmit="return confirm('Hapus data pelamar ini?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="9" style="text-align:center;color:var(--text-muted);padding:48px">Belum ada pelamar.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
