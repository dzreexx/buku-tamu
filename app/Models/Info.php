<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Info extends Model
{
    use HasFactory;


    protected $fillable = [
        'nama',
        'lokasi',
        'tanggal',
        'ket',
        'created_at',
        'update_at',
    ];
}
