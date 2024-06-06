<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;
    
    protected $fillable = ['number', 'is_used'];

    public function guest()
    {
        return $this->hasOne(User::class);
    }
}
