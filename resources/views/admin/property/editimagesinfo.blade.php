<!-- Edit Property Images Info Admin -->
<form class="imagesinfo" name="imagesinfoForm" ng-submit="submitImagesinfo(imagesinfoForm.$valid)" novalidate role="form" method="post" enctype="multipart/form-data">
	{{ csrf_field() }}
	<div class="images-container">
		<h3 class="property-tabheadline">Property Images</h3>

		<div class="form-group {{ $errors->has('property_mainimage') ? ' has-error' : '' }}">
		  <label for="property_mainimage" class="col-sm-2 control-label">Property Main Image<span class="required-mark">*</span> : </label>
		  <div class="col-sm-10" data-ng-init="property.mainimagesrc = '{{ asset('images/property/'.$propertydata->property_id.'/'.$propertydata->property_mainimage) }}'">
			<input type="file" id="property_mainimage" name="property_mainimage" data-ng-model="property.images.property_mainimage" class="propertyimage_input" accept="image/*" valid-file onchange="angular.element(this).scope().uploadedFile(this)">
			<img data-ng-src="@{{ property.mainimagesrc }}" height="150px" width="150px" class="img-responsive property-mainimage">
		  </div>
		</div>
		
        <div class="form-group {{ $errors->has('property_logoimage') ? ' has-error' : '' }}">
		  <label for="property_logoimage" class="col-sm-2 control-label">Property Logo Image<span class="required-mark">*</span> : </label>
		  <div class="col-sm-10" data-ng-init="property.logoimagesrc = '{{ asset('images/property/'.$propertydata->property_id.'/'.$propertydata->property_logoimage) }}'">
			<input type="file" id="property_logoimage" name="property_logoimage" data-ng-model="property.images.property_logoimage" class="propertyimage_input" accept="image/*" valid-file onchange="angular.element(this).scope().uploadeLogoFile(this)">
			<img data-ng-src="@{{ property.logoimagesrc }}" height="150px" width="150px" class="img-responsive property-mainimage">
		  </div>
		</div>
        
		<div class="form-group {{ $errors->has('property_mainimage') ? ' has-error' : '' }}">
		  <label for="property_mainimage" class="col-sm-2 control-label">Property Other Image(s)<span class="required-mark">*</span> : </label>
		  <div class="col-sm-10">
			<div class="row otherimages-container" data-ng-init="assignPropertyimages('{{ $propertyimages }}')">
				<div class="col-xs-6 col-sm-3 col-md-2 col-lg-2" data-ng-repeat="propertyotherimage in propertyotherimagesdata track by $index">
					<img src="{{ asset('images/property/'.$propertyid) }}/@{{propertyotherimage.image_name}}" class="img-responsive property-otherimage">
					<a class="removepropertyimage" data-ng-click="removePropertyimage($index,propertyotherimage.image_id);"><i class="fa fa-times"></i></a>
				</div>
				<div ng-show="propertyotherimagesdata.length <= 0" class="nopropertyimages">No Property Images Found.</div>
			</div>

			<div class="imageinput-container" data-ng-repeat="propertyimage in propertyimagesdata">
				<div class="individualimage-input">
					<input type="file" id="property_images" name="property_images@{{$index}}" data-ng-model="propertyimage.property_images" class="propertyimage_input other" accept="image/*" valid-file onchange="angular.element(this).scope().uploadeMultipleFile(this)">
					<a class="remove-image" href="javascript:void(0)" data-ng-click="removeMultipleFile([$index])">Remove</a>
				</div>
			</div>
			<span class="help-block" ng-show="imagesinfoForm.property_images.$invalid">Please select image for all inputs.</span>
				
			<button name="addmore_image" data-ng-model="property.addmoreimage" data-ng-click="addMoreImage()" class="btn btn-primary pull-right addroombtn" type="button">Add More Image</button>

		  </div>
		</div>

	</div>
	<hr class="room-hour-seperator">
	<div class="document-container">
		<h3 class="property-tabheadline">Property Document</h3>

		<div class="form-group">
		  <label for="property_document" class="col-sm-2 control-label">Property Doc<span class="required-mark">*</span> : </label>
		  <div class="col-sm-10" data-ng-init="property.documentlink = '{{ $propertydocument }}' ">
			<a data-ng-href="@{{ property.documentlink }}" target="_blank"><img src="{{ asset('images/icon-doc.svg') }}" height="100px" width="100px" class="img-responsive property-docimage"></a>
			<input type="file" id="property_document" name="property_document" data-ng-model="property.property_document" class="propertydoc_input" onchange="angular.element(this).scope().uploadDocumentFile(this)" accept=".pdf,.doc,.docx" valid-doc-file>
		  </div>
		</div>
	</div>
	<div class="row">
		<div class="col-sm-12 col-md-12 col-lg-12 pull-right">
			<div id="dataimagessave_message"></div>
		</div>
	</div>
	<div class="button-group">
		<button class="btn btn-primary mrgn-right10" type="submit" data-ng-model="property.property_imagesinfosave" data-ng-disabled="imagesinfoForm.$invalid" id="savePropertyimageinfobtn">Save</button>
		<a class="btn btn-primary" href="{{ url('admin/property') }}">Cancel</a>
	</div>
</form>
							  
<!-- /.content -->