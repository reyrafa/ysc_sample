<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Branch_under;
use App\Models\Depositor;
use App\Models\history_of_transaction;
use App\Models\officer;
use App\Models\OfficialMember;
use App\Models\Transaction;
use App\Models\User;
use App\Notifications\StatusAlert;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;

class BranchController extends Controller
{
    //getting the branch under and returning to the view as json
    public function findBranchUnder(Request $request){
        $data = Branch_under::select('branch_name', 'id')->where('branch_under_id', $request->id)->take(100)->get();

        return response()->json($data);
      }

      public function Branch(Request $request){
        
        $branch = Branch::select('branch_name')->where('branch_id', $request->id)->take(100)->get();
        return response()->json($branch);
      }

      public function index(){
        $officer = officer::all()->where('relation_id', Auth::user()->id);
        return view('officer.branch.home.index', compact('officer'));
      }

      public function transaction(){
        $officer = officer::all()->where('relation_id', Auth::user()->id);
        $transaction = Transaction::all();
        $depositor = Depositor::all();
        $branch = Branch::all();
        $branch_under = Branch_under::all();
        return view('officer.branch.transaction.index', compact('officer', 'transaction', 'depositor', 'branch', 'branch_under'));
      }
    


      public function approve_application(Request $request){
        $user = User::all()->where('id', $request->depositor_id);

            //sending email notification
            $statusData =[
              'body' => 'Thank you for applying for the Youth Savers Club. Your application is now approved. You are now officially member of Youth Savers Club.' ,
              'thankyou' => 'Thank You, God bless!!.'
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
       $history_of_transaction->level_id = '3';
       $history_of_transaction->remarks = $request->remarks;
       $history_of_transaction->save();


       //adding to official member table
       $official = new OfficialMember();
       $official->depositor_id =  $transaction->depositor_id;
       $official->isAlumni = '1';
       $official->save();

       return \redirect('/branch/user/transaction');

      }

}
