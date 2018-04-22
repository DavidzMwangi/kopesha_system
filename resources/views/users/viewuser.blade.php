@extends('layouts.main')
@section('style')
    <link href="{{asset('template/vendors/jasny-bootstrap/css/jasny-bootstrap.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('template/vendors/x-editable/css/bootstrap-editable.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('template/css/pages/user_profile.css')}}" rel="stylesheet" type="text/css"/>
   {{--modal--}}
    <link href="{{asset('template/vendors/modal/css/component.css')}}" rel="stylesheet" />

@endsection

@section('content')

    <section class="content-header">
        <!--section starts-->
        <h1>User Profile</h1>
        <ol class="breadcrumb">
            <li>
                <a href="{{url('/home')}}">
                    <i class="livicon" data-name="home" data-size="14" data-loop="true"></i>
                    Home
                </a>
            </li>
            <li>
                <a href="#">Users</a>
            </li>
            <li class="active">User Profile</li>
        </ol>
    </section>
    <!--section ends-->
    <section class="content">
        <div class="row">
            <div class="col-lg-12">
                <ul class="nav  nav-tabs ">
                    <li class="active">
                        <a href="#tab1" data-toggle="tab">
                            <i class="livicon" data-name="user" data-size="16" data-c="#000" data-hc="#000" data-loop="true"></i>
                           View User Profile</a>
                    </li>
                    <li>
                        <a href="#tab2" data-toggle="tab" id="tabber">
                            <i class="livicon" data-name="key" data-size="16" data-loop="true" data-c="#000" data-hc="#000"></i>
                            Edit User Profile</a>
                    </li>


                </ul>
                <div  class="tab-content mar-top">
                    <div id="tab1" class="tab-pane fade active in">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="panel">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">

                                            User Profile
                                        </h3>

                                    </div>
                                    <div class="panel-body">
                                        <div class="col-md-4">
                                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                                <div class="fileinput-new thumbnail img-file">
                                                    <img src="{{asset('uploads/user_pictures/' . $selecteduser->user_pic)}}" alt="Pictures"></div>
                                                <div class="fileinput-preview fileinput-exists thumbnail img-max"></div>

                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="panel-body">
                                                <div class="table-responsive">
                                                    <table class="table table-bordered table-striped" >
                                                        <tr>
                                                            <td>First Name</td>
                                                            <td>
                                                               {{ $selecteduser->first_name}}
                                                            </td>

                                                        </tr>
                                                        <tr>
                                                            <td>Last Name</td>
                                                            <td>
                                                                {{$selecteduser->last_name}}
                                                            </td>

                                                        </tr>
                                                        <tr>
                                                            <td>User Name</td>
                                                            <td>
                                                              {{$selecteduser->user_name}}
                                                            </td>

                                                        </tr>
                                                        <tr>
                                                            <td>E-mail</td>
                                                            <td>
                                                                {{$selecteduser->email}}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Phone Number</td>
                                                            <td>
                                                                {{$selecteduser->phone_number}}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Alternative Phone Number</td>
                                                            <td>
                                                                {{$selecteduser->alternative_number}}
                                                            </td>
                                                        </tr>

                                                        <tr>
                                                            <td>Address</td>
                                                            <td>
                                                                {{$selecteduser->address}}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Identity Number / Birth Certificate No</td>
                                                            <td>
                                                                {{$selecteduser->id_no}}                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Level</td>
                                                            <td>
                                                                @if( $selecteduser->level==1)
                                                                    Administrator
                                                                    @else
                                                                    User
                                                                    @endif
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Date Of Birth</td>
                                                            <td>
                                                                {{$selecteduser->DOB}}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Gender</td>
                                                            <td>
                                                                @if($selecteduser->gender=='male')
                                                                    Male
                                                                @else
                                                                    Female

                                                                    @endif
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Created At</td>
                                                            <td>
                                                               {{$selecteduser->created_at->toDateString()}}
                                                            </td>
                                                        </tr>

                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="tab2" class="tab-pane fade">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="panel">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">

                                            User Profile
                                        </h3>

                                    </div>
                                    <div class="panel-body">
                                        <div class="col-md-4">
                                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                                <div class="fileinput-new thumbnail img-file">
                                                    <img src="{{asset('uploads/user_pictures/' . $selecteduser->user_pic)}}" ></div>
                                                <div class="fileinput-preview fileinput-exists thumbnail img-max"></div>
                                                <div>
                                                    <form class="form form-horizontal" method="post" action="{{url('updateuserpic/'. $selecteduser->id )}}" enctype="multipart/form-data">
                                                        {{csrf_field()}}
                                                            <span class="btn btn-default btn-file">
                                                                <span class="fileinput-new">Select image</span>
                                                                <span class="fileinput-exists">Change</span>
                                                                <input type="file" name="image"></span>
                                                    <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
                                                    <input type="submit" class="btn btn-default fileinput-exists" value="Upload Picture">
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="panel-body">
                                                <div class="table-responsive">
                                                    <form name="updatetable">
                                                    <table class="table table-bordered table-striped" id="users">

                                                        <tr>
                                                            <td>First Name</td>
                                                            <td>
                                                              <input class="form-control" id="first_name" name="first_name" value="{{ $selecteduser->first_name}}" type="text" >
                                                            </td>

                                                        </tr>
                                                        <tr>
                                                            <td>Last Name</td>
                                                            <td>
                                                                <input name="last_name" id="last_name" type="text" class="form-control" value="{{$selecteduser->last_name}}">
                                                            </td>

                                                        </tr>
                                                        <tr>
                                                            <td>User Name</td>
                                                            <td>
                                                                <input name="user_name" id="user_name" class="form-control" type="text" value="{{$selecteduser->user_name}}" >
                                                            </td>

                                                        </tr>
                                                        <tr>
                                                            <td>E-mail</td>
                                                            <td>
                                                                <input  class="form-control"  id="email" value="{{$selecteduser->email}}" name="email" type="email">
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Phone Number</td>
                                                            <td>
                                                               <input class="form-control" id="phone_number" name="phone_number" type="text" value="{{$selecteduser->phone_number}}">
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Alternative Phone Number</td>
                                                            <td>
                                                               <input class="form-control" id="alternative_number" name="alternative_number" value="{{$selecteduser->alternative_number}}">
                                                            </td>
                                                        </tr>

                                                        <tr>
                                                            <td>Address</td>
                                                            <td>
                                                               <input  class="form-control" value="{{$selecteduser->address}}" name="address" id="address" type="text">
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Identity Number / Birth Certificate No</td>
                                                            <td>
                                                                <input  class="form-control" value="{{$selecteduser->id_no}}" name="id_no" id="id_no" type="text">
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Level</td>
                                                            <td>

                                                                   <select id="level" name="level" class="form-control">
                                                                       <option value="1" {{($selecteduser->level==1)?'selected':""}} >Administrator</option>

                                                                       <option value="2" {{($selecteduser->level==2)?'selected':""}}>User</option>

                                                                   </select>

                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Date Of Birth</td>
                                                            <td>
                                                             <input type="" id="DOB" class="form-control" value=" {{$selecteduser->DOB}}" name="DOB">
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Gender</td>
                                                            <td>
                                                                    Male
                                                                <input type="radio" name="gender" class="gendering" value="male" {{($selecteduser->gender=='male')?"checked":""}}>
                                                                    Female
                                                                    <input type="radio"  class="gendering" name="gender" value="female" {{($selecteduser->gender=='female')?"checked":""}}>


                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Created At</td>
                                                            <td>
                                                                {{$selecteduser->created_at->toDateString()}}
                                                            </td>
                                                        </tr>
                                                    </table>
                                                    </form>
                                                    <button class="btn btn-primary" id="updaterbutton" onclick="updateuser('{{$selecteduser->id}}')">Update User</button>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade in" id="responsive" tabindex="-1" role="dialog" aria-hidden="false" style="display:none;">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">


                        <div class="modal-body">
                            <div class="row">
                                @if($errors->has('Update'))
                                    <div class="alert-success">
                                            <h4>{{$errors->first('Update')}}</h4><br>
                                    </div>
                                @elseif($errors->has('problem'))
                                    <div class="alert-danger">
                                        <h4>{{$errors->first('problem')}}</h4><br>
                                    </div>
                                @endif

                            </div>
                        </div>

                </div>
            </div>
        </div>
        <div class="modal fade in" id="responsive2" tabindex="-1" role="dialog" aria-hidden="false" style="display:none;">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">


                        <div class="modal-body">
                            <div class="row">
                                {{--@if($errors->has('Update'))--}}
                                    <div class="alert-success">
                                            <h4>The User Details Have Been Successfully Updated</h4><br>
                                    </div>
                                {{--@elseif($errors->has('problem'))--}}
                                    {{--<div class="alert-danger">--}}
                                        {{--<h4>{{$errors->first('problem')}}</h4><br>--}}
                                    {{--</div>--}}
                                {{--@endif--}}

                            </div>
                        </div>

                </div>
            </div>
        </div>

    </section>
    @endsection

