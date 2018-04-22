@extends('layouts.main')
@section('style')
    <link rel="stylesheet" type="text/css" href="{{asset('template/vendors/datatables/css/dataTables.colReorder.min.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{asset('template/vendors/datatables/css/dataTables.scroller.min.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{asset('template/vendors/datatables/css/dataTables.bootstrap.css')}}" />
    <link href="{{asset('template/css/pages/tables.css')}}" rel="stylesheet" type="text/css">

    {{--select 2 css--}}
    <link href="{{asset('template/vendors/select2/select2.css')}}" rel="stylesheet" />
    <link rel="stylesheet" href="{{asset('template/vendors/select2/select2-bootstrap.css')}}" />


    {{--<link href="vendors/daterangepicker/css/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />--}}

    {{--<!--clock face css-->--}}
    {{--<link href="vendors/iCheck/skins/all.css" rel="stylesheet" />--}}
    {{--<link href="css/pages/formelements.css" rel="stylesheet" />--}}
    @endsection
@section('content')
    <section class="content-header">
        <!--section starts-->
        <h1>Advanced Datatables</h1>
        <ol class="breadcrumb">
            <li>
                <a href="index.html">
                    <i class="livicon" data-name="home" data-size="18" data-loop="true"></i>
                    Home
                </a>
            </li>
            <li>
                <a href="#">DataTables</a>
            </li>
            <li class="active">Advanced Datatables</li>
        </ol>
    </section>
    <!--section ends-->
    <section class="content">
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-primary filterable">
                    <div class="panel-heading clearfix  ">
                        <div class="panel-title pull-left">
                            <div class="caption">
                                <i class="livicon" data-name="camera-alt" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                                TableTools
                            </div>

                        </div>
                        <div class="tools pull-right"></div>

                    </div>
                    <div class="panel-body">
                        <a class="btn btn-success btn-large " data-toggle="modal" data-href="#responsive" href="#responsive">Add New Debtor</a>
                        <table class="table table-striped table-responsive" id="table1">
                            <thead>
                            <tr>

                                <th>Full Names</th>
                                <th>ID No</th>
                                <th>Phone Number</th>
                                <th>Alternative Phone Number</th>
                                <th>Current Debt</th>
                                <th>Maximum Limit Debt</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($debtors as $debtor)
                            <tr>

                                <td>{{$debtor->user->first_name}} {{$debtor->user->last_name}}</td>
                                <td>{{$debtor->user->id_no}}</td>
                                <td>{{$debtor->user->phone_number}}</td>
                                <td>{{$debtor->user->alternative_number}}</td>
                                <td>{{$debtor->current_debt}}</td>
                                <td>{{$debtor->max_limit_debt}}</td>
                                {{--<a class="btn btn-success btn-large " data-toggle="modal" data-href="#responsive" href="#responsive">Add New User</a>--}}

                                <td><a data-toggle="modal" data-target="#edditerModal" onclick="getDebtorId({{$debtor->id}});getDebtorLimit({{$debtor->max_limit_debt}})" href="#">
                                        <i class="livicon" data-name="info" data-size="18" data-loop="true" data-c="#428BCA" data-hc="#428BCA" title="view Debtor"></i>
                                    </a> </td>
                                <td> <a href="#" data-toggle="modal" onclick="showDeleteModal({{$debtor->id}});showcurentDebt({{$debtor->current_debt}})" >
                                        <i class="livicon" data-name="user-remove" data-size="18" data-loop="true" data-c="#f56954" data-hc="#f56954" title="delete user"></i>
                                    </a></td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        {{--new user modal--}}
        <div class="modal fade in" id="responsive" tabindex="-1" role="dialog" aria-hidden="false" style="display:none;">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <form action="{{url('addnewdebtor')}}" method="post">
                        {{csrf_field()}}
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title"> Add New Debtor</h4>
                    </div>

                    <div class="modal-body">

                        <div class="row">
                            <!--select2 starts-->
                            <div class="panel panel-info">
                                <div class="panel-heading">
                                    <h3 class="panel-title">
                                        <i class="livicon" data-name="bell" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                                        New Debtor
                                    </h3>
                                    <span class="pull-right clickable">
                                    <i class="glyphicon glyphicon-chevron-up"></i>
                                </span>
                                </div>

                                <div class="panel-body">
                                    <div class="form-group">
                                        <label for="e1" class="control-label">
                                           Select Identity Number for new Debtor
                                        </label>
                                        <select id="e1" class="form-control select2" name="newDebtor">
                                            @foreach($users as $user)
                                                <option value="{{$user->id}}">{{$user->id_no}}</option>
                                          @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="amount">Maximum Limit Debt</label><br>
                                        <input id="amount" placeholder="Maximum Limit Debt in KSH" class="form-control" name="limitDebt" value="100">
                                    </div>

                                    <!--ends--> </div>
                            </div>
                            <!--select2 ends-->
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" data-dismiss="modal" class="btn">Close</button>
                        <button type="submit" class="btn btn-primary">Save New Debtor</button>

                    </div>
                    </form>

                </div>
            </div>
        </div>

        {{--edit modal--}}
        <div class="modal fade in" id="edditerModal" tabindex="-1" role="dialog" aria-hidden="false" style="display:none;">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    {{--<form action="{{url('updateDebtorDetails/')}}" method="post">--}}
                        {{--{{csrf_field()}}--}}
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <h4 class="modal-title"> Edit Debtor</h4>
                        </div>

                        <div class="modal-body">

                            <div class="row">
                                <input id="selected_debtor_id" type="hidden" name="selected_debtor_id">

                                        <div class="form-group">
                                            <label for="amount">Maximum Limit Debt</label><br>
                                            <input id="debtor_limit_amount" placeholder="Maximum Limit Debt in KSH" class="form-control" name="limitDebt" required>

                                {{--<button id="testingButton">Tester</button>--}}
                                        </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" data-dismiss="modal" class="btn">Close</button>
                            <button type="button" id="submitUpdatedDetails" class="btn btn-primary" onclick="updateDebtor()">Update Debtor Details</button>

                        </div>
                    {{--</form>--}}

                </div>
            </div>
        </div>
        <!-- row-->
        {{--delete modal--}}
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
                        <input type="hidden" id="current_debt">
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

    </section>
    @endsection
@section('script')
    <script type="text/javascript" src="{{asset('template/vendors/datatables/jquery.dataTables.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('template/vendors/datatables/dataTables.tableTools.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('template/vendors/datatables/dataTables.colReorder.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('template/vendors/datatables/dataTables.scroller.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('template/vendors/datatables/dataTables.bootstrap.js')}}"></script>
    <script type="text/javascript" src="{{asset('template/js/pages/table-advanced.js')}}"></script>
    {{--select 2 js--}}
    <script src="{{asset('template/vendors/select2/select2.js')}}" type="text/javascript"></script>


    <script src="{{asset('template/vendors/input-mask/jquery.inputmask.js')}}" type="text/javascript"></script>
    <script src="{{asset('template/vendors/input-mask/jquery.inputmask.date.extensions.js')}}" type="text/javascript"></script>
    <script src="{{asset('template/vendors/input-mask/jquery.inputmask.extensions.js')}}" type="text/javascript"></script>
    <!-- date-range-picker -->
    <script src="{{asset('template/vendors/daterangepicker/daterangepicker.js')}}" type="text/javascript"></script>
    <script src="{{asset('template/vendors/iCheck/icheck.js')}}" type="text/javascript"></script>
    <script src="{{asset('template/vendors/iCheck/demo/js/custom.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('template/vendors/autogrow/js/jQuery-autogrow.js')}}" type="text/javascript"></script>
    <script src="{{asset('template/vendors/maxlength/bootstrap-maxlength.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('template/vendors/card/jquery.card.js')}}" type="text/javascript"></script>
    <script src="{{asset('template/js/pages/formelements.js')}}" type="text/javascript"></script>
    <script type="application/javascript">
        function getDebtorId(id) {
//            alert(id);
            $('#selected_debtor_id').val(id);
        }
        //getting the debtor limit amount as per now
        function getDebtorLimit(limit_amount) {
//            alert(limit_amount);
            //display the input tag with the current amount in the table
            $('#debtor_limit_amount').val(limit_amount);

//           
        }
        function updateDebtor() {
            //get the id of the debtor
            var id=$('#selected_debtor_id').val();
            //get th value in the input tag
            var updatedLimit=$('#debtor_limit_amount').val();
//            alert(updatedLimit);

            var url='{{url('updateDebtorDetails' )}}';
            axios.post(url,{'debtor_id_to_update':id,'updated_limit':updatedLimit})
                .then(function (result) {
//                    alert('saved');
                        window.location='{{url('debtors')}}';
                })
            //hide the modal before saving
//            $('#edditerModal').hide();
        }

    </script>
    <script type="application/javascript">
        //function t show the current debt
        function showcurentDebt(currentDebt) {
//            alert(currentDebt)
            $('#current_debt').val(currentDebt);
        }
        function showDeleteModal(debtorId) {
            var debtAmount=$('#current_debt').val();
            if (debtAmount==0){
                $('#delete_confirm').modal('show');
            }else{
                alert('The User Has Uncompleted Debt. The user has to first complete the debt in order to delete the user')
            }

            //now delete the debtor
            $('#delete_button').click(function () {
//                alert('')
                var url='{{url('deletingDebtor')}}';
                axios.post(url,{'debtor_id':debtorId})
                    .then(function (result) {
                        $('#delete_confirm').modal('hide');
                        window.location='{{url('debtors')}}';

                    })

            })
        }
    </script>
    <!-- end of page level js -->
@endsection