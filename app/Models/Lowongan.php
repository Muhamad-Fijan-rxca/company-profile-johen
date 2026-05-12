<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lowongan extends Model
{
    protected $table = 'lowongan';
    protected $fillable = ['posisi', 'departemen', 'deskripsi', 'persyaratan', 'tipe', 'aktif'];

    protected $casts = ['aktif' => 'boolean'];

    public function scopeAktif($query) { return $query->where('aktif', true); }

    public function pelamar()
    {
        return $this->hasMany(Pelamar::class);
    }
}
