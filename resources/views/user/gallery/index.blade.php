<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gallery Sekolah</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css/user/gallery/index.css') }}" rel="stylesheet">
</head>
<body>
    <!-- Header Section -->
    <div class="page-header">
        <div class="header-content">
            <h1>Gallery Sekolah</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('user.home') }}">Home</a></li>
                    <li class="breadcrumb-item active">Gallery</li>
                </ol>
            </nav>
        </div>
    </div>

    <!-- Main Content -->
    <div class="container">
        <!-- Albums Grid -->
        <div class="albums-grid">
            @forelse($albums as $album)
            <div class="album-card">
                <div class="album-cover">
                    @if($album->cover)
                        <img src="{{ asset('storage/' . $album->cover) }}" 
                             alt="{{ $album->nama_album }}"
                             class="cover-image">
                    @elseif($album->photos->count() > 0)
                        <img src="{{ asset('storage/' . $album->photos->first()->path_foto) }}" 
                             alt="{{ $album->nama_album }}"
                             class="cover-image">
                    @else
                        <div class="no-image">
                            <i class="fas fa-images"></i>
                        </div>
                    @endif
                    <div class="album-overlay">
                        <div class="overlay-content">
                            <span class="photo-count">
                                <i class="fas fa-camera"></i>
                                {{ $album->photos_count }} Foto
                            </span>
                            <a href="{{ route('gallery.show', $album->id) }}" class="view-album">
                                Lihat Album
                            </a>
                        </div>
                    </div>
                </div>
                <div class="album-info">
                    <h3>{{ $album->nama_album }}</h3>
                    <p>{{ $album->deskripsi }}</p>
                </div>
            </div>
            @empty
            <div class="empty-state">
                <i class="fas fa-images"></i>
                <h3>Belum ada album</h3>
                <p>Album foto akan segera ditambahkan</p>
            </div>
            @endforelse
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
