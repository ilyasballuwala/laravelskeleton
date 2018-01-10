<!-- Edited Amit on 21/07/2017 -->
<!-- Add new layout of login page as per admin theme -->
@extends('admin.auth.master')
@section('content')
<div class="login-box">
	<div class="login-logo">
    	<a href="{{ url('/admin') }}"><img src="{{ asset("images/ecabs.png") }}" class="logo-image img-responsive" alt="Admin e-Cabs4u"></a>
  	</div>
  	<!-- /.login-logo -->
  	<div class="login-box-body">
    	<p class="login-box-msg">Sign in to get access of Admin section</p>
		<form class="form-horizontal" role="form" method="POST" action="{{ url('/admin/login') }}">
    		{{ csrf_field() }}
     		<div class="form-group has-feedback {{ $errors->has('email') ? 'has-error' : '' }}">
            	<input type="email" name="email" class="form-control" value="{{ old('email') }}" placeholder="Email">
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                @if($errors->has('email'))
                	<span class="help-block"><strong>{{ $errors->first('email') }}</strong></span>
                @endif
            </div>
            <div class="form-group has-feedback {{ $errors->has('password') ? 'has-error' : '' }}">
            	<input type="password" name="password" class="form-control" placeholder="Password">
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                @if($errors->has('password'))
                	<span class="help-block"><strong>{{ $errors->first('password') }}</strong></span>
                @endif
            </div>
            <div class="row">
        		<div class="col-xs-8">
          			<!--<div class="checkbox icheck">
            			<label><input type="checkbox" name="remember"> Remember Me</label>
          			</div>-->
        		</div>
        		<!-- /.col -->
        		<div class="col-xs-4">
          			<button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
        		</div>
        		<!-- /.col -->
      		</div>
      		<div class="row">
            	<div class="col-xs-8">
                	<a href="{{ url('/admin/password/reset') }}" class="text-center">Forgot Your Password?</a>
                </div>
      			<div class="col-xs-4">
      				<a href="{{ url('/admin/register') }}" class="text-center">Register</a>
        		</div>
      		</div>
    	</form>
  	</div>
  	<!-- /.login-box-body -->
</div>
<!-- /.login-box -->
@endsection
<!-- Edited Amit End -->