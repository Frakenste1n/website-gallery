@extends('layouts.app')

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Galeri Sekolah</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css/user/home.css') }}" rel="stylesheet">
</head>
<body>

    <!-- Header dengan background foto -->
    <header class="header-bg">
        <!-- User dropdown di kanan atas -->
        <div class="user-dropdown">
            <div class="user-trigger">
                @if (Auth::user()->avatar)
                    <img src="{{ asset('storage/' . Auth::user()->avatar) }}" alt="Avatar" class="user-avatar">
                @else
                    <div class="user-avatar-placeholder">
                        <i class="fas fa-user"></i>
                    </div>
                @endif
                <span class="username">{{ Auth::user()->name }}</span>
                <i class="fas fa-chevron-down"></i>
            </div>
            <div class="dropdown-content">
                <a href="{{ route('profile') }}" class="dropdown-item">
                    <i class="fas fa-user"></i> Profile
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item" data-toggle="modal" data-target="#logoutModal">
                    <i class="fas fa-sign-out-alt text-danger"></i> Logout
                </a>
            </div>
        </div>

        <!-- Navigasi utama -->
        <nav class="main-nav">
            <a class="nav-link" href="#home">Home</a>
            <a class="nav-link" href="#about">About</a>
            <img src="{{ asset('storage/about.jpg') }}" alt="Logo" class="logo-img">
            <a class="nav-link" href="{{ route('gallery.index') }}">Gallery</a>
            <div class="custom-dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button">
                    News
                </a>
                <div class="custom-dropdown-menu">
                    <a href="{{ route('informasi.index') }}">Informasi</a>
                    <a href="{{ route('agenda.index') }}">Agenda</a>
                </div>
            </div>
        </nav>

        <!-- Teks selamat datang dengan animasi -->
        <div class="welcome-text">Selamat Datang di Galeri Sekolah</div>
    </header>

    <!-- Section About dengan tampilan yang diupgrade -->
    <section class="container my-5" id="about">
        <div class="section-header text-center mb-5">
            <h2 class="display-4 font-weight-bold">About Us</h2>
        </div>
        <div class="row align-items-center">
            <div class="col-md-6">
                <div class="about-img-container">
                    <img src="{{ asset('storage/about.jpg') }}" alt="Foto Profil" class="img-fluid rounded shadow-lg hover-scale">
                </div>
            </div>
            <div class="col-md-6">
                <div class="about-content">
                    <h3 class="mb-4">SMK Negeri 4 Bogor</h3>
                    <p class="lead">Sekolah kejuruan terkemuka yang berkomitmen pada keunggulan pendidikan.</p>
                    <p>SMK 4 Bogor adalah sekolah kejuruan terkemuka yang menawarkan program pendidikan berkualitas tinggi, termasuk bidang teknologi, bisnis, dan layanan masyarakat.</p>
                    <div class="mt-4">
                        <div class="row">
                            <div class="col-6 mb-3">
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-check-circle text-success mr-2"></i>
                                    <span>Program Unggulan</span>
                                </div>
                            </div>
                            <div class="col-6 mb-3">
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-check-circle text-success mr-2"></i>
                                    <span>Fasilitas Modern</span>
                                </div>
                            </div>
                            <div class="col-6 mb-3">
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-check-circle text-success mr-2"></i>
                                    <span>Guru Profesional</span>
                                </div>
                            </div>
                            <div class="col-6 mb-3">
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-check-circle text-success mr-2"></i>
                                    <span>Lingkungan Kondusif</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Ganti section Fitur Utama -->
    <section class="container my-5" id="features">
        <div class="section-header text-center mb-5">
            <h2 class="display-4 font-weight-bold">Fitur Utama</h2>
            <p class="lead mt-3">Akses berbagai fitur untuk mendapatkan informasi terkini seputar sekolah</p>
        </div>
        
        <div class="row mb-5">
            <!-- Info Card -->
            <div class="col-md-6 mb-4" id="info">
                <div class="feature-card h-100">
                    <div class="icon-wrapper mb-4">
                        <i class="fa-regular fa-bell fa-3x text-primary"></i>
                    </div>
                    <h3 class="feature-title">Info Sekolah</h3>
                    <p class="feature-desc">Dapatkan informasi terbaru mengenai kegiatan dan acara sekolah untuk para siswa dan guru.</p>
                    <ul class="info-list">
                        <li><i class="fas fa-chevron-right"></i> Pengumuman Penting</li>
                        <li><i class="fas fa-chevron-right"></i> Berita Sekolah</li>
                        <li><i class="fas fa-chevron-right"></i> Prestasi Siswa</li>
                        <li><i class="fas fa-chevron-right"></i> Kegiatan Akademik</li>
                    </ul>
                    <a href="{{ route('informasi.index') }}" class="btn btn-primary btn-lg feature-btn">
                        <i class="fas fa-info-circle mr-2"></i>View Info
                    </a>
                </div>
            </div>

            <!-- Agenda Card -->
            <div class="col-md-6 mb-4" id="agenda">
                <div class="feature-card h-100">
                    <div class="icon-wrapper mb-4">
                        <i class="fa-solid fa-calendar-days fa-3x text-success"></i>
                    </div>
                    <h3 class="feature-title">Agenda Sekolah</h3>
                    <p class="feature-desc">Akses jadwal kegiatan dan agenda penting sekolah dengan mudah dan terorganisir.</p>
                    <ul class="agenda-list">
                        <li><i class="fas fa-chevron-right"></i> Jadwal Ujian</li>
                        <li><i class="fas fa-chevron-right"></i> Kegiatan Ekstrakurikuler</li>
                        <li><i class="fas fa-chevron-right"></i> Rapat Orang Tua</li>
                        <li><i class="fas fa-chevron-right"></i> Event Sekolah</li>
                    </ul>
                    <a href="{{ route('agenda.index') }}" class="btn btn-success btn-lg feature-btn">
                        <i class="fas fa-calendar-check mr-2"></i>View Agenda
                    </a>
                </div>
            </div>
        </div>

        <!-- Gallery Section -->
        <div class="gallery-section mt-5">
            <div class="section-header text-center mb-5">
                <h2 class="display-4 font-weight-bold">Galeri Sekolah</h2>
                <p class="lead mt-3">Koleksi moment berkesan di sekolah kami</p>
            </div>

            <div class="gallery-container">
                <div class="row">
                    <div class="col-md-4 mb-4">
                        <div class="gallery-item">
                            <img src="{{ asset('storage/header.jpg') }}" class="img-fluid rounded" alt="Gallery 1">
                            <div class="gallery-overlay">
                                <div class="gallery-info">
                                    <h5>Kegiatan Sekolah</h5>
                                    <p>Dokumentasi aktivitas siswa</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-4">
                        <div class="gallery-item">
                            <img src="{{ asset('storage/about.jpg') }}" class="img-fluid rounded" alt="Gallery 2">
                            <div class="gallery-overlay">
                                <div class="gallery-info">
                                    <h5>Fasilitas Sekolah</h5>
                                    <p>Ruang praktik modern</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-4">
                        <div class="gallery-item">
                            <img src="{{ asset('storage/header.jpg') }}" class="img-fluid rounded" alt="Gallery 3">
                            <div class="gallery-overlay">
                                <div class="gallery-info">
                                    <h5>Event Sekolah</h5>
                                    <p>Acara tahunan sekolah</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-4">
                        <div class="gallery-item">
                            <img src="{{ asset('storage/about.jpg') }}" class="img-fluid rounded" alt="Gallery 4">
                            <div class="gallery-overlay">
                                <div class="gallery-info">
                                    <h5>Prestasi Siswa</h5>
                                    <p>Pencapaian membanggakan</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-4">
                        <div class="gallery-item">
                            <img src="{{ asset('storage/header.jpg') }}" class="img-fluid rounded" alt="Gallery 5">
                            <div class="gallery-overlay">
                                <div class="gallery-info">
                                    <h5>Kegiatan Praktek</h5>
                                    <p>Pembelajaran hands-on</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-4">
                        <div class="gallery-item">
                            <img src="{{ asset('storage/about.jpg') }}" class="img-fluid rounded" alt="Gallery 6">
                            <div class="gallery-overlay">
                                <div class="gallery-info">
                                    <h5>Ekstrakurikuler</h5>
                                    <p>Aktivitas non-akademik</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="text-center mt-4">
                <a href="{{ route('gallery.index') }}" class="btn btn-info btn-lg px-5">
                    <i class="fas fa-images mr-2"></i>Lihat Semua Galeri
                </a>
            </div>
        </div>
    </section>

    <!-- Tambahkan modal konfirmasi logout -->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <h5 class="modal-title">Konfirmasi Logout</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body text-center py-4">
                    <i class="fas fa-sign-out-alt fa-3x text-danger mb-3"></i>
                    <h4>Apakah Anda yakin ingin keluar?</h4>
                    <p class="text-muted mb-0">Anda akan keluar dari sistem.</p>
                </div>
                <div class="modal-footer border-0 justify-content-center">
                    <button type="button" class="btn btn-secondary px-4" data-dismiss="modal">
                        <i class="fas fa-times mr-2"></i>Batal
                    </button>
                    <form action="{{ route('logout') }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-danger px-4">
                            <i class="fas fa-sign-out-alt mr-2"></i>Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
@endsection
