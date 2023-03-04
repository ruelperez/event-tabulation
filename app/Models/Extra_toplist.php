<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Extra_toplist extends Model
{
    protected $fillable = [
        'portion_id',
        'event_id',
        'candidate_id',
        'candidate_number',
        'judge_id',
    ];

    use HasFactory;
}
