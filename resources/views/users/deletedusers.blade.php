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
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>User Name</th>
                            <th>
                                User E-mail
                            </th>
                            <th>Gender</th>
                            <th>Address</th>
                            <th>Phone Number</th>
                            {{--<th>Created At</th>--}}
                            <th>Restore User</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $user)
                            <tr>


                                <td>{{$user->first_name}}</td>
                                <td>{{$user->last_name}}</td>
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

                                <td>
                                    {{--<a href="#" data-toggle="modal" data-target="#delete_confirm" >--}}
                                    <a href="#" data-toggle="modal" onclick="showmodal({{$user->id}})" >
                                        <i class="livicon" data-name="users-add" data-size="18" data-loop="true" data-c="#f56954" data-hc="#f56954" title="delete user"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                    <!-- Modal for showing restore  confirmation -->
                    <div class="modal fade" id="delete_confirm" tabindex="-1" role="dialog" aria-labelledby="user_delete_confirm_title" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                    <h4 class="modal-title" id="user_delete_confirm_title">
                                        Restore User
                                    </h4>
                                </div>
                                <div class="modal-body">
                                    Are you sure to restore this user?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                    <input  type="button" class="btn btn-danger" value="Restore" id="delete_button">
                                    {{--<a href="{{url('deleteuser/')}}" type="button" class="btn btn-danger">Delete</a>--}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- row--> </section>


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
               var url='{{url('restoreuser')}}';
               axios.post(url,{'userid':userid})
                   .then(function (result) {
                       window.location='{{url('allusers')}}';
                   })

            })

        }
        </script>
    <script src="{{asset('template/vendors/modal/js/classie.js')}}"></script>
    <script src="{{asset('template/vendors/modal/js/modalEffects.js')}}"></script>
@endsection