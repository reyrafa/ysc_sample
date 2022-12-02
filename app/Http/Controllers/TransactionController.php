<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Branch_under;
use App\Models\Depositor;
use App\Models\guardian;
use App\Models\history_of_transaction;
use App\Models\LvlOfTransac;
use App\Models\officer;
use App\Models\StatusOfTransaction;
use App\Models\Transaction;
use App\Models\User;
use App\Notifications\StatusAlert;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;
use League\CommonMark\Extension\Table\Table;
use Symfony\Contracts\Service\Attribute\Required;

class TransactionController extends Controller
{

    //getting the transactions from transaction table after clicking transaction link in the navigation bar then redirect to transaction interface
    public function index(){
        $transaction = Transaction::all()->where('depositor_id', Auth::user()->id);
        $officer = officer::all();
        $status_of_transaction = StatusOfTransaction::all();
        $level_of_transaction = LvlOfTransac::all();
        return view('page.transaction.index', compact('transaction' , 'status_of_transaction', 'level_of_transaction','officer'));
    }

    //getting the personal information of the depositor then redirect to profile interface
    public function personal_info(){
        $depositor = Depositor::all()->where('depositor_id', Auth::user()->id);
        $guardians = guardian::all()->where('depositor_id', Auth::user()->id);
        $branch = Branch::all();
        $branch_under = Branch_under::all();

        $transaction = Transaction::all()->where('depositor_id', Auth::user()->id);
        $status_of_transaction = StatusOfTransaction::all();
        $level_of_transaction = LvlOfTransac::all();

        return view('page.profile_update.index', compact('depositor', 'guardians','branch', 'branch_under', 'transaction' , 'status_of_transaction', 'level_of_transaction'));
    }
    public function showData($transaction_id){
   
    return Transaction::find($transaction_id);
    }

    //adding the transaction to transaction table after clicking the add transaction button on the modal
    public function add_receipt(Request $request){
        $user = User::all()->where('id', Auth::user()->id);
         
        //sending email notification
        $statusData =[
            'body' => 'Thank you for applying for the Youth Savers Club. Your application is on the process, We will notify you if your application is approved' ,
            'thankyou' => 'Thank You for your Patience.'
        ];

    Notification::send($user, new StatusAlert($statusData));
    
      // $data = Transaction::find($request->id);
        //$data->or_num=$request->or_num;
        //$data->amount = $request->amount;
        //$data->save();

        //adding the data to transaction table
        $document = new Transaction();
        $document->depositor_id = Auth::user()->id;
        $document->level_id =2;
        $document->status_id =1;
        $document->amount = $request->amount;
        $document->or_num = $request->or_num;
        
        if($request->hasFile('receipt')){
            $file =$request->file('receipt');
            $receipt = $file->getClientOriginalName();
            $filename = time() . '.'.$receipt;
            $file->move('uploads/Receipt' , $filename);
            $document->uploaded_receipt = $filename;
           
        }
        $document->save();

        //adding the data to the history of transaction table
        $history_of_transaction = new history_of_transaction();
        $history_of_transaction->depositor_id = Auth::user()->id;
        $history_of_transaction->status_id = 1;
        $history_of_transaction->level_id = 2;
        $history_of_transaction->save();

        
        return redirect('/transaction'); 
    }
}
