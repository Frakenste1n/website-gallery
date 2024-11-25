<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $album->nama_album }} - Gallery</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css/user/gallery/show.css') }}" rel="stylesheet">
</head>
<body>
    <!-- Header Section -->
    <div class="page-header">
        <div class="header-content">
            <h1>{{ $album->nama_album }}</h1>
            <div class="breadcrumb-nav">
                <a href="{{ route('user.home') }}">Home</a>
                <span class="separator">/</span>
                <a href="{{ route('gallery.index') }}">Gallery</a>
                <span class="separator">/</span>
                <span class="current">{{ $album->nama_album }}</span>
            </div>
            <div class="photo-stats">
                <i class="fas fa-camera"></i>
                <span>{{ $album->photos->count() }} Foto</span>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="container">
        <!-- Photos Grid -->
        <div class="photos-grid">
            @forelse($album->photos as $photo)
            <div class="photo-card">
                <div class="photo-wrapper">
                    <img src="{{ asset('storage/' . $photo->path_foto) }}" 
                         alt="{{ $photo->judul_foto ?? $album->nama_album }}">
                </div>
                <div class="photo-info">
                    <div class="photo-actions">
                        <button class="action-btn like-btn {{ $photo->isLikedBy(auth()->id()) ? 'liked' : '' }}" 
                                onclick="likePhoto({{ $photo->id }}, this)">
                            <i class="fa-heart {{ $photo->isLikedBy(auth()->id()) ? 'fas' : 'far' }}"></i>
                            <span class="count">{{ $photo->likes }}</span>
                        </button>
                        <a href="{{ route('gallery.photo.detail', $photo->id) }}" class="action-btn comment-btn">
                            <i class="fas fa-comment"></i>
                            <span class="count">{{ $photo->komen }}</span>
                        </a>
                    </div>
                </div>
            </div>
            @empty
            <div class="empty-state">
                <i class="fas fa-images"></i>
                <h3>Belum ada foto</h3>
                <p>Album ini masih kosong</p>
            </div>
            @endforelse
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