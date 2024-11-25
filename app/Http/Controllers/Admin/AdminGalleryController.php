<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Album;
use App\Models\Photo; // Pastikan model Photo sudah ada
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminGalleryController extends Controller
{
    // Menampilkan halaman utama album beserta foto
    public function index()
    {
        $albums = Album::withCount('photos')->orderBy('created_at', 'desc')->get();
        return view('admin.gallery.index', compact('albums'));
    }

    // Menyimpan album baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_album' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'cover' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        if ($request->hasFile('cover')) {
            $validated['cover'] = $request->file('cover')->store('album-covers', 'public');
        }

        Album::create($validated);
        return redirect()->route('admin.gallery.index')->with('success', 'Album berhasil ditambahkan');
    }

    // Mengupdate album
    public function update(Request $request, $id)
    {
        $album = Album::findOrFail($id);

        $validated = $request->validate([
            'nama_album' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'cover' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        if ($request->hasFile('cover')) {
            // Hapus cover lama jika ada
            if ($album->cover) {
                Storage::disk('public')->delete($album->cover);
            }
            $validated['cover'] = $request->file('cover')->store('album-covers', 'public');
        }

        $album->update($validated);
        return redirect()->route('admin.gallery.index')->with('success', 'Album berhasil diperbarui');
    }

    // Menghapus album
    public function destroy($id)
    {
        $album = Album::findOrFail($id);
        
        // Hapus cover jika ada
        if ($album->cover) {
            Storage::disk('public')->delete($album->cover);
        }
        
        // Hapus semua foto dalam album
        foreach ($album->photos as $photo) {
            Storage::disk('public')->delete($photo->path_foto);
        }
        
        $album->delete();
        return redirect()->route('admin.gallery.index')->with('success', 'Album berhasil dihapus');
    }

    // Menampilkan foto dari album
    public function showPhotos($albumId)
    {
        try {
            $album = Album::with('photos')->findOrFail($albumId);
            return view('admin.gallery.photo', compact('album'));
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    // Menyimpan foto baru ke album
    public function createPhoto(Request $request, $albumId)
    {
        $validated = $request->validate([
            'judul_foto' => 'required|string|max:255',
            'deskripsi_foto' => 'nullable|string',
            'path_foto' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        
        try {
            $path = $request->file('path_foto')->store('photos', 'public');
            
            Photo::create([
                'album_id' => $albumId,
                'judul_foto' => $validated['judul_foto'],
                'deskripsi_foto' => $validated['deskripsi_foto'],
                'path_foto' => $path,
                'likes' => 0,
                'komen' => 0
            ]);

            return redirect()->route('admin.gallery.photo', $albumId)
                ->with('success', 'Foto berhasil ditambahkan');
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function editPhoto($id)
    {
        try {
            $photo = Photo::findOrFail($id);
            return response()->json([
                'id' => $photo->id,
                'judul_foto' => $photo->judul_foto,
                'deskripsi_foto' => $photo->deskripsi_foto,
                'path_foto' => $photo->path_foto
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Foto tidak ditemukan'
            ], 404);
        }
    }

    public function updatePhoto(Request $request, $id)
    {
        try {
            $photo = Photo::findOrFail($id);
            
            $validated = $request->validate([
                'judul_foto' => 'required|string|max:255',
                'deskripsi_foto' => 'nullable|string',
                'path_foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
            ]);

            // Update data foto
            $photo->judul_foto = $validated['judul_foto'];
            $photo->deskripsi_foto = $validated['deskripsi_foto'];

            // Jika ada file foto baru
            if ($request->hasFile('path_foto')) {
                // Hapus foto lama
                if ($photo->path_foto) {
                    Storage::disk('public')->delete($photo->path_foto);
                }
                // Upload foto baru
                $photo->path_foto = $request->file('path_foto')->store('photos', 'public');
            }

            $photo->save();

            return redirect()->back()->with('success', 'Foto berhasil diperbarui');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function destroyPhoto($id)
    {
        try {
            $photo = Photo::findOrFail($id);
            $albumId = $photo->album_id;

            // Hapus file foto dari storage
            if ($photo->path_foto) {
                Storage::disk('public')->delete($photo->path_foto);
            }

            // Hapus record dari database
            $photo->delete();

            return redirect()->route('admin.gallery.photo', $albumId)
                ->with('success', 'Foto berhasil dihapus');
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function postUpdatePhoto(Request $request, $id)
    {
        try {
            $validated = $request->validate([
                'judul_foto' => 'required|string|max:255',
                'deskripsi_foto' => 'nullable|string',
                'path_foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
            ]);

            $photo = Photo::findOrFail($id);

            // Update data foto
            $photo->judul_foto = $validated['judul_foto'];
            $photo->deskripsi_foto = $validated['deskripsi_foto'];

            // Jika ada file foto baru
            if ($request->hasFile('path_foto')) {
                // Hapus foto lama
                if ($photo->path_foto) {
                    Storage::disk('public')->delete($photo->path_foto);
                }
                // Upload foto baru
                $photo->path_foto = $request->file('path_foto')->store('photos', 'public');
            }

            $photo->save();

            return redirect()->back()->with('success', 'Foto berhasil diperbarui');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function create()
    {
        return view('admin.gallery.create');
    }

    public function edit($id)
    {
        try {
            $album = Album::findOrFail($id);
            return view('admin.gallery.edit', compact('album'));
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function getPhotoDetails($id)
    {
        $photo = Photo::with(['comments.user'])->findOrFail($id);
        return response()->json($photo);
    }

    public function storeComment(Request $request, $photoId)
    {
        $request->validate([
            'content' => 'required|string'
        ]);

        $photo = Photo::findOrFail($photoId);
        
        Comment::create([
            'photo_id' => $photoId,
            'user_id' => auth()->id(),
            'content' => $request->content
        ]);

        $photo->increment('komen');

        return redirect()->back()->with('success', 'Komentar berhasil ditambahkan');
    }

    public function destroyComment($id)
    {
        $comment = Comment::findOrFail($id);
        $photo = $comment->photo;
        
        $comment->delete();
        $photo->decrement('komen');

        return redirect()->back()->with('success', 'Komentar berhasil dihapus');
    }

    public function showPhotoDetail($id)
    {
        $photo = Photo::with(['comments.user'])->findOrFail($id);
        return view('admin.gallery.detail', compact('photo'));
    }
}