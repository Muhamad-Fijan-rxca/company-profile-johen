<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    protected $table = 'produk';
    protected $fillable = ['nama', 'kategori', 'deskripsi', 'harga', 'gambar', 'urutan', 'unggulan', 'aktif'];

    protected $casts = ['unggulan' => 'boolean', 'aktif' => 'boolean'];

    public function scopeAktif($query) { return $query->where('aktif', true); }
    public function scopeUnggulan($query) { return $query->where('unggulan', true); }
}
