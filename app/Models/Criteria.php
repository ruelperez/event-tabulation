<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Criteria extends Model
{
    protected $fillable = [
        'portion_id',
        'title',
        'percentage'
    ];

    public function portion(){
        return $this->belongsTo(Portion::class);
    }

    use HasFactory;
}
