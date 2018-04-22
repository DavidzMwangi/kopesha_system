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
                        <a class="btn btn-success btn-large " data-toggle="modal" data-href="#responsive" href="#responsive">Add New Lender</a>
                        <table class="table table-striped table-responsive" id="table1">
                            <thead>
                            <tr>

                                <th>Full Names</th>
                                <th>ID No</th>
                                <th>Phone No</th>
                                <th>Current Lended Amount</th>
                                <th>Max Lending Amount</th>
                                <th>Interest Rate P.M.</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($lenders as $lender)
                                <tr>

                                    <td>{{$lender->user->first_name}} {{$lender->user->last_name}}</td>
                                    <td>{{$lender->user->id_no}}</td>
                                    <td>{{$lender->user->phone_number}}</td>
                                    <td>{{$lender->lended_amount}}</td>
                                    <td>{{$lender->max_amount}}</td>
                                    <td>{{$lender->interest_rate_pm}} %</td>
                                    <td><a data-toggle="modal" data-target="#edditerModal" onclick="getLenderId({{$lender->id}});getLenderAmount({{$lender->max_amount}});getLenderInterest({{$lender->interest_rate_pm}})" href="#">
                                            <i class="livicon" data-name="info" data-size="18" data-loop="true" data-c="#428BCA" data-hc="#428BCA" title="view Debtor"></i>
                                        </a> </td>
                                    <td> <a href="#" data-toggle="modal" onclick="showDeleteModal({{$lender->id}});showcurrentLendedAmount({{$lender->lended_amount}})" >
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
                    <form action="{{url('addnewlender')}}" method="post">
                        {{csrf_field()}}
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <h4 class="modal-title"> Add New Lender</h4>
                        </div>

                        <div class="modal-body">

                            <div class="row">
                                <!--select2 starts-->
                                <div class="panel panel-info">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">
                                            <i class="livicon" data-name="bell" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                                            New Lender
                                        </h3>
                                        <span class="pull-right clickable">
                                    <i class="glyphicon glyphicon-chevron-up"></i>
                                </span>
                                    </div>

                                    <div class="panel-body">
                                        <div class="form-group">
                                            <label for="e1" class="control-label">
                                                Select Identity Number for new Lender
                                            </label>
                                            <select id="e1" class="form-control select2" name="newLender" required>
                                                @foreach($users as $user)
                                                    <option value="{{$user->id}}">{{$user->id_no}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                        <label for="amount">Amount To Lend</label><br>
                                            <input id="amount" placeholder="Amount To Lend in KSH" class="form-control" name="lenderamount" >
                                        </div>
                                        <div class="form-group">
                                            <label for="interet_rate">Interest Rate per month (Default: 10%)</label><br>
                                            <input id="interest_rate" placeholder="Enter Interest rate per month not exceeding 15%" class="form-control" type="number" name="interest_rate" max="15">
                                        </div>
                                        <!--ends--> </div>
                                </div>
                                <!--select2 ends-->
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" data-dismiss="modal" class="btn">Close</button>
                            <button type="submit" class="btn btn-primary">Save New Lender</button>

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
                            <input id="selected_lender_id" type="hidden" name="selected_lender_id">
                            {{--<input id="selected_lender_amount" type="hidden" name="selected_lender_amount">--}}

                            <div class="form-group">
                                <label for="amount">Maximum Lending Amount</label><br>
                                <input id="max_amount" placeholder="Maximum Lending Amount in KSH" class="form-control" name="max_amount" required>

                                {{--<button id="testingButton">Tester</button>--}}
                            </div>
                            <div class="form-group">
                                <label for="updated_interest_rate">Interest Rate per month (Default: 10%)</label><br>
                                <input id="updated_interest_rate" placeholder="Enter Interest rate per month not exceeding 15%" class="form-control"  type="number" name="update_interest_rate" max="15">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" data-dismiss="modal" class="btn">Close</button>
                        <button type="button" id="submitUpdatedDetails" class="btn btn-primary" onclick="updateLender()">Update Debtor Details</button>

                    </div>
                    {{--</form>--}}

                </div>
            </div>
        </div>

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
                        <input type="hidden" id="current_lended_amount">
                        <input type="hidden" id="current_lender_id">
                        Are you sure to delete this user? This operation is irreversible.
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                        <input  type="button" class="btn btn-danger" value="Delete" id="delete_button" onclick="deleteLender()">
                        {{--<a href="{{url('deleteuser/')}}" type="button" class="btn btn-danger">Delete</a>--}}
                    </div>
                </div>
            </div>
        </div>

        <!-- row-->

        <!-- Third Basic Table Ends Here-->
        <!--delete modal starts here-->
    {{--<div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">--}}
    {{--<div class="modal-dialog">--}}
    {{--<div class="modal-content">--}}
    {{--<div class="modal-header">--}}
    {{--<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>--}}
    {{--<h4 class="modal-title custom_align" id="Heading">--}}
    {{--Delete this entry--}}
    {{--</h4>--}}
    {{--</div>--}}
    {{--<div class="modal-body">--}}
    {{--<div class="alert alert-warning">--}}
    {{--<span class="glyphicon glyphicon-warning-sign"></span>--}}
    {{--Are you sure you want to delete this Record?--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--<div class="modal-footer ">--}}
    {{--<button type="button" class="btn btn-warning">--}}
    {{--<span class="glyphicon glyphicon-ok-sign"></span>--}}
    {{--Yes--}}
    {{--</button>--}}
    {{--<button type="button" class="btn btn-warning" data-dismiss="modal">--}}
    {{--<span class="glyphicon glyphicon-remove"></span>--}}
    {{--No--}}
    {{--</button>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}
    <!-- /.modal ends here -->
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
        //getting the amount in the table now and displaying it in the input tag
        function getLenderAmount(lenderAmount) {
//            $('#selected_lender_amount').val(lenderAmount);
            $('#max_amount').val(lenderAmount);
        }
        function getLenderId(id) {
                //assign an input tag the id no
            $('#selected_lender_id').val(id);


        }
        function getLenderInterest(interest) {
            $('#updated_interest_rate').val(interest);
        }
        function updateLender() {
            var updatedAmount=$('#max_amount').val();
            var updatedInterest=$('#updated_interest_rate').val();
            var toUpdateLenderId=$('#selected_lender_id').val();
            var url='{{url('updateLenderMaxAmount')}}';
            axios.post(url,{'selectedLenderId':toUpdateLenderId,'updatedAmount':updatedAmount,'updatedInterestRate':updatedInterest})
                .then(function (result) {
                    window.location='{{url('lenders')}}';
                })
        }

    </script>
    <script type="application/javascript">
        //deleting manenos
        //first show the lended amount and determine if its 0
        function showcurrentLendedAmount(lendedAmount) {
//            alert(lendedAmount)
            $('#current_lended_amount').val(lendedAmount);
        }
        //determine whether to delete the user or not
        function showDeleteModal(id) {
            var lended=$('#current_lended_amount').val();
            $('#current_lender_id').val(id);
            //determine whether the value is  0 or not
            if(lended==0)
            {
                $('#delete_confirm').modal('show');

            }else{
                alert('The Lender has currently lended some money. Please wait until the lender has not lended any money')
            }
        }
        function deleteLender() {
           var lend_id= $('#current_lender_id').val()
            var url='{{url('deleteLender')}}';
            axios.post(url,{'lenderId':lend_id})
                .then(function () {
                    window.location='{{url('lenders')}}';
                })
        }
    </script>
    <!-- end of page level js -->
@endsection