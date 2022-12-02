<?php

namespace App\Http\Controllers;

use App\Models\position;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RedirectsUser extends Controller
{
    public function index(){
        $scope = Auth::user()->scope;
        $position = position::all()->where('relation_id', Auth::user()->id);
       
        if($scope == 'depositor'){
            return redirect('/dashboard');
        }
        else if($scope == 'oic_officer'){
            foreach($position as $position_info){
                if($position_info->position_id == '1'){
                   return redirect('/admin/user');
                }
                else if($position_info->position_id == '2'){
                    return redirect('/personnel/user');
                }
                else if($position_info->position_id == '3'){
                    return redirect('/finance/user');
                }
                else if($position_info->position_id == '4'){
                    return redirect('/branch/user');
                }
            }
        }
    }
}
