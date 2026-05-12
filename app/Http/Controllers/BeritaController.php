<?php

namespace App\Http\Controllers;

use App\Models\Berita;

class BeritaController extends Controller
{
    public function index()
    {
        $berita = Berita::aktif()->latest()->paginate(6);
        return view('berita.index', compact('berita'));
    }

    public function show(string $slug)
    {
        $berita = Berita::aktif()->where('slug', $slug)->firstOrFail();
        $lainnya = Berita::aktif()->where('id', '!=', $berita->id)->latest()->take(3)->get();
        return view('berita.show', compact('berita', 'lainnya'));
    }
}
