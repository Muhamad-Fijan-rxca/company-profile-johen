<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KontenDigital;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class KontenDigitalController extends Controller
{
    public function index()
    {
        $konten = KontenDigital::whereIn('kategori', ['Live Commerce', 'Konten Digital'])->orderBy('urutan')->get();

        return view('admin.konten-digital.index', compact('konten'));
    }

    public function create()
    {
        return view('admin.konten-digital.form', ['konten' => new KontenDigital]);
    }

    public function store(Request $request)
    {
        $validated = $this->validateKonten($request);
        if ($request->hasFile('gambar')) {
            $validated['gambar'] = $request->file('gambar')->store('konten-digital', 'public');
        }
        if ($request->hasFile('mascot_influencer')) {
            $validated['mascot_influencer'] = $request->file('mascot_influencer')->store('maskot/influencer', 'public');
        }
        KontenDigital::create($validated);

        return redirect()->route('admin.konten-digital.index')->with('success', 'Konten berhasil ditambahkan.');
    }

    public function edit(KontenDigital $kontenDigital)
    {
        return view('admin.konten-digital.form', ['konten' => $kontenDigital]);
    }

    public function update(Request $request, KontenDigital $kontenDigital)
    {
        $validated = $this->validateKonten($request);
        if ($request->hasFile('gambar')) {
            if ($kontenDigital->gambar) {
                Storage::disk('public')->delete($kontenDigital->gambar);
            }
            $validated['gambar'] = $request->file('gambar')->store('konten-digital', 'public');
        }
        if ($request->hasFile('mascot_influencer')) {
            if ($kontenDigital->mascot_influencer) {
                Storage::disk('public')->delete($kontenDigital->mascot_influencer);
            }
            $validated['mascot_influencer'] = $request->file('mascot_influencer')->store('maskot/influencer', 'public');
        }
        $kontenDigital->update($validated);

        return redirect()->route('admin.konten-digital.index')->with('success', 'Konten berhasil diperbarui.');
    }

    public function destroy(KontenDigital $kontenDigital)
    {
        if ($kontenDigital->gambar) {
            Storage::disk('public')->delete($kontenDigital->gambar);
        }
        if ($kontenDigital->mascot_influencer) {
            Storage::disk('public')->delete($kontenDigital->mascot_influencer);
        }
        $kontenDigital->delete();

        return back()->with('success', 'Konten berhasil dihapus.');
    }

    private function validateKonten(Request $request): array
    {
        return $request->validate([
            'judul' => 'required|string|max:255',
            'kategori' => 'required|in:Live Commerce,Konten Digital',
            'deskripsi' => 'required|string',
            'gambar' => 'nullable|image|max:2048',
            'urutan' => 'required|integer|min:0',
            'unggulan' => 'boolean',
            'aktif' => 'boolean',
        ]);
    }
}
