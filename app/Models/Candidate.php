<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Candidate extends Model
{
    protected $fillable = [
        'fullname',
        'address',
        'photo',
        'team_name'
    ];
    use HasFactory;
}
