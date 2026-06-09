<?php

namespace App\Http\Controllers;

use App\Models\Produk;

class ProdukController extends Controller
{
    public function index()
    {
        $kategori = request('kategori');
        $query = Produk::aktif()->where('kategori', '!=', 'Konten Digital')->orderBy('urutan');
        if ($kategori) {
            $query->where('kategori', $kategori);
        }
        $produk = $query->get();
        $kategoriList = Produk::aktif()->where('kategori', '!=', 'Konten Digital')->distinct()->pluck('kategori');
        return view('produk', compact('produk', 'kategoriList', 'kategori'));
    }

    public function topUp()
    {
        $kategori = 'Top Up';
        $produk = Produk::aktif()->where('kategori', $kategori)->orderBy('urutan')->get();
        return view('produk-kategori', compact('produk', 'kategori'));
    }

    public function jokiMl()
    {
        $kategori = 'Jasa Joki';
        $produk = Produk::aktif()->where('kategori', $kategori)->orderBy('urutan')->get();
        return view('produk-kategori', compact('produk', 'kategori'));
    }

    public function jualBeliAkun()
    {
        $kategori = 'Jual Beli Akun';
        $produk = Produk::aktif()->where('kategori', $kategori)->orderBy('urutan')->get();
        return view('produk-kategori', compact('produk', 'kategori'));
    }

    public function liveCommerce()
    {
        $kategori = 'Live Commerce';
        $produk = Produk::aktif()->where('kategori', $kategori)->orderBy('urutan')->get();
        return view('produk-kategori', compact('produk', 'kategori'));
    }
}
