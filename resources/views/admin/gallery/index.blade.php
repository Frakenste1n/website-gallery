@extends('layouts.panel')

@section('title', 'Manajemen Gallery')

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

    .btn-create {
        background-color: #18BC9C;
    }

    .btn-create:hover {
        background-color: #16A085;
    }

    .btn-edit {
        background-color: #F39C12;
    }

    .btn-edit:hover {
        background-color: #D35400;
    }

    .btn-delete {
        background-color: #E74C3C;
    }

    .btn-delete:hover {
        background-color: #C0392B;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
        background: white;
        border-radius: 8px;
        overflow: hidden;
    }

    th {
        background-color: #34495E;
        color: white;
        padding: 12px;
        text-align: left;
        font-weight: 500;
    }

    td {
        padding: 12px;
        border-bottom: 1px solid #ddd;
        color: #2C3E50;
    }

    tr:hover {
        background-color: #f5f6fa;
    }

    .actions {
        display: flex;
        gap: 8px;
    }

    .alert {
        padding: 12px;
        border-radius: 4px;
        margin-bottom: 20px;
        font-size: 14px;
    }

    .alert-success {
        background-color: #18BC9C;
        color: white;
    }

    .alert-danger {
        background-color: #E74C3C;
        color: white;
    }

    .gallery-image {
        width: 100px;
        height: 100px;
        object-fit: cover;
        border-radius: 4px;
    }

    .album-cover {
        width: 80px;
        height: 80px;
        object-fit: cover;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }
</style>

<div class="header">
    <div class="header-title">
        <div class="title-wrapper">
            <h2>Manajemen Gallery</h2>
            <i class="fas fa-images" style="color: white; font-size: 24px;"></i>
        </div>
        <a href="{{ route('admin.gallery.create') }}" class="btn btn-create">
            <i class="fas fa-plus"></i> Tambah Album
        </a>
    </div>
</div>

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

<div class="table-responsive">
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Cover</th>
                <th>Nama Album</th>
                <th>Deskripsi</th>
                <th>Jumlah Foto</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($albums as $index => $album)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>
                    <img src="{{ $album->cover_url }}" 
                         alt="{{ $album->nama_album }}" 
                         class="album-cover">
                </td>
                <td>{{ $album->nama_album }}</td>
                <td>{{ Str::limit($album->deskripsi, 50) }}</td>
                <td>{{ $album->photos_count }}</td>
                <td class="actions">
                    <a href="{{ route('admin.gallery.photo', $album->id) }}" class="btn btn-edit">
                        <i class="fas fa-images"></i> Lihat Foto
                    </a>
                    <a href="{{ route('admin.gallery.edit', $album->id) }}" class="btn btn-edit">
                        <i class="fas fa-edit"></i> Edit
                    </a>
                    <form action="{{ route('admin.gallery.destroy', $album->id) }}" method="POST" class="delete-form">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-delete" onclick="return confirm('Apakah Anda yakin ingin menghapus album ini?')">
                            <i class="fas fa-trash"></i> Hapus
                        </button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="text-center">Tidak ada data album</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
