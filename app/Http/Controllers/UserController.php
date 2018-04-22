<?php

namespace App\Http\Controllers;

use App\Facades\Lender;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\MessageBag;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function allUsers()
    {
//        $data=User::orderBy('id','desc')->get();
        $data=User::orderBy('id','desc')->where('deleted','=>',0)->get();
//        return json_encode($data);
        return View::make('users.users')->with('users',$data);
    }

    public function editUser()
    {
        return view('users.viewuser');
    }

    public function saveNewUser(Request $request)
    {
        $validator=Validator::make($request->all(),[
            'user_name'=>'required',
            'email'=>'required',
            'first_name'=>'required',
            'last_name'=>'required',
            'gender'=>'required',
            'address'=>'required',
            'DOB'=>'required',
            'phone_number'=>'required',
            'id_no'=>'required',
            'level'=>'required',

        ]);
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $data=new User();
        $data->user_name=$request->input('user_name');
        $data->email=$request->input('email');
        $data->password=bcrypt($request->input('password'));
        $data->first_name=$request->input('first_name');
        $data->last_name=$request->input('last_name');
        $data->gender=$request->input('gender');
        $data->DOB=$request->input('DOB');
        $data->phone_number=$request->input('phone_number');
        $data->id_no=$request->input('id_no');
        $data->address=$request->input('address');
        $data->alternative_number=$request->input('alternative_number');
        $data->level=$request->input('level');

        $data->user_pic='agent.png';
       // deleted is 0 if the user is still active
        $data->deleted=0;
        $data->save();

        return redirect()->back();
    }

    public function viewUser($userid)
    {
        $user=User::find($userid);
//        return json_encode($user);
        return View::make('users.viewuser')->with('selecteduser',$user);

    }

    public function updateUser(Request $request,$userid)
    {
        $data=User::find($userid);
        $data->user_name=$request->input('user_name');
        $data->email=$request->input('email');
        $data->password=bcrypt($request->input('password'));
        $data->first_name=$request->input('first_name');
        $data->last_name=$request->input('last_name');
        $data->gender=$request->input('gender');
        $data->DOB=$request->input('DOB');
        $data->phone_number=$request->input('phone_number');
        $data->address=$request->input('address');
        $data->alternative_number=$request->input('alternative_number');
        $data->level=$request->input('level');
//        $data->user_pic='agent.png';

        // deleted is 0 if the user is still active
        $data->deleted=0;
        $data->save();
    }

    public function updateUserPicture(Request $request,$userid)
    {
        if($request->hasFile("image")){
            if ($request->file('image')->isValid()) {
                //save the picture in public folder
                $destpath=public_path() . "/uploads/user_pictures/";
                $fileName=rand(111111,999999) . "." . $request->file('image')->getClientOriginalExtension();
                $request->file('image')->move($destpath, $fileName);

               //save the link to the database
                $data=User::find($userid);
                $data->user_pic=$fileName;
                $data->save();

                return redirect('allusers')->withErrors(new MessageBag(['Update'=>'The Picture has been updated']));
            }
        }
        else{


            return redirect()->back()->withErrors(new MessageBag(['problem'=>"The picture selected cannot be used as company profile"]));

        }

    }

    public function deleteUser(Request $request)
    {
        $data=User::find($request->input('deleteinguserid'));
        $data->deleted=1;
        $data->save();
//        return redirect('allusers');
//        return json_encode($data);
    }
    //display deleted users
    public function displayDeleted()
    {
        $data=User::where('deleted','=',1)->get();
       return View::make('users.deletedusers')->with('users',$data);
    }

    public function restoreUser(Request $request)
    {
        $data=User::find($request->input('userid'));
        $data->deleted=0;
        $data->save();
    }

//    public function tester()
//    {
//       $data= count(Lender::lender()->all());
//        return json_encode($data);
//    }
}
