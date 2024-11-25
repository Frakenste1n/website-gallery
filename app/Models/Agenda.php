<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agenda extends Model
{
    use HasFactory;

    protected $table = 'agendas';
    
    protected $fillable = [
        'judul_agenda',
        'tgl_agenda',
        'lokasi',
        'deskripsi_agenda'
    ];

    protected $dates = [
        'tgl_agenda',
        'created_at',
        'updated_at'
    ];
}
