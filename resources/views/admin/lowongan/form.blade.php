@extends('admin.layout')
@section('title', $lowongan->exists ? 'Edit Lowongan' : 'Tambah Lowongan')

@section('content')
<div class="page-header">
    <h2>{{ $lowongan->exists ? 'Edit Lowongan' : 'Tambah Lowongan' }}</h2>
    <a href="{{ route('admin.lowongan.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Kembali</a>
</div>

<div class="card" style="max-width:720px">
    <div class="card-body">
        <form action="{{ $lowongan->exists ? route('admin.lowongan.update', $lowongan) : route('admin.lowongan.store') }}" method="POST">
            @csrf
            @if($lowongan->exists) @method('PUT') @endif

            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">Posisi *</label>
                    <input type="text" name="posisi" class="form-control @error('posisi') is-invalid @enderror" value="{{ old('posisi', $lowongan->posisi) }}" required>
                    @error('posisi')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="form-group">
                    <label class="form-label">Departemen *</label>
                    <input type="text" name="departemen" class="form-control @error('departemen') is-invalid @enderror" value="{{ old('departemen', $lowongan->departemen) }}" required>
                    @error('departemen')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
            </div>

            <div class="form-group">
                <label class="form-label">Tipe Pekerjaan *</label>
                <select name="tipe" class="form-control" required>
                    @foreach(['Full-time','Part-time','Freelance','Internship'] as $t)
                    <option value="{{ $t }}" {{ old('tipe', $lowongan->tipe) === $t ? 'selected' : '' }}>{{ $t }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label class="form-label">Deskripsi Pekerjaan *</label>
                <textarea name="deskripsi" class="form-control @error('deskripsi') is-invalid @enderror" style="min-height:120px" required>{{ old('deskripsi', $lowongan->deskripsi) }}</textarea>
                @error('deskripsi')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="form-group">
                <label class="form-label">Persyaratan *</label>
                <textarea name="persyaratan" class="form-control @error('persyaratan') is-invalid @enderror" style="min-height:150px" placeholder="Gunakan tanda - untuk list persyaratan" required>{{ old('persyaratan', $lowongan->persyaratan) }}</textarea>
                @error('persyaratan')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div style="margin-bottom:24px">
                <label class="form-check">
                    <input type="checkbox" name="aktif" value="1" {{ old('aktif', $lowongan->aktif ?? true) ? 'checked' : '' }}>
                    Lowongan Aktif
                </label>
            </div>

            <div style="display:flex;gap:12px">
                <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
                <a href="{{ route('admin.lowongan.index') }}" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
