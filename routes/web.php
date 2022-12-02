<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Branch;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\ConditionController;
use App\Http\Controllers\DepositorController;
use App\Http\Controllers\DisabledController;
use App\Http\Controllers\FinanceController;
use App\Http\Controllers\PersonnelController;
use App\Http\Controllers\RedirectsUser;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ValidateUserIdController;
use App\Http\Controllers\TransactionController;
use App\Models\Branch_under;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View as FacadesView;
use Illuminate\View\View as ViewView;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//route login
Route::get('/', function () {
    return redirect ()->route ('login');
    //return view('welcome');
});

//route after user authenticated
Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    if(auth()->user()->scope == "depositor"){
        return view('dashboard');
    }
    return redirect('/')->with('error', "you dont have access to this page");
    
})->name('dashboard');

//route to get the branch under
Route::get('/findBranchUnder', [BranchController::class, 'findBranchUnder']);


Route::get('/validateUserId', [ValidateUserIdController::class, 'validateUserId'])->middleware('depositor', 'auth:sanctum', 'verified');

//route for validating the email address on registration
Route::get('/validateUserEmail', [ValidateUserIdController::class, 'validateUserEmail']);

//route for the transaction page
Route::get('/transaction',[TransactionController::class, 'index'])->name('transaction')->middleware('depositor', 'auth:sanctum', 'verified', 'isDisabled');

//route for the personal information page
Route::get('/personal_info',[TransactionController::class, 'personal_info'])->name('personal_info')->middleware('depositor', 'auth:sanctum', 'verified', 'isDisabled');


Route::get('/Branch',[BranchController::class, 'branch']);

//route for updating the email address in email verify page
Route::post('edit_email', [DepositorController::class, 'update_email'])->middleware('auth:sanctum');


Route::get('/add_receipt/{transaction_id}', [TransactionController::class, 'showData'])->middleware('depositor', 'auth:sanctum', 'verified', 'isDisabled');

//route for adding transaction
Route::post('add_receipt', [TransactionController::class, 'add_receipt'])->middleware('depositor', 'auth:sanctum', 'verified', 'isDisabled');

//route for updating personal info
Route::post('update_personal_information', [DepositorController::class, 'update_personal_information'])->middleware('depositor', 'auth:sanctum', 'verified', 'isDisabled');

//route to redirect on update personal info page
Route::get('/update_personal_info', [DepositorController::class, 'update_personal_info'])->middleware('depositor', 'auth:sanctum', 'verified', 'isDisabled');

//route to redirect to term page 
Route::get('/terms', [ConditionController::class, 'terms']);

//route to redirect to policy page
Route::get('/policy', [ConditionController::class, 'policy']);

//route to redirect user depends on his/her position
Route::get('redirects', [RedirectsUser::class, 'index'])->middleware('auth:sanctum');

//route to the admin user
Route::middleware(['auth:sanctum'])->get('/admin/user', [AdminController::class, 'index'])->name('home')->middleware('oic_officer', 'roleAdmin', 'isDisabled');

//route to redirect to user management page
Route::get('/admin/user/management', [AdminController::class, 'usermanagement'])->name('usermanagement')->middleware('oic_officer', 'roleAdmin', 'auth:sanctum', 'isDisabled');

//route to redirect to transaction history page
Route::get('/admin/user/transaction/history', [AdminController::class, 'transactionhistory'])->middleware('oic_officer', 'roleAdmin', 'auth:sanctum', 'isDisabled');

//route to  redirect to add user page after clicking add button
Route::get('/admin/user/management/add/user', [AdminController::class, 'add_officer'])->middleware('oic_officer', 'roleAdmin', 'auth:sanctum', 'isDisabled');

//route to add oic officer to the system
Route::post('admin/user/management/add/oic/user', [AdminController::class, 'add_oic_officer'])->middleware('oic_officer', 'roleAdmin', 'auth:sanctum', 'isDisabled');

//route to validate officer Id
Route::get('/validate_officer_id', [AdminController::class, 'add_officer_id'])->middleware('oic_officer', 'roleAdmin', 'auth:sanctum', 'isDisabled');

//route to search
Route::get('/search/users', [AdminController::class, 'search_user'])->name('search.user')->middleware('oic_officer', 'roleAdmin', 'auth:sanctum', 'isDisabled');

