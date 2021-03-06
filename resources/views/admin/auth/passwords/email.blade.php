<!-- Edited Amit on 21/07/2017 -->
<!-- Add new layout of forgot password page as per admin theme -->
@extends('admin.auth.master')
@section('content')
<div class="login-box">
	<div class="login-logo">
    	<a href="{{ url('/admin') }}"><img src="{{ asset("images/ecabs.png") }}" class="logo-image img-responsive" alt="Admin e-Cabs4u"></a>
    </div>
    <!-- /.login-logo -->
    <div class="login-box-body">
    	<p class="login-box-msg">Reset Password</p>
        @if(session('status'))
        	<div class="alert alert-success">
            	{{ session('status') }}
            </div>
        @endif
        <form role="form" method="POST" action="{{ url('/admin/password/email') }}">
        	{{ csrf_field() }}
			<div class="form-group has-feedback {{ $errors->has('email') ? 'has-error' : '' }}">
            	<input type="email" id="email" name="email" class="form-control" value="{{ old('email') }}" placeholder="E-Mail Address">
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                @if($errors->has('email'))
                	<span class="help-block">
                    	<strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
            </div>
            <div class="row">
            	<div class="col-xs-4">
                	<a href="{{ url('/admin/login') }}" class="text-center">Back to Login</a>
                </div>
                <div class="col-xs-8">
                	<button type="submit" class="btn btn-primary btn-block btn-flat">Send Password Reset Link</button>
                </div>
            </div>
        </form>
    </div>
    <!-- /.login-box-body -->
</div><!-- /.login-box -->
@endsection