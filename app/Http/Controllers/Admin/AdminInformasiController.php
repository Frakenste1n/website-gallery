<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Informasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminInformasiController extends Controller
{
    public function index(Request $request)
    {
        $query = Informasi::query();

        // Filter berdasarkan pencarian
        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('judul_info', 'LIKE', "%{$search}%")
                  ->orWhere('artikel', 'LIKE', "%{$search}%");
            });
        }

        // Filter berdasarkan kategori
        if ($request->has('kategori') && $request->kategori !== '') {
            $query->where('kategori_info', $request->kategori);
        }

        $informasi = $query->orderBy('created_at', 'desc')->paginate(10);
        return view('admin.informasi.index', compact('informasi'));
    }

    public function create()
    {
        return view('admin.informasi.create');
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'judul' => 'required|string|max:255',
                'kategori' => 'required|in:Pengumuman,Berita,Prestasi,Kegiatan',
                'konten' => 'required|string',
                'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
            ]);

            $data = [
                'judul_info' => $validated['judul'],
                'kategori_info' => $validated['kategori'],
                'artikel' => $validated['konten']
            ];

            if ($request->hasFile('gambar')) {
                $path = $request->file('gambar')->store('informasi', 'public');
                $data['gambar'] = $path;
            }

            Informasi::create($data);

            return redirect()
                ->route('admin.informasi.index')
                ->with('success', 'Informasi berhasil ditambahkan');
        } catch (\Exception $e) {
            \Log::error('Error creating informasi: ' . $e->getMessage());
            return back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        $informasi = Informasi::findOrFail($id);
        return view('admin.informasi.edit', compact('informasi'));
    }

    public function update(Request $request, $id)
    {
        $informasi = Informasi::findOrFail($id);

        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'kategori' => 'required|in:Pengumuman,Berita,Prestasi,Kegiatan',
            'konten' => 'required|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        try {
            if ($request->hasFile('gambar')) {
                if ($informasi->gambar) {
                    Storage::disk('public')->delete($informasi->gambar);
                }
                $validated['gambar'] = $request->file('gambar')->store('informasi', 'public');
            }

            $informasi->update($validated);
            return redirect()->route('admin.informasi.index')->with('success', 'Informasi berhasil diperbarui');
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage())->withInput();
        }
    }

    public function destroy($id)
    {
        try {
            $informasi = Informasi::findOrFail($id);
            
            if ($informasi->gambar) {
                Storage::disk('public')->delete($informasi->gambar);
            }
            
            $informasi->delete();
            return redirect()->route('admin.informasi.index')->with('success', 'Informasi berhasil dihapus');
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
