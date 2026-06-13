<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Sosmed;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SosmedController extends Controller
{
    public function index()
    {
        $sosmed = Sosmed::orderBy('urutan')->get();

        return view('admin.sosmed.index', compact('sosmed'));
    }

    public function create()
    {
        return view('admin.sosmed.form', ['sosmed' => new Sosmed]);
    }

    public function store(Request $request)
    {
        $validated = $this->validateSosmed($request);
        $validated = $this->handleUploads($request, $validated);
        Sosmed::create($validated);

        return redirect()->route('admin.sosmed.index')->with('success', 'Akun sosial media berhasil ditambahkan.');
    }

    public function edit(Sosmed $sosmed)
    {
        return view('admin.sosmed.form', compact('sosmed'));
    }

    public function update(Request $request, Sosmed $sosmed)
    {
        $validated = $this->validateSosmed($request);
        $validated = $this->handleUploads($request, $validated, $sosmed);
        $sosmed->update($validated);

        return redirect()->route('admin.sosmed.index')->with('success', 'Akun sosial media berhasil diperbarui.');
    }

    public function destroy(Sosmed $sosmed)
    {
        $this->deleteFiles($sosmed);
        $sosmed->delete();

        return back()->with('success', 'Akun sosial media berhasil dihapus.');
    }

    private function validateSosmed(Request $request): array
    {
        return $request->validate([
            'platform' => 'required|in:ig,tt',
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255',
            'followers' => 'required|string|max:100',
            'avatar' => 'nullable|image|max:2048',
            'desc' => 'required|string',
            'url' => 'required|url|max:255',
            'btn_text' => 'required|string|max:255',
            'thumbnails' => 'nullable|array|max:4',
            'thumbnails.*' => 'image|max:2048',
            'urutan' => 'required|integer|min:0',
            'aktif' => 'boolean',
        ]);
    }

    private function handleUploads(Request $request, array $validated, ?Sosmed $sosmed = null): array
    {
        if ($request->hasFile('avatar')) {
            if ($sosmed && $sosmed->avatar) {
                Storage::disk('public')->delete($sosmed->avatar);
            }
            $validated['avatar'] = $request->file('avatar')->store('sosmed/avatar', 'public');
        }

        if ($request->hasFile('thumbnails')) {
            $paths = [];
            foreach ($request->file('thumbnails') as $file) {
                $paths[] = $file->store('sosmed/thumbnails', 'public');
            }
            $validated['thumbnails'] = $paths;
        }

        return $validated;
    }

    private function deleteFiles(Sosmed $sosmed): void
    {
        if ($sosmed->avatar) {
            Storage::disk('public')->delete($sosmed->avatar);
        }
        if ($sosmed->thumbnails) {
            foreach ($sosmed->thumbnails as $thumb) {
                Storage::disk('public')->delete($thumb);
            }
        }
    }
}
