<!-- Edit Amenities and Features Info Property Admin -->
<form class="amenitiesinfo" name="amenitiesinfoForm" ng-submit="submitAmenitiesinfo(amenitiesinfoForm.$valid)" novalidate role="form" method="post" enctype="multipart/form-data">
	{{ csrf_field() }}
	<div class="amenities-container" data-ng-init="assignAmenitesandFeatures('{{ $propertydata->property_amenities }}','{{ $propertydata->property_features }}')">
		<h3 class="property-tabheadline">Property Amenities</h3>
		<div class="row">
			@foreach($amenitiesdata as $amenities)
				<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 individual-amenities">
					<div class="checkbox marginnone">
					  <label>
						<input type="checkbox" name="amenity_{{ $amenities->amenity_id }}" id="amenity_{{ $amenities->amenity_id }}" data-ng-model="bool_amenity{{ $amenities->amenity_id }}" ng-value="{{ $amenities->amenity_id }}" data-ng-click="saveAmenities(bool_amenity{{ $amenities->amenity_id }},{{ $amenities->amenity_id }})" data-ng-checked="isAmenitieshave({{ $amenities->amenity_id }})"> {{ $amenities->amenity_name }} 
					  </label>
					</div>
				</div>
			@endforeach
		</div>
	</div>
	<hr class="room-hour-seperator">
	<div class="features-container">
		<h3 class="property-tabheadline">Property Features</h3>
		<div class="row">
		  @foreach($featuresdata as $features)
			<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 individual-amenities">
				<div class="checkbox marginnone">
				  <label>
					<input type="checkbox" name="features_{{ $features->feature_id }}" id="feature_{{ $features->feature_id }}" data-ng-model="bool_feature{{ $features->feature_id }}" data-ng-click="saveFeatures(bool_feature{{ $features->feature_id }},{{ $features->feature_id }})" data-ng-checked="isFeatureshave({{ $features->feature_id }})"> {{ $features->feature_title }} 
				  </label>
				</div>
			</div>
		  @endforeach
		</div>
	</div>
	<div class="row">
		<div class="col-sm-12 col-md-12 col-lg-12 pull-right">
			<div id="dataamenitiessave_message"></div>
		</div>
	</div>
	<div class="button-group">
		<button class="btn btn-primary mrgn-right10" type="submit" ng-disabled="!checkamenityandfeatyure()" id="saveAmenitiesinfobtn">Save</button>
		<a class="btn btn-primary" href="{{ url('admin/property') }}">Cancel</a>
	</div>
</form>							  
<!-- /.content -->