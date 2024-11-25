@extends('layouts.panel')

@section('title', 'Foto Album ' . $album->nama_album)

@section('content')
<style>
    .header {
        display: flex;
        flex-direction: column;
        align-items: flex-start;
        padding: 15px;
        background-color: #2C3E50;
        border-radius: 8px;
        margin-bottom: 20px;
        width: 100%;
    }

    .header-title {
        display: flex;
        justify-content: space-between;
        align-items: center;
        width: 100%;
    }

    .title-wrapper {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .header h2 {
        color: white;
        font-size: 28px;
        font-weight: bold;
        margin: 0;
    }

    .btn {
        padding: 8px 12px;
        color: white;
        border: none;
        border-radius: 4px;
        font-size: 14px;
        cursor: pointer;
        transition: background-color 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 5px;
    }

    .btn-create {
        background-color: #18BC9C;
    }

    .btn-create:hover {
        background-color: #16A085;
    }

    .btn-back {
        background-color: #95A5A6;
    }

    .btn-back:hover {
        background-color: #7F8C8D;
    }

    .btn-edit {
        background-color: #F39C12;
    }

    .btn-edit:hover {
        background-color: #D35400;
    }

    .btn-delete {
        background-color: #E74C3C;
    }

    .btn-delete:hover {
        background-color: #C0392B;
    }

    .alert {
        padding: 12px;
        border-radius: 4px;
        margin-bottom: 20px;
        font-size: 14px;
    }

    .alert-success {
        background-color: #18BC9C;
        color: white;
    }

    .alert-danger {
        background-color: #E74C3C;
        color: white;
    }

    .photos-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
        gap: 20px;
        padding: 20px;
        background: white;
        border-radius: 8px;
    }

    .photo-card {
        background: white;
        border: 1px solid #ddd;
        border-radius: 8px;
        overflow: hidden;
        transition: transform 0.2s;
    }

    .photo-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    }

    .photo-image {
        width: 100%;
        height: 200px;
        object-fit: cover;
    }

    .photo-details {
        padding: 15px;
    }

    .photo-title {
        font-size: 16px;
        font-weight: 500;
        color: #2C3E50;
        margin-bottom: 8px;
    }

    .photo-description {
        font-size: 14px;
        color: #7F8C8D;
        margin-bottom: 15px;
    }

    .photo-actions {
        display: flex;
        gap: 8px;
    }

    .upload-form {
        background: white;
        padding: 20px;
        border-radius: 8px;
        margin-bottom: 20px;
    }

    .form-group {
        margin-bottom: 15px;
    }

    .form-group label {
        display: block;
        margin-bottom: 8px;
        color: #2C3E50;
        font-weight: 500;
    }

    .form-control {
        width: 100%;
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 4px;
        font-size: 14px;
    }

    .form-control:focus {
        border-color: #3498DB;
        outline: none;
    }

    .photo-stats {
        display: flex;
        align-items: center;
        gap: 15px;
        margin-bottom: 10px;
        color: #7F8C8D;
    }

    .stat-item {
        display: flex;
        align-items: center;
        gap: 5px;
    }

    .btn-view {
        width: 35px;
        height: 35px;
        background: #3498db;
        color: white;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        text-decoration: none;
        transition: all 0.3s ease;
        margin-left: auto;
        box-shadow: 0 2px 5px rgba(52, 152, 219, 0.3);
    }

    .btn-view:hover {
        background: #2980b9;
        transform: translateY(-2px);
        box-shadow: 0 4px 10px rgba(52, 152, 219, 0.4);
        color: white;
        text-decoration: none;
    }

    .btn-view i {
        font-size: 1rem;
    }

    /* Modal Styles */
    .modal {
        display: none;
        position: fixed;
        z-index: 1000;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0,0,0,0.8);
    }

    .modal-content {
        position: relative;
        background-color: #fefefe;
        margin: 2% auto;
        padding: 20px;
        width: 90%;
        max-width: 1200px;
        border-radius: 8px;
        max-height: 90vh;
        overflow-y: auto;
    }

    .close {
        position: absolute;
        right: 20px;
        top: 10px;
        font-size: 28px;
        font-weight: bold;
        cursor: pointer;
        color: #7F8C8D;
    }

    .modal-body {
        display: flex;
        gap: 20px;
    }

    .modal-image {
        max-width: 60%;
        max-height: 70vh;
        object-fit: contain;
        border-radius: 8px;
    }

    .modal-details {
        flex: 1;
    }

    .comments-section {
        margin-top: 20px;
        border-top: 1px solid #ddd;
        padding-top: 20px;
    }

    .comment-item {
        padding: 10px;
        border-bottom: 1px solid #eee;
    }

    .comment-header {
        display: flex;
        justify-content: space-between;
        margin-bottom: 5px;
    }

    .comment-form {
        margin-top: 15px;
    }

    .comment-form textarea {
        width: 100%;
        margin-bottom: 10px;
    }

    @media (max-width: 768px) {
        .modal-body {
            flex-direction: column;
        }

        .modal-image {
            max-width: 100%;
        }
    }

    .modal {
        display: none;
        position: fixed;
        z-index: 1000;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0,0,0,0.5);
    }

    .modal-content {
        background-color: #fefefe;
        margin: 5% auto;
        padding: 20px;
        border-radius: 8px;
        width: 80%;
        max-width: 600px;
    }

    .modal-content h3 {
        margin-bottom: 20px;
        color: #2C3E50;
    }

    .close {
        color: #aaa;
        float: right;
        font-size: 28px;
        font-weight: bold;
        cursor: pointer;
    }

    .close:hover {
        color: #2C3E50;
    }

    .form-group {
        margin-bottom: 15px;
    }

    .form-group label {
        display: block;
        margin-bottom: 5px;
        color: #2C3E50;
    }

    .form-control {
        width: 100%;
        padding: 8px;
        border: 1px solid #ddd;
        border-radius: 4px;
    }

    .form-actions {
        display: flex;
        gap: 10px;
        margin-top: 20px;
    }

    .btn-primary {
        background-color: #3498DB;
    }

    .btn-primary:hover {
        background-color: #2980B9;
    }

    .btn-secondary {
        background-color: #95A5A6;
    }

    .btn-secondary:hover {
        background-color: #7F8C8D;
    }
