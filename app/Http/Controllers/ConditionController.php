<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ConditionController extends Controller
{   
    // redirect to term page
    public function terms(){
        return view('terms');
    }
    
    //redirect to policy page
    public function policy(){
        return view('policy');
    }
}
