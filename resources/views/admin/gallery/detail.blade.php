@extends('layouts.panel')

@section('title', 'Detail Foto')

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

    .content-container {
        background: white;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        overflow: hidden;
    }

    .photo-section {
        position: relative;
        background: #f8f9fa !important;
        text-align: center;
        padding: 30px !important;
        min-height: auto !important;
    }

    .photo-container {
        max-width: 1000px;
        margin: 0 auto;
        background: white;
        padding: 10px;
        border-radius: 8px;
        box-shadow: 0 4px 6px rgba(0,0,0,0.1);
    }

    .photo-image {
        width: 100%;
        height: auto;
        max-height: 600px;
        object-fit: contain;
        border-radius: 8px;
        display: block;
    }

    .photo-info {
        padding: 30px;
        border-bottom: 1px solid #eee;
    }

    .photo-title {
        font-size: 24px;
        color: #2C3E50;
        margin-bottom: 10px;
        font-weight: 600;
    }

    .photo-description {
        color: #7F8C8D;
        line-height: 1.6;
        font-size: 16px;
    }

    .stats-section {
        padding: 20px 30px;
        background: #f8f9fa;
        display: flex;
        gap: 30px;
        justify-content: center;
        border-bottom: 1px solid #eee;
    }

    .stat-item {
        display: flex;
        align-items: center;
        gap: 8px;
        color: #2C3E50;
        font-size: 16px;
        padding: 8px 15px;
        background: white;
        border-radius: 20px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.05);
    }

    .stat-item i {
        font-size: 20px;
        color: #3498DB;
    }

    .comments-section {
        padding: 30px;
        background: white;
        margin-top: 20px;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }

    .comments-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
        padding-bottom: 15px;
        border-bottom: 2px solid #f1f1f1;
    }

    .comments-header h3 {
        font-size: 20px;
        color: #2C3E50;
        font-weight: 600;
    }

    .comment-form {
        margin-bottom: 30px;
    }

    .comment-input {
        width: 100%;
        padding: 15px;
        border: 1px solid #e1e1e1;
        border-radius: 8px;
        margin-bottom: 15px;
        resize: vertical;
        min-height: 100px;
        font-size: 15px;
        transition: border-color 0.3s ease;
    }

    .comment-input:focus {
        border-color: #3498DB;
        outline: none;
    }

    .comment-list {
        display: flex;
        flex-direction: column;
        gap: 20px;
    }

    .comment-item {
        padding: 20px;
        background: #f8f9fa;
        border-radius: 8px;
        position: relative;
    }

    .comment-header {
        display: flex;
        justify-content: space-between;
        margin-bottom: 10px;
    }

    .comment-user {
        font-weight: 600;
        color: #2C3E50;
        font-size: 15px;
    }

    .comment-date {
        color: #95A5A6;
        font-size: 14px;
    }

    .comment-content {
        color: #34495E;
        line-height: 1.5;
        font-size: 15px;
    }

    .btn {
        padding: 10px 15px;
        color: white;
        border: none;
        border-radius: 6px;
        font-size: 14px;
        cursor: pointer;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 5px;
    }

    .btn-back {
        background-color: #95A5A6;
    }

    .btn-back:hover {
        background-color: #7F8C8D;
        transform: translateY(-1px);
    }

    .btn-submit {
        background-color: #3498DB;
    }

    .btn-submit:hover {
        background-color: #2980B9;
        transform: translateY(-1px);
    }

    .btn-delete {
        background-color: #E74C3C;
        padding: 6px 10px;
        font-size: 12px;
        position: absolute;
        right: 20px;
        bottom: 20px;
    }

    .btn-delete:hover {
        background-color: #C0392B;
        transform: translateY(-1px);
    }

    .no-comments {
        text-align: center;
        padding: 30px;
        color: #95A5A6;
        font-size: 16px;
        background: #f8f9fa;
        border-radius: 8px;
    }

    @media (max-width: 768px) {
        .photo-info {
            padding: 20px;
        }

        .stats-section {
            padding: 15px 20px;
            flex-wrap: wrap;
        }

        .comments-section {
            padding: 20px;
        }
    }
</style>

<div class="header">
    <div class="header-title">
        <div class="title-wrapper">
            <h2>Detail Foto</h2>
            <i class="fas fa-image" style="color: white; font-size: 24px;"></i>
        </div>
        <a href="{{ route('admin.gallery.photo', $photo->album_id) }}" class="btn btn-back">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>
</div>

<div class="content-container">
    <div class="photo-section">
        <div class="photo-container">
            <img src="{{ asset('storage/' . $photo->path_foto) }}" 
                 alt="{{ $photo->judul_foto }}" 
                 class="photo-image">
        </div>
    </div>
    
    <div class="photo-info">
        <h3 class="photo-title">{{ $photo->judul_foto }}</h3>
        <p class="photo-description">{{ $photo->deskripsi_foto }}</p>
    </div>

    <div class="stats-section">
        <div class="stat-item">
            <i class="fas fa-heart" style="color: #E74C3C;"></i>
            <span>{{ $photo->likes }} Likes</span>
        </div>
        <div class="stat-item">
            <i class="fas fa-comments" style="color: #3498DB;"></i>
            <span>{{ $photo->comments->count() }} Komentar</span>
        </div>
        <div class="stat-item">
            <i class="fas fa-calendar" style="color: #2ECC71;"></i>
            <span>{{ $photo->created_at->format('d M Y') }}</span>
        </div>
    </div>
</div>

<div class="comments-section">
    <div class="comments-header">
        <h3>Komentar</h3>
    </div>

    <form class="comment-form" action="{{ route('admin.gallery.photo.comment.store', $photo->id) }}" method="POST">
        @csrf
        <textarea name="content" 
                  class="comment-input" 
                  placeholder="Tulis komentar..."
                  required></textarea>
        <button type="submit" class="btn btn-submit">
            <i class="fas fa-paper-plane"></i> Kirim Komentar
        </button>
    </form>

    <div class="comment-list">
        @forelse($photo->comments()->with('user')->latest()->get() as $comment)
            <div class="comment-item">
                <div class="comment-header">
                    <span class="comment-user">{{ $comment->user->name }}</span>
                    <span class="comment-date">{{ $comment->created_at->diffForHumans() }}</span>
                </div>
                <p class="comment-content">{{ $comment->content }}</p>
                <form action="{{ route('admin.gallery.photo.comment.destroy', $comment->id) }}" 
                      method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-delete" 
                            onclick="return confirm('Hapus komentar ini?')">
                        <i class="fas fa-trash"></i> Hapus
                    </button>
                </form>
            </div>
        @empty
            <div class="no-comments">
                <i class="fas fa-comments" style="font-size: 24px; margin-bottom: 10px;"></i>
                <p>Belum ada komentar</p>
            </div>
        @endforelse
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
@endsection 