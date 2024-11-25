<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\Photo;
use App\Models\Comment;
use App\Models\Like;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    public function index()
    {
        $albums = Album::withCount('photos')
            ->orderBy('created_at', 'desc')
            ->get();
        return view('user.gallery.index', compact('albums'));
    }

    public function show($id)
    {
        try {
            $album = Album::with(['photos' => function($query) {
                $query->with('comments.user')
                    ->orderBy('created_at', 'desc');
            }])->findOrFail($id);
            return view('user.gallery.show', compact('album'));
        } catch (\Exception $e) {
            return redirect()->route('gallery.index')
                ->with('error', 'Album tidak ditemukan');
        }
    }

    public function showPhotoDetail($id)
    {
        try {
            $photo = Photo::with(['comments.user', 'album'])->findOrFail($id);
            return view('user.gallery.photo-detail', compact('photo'));
        } catch (\Exception $e) {
            return back()->with('error', 'Foto tidak ditemukan');
        }
    }

    public function likePhoto($id)
    {
        try {
            $photo = Photo::findOrFail($id);
            $userId = auth()->id();
            
            // Cek apakah user sudah like
            $existingLike = Like::where('user_id', $userId)
                ->where('photo_id', $id)
                ->first();
                
            if ($existingLike) {
                // Jika sudah like, hapus like
                $existingLike->delete();
                $photo->decrement('likes');
                $isLiked = false;
            } else {
                // Jika belum like, tambah like
                Like::create([
                    'user_id' => $userId,
                    'photo_id' => $id
                ]);
                $photo->increment('likes');
                $isLiked = true;
            }

            return response()->json([
                'success' => true,
                'likes' => $photo->likes,
                'isLiked' => $isLiked
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan'
            ], 500);
        }
    }

    public function addComment(Request $request, $photoId)
    {
        $request->validate([
            'content' => 'required|string'
        ]);

        try {
            $photo = Photo::findOrFail($photoId);
            
            Comment::create([
                'photo_id' => $photoId,
                'user_id' => auth()->id(),
                'content' => $request->content
            ]);

            $photo->increment('komen');

            return back()->with('success', 'Komentar berhasil ditambahkan');
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan saat menambahkan komentar');
        }
    }

    public function deleteComment($id)
    {
        try {
            $comment = Comment::findOrFail($id);
            
            // Pastikan user yang menghapus adalah pemilik komentar
            if ($comment->user_id !== auth()->id()) {
                return back()->with('error', 'Anda tidak memiliki izin untuk menghapus komentar ini');
            }

            $photo = $comment->photo;
            $comment->delete();
            $photo->decrement('komen');

            return back()->with('success', 'Komentar berhasil dihapus');
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan saat menghapus komentar');
        }
    }
}
