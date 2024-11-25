<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agenda Sekolah</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css/user/agenda/index.css') }}" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <!-- Header Section -->
    <div class="page-header">
        <div class="header-content">
            <h1>Agenda Sekolah</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('user.home') }}">Home</a></li>
                    <li class="breadcrumb-item active">Agenda</li>
                </ol>
            </nav>
        </div>
    </div>

    <!-- Search Section -->
    <div class="search-section">
        <div class="search-box">
            <i class="fas fa-search search-icon"></i>
            <input type="text" id="searchAgenda" placeholder="Cari agenda...">
        </div>
        <div class="info-stats">
            <div class="stat-item">
                <i class="fas fa-calendar-alt"></i>
                <span>{{ $agendas->count() }} Agenda</span>
            </div>
        </div>
    </div>

    <!-- Content Section -->
    <div class="content-section">
        <div class="table-wrapper">
            <table class="agenda-table">
                <thead>
                    <tr>
                        <th width="5%">No</th>
                        <th width="30%">Judul Agenda</th>
                        <th width="20%">Tanggal</th>
                        <th width="25%">Lokasi</th>
                        <th width="20%">Status</th>
                    </tr>
                </thead>
                <tbody id="agendaTableBody">
                    @forelse($agendas as $index => $agenda)
                    <tr class="agenda-item">
                        <td>{{ $index + 1 }}</td>
                        <td>
                            <div class="agenda-title">
                                <i class="fas fa-calendar-check text-primary"></i>
                                <span>{{ $agenda->judul_agenda }}</span>
                            </div>
                        </td>
                        <td>
                            <div class="date-info">
                                <i class="far fa-calendar"></i>
                                {{ $agenda->tgl_agenda->format('d M Y') }}
                            </div>
                        </td>
                        <td>
                            <div class="location-info">
                                <i class="fas fa-map-marker-alt"></i>
                                {{ $agenda->lokasi }}
                            </div>
                        </td>
                        <td>
                            @php
                                $today = \Carbon\Carbon::now()->startOfDay();
                                $agendaDate = $agenda->tgl_agenda->startOfDay();
                            @endphp

                            @if($agendaDate->isFuture())
                                <span class="badge badge-info">Segera</span>
                            @elseif($agendaDate->isToday())
                                <span class="badge badge-success">Berlangsung</span>
                            @else
                                <span class="badge badge-danger">Berakhir</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5">
                            <div class="empty-state">
                                <img src="{{ asset('images/empty-state.svg') }}" alt="No Data">
                                <p>Belum ada agenda tersedia</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('searchAgenda');
    const tableBody = document.getElementById('agendaTableBody');
    const rows = tableBody.getElementsByTagName('tr');

    searchInput.addEventListener('keyup', function(e) {
        const searchText = e.target.value.toLowerCase();

        Array.from(rows).forEach(row => {
            if(row.classList.contains('agenda-item')) {
                const title = row.querySelector('.agenda-title span').textContent.toLowerCase();
                const location = row.querySelector('.location-info').textContent.toLowerCase();
                
                if (title.includes(searchText) || location.includes(searchText)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            }
        });

        // Check if no results found
        const visibleRows = Array.from(rows).filter(row => row.style.display !== 'none');
        if (visibleRows.length === 0) {
            showNoResults();
        } else {
            hideNoResults();
        }
    });
});

function showNoResults() {
    const existingNoResults = document.querySelector('.no-results');
    if (!existingNoResults) {
        const tableBody = document.getElementById('agendaTableBody');
        const noResultsRow = document.createElement('tr');
        noResultsRow.className = 'no-results';
        noResultsRow.innerHTML = `
            <td colspan="5">
                <div class="empty-state">
                    <i class="fas fa-search fa-3x"></i>
                    <p>Tidak ditemukan hasil yang sesuai</p>
                </div>
            </td>
        `;
        tableBody.appendChild(noResultsRow);
    }
}

function hideNoResults() {
    const noResultsRow = document.querySelector('.no-results');
    if (noResultsRow) {
        noResultsRow.remove();
    }
}
</script>
</body>
</html>
