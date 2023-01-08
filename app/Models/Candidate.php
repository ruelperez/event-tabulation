<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Candidate extends Model
{
    protected $fillable = [
        'candidate_num',
        'event_id',
        'user_id',
        'full_name',
        'team_name',
        'origin',
        'photo'
    ];
    use HasFactory;
}
