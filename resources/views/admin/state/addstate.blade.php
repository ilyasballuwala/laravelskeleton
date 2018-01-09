<!-- Add State for Admin -->
@extends('layouts.admin_template')
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
	<div class="row">
       		<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
       			<h1 class="mainsection-title">State Management</h1>
       		</div>
       		<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
       			<a href="{{ url('/admin/state') }}" class="btn btn-primary headeradd-btn pull-right">View State Listing</a>
       		</div>
       </div>
</section>
<!-- Main content -->
<section class="content">
	<!-- Small boxes (Stat box) -->
    <div class="box box-primary">
    	<div class="box-header with-border">
        	<h3 class="box-title">Add State</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form class="" role="form" method="POST" action="{{ url('/admin/state') }}" enctype="multipart/form-data">
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
						<div class="form-group {{ $errors->has('state_name') ? ' has-error' : '' }}">
						  <label for="state_name" class="col-sm-2 control-label">State Name<span class="required-mark">*</span> : </label>
						  <div class="col-sm-10">
							<input type="text" class="form-control" id="state_name" name="state_name" placeholder="Enter State Name" value="{{ old('state_name') }}">
							@if ($errors->has('state_name'))
								<span class="help-block">{{ $errors->first('state_name') }}</span>
							@endif
						  </div>
						</div>
						<div class="form-group {{ $errors->has('state_abbr') ? ' has-error' : '' }}">
						  <label for="state_abbr" class="col-sm-2 control-label">State Abbrevation<span class="required-mark">*</span> : </label>
						  <div class="col-sm-10">
							<input type="text" class="form-control" id="state_abbr" name="state_abbr" placeholder="Enter State Abbrevation" value="{{ old('state_abbr') }}">
							@if ($errors->has('state_abbr'))
								<span class="help-block">{{ $errors->first('state_abbr') }}</span>
							@endif
						  </div>
						</div>
						<div class="form-group">
						  <label for="state_abbr" class="col-sm-2 control-label">State Status<span class="required-mark">*</span> : </label>
						  <div class="col-sm-10">
							  <div class="radio inline">
								<label><input type="radio" name="state_status" id="status_active" value="1" checked>Active</label>
							  </div>
							  <div class="radio inline">
								<label><input type="radio" name="state_status" id="status_inactive" value="0" {{ (old("state_status") == '0' ? 'checked' : "" ) }}>Inactive</label>
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