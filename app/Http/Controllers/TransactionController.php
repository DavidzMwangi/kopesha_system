<?php

namespace App\Http\Controllers;

use App\Models\Debtor;
use App\Models\Lender;
use App\Models\Transaction;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\View;


class TransactionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        //display the existing debtors and lenders who will appear in the select2
        //debtors who have no debt as per now or have more cash i.e have a negative value
        $debtors=Debtor::where('current_debt','<=',0)->get();




        return View::make('transactions.transactions')->with('debtors',$debtors);

    }

    public function lenderDetails(Request $request)
    {
       $lender=Lender::find($request->input('lenderid'));
       return Response::json([
           'result'=>$request->all(),
           'lenderData'=>$lender,
       ]);
    }

    public function displayLenders(Request $request)
    {
        //get the selected debtor id no
        $debtor_id_no=$request->input('post_debtor_id_no');
        //get the id of the debtor from the user table
        $user_id=User::where('id_no','=',$debtor_id_no)->select('id')->first();

        //lenders who have more cash compared to the lended amount and the lender who is not the selected debtor
        $lenders=Lender::where('max_amount','>','lended_amount')->whereNotIn('user_id',$user_id)->get();
        return Response::json([
            'result22'=>$request->all(),
            'possible_lenders'=>$lenders->load([
                'User'
            ]),
        ]);
    }

    public function MaxDebtAmount(Request $request)
    {
        $debtor_id_no=$request->input('debtor_id_no_4_max');
        $id=User::where('id_no','=',$debtor_id_no)->select('id')->first();
        $id2=$id->id;
        $maxDebt=Debtor::where('user_id','=',$id2)->first();
        return Response::json([
            'debtor_max_limit'=>$maxDebt,
            'result6'=>$request->all(),
        ]);
    }

    public function newTransaction(Request $request)
    {
        //first get the id no if the lender from their id.
        $data1=$request->input('lender_id');
        $data2=Lender::find($data1);
        $data3=User::find($data2->user_id);
        //get the id no of the lender
        $data4=$data3->id_no;
//        return json_encode($data3->id_no);


        $data7=new Transaction();
        $data7->debtor_id_no=$request->input('debtor_id_no');
        $data7->lender_id_no=$data4;
        $data7->amount=$request->input('amount_borrow');
        $data7->payment_duration=$request->input('payment_duration');

//        determine the total amount to pay plus the interest

        //get the amount
        $lending_amount=$request->input('amount_borrow');
        //get the interest rate
        $interest_rate=$request->input('submit_interest_rate');
        //get the months duration
        $duration_pm=$request->input('payment_duration');
        $total_amount_and_interest=($lending_amount*($interest_rate/100)*$duration_pm)+$request->input('amount_borrow');

        $data7->total_amount_and_interest=$total_amount_and_interest;
        //today month
        $data7->processing_date=Carbon::today()->toDateString();
        //to determine the deadline4
        $number=$request->input('payment_duration');
        //save the interest rate per month
        $data7->interest_rate_pm=$request->input('submit_interest_rate');
        $data7->payment_end_date=Carbon::today()->addMonths($number)->toDateString();
        $data7->is_confirmed=false;
        $data7->save();

        //add the amount lended to the currently lended money of the lender
        $newLending=Lender::find($data1);
        $newLending->lended_amount=($newLending->lended_amount)+($request->input('amount_borrow'));
        $newLending->save();

        //add the lended amount to the debtor current amount
        //get the debtor id_no
        $debtor_id_no=$request->input('debtor_id_no');
        $data11=User::where('id_no','=',$debtor_id_no)->first();
        //get the id no of the debtor from the user table
        $data12=$data11->id;
        $data13=Debtor::where('user_id','=',$data12)->first();
        $data13->current_debt=($data13->current_debt)+($request->input('amount_borrow'));
        $data13->save();
        return redirect('processingTransactions');
    }
            //transaction processing methods
    public function processingTransaction()
    {
        $processingTransactions=Transaction::where('is_confirmed','=',false)->get();
        return View::make('transactions.processing_transactions')->with('processingTransactions',$processingTransactions);
    }

    public function cancelTransaction(Request $request)
    {
        //get the transaction id first
        $transaction_id=$request->input('transaction_id');
        $data=Transaction::find($transaction_id);
        $amount=$data->amount;
        //reduce the amount to the lender lended amount

                $lender_id=User::where('id_no','=',$data->lender_id_no)->first();
        //decrement the lended amount
        Lender::where('user_id','=',$lender_id->id)->first()->decrement('lended_amount',$amount);
        //reduce the debtor current debt amount by the amount in the transaction table
        $debtor_id=User::where('id_no','=',$data->debtor_id_no)->first();
        //decrement the debtor current debt
       Debtor::where('user_id','=',$debtor_id->id)->first()->decrement('current_debt',$amount);

        //then delete the transaction record
        Transaction::find($transaction_id)->delete();

//
    }

    public function completeTransaction(Request $request)
    {
        $transaction_id=$request->input('SelectedTransactionId');
        //change the is_confirmed to true
        $transaction=Transaction::find($transaction_id);
        $transaction->is_confirmed=true;
        $transaction->save();

//        return Response::json([
//            'crazy'=>'Success',
//            'result45'=>$request->all(),
//        ]);
    }
            //completed transactions
    public function displayCompleted()
    {
        $transactions=Transaction::where('is_confirmed','=',true)->get();


        return View::make('transactions.completed_transactions')->with('completedTransactions',$transactions);
    }

    public function editCompletedTransaction(Request $request)
    {
        $transactionId=$request->input('editted_transaction_id');
        $transaction=Transaction::find($transactionId);
        $duration=$transaction->payment_duration;
        $transaction->payment_duration=$request->input('edit_duration');

        //get the added no of months
        //get the duration that has been updated
           $value1=$request->input('edit_duration') ;
           $difference=$value1-$duration;
           $transaction->payment_end_date=Carbon::parse( $transaction->payment_end_date)->addMonths($difference);
           $transaction->save();
           return redirect()->back();
    }
}
