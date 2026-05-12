<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PesanKontak extends Model
{
    protected $table = 'pesan_kontak';
    protected $fillable = [
        'tujuan', 'nama', 'email', 'no_hp',
        'nama_game', 'level_akun', 'harga_harapan', 'deskripsi',
        'game_dicari', 'budget_maksimal', 'request_khusus', 'sudah_dibaca'
    ];

    protected $casts = ['sudah_dibaca' => 'boolean'];
}
