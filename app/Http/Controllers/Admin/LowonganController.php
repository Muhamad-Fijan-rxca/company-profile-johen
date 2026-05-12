<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Lowongan;
use Illuminate\Http\Request;

class LowonganController extends Controller
{
    public function index()
    {
        $lowongan = Lowongan::latest()->get();
        return view('admin.lowongan.index', compact('lowongan'));
    }

    public function create()
    {
        return view('admin.lowongan.form', ['lowongan' => new Lowongan()]);
    }

    public function store(Request $request)
    {
        $validated = $this->validateLowongan($request);
        Lowongan::create($validated);
        return redirect()->route('admin.lowongan.index')->with('success', 'Lowongan berhasil ditambahkan.');
    }

    public function edit(Lowongan $lowongan)
    {
        return view('admin.lowongan.form', compact('lowongan'));
    }

    public function update(Request $request, Lowongan $lowongan)
    {
        $validated = $this->validateLowongan($request);
        $lowongan->update($validated);
        return redirect()->route('admin.lowongan.index')->with('success', 'Lowongan berhasil diperbarui.');
    }

    public function destroy(Lowongan $lowongan)
    {
        $lowongan->delete();
        return back()->with('success', 'Lowongan berhasil dihapus.');
    }

    private function validateLowongan(Request $request): array
    {
        return $request->validate([
            'posisi' => 'required|string|max:255',
            'departemen' => 'required|string|max:100',
            'deskripsi' => 'required|string',
            'persyaratan' => 'required|string',
            'tipe' => 'required|in:Full-time,Part-time,Freelance,Internship',
            'aktif' => 'boolean',
        ]);
    }
}
