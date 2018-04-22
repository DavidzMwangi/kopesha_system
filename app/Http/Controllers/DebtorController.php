<?php

namespace App\Http\Controllers;

use App\Models\Debtor;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;

class DebtorController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
    //$data2 displays the existing users except the ones in the debtors table
        //$data displays all the users in the debtors table

            //display all debtors
        $debtors=Debtor::all();


        //display existing users except the ones in the debtors table
        $abc=Debtor::pluck('user_id');
        $data2=User::whereNotIn('id',$abc)->get();
//        return ($data2);
        return View::make('debtors.debtors')->with('debtors',$debtors)->with('users',$data2);
    }

    public function newDebtor(Request $request)
    {
        $newdebtor=new Debtor();
        $newdebtor->user_id=$request->input('newDebtor');
        $newdebtor->max_limit_debt=$request->input('limitDebt');
        $newdebtor->save();
        return redirect('debtors');
    }

    public function updateDebtorDetails(Request $request)
    {
        //get the id of the debtor to be updated
        $debtorId=$request->input('debtor_id_to_update');
        $data=Debtor::find($debtorId);
        $data->max_limit_debt=$request->input('updated_limit');
        $data->save();

//        return redirect('debtors');
    }

    public function deleteDebtor(Request $request)
    {
        //get the id of the debtor to be deleted and delete
        Debtor::find($request->input('debtor_id'))->delete();
    }
}
