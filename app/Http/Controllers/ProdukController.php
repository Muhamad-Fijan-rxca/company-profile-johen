<?php

namespace App\Http\Controllers;

use App\Models\Produk;

class ProdukController extends Controller
{
    public function index()
    {
        $kategori = request('kategori');
        $query = Produk::aktif()->orderBy('urutan');
        if ($kategori) {
            $query->where('kategori', $kategori);
        }
        $produk = $query->get();
        $kategoriList = Produk::aktif()->distinct()->pluck('kategori');
        return view('produk', compact('produk', 'kategoriList', 'kategori'));
    }
}
