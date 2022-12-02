<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Depositor;
use App\Models\guardian;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\Console\Input\Input;

class DepositorController extends Controller
{
    //update the email on the verification section if user mistype the email
    public function update_email(Request $request){
        $validate_email = $request->validate([
            'email' => 'required', 'string', 'email', 'max:255', 'unique:users'
        ]);
        $data=User::find($request->id);
        $data->email = $request->email;
        $data->save();
        return redirect('/email/verify');
    }

    //get the personal data of depositor and return to the update page, putting the data on the input fields
    public function update_personal_info(){
       $data = Depositor::all()->where('depositor_id', Auth::user()->id);
       $guardian = guardian::all()->where('depositor_id', Auth::user()->id);
       $branch = Branch::all();
        return view('page.profile_update.update', compact('data', 'branch', 'guardian'));
    
    }

    //updates the personal information
    public function update_personal_information(Request $request){
        //update depositors table
        $personal_info = Depositor::find($request->id);
        $personal_info->firstname = $request->firstname;
        $personal_info->lastname = $request->lastname;
        $personal_info->middlename =$request->middlename;
        $personal_info->suffix = $request->suffix;
        $personal_info->date_of_birth = $request->date_of_birth;
        $personal_info->gender = $request->gender;
        $personal_info->home_address = $request->home_address;
        $personal_info->contact_no = $request->contact_no;
        $personal_info->branch_id = $request->branch_id;
        $personal_info->branch_under_id = $request->branch_under_id;

        $guardian_info = guardian::find($request->id);
        $guardian_info->guardian_firstname = $request->guardian_firstname;
        $guardian_info->guardian_lastname = $request->guardian_lastname;
        $guardian_info->guardian_middlename = $request->guardian_middlename;
        $guardian_info->guardian_suffix = $request->guardian_suffix;
        $guardian_info->guardian_date_of_birth = $request->guardian_date_of_birth;
        $guardian_info->guardian_gender = $request->guardian_gender;
        $guardian_info->guardian_relationship_to_depositor = $request->guardian_relationship_to_depositor;
        $guardian_info->guardian_civil_status = $request->guardian_civil_status;
        $guardian_info->guardian_oic_member = $request->guardian_oic_member;
        $guardian_info->guardian_home_address = $request->guardian_home_address;
        $guardian_info->guardian_present_address = $request->guardian_present_address;
        $guardian_info->guardian_contact_no = $request->guardian_contact_no;

        $guardian_info->save();
        $personal_info->save();
        return redirect('/personal_info');
    }
}
