<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Produk;
use App\Models\Berita;
use App\Models\Lowongan;
use App\Models\Pelamar;
use App\Models\PesanKontak;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'produk' => Produk::count(),
            'berita' => Berita::count(),
            'lowongan' => Lowongan::aktif()->count(),
            'pelamar' => Pelamar::count(),
            'pesan' => PesanKontak::count(),
            'pesan_baru' => PesanKontak::where('sudah_dibaca', false)->count(),
        ];
        $pesanTerbaru = PesanKontak::latest()->take(5)->get();
        $pelamarTerbaru = Pelamar::with('lowongan')->latest()->take(5)->get();
        return view('admin.dashboard', compact('stats', 'pesanTerbaru', 'pelamarTerbaru'));
    }
}
