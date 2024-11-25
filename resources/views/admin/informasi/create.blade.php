@extends('layouts.panel')

@section('title', 'Tambah Informasi')

@section('content')
<style>
    .header {
        display: flex;
        flex-direction: column;
        align-items: flex-start;
        padding: 15px;
        background-color: #2C3E50;
        border-radius: 8px;
        margin-bottom: 20px;
        width: 100%;
    }

    .header-title {
        display: flex;
        justify-content: space-between;
        align-items: center;
        width: 100%;
    }

    .title-wrapper {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .header h2 {
        color: white;
        font-size: 28px;
        font-weight: bold;
        margin: 0;
    }

    .form-container {
        background-color: white;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-group label {
        display: block;
        margin-bottom: 8px;
        color: #2C3E50;
        font-weight: 500;
    }

    .form-control {
        width: 100%;
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 4px;
        font-size: 14px;
    }

    .form-control:focus {
        border-color: #3498DB;
        outline: none;
    }

    textarea.form-control {
        min-height: 200px;
        resize: vertical;
    }

    .btn {
        padding: 8px 12px;
        color: white;
        border: none;
        border-radius: 4px;
        font-size: 14px;
        cursor: pointer;
        transition: background-color 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 5px;
    }

    .btn-primary {
        background-color: #3498DB;
    }

    .btn-primary:hover {
        background-color: #2980B9;
    }

    .btn-secondary {
        background-color: #95A5A6;
    }

    .btn-secondary:hover {
        background-color: #7F8C8D;
    }

    .form-actions {
        display: flex;
        gap: 10px;
        margin-top: 20px;
    }

    .invalid-feedback {
        color: #E74C3C;
        font-size: 13px;
        margin-top: 5px;
    }

    .ck-editor__editable {
        min-height: 300px;
    }
</style>

<div class="header">
    <div class="header-title">
        <div class="title-wrapper">
            <h2>Tambah Informasi</h2>
            <i class="fas fa-newspaper" style="color: white; font-size: 24px;"></i>
        </div>
        <a href="{{ route('admin.informasi.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>
</div>

<div class="form-container">
    <form action="{{ route('admin.informasi.store') }}" method="POST" enctype="multipart/form-data" id="createForm">
        @csrf
        <div class="form-group">
            <label for="judul">Judul</label>
            <input type="text" 
                   class="form-control @error('judul') is-invalid @enderror" 
                   id="judul" 
                   name="judul" 
                   value="{{ old('judul') }}" 
                   required>
            @error('judul')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="kategori">Kategori</label>
            <select class="form-control @error('kategori') is-invalid @enderror" 
                    id="kategori" 
                    name="kategori" 
                    required>
                <option value="">Pilih Kategori</option>
                <option value="Pengumuman" {{ old('kategori') == 'Pengumuman' ? 'selected' : '' }}>Pengumuman</option>
                <option value="Berita" {{ old('kategori') == 'Berita' ? 'selected' : '' }}>Berita</option>
                <option value="Prestasi" {{ old('kategori') == 'Prestasi' ? 'selected' : '' }}>Prestasi</option>
                <option value="Kegiatan" {{ old('kategori') == 'Kegiatan' ? 'selected' : '' }}>Kegiatan</option>
            </select>
            @error('kategori')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="konten">Konten</label>
            <textarea class="form-control @error('konten') is-invalid @enderror" 
                      id="konten" 
                      name="konten">{{ old('konten') }}</textarea>
            @error('konten')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="gambar">Gambar</label>
            <input type="file" 
                   class="form-control @error('gambar') is-invalid @enderror" 
                   id="gambar" 
                   name="gambar" 
                   accept="image/*">
            @error('gambar')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-actions">
            <button type="submit" class="btn btn-primary" id="submitBtn">
                <i class="fas fa-save"></i> Simpan
            </button>
            <a href="{{ route('admin.informasi.index') }}" class="btn btn-secondary">
                <i class="fas fa-times"></i> Batal
            </a>
        </div>
    </form>
</div>

@push('scripts')
<script src="https://cdn.ckeditor.com/ckeditor5/35.0.1/classic/ckeditor.js"></script>
<script>
    ClassicEditor
        .create(document.querySelector('#konten'))
        .catch(error => {
            console.error(error);
        });

    document.getElementById('createForm').addEventListener('submit', function(e) {
        e.preventDefault();
        
        // Disable submit button to prevent double submission
        document.getElementById('submitBtn').disabled = true;
        
        // Submit form
        this.submit();
    });
</script>
@endpush
@endsection 