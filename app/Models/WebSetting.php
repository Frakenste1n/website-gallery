<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WebSetting extends Model
{
    protected $fillable = [
        'favicon',
        'title',
        'logo',
        'header_background',
        'header_text',
        'about_image',
        'about_title',
        'about_description',
        'footer_address',
        'footer_phone',
        'footer_email',
        'footer_facebook',
        'footer_instagram',
        'footer_youtube'
    ];
} 