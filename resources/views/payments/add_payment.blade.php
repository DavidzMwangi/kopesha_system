@extends('layouts.main')
@section('style')
    <link href="{{asset('template/vendors/jasny-bootstrap/css/jasny-bootstrap.css')}}" rel="stylesheet" />
    <link href="{{asset('template/vendors/daterangepicker/css/daterangepicker-bs3.css')}}" rel="stylesheet" type="text/css" />
    <!--select css-->
    <link href="{{asset('template/vendors/select2/select2.css')}}" rel="stylesheet" />
    <link rel="stylesheet" href="{{asset('template/vendors/select2/select2-bootstrap.css')}}" />
    <!--clock face css-->
    <link href="{{asset('template/vendors/iCheck/skins/all.css')}}" rel="stylesheet" />
    <link href="{{asset('template/css/pages/formelements.css')}}" rel="stylesheet" />

@endsection
@section('content')
    <section class="content-header">
        <!--section starts-->
        <h1>Loan Payment</h1>
        <ol class="breadcrumb">
            <li>
                <a href="{{url('home')}}">
                    <i class="livicon" data-name="home" data-size="14" data-loop="true"></i>
                    Home
                </a>
            </li>
            <li>
                <a href="#">Payment</a>
            </li>
            <li class="active">New Payment</li>
        </ol>
    </section>
    <!--section ends-->
    <section class="content">
        <!--main content-->
        <div class="row">
            <!--row starts-->
            <div class="col-md-12">
                <!--md-12 starts-->
                <!--form control starts-->
                <div class="panel panel-success" id="hidepanel6">
                    <div class="panel-heading">
                        <h3 class="panel-title">
                            <i class="livicon" data-name="share" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                            New Payment
                        </h3>
                        <span class="pull-right">
                                    <i class="glyphicon glyphicon-chevron-up clickable"></i>
                                    <i class="glyphicon glyphicon-remove removepanel clickable"></i>
                                </span>
                    </div>
                    <div class="panel-body">
                        <div class="alert-danger">
                            @if(count($errors->all())>0)
                                @foreach($errors->all() as $error)
                                    {{$error}}
                                    @endforeach

                                {{--@if($errors->has('excess')){--}}
                                    {{--{{$errors}}--}}
                                {{--@endif--}}
                                @endif
                        </div>
                        <form method="post" action="{{url('save_the_payment')}}">
                            {{csrf_field()}}
                            <div class="form-group col-md-12">
                                {{--select 2 for the debtor id--}}
                                <div class="col-md-6">
                                    <label>Debtor Id No</label>
                                    <select id="debtorSelector" class="form-control select2" name="debtor_id_no" onchange="getTransactionDetails(this.value)" required>
                                        <option disabled selected>Select Debtor</option>

                                        @foreach($debtors as $debtor)
                                                    <option value="{{$debtor->user->id_no}}" >{{$debtor->user->id_no}}</option>
                                        @endforeach
                                    </select>


                                </div>
                                <div class="col-md-6">

                                    <label class="control-label" for="amount_borrowed">Amount Borrowed</label>
                                    <input type="text" class="form-control" id="amount_borrowed" name="amount_borrowed"  readonly>

                                </div>
                            </div>
                            <div class="col-md-12" id="lenders_details">
                                <div class="col-md-6">
                                    <label class="control-label" for="initial_amount_to_pay">Initial Amount to Pay</label>
                                    <input type="text" class="form-control" id="initial_amount_to_pay" name="initial_amount_to_pay"  readonly>

                                </div>
                                <div class="form-group col-md-offset-6">
                                    <label class="control-label" for="remaining_amount_to_pay">Remaining Amount to Pay</label>
                                    <input type="text" class="form-control" id="remaining_amount_to_pay" name="remaining_amount_to_pay" readonly>
                                </div>

                            </div>

                            <div class="col-md-12">
                                <div class="form-group col-md-6">
                                    <input type="hidden" id="transaction_id" name="transaction_id">

                                    <label for="amount_paid">Select the Amount to Pay</label>
                                    <input class="form-control"  id="amount_paid" name="amount_paid"  placeholder="Enter Amount to Pay" type="number" min="0" required>
                                </div>


                            </div>

                            <div class="col-md-12">
                                <input type="submit" class="btn btn-primary" value="Save New Payment">
                            </div>
                        </form>

                    </div>
                </div>
            </div>

        </div>
        <!--main content ends--> </section>
@endsection
@section('script')
    <script type="application/javascript">
        function getTransactionDetails(debtorIdNo) {

            var url1='{{url('fetch_transaction_details')}}';
            axios.post(url1,{'debtor_id_no':debtorIdNo})
                .then(function (result1) {
                $('#amount_borrowed').val(result1.data.transaction1.amount);

                //get the initial amount  to pay
                    $('#initial_amount_to_pay').val(result1.data.transaction1.total_amount_and_interest);
                    //assign an input record a transaction id
                    $('#transaction_id').val(result1.data.transaction1.id);
                    //get the amount remaining to pay
                    var numer=Number(result1.data.payment1.remaining_amount);
                    if (numer>0){
                       $('#remaining_amount_to_pay').val(result1.data.payment1.remaining_amount)

                    }else {
                        $('#remaining_amount_to_pay').val(result1.data.transaction1.total_amount_and_interest);

                    }

                })
        }

        function validateAmount() {
            var current_debt=$('#remaining_amount_to_pay').val();
            var entered_amount= $('#amount_paid').val();

            if(entered_amount>current_debt){
                alert('You are not allowed to pay more than the debt you have');
            }
        }
    </script>
    <script src="{{asset('template/vendors/jasny-bootstrap/js/jasny-bootstrap.js')}}"></script>
    <script src="{{asset('template/vendors/input-mask/jquery.inputmask.js')}}" type="text/javascript"></script>
    <script src="{{asset('template/vendors/input-mask/jquery.inputmask.date.extensions.js')}}" type="text/javascript"></script>
    <script src="{{asset('template/vendors/input-mask/jquery.inputmask.extensions.js')}}" type="text/javascript"></script>
    <!-- date-range-picker -->
    <script src="{{asset('template/vendors/daterangepicker/daterangepicker.js')}}" type="text/javascript"></script>
    <script src="{{asset('template/vendors/select2/select2.js')}}" type="text/javascript"></script>
    <script src="{{asset('template/vendors/iCheck/icheck.js')}}" type="text/javascript"></script>
    <script src="{{asset('template/vendors/iCheck/demo/js/custom.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('template/vendors/autogrow/js/jQuery-autogrow.js')}}" type="text/javascript"></script>
    <script src="{{asset('template/vendors/maxlength/bootstrap-maxlength.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('template/vendors/card/jquery.card.js')}}" type="text/javascript"></script>
    <script src="{{asset('template/js/pages/formelements.js')}}" type="text/javascript"></script>

    <!-- end of page level js -->
@endsection
