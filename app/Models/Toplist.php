<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Toplist extends Model
{
    protected $fillable = [
        'candidate_id',
        'portion_id',
        'result',
    ];

    public function candidate(){
        return $this->belongsTo(Candidate::class);
    }

    use HasFactory;
}
