<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PesanKontak;
use Illuminate\Http\Request;

class PesanController extends Controller
{
    public function index(Request $request)
    {
        $query = PesanKontak::latest();
        if ($request->filled('tujuan')) {
            $query->where('tujuan', $request->tujuan);
        }
        $pesan = $query->get();
        return view('admin.pesan.index', compact('pesan'));
    }

    public function show(PesanKontak $pesan)
    {
        $pesan->update(['sudah_dibaca' => true]);
        return view('admin.pesan.show', compact('pesan'));
    }

    public function destroy(PesanKontak $pesan)
    {
        $pesan->delete();
        return back()->with('success', 'Pesan berhasil dihapus.');
    }
}
