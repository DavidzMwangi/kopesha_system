<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <link rel="apple-touch-icon" sizes="76x76" href="{{asset('loginPage/img/favicon.png')}}">

    <title>Kopesha System</title>

    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />

    <link rel="apple-touch-icon" sizes="76x76" href="{{asset('loginPage/img/apple-icon.png')}}" />
    <link rel="icon" type="image/png" href="{{asset('loginPage/img/favicon.png')}}" />

    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" />

    <!-- CSS Files -->
    <link href="{{asset('loginPage/css/bootstrap.min.css')}}" rel="stylesheet" />
    <link href="{{asset('loginPage/css/material-bootstrap-wizard.css')}}" rel="stylesheet" />

    {{--<!-- CSS Just for demo purpose, don't include it in your project -->--}}
    {{--<link href="{{asset('loginPage/css/demo.css')}}" rel="stylesheet" />--}}
</head>

<body>
<div class="image-container set-full-height" style="background-image: {{asset('loginPage/img/wizard-profile.jpg')}} ">


<!--  Made With Material Kit  -->
    <a href="http://demos.creative-tim.com/material-kit/index.html?ref=material-bootstrap-wizard" class="made-with-mk">
        <div class="brand">KS</div>
        <div class="made-with">Made For <strong>Kopesha System</strong></div>
    </a>

    <!--   Big container   -->
    <div class="container">
        <div class="row">
            <div class="col-sm-8 col-sm-offset-2">
                <!--      Wizard container        -->
                <div class="wizard-container">
                    <div class="card wizard-card" data-color="blue" id="wizardProfile">

                        <form action="{{ route('register') }}" method="post">
                            <!--        You can switch " data-color="purple" "  with one of the next bright colors: "green", "orange", "red", "blue"       -->
                            {{ csrf_field() }}

                            <div class="wizard-header">
                                <div class="made-with pull-right"><a href="{{url('login')}}" class="btn btn-primary">Login</a> </div>

                                <h3 class="wizard-title">
                                    Create Your Profile
                                </h3>
                                <h5>This information will let us know more about you.</h5>
                            </div>
                            <div class="wizard-navigation">
                                <ul>
                                    <li><a href="#about" data-toggle="tab">About</a></li>
                                    <li><a href="#account" data-toggle="tab">Password</a></li>
                                    <li><a href="#address" data-toggle="tab">Address</a></li>
                                </ul>
                            </div>

                            <div class="tab-content">
                                <div class="tab-pane" id="about">
                                    <div class="row">
                                        <h4 class="info-text"> Let's start with the basic information (with validation)</h4>

                                        <div class="col-sm-10 col-sm-offset-1">
                                            {{--<div class="input-group">--}}
													{{--<span class="input-group-addon">--}}
														{{--<i class="material-icons">face</i>--}}
													{{--</span>--}}
                                                {{--<div class="form-group label-floating">--}}
                                                    {{--<label  for="firstName" class="control-label">User Name <small>(required)</small></label>--}}
                                                    {{--<input id="firstName" name="user_name" type="text" class="form-control" value="{{ old('user_name') }}" required>--}}
                                                    {{--@if ($errors->has('user_name'))--}}
                                                        {{--<span class="help-block">--}}
                                        {{--<strong>{{ $errors->first('user_name') }}</strong>--}}
                                    {{--</span>--}}
                                                    {{--@endif--}}
                                                {{--</div>--}}
                                            {{--</div>--}}

                                            <div>
                                                @if(count($errors)>0)
                                                    @foreach($errors as $error)
                                                    {{$error}}
                                                    @endforeach
                                                 @endif
                                            </div>
                                            <div class="input-group">
													<span class="input-group-addon">
														<i class="material-icons">face</i>
													</span>
                                                <div class="form-group label-floating">
                                                    <label  for="firstName" class="control-label">First Name <small>(required)</small></label>
                                                    <input id="firstName" name="first_name" type="text" class="form-control" value="{{ old('first_name') }}" required>
                                                    @if ($errors->has('first_name'))
                                                        <span class="help-block">
                                        <strong>{{ $errors->first('first_name') }}</strong>
                                    </span>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="input-group">
													<span class="input-group-addon">
														<i class="material-icons">record_voice_over</i>
													</span>
                                                <div class="form-group label-floating">
                                                    <label class="control-label">Last Name <small>(required)</small></label>
                                                    <input name="last_name" type="text" class="form-control" value="{{old('last_name')}}" required >
                                                    {{--<input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>--}}
                                                    @if ($errors->has('last_name'))
                                                        <span class="help-block">
                                        <strong>{{ $errors->first('last_name') }}</strong>
                                    </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-10 col-sm-offset-1">
                                            <div class="input-group">
													<span class="input-group-addon">
														<i class="material-icons">email</i>
													</span>
                                                <div class="form-group label-floating">
                                                    <label class="control-label">Email <small>(required)</small></label>
                                                    {{--<input name="email" type="email" class="form-control">--}}
                                                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>
                                                    @if ($errors->has('email'))
                                                        <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="account">
                                    <h4 class="info-text"> What are you doing? (checkboxes) </h4>
                                    <div class="row">
                                        <div class="col-sm-10 col-sm-offset-1">
                                            <div class="col-sm-6">

                                                <div class="input-group">
													<span class="input-group-addon">
														<i class="material-icons">email</i>
													</span>
                                                    <div class="form-group label-floating">
                                                        <label  for="firstName" class="control-label">User Name <small>(required)</small></label>
                                                        <input id="firstName" name="user_name" type="text" class="form-control" value="{{ old('user_name') }}" required>
                                                        @if ($errors->has('user_name'))
                                                        <span class="help-block">
                                                        <strong>{{ $errors->first('user_name') }}</strong>
                                                        </span>
                                                            @endif

                                                    </div>
                                                </div>



                                                <div class="input-group">
													<span class="input-group-addon">
														<i class="material-icons">email</i>
													</span>
                                                    <div class="form-group label-floating">
                                                        <label for="password" class="control-label">Password <small>(required)</small></label>
                                                        {{--<input id="password" type="password" class="form-control" name="password" required>--}}
                                                        <input id="password" type="password" class="form-control" name="password"  required>
                                                        @if ($errors->has('password'))
                                                            <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                                        @endif
                                                    </div>
                                                </div>



                                                <div class="input-group">
													<span class="input-group-addon">
														<i class="material-icons">email</i>
													</span>
                                                    <div class="form-group label-floating">
                                                        <label  for="password-confirm" class="control-label">Confirm Password <small>(required)</small></label>
                                                        <input id="password-confirm" type="password" class="form-control" name="password-confirmation"  required>

                                                    </div>
                                                </div>
                                                {{--<div class="choice" data-toggle="wizard-checkbox">--}}
                                                {{--<input type="checkbox" name="jobb" value="Design">--}}
                                                {{--<div class="icon">--}}
                                                {{--<i class="fa fa-pencil"></i>--}}
                                                {{--</div>--}}
                                                {{--<h6>Design</h6>--}}
                                                {{--</div>--}}
                                            </div>
                                            <div class="col-sm-6">
                                                <div>
                                                <label class="control-label"><h3>Male   </h3></label>

                                                <input type="radio"  name="gender" value="male" required>
                                                <label class="control-label"><h3>Female    </h3></label>

                                                <input type="radio" name="gender" value="female" required>
                                                </div>


                                                <div class="input-group">
													<span class="input-group-addon">
														<i class="material-icons">email</i>
													</span>
                                                    <div class="form-group label-floating">
                                                        <label  for="id_no" class="control-label">Identity No/ Birth Certificate No <small>(required)</small></label>
                                                        <input id="id_no" type="text" class="form-control" name="id_no"  required>

                                                    </div>
                                                </div>
                                                {{--<div class="choice" data-toggle="wizard-checkbox">--}}
                                                {{--<input type="radio" name="jobb" value="Code">--}}
                                                {{--<div class="icon">--}}
                                                {{--<i class="fa fa-terminal"></i>--}}
                                                {{--</div>--}}
                                                {{--<h6>Code</h6>--}}
                                                {{--</div>--}}
                                            </div>
                                            {{--<div class="col-sm-3">--}}
                                            {{--<div class="choice" data-toggle="wizard-checkbox">--}}
                                            {{--<input type="radio" name="jobb" value="Develop">--}}
                                            {{--<div class="icon">--}}
                                            {{--<i class="fa fa-laptop"></i>--}}
                                            {{--</div>--}}
                                            {{--<h6>Develop</h6>--}}
                                            {{--</div>--}}
                                            {{--</div>--}}
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="address">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <h4 class="info-text"> Which are your addresses </h4>
                                        </div>
                                        <div class="col-sm-5 col-sm-offset-1">
                                            <div class="form-group label-floating">
                                                <label for="phone_no" class="control-label">Phone Number</label>
                                                <input id="phone_no" type="text"  name="phone_number" class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="col-sm-5 col-sm-offset-1">
                                            <div class="form-group label-floating">
                                                <label for="alternative_number" class="control-label">Alternative Phone Number</label>
                                                <input id="alternative_number" type="text"  name="alternative_number" class="form-control" >
                                            </div>
                                        </div>
                                        <div class="col-sm-5 col-sm-offset-1">
                                            <div class="form-group label-floating">
                                                <label class="control-label">Address</label>
                                                <input type="text" name="address" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-sm-5 col-sm-offset-1">
                                            <div class="form-group label-floating">
                                                <label for="DOB" class="control-label">Date of Birth</label>
                                                <input  id="DOB" type="date" name="DOB" class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="col-sm-5 col-sm-offset-1">
                                            <div class="form-group label-floating">
                                                <label  for="level" class="control-label">User Level</label>
                                                <select  id="level" name="level" class="form-control" required>
                                                    <option disabled="" selected=""></option>
                                                    <option value="1"> Administrator </option>
                                                    <option value="2"> User </option>

                                                </select>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="wizard-footer">
                                <div class="pull-right">
                                    <input type='button' class='btn btn-next btn-fill btn-success btn-wd' name='next' value='Next' />
                                    <input type='submit' class='btn btn-finish btn-fill btn-success btn-wd' name="submit" value="update"/>

                                </div>

                                <div class="pull-left">
                                    <input type='button' class='btn btn-previous btn-fill btn-default btn-wd' name='previous' value='Previous' />
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        </form>
                    </div>
                </div> <!-- wizard container -->
            </div>
        </div><!-- end row -->
    </div> <!--  big container -->

    <div class="footer">
        <div class="container text-center">
            Made with <i class="fa fa-heart heart"></i> by <a href="#">Kopesha System </a> Visit country <a href="#">here.</a>
        </div>
    </div>
</div>

</body>
<!--   Core JS Files   -->
<script src="{{asset('loginPage/js/jquery-2.2.4.min.js')}}" type="text/javascript"></script>
<script src="{{asset('loginPage/js/bootstrap.min.js')}}" type="text/javascript"></script>
<script src="{{asset('loginPage/js/jquery.bootstrap.js')}}" type="text/javascript"></script>

<!--  Plugin for the Wizard -->
<script src="{{asset('loginPage/js/material-bootstrap-wizard.js')}}"></script>

<!--  More information about jquery.validate here: http://jqueryvalidation.org/	 -->
<script src="{{asset('loginPage/js/jquery.validate.min.js')}}"></script>

</html>
