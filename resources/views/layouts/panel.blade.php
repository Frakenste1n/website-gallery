<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <!-- CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css/layouts/panel.css') }}" rel="stylesheet">
    <link href="{{ asset('css/admin/dashboard.css') }}" rel="stylesheet">
</head>
<body>
    <div class="wrapper">
        <!-- Sidebar -->
        <div class="sidebar">
            <div class="sidebar-header">
                <h2>Panel</h2>
            </div>
            
            <div class="admin-profile">
                <div class="admin-info">
                    <h4 class="admin-name">{{ Auth::user()->name }}</h4>
                    <p class="admin-role">Administrator</p>
                </div>
            </div>

            <nav class="nav-menu">
                <a href="{{ route('admin.dashboard') }}" class="menu-item">
                    <i class="fas fa-home"></i>
                    <span>Dashboard</span>
                </a>
                <a href="{{ route('admin.users.index') }}" class="menu-item">
                    <i class="fas fa-users"></i>
                    <span>Kelola User</span>
                </a>
                <a href="{{ route('admin.gallery.index') }}" class="menu-item">
                    <i class="fas fa-images"></i>
                    <span>Kelola Galeri</span>
                </a>
                <a href="{{ route('admin.informasi.index') }}" class="menu-item">
                    <i class="fas fa-info-circle"></i>
                    <span>Kelola Informasi</span>
                </a>
                <a href="{{ route('admin.agenda.index') }}" class="menu-item">
                    <i class="fas fa-calendar-alt"></i>
                    <span>Kelola Agenda</span>
                </a>
                
                
                <form action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
                <a href="#" class="menu-item" onclick="event.preventDefault(); document.querySelector('form').submit();">
                    <i class="fas fa-sign-out-alt"></i>
                    <span>Logout</span>
                </a>
            </nav>
        </div>

        <!-- Main Content -->
        <div class="main-content">
            @yield('content')
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
