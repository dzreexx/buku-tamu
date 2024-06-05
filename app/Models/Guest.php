<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Guest extends Model
{
    use HasFactory;

    protected $dates = [
        'created_at',
        'updated_at',
        'check_in_at',
        'check_out_at',
    ];

    protected $fillable = [
        'nama',
        'user_id',
        'ticket_id',
        'telp',
        'nik',
        'ket',
        'check_in_at',
        'check_out_at',
        'selfie_path', // Tambahkan kolom selfie_path
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function ticket()
    {
        return $this->belongsTo(Ticket::class);
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'id'
    ];
}
