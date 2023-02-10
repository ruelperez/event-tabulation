<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Candidate extends Model
{
    protected $fillable = [
        'candidate_number',
        'event_id',
        'user_id',
        'full_name',
        'team_name',
        'origin',
        'photo'
    ];

    public function toplist(){
        return $this->hasMany(Toplist::class);
    }
    use HasFactory;
}
