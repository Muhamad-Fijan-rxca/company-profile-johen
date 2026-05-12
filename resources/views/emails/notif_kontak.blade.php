<!DOCTYPE html>
<html>
<head><meta charset="UTF-8"><style>body{font-family:Arial,sans-serif;font-size:14px;color:#333}table{width:100%;border-collapse:collapse}td{padding:10px;border:1px solid #ddd}.header{background:linear-gradient(135deg,#1e3c72,#6a1b9a);color:white;padding:24px;text-align:center}.label{background:#f5f5f5;font-weight:bold;width:35%}</style></head>
<body>
<div class="header"><h2>PT Johen Gaming - Pesan Baru</h2></div>
<div style="padding:24px">
    <p>Ada pesan baru dari form Contact Us:</p>
    <table>
        <tr><td class="label">Tujuan</td><td><strong>{{ strtoupper($pesan->tujuan) }} Akun Game</strong></td></tr>
        <tr><td class="label">Nama</td><td>{{ $pesan->nama }}</td></tr>
        <tr><td class="label">Email</td><td>{{ $pesan->email }}</td></tr>
        <tr><td class="label">No. HP</td><td>{{ $pesan->no_hp }}</td></tr>
        @if($pesan->tujuan === 'jual')
        <tr><td class="label">Nama Game</td><td>{{ $pesan->nama_game }}</td></tr>
        <tr><td class="label">Level Akun</td><td>{{ $pesan->level_akun }}</td></tr>
        <tr><td class="label">Harga Harapan</td><td>{{ $pesan->harga_harapan }}</td></tr>
        <tr><td class="label">Deskripsi</td><td>{{ $pesan->deskripsi }}</td></tr>
        @else
        <tr><td class="label">Game Dicari</td><td>{{ $pesan->game_dicari }}</td></tr>
        <tr><td class="label">Budget Maksimal</td><td>{{ $pesan->budget_maksimal }}</td></tr>
        <tr><td class="label">Request Khusus</td><td>{{ $pesan->request_khusus ?? '-' }}</td></tr>
        @endif
        <tr><td class="label">Waktu</td><td>{{ $pesan->created_at->format('d M Y H:i') }} WIB</td></tr>
    </table>
    <p style="margin-top:16px;color:#666">Silakan login ke admin panel untuk melihat detail pesan.</p>
</div>
</body>
</html>
