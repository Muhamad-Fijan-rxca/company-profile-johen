<?php

namespace App\Http\Controllers;

use App\Models\Lowongan;
use App\Models\Pelamar;
use Illuminate\Http\Request;

class KarirController extends Controller
{
    public function index()
    {
        $lowongan = Lowongan::aktif()->latest()->get();
        return view('karir', compact('lowongan'));
    }

    public function lamar(Request $request)
    {
        $validated = $request->validate([
            'lowongan_id' => 'required|exists:lowongan,id',
            'nama' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'no_hp' => 'required|string|max:20',
            'posisi' => 'required|string|max:255',
            'cv' => 'required|file|mimes:pdf,doc,docx|max:2048',
        ]);

        $cvPath = $request->file('cv')->store('cv', 'public');

        Pelamar::create([
            'lowongan_id' => $validated['lowongan_id'],
            'nama' => $validated['nama'],
            'email' => $validated['email'],
            'no_hp' => $validated['no_hp'],
            'posisi' => $validated['posisi'],
            'cv_file' => $cvPath,
        ]);

        return back()->with('success', 'Lamaran Anda berhasil dikirim! Kami akan menghubungi Anda segera.');
    }
}
