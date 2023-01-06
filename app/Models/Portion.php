<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Portion extends Model
{
    protected $fillable = [
        'event_id',
        'title',
        'description'
    ];

    use HasFactory;
}
