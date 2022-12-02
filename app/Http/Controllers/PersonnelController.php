<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Branch_under;
use App\Models\Depositor;
use App\Models\history_of_transaction;
use App\Models\officer;
use App\Models\position;
use App\Models\positionDescrip;
use App\Models\Transaction;
use App\Models\uploaded_document;
use App\Models\User;
use App\Notifications\StatusAlert;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;

class PersonnelController extends Controller
{   
    //redirect personnel to home page
    public function index(){
        $officer = officer::all()->where('relation_id', Auth::user()->id);
        return view('officer.personnel.home.index', compact('officer'));
    }

    //redirect personnel to transaction page with the data for the table
    public function transaction(){
        $officer = officer::all()->where('relation_id', Auth::user()->id);
        $depositor = Depositor::all();
        $uploaded_document = uploaded_document::all();
        $transaction = Transaction::all();
        return view('officer.personnel.transaction.index', compact('officer', 'depositor', 'uploaded_document', 'transaction'));
    }

    //process on updating the trasanction to approved in personnel
    public function approve_application(Request $request){
        $user = User::all()->where('id', $request->depositor_id);
         
        //sending email notification
        $statusData =[
            'body' => 'Thank you for applying for the Youth Savers Club. Your application is approved on Personnel level. We will notify you, if your application is completely validated.' ,
            'thankyou' => 'Thank You for your Patience.'
        ];

    Notification::send($user, new StatusAlert($statusData));
       $transaction = Transaction::find($request->id);
       $transaction->officer_id = $request->officer_id;
       $transaction->remarks = $request->remarks;
       $transaction->status_id = '2';
       $transaction->save();

       //process on adding the transaction to history table
        $history_of_transaction = new history_of_transaction();
        $history_of_transaction->depositor_id = $transaction->depositor_id;
        $history_of_transaction->officer_id = $request->officer_id;
        $history_of_transaction->status_id ='2';
        $history_of_transaction->level_id = '1';
        $history_of_transaction->remarks = $request->remarks;
        $history_of_transaction->save();

       //process on adding another transaction for branch if depositor is approved on personnel and finance
        $checker = Transaction::all()->where('depositor_id', $transaction->depositor_id);
        foreach($checker as $checker_info){
            if($checker_info->level_id == '2' && $checker_info->status_id == '2'){
                $transaction_for_branch = new Transaction();
                $transaction_for_branch->depositor_id = $transaction->depositor_id;
                $transaction_for_branch->status_id = '1';
                $transaction_for_branch->level_id ='3';
                $transaction_for_branch->save();
                
                $transaction_history = new history_of_transaction();
                $transaction_history->depositor_id = $transaction->depositor_id;
                $transaction_history->status_id = '1';
                $transaction_history->level_id = '3';
                $transaction_history->save();
                break;
            }        
        }
       

        return redirect('/personnel/user/transactions');
       // return request()->input();
    }

    //process on denying the application personnel
    public function denied_application(Request $request){
        $user = User::all()->where('id', $request->depositor_id);

        $reason = $request->remarks;
         
        //sending email notification
        $statusData =[
            'body' => ['Your application is denied on Personnel level because ' , $reason , '. Please open the online membership app for further details.'],
            'thankyou' => 'Thank You for your Patience.'
        ];

    Notification::send($user, new StatusAlert($statusData));
        $transaction_denied = Transaction::find($request->id);
        $transaction_denied->status_id = '3';
        $transaction_denied->officer_id = $request->officer_id;
        $transaction_denied->remarks = $request->remarks;
        $transaction_denied->save();

        $history_of_transaction = new history_of_transaction();
        $history_of_transaction->depositor_id = $transaction_denied->depositor_id;
        $history_of_transaction->officer_id = $request->officer_id;
        $history_of_transaction->status_id ='3';
        $history_of_transaction->level_id = '1';
        $history_of_transaction->remarks = $request->remarks;
        $history_of_transaction->save();

        return redirect('/personnel/user/transactions');
    }

    //redirect to ysc page 
    public function ysc_member(){
        $officer = officer::all()->where('relation_id', Auth::user()->id);
        return view('officer.personnel.ysc_member.index', compact('officer'));
    }

    //redirect personnel to profile page
    public function profile(){
        $officer = officer::all()->where('relation_id', Auth::user()->id);
        $position = position::all()->where('relation_id', Auth::user()->id);
        $position_descrip = positionDescrip::all();
        $branch = Branch::all();
        $branch_under = Branch_under::all();
        return view('officer.personnel.profile.index', compact('officer', 'position', 'position_descrip', 'branch', 'branch_under'));
    }
    
}
