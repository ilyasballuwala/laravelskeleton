<!-- Edit General Info Property Admin -->
<form class="generalinfo" name="generalinfoForm" ng-submit="submitGeneralinfo(generalinfoForm.$valid)" novalidate role="form" method="post" enctype="multipart/form-data">
	{{ csrf_field() }}
	<input type="hidden" name="property_id" value="{{ $propertyid }}" data-ng-model="property.property_id" />
	<div class="form-group" ng-class="{ 'has-error' : generalinfoForm.property_name.$invalid && !generalinfoForm.property_name.$pristine }">
	  <label for="property_name" class="col-sm-2 control-label">Property Name<span class="required-mark">*</span> : </label>
	  <div class="col-sm-10">
		<input type="text" class="form-control" id="property_name" name="property_name" placeholder="Enter Property Name" value="{{ $propertydata->property_name }}" data-ng-model="property.generalinfo.property_name" required>
		<span class="help-block" ng-show="generalinfoForm.property_name.$invalid && !generalinfoForm.property_name.$pristine">Property name is required.</span>
	  </div>
	</div>
	<div class="form-group" ng-class="{ 'has-error' : generalinfoForm.property_location.$invalid && !generalinfoForm.property_location.$pristine }">
	  <label for="property_location" class="col-sm-2 control-label">Property Location<span class="required-mark">*</span> : </label>
	  <div class="col-sm-10">
		<input type="text" class="form-control" id="property_location" name="property_location" placeholder="Enter Property Location" value="{{ $propertydata->property_location }}" data-ng-model="property.generalinfo.property_location" required>
		<span class="help-block" ng-show="generalinfoForm.property_location.$invalid && !generalinfoForm.property_location.$pristine">Property location is required.</span>
	  </div>
	</div>
	<div class="form-group" ng-class="{ 'has-error' : generalinfoForm.property_desc.$invalid && !generalinfoForm.property_desc.$pristine }">
	  <label for="property_desc" class="col-sm-2 control-label">Property Description<span class="required-mark">*</span> : </label>
	  <div class="col-sm-10">
		<textarea id="property_desc" name="property_desc" rows="10" cols="80" class="form-control resizeverticleonly" data-ng-model="property.generalinfo.property_desc" value="{{ str_replace('<br />',"\n",$propertydata->property_desc ) }}" placeholder="Enter Property Description" required></textarea>
		<span class="help-block" ng-show="generalinfoForm.property_desc.$invalid && !generalinfoForm.property_desc.$pristine">Property description is required.</span>
	  </div>
	</div>
	<div class="form-group" ng-class="{ 'has-error' : generalinfoForm.property_state.$invalid && !generalinfoForm.property_state.$pristine }">
	  <label for="property_state" class="col-sm-2 control-label">Property State<span class="required-mark">*</span> : </label>
	  <div class="col-sm-10">
		<select class="form-control selectbox select2" name="property_state" id="property_state" data-ng-init="getCity('{{ $propertydata->property_state }}');  property.generalinfo.property_state='{{ $propertydata->property_state }}' " data-ng-model="property.generalinfo.property_state" data-ng-change="getCity(property.generalinfo.property_state)" required>
			<option value="">Select State</option>	
			@foreach($statedata as $key=>$state)
				<option value="{{ $key }}" {{ ($propertydata->property_state == $key ? "selected":"") }}>{{ $state }}</option>
			@endforeach
		</select>
		<span class="help-block" ng-show="generalinfoForm.property_state.$invalid && !generalinfoForm.property_state.$pristine">Property State is required.</span>
	  </div>
	</div>
	<div class="form-group" ng-class="{ 'has-error' : generalinfoForm.property_city.$invalid && !generalinfoForm.property_city.$pristine }">
	  <label for="property_city" class="col-sm-2 control-label">Property City<span class="required-mark">*</span> : </label>
	  <div class="col-sm-10">
		<select class="form-control selectbox select2" name="property_city" id="property_city" data-ng-model="property.generalinfo.property_city" data-ng-init="property.generalinfo.property_city='{{ $propertydata->property_city }}'" required>
			<option value="">Select City</option>
			<option data-ng-repeat="city in citydata" value="@{{city.id}}">@{{city.name}}</option>
		</select>
		<span class="help-block" ng-show="generalinfoForm.property_city.$invalid && !generalinfoForm.property_city.$pristine">Property City is required.</span>
	  </div>
	</div>
	<div class="form-group" ng-class="{ 'has-error' : generalinfoForm.property_seourl.$invalid && !generalinfoForm.property_seourl.$pristine }">
	  <label for="property_seourl" class="col-sm-2 control-label">Property SEO URL<span class="required-mark">*</span> : </label>
	  <div class="col-sm-10">
		<input type="text" class="form-control" id="property_seourl" name="property_seourl" placeholder="Enter Property SEO URL" value="{{ $propertydata->property_seourl }}" data-ng-model="property.generalinfo.property_seourl" required>
		<span class="help-block" ng-show="generalinfoForm.property_seourl.$invalid && !generalinfoForm.property_seourl.$pristine">Property SEO url is required.</span>
	  </div>
	</div>
	<div class="form-group" ng-class="{ 'has-error' : generalinfoForm.property_address.$invalid && !generalinfoForm.property_address.$pristine }">
	  <label for="property_address" class="col-sm-2 control-label">Street Address<span class="required-mark">*</span> : </label>
	  <div class="col-sm-10">
		<input type="text" class="form-control" id="property_address" name="property_address" placeholder="Enter Property Address" value="{{ $propertydata->property_address }}" data-ng-model="property.generalinfo.property_address" required>
		<span class="help-block" ng-show="generalinfoForm.property_address.$invalid && !generalinfoForm.property_address.$pristine">Street address is required.</span>
	  </div>
	</div>
	<div class="form-group" ng-class="{ 'has-error' : generalinfoForm.property_postalcode.$invalid && !generalinfoForm.property_postalcode.$pristine }">
	  <label for="property_postalcode" class="col-sm-2 control-label">Postal Code<span class="required-mark">*</span> : </label>
	  <div class="col-sm-10">
		<input type="text" class="form-control" id="property_postalcode" name="property_postalcode" placeholder="Enter Postal Code" value="{{ $propertydata->property_postalcode }}" data-ng-model="property.generalinfo.property_postalcode" numeric-only maxlength="9" required>
		<span class="help-block" ng-show="generalinfoForm.property_postalcode.$invalid && !generalinfoForm.property_postalcode.$pristine">Please enter valid postal code.</span>
	  </div>
	</div>
	<div class="form-group" ng-class="{ 'has-error' : generalinfoForm.property_phoneno.$invalid && !generalinfoForm.property_phoneno.$pristine }">
	  <label for="property_phoneno" class="col-sm-2 control-label">Contact No<span class="required-mark">*</span> : </label>
	  <div class="col-sm-10">
		<input type="text" class="form-control" id="property_phoneno" name="property_phoneno" placeholder="Enter Contact No" value="{{ $propertydata->property_phoneno }}" data-ng-model="property.generalinfo.property_phoneno" numeric-only maxlength="11" required>
		<span class="help-block" ng-show="generalinfoForm.property_phoneno.$invalid && !generalinfoForm.property_phoneno.$pristine">Please enter valid phone no.</span>
	  </div>
	</div>
	<div class="form-group" ng-class="{ 'has-error' : generalinfoForm.property_email.$invalid && !generalinfoForm.property_email.$pristine }">
	  <label for="property_email" class="col-sm-2 control-label">Property Email<span class="required-mark">*</span> : </label>
	  <div class="col-sm-10">
		<input type="email" class="form-control" id="property_email" name="property_email" placeholder="Enter Property Email" value="{{ $propertydata->property_email }}" data-ng-model="property.generalinfo.property_email" required>
		<span class="help-block" ng-show="generalinfoForm.property_email.$invalid && !generalinfoForm.property_email.$pristine">Please enter valid email.</span>
	  </div>
	</div>
	<div class="form-group">
	  <label for="state_abbr" class="col-sm-2 control-label">Property Status : </label>
	  <div class="col-sm-10" data-ng-init='property.generalinfo.property_status = {{ $propertydata->property_status }}'>
		  <div class="radio inline">
			<label><input type="radio" name="property_status" id="status_active" data-ng-model="property.generalinfo.property_status" ng-value="1">Active</label>
		  </div>
		  <div class="radio inline">
			<label><input type="radio" name="property_status" id="status_inactive" data-ng-model="property.generalinfo.property_status" ng-value="0">Inactive</label>
		  </div>
	  </div>
	</div>
	<div class="row">
		<div class="col-sm-10 col-md-10 col-lg-10 pull-right">
			<div id="datasave_message"></div>
		</div>
	</div>
	<div class="button-group">
		<button class="btn btn-primary mrgn-right10" type="submit" ng-disabled="generalinfoForm.$invalid" data-ng-model="property.property_basicinfosave" id="savePropertyinfobtn">Save</button>
		<a class="btn btn-primary" href="{{ url('admin/property') }}">Cancel</a>
	</div>
</form>							  

<!--data-ng-click="saveGeneralinfo()"-->
<!-- /.content -->