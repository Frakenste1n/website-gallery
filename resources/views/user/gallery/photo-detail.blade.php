<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Foto - {{ $photo->judul_foto }}</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css/user/gallery/photo-detail.css') }}" rel="stylesheet">
</head>
<body>
    <!-- Navigation -->
    <nav class="top-nav">
        <div class="container">
            <div class="breadcrumb-nav">
                <a href="{{ route('user.home') }}">Home</a>
                <span class="separator">/</span>
                <a href="{{ route('gallery.index') }}">Gallery</a>
                <span class="separator">/</span>
                <a href="{{ route('gallery.show', $photo->album->id) }}">{{ $photo->album->nama_album }}</a>
                <span class="separator">/</span>
                <span class="current">{{ $photo->judul_foto }}</span>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="photo-detail">
            <div class="photo-container">
                <img src="{{ asset('storage/' . $photo->path_foto) }}" 
                     alt="{{ $photo->judul_foto }}"
                     class="main-photo">
            </div>

            <div class="photo-info">
                <div class="photo-header">
                    <h2>{{ $photo->judul_foto }}</h2>
                    <div class="photo-stats">
                        <button class="like-btn {{ $photo->isLikedBy(auth()->id()) ? 'liked' : '' }}" 
                                onclick="likePhoto({{ $photo->id }}, this)">
                            <i class="fa-heart {{ $photo->isLikedBy(auth()->id()) ? 'fas' : 'far' }}"></i>
                            <span class="count">{{ $photo->likes }}</span>
                        </button>
                        <span class="comments">
                            <i class="fas fa-comment"></i>
                            {{ $photo->komen }}
                        </span>
                    </div>
                </div>

                <div class="photo-description">
                    <p>{{ $photo->deskripsi_foto }}</p>
                </div>

                <div class="comments-section">
                    <h3>Komentar</h3>
                    <div class="comments-list">
                        @forelse($photo->comments as $comment)
                        <div class="comment-item">
                            <div class="comment-header">
                                <span class="comment-author">{{ $comment->user->name }}</span>
                                @if($comment->user_id === auth()->id())
                                <form action="{{ route('gallery.comment.delete', $comment->id) }}" 
                                      method="POST" 
                                      class="delete-comment">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="delete-btn">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </form>
                                @endif
                            </div>
                            <p class="comment-content">{{ $comment->content }}</p>
                        </div>
                        @empty
                        <p class="no-comments">Belum ada komentar</p>
                        @endforelse
                    </div>

                    <form action="{{ route('gallery.comment.add', $photo->id) }}" 
                          method="POST" 
                          class="comment-form">
                        @csrf
                        <input type="text" 
                               name="content" 
                               placeholder="Tambahkan komentar..." 
                               required>
                        <button type="submit">
                            <i class="fas fa-paper-plane"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script>
        function likePhoto(photoId, button) {
            $.ajax({
                url: `/gallery/photo/${photoId}/like`,
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    if (response.success) {
                        const icon = button.querySelector('i');
                        const count = button.querySelector('.count');
                        
                        // Update like count
                        count.textContent = response.likes;
                        
                        // Toggle heart icon dan animasi
                        if (response.isLiked) {
                            icon.classList.remove('far');
                            icon.classList.add('fas', 'liked-animation');
                            button.classList.add('liked');
                        } else {
                            icon.classList.remove('fas', 'liked-animation');
                            icon.classList.add('far');
                            button.classList.remove('liked');
                        }

                        // Hapus class animasi setelah selesai
                        setTimeout(() => {
                            icon.classList.remove('liked-animation');
                        }, 300);
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error:', error);
                }
            });
        }
    </script>
</body>
</html> 