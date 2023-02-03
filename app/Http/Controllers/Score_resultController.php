<?php

namespace App\Http\Controllers;

use App\Models\Rating;
use Illuminate\Http\Request;

class Score_resultController extends Controller
{
    public function getData(){
        $data = Rating::all();
        return (['raing_data' => $data]);
    }
}
