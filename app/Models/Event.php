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

    use HasFactory;
}
