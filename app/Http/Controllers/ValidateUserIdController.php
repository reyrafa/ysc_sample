<?php

namespace App\Http\Controllers;

use App\Models\Validate_userId;
use Illuminate\Http\Request;

class ValidateUserIdController extends Controller
{
     //   public function validateUserId(Request $request){
     //   $data = Validate_userId::select('email')->where('user_id', $request->id)->take(100)->get();
     //   return response()->json($data);
     //   
     // }


     //getting the email address and returning it to register page to validate email as unique
      public function validateUserEmail(Request $request){
        $data = Validate_userId::select('email')->where('email', $request->id)->take(100)->get();
        return response()->json($data);
      }
}
