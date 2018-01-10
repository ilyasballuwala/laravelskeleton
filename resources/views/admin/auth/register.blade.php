<!-- Edited Amit on 21/07/2017 -->
<!-- Add new layout of login page as per admin theme -->
@extends('admin.auth.master')
@section('content')
<div class="register-box">
	<div class="register-logo">
    	<a href="{{ url('/admin') }}"><img src="{{ asset("images/ecabs.png") }}" class="logo-image img-responsive" alt="Admin e-Cabs4u"></a>
  	</div>
  	<div class="register-box-body">
    	<p class="login-box-msg">Sign up to get access of Admin section</p>
        <form role="form" method="POST" action="{{ url('/admin/register') }}">
        	{{ csrf_field() }}
      		<div class="form-group has-feedback {{ $errors->has('name') ? 'has-error' : '' }}">
        		<input type="text" name="name" id="name" class="form-control" placeholder="Full name" value="{{ old('name') }}" autofocus>
        		<span class="glyphicon glyphicon-user form-control-feedback"></span>
                @if ($errors->has('name'))
                	<span class="help-block">
                    	<strong>{{ $errors->first('name') }}</strong>
                    </span>
                @endif
      		</div>
          	<div class="form-group has-feedback {{ $errors->has('email') ? 'has-error' : '' }}">
            	<input type="email" name="email" id="email" class="form-control" placeholder="Email" value="{{ old('email') }}"> 
            	<span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                @if ($errors->has('email'))
                	<span class="help-block">
                    	<strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
          	</div>
          	<div class="form-group has-feedback {{ $errors->has('password') ? 'has-error' : '' }}">
            	<input type="password" name="password" id="password" class="form-control" placeholder="Password">
            	<span class="glyphicon glyphicon-lock form-control-feedback"></span>
                @if ($errors->has('password'))
                	<span class="help-block">
                    	<strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
          	</div>
          	<div class="form-group has-feedback {{ $errors->has('password_confirmation') ? 'has-error' : '' }}">
            	<input type="password" name="password_confirmation" id="password-confirm" class="form-control" placeholder="Retype password">
            	<span class="glyphicon glyphicon-log-in form-control-feedback"></span>
                @if ($errors->has('password_confirmation'))
                	<span class="help-block">
                    	<strong>{{ $errors->first('password_confirmation') }}</strong>
                    </span>
                @endif
          	</div>
      		<div class="row">
            	<div class="col-xs-8">
      				<a href="{{ url('/admin/login') }}" class="text-center">Go Back to Login</a>
        		</div>
        		<div class="col-xs-4">
          			<button type="submit" class="btn btn-primary btn-block btn-flat">Register</button>
        		</div>
      		</div>
    	</form>
  	</div>
  	<!-- /.form-box -->
</div>
<!-- /.register-box -->
@endsection