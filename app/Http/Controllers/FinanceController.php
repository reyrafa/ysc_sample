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
use App\Models\User;
use App\Notifications\StatusAlert;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;

class FinanceController extends Controller
{
    public function index(){
        $officer = officer::all()->where('relation_id', Auth::user()->id);
        return view('officer.finance.home.index', compact('officer'));
    }

    public function transaction(){
        $officer = officer::all()->where('relation_id', Auth::user()->id);
        $transaction = Transaction::all();
        $depositor = Depositor::all();


        $result = array();

        foreach($transaction as $key => $transaction_info){
            if($transaction_info->level_id == '2' && $transaction_info->status_id == '1'){
                $id = $transaction_info->depositor_id;
                $result[$id][] = $transaction_info->amount;

            }
        }

        $new = array();
        foreach($result as $key => $value){
            $new[]= array('depositor_id' => $key, 'quantity' =>array_sum($value));
        }
        return view('officer.finance.transaction.index', compact('officer', 'transaction', 'depositor', 'new'));
    }

    public function approve_transaction(Request $request){
        $user = User::all()->where('id', $request->depositor_id);

       
         
        //sending email notification
        $statusData =[
            'body' => 'Thank you for applying for the Youth Savers Club. Your application is approved on Finance level. We will notify you, if your application is completely validated.' ,
            'thankyou' => 'Thank You for your Patience.'
        ];

    Notification::send($user, new StatusAlert($statusData));
        
        $transaction = Transaction::find($request->id);
        $transaction->status_id = '2';
        $transaction->officer_id = $request->officer_id;
        $transaction->remarks = $request->remarks;
        $transaction->save();
        $checker_same = Transaction::all()->where('depositor_id', $transaction->depositor_id);
        foreach($checker_same as $checker_same_info){
            if($checker_same_info->level_id == '2' && $checker_same_info->status_id == '1'){
            $checker_same_info->status_id = '2';
            $checker_same_info->officer_id = $request->officer_id;
            $checker_same_info->remarks = $request->remarks;
            $checker_same_info->save();
            }
        }

        $transaction_his = new history_of_transaction();
        $transaction_his->depositor_id = $transaction->depositor_id;
        $transaction_his->officer_id = $request->officer_id;
        $transaction_his->remarks = $request->remarks;
        $transaction_his->status_id = '2';
        $transaction_his->level_id = '2';
        $transaction_his->save();

        //process on adding another transaction for branch if depositor is approved on personnel and finance
        $checker = Transaction::all()->where('depositor_id', $transaction->depositor_id);
        foreach($checker as $checker_info){
            if($checker_info->level_id == '1' && $checker_info->status_id == '2'){
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

        return redirect('/finance/user/transaction');
        //return request()->input();

    }

    public function profile(){
        $officer = officer::all()->where('relation_id', Auth::user()->id);
        $position = position::all()->where('relation_id', Auth::user()->id);
        $position_descrip = positionDescrip::all();
        $branch = Branch::all();
        $branch_under = Branch_under::all();
        return view('officer.finance.profile.index', compact('officer', 'position', 'position_descrip', 'branch', 'branch_under'));
    }
    
    public function disapproved_transaction(Request $request){
        $user = User::all()->where('id', $request->depositor_id);

        $reason = $request->remarks;
         
        //sending email notification
        $statusData =[
            'body' => ['Your application is denied on Finance level because ' , $reason , '. Please open the online membership app for further details.'],
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
        $history_of_transaction->level_id = '2';
        $history_of_transaction->remarks = $request->remarks;
        $history_of_transaction->save();

        return redirect('/finance/user/transaction');
    }


    //route to receipts page
    public function receiptViewer(){
        $officer = officer::all()->where('relation_id', Auth::user()->id);

        $depositor = Depositor::all();
        $transaction = Transaction::all();
        return \view('officer.finance.receiptViewer.index', compact('officer', 'transaction', 'depositor'));
    }
}
