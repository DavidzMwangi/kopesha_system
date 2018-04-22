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
        <h1>Transaction</h1>
        <ol class="breadcrumb">
            <li>
                <a href="{{url('home')}}">
                    <i class="livicon" data-name="home" data-size="14" data-loop="true"></i>
                    Home
                </a>
            </li>
            <li>
                <a href="#">Transaction</a>
            </li>
            <li class="active">New Transaction</li>
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
                            New Transaction
                        </h3>
                        <span class="pull-right">
                                    <i class="glyphicon glyphicon-chevron-up clickable"></i>
                                    <i class="glyphicon glyphicon-remove removepanel clickable"></i>
                                </span>
                    </div>
                    <div class="panel-body">
                        <form method="post" action="{{url('new_transaction')}}">
                            {{csrf_field()}}
                            <div class="form-group col-md-12">
                                {{--select 2 for the debtor id--}}
                                <div class="col-md-6">
                                <label>Debtor Id No</label>
                                {{--<input class="form-control">--}}
                                {{--<p class="help-block">Example block-level help text here.</p>--}}
                                    <select id="debtorSelector" class="form-control select2" name="debtor_id_no" onchange="getAllLenders(this.value);getMaxAmount(this.value)" required>
                                        <option disabled selected>Select Debtor</option>

                                    @foreach($debtors as $debtor)
                                            <option value="{{$debtor->user->id_no}}" >{{$debtor->user->id_no}}</option>
                                       @endforeach
                                    </select>


                                    {{--//make surethe debtorcannot borrow more than their limit--}}
                                </div>
                                {{--select2 for the lenders available--}}
                                <div class="col-md-6">
                                    <label for="all_lenders"> Lender Id No</label>
                                    <select id="all_lenders" class="form-control select2" onchange="lenderSelect(this.value)" name="lender_id">
                                        {{--<option disabled selected>Select Lender</option>--}}
                                        {{--@foreach($lenders as $lender)--}}
                                            {{--<option value="{{$lender->id}}" >{{$lender->user->id_no}}</option>--}}
                                       {{--@endforeach--}}
                                    </select>

                                    {{--<input class="form-control">--}}
                                    {{--<p class="help-block">Example block-level help text here.</p>--}}
                                </div>
                            </div>
                            <div class="col-md-12" id="lenders_details">
                               <div class="col-md-6">
                                   <label class="control-label" for="interest_rate">Interest Rate per Month</label>
                                   <input type="text" class="form-control" id="interest_rate"  readonly>
                                   <input type="hidden" name="submit_interest_rate" id="submit_interest_rate">
                               </div>
                            <div class="form-group has-success col-md-offset-6">
                                <label class="control-label" for="inputSuccess">Amount the Lender can lend</label>
                                <input type="text" class="form-control" id="inputSuccess" disabled>
                            </div>

                            </div>
                            {{--//assigned the max debt the debtor can have--}}
                            <input type="hidden" id="tester_maximum">

                            <div class="col-md-12">
                                <div class="form-group col-md-6">

                                    <label>Select the Amount to Borrow</label>
                                    <input class="form-control"  id="amount_borrow" name="amount_borrow"  placeholder="Enter Amount to Borrow" required>
                                </div>

                                <div class="form-group col-md-6">
                                    <label>Enter the Duration of Payment in months</label>
                                    <input class="form-control" type="number" name="payment_duration" placeholder="Enter Payment Duration in Months" onclick="paymentDuration()" min="0"></div>

                            </div>

                            <div class="col-md-12">
                                <input type="submit" class="btn btn-primary" value="Save New Transaction">
                            </div>
                        </form>

                            {{--show the start and end of the load as per the agreement of the lender and the debtor                            --}}

                             {{--<div class="col-md-12">--}}
                                {{--<div class="form-group col-md-6">--}}
                                    {{--<label>Start of the Loan</label>--}}
                                    {{--<input class="form-control"  id=""  type="month">--}}
                                {{--</div>--}}

                                {{--<div class="form-group col-md-6">--}}
                                    {{--<label>End of the loan</label>--}}
                                    {{--<input class="form-control" type="month"  ></div>--}}

                            {{--</div>--}}


                            {{--end of the date shownig shitment--}}

                            {{--<div class="col-md-12">--}}
                            {{--<div class="form-group">--}}
                                {{--<label>--}}
                                    {{--Date range:--}}
                                {{--</label>--}}
                                {{--<div class="input-group">--}}
                                    {{--<div class="input-group-addon">--}}
                                        {{--<i class="fa fa-calendar"></i>--}}
                                    {{--</div>--}}
                                    {{--<input type="text" class="form-control pull-right" id="reservation" />--}}
                                {{--</div>--}}
                                {{--<!-- /.input group --> </div>--}}
                            {{--</div>--}}
                            {{--<div class="form-group">--}}
                                {{--<label>Static Control</label>--}}
                                {{--<p class="form-control-static">email@example.com</p>--}}
                            {{--</div>--}}
                            {{--<div class="form-group">--}}
                                {{--<label>Text area</label>--}}
                                {{--<textarea class="form-control" rows="3"></textarea>--}}
                            {{--</div>--}}
                            {{--<div class="form-group">--}}
                                {{--<label>Checkboxes</label>--}}
                                {{--<div class="checkbox">--}}
                                    {{--<label>--}}
                                        {{--<input type="checkbox" value="">Checkbox 1</label>--}}
                                {{--</div>--}}
                                {{--<div class="checkbox">--}}
                                    {{--<label>--}}
                                        {{--<input type="checkbox" value="">Checkbox 2</label>--}}
                                {{--</div>--}}
                                {{--<div class="checkbox">--}}
                                    {{--<label>--}}
                                        {{--<input type="checkbox" value="">Checkbox 3</label>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                            {{--<div class="form-group">--}}
                                {{--<label>Inline Checkboxes</label>--}}
                                {{--<label class="checkbox-inline">--}}
                                    {{--<input type="checkbox">1</label>--}}
                                {{--<label class="checkbox-inline">--}}
                                    {{--<input type="checkbox">2</label>--}}
                                {{--<label class="checkbox-inline">--}}
                                    {{--<input type="checkbox">3</label>--}}
                            {{--</div>--}}
                            {{--<div class="form-group">--}}
                                {{--<label>Radio Buttons</label>--}}
                                {{--<div class="radio">--}}
                                    {{--<label>--}}
                                        {{--<input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" checked>Radio 1</label>--}}
                                {{--</div>--}}
                                {{--<div class="radio">--}}
                                    {{--<label>--}}
                                        {{--<input type="radio" name="optionsRadios" id="optionsRadios2" value="option2">Radio 2</label>--}}
                                {{--</div>--}}
                                {{--<div class="radio">--}}
                                    {{--<label>--}}
                                        {{--<input type="radio" name="optionsRadios" id="optionsRadios3" value="option3">Radio 3</label>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                            {{--<div class="form-group">--}}
                                {{--<label>Inline Radio Buttons</label>--}}
                                {{--<label class="radio-inline">--}}
                                    {{--<input type="radio" name="optionsRadiosInline" id="optionsRadiosInline1" value="option1" checked>1</label>--}}
                                {{--<label class="radio-inline">--}}
                                    {{--<input type="radio" name="optionsRadiosInline" id="optionsRadiosInline2" value="option2">2</label>--}}
                                {{--<label class="radio-inline">--}}
                                    {{--<input type="radio" name="optionsRadiosInline" id="optionsRadiosInline3" value="option3">3</label>--}}
                            {{--</div>--}}
                            {{--<div class="form-group">--}}
                                {{--<label>Selects</label>--}}
                                {{--<select class="form-control">--}}
                                    {{--<option>1</option>--}}
                                    {{--<option>2</option>--}}
                                    {{--<option>3</option>--}}
                                    {{--<option>4</option>--}}
                                    {{--<option>5</option>--}}
                                {{--</select>--}}
                            {{--</div>--}}
                            {{--<div class="form-group">--}}
                                {{--<label>Multiple Selects</label>--}}
                                {{--<select multiple class="form-control">--}}
                                    {{--<option>1</option>--}}
                                    {{--<option>2</option>--}}
                                    {{--<option>3</option>--}}
                                    {{--<option>4</option>--}}
                                    {{--<option>5</option>--}}
                                {{--</select>--}}
                            {{--</div>--}}
                            {{--<div class="form-group">--}}
                                {{--<div class="fileinput fileinput-new" data-provides="fileinput">--}}
                                    {{--<div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">--}}
                                        {{--<img data-src="holder.js/100%x100%" alt="..."></div>--}}
                                    {{--<div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"></div>--}}
                                    {{--<div>--}}
                                                {{--<span class="btn btn-default btn-file">--}}
                                                    {{--<span class="fileinput-new">Select image</span>--}}
                                                    {{--<span class="fileinput-exists">Change</span>--}}
                                                    {{--<input type="file" name="..."></span>--}}
                                        {{--<a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                            {{--<button type="submit" class="btn btn-responsive btn-default">Submit Button</button>--}}
                            {{--<button type="reset" class="btn btn-responsive btn-default">Reset Button</button>--}}
                    </div>
                </div>
            </div>

        </div>
        <!--main content ends--> </section>
    @endsection
@section('script')
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
        <script type="application/javascript">
            //first hide the div until the user clicks the select 2 of the lender
            $('#lenders_details').hide();

            //clear the lender selector 2 when dentor selector is clicked again
            $('#debtorSelector').click(function () {
                $('#lenders_details').hide();

                $('#all_lenders').empty();
            });
            //display the lenders first
            function getAllLenders(debtor_id_no) {
                //send the selected debtor id_no
                var url1='{{url('getLenderFromDebtor')}}';
                axios.post(url1,{'post_debtor_id_no':debtor_id_no})
                    .then(function (result22) {
                        $('#all_lenders').append("<option  disabled selected>Select A Lender</option>");

                        $.each(result22.data.possible_lenders,function (key,value) {
                            $('#all_lenders').append("<option   value='"+value.id+"'>"+value.user.id_no+"</option>")
                        })
                    })
            }

            function lenderSelect(lenderid) {
//                alert(lenderid)
                //display the div after user selects the select2 input
                $('#lenders_details').show();
                //first post the id to get the details of the lender
                var url3='{{url('lender_details')}}';
                axios.post(url3,{'lenderid':lenderid})
                    .then(function (result) {
                        //display the maximum value the debtorcan borrow
                        $('#inputSuccess').val((result.data.lenderData.max_amount)-(result.data.lenderData.lended_amount));
                        $('#interest_rate').val(result.data.lenderData.interest_rate_pm + "%");
                        $('#submit_interest_rate').val(result.data.lenderData.interest_rate_pm);
                    });

            }
            function paymentDuration() {
                var num1=$('#amount_borrow').val();
                var num2=$('#inputSuccess').val();
                //check whether the value is grater than the amount that can be borrowed4

                if ((num1-num2)>0 ){
//                    alert(num2-num1);
                    alert("The value is greater than the amount you can borrow");
                    $('#amount_borrow').val(null);
                }
                var num12=$('#tester_maximum').val();
                if((num1-num12)>0){
                    alert("The money has exceeded the maximum amount of debt the user can borrow")
                }
            }
            //function to get the max amount the debtor can borrow
            function getMaxAmount(debtor_id_no) {
                var url5='{{url('getDebtorMaxValue')}}';
                axios.post(url5,{'debtor_id_no_4_max':debtor_id_no})
                    .then(function (result6) {
                        var maximum=result6.data.debtor_max_limit.max_limit_debt;
                       $('#tester_maximum').val(maximum);
//                        alert(result6.data.debtor_max_limit.max_limit_debt)
                    })
            }

        </script>
    <script type="application/javascript">

    </script>
    <!-- end of page level js -->
@endsection
