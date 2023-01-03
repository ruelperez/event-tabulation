<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
use App\Models\Criteria;
use Illuminate\Http\Request;

class ScoringController extends Controller
{
    public function render(){
        $candidate = Candidate::all();
        $criteria = Criteria::all();

        return view('scoring', ['candidate' => $candidate, 'criteria' => $criteria]);
    }
}