@section('script')
    <script  src="{{asset('template/vendors/jasny-bootstrap/js/jasny-bootstrap.js')}}" type="text/javascript"></script>
    <script src="{{asset('template/vendors/x-editable/jquery.mockjax.js')}}" type="text/javascript"></script>
    <script src="{{asset('template/vendors/x-editable/bootstrap-editable.js')}}" type="text/javascript"></script>
    <script src="{{asset('template/js/pages/user_profile.js')}}" type="text/javascript"></script>
            {{--modal--}}
    <script src="{{asset('template/vendors/modal/js/classie.js')}}"></script>
    <script src="{{asset('template/vendors/modal/js/modalEffects.js')}}"></script>
    <script type="application/javascript">
        $('#tabber').click(function () {
//            alert('saved');

        });
    function updateuser(userid) {
            var form=document.forms.namedItem('updatetable');
            var popoer=new FormData(form);

        var url='{{url('updateuser/' . $selecteduser->id)}}';
//alert(popoer);

        axios.post(url,popoer)
            .then(function (result) {
                $('#responsive2').show();
                setTimeout(function () {
                    $('#responsive2').hide()
                },2500);
                window.location='{{url('home')}}';

            })
    }

//    code to display the modal

        @if(count($errors)>0)
            $('#responsive').show();
            setTimeout(function () {
                $('#responsive').hide()
            },2000);
//        setTimeout( function() { $( "#SimpleModalBox" ).modal( "hide" ) }, 3000 );

        @endif
    </script>
    @endsection