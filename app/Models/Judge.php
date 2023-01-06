<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Judge extends Model
{
    protected $fillable = [
        'event_id',
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
