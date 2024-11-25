<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Admin Panel</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="{{ asset('css/layouts/panel.css') }}" rel="stylesheet">
    <link href="{{ asset('css/admin/dashboard.css') }}" rel="stylesheet">
</head>
<body>
    <div class="admin-container">
        @include('layouts.panel')
        
        <div class="container-fluid">
            <div class="d-flex justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
            </div>

            <!-- Card Statistik -->
            <div class="row">
    <!-- Total Users Card -->
    <div class="col-md-3">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <h5 class="font-weight-bold">
                    <i class="fas fa-users text-primary mr-2"></i>Total Users
                </h5>
                <p class="card-value">{{ $totalUsers }}</p>
            </div>
        </div>
    </div>

    <!-- Total Informasi Card -->
    <div class="col-md-3">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <h5 class="font-weight-bold">
                    <i class="fas fa-info-circle text-success mr-2"></i>Total Informasi
                </h5>
                <p class="card-value">{{ $totalInformasi }}</p>
            </div>
        </div>
    </div>

    <!-- Total Gallery Card -->
    <div class="col-md-3">
        <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
                <h5 class="font-weight-bold">
                    <i class="fas fa-images text-info mr-2"></i>Total Gallery
                </h5>
                <p class="card-value">{{ $totalGallery }}</p>
            </div>
        </div>
    </div>

    <!-- Total Agenda Card -->
    <div class="col-md-3">
        <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
                <h5 class="font-weight-bold">
                    <i class="fas fa-calendar-alt text-warning mr-2"></i>Total Agenda
                </h5>
                <p class="card-value">{{ $totalAgenda }}</p>
            </div>
        </div>
    </div>
</div>


            <!-- Data Terbaru -->
            <div class="row mt-4">
                <!-- User Terbaru -->
                <div class="col-md-6">
                    <div class="card shadow mb-4">
                        <div class="card-header">User Terbaru</div>
                        <div class="card-body">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Nama</th>
                                        <th>Email</th>
                                        <th>Tanggal Daftar</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($latestUsers as $user)
                                    <tr>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->created_at->format('d/m/Y') }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Informasi Terbaru -->
                <div class="col-md-6">
                    <div class="card shadow mb-4">
                        <div class="card-header">Informasi Terbaru</div>
                        <div class="card-body">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Judul</th>
                                        <th>Kategori</th>
                                        <th>Tanggal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($latestInformasi as $info)
                                    <tr>
                                        <td>{{ $info->judul_info }}</td>
                                        <td>{{ $info->kategori_info }}</td>
                                        <td>{{ \Carbon\Carbon::parse($info->tgl_info)->format('d/m/Y') }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Agenda Terbaru -->
            <div class="row mt-4">
                <div class="col-md-12">
                    <div class="card shadow mb-4">
                        <div class="card-header">Agenda Terbaru</div>
                        <div class="card-body">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Judul</th>
                                        <th>Tanggal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($latestAgenda as $agenda)
                                    <tr>
                                        <td>{{ $agenda->judul_agenda }}</td>
                                        <td>{{ \Carbon\Carbon::parse($agenda->tgl_agenda)->format('d/m/Y') }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Aktivitas Terbaru -->
            <div class="row mt-4">
                <div class="col-md-12">
                    <div class="card shadow mb-4">
                        <div class="card-header">Aktivitas Terbaru</div>
                        <div class="card-body">
                            <ul class="list-group">
                                @foreach($recentActivities as $activity)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    {{ $activity['message'] }}
                                    <span class="badge badge-secondary">{{ $activity['time']->format('d/m/Y H:i') }}</span>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
