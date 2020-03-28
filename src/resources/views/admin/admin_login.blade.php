<!DOCTYPE html>  
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="">
<meta name="author" content="">
<link rel="icon" type="image/png" sizes="16x16" href="{{asset('images/admin/favicon.png')}}">
<title>1 INR Login</title>
<!-- Bootstrap Core CSS -->
    <!-- Menu CSS -->
    <link href="{{ asset('css/admin/bootstrap.min.css') }}" rel="stylesheet">
    <!-- animation CSS -->
    <link href="{{ asset('css/admin/animate.css') }}" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="{{ asset('css/admin/style.css') }}" rel="stylesheet">
    <!-- color CSS -->
    <link href="{{ asset('css/admin/colors/blue.css') }}" id="theme" rel="stylesheet">

<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
</head>

<body>
<!-- Preloader -->
<div class="preloader">
  <div class="cssload-speeding-wheel"></div>
</div>
<section id="wrapper" class="login-register">
  <div class="login-box login-sidebar">
    <div class="white-box">
      @if (session('status'))
          <div class="alert alert-success" role="alert">
              {{ session('status') }}
          </div>
      @endif

      @if ($errors->has('email'))
          <div class="alert alert-danger" role="alert">
        <span class="invalid-feedback" role="alert">
            {{ $errors->first('email') }}
        </span>
      </div>
      @endif
      {{-- <form class="form-horizontal form-material" id="loginform" action="{{ url('admin/login') }}" method="post"> --}}
        {!! Form::open(['url'=>'admin/login', 'class'=> 'form-horizontal form-material', 'id'=>'loginform']) !!}
        <a href="javascript:void(0)" class="text-center db"><img src="{{asset('images/one-inr.png')}}" alt="onr inr" height="100px;" /></a><br/>
          <h3 class="text-center">One INR</h3>
          {{-- <img src="{{asset('images/admin/admin-text-dark.png')}}" alt="Home" /></a>   --}}
        
        <div class="form-group m-t-40">
          <div class="col-xs-12">
            {{-- <input class="form-control" type="text" placeholder="Email Id"> --}}
            {!! Form::email('email', null, ['class'=>'form-control', 'placeholder'=>'Email Id', 'required']) !!}
            @if(session('error'))
            <div class="help-block with-errors text-danger"><ul class="list-unstyled"><li>Email Id or password is incorrect.</li></ul></div>
            @endif

          </div>
        </div>
        <div class="form-group">
          <div class="col-xs-12">
            {{-- <input class="form-control" type="password" placeholder="Password"> --}}
            {!! Form::password('password', ['class'=>'form-control', 'placeholder'=>'Password', 'required']) !!}

          </div>
        </div>
        <div class="form-group">
          <div class="col-md-12">
            {{-- <div class="checkbox checkbox-primary pull-left p-t-0">
              <input id="checkbox-signup" type="checkbox">
              <label for="checkbox-signup"> Remember me </label>
            </div> --}}
            <a href="javascript:void(0)" id="to-recover" class="text-dark pull-right"><i class="fa fa-lock m-r-5"></i> Forgot Password?</a> </div>
        </div>
        <div class="form-group text-center m-t-20">
          <div class="col-xs-12">
            <button class="btn btn-info btn-lg btn-block text-uppercase waves-effect waves-light" type="submit">Log In</button>
          </div>
        </div>
        {{-- <div class="row">
          <div class="col-xs-12 col-sm-12 col-md-12 m-t-10 text-center">
            <div class="social"><a href="javascript:void(0)" class="btn  btn-facebook" data-toggle="tooltip"  title="Login with Facebook"> <i aria-hidden="true" class="fa fa-facebook"></i> </a> <a href="javascript:void(0)" class="btn btn-googleplus" data-toggle="tooltip"  title="Login with Google"> <i aria-hidden="true" class="fa fa-google-plus"></i> </a> </div>
          </div>
        </div> --}}
        <!-- <div class="form-group m-b-0">
          <div class="col-sm-12 text-center">
            <p>Don't have an account? <a href="register2.html" class="text-primary m-l-5"><b>Sign Up</b></a></p>
          </div>
        </div> -->
      {{-- </form> --}}
      {!! Form::close() !!}

      {{-- <form class="form-horizontal" id="recoverform" action="index.html"> --}}
        {!! Form::open(['route'=>'password.email', 'id'=>'recoverform', 'class'=>'form-horizontal']) !!}
        <div class="form-group ">
          <div class="col-xs-12">
            <h3>Recover Password</h3>
            <p class="text-muted">Enter your email</p>
          </div>
        </div>
        <div class="form-group ">
          <div class="col-xs-12">
            <input name="email" class="form-control" type="text" required placeholder="Email">
          </div>
        </div>
        <div class="form-group text-center m-t-20">
          <div class="col-xs-6">
            <button class="btn btn-primary btn-lg btn-block text-uppercase waves-effect waves-light" type="submit">Submit</button>
          </div>

          <div class="col-xs-6">
            <a href="{{ url('admin/login') }}">
            <button class="btn btn-primary btn-lg btn-block text-uppercase waves-effect waves-light" type="button">Back</button>
            </a>
          </div>
        </div>
      {{-- </form> --}}
      {!! Form::close() !!}
    </div>
  </div>
</section>
<!-- jQuery -->
<script src="{{ asset('js/admin/jquery.min.js')}}"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="{{ asset('js/admin/bootstrap.min.js')}}"></script>
    <!-- Menu Plugin JavaScript -->
    <script src="{{ asset('js/admin/sidebar-nav.min.js')}}"></script>
    <!--slimscroll JavaScript -->
    <script src="{{ asset('js/admin/jquery.slimscroll.js')}}"></script>
    <!--Wave Effects -->
    <script src="{{ asset('js/admin/waves.js')}}"></script>
    <!-- Custom Theme JavaScript -->
    <script src="{{ asset('js/admin/custom.min.js')}}"></script>
    <!--Style Switcher -->
    <script src="{{ asset('js/admin/jQuery.style.switcher.js')}}"></script>
</body>
</html>
