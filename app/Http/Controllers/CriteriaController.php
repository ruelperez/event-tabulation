<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
use App\Models\Criteria;
use Illuminate\Http\Request;

class CriteriaController extends Controller
{

    public function store(Request $request){

        //       $anti = floatval($request->percentage) / 100.00;

        function clean($string){
            $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.

            return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
        }
        $cri_data =clean($request->percentage);

            Criteria::create([
            'name' => $request->name,
            'percentage' => $cri_data
        ]);

        return redirect('/home')->with('message_cri', 'Data Save!!!');

    }




}