</style>

<div class="header">
    <div class="header-title">
        <div class="title-wrapper">
            <h2>Foto Album: {{ $album->nama_album }}</h2>
            <i class="fas fa-images" style="color: white; font-size: 24px;"></i>
        </div>
        <div style="display: flex; gap: 10px;">
            <a href="{{ route('admin.gallery.index') }}" class="btn btn-back">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
            <button type="button" class="btn btn-create" onclick="toggleUploadForm()">
                <i class="fas fa-plus"></i> Tambah Foto
            </button>
        </div>
    </div>
</div>

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

<div class="upload-form" id="uploadForm" style="display: none;">
    <form action="{{ route('admin.gallery.photo.store', $album->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="judul_foto">Judul Foto</label>
            <input type="text" class="form-control @error('judul_foto') is-invalid @enderror" 
                   id="judul_foto" name="judul_foto" required>
            @error('judul_foto')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="deskripsi_foto">Deskripsi</label>
            <textarea class="form-control @error('deskripsi_foto') is-invalid @enderror" 
                      id="deskripsi_foto" name="deskripsi_foto"></textarea>
            @error('deskripsi_foto')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="path_foto">Pilih Foto</label>
            <input type="file" class="form-control @error('path_foto') is-invalid @enderror" 
                   id="path_foto" name="path_foto" accept="image/*" required>
            @error('path_foto')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-actions">
            <button type="submit" class="btn btn-create">
                <i class="fas fa-upload"></i> Upload Foto
            </button>
            <button type="button" class="btn btn-back" onclick="toggleUploadForm()">
                <i class="fas fa-times"></i> Batal
            </button>
        </div>
    </form>
</div>

<div class="photos-grid">
    @forelse($album->photos as $photo)
        <div class="photo-card">
            <div class="photo-wrapper">
                <img src="{{ asset('storage/' . $photo->path_foto) }}" 
                     alt="{{ $photo->judul_foto }}" 
                     class="photo-image">
            </div>
            <div class="photo-details">
                <h3 class="photo-title">{{ $photo->judul_foto }}</h3>
                <p class="photo-description">{{ Str::limit($photo->deskripsi_foto, 100) }}</p>
                <div class="photo-stats">
                    <span class="stat-item">
                        <i class="fas fa-heart"></i> {{ $photo->likes }}
                    </span>
                    <span class="stat-item">
                        <i class="fas fa-comments"></i> {{ $photo->comments_count }}
                    </span>
                    <a href="{{ route('admin.gallery.photo.detail', $photo->id) }}" 
                       class="btn-view" 
                       title="Lihat Detail">
                        <i class="fas fa-eye"></i>
                    </a>
                </div>
                <div class="photo-actions">
                    <button class="btn btn-edit" onclick="editPhoto({{ $photo->id }})">
                        <i class="fas fa-edit"></i> Edit
                    </button>
                    <form action="{{ route('admin.gallery.photo.destroy', $photo->id) }}" 
                          method="POST" 
                          style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-delete" 
                                onclick="return confirm('Apakah Anda yakin ingin menghapus foto ini?')">
                            <i class="fas fa-trash"></i> Hapus
                        </button>
                    </form>
                </div>
            </div>
        </div>
    @empty
        <div style="grid-column: 1/-1; text-align: center; padding: 20px; color: #7F8C8D;">
            Belum ada foto dalam album ini
        </div>
    @endforelse
</div>

