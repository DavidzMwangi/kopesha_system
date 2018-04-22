@extends('layouts.main')
@section('style')
    <link rel="stylesheet" type="text/css" href="{{asset('template/vendors/datatables/css/dataTables.bootstrap.css')}}" />
    <link href="{{asset('template/css/pages/tables.css')}}" rel="stylesheet" type="text/css" />

    {{--modal--}}
    <link href="{{asset('template/vendors/modal/css/component.css')}}" rel="stylesheet" />

@endsection

@section('content')

    <section class="content-header">
        <h1>Transactions</h1>
        <ol class="breadcrumb">
            <li>
                <a href="{{url('home')}}">
                    <i class="livicon" data-name="home" data-size="16" data-color="#000"></i>
                    Dashboard
                </a>
            </li>
            <li>Transactions</li>
            <li class="active">Completed Transactions</li>
        </ol>
    </section>






    <section class="content paddingleft_right15">
        <div class="row">
            <div class="panel panel-primary ">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <i class="livicon" data-name="user" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                        Completed Transactions
                    </h4>
                </div>
                <br />
                <div class="panel-body">
                    <table class="table table-bordered " id="table">
                        <thead>
                        <tr class="filters">
                            {{--<th>First Name</th>--}}
                            {{--<th>Last Name</th>--}}
                            <th>Debtor Id No</th>
                            <th>
                                Lender Id No
                            </th>
                            <th>Amount</th>
                            <th>Interest Gained</th>
                            <th>Payment Duration</th>
                            <th>Remaining Days</th>
                            <th>Payment Status</th>
                            <th>Edit</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($completedTransactions as $completedTransaction)
                            <tr>
                                <td>{{$completedTransaction->debtor_id_no}}</td>
                                <td>
                                    {{$completedTransaction->lender_id_no}}</td>

                                <td>  {{$completedTransaction->amount}}</td>
                                <td>  {{((($completedTransaction->interest_rate_pm)/100)*$completedTransaction->amount)*$completedTransaction->payment_duration}}</td>

                                <td>    {{$completedTransaction->payment_duration}} Months                     </td>
                                <td>   {{(\Carbon\Carbon::parse($completedTransaction->payment_end_date))->diffInDays(\Carbon\Carbon::now())}}             </td>
                                <td>

                                    @php($data=$completedTransaction->payment()->orderBy('id','desc')->first())
                                    @if($data['remaining_amount']==' ')
                                        <span class="label label-sm label-success">Completed</span>
                                    @elseif($data['remaining_amount']>0)

                                        <span class="label label-sm label-danger">Incomplete</span>
                                    @else
                                        <span class="label label-sm label-danger">No Payment Made</span>

                                    @endif

                                  {{--@if($completedTransaction->payment()->first()->remaining_amount==0)--}}

                                    {{--<span class="label label-sm label-success">Completed</span>--}}
                                    {{--@else--}}
                                    {{--<span class="label label-sm label-danger">Incomplete</span>--}}
                                    {{--@endif--}}
                                    {{--@php($data=$completedTransaction->payment()->orderBy('id','desc')->first())--}}
                                    {{--{{$data['remaining_amount']}}--}}
                                </td>
                                <td>
                                    {{--<a href="#" data-toggle="modal" data-target="#delete_confirm" >--}}
                                    <a href="#" data-toggle="modal" data-target="#edit_modal" onclick="getId4Modal({{$completedTransaction->id}});getDuration({{$completedTransaction->payment_duration}})" class="btn btn-primary">Edit
                                    </a>
                                </td>
                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                    <!-- Modal for showing transaction confirmation -->
                    <div class="modal fade" id="edit_modal" tabindex="-1" role="dialog" aria-labelledby="user_delete_confirm_title" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                    <h4 class="modal-title" id="user_delete_confirm_title">
                                        Edit Transaction
                                    </h4>
                                </div>
                                <form action="{{url('edit_completed_transaction')}}" method="post">
                                    {{csrf_field()}}
                                <div class="modal-body">

                                    <input id="transaction_id" type="hidden" name="editted_transaction_id">
                                        <label for="edit_duration">Enter The Transaction Duration</label>
                                    <input class="form-control" id="edit_duration" name="edit_duration" type="number" min="1" required>

                                </div>
                                <div class="modal-footer">
                                    <button  class="btn btn-default pull-left"  name="cancel_button" value="button_cancel" data-dismiss="modal">Cancel</button>

                                    <input  type="submit" class="btn btn-success pull-right" value="Confirm" id="confirm_button" name="confirm_button" >
                                </div>
                                </form>

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

    {{--modal--}}
    <script src="{{asset('template/vendors/modal/js/classie.js')}}"></script>
    <script src="{{asset('template/vendors/modal/js/modalEffects.js')}}"></script>
    <script type="application/javascript">
        function getId4Modal(transactionId) {
            $('#transaction_id').val(transactionId)
        }
        function getDuration(payment_time) {
            $('#edit_duration').val(payment_time)
        }

    </script>
@endsection