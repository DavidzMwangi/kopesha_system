<?php

namespace App\Http\Controllers;

use App\Models\Debtor;
use App\Models\Lender;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class LenderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        //make a list of existing lenders
        $lenders=Lender::all();

        //display the users who can be lenders exempting the existing lenders and those who have debts
        $data=Lender::pluck('user_id');
        //select the users who have debts and get their user id
        $debts=Debtor::where('current_debt','>',0)->pluck('user_id');
        //display the users who are not in the lenders table and have no debts in the system
        $data2=User::whereNotIn('id',$data)->whereNotIn('id',$debts)->get();

//        return($debts);
        return View::make('lender.lender')->with('lenders',$lenders)->with('users',$data2);
    }

    public function newLender(Request $request)
    {
        $data=new Lender();
        $data->user_id=$request->input('newLender');
        $data->max_amount=$request->input('lenderamount');
        $data->interest_rate_pm=$request->input('interest_rate');
        $data->save();
        return redirect('lenders');
    }

    public function updateLender(Request $request)
    {
        $data=Lender::find($request->input('selectedLenderId'));
        $data->max_amount=$request->input('updatedAmount');
        $data->interest_rate_pm=$request->input('updatedInterestRate');
        $data->save();

    }

    public function deleteLender(Request $request)
    {
        Lender::find($request->input('lenderId'))->delete();
    }
}
