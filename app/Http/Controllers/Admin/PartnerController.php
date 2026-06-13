<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KontenDigital;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PartnerController extends Controller
{
    public function index()
    {
        $partners = KontenDigital::where('kategori', 'Partner')->orderBy('urutan')->get();

        return view('admin.partner.index', compact('partners'));
    }

    public function create()
    {
        return view('admin.partner.form', ['partner' => new KontenDigital]);
    }

    public function store(Request $request)
    {
        $validated = $this->validatePartner($request);
        $validated['kategori'] = 'Partner';
        if ($request->hasFile('gambar')) {
            $validated['gambar'] = $request->file('gambar')->store('partner', 'public');
        }
        if ($request->hasFile('mascot_influencer')) {
            $validated['mascot_influencer'] = $request->file('mascot_influencer')->store('maskot/influencer', 'public');
        }
        KontenDigital::create($validated);

        return redirect()->route('admin.partner.index')->with('success', 'Partner berhasil ditambahkan.');
    }

    public function edit(KontenDigital $partner)
    {
        return view('admin.partner.form', ['partner' => $partner]);
    }

    public function update(Request $request, KontenDigital $partner)
    {
        $validated = $this->validatePartner($request);
        if ($request->hasFile('gambar')) {
            if ($partner->gambar) {
                Storage::disk('public')->delete($partner->gambar);
            }
            $validated['gambar'] = $request->file('gambar')->store('partner', 'public');
        }
        if ($request->hasFile('mascot_influencer')) {
            if ($partner->mascot_influencer) {
                Storage::disk('public')->delete($partner->mascot_influencer);
            }
            $validated['mascot_influencer'] = $request->file('mascot_influencer')->store('maskot/influencer', 'public');
        }
        $partner->update($validated);

        return redirect()->route('admin.partner.index')->with('success', 'Partner berhasil diperbarui.');
    }

    public function destroy(KontenDigital $partner)
    {
        if ($partner->gambar) {
            Storage::disk('public')->delete($partner->gambar);
        }
        if ($partner->mascot_influencer) {
            Storage::disk('public')->delete($partner->mascot_influencer);
        }
        $partner->delete();

        return back()->with('success', 'Partner berhasil dihapus.');
    }

    private function validatePartner(Request $request): array
    {
        return $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'role' => 'nullable|string|max:255',
            'followers' => 'nullable|string|max:100',
            'gambar' => 'nullable|image|max:2048',
            'mascot_influencer' => 'nullable|image|max:2048',
            'urutan' => 'required|integer|min:0',
            'unggulan' => 'boolean',
            'aktif' => 'boolean',
        ]);
    }
}
