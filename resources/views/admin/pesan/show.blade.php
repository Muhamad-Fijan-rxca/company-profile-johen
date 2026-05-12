@extends('admin.layout')
@section('title', 'Detail Pesan')

@section('content')
<div class="page-header">
    <h2>Detail Pesan</h2>
    <a href="{{ route('admin.pesan.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Kembali</a>
</div>

<div style="max-width:640px">
    <div class="card">
        <div class="card-header">
            <div>
                <span class="badge {{ $pesan->tujuan === 'jual' ? 'badge-warning' : 'badge-primary' }}" style="font-size:13px;padding:6px 14px">
                    {{ $pesan->tujuan === 'jual' ? '🏷️ Ingin MENJUAL Akun' : '🛒 Ingin MEMBELI Akun' }}
                </span>
            </div>
            <span style="font-size:12px;color:var(--text-muted)">{{ $pesan->created_at->format('d M Y, H:i') }} WIB</span>
        </div>
        <div class="card-body">
            <table style="width:100%;border-collapse:collapse">
                <tr style="border-bottom:1px solid var(--border)">
                    <td style="padding:12px 0;font-weight:600;width:40%;color:var(--text-muted);font-size:13px">Nama</td>
                    <td style="padding:12px 0;font-size:14px">{{ $pesan->nama }}</td>
                </tr>
                <tr style="border-bottom:1px solid var(--border)">
                    <td style="padding:12px 0;font-weight:600;color:var(--text-muted);font-size:13px">Email</td>
                    <td style="padding:12px 0;font-size:14px"><a href="mailto:{{ $pesan->email }}" style="color:var(--primary)">{{ $pesan->email }}</a></td>
                </tr>
                <tr style="border-bottom:1px solid var(--border)">
                    <td style="padding:12px 0;font-weight:600;color:var(--text-muted);font-size:13px">No. HP</td>
                    <td style="padding:12px 0;font-size:14px"><a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $pesan->no_hp) }}" target="_blank" style="color:var(--primary)">{{ $pesan->no_hp }}</a></td>
                </tr>

                @if($pesan->tujuan === 'jual')
                <tr style="border-bottom:1px solid var(--border)">
                    <td style="padding:12px 0;font-weight:600;color:var(--text-muted);font-size:13px">Nama Game</td>
                    <td style="padding:12px 0;font-size:14px">{{ $pesan->nama_game }}</td>
                </tr>
                <tr style="border-bottom:1px solid var(--border)">
                    <td style="padding:12px 0;font-weight:600;color:var(--text-muted);font-size:13px">Level / Rank</td>
                    <td style="padding:12px 0;font-size:14px">{{ $pesan->level_akun }}</td>
                </tr>
                <tr style="border-bottom:1px solid var(--border)">
                    <td style="padding:12px 0;font-weight:600;color:var(--text-muted);font-size:13px">Harga Harapan</td>
                    <td style="padding:12px 0;font-size:14px;font-weight:700;color:var(--primary)">{{ $pesan->harga_harapan }}</td>
                </tr>
                <tr>
                    <td style="padding:12px 0;font-weight:600;color:var(--text-muted);font-size:13px;vertical-align:top">Deskripsi</td>
                    <td style="padding:12px 0;font-size:14px;line-height:1.7">{{ $pesan->deskripsi }}</td>
                </tr>
                @else
                <tr style="border-bottom:1px solid var(--border)">
                    <td style="padding:12px 0;font-weight:600;color:var(--text-muted);font-size:13px">Game Dicari</td>
                    <td style="padding:12px 0;font-size:14px">{{ $pesan->game_dicari }}</td>
                </tr>
                <tr style="border-bottom:1px solid var(--border)">
                    <td style="padding:12px 0;font-weight:600;color:var(--text-muted);font-size:13px">Budget Maksimal</td>
                    <td style="padding:12px 0;font-size:14px;font-weight:700;color:var(--primary)">{{ $pesan->budget_maksimal }}</td>
                </tr>
                <tr>
                    <td style="padding:12px 0;font-weight:600;color:var(--text-muted);font-size:13px;vertical-align:top">Request Khusus</td>
                    <td style="padding:12px 0;font-size:14px;line-height:1.7">{{ $pesan->request_khusus ?? '-' }}</td>
                </tr>
                @endif
            </table>

            <div style="margin-top:24px;display:flex;gap:12px">
                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $pesan->no_hp) }}" target="_blank" class="btn btn-primary">
                    <i class="fab fa-whatsapp"></i> Balas via WhatsApp
                </a>
                <a href="mailto:{{ $pesan->email }}" class="btn btn-secondary">
                    <i class="fas fa-envelope"></i> Balas via Email
                </a>
                <form action="{{ route('admin.pesan.destroy', $pesan) }}" method="POST" onsubmit="return confirm('Hapus pesan ini?')" style="margin-left:auto">
                    @csrf @method('DELETE')
                    <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i> Hapus</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
