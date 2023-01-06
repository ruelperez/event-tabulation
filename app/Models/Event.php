<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = [
        'title',
        'description',
    ];

    public function judge(){
        return $this->hasMany(Judge::class);
    }

    use HasFactory;
}
