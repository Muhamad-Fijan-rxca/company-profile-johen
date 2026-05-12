@extends('admin.layout')
@section('title', $berita->exists ? 'Edit Berita' : 'Tambah Berita')

@push('styles')
<style>
    .ql-editor { min-height: 300px; font-family: 'Poppins', sans-serif; font-size: 14px; }
    .ql-toolbar { border-radius: 8px 8px 0 0; border-color: #e5e7eb !important; }
    .ql-container { border-radius: 0 0 8px 8px; border-color: #e5e7eb !important; }
</style>
<link href="https://cdn.quilljs.com/1.3.7/quill.snow.css" rel="stylesheet">
@endpush

@section('content')
<div class="page-header">
    <h2>{{ $berita->exists ? 'Edit Berita' : 'Tambah Berita' }}</h2>
    <a href="{{ route('admin.berita.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Kembali</a>
</div>

<div class="card" style="max-width:800px">
    <div class="card-body">
        <form action="{{ $berita->exists ? route('admin.berita.update', $berita) : route('admin.berita.store') }}" method="POST" enctype="multipart/form-data" id="beritaForm">
            @csrf
            @if($berita->exists) @method('PUT') @endif

            <div class="form-group">
                <label class="form-label">Judul Berita *</label>
                <input type="text" name="judul" class="form-control @error('judul') is-invalid @enderror" value="{{ old('judul', $berita->judul) }}" required>
                @error('judul')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="form-group">
                <label class="form-label">Isi Berita *</label>
                <div id="quillEditor">{!! old('isi', $berita->isi) !!}</div>
                <input type="hidden" name="isi" id="isiInput">
                @error('isi')<div class="invalid-feedback" style="display:block">{{ $message }}</div>@enderror
            </div>

            <div class="form-group">
                <label class="form-label">Thumbnail (rasio 16:9, maks 2MB)</label>
                @if($berita->thumbnail)
                    <div style="margin-bottom:10px"><img src="{{ Storage::url($berita->thumbnail) }}" style="height:80px;border-radius:8px;object-fit:cover" alt="Thumbnail saat ini"></div>
                @endif
                <input type="file" name="thumbnail" class="form-control @error('thumbnail') is-invalid @enderror" accept="image/*">
                @error('thumbnail')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div style="margin-bottom:24px">
                <label class="form-check">
                    <input type="checkbox" name="aktif" value="1" {{ old('aktif', $berita->aktif ?? true) ? 'checked' : '' }}>
                    Publikasikan Berita
                </label>
            </div>

            <div style="display:flex;gap:12px">
                <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
                <a href="{{ route('admin.berita.index') }}" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.quilljs.com/1.3.7/quill.min.js"></script>
<script>
    const quill = new Quill('#quillEditor', {
        theme: 'snow',
        modules: { toolbar: [['bold','italic','underline'],['blockquote'],['link'],['image'],[{list:'ordered'},{list:'bullet'}],[{header:[1,2,3,false]}],['clean']] }
    });
    document.getElementById('beritaForm').addEventListener('submit', function() {
        document.getElementById('isiInput').value = quill.root.innerHTML;
    });
</script>
@endpush
