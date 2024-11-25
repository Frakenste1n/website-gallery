@extends('layouts.panel')

@section('title', 'Tambah Agenda')

@section('content')
<style>
    .header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 15px;
        background-color: #2C3E50;
        border-radius: 8px;
        margin-bottom: 20px;
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

    .form-label {
        display: block;
        margin-bottom: 8px;
        font-weight: 500;
        color: #2C3E50;
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

    .btn {
        padding: 8px 12px;
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
        background-color: #18BC9C;
        color: white;
    }

    .btn-primary:hover {
        background-color: #16A085;
    }

    .btn-secondary {
        background-color: #95A5A6;
        color: white;
    }

    .btn-secondary:hover {
        background-color: #7F8C8D;
    }

    .alert {
        padding: 12px;
        border-radius: 4px;
        margin-bottom: 20px;
        font-size: 14px;
    }

    .alert-danger {
        background-color: #E74C3C;
        color: white;
    }

    .invalid-feedback {
        color: #E74C3C;
        font-size: 12px;
        margin-top: 4px;
    }
</style>

<div class="header">
    <div class="title-wrapper">
        <h2>Tambah Agenda</h2>
        <i class="fas fa-calendar-plus" style="color: white; font-size: 24px;"></i>
    </div>
</div>

<div class="form-container">
    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.agenda.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label class="form-label">Judul Agenda</label>
            <input type="text" 
                   name="judul_agenda" 
                   class="form-control @error('judul_agenda') is-invalid @enderror"
                   value="{{ old('judul_agenda') }}" 
                   placeholder="Masukkan judul agenda"
                   required>
            @error('judul_agenda')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label class="form-label">Tanggal Agenda</label>
            <input type="date" 
                   name="tgl_agenda" 
                   class="form-control @error('tgl_agenda') is-invalid @enderror"
                   value="{{ old('tgl_agenda', date('Y-m-d')) }}" 
                   required>
            @error('tgl_agenda')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label class="form-label">Lokasi</label>
            <input type="text" 
                   name="lokasi" 
                   class="form-control @error('lokasi') is-invalid @enderror"
                   value="{{ old('lokasi') }}" 
                   placeholder="Masukkan lokasi"
                   required>
            @error('lokasi')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label class="form-label">Deskripsi</label>
            <textarea name="deskripsi" 
                      class="form-control @error('deskripsi') is-invalid @enderror"
                      rows="4" 
                      placeholder="Masukkan deskripsi agenda"
                      required>{{ old('deskripsi') }}</textarea>
            @error('deskripsi')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group mb-0">
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save"></i> Simpan
            </button>
            <a href="{{ route('admin.agenda.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>
    </form>
</div>
@endsection 