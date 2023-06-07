<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MinMaxRating extends Model
{
    protected $fillable = [
        'min',
        'max',
        'user_id',
        'event_id',
    ];

    use HasFactory;
}
