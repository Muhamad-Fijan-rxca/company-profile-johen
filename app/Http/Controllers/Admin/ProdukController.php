<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProdukController extends Controller
{
    public function index()
    {
        $produk = Produk::orderBy('urutan')->get();
        return view('admin.produk.index', compact('produk'));
    }

    public function create()
    {
        return view('admin.produk.form', ['produk' => new Produk()]);
    }

    public function store(Request $request)
    {
        $validated = $this->validateProduk($request);
        if ($request->hasFile('gambar')) {
            $validated['gambar'] = $request->file('gambar')->store('produk', 'public');
        }
        Produk::create($validated);
        return redirect()->route('admin.produk.index')->with('success', 'Produk berhasil ditambahkan.');
    }

    public function edit(Produk $produk)
    {
        return view('admin.produk.form', compact('produk'));
    }

    public function update(Request $request, Produk $produk)
    {
        $validated = $this->validateProduk($request);
        if ($request->hasFile('gambar')) {
            if ($produk->gambar) Storage::disk('public')->delete($produk->gambar);
            $validated['gambar'] = $request->file('gambar')->store('produk', 'public');
        }
        $produk->update($validated);
        return redirect()->route('admin.produk.index')->with('success', 'Produk berhasil diperbarui.');
    }

    public function destroy(Produk $produk)
    {
        if ($produk->gambar) Storage::disk('public')->delete($produk->gambar);
        $produk->delete();
        return back()->with('success', 'Produk berhasil dihapus.');
    }

    private function validateProduk(Request $request): array
    {
        return $request->validate([
            'nama' => 'required|string|max:255',
            'kategori' => 'required|string|max:100',
            'deskripsi' => 'required|string',
            'harga' => 'nullable|string|max:100',
            'urutan' => 'required|integer|min:0',
            'unggulan' => 'boolean',
            'aktif' => 'boolean',
            'gambar' => 'nullable|image|max:2048',
        ]);
    }
}