<!-- Modal Detail Foto -->
<div id="photoModal" class="modal" style="display: none;">
    <div class="modal-content">
        <span class="close">&times;</span>
        <div class="modal-body">
            <img id="modalImage" src="" alt="" class="modal-image">
            <div class="modal-details">
                <h3 id="modalTitle"></h3>
                <p id="modalDescription"></p>
                <div class="stats-section">
                    <div class="likes-section">
                        <i class="fas fa-heart"></i>
                        <span id="modalLikes">0</span> likes
                    </div>
                </div>
                <div class="comments-section">
                    <h4>Komentar</h4>
                    <div id="commentsList"></div>
                    <form id="commentForm" class="comment-form">
                        @csrf
                        <input type="hidden" id="photoId" name="photo_id">
                        <textarea name="content" class="form-control" placeholder="Tambahkan komentar..." required></textarea>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-paper-plane"></i> Kirim
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Tambahkan modal edit di bagian bawah sebelum tag script -->
<div id="editPhotoModal" class="modal" style="display: none;">
    <div class="modal-content">
        <span class="close" onclick="closeEditModal()">&times;</span>
        <h3>Edit Foto</h3>
        <form id="editPhotoForm" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="edit_judul_foto">Judul Foto</label>
                <input type="text" 
                       class="form-control" 
                       id="edit_judul_foto" 
                       name="judul_foto" 
                       required>
            </div>

            <div class="form-group">
                <label for="edit_deskripsi_foto">Deskripsi</label>
                <textarea class="form-control" 
                          id="edit_deskripsi_foto" 
                          name="deskripsi_foto"></textarea>
            </div>

            <div class="form-group">
                <label for="edit_path_foto">Ganti Foto (Opsional)</label>
                <input type="file" 
                       class="form-control" 
                       id="edit_path_foto" 
                       name="path_foto" 
                       accept="image/*">
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Simpan Perubahan
                </button>
                <button type="button" class="btn btn-secondary" onclick="closeEditModal()">
                    <i class="fas fa-times"></i> Batal
                </button>
            </div>
        </form>
    </div>
</div>

<script>
function toggleUploadForm() {
    const form = document.getElementById('uploadForm');
    form.style.display = form.style.display === 'none' ? 'block' : 'none';
}

function editPhoto(photoId) {
    // Fetch data foto yang akan diedit
    fetch(`/admin/gallery/photos/${photoId}/details`)
        .then(response => response.json())
        .then(data => {
            // Isi form dengan data yang ada
            document.getElementById('edit_judul_foto').value = data.judul_foto;
            document.getElementById('edit_deskripsi_foto').value = data.deskripsi_foto;
            
            // Set action URL form
            const form = document.getElementById('editPhotoForm');
            form.action = `/admin/gallery/photos/${photoId}`;
            
            // Tampilkan modal
            document.getElementById('editPhotoModal').style.display = 'block';
        });
}

function closeEditModal() {
    document.getElementById('editPhotoModal').style.display = 'none';
}

// Tambahkan event listener untuk menutup modal saat klik di luar modal
window.onclick = function(event) {
    const editModal = document.getElementById('editPhotoModal');
    if (event.target == editModal) {
        editModal.style.display = 'none';
    }
}

function showPhotoDetails(photoId) {
    const modal = document.getElementById('photoModal');
    const modalImage = document.getElementById('modalImage');
    const modalTitle = document.getElementById('modalTitle');
    const modalDescription = document.getElementById('modalDescription');
    const modalLikes = document.getElementById('modalLikes');
    const commentsList = document.getElementById('commentsList');
    const photoIdInput = document.getElementById('photoId');

    // Fetch photo details using AJAX
    fetch(`/admin/gallery/photos/${photoId}/details`)
        .then(response => response.json())
        .then(data => {
            modalImage.src = `/storage/${data.path_foto}`;
            modalTitle.textContent = data.judul_foto;
            modalDescription.textContent = data.deskripsi_foto;
            modalLikes.textContent = data.likes;
            photoIdInput.value = photoId;

            // Render comments
            commentsList.innerHTML = data.comments.map(comment => `
                <div class="comment-item">
                    <div class="comment-header">
                        <strong>${comment.user.name}</strong>
                        <span>${new Date(comment.created_at).toLocaleDateString()}</span>
                    </div>
                    <p>${comment.content}</p>
                    <button onclick="deleteComment(${comment.id})" class="btn btn-delete btn-sm">
                        <i class="fas fa-trash"></i>
                    </button>
                </div>
            `).join('');

            modal.style.display = 'block';
        });
}

// Close modal when clicking the X
document.querySelector('.close').onclick = function() {
    document.getElementById('photoModal').style.display = 'none';
}

// Close modal when clicking outside
window.onclick = function(event) {
    const modal = document.getElementById('photoModal');
    if (event.target == modal) {
        modal.style.display = 'none';
    }
}

// Handle comment submission
document.getElementById('commentForm').onsubmit = function(e) {
    e.preventDefault();
    const photoId = document.getElementById('photoId').value;
    const content = this.content.value;

    fetch(`/admin/gallery/photos/${photoId}/comments`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        },
        body: JSON.stringify({ content })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            showPhotoDetails(photoId); // Refresh comments
            this.content.value = ''; // Clear form
        }
    });
};

function deleteComment(commentId) {
    if (confirm('Apakah Anda yakin ingin menghapus komentar ini?')) {
        fetch(`/admin/gallery/comments/${commentId}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                showPhotoDetails(document.getElementById('photoId').value); // Refresh comments
            }
        });
    }
}
</script>
@endsection
