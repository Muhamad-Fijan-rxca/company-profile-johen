<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Berita;

class HomeController extends Controller
{
    public function index()
    {
        $produkUnggulan = Produk::aktif()->unggulan()->orderBy('urutan')->take(3)->get();
        $beritaTerbaru = Berita::aktif()->latest()->take(3)->get();
        return view('home', compact('produkUnggulan', 'beritaTerbaru'));
    }
}
