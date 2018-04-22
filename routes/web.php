<?php

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

Route::get('/','HomeController@index');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('main',function (){
   return view('layouts.main');
});


//users routes
Route::get('allusers','UserController@allUsers');
Route::get('edituser','UserController@editUser');
Route::post('savenewuser','UserController@saveNewUser');
Route::get('viewuser/{userid}','UserController@viewUser');
Route::post('updateuser/{userid}','UserController@updateUser');
Route::post('updateuserpic/{userid}','UserController@updateUserPicture');
Route::post('deleteuser','UserController@deleteUser');
//restore user
Route::get('deletedusers','UserController@displayDeleted');
Route::post('restoreuser','UserController@restoreUser');


//lender data
Route::get('lenders','LenderController@index');
Route::post('addnewlender','LenderController@newLender');
Route::post('updateLenderMaxAmount','LenderController@updateLender');
Route::post('deleteLender','LenderController@deleteLender');

//debtors
Route::get('debtors','DebtorController@index');
//add new debtor
Route::post('addnewdebtor','DebtorController@newDebtor');
Route::post('updateDebtorDetails','DebtorController@updateDebtorDetails');
Route::post('deletingDebtor','DebtorController@deleteDebtor');

//transactions
Route::get('transactions','TransactionController@index');
Route::post('lender_details','TransactionController@lenderDetails');
Route::post('new_transaction','TransactionController@newTransaction');
Route::post('getLenderFromDebtor','TransactionController@displayLenders');
Route::post('getDebtorMaxValue','TransactionController@MaxDebtAmount');

//processing transactions
Route::get('processingTransactions','TransactionController@processingTransaction');
Route::post('cancelTransactionCompletely','TransactionController@cancelTransaction');
Route::post('completeTransaction','TransactionController@completeTransaction');

//completed transactions
Route::get('completed_transactions','TransactionController@displayCompleted');
Route::post('edit_completed_transaction','TransactionController@editCompletedTransaction');
Route::get('adduser',function (){
    return view('auth.register');
});

//payment routes
Route::get('add_payment','PaymentController@index');
Route::post('fetch_transaction_details','PaymentController@transactionDetails');
Route::post('save_the_payment','PaymentController@savePayment');
Route::get('completed_payments','PaymentController@displayCompletedPayments');
Route::get('all_payments','PaymentController@displayAllPayments');
