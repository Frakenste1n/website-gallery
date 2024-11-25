<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    // Tentukan kolom yang dapat diisi (mass assignable)
    protected $fillable = [
        'name',
        'email',
        'password',
        'role'
    ];

    // Tentukan kolom yang harus disembunyikan (hidden) seperti password
    protected $hidden = [
        'password',
        'remember_token',
    ];

    // Tentukan kolom yang harus di-cast (seperti tanggal)
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // Relasi ke agenda (Jika perlu)
    // public function agendas()
    // {
    //     return $this->hasMany(Agenda::class);
    // }

    // Menggunakan accessor untuk mengecek role user
    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    public function isUser()
    {
        return $this->role === 'user';
    }
}
