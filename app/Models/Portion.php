<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Portion extends Model
{
    protected $fillable = [
        'event_id',
        'user_id',
        'title',
        'numberOfCandidateToRate',
        'numberOfTopCandidate',
        'description',
        'isLock',
    ];

    public function criteria(){
        return $this->hasMany(Criteria::class);
    }

    public function rating(){
        return $this->hasMany(Rating::class);
    }

    public function toplist(){
        return $this->hasMany(Toplist::class);
    }

    public function event(){
        return $this->belongsTo(Event::class);
    }

    public function extra_toplist(){
        return $this->hasMany(Extra_toplist::class);
    }

    public function award(){
        return $this->hasMany(Award::class);
    }

    use HasFactory;
}