//route to update officer page
Route::get('/admin/user/management/update/officer/{relation_id}', [AdminController::class, 'update_officer'])->middleware('oic_officer', 'roleAdmin', 'auth:sanctum');

//update the officer
Route::post('/admin/user/management/update/officer/oic/officer', [AdminController::class, 'update_oic_officer'])->middleware('oic_officer', 'roleAdmin', 'auth:sanctum');

//route to ysc members page
Route::get('/admin/user/ysc/members', [AdminController::class, 'ysc_member'])->middleware('oic_officer', 'roleAdmin', 'auth:sanctum', 'isDisabled');

//route to personnel user
Route::get('/personnel/user', [PersonnelController::class, 'index'])->middleware('verified', 'auth:sanctum', 'oic_officer', 'rolePersonnel', 'isDisabled');

//route to transaction page on personnel dashboard
Route::get('/personnel/user/transactions', [PersonnelController::class, 'transaction'])->middleware('verified', 'auth:sanctum', 'oic_officer', 'rolePersonnel', 'isDisabled');

//route to approve application on personnel dashboard
Route::post('/approved/application', [PersonnelController::class, 'approve_application'])->middleware('verified', 'auth:sanctum', 'oic_officer', 'rolePersonnel', 'isDisabled');

//route to disapprove or denied application on the personnel dashboard
Route::post('/denied/application', [PersonnelController::class, 'denied_application'])->middleware('verified', 'auth:sanctum', 'oic_officer', 'rolePersonnel', 'isDisabled');

//route to redirect to youth members page on personnel dashboard
Route::get('/personnel/user/ysc/members', [PersonnelController::class, 'ysc_member'])->middleware('verified', 'auth:sanctum', 'oic_officer', 'rolePersonnel', 'isDisabled');

//route to profile page on personnel dashboard
Route::get('/personnel/user/profile', [PersonnelController::class, 'profile'])->middleware('verified', 'auth:sanctum', 'oic_officer', 'rolePersonnel', 'isDisabled');

//route to finance user
Route::get('/finance/user', [FinanceController::class, 'index'])->middleware('verified', 'auth:sanctum', 'oic_officer', 'roleFinance', 'isDisabled');

//route to redirect to transaction page on finance user
Route::get('/finance/user/transaction', [FinanceController::class, 'transaction'])->middleware('verified', 'auth:sanctum', 'oic_officer', 'roleFinance', 'isDisabled');

//route to approve application on finance dashboard
Route::post('/approved/application/personnel', [FinanceController::class, 'approve_transaction'])->middleware('verified', 'auth:sanctum', 'oic_officer', 'roleFinance', 'isDisabled');

//route to disapprove application
Route::post('/denied/application', [FinanceController::class, 'disapproved_transaction'])->middleware('verified', 'auth:sanctum', 'oic_officer', 'roleFinance', 'isDisabled');

//route to profile page finance dashboard
Route::get('/finance/user/profile', [FinanceController::class, 'profile'])->middleware('verified', 'auth:sanctum', 'oic_officer', 'roleFinance', 'isDisabled');

//route to branch user
Route::get('/branch/user', [BranchController::class, 'index'])->middleware('verified', 'auth:sanctum', 'oic_officer', 'roleBranch', 'isDisabled');

//route to transaction on branch dashboard
Route::get('/branch/user/transaction', [BranchController::class, 'transaction'])->middleware('verified', 'auth:sanctum', 'oic_officer', 'roleBranch', 'isDisabled');

Route::get('/disabled/Account', [DisabledController::class, 'index'])->middleware('disabler');

Route::get('/admin/user/report', [ReportController::class, 'adminIndex'])->middleware('oic_officer', 'roleAdmin', 'auth:sanctum', 'isDisabled');

Route::get('/finance/user/receipts', [FinanceController::class, 'receiptViewer'])->middleware('verified', 'auth:sanctum', 'oic_officer', 'roleFinance', 'isDisabled');

Route::post('/branch/user/approve/application', [BranchController::class, 'approve_application'])->middleware('verified', 'auth:sanctum', 'oic_officer', 'roleBranch', 'isDisabled');

Route::post('/alumni/admit',[ReportController::class, 'alumni'])->middleware('oic_officer', 'roleAdmin', 'auth:sanctum', 'isDisabled');