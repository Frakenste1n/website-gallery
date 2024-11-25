<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $informasi->judul_info }}</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css/user/informasi/show.css') }}" rel="stylesheet">
</head>
<body>
    <!-- Navigation -->
    <nav class="top-nav">
        <div class="container">
            <div class="breadcrumb-nav">
                <a href="{{ route('user.home') }}">Home</a>
                <span class="separator">/</span>
                <a href="{{ route('informasi.index') }}">Informasi</a>
                <span class="separator">/</span>
                <span class="current">{{ $informasi->judul_info }}</span>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="main-content">
        <div class="container">
            <!-- Article Header -->
            <header class="article-header">
                <div class="category-tag">
                    <i class="fas fa-tag"></i>
                    {{ ucfirst($informasi->kategori_info) }}
                </div>
                <h1 class="article-title">{{ $informasi->judul_info }}</h1>
                <div class="article-meta">
                    <div class="meta-item">
                        <i class="far fa-calendar"></i>
                        {{ $informasi->created_at->format('d M Y') }}
                    </div>
                    <div class="meta-item">
                        <i class="far fa-clock"></i>
                        {{ $informasi->created_at->format('H:i') }} WIB
                    </div>
                </div>
            </header>

            <!-- Article Content -->
            <article class="article-content">
                @if($informasi->gambar)
                <div class="featured-image-wrapper">
                    <img src="{{ asset('storage/' . $informasi->gambar) }}" 
                         alt="{{ $informasi->judul_info }}"
                         class="featured-image">
                </div>
                @endif

                <div class="content-wrapper">
                    {!! nl2br(e($informasi->artikel)) !!}
                </div>
            </article>

            <!-- Share Section -->
            <div class="share-section">
                <div class="share-header">
                    <h3>Bagikan Informasi</h3>
                    <p>Bagikan informasi ini ke media sosial Anda</p>
                </div>
                <div class="share-buttons">
                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->url()) }}" 
                       target="_blank" 
                       class="share-btn facebook">
                        <i class="fab fa-facebook-f"></i>
                        <span>Facebook</span>
                    </a>
                    <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->url()) }}&text={{ urlencode($informasi->judul_info) }}" 
                       target="_blank" 
                       class="share-btn twitter">
                        <i class="fab fa-twitter"></i>
                        <span>Twitter</span>
                    </a>
                    <a href="https://wa.me/?text={{ urlencode($informasi->judul_info . ' ' . request()->url()) }}" 
                       target="_blank" 
                       class="share-btn whatsapp">
                        <i class="fab fa-whatsapp"></i>
                        <span>WhatsApp</span>
                    </a>
                </div>
            </div>
        </div>
    </main>

    <!-- Back to Top -->
    <button id="backToTop" class="back-to-top">
        <i class="fas fa-arrow-up"></i>
    </button>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        // Back to Top Button
        const backToTopButton = document.getElementById('backToTop');
        
        window.onscroll = function() {
            if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
                backToTopButton.style.display = "block";
            } else {
                backToTopButton.style.display = "none";
            }
        };

        backToTopButton.onclick = function() {
            window.scrollTo({top: 0, behavior: 'smooth'});
        };
    </script>
</body>
</html>
