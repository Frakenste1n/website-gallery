<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $album->nama_album }} - Galeri Foto</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="{{ asset('css/user/gallery/foto.css') }}" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <!-- Header Section -->
        <div class="page-header">
            <div class="header-content">
                <h1>{{ $album->nama_album }}</h1>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('user.home') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('gallery.index') }}">Gallery</a></li>
                        <li class="breadcrumb-item active">{{ $album->nama_album }}</li>
                    </ol>
                </nav>
            </div>
        </div>

        <!-- Album Info -->
        <div class="album-info-card">
            <div class="album-description">
                <p>{{ $album->deskripsi }}</p>
            </div>
            <div class="album-stats">
                <span><i class="fas fa-image"></i> {{ $album->photos->count() }} Foto</span>
                <span><i class="far fa-calendar"></i> {{ $album->created_at ? $album->created_at->format('d M Y') : 'Tanggal tidak tersedia' }}</span>
            </div>
        </div>

        <!-- Photos Grid -->
        <div class="photos-grid">
            @forelse($album->photos as $photo)
                <div class="photo-card" data-full-img="{{ asset('storage/' . $photo->path_foto) }}">
                    <img src="{{ asset('storage/' . $photo->path_foto) }}" alt="{{ $photo->judul_foto }}">
                    <div class="photo-overlay">
                        <div class="photo-info">
                            <h3>{{ $photo->judul_foto }}</h3>
                            @if($photo->deskripsi_foto)
                                <p>{{ $photo->deskripsi_foto }}</p>
                            @endif
                            <div class="photo-stats">
                                <span><i class="fas fa-heart"></i> {{ $photo->likes }}</span>
                                <span><i class="fas fa-comment"></i> {{ $photo->komen }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="empty-state">
                    <i class="fas fa-images"></i>
                    <p>Belum ada foto dalam album ini</p>
                </div>
            @endforelse
        </div>

        <!-- Back Button -->
        <div class="back-section">
            <a href="{{ route('gallery.index') }}" class="back-btn">
                <i class="fas fa-arrow-left"></i> Kembali ke Gallery
            </a>
        </div>
    </div>

    <!-- Photo Viewer Modal -->
    <div class="photo-modal">
        <span class="close-modal">&times;</span>
        <img class="modal-content" id="modalImage">
        <div class="modal-caption"></div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const photoCards = document.querySelectorAll('.photo-card');
            const modal = document.querySelector('.photo-modal');
            const modalImg = document.getElementById('modalImage');
            const closeModal = document.querySelector('.close-modal');
            const modalCaption = document.querySelector('.modal-caption');

            photoCards.forEach(card => {
                card.addEventListener('click', function() {
                    modal.style.display = 'block';
                    modalImg.src = this.dataset.fullImg;
                    
                    // Ambil informasi foto untuk caption modal
                    const photoInfo = this.querySelector('.photo-info').cloneNode(true);
                    modalCaption.innerHTML = '';
                    modalCaption.appendChild(photoInfo);
                });
            });

            closeModal.addEventListener('click', function() {
                modal.style.display = 'none';
            });

            window.addEventListener('click', function(e) {
                if (e.target === modal) {
                    modal.style.display = 'none';
                }
            });

            // Escape key untuk menutup modal
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape' && modal.style.display === 'block') {
                    modal.style.display = 'none';
                }
            });
        });
    </script>
</body>
</html>
