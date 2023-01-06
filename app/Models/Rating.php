<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    protected $fillable = [
        'judge_id',
        'candidate_id',
        'criteria_id',
        'rating',
    ];

    use HasFactory;
}
