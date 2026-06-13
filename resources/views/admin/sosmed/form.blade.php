@extends('admin.layout')
@section('title', $sosmed->exists ? 'Edit Akun Sosial Media' : 'Tambah Akun Sosial Media')

@section('content')
<div class="page-header">
    <h2>{{ $sosmed->exists ? 'Edit Akun Sosial Media' : 'Tambah Akun Sosial Media' }}</h2>
    <a href="{{ route('admin.sosmed.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Kembali</a>
</div>

<div class="card" style="max-width:720px">
    <div class="card-body">
        <form action="{{ $sosmed->exists ? route('admin.sosmed.update', $sosmed) : route('admin.sosmed.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @if($sosmed->exists) @method('PUT') @endif

            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">Platform *</label>
                    <select name="platform" class="form-control @error('platform') is-invalid @enderror" required>
                        <option value="">-- Pilih Platform --</option>
                        <option value="ig" {{ old('platform', $sosmed->platform) === 'ig' ? 'selected' : '' }}>Instagram</option>
                        <option value="tt" {{ old('platform', $sosmed->platform) === 'tt' ? 'selected' : '' }}>TikTok</option>
                    </select>
                    @error('platform')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="form-group">
                    <label class="form-label">Urutan Tampil *</label>
                    <input type="number" name="urutan" class="form-control" value="{{ old('urutan', $sosmed->urutan ?? 0) }}" min="0" required>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">Nama Akun *</label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $sosmed->name) }}" required>
                    @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="form-group">
                    <label class="form-label">Username *</label>
                    <input type="text" name="username" class="form-control @error('username') is-invalid @enderror" value="{{ old('username', $sosmed->username) }}" required>
                    @error('username')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">Jumlah Followers *</label>
                    <input type="text" name="followers" class="form-control @error('followers') is-invalid @enderror" value="{{ old('followers', $sosmed->followers) }}" placeholder="Contoh: 124K" required>
                    @error('followers')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="form-group">
                    <label class="form-label">URL Profil *</label>
                    <input type="url" name="url" class="form-control @error('url') is-invalid @enderror" value="{{ old('url', $sosmed->url) }}" required>
                    @error('url')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">Teks Tombol *</label>
                    <input type="text" name="btn_text" class="form-control @error('btn_text') is-invalid @enderror" value="{{ old('btn_text', $sosmed->btn_text) }}" placeholder="Contoh: Follow Instagram" required>
                    @error('btn_text')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="form-group">
                    <label class="form-label">Avatar (maks 2MB)</label>
                    @if($sosmed->avatar)
                        <div style="margin-bottom:8px">
                            <img src="{{ Storage::url($sosmed->avatar) }}" style="height:60px;width:60px;border-radius:50%;object-fit:cover">
                        </div>
                    @endif
                    <input type="file" name="avatar" class="form-control @error('avatar') is-invalid @enderror" accept="image/*">
                    @error('avatar')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
            </div>

            <div class="form-group">
                <label class="form-label">Deskripsi / Caption *</label>
                <textarea name="desc" class="form-control @error('desc') is-invalid @enderror" style="min-height:100px" required>{{ old('desc', $sosmed->desc) }}</textarea>
                @error('desc')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="form-group">
                <label class="form-label">Thumbnail Konten (bisa upload beberapa, maks 2MB masing-masing)</label>
                @if($sosmed->thumbnails)
                    <div style="display:flex;gap:8px;margin-bottom:8px;flex-wrap:wrap">
                        @foreach($sosmed->thumbnails as $thumb)
                            <img src="{{ Storage::url($thumb) }}" style="height:72px;width:72px;border-radius:8px;object-fit:cover">
                        @endforeach
                    </div>
                @endif
                <input type="file" name="thumbnails[]" class="form-control @error('thumbnails.*') is-invalid @enderror" accept="image/*" multiple>
                @error('thumbnails.*')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div style="display:flex;gap:24px;margin-bottom:24px">
                <label class="form-check">
                    <input type="checkbox" name="aktif" value="1" {{ old('aktif', $sosmed->aktif ?? true) ? 'checked' : '' }}>
                    Aktif
                </label>
            </div>

            <div style="display:flex;gap:12px">
                <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
                <a href="{{ route('admin.sosmed.index') }}" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
