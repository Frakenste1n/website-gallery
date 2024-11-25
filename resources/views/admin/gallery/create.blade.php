@extends('layouts.panel')

@section('title', 'Tambah Album')

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
        min-height: 100px;
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
</style>

<div class="header">
    <div class="header-title">
        <div class="title-wrapper">
            <h2>Tambah Album</h2>
            <i class="fas fa-plus" style="color: white; font-size: 24px;"></i>
        </div>
    </div>
</div>

<div class="form-container">
    <form action="{{ route('admin.gallery.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="nama_album">Nama Album</label>
            <input type="text" 
                   class="form-control @error('nama_album') is-invalid @enderror" 
                   id="nama_album" 
                   name="nama_album" 
                   value="{{ old('nama_album') }}" 
                   required>
            @error('nama_album')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="deskripsi">Deskripsi</label>
            <textarea class="form-control @error('deskripsi') is-invalid @enderror" 
                      id="deskripsi" 
                      name="deskripsi">{{ old('deskripsi') }}</textarea>
            @error('deskripsi')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="cover">Cover Album</label>
            <input type="file" 
                   class="form-control @error('cover') is-invalid @enderror" 
                   id="cover" 
                   name="cover" 
                   accept="image/*">
            @error('cover')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-actions">
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save"></i> Simpan
            </button>
            <a href="{{ route('admin.gallery.index') }}" class="btn btn-secondary">
                <i class="fas fa-times"></i> Batal
            </a>
        </div>
    </form>
</div>
@endsection 