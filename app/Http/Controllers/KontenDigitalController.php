<?php

namespace App\Http\Controllers;

use App\Models\KontenDigital;

class KontenDigitalController extends Controller
{
    public function index()
    {
        $liveCommerce = KontenDigital::aktif()->where('kategori', 'Live Commerce')->orderBy('urutan')->get();
        $kontenDigital = KontenDigital::aktif()->where('kategori', 'Konten Digital')->orderBy('urutan')->get();
        return view('konten-digital', compact('liveCommerce', 'kontenDigital'));
    }
}
