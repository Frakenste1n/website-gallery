<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile - SMKN 4 Bogor</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="{{ asset('css/user/profile.css') }}" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div class="profile-card">
            <div class="profile-header">
                <h2 class="edit-title">
                    <i class="fas fa-user-edit"></i> 
                    Edit Profile
                </h2>
                
            </div>

            <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" class="edit-form" id="editForm">
                @csrf
                @method('PUT')
                
                <div class="avatar-section">
                    <div class="avatar-container">
                        <label for="avatar-input" class="cursor-pointer">
                            @if ($user->avatar)
                                <img src="{{ asset('storage/' . $user->avatar) }}" alt="Avatar" class="avatar" id="avatar-preview">
                            @else
                                <div class="avatar-placeholder" id="avatar-preview-placeholder">
                                    <i class="fas fa-user"></i>
                                </div>
                            @endif
                            <div class="avatar-overlay">
                                <i class="fas fa-camera"></i>
                                <span>Ubah Foto</span>
                            </div>
                        </label>
                        <input type="file" id="avatar-input" name="avatar" class="hidden" accept="image/*" onchange="previewImage(this)">
                    </div>
                    <p class="avatar-help">Klik untuk mengubah foto profil</p>
                </div>

                <div class="form-section">
                    <div class="form-group">
                        <label for="name" class="form-label">
                            <i class="fas fa-user"></i> Nama Lengkap
                        </label>
                        <div class="input-group">
                            <input type="text" id="name" name="name" class="form-control" value="{{ $user->name }}" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="kelas" class="form-label">
                            <i class="fas fa-graduation-cap"></i> Kelas
                        </label>
                        <div class="input-group">
                            <input type="text" id="kelas" name="kelas" class="form-control" value="{{ $user->kelas }}" placeholder="Contoh: XI RPL 1">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="jurusan" class="form-label">
                            <i class="fas fa-book"></i> Jurusan
                        </label>
                        <div class="select-wrapper">
                            <select id="jurusan" name="jurusan" class="form-control">
                                <option value="" {{ $user->jurusan == '' ? 'selected' : '' }}>Pilih Jurusan</option>
                                <option value="PPLG" {{ $user->jurusan == 'PPLG' ? 'selected' : '' }}>Pengembangan Perangkat Lunak dan Gim</option>
                                <option value="TJKT" {{ $user->jurusan == 'TJKT' ? 'selected' : '' }}>Teknik Jaringan Komputer dan Telekomunikasi</option>
                                <option value="TO" {{ $user->jurusan == 'TO' ? 'selected' : '' }}>Teknik Otomotif</option>
                                <option value="TP" {{ $user->jurusan == 'TP' ? 'selected' : '' }}>Teknik Pengelasan</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="action-buttons">
                    <button type="submit" class="btn btn-save" id="saveButton">
                        <i class="fas fa-save"></i> 
                        <span>Simpan Perubahan</span>
                    </button>
                    <a href="{{ route('profile') }}" class="btn btn-cancel">
                        <i class="fas fa-times"></i> 
                        <span>Batal</span>
                    </a>
                </div>
            </form>
        </div>
    </div>

    <script>
    // Preview Image
    function previewImage(input) {
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            const preview = document.getElementById('avatar-preview');
            const placeholder = document.getElementById('avatar-preview-placeholder');
            
            reader.onload = function(e) {
                if (preview.tagName === 'IMG') {
                    preview.src = e.target.result;
                } else {
                    const img = document.createElement('img');
                    img.src = e.target.result;
                    img.id = 'avatar-preview';
                    img.className = 'avatar';
                    placeholder.parentNode.replaceChild(img, placeholder);
                }
            }
            
            reader.readAsDataURL(input.files[0]);
        }
    }

    // Form Validation & Submit Animation
    document.getElementById('editForm').addEventListener('submit', function(e) {
        const saveButton = document.getElementById('saveButton');
        const buttonText = saveButton.querySelector('span');
        const buttonIcon = saveButton.querySelector('i');

        saveButton.classList.add('loading');
        buttonIcon.className = 'fas fa-spinner fa-spin';
        buttonText.textContent = 'Menyimpan...';
    });

    // Input Validation
    document.querySelectorAll('.form-control').forEach(input => {
        input.addEventListener('input', function() {
            const successIcon = this.parentElement.querySelector('.success-icon');
            if (this.value.trim() !== '') {
                successIcon.style.opacity = '1';
            } else {
                successIcon.style.opacity = '0';
            }
        });
    });
    </script>
</body>
</html>
