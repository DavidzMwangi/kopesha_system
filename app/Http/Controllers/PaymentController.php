<?php

namespace App\Http\Controllers;

use App\Models\Debtor;
use App\Models\Lender;
use App\Models\Payment;
use App\Models\Transaction;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\MessageBag;

class PaymentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $debtors=Debtor::where('current_debt','>',0)->get();
        return View::make('payments.add_payment')->with('debtors',$debtors);
    }

    public function transactionDetails(Request $request)
    {
        $transaction=Transaction::where('debtor_id_no','=',$request->input('debtor_id_no'))
                                ->where('amount','>',0)
                                 ->orderBy('id','desc')
                                ->where('is_confirmed','=',true)->first();
        //payment details of the latest record ie the record with the highest id
        $payment=Payment::where('debtor_id_no','=',$request->input('debtor_id_no'))->orderBy('id','desc')->first();
        return Response::json([
            'result1'=>$request->all(),
            'transaction1'=>$transaction,
            'payment1'=>$payment,
        ]);
    }

    public function savePayment(Request $request)
    {
        $validator=Validator::make($request->all(),[
            'debtor_id_no'=>'required',
            'transaction_id'=>'required',
            'amount_paid'=>'required',
            'remaining_amount_to_pay'=>'required',

        ]);
        if ($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $amount2=$request->input('amount_paid');
            $remaining2=$request->input('remaining_amount_to_pay');
        if($amount2>$remaining2){
            return redirect()->back()->withErrors(new MessageBag(['You',' are not allowed to pay more money than you have as debt']));
        }
        $data2=new Payment();
        $data2->debtor_id_no=$request->input('debtor_id_no');
        $data2->transaction_id=$request->input('transaction_id');
        $data2->amount_paid=$request->input('amount_paid');
        //compute the remaining amount to pay

        $new_remaining_amount=$remaining2-$amount2;

        //save the new remaining amount
        $data2->remaining_amount=$new_remaining_amount;
        $data2->save();


        //reduce the amount the debtor owes
        if($remaining2==$amount2){
            $the_debtor_id_no=$request->input('debtor_id_no');
            $id=User::where('id_no','=',$the_debtor_id_no)->first();
            $id2=$id->id;
//            return json_encode($id2);
            $debtor=Debtor::where('user_id','=',$id2)->first();
            $debtor->current_debt=0;
            $debtor->save();
            //increase the max amount lender can lend
            $transaction_record=Transaction::where('debtor_id_no','=',$request->input('debtor_id_no'))
                                            ->orderBy('debtor_id_no','desc')
                                            ->first();

            $a=User::where('id_no','=',$transaction_record->lender_id_no)->first();
            $c=$a->lender->user_id;
//           return json_encode($c);
            Lender::where('user_id','=',$c)->first()->increment('lended_amount',$transaction_record->amount);
        }

        return redirect()->back();

    }

    public function displayCompletedPayments()
    {
        $completed_payments=Payment::where('remaining_amount','=',0)->select('transaction_id')->get();

        //get the details of the transaction now
        $completed_transactions=Transaction::find($completed_payments);
//        return json_encode($completed_transactions);
        return View::make('payments.completed_payments')->with('completed_transactions',$completed_transactions);
    }

    public function displayAllPayments()
    {
        $payments=Payment::all();
        return View::make('payments.all_payments')->with('payments',$payments);
    }


}
