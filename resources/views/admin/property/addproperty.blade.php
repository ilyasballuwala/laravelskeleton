<!-- Add Property for Admin -->
@extends('layouts.admin_template')
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
	<div class="row">
       		<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
       			<h1 class="mainsection-title">{{ $title }}</h1>
       		</div>
       		<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
       			<a href="{{ url('/admin/property') }}" class="btn btn-primary headeradd-btn pull-right">View Property Listing</a>
       		</div>
       </div>
</section>
<!-- Main content -->
<section class="content" data-ng-controller="propertyController">
	<!-- Small boxes (Stat box) -->
    <div class="box box-primary">
    	<div class="box-header with-border">
        	<h3 class="box-title">Add New Property</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form class="" role="form" method="POST" action="{{ url('/admin/property') }}" enctype="multipart/form-data">
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
						<div class="form-group {{ $errors->has('property_name') ? ' has-error' : '' }}">
						  <label for="property_name" class="col-sm-2 control-label">Property Name<span class="required-mark">*</span> : </label>
						  <div class="col-sm-10">
							<input type="text" class="form-control" id="property_name" name="property_name" placeholder="Enter Property Name" value="{{ old('property_name') }}" data-ng-model="property.property_name">
							@if ($errors->has('property_name'))
								<span class="help-block">{{ $errors->first('property_name') }}</span>
							@endif
						  </div>
						</div>
						<div class="form-group {{ $errors->has('property_location') ? ' has-error' : '' }}">
						  <label for="property_location" class="col-sm-2 control-label">Property Location<span class="required-mark">*</span> : </label>
						  <div class="col-sm-10">
							<input type="text" class="form-control" id="property_location" name="property_location" placeholder="Enter Property Location" value="{{ old('property_location') }}" data-ng-model="property.property_location">
							@if ($errors->has('property_location'))
								<span class="help-block">{{ $errors->first('property_location') }}</span>
							@endif
						  </div>
						</div>
						<div class="form-group {{ $errors->has('property_desc') ? ' has-error' : '' }}">
						  <label for="property_desc" class="col-sm-2 control-label">Property Description<span class="required-mark">*</span> : </label>
						  <div class="col-sm-10">
						  	<textarea id="property_desc" name="property_desc" rows="10" cols="80" class="form-control resizeverticleonly" data-ng-model="property.property_desc" value="{{ old('property_desc') }}" placeholder="Enter Property Description"></textarea>
							@if ($errors->has('property_desc'))
								<span class="help-block">{{ $errors->first('property_desc') }}</span>
							@endif
						  </div>
						</div>
						<div class="form-group {{ $errors->has('property_state') ? ' has-error' : '' }}">
						  <label for="property_state" class="col-sm-2 control-label">Property State<span class="required-mark">*</span> : </label>
						  <div class="col-sm-10">
						  	<select class="form-control selectbox select2" name="property_state" id="property_state" data-ng-init="getCity('{{ old("property_state") }}'); property.property_state = '{{ old("property_state") }}'" data-ng-model="property.property_state" data-ng-change="getCity(property.property_state)">
				  	  			<option value="">Select State</option>	
					  	  		@foreach($statedata as $key=>$state)
									<option value="{{ $key }}" {{ (old("property_state") == $key ? "selected" : "") }}>{{ $state }}</option>
								@endforeach
							</select>
							@if ($errors->has('property_state'))
								<span class="help-block">{{ $errors->first('property_state') }}</span>
							@endif
						  </div>
						</div>
						<div class="form-group {{ $errors->has('property_city') ? ' has-error' : '' }}">
						  <label for="property_city" class="col-sm-2 control-label">Property City<span class="required-mark">*</span> : </label>
						  <div class="col-sm-10">
						  	<select class="form-control selectbox select2" name="property_city" id="property_city" data-ng-model="property.property_city" ng-init="property.property_city='{{ old("property_city") }}'">
				  	  			<option value="">Select City</option>
				  	  			<option data-ng-repeat="city in citydata" value="@{{city.id}}">@{{city.name}}</option>			  	  		
							</select>
							@if ($errors->has('property_city'))
								<span class="help-block">{{ $errors->first('property_city') }}</span>
							@endif
						  </div>
						</div>
						<div class="form-group {{ $errors->has('property_seourl') ? ' has-error' : '' }}">
						  <label for="property_seourl" class="col-sm-2 control-label">Property SEO URL<span class="required-mark">*</span> : </label>
						  <div class="col-sm-10">
							<input type="text" class="form-control" id="property_seourl" name="property_seourl" placeholder="Enter Property SEO URL" value="{{ old('property_seourl') }}" data-ng-model="property.property_seourl">
							@if ($errors->has('property_seourl'))
								<span class="help-block">{{ $errors->first('property_seourl') }}</span>
							@endif
						  </div>
						</div>
						<div class="form-group {{ $errors->has('property_email') ? ' has-error' : '' }}">
						  <label for="property_email" class="col-sm-2 control-label">Property Email<span class="required-mark">*</span> : </label>
						  <div class="col-sm-10">
							<input type="text" class="form-control" id="property_email" name="property_email" placeholder="Enter Property Email" value="{{ old('property_email') }}" data-ng-model="property.property_email">
							@if ($errors->has('property_email'))
								<span class="help-block">{{ $errors->first('property_email') }}</span>
							@endif
						  </div>
						</div>
						<div class="form-group {{ $errors->has('property_mainimage') ? ' has-error' : '' }}">
						  <label for="property_mainimage" class="col-sm-2 control-label">Property Main Image<span class="required-mark">*</span> : </label>
						  <div class="col-sm-10">
							<input type="file" id="property_mainimage" name="property_mainimage" value="{{ old('property_mainimage') }}" data-ng-model="property.property_mainimage">
							@if ($errors->has('property_mainimage'))
								<span class="help-block">{{ $errors->first('property_mainimage') }}</span>
							@endif
						  </div>
						</div>
                        <div class="form-group {{ $errors->has('property_logoimage') ? ' has-error' : '' }}">
						  <label for="property_logoimage" class="col-sm-2 control-label">Property Logo Image<span class="required-mark">*</span> : </label>
						  <div class="col-sm-10">
							<input type="file" id="property_logoimage" name="property_logoimage" value="{{ old('property_logoimage') }}" data-ng-model="property.property_logoimage">
							@if ($errors->has('property_logoimage'))
								<span class="help-block">{{ $errors->first('property_logoimage') }}</span>
							@endif
						  </div>
						</div>
						<div class="form-group">
						  <label for="property_status" class="col-sm-2 control-label">Property Status : </label>
						  <div class="col-sm-10">
							  <div class="radio inline">
								<label><input type="radio" name="property_status" id="status_active" value="1" checked>Active</label>
							  </div>
							  <div class="radio inline">
								<label><input type="radio" name="property_status" id="status_inactive" value="0" {{ (old("property_status") == '0' ? 'checked' : "" ) }}>Inactive</label>
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