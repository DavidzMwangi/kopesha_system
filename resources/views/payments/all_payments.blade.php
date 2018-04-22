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
        <h1>All Payments</h1>
        <ol class="breadcrumb">
            <li>
                <a href="{{url('home')}}">
                    <i class="livicon" data-name="home" data-size="18" data-loop="true"></i>
                    Home
                </a>
            </li>
            <li>
                <a href="#">Payment</a>
            </li>
            <li class="active">All Payments</li>
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
                        {{--<a class="btn btn-success btn-large " data-toggle="modal" data-href="#responsive" href="#responsive">Add New Debtor</a>--}}
                        <table class="table table-striped table-responsive" id="table1">
                            <thead>
                            <tr>

                                <th>Debtor Id No</th>
                                <th>Lender Id No</th>
                                <th>Total Amount <br>and Interest</th>
                                <th>Payment <br>Duration</th>
                                <th>Interest Rate PM</th>
                                <th>Amount Paid</th>
                                <th>Remaining<br> Amount</th>
                                <th>Transaction Date</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($payments as $payment)
                                <tr>

                                    <td>{{$payment->debtor_id_no}}</td>
                                    <td>{{$payment->transaction->first()->lender_id_no}}</td>
                                    <td>{{$payment->transaction->first()->total_amount_and_interest}}</td>
                                    <td>{{$payment->transaction->first()->payment_duration}}</td>
                                    <td>{{$payment->transaction->first()->interest_rate_pm}} Months</td>
                                    <td>{{$payment->amount_paid}}</td>
                                    <td>{{$payment->remaining_amount}}</td>
                                    <td>{{$payment->created_at}}</td>

                                </tr>
                            @endforeach
                            </tbody>
                        </table>
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

    <!-- end of page level js -->
@endsection