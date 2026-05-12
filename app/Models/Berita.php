<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Berita extends Model
{
    protected $table = 'berita';
    protected $fillable = ['judul', 'slug', 'isi', 'thumbnail', 'aktif'];

    protected $casts = ['aktif' => 'boolean'];

    public static function generateSlug(string $judul): string
    {
        $slug = Str::slug($judul);
        $count = static::where('slug', 'like', $slug . '%')->count();
        return $count ? $slug . '-' . ($count + 1) : $slug;
    }

    public function scopeAktif($query) { return $query->where('aktif', true); }

    public function getRingkasanAttribute(): string
    {
        return Str::limit(strip_tags($this->isi), 150);
    }
}
