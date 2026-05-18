<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KontenDigital extends Model
{
    protected $table = 'konten_digital';
    protected $fillable = ['judul', 'kategori', 'deskripsi', 'gambar', 'urutan', 'unggulan', 'aktif'];
    protected $casts = ['unggulan' => 'boolean', 'aktif' => 'boolean'];

    public function scopeAktif($query) { return $query->where('aktif', true); }
    public function scopeUnggulan($query) { return $query->where('unggulan', true); }
}
