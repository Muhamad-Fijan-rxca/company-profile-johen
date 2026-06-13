<?php

namespace App\Http\Controllers;

use App\Models\KontenDigital;
use App\Models\Sosmed;

class KontenDigitalController extends Controller
{
    public function index()
    {
        $liveCommerce = KontenDigital::aktif()->where('kategori', 'Live Commerce')->orderBy('urutan')->get();
        $kontenDigital = KontenDigital::aktif()->where('kategori', 'Konten Digital')->orderBy('urutan')->get();
        $partners = KontenDigital::aktif()->where('kategori', 'Partner')->orderBy('urutan')->get();
        $sosmedIg = Sosmed::aktif()->platform('ig')->orderBy('urutan')->get();
        $sosmedTt = Sosmed::aktif()->platform('tt')->orderBy('urutan')->get();

        return view('partner', compact('liveCommerce', 'kontenDigital', 'partners', 'sosmedIg', 'sosmedTt'));
    }
}
