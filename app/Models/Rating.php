<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    protected $fillable = [
        'judge_id',
        'candidate_number',
        'criteria_id',
        'rating',
        'portion_id',
        'isSubmit',
    ];

    use HasFactory;
}
