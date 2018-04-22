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
            <li class="active">Processing Transactions</li>
        </ol>
    </section>






    <section class="content paddingleft_right15">
        <div class="row">
            <div class="panel panel-primary ">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <i class="livicon" data-name="user" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                       Processing Transactions
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
                            {{--<th>Created At</th>--}}
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($processingTransactions as $processingTransaction)
                            <tr>
                                <td>{{$processingTransaction->debtor_id_no}}</td>
                                <td>
                                    {{$processingTransaction->lender_id_no}}
                                </td>

                                <td>  {{$processingTransaction->amount}}</td>
                                <td>  {{((($processingTransaction->interest_rate_pm)/100)*$processingTransaction->amount)*$processingTransaction->payment_duration}}</td>
                                <td>    {{$processingTransaction->payment_duration}} Months</td>

                                <td>
                                    {{--<a href="#" data-toggle="modal" data-target="#delete_confirm" >--}}
                                    <a href="#" data-toggle="modal" data-target="#confirm_modal" onclick="getIdForModal('{{$processingTransaction->id}}','{{$processingTransaction->lender_id_no}}')" class="btn btn-primary">Complete or Cancel
                                    </a>
                                </td>
                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                    <!-- Modal for showing transaction confirmation -->
                    <div class="modal fade" id="confirm_modal" tabindex="-1" role="dialog" aria-labelledby="user_delete_confirm_title" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                    <h4 class="modal-title" id="user_delete_confirm_title">
                                       Confirm Transaction
                                    </h4>
                                </div>
                                <div class="modal-body">
                                    Are you sure to Perform The Transaction? This operation is irreversible.
                                </div>
                                <div class="modal-footer">
                                    {{--<form action="{{url('confirm_cancel_confirmation')}}" method="post">--}}
                                        {{--{{csrf_field()}}--}}
                                    <input id="transaction_id" type="hidden">
                                    <input id="lender_id_no" name="lender_id_no" type="hidden">

                                    <button type="submit" class="btn btn-default"  name="cancel_button" value="button_cancel" onclick="cancelButton()">Cancel Transaction</button>

                                    <input  type="submit" class="btn btn-success" value="Confirm" id="confirm_button" name="confirm_button" onclick="confirmButton()">
                                    {{--</form>--}}
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

    {{--modal--}}
    <script src="{{asset('template/vendors/modal/js/classie.js')}}"></script>
    <script src="{{asset('template/vendors/modal/js/modalEffects.js')}}"></script>
    <script type="application/javascript">
        function getIdForModal(transaction_id,lender_id_no) {
           $('#transaction_id').val(transaction_id);
           $('#lender_id_no').val(lender_id_no);
        }
        function cancelButton() {
            var transactionId=$('#transaction_id').val();
//            alert(transactionId)
            var url1='{{url('cancelTransactionCompletely')}}';
            axios.post(url1,{'transaction_id':transactionId})
                .then(function (result23) {
//                    alert(result23.data.stupid);
                    window.location='{{url('transactions')}}';
                })
        }
        function confirmButton() {
            var transactionId2=$('#transaction_id').val();
            var url2='{{url('completeTransaction')}}';
            axios.post(url2,{'SelectedTransactionId':transactionId2})
                .then(function (result45) {
                    window.location='{{url('completed_transactions')}}';
//                    alert(result45.data.crazy);
                })
        }
    </script>
@endsection