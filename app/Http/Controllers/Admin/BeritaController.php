<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BeritaController extends Controller
{
    public function index()
    {
        $berita = Berita::latest()->get();
        return view('admin.berita.index', compact('berita'));
    }

    public function create()
    {
        return view('admin.berita.form', ['berita' => new Berita()]);
    }

    public function store(Request $request)
    {
        $validated = $this->validateBerita($request);
        $validated['slug'] = Berita::generateSlug($validated['judul']);
        if ($request->hasFile('thumbnail')) {
            $validated['thumbnail'] = $request->file('thumbnail')->store('berita', 'public');
        }
        Berita::create($validated);
        return redirect()->route('admin.berita.index')->with('success', 'Berita berhasil ditambahkan.');
    }

    public function edit(Berita $berita)
    {
        return view('admin.berita.form', compact('berita'));
    }

    public function update(Request $request, Berita $berita)
    {
        $validated = $this->validateBerita($request);
        if ($validated['judul'] !== $berita->judul) {
            $validated['slug'] = Berita::generateSlug($validated['judul']);
        }
        if ($request->hasFile('thumbnail')) {
            if ($berita->thumbnail) Storage::disk('public')->delete($berita->thumbnail);
            $validated['thumbnail'] = $request->file('thumbnail')->store('berita', 'public');
        }
        $berita->update($validated);
        return redirect()->route('admin.berita.index')->with('success', 'Berita berhasil diperbarui.');
    }

    public function destroy(Berita $berita)
    {
        if ($berita->thumbnail) Storage::disk('public')->delete($berita->thumbnail);
        $berita->delete();
        return back()->with('success', 'Berita berhasil dihapus.');
    }

    private function validateBerita(Request $request): array
    {
        return $request->validate([
            'judul' => 'required|string|max:255',
            'isi' => 'required|string',
            'thumbnail' => 'nullable|image|max:2048',
            'aktif' => 'boolean',
        ]);
    }
}
