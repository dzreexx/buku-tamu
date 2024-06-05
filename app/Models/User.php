<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nama',
        'email',
        // 'ticket_id',
        'telp',
        'nik',
        'password',
        // 'ket',
        // 'check_in_at',
        // 'check_out_at',
        'img_path', // Tambahkan kolom selfie_path
        'is_admin', // Tambahkan kolom selfie_path
    ];
    public function guest()
    {
        return $this->hasOne(Guest::class);
    }
    // public function ticket()
    // {
    //     return $this->belongsTo(Ticket::class);
    // }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'id',
        // 'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
