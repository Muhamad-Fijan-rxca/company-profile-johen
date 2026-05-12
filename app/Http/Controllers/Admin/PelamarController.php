<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pelamar;
use Illuminate\Support\Facades\Storage;

class PelamarController extends Controller
{
    public function index()
    {
        $pelamar = Pelamar::with('lowongan')->latest()->get();
        return view('admin.pelamar.index', compact('pelamar'));
    }

    public function destroy(Pelamar $pelamar)
    {
        Storage::disk('public')->delete($pelamar->cv_file);
        $pelamar->delete();
        return back()->with('success', 'Data pelamar berhasil dihapus.');
    }
}
