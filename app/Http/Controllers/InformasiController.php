<?php

namespace App\Http\Controllers;

use App\Models\Informasi;
use Illuminate\Http\Request;
use Carbon\Carbon;

class InformasiController extends Controller
{
    public function index()
    {
        $informasi = Informasi::orderBy('created_at', 'desc')
            ->get()
            ->map(function($info) {
                $info->created_at = Carbon::parse($info->created_at);
                return $info;
            });

        return view('user.informasi.index', compact('informasi'));
    }

    public function show($id)
    {
        try {
            $informasi = Informasi::findOrFail($id);
            
            // Update status dibaca
            if (!$informasi->is_read) {
                $informasi->is_read = true;
                $informasi->save();
            }
            
            $informasi->created_at = Carbon::parse($informasi->created_at);
            return view('user.informasi.show', compact('informasi'));
        } catch (\Exception $e) {
            return redirect()->route('informasi.index')
                ->with('error', 'Informasi tidak ditemukan');
        }
    }
}
