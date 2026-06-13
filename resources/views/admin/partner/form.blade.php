@extends('admin.layout')
@section('title', $partner->exists ? 'Edit Partner' : 'Tambah Partner')

@section('content')
<div class="page-header">
    <h2>{{ $partner->exists ? 'Edit Partner' : 'Tambah Partner' }}</h2>
    <a href="{{ route('admin.partner.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Kembali</a>
</div>

<div class="card" style="max-width:720px">
    <div class="card-body">
        <form action="{{ $partner->exists ? route('admin.partner.update', $partner) : route('admin.partner.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @if($partner->exists) @method('PUT') @endif

            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">Nama Partner *</label>
                    <input type="text" name="judul" class="form-control @error('judul') is-invalid @enderror" value="{{ old('judul', $partner->judul) }}" required>
                    @error('judul')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="form-group">
                    <label class="form-label">Urutan Tampil *</label>
                    <input type="number" name="urutan" class="form-control" value="{{ old('urutan', $partner->urutan ?? 0) }}" min="0" required>
                </div>
            </div>

            <div class="form-group">
                <label class="form-label">Deskripsi *</label>
                <textarea name="deskripsi" class="form-control @error('deskripsi') is-invalid @enderror" style="min-height:130px" required>{{ old('deskripsi', $partner->deskripsi) }}</textarea>
                @error('deskripsi')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">Role / Kategori Creator</label>
                    <input type="text" name="role" class="form-control @error('role') is-invalid @enderror" value="{{ old('role', $partner->role) }}" placeholder="Contoh: PUBG Mobile Creator">
                    @error('role')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="form-group">
                    <label class="form-label">Jumlah Followers</label>
                    <input type="text" name="followers" class="form-control @error('followers') is-invalid @enderror" value="{{ old('followers', $partner->followers) }}" placeholder="Contoh: 247.8K Followers">
                    @error('followers')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">Maskot Influencer (maks 2MB)</label>
                    @if($partner->mascot_influencer)
                        <div style="margin-bottom:8px">
                            <img src="{{ Storage::url($partner->mascot_influencer) }}" style="height:80px;border-radius:6px;object-fit:cover">
                        </div>
                    @endif
                    <input type="file" name="mascot_influencer" class="form-control @error('mascot_influencer') is-invalid @enderror" accept="image/*">
                    @error('mascot_influencer')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="form-group">
                    <label class="form-label">Gambar (maks 2MB)</label>
                    @if($partner->gambar)
                        <div style="margin-bottom:8px"><img src="{{ Storage::url($partner->gambar) }}" style="height:60px;border-radius:6px;object-fit:cover"></div>
                    @endif
                    <input type="file" name="gambar" class="form-control @error('gambar') is-invalid @enderror" accept="image/*">
                    @error('gambar')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
            </div>

            <div style="display:flex;gap:24px;margin-bottom:24px">
                <label class="form-check">
                    <input type="checkbox" name="unggulan" value="1" {{ old('unggulan', $partner->unggulan) ? 'checked' : '' }}>
                    Tampilkan sebagai Unggulan
                </label>
                <label class="form-check">
                    <input type="checkbox" name="aktif" value="1" {{ old('aktif', $partner->aktif ?? true) ? 'checked' : '' }}>
                    Aktif
                </label>
            </div>

            <div style="display:flex;gap:12px">
                <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
                <a href="{{ route('admin.partner.index') }}" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
