<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Award extends Model
{
    protected $fillable = [
        'event_id',
        'user_id',
        'portion_id',
        'award_name'
    ];

    use HasFactory;
}
