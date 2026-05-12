<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pelamar extends Model
{
    protected $table = 'pelamar';
    protected $fillable = ['lowongan_id', 'nama', 'email', 'no_hp', 'posisi', 'cv_file'];

    public function lowongan()
    {
        return $this->belongsTo(Lowongan::class);
    }
}
