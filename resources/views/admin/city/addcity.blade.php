<!-- Add State for Admin -->
@extends('layouts.admin_template')
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
	<div class="row">
       		<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
       			<h1 class="mainsection-title">City Management</h1>
       		</div>
       		<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
       			<a href="{{ url('/admin/city') }}" class="btn btn-primary headeradd-btn pull-right">View City Listing</a>
       		</div>
       </div>
</section>
<!-- Main content -->
<section class="content">
	<!-- Small boxes (Stat box) -->
    <div class="box box-primary">
    	<div class="box-header with-border">
        	<h3 class="box-title">Add City</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form class="" role="form" method="POST" action="{{ url('/admin/city') }}" enctype="multipart/form-data">
			{{ csrf_field() }}
        	<div class="box-body">
            	<!-- Start .flash-message -->
				  <div class="flash-message mrgn-top15">
					@foreach (['danger', 'warning', 'success', 'info'] as $msg)
					  @if(Session::has('alert-' . $msg))
					  <div class="alert alert-{{ $msg }} alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><h4>{{ ucfirst(($msg == 'danger') ? "Error" : $msg) }}!</h4> {{ Session::get('alert-' . $msg) }}</div>
					  @endif
					@endforeach
				  </div> 
				<!-- end .flash-message -->
				<div class="row">
					<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
						<div class="form-group {{ $errors->has('city_name') ? ' has-error' : '' }}">
						  <label for="city_name" class="col-sm-2 control-label">City Name<span class="required-mark">*</span> : </label>
						  <div class="col-sm-10">
							<input type="text" class="form-control" id="city_name" name="city_name" placeholder="Enter City Name" value={{ old('city_name') }}>
							@if ($errors->has('city_name'))
								<span class="help-block">{{ $errors->first('city_name') }}</span>
							@endif
						  </div>
						</div>
						<div class="form-group {{ $errors->has('city_abbr') ? ' has-error' : '' }}">
						  <label for="city_abbr" class="col-sm-2 control-label">City Abbrevation<span class="required-mark">*</span> : </label>
						  <div class="col-sm-10">
							<input type="text" class="form-control" id="city_abbr" name="city_abbr" placeholder="Enter City Abbrevation" value={{ old('city_abbr') }}>
							@if ($errors->has('city_abbr'))
								<span class="help-block">{{ $errors->first('city_abbr') }}</span>
							@endif
						  </div>
						</div>
						<div class="form-group {{ $errors->has('state_id') ? ' has-error' : '' }}">
						  <label for="state_id" class="col-sm-2 control-label">Select State<span class="required-mark">*</span> : </label>
						  <div class="col-sm-10">
						  	<select class="form-control selectbox select2" name="state_id" id="state_id">
				  	  			<option value="">Select State for City</option>	
					  	  		@foreach($statedata as $key=>$state)
									<option value="{{ $key }}" {{ (old("state_id") == $key ? "selected":"") }}>{{ $state }}</option>
								@endforeach
							</select>
							@if ($errors->has('state_id'))
								<span class="help-block">{{ $errors->first('state_id') }}</span>
							@endif
						  </div>
						</div>
						
						<div class="form-group">
						  <label for="state_abbr" class="col-sm-2 control-label">City Status<span class="required-mark">*</span> : </label>
						  <div class="col-sm-10">
							  <div class="radio inline">
								<label><input type="radio" name="city_status" id="status_active" value="1" checked>Active</label>
							  </div>
							  <div class="radio inline">
								<label><input type="radio" name="city_status" id="status_inactive" value="0" {{ (old("city_status") == '0' ? 'checked' : "" ) }}>Inactive</label>
							  </div>
						  </div>
						</div>
					</div>
				</div>
            </div>
            <div class="box-footer">
			  <button class="btn btn-primary mrgn-right10" type="submit">Submit</button>
			  <button class="btn btn-primary" type="reset">Reset</button>
			</div>
         </form>
          
    </div>
    <!-- /.row -->
</section>
<!-- /.content -->
@endsection