<!-- Edit SEO Info Property Admin -->
<form class="seoinfo" name="seoinfoForm" ng-submit="submitSeoinfo(seoinfoForm.$valid)" novalidate role="form" method="post" enctype="multipart/form-data">
	{{ csrf_field() }}
	<div class="form-group" ng-class="{ 'has-error' : seoinfoForm.property_seourl.$invalid && !seoinfoForm.property_seourl.$pristine }">
	  <label for="property_seourl" class="col-sm-2 control-label">SEO URL<span class="required-mark">*</span> : </label>
	  <div class="col-sm-10">
		<input type="text" class="form-control" id="property_seourl" name="property_seourl" placeholder="Enter Property SEO URL" value="{{ $propertydata->property_seourl }}" data-ng-model="property.seoinfo.property_seourl" required>
		<span class="help-block" ng-show="seoinfoForm.property_seourl.$invalid && !seoinfoForm.property_seourl.$pristine">SEO Url is required.</span>
	  </div>
	</div>
	<div class="form-group" ng-class="{ 'has-error' : seoinfoForm.property_metatitle.$invalid && !seoinfoForm.property_metatitle.$pristine }">
	  <label for="property_metatitle" class="col-sm-2 control-label">Meta Title<span class="required-mark">*</span> : </label>
	  <div class="col-sm-10">
		<input type="text" class="form-control" id="property_metatitle" name="property_metatitle" placeholder="Enter Property Meta Title" value="{{ $propertydata->property_metatitle }}" data-ng-model="property.seoinfo.property_metatitle" required>
		<span class="help-block" ng-show="seoinfoForm.property_metatitle.$invalid && !seoinfoForm.property_metatitle.$pristine">SEO meta title is required.</span>
	  </div>
	</div>
	<div class="form-group" ng-class="{ 'has-error' : seoinfoForm.property_metakeywords.$invalid && !seoinfoForm.property_metakeywords.$pristine }">
	  <label for="property_metakeywords" class="col-sm-2 control-label">Meta Keywords<span class="required-mark">*</span> : </label>
	  <div class="col-sm-10">
		<input data-role="tagsinput" type="text" class="form-control tagsinput" id="property_metakeywords" name="property_metakeywords" placeholder="Enter MetaKeywords" value="{{ $propertydata->property_metakeywords }}" required data-ng-model="property.seoinfo.property_metakeywords">
		<span class="help-block" ng-show="seoinfoForm.property_metakeywords.$invalid && !seoinfoForm.property_metakeywords.$pristine">SEO meta keywords is required.</span>
	  </div>
	</div>
	<div class="form-group" ng-class="{ 'has-error' : seoinfoForm.property_metadesc.$invalid && !seoinfoForm.property_metadesc.$pristine }">
	  <label for="property_metadesc" class="col-sm-2 control-label">Meta Description<span class="required-mark">*</span> : </label>
	  <div class="col-sm-10">
		<textarea name="property_metadesc" id="property_metadesc" rows="5" cols="80" placeholder="Enter Meta Description" class="form-control resizeverticleonly" required data-ng-model="property.seoinfo.property_metadesc" value="{{ $propertydata->property_metadesc }}">{{ $propertydata->property_metadesc }}</textarea>
		<span class="help-block" ng-show="seoinfoForm.property_metadesc.$invalid && !seoinfoForm.property_metadesc.$pristine">SEO meta description is required.</span>
	  </div>
	</div>
	<div class="row">
		<div class="col-sm-10 col-md-10 col-lg-10 pull-right">
			<div id="dataseosave_message"></div>
		</div>
	</div>
	<div class="button-group">
		<button class="btn btn-primary mrgn-right10" type="submit" ng-disabled="seoinfoForm.$invalid" id="savePropertyseoinfobtn">Save</button>
		<a class="btn btn-primary" href="{{ url('admin/property') }}">Cancel</a>
	</div>
</form>							  
<!-- /.content -->