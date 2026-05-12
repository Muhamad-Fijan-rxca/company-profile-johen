@extends('admin.layout')
@section('title', $produk->exists ? 'Edit Produk' : 'Tambah Produk')

@section('content')
<div class="page-header">
    <h2>{{ $produk->exists ? 'Edit Produk' : 'Tambah Produk' }}</h2>
    <a href="{{ route('admin.produk.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Kembali</a>
</div>

<div class="card" style="max-width:720px">
    <div class="card-body">
        <form action="{{ $produk->exists ? route('admin.produk.update', $produk) : route('admin.produk.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @if($produk->exists) @method('PUT') @endif

            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">Nama Produk *</label>
                    <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror" value="{{ old('nama', $produk->nama) }}" required>
                    @error('nama')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="form-group">
                    <label class="form-label">Kategori *</label>
                    <input type="text" name="kategori" class="form-control @error('kategori') is-invalid @enderror" value="{{ old('kategori', $produk->kategori) }}" placeholder="cth: Top Up, Jual Beli Akun, Jasa" required>
                    @error('kategori')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
            </div>

            <div class="form-group">
                <label class="form-label">Deskripsi *</label>
                <textarea name="deskripsi" class="form-control @error('deskripsi') is-invalid @enderror" required>{{ old('deskripsi', $produk->deskripsi) }}</textarea>
                @error('deskripsi')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">Harga (opsional)</label>
                    <input type="text" name="harga" class="form-control" value="{{ old('harga', $produk->harga) }}" placeholder="cth: Mulai Rp 2.000">
                </div>
                <div class="form-group">
                    <label class="form-label">Urutan Tampil *</label>
                    <input type="number" name="urutan" class="form-control" value="{{ old('urutan', $produk->urutan ?? 0) }}" min="0" required>
                </div>
            </div>

            <div class="form-group">
                <label class="form-label">Gambar Produk (maks 2MB)</label>
                @if($produk->gambar)
                    <div style="margin-bottom:10px"><img src="{{ Storage::url($produk->gambar) }}" style="height:80px;border-radius:8px;object-fit:cover" alt="Gambar saat ini"></div>
                @endif
                <input type="file" name="gambar" class="form-control @error('gambar') is-invalid @enderror" accept="image/*">
                @error('gambar')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div style="display:flex;gap:24px;margin-bottom:24px">
                <label class="form-check">
                    <input type="checkbox" name="unggulan" value="1" {{ old('unggulan', $produk->unggulan) ? 'checked' : '' }}>
                    Tampilkan sebagai Produk Unggulan
                </label>
                <label class="form-check">
                    <input type="checkbox" name="aktif" value="1" {{ old('aktif', $produk->aktif ?? true) ? 'checked' : '' }}>
                    Produk Aktif
                </label>
            </div>

            <div style="display:flex;gap:12px">
                <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
                <a href="{{ route('admin.produk.index') }}" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
