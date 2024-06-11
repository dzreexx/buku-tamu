<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;

    protected $fillable = [
        'judul',
        'thumb_path',
        'body',
        'excerpt',
        'created_at',
    ];
}
