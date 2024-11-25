<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile - SMKN 4 Bogor</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="{{ asset('css/user/profile.css') }}" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div class="profile-card">
            <div class="profile-header">
                <div class="avatar-container-static">
                    @if (Auth::user()->avatar)
                        <img src="{{ asset('storage/' . Auth::user()->avatar) }}" alt="Avatar" class="avatar">
                    @else
                        <div class="avatar-placeholder">
                            <i class="fas fa-user"></i>
                        </div>
                    @endif
                </div>
                <h2 class="profile-name">{{ Auth::user()->name }}</h2>
                <p class="profile-role">{{ ucfirst(Auth::user()->role) }}</p>
            </div>

            <div class="profile-content">
                <div class="info-section">
                    <div class="info-header">
                        <h3><i class="fas fa-info-circle"></i> Informasi Pribadi</h3>
                    </div>
                    <div class="info-body">
                        <div class="info-item">
                            <div class="info-label">
                                <i class="fas fa-envelope"></i>
                                <span>Email</span>
                            </div>
                            <div class="info-value">{{ Auth::user()->email }}</div>
                        </div>

                        <div class="info-item">
                            <div class="info-label">
                                <i class="fas fa-graduation-cap"></i>
                                <span>Kelas</span>
                            </div>
                            <div class="info-value">{{ Auth::user()->kelas ?? 'Belum diatur' }}</div>
                        </div>

                        <div class="info-item">
                            <div class="info-label">
                                <i class="fas fa-book"></i>
                                <span>Jurusan</span>
                            </div>
                            <div class="info-value">{{ Auth::user()->jurusan ?? 'Belum diatur' }}</div>
                        </div>
                    </div>
                </div>

                <div class="action-buttons">
                    <a href="{{ route('profile.edit') }}" class="btn btn-edit">
                        <i class="fas fa-user-edit"></i> Edit Profile
                    </a>
                    <a href="{{ route('user.home') }}" class="btn btn-back">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                </div>
            </div>
        </div>
    </div>

    <style>
    .action-buttons {
        display: flex;
        gap: 1rem;
        margin-top: 2rem;
        justify-content: center;
    }

    .btn {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.8rem 1.5rem;
        border-radius: 25px;
        font-weight: 500;
        text-decoration: none;
        transition: all 0.3s ease;
        border: none;
        cursor: pointer;
    }

    .btn-edit {
        background: linear-gradient(135deg, #2c3e50 0%, #3498db 100%);
        color: white;
        box-shadow: 0 4px 15px rgba(44, 62, 80, 0.3);
    }

    .btn-edit:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(44, 62, 80, 0.4);
        color: #f1c40f;
    }

    .btn-back {
        background: linear-gradient(135deg, #34495e, #2c3e50);
        color: white;
        box-shadow: 0 4px 15px rgba(52, 73, 94, 0.3);
    }

    .btn-back:hover {
        background: linear-gradient(135deg, #2c3e50, #34495e);
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(52, 73, 94, 0.4);
        color: #f1c40f;
    }

    .btn i {
        font-size: 1.1rem;
    }
    </style>
</body>
</html>
