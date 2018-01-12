<!-- Edited Amit on 02-03-2017 -->
<!-- Add new layout of reset password page as per admin theme -->
@extends('admin.auth.master')
@section('content')
<div class="login-box">
	<div class="login-logo">
   		<a href="{{ url('/admin') }}"><img src="{{ asset("images/efficient-corporate.png") }}" class="img-responsive" alt="Admin Efficient Corporate"></a>
    </div>
    <!-- /.login-logo -->
    <div class="login-box-body">
    	<p class="login-box-msg">Reset Password</p>
        <form role="form" method="POST" action="{{ url('/admin/password/reset') }}">
        	{{ csrf_field() }}
			<input type="hidden" name="token" value="{{ $token }}">
			<div class="form-group has-feedback {{ $errors->has('email') ? 'has-error' : '' }}">
            	<input type="email" id="email" name="email" class="form-control" value="{{ $email or old('email') }}" placeholder="E-Mail Address">
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                @if($errors->has('email'))
                	<span class="help-block">
                    	<strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
            </div>
            <div class="form-group has-feedback {{ $errors->has('password') ? 'has-error' : '' }}">
            	<input type="password" id="password" name="password" class="form-control" placeholder="Password">
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                @if($errors->has('password'))
                	<span class="help-block">
                    	<strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
            </div>
            <div class="form-group has-feedback {{ $errors->has('password_confirmation') ? 'has-error' : '' }}">
            	<input type="password" id="password-confirm" name="password_confirmation" class="form-control" placeholder="Confirm Password">
                <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
                @if($errors->has('password_confirmation'))
                	<span class="help-block">
                    	<strong>{{ $errors->first('password_confirmation') }}</strong>
                    </span>
                @endif
            </div>
            <button type="submit" class="btn btn-primary btn-block btn-flat">Reset Password</button>
        </form>
    </div>
    <!-- /.login-box-body -->
</div><!-- /.login-box -->
@endsection