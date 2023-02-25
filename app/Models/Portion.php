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
        'numberOfTopCandidate',
        'description'
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

    use HasFactory;
}
