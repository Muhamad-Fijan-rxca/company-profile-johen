<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sosmed extends Model
{
    protected $table = 'sosmed';
    protected $fillable = [
        'platform', 'name', 'username', 'followers', 'avatar',
        'desc', 'url', 'btn_text', 'thumbnails', 'urutan', 'aktif'
    ];
    protected $casts = [
        'thumbnails' => 'array',
        'aktif' => 'boolean',
    ];

    public function scopeAktif($query) { return $query->where('aktif', true); }

    public function scopePlatform($query, $platform) { return $query->where('platform', $platform); }
}
