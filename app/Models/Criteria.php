<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Criteria extends Model
{
    protected $fillable = [
        'portion_id',
        'user_id',
        'title',
        'percentage',
        'isLink',
        'portionLink',
        'event_id',
    ];

    public function portion(){
        return $this->belongsTo(Portion::class);
    }

    public function event(){
        return $this->belongsTo(Event::class);
    }

    use HasFactory;
}
