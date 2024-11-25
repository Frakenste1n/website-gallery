<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Informasi;
use App\Models\Photo;
use App\Models\Agenda;
use Carbon\Carbon;

class AdminDashboardController extends Controller
{
    public function index()
    {
        // Data untuk cards
        $data = [
            'totalUsers' => User::where('role', 'user')->count(),
            'totalInformasi' => Informasi::count(),
            'totalGallery' => Photo::count(),
            'totalAgenda' => Agenda::count(),
        ];

        // Data untuk tabel users terbaru
        $data['latestUsers'] = User::where('role', 'user')
                                 ->latest()
                                 ->take(5)
                                 ->select('name', 'email', 'created_at')
                                 ->get();

        // Data untuk tabel informasi terbaru (menggunakan nama kolom yang benar)
        $data['latestInformasi'] = Informasi::latest()
                                          ->take(5)
                                          ->select('judul_info', 'kategori_info', 'created_at')
                                          ->get();

        // Data untuk tabel agenda terbaru
        $data['latestAgenda'] = Agenda::latest()
                                    ->take(5)
                                    ->select('judul_agenda', 'tgl_agenda', 'created_at')
                                    ->get();

        // Data untuk aktivitas terbaru
        $data['recentActivities'] = collect()
            ->concat($data['latestUsers']->map(function($user) {
                return [
                    'type' => 'user',
                    'message' => "User baru terdaftar: {$user->name}",
                    'time' => $user->created_at,
                ];
            }))
            ->concat($data['latestInformasi']->map(function($info) {
                return [
                    'type' => 'info',
                    'message' => "Informasi baru ditambahkan: {$info->judul_info}",
                    'time' => $info->created_at,
                ];
            }))
            ->concat($data['latestAgenda']->map(function($agenda) {
                return [
                    'type' => 'agenda',
                    'message' => "Agenda baru ditambahkan: {$agenda->judul_agenda}",
                    'time' => $agenda->created_at,
                ];
            }))
            ->sortByDesc('time')
            ->take(10);

        // Data statistik per bulan (6 bulan terakhir)
        $sixMonthsAgo = Carbon::now()->subMonths(6);
        
        $data['monthlyStats'] = [
            'users' => User::where('created_at', '>=', $sixMonthsAgo)
                          ->where('role', 'user')
                          ->selectRaw('MONTH(created_at) as month, COUNT(*) as total')
                          ->groupBy('month')
                          ->get(),
            'informasi' => Informasi::where('created_at', '>=', $sixMonthsAgo)
                                 ->selectRaw('MONTH(created_at) as month, COUNT(*) as total')
                                 ->groupBy('month')
                                 ->get(),
        ];

        return view('admin.dashboard', $data);
    } 
} 
