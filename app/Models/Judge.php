<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Judge extends Authenticatable
{
    protected $fillable = [
        'judge_number',
        'event_id',
        'user_id',
        'full_name',
        'is_chairman',
        'photo',
        'username',
        'password'
    ];

    public function event(){
        return $this->belongsTo(Event::class);
    }

    use HasFactory;
}
