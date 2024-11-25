<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informasi Sekolah</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css/user/informasi/index.css') }}" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <!-- Header Section -->
    <div class="page-header">
        <div class="header-content">
            <h1>Informasi Sekolah</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('user.home') }}">Home</a></li>
                    <li class="breadcrumb-item active">Informasi</li>
                </ol>
            </nav>
        </div>
    </div>

    <!-- Search Section -->
    <div class="search-section">
        <div class="search-tools">
            <div class="search-box">
                <input type="text" 
                       id="searchInformasi" 
                       placeholder="Cari informasi...">
                <div class="search-icons">
                    <i class="fas fa-search"></i>
                </div>
            </div>
        </div>
        <div class="info-stats">
            <i class="fas fa-newspaper"></i>
            <span>{{ $informasi->count() }} Informasi</span>
        </div>
    </div>

    <!-- Content Section -->
    <div class="content-section">
        <div class="informasi-grid">
            @forelse($informasi as $info)
            <div class="informasi-card {{ $info->is_read ? 'read' : 'unread' }}">
                <div class="informasi-header">
                    <div class="informasi-title">
                        <i class="fas fa-file-alt"></i>
                        <span>{{ $info->judul_info }}</span>
                    </div>
                    <div class="informasi-meta">
                        <span class="category-badge">
                            <i class="fas fa-tag"></i>
                            {{ ucfirst($info->kategori_info) }}
                        </span>
                    </div>
                </div>
                <div class="informasi-footer">
                    <div class="date-info">
                        <i class="far fa-calendar"></i>
                        {{ $info->created_at->format('d M Y') }}
                    </div>
                    <a href="{{ route('informasi.show', $info->id) }}" class="btn-detail">
                        <i class="fas fa-eye"></i> Detail
                    </a>
                </div>
            </div>
            @empty
            <div class="empty-state">
                <img src="{{ asset('images/empty-state.svg') }}" alt="No Data">
                <p>Belum ada informasi tersedia</p>
            </div>
            @endforelse
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('searchInformasi');
    const informasiCards = document.querySelectorAll('.informasi-card');

    function filterInformasi(searchText) {
        let hasResults = false;
        
        informasiCards.forEach(card => {
            const title = card.querySelector('.informasi-title span').textContent.toLowerCase();
            const category = card.querySelector('.category-badge').textContent.toLowerCase();
            
            if (title.includes(searchText) || category.includes(searchText)) {
                card.style.display = '';
                hasResults = true;
            } else {
                card.style.display = 'none';
            }
        });

        // Show/hide no results message
        const emptyState = document.querySelector('.empty-state');
        const existingNoResults = document.querySelector('.no-results');

        if (!hasResults) {
            if (!existingNoResults) {
                const noResults = document.createElement('div');
                noResults.className = 'no-results empty-state';
                noResults.innerHTML = `
                    <i class="fas fa-search fa-3x mb-3"></i>
                    <p>Tidak ditemukan hasil yang sesuai</p>
                `;
                document.querySelector('.informasi-grid').appendChild(noResults);
            }
        } else {
            if (existingNoResults) {
                existingNoResults.remove();
            }
        }
    }

    // Live search
    searchInput.addEventListener('input', function(e) {
        const searchText = this.value.toLowerCase().trim();
        filterInformasi(searchText);
    });
});
</script>
</body>
</html>
