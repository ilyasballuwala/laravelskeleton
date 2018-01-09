<!-- Added Amit on 03-03-2017 -->
<!-- Change Password Page for Admin -->
@extends('layouts.admin_template')
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
	<h1>Change Password</h1>
</section>
<!-- Main content -->
<section class="content">
	<!-- Small boxes (Stat box) -->
    <div class="box box-primary">
    	<div class="box-header with-border">
        	<h3 class="box-title">Change Password for Admin</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form class="" role="form" method="POST" action="{{ url('/admin/changepass') }}" enctype="multipart/form-data">
        	{{ csrf_field() }}
        	<div class="box-body">
            	<!-- Start .flash-message -->
            	<div class="flash-message">
                    @foreach(['danger','warning','success','info'] as $msg)
                    	@if(Session::has('alert-'.$msg))
                			<p class="alert alert-{{ $msg }}">{{ Session::get('alert-'.$msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
                      	@endif
                    @endforeach
            	</div> 
                <!-- end .flash-message -->
              	<div class="row">
					<div class="col-md-6">
                		<div class="form-group {{ $errors->has('currentpass') ? ' has-error' : '' }}">
                  			<label for="current_password">Current Password</label>
                  			<div class="input-group">
                				<span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                            	<input type="password" class="form-control" id="currentpass" name="currentpass" value="">
                            </div>
							@if($errors->has('currentpass'))
                        		<span class="help-block">
                            		<strong>{{ $errors->first('currentpass') }}</strong>
                        		</span>
                    		@endif
                		</div>
                 		<div class="form-group {{ $errors->has('newpass') ? ' has-error' : '' }}">
                  			<label for="new_password">New Password</label>
                  			<div class="input-group">
                				<span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                            	<input type="password" class="form-control" id="newpass" name="newpass" value="">
                            </div>
                 			@if($errors->has('newpass'))
                        		<span class="help-block">
                            		<strong>{{ $errors->first('newpass') }}</strong>
                        		</span>
                    		@endif
                		</div>
                		<div class="form-group {{ $errors->has('newpass_confirmation') ? ' has-error' : '' }}">
                  			<label for="newpass_confirmation">Confirm Password</label>
                  			<div class="input-group">
                				<span class="input-group-addon"><i class="glyphicon glyphicon-log-in"></i></span>
                            	<input type="password" class="form-control" id="newpass_confirmation" name="newpass_confirmation" value="">
                            </div>
							@if($errors->has('newpass_confirmation'))
                        		<span class="help-block">
                            		<strong>{{ $errors->first('newpass_confirmation') }}</strong>
                        		</span>
                    		@endif
                		</div>
                	</div>
                </div>
            </div>
            <!-- /.box-body -->
			<div class="box-footer">
            	<button class="btn btn-primary" type="submit">Submit</button>
            </div>
        </form>
    </div>
    <!-- /.row -->
</section>
<!-- /.content -->
@endsection