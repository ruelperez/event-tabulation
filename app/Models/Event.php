<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = [
        'title',
        'photo',
        'description',
        'user_id',
    ];

    public function extra_toplist(){
        return $this->hasMany(Extra_toplist::class);
    }

    public function judge(){
        return $this->hasMany(Judge::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function candidate(){
        return $this->hasMany(Candidate::class);
    }

    public function portion(){
        return $this->hasMany(Portion::class);
    }

    public function toplist(){
        return $this->hasMany(Toplist::class);
    }

    public function criteria(){
        return $this->hasMany(Criteria::class);
    }

    use HasFactory;
}
