@extends('layouts.main')
@section('style')
    <link rel="stylesheet" type="text/css" href="{{asset('template/vendors/datatables/css/dataTables.bootstrap.css')}}" />
    <link href="{{asset('template/css/pages/tables.css')}}" rel="stylesheet" type="text/css" />

    {{--modal--}}
    <link href="{{asset('template/vendors/modal/css/component.css')}}" rel="stylesheet" />

@endsection

@section('content')

    <section class="content-header">
        <h1>Users</h1>
        <ol class="breadcrumb">
            <li>
                <a href="{{url('home')}}">
                    <i class="livicon" data-name="home" data-size="16" data-color="#000"></i>
                    Dashboard
                </a>
            </li>
            <li>Users</li>
            <li class="active">Users</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content paddingleft_right15">
        <div class="row">
            <div class="panel panel-primary ">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <i class="livicon" data-name="user" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                       Add New user
                    </h4>
                </div>
                <br />
                <div class="panel-body">
                    {{--button to add a new user--}}
                    {{--<button type="button" class="btn btn-responsive button-alignment btn-Primary" style="margin-bottom:7px;" data-toggle="button">Button 1</button>--}}
                    <a class="btn btn-success btn-large pull-right" data-toggle="modal" data-href="#responsive" href="#responsive">Add New User</a>
                    {{--<button class="pull-right form-control" style="width: 20%">New User</button>--}}
                </div>
            </div>
        </div>
        <!-- row--> </section>




    <section class="content paddingleft_right15">
        <div class="row">
            <div class="panel panel-primary ">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <i class="livicon" data-name="user" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                      Existing Users
                    </h4>
                </div>
                <br />
                <div class="panel-body">
                    <table class="table table-bordered " id="table">
                        <thead>
                        <tr class="filters">
                            {{--<th>First Name</th>--}}
                            {{--<th>Last Name</th>--}}
                            <th>User Name</th>
                            <th>
                                User E-mail
                            </th>
                            <th>Gender</th>
                            <th>Address</th>
                            <th>Phone Number</th>
                            {{--<th>Created At</th>--}}
                            <th>View & Edit</th>
                            <th>Delete</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $user)
                        <tr>


                            {{--<td>{{$user->first_name}}</td>--}}
                            {{--<td>{{$user->last_name}}</td>--}}
                            <td>{{$user->user_name}}</td>
                            <td>
                               {{$user->email}}
                            </td>
                            <td>
                            @if($user->gender=='male')
                                Male
                                @else
                                Female
                                @endif
                            </td>
                            <td>  {{$user->address}}                       </td>
                            <td>    {{$user->phone_number}}                        </td>
                            {{--<td>--}}
                               {{--{{$user->created_at->toDateString()}}--}}
                            {{--</td>--}}
                            <td>
                                <a href="{{url('viewuser/' . $user->id)}}">
                                    <i class="livicon" data-name="info" data-size="18" data-loop="true" data-c="#428BCA" data-hc="#428BCA" title="view user"></i>
                                </a>
                            </td>
                            {{--<td>--}}
                                {{--<a href="}" data-toggle="modal" data-target="#delete_confirm">--}}
                                    {{--<i class="livicon" data-name="user-edit" data-size="18" data-loop="true" data-c="#f56954" data-hc="#f56954" title="View user"></i>--}}
                                {{--</a>--}}
                            {{--</td>--}}
                            <td>
                                {{--<a href="#" data-toggle="modal" data-target="#delete_confirm" >--}}
                                <a href="#" data-toggle="modal" onclick="showmodal({{$user->id}})" >
                                    <i class="livicon" data-name="user-remove" data-size="18" data-loop="true" data-c="#f56954" data-hc="#f56954" title="delete user"></i>
                                </a>
                            </td>
                        </tr>
                        @endforeach

                        </tbody>
                    </table>
                    <!-- Modal for showing delete confirmation -->
                    <div class="modal fade" id="delete_confirm" tabindex="-1" role="dialog" aria-labelledby="user_delete_confirm_title" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                    <h4 class="modal-title" id="user_delete_confirm_title">
                                        Delete User
                                    </h4>
                                </div>
                                <div class="modal-body">
                                    Are you sure to delete this user? This operation is irreversible.
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                    <input  type="button" class="btn btn-danger" value="Delete" id="delete_button">
                                    {{--<a href="{{url('deleteuser/')}}" type="button" class="btn btn-danger">Delete</a>--}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- row--> </section>


    <div class="modal fade in" id="responsive" tabindex="-1" role="dialog" aria-hidden="false" style="display:none;">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form action="{{url('savenewuser')}}" method="post">
                    {{csrf_field()}}
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">Add User</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                            @if(count($errors)>0)
                                <div class="alert-danger">
                                    @foreach($errors as $error)
                                        <h4>{{$error}}</h4><br>



                                        @endforeach
                                </div>



                                @endif
                        <div class="col-md-6">
                            <h4>User Name</h4>
                            <p>
                                <input id="user_name" name="user_name" type="text" placeholder="Enter User Name" class="form-control">
                            </p>
                            <h4>Email</h4>
                            <p>
                                <input id="email" name="email" type="email" placeholder="Email" class="form-control">
                            </p>
                            <h4>First Name</h4>
                            <p>
                                <input id="first_name" name="first_name" type="text" placeholder="First name" class="form-control">
                            </p>
                            <h4>Last Name</h4>
                            <p>
                                <input id="last_name" name="last_name" type="text" placeholder="Last name" class="form-control">
                            </p>
                            <h4>Identity Number</h4>

                            <p>
                                <input id="id_no" name="id_no" type="text" placeholder="Identity No/ BirthCertificate No" class="form-control">
                            </p>
                            <h4>Password</h4>
                            <p>
                                <input id="password" name="password" type="password" placeholder="Password" class="form-control">
                            </p>
                            <h4>Password Confirmation</h4>
                            <p>
                                <input id="confirm_password" name="password_confirmation" type="password" placeholder="Password Confirmation" class="form-control">
                            </p>

                        </div>
                        <div class="col-md-6">
                            <h4>Gender</h4>
                            <p class="radio-list">
                                <label for="male">Male</label>
                                <input id="male" name="gender" type="radio" value="male" class="">
                                <label for="female">Female</label>
                                <input id="female" name="gender" type="radio" value="female" class="">
                            </p>
                            <h4>Address</h4>
                            <p>
                                <input id="address" name="address" type="text" placeholder="Address" class="form-control">
                            </p>
                            <h4>Date Of Birth(DOB)</h4>
                            <p>
                                <input id="DOB" name="DOB" type="date" placeholder="DOB" class="form-control">
                            </p>
                            <h4>Phone Number</h4>
                            <p>
                                <input id="phone_number" name="phone_number" type="text" placeholder="Phone Number" class="form-control">
                            </p>
                            <h4>Alternative Number</h4>
                            <p>
                                <input id="alternative_number" name="alternative_number" type="text" placeholder="Alternative Number" class="form-control">
                            </p>
                            <p>
                                <label for="level">User Level</label><br>
                                <select id="level" name="level" class="form-control">
                                    <option disabled readonly>Choose one of the below</option>
                                    <option value="1">Administrator</option>
                                    <option value="2">User</option>
                                </select>
                            </p>
                        </div>


                    </div>
                </div>
                <div class="modal-footer">
                    <button type="reset" data-dismiss="modal" class="btn">Reset</button>
                    <button type="submit" class="btn btn-primary">Create New User</button>
                </div>
                </form>
            </div>
        </div>
    </div>

@endsection
@section('script')
    <script type="text/javascript" src="{{asset('template/vendors/datatables/jquery.dataTables.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('template/vendors/datatables/dataTables.bootstrap.js')}}"></script>
    <script>
        $(document).ready(function() {
            $('#table').dataTable();
        });
       function showmodal(userid) {
//           alert(userid);
          $('#delete_confirm').modal('show');
          $('#delete_button').click(function () {
              var url='{{url('deleteuser')}}';
              axios.post(url,{'deleteinguserid':userid})
                  .then(function (result) {
//                      alert(userid);
                      $('#delete_confirm').modal('hide');
                      window.location='{{url('allusers')}}';

                      {{--window.location('{{url('home')}}');--}}
                  })
          })

       }
    </script>
    {{--modal--}}
    <script src="{{asset('template/vendors/modal/js/classie.js')}}"></script>
    <script src="{{asset('template/vendors/modal/js/modalEffects.js')}}"></script>
    @endsection