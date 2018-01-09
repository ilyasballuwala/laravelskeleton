<!-- Added Amit on 03-03-2017 -->
<!-- Change Profile Page for Admin -->
@extends('layouts.admin_template')
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
	<h1>Edit Profile</h1>
</section>
<!-- Main content -->
<section class="content">
	<!-- Small boxes (Stat box) -->
    <div class="box box-primary">
    	<div class="box-header with-border">
        	<h3 class="box-title">Edit Profile of Admin</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form class="" role="form" method="POST" action="{{ url('/admin/profile') }}" enctype="multipart/form-data">
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
                		<div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                  			<label for="profile_name">Name</label>
                  			<div class="input-group">
                				<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                				<input type="text" class="form-control" id="name" name="name" value="{{ $userData->name }}">
              				</div>
							@if($errors->has('name'))
                        		<span class="help-block">
                            		<strong>{{ $errors->first('name') }}</strong>
                        		</span>
                    		@endif
                		</div>
                		<div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                  			<label for="profile_email">E-Mail Address</label>
                            <div class="input-group">
                				<span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                  				<input type="email" class="form-control" id="email" name="email" value="{{ $userData->email }}">
                            </div>
							@if($errors->has('email'))
                            	<span class="help-block">
                                	<strong>{{ $errors->first('email') }}</strong>
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