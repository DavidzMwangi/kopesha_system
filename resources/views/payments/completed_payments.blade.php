@extends('layouts.main')
@section('style')
    <link rel="stylesheet" type="text/css" href="{{asset('template/vendors/datatables/css/dataTables.bootstrap.css')}}" />
    <link href="{{asset('template/css/pages/tables.css')}}" rel="stylesheet" type="text/css" />

    {{--modal--}}
    <link href="{{asset('template/vendors/modal/css/component.css')}}" rel="stylesheet" />

@endsection

@section('content')

    <section class="content-header">
        <h1>Completed Payments</h1>
        <ol class="breadcrumb">
            <li>
                <a href="{{url('home')}}">
                    <i class="livicon" data-name="home" data-size="16" data-color="#000"></i>
                    Dashboard
                </a>
            </li>
            <li>Payments</li>
            <li class="active">Completed Payments</li>
        </ol>
    </section>






    <section class="content paddingleft_right15">
        <div class="row">
            <div class="panel panel-primary ">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <i class="livicon" data-name="user" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                        Completed Payments
                    </h4>
                </div>
                <br />
                <div class="panel-body">
                    <table class="table table-bordered " id="table">
                        <thead>
                        <tr class="filters">

                            <th>Debtor Id No</th>
                            <th>
                                Lender Id No
                            </th>
                            <th>Amount</th>
                            <th>Interest Gained</th>
                            <th>Payment Duration</th>
                            <th>Remaining Days</th>
                            <th>Payment Status</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($completed_transactions as $completed_transaction)
                            <tr>
                                <td>{{$completed_transaction->debtor_id_no}}</td>
                                <td>
                                    {{$completed_transaction->lender_id_no}}</td>

                                <td>  {{$completed_transaction->amount}}</td>
                                <td>  {{((($completed_transaction->interest_rate_pm)/100)*$completed_transaction->amount)*$completed_transaction->payment_duration}}</td>

                                <td>    {{$completed_transaction->payment_duration}} Months                     </td>
                                <td>   {{(\Carbon\Carbon::parse($completed_transaction->payment_end_date))->diffInDays(\Carbon\Carbon::now())}}             </td>

                                <td>
                                    <span class="label label-sm label-success">Completed</span>

                                </td>
                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- row--> </section>



@endsection
@section('script')
    <script type="text/javascript" src="{{asset('template/vendors/datatables/jquery.dataTables.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('template/vendors/datatables/dataTables.bootstrap.js')}}"></script>

    {{--modal--}}
    <script src="{{asset('template/vendors/modal/js/classie.js')}}"></script>
    <script src="{{asset('template/vendors/modal/js/modalEffects.js')}}"></script>
@endsection