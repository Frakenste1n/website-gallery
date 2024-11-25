<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Informasi extends Model
{
    use HasFactory;

    protected $table = 'informasi';
    
    protected $fillable = [
        'judul_info',
        'kategori_info',
        'artikel',
        'gambar'
    ];

    // Tambahkan untuk debugging
    protected static function booted()
    {
        static::creating(function ($model) {
            \Log::info('Creating informasi:', $model->toArray());
        });

        static::created(function ($model) {
            \Log::info('Created informasi:', $model->toArray());
        });
    }
}
