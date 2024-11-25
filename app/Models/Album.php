<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_album',
        'deskripsi',
        'cover'
    ];

    public function photos()
    {
        return $this->hasMany(Photo::class);
    }

    public function getCoverUrlAttribute()
    {
        if ($this->cover && file_exists(public_path('storage/' . $this->cover))) {
            return asset('storage/' . $this->cover);
        }
        return asset('images/default-album-cover.jpg');
    }
}
