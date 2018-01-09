<!-- Edit CMS for Admin -->
@extends('layouts.admin_template')
@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
	<div class="row">
       		<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
       			<h1 class="mainsection-title">{{ $title }}</h1>
       		</div>
       		<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
       			<a href="{{ url('/admin/cms') }}" class="btn btn-primary headeradd-btn pull-right">View CMS Page Listing</a>
       		</div>
       </div>
</section>
<!-- Main content -->
<section class="content" data-ng-controller="cmsController">
	<!-- Small boxes (Stat box) -->
    <div class="box box-primary"> 
    	<div class="box-header with-border">
        	<h3 class="box-title">Edit CMS</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form class="" role="form" method="post" action="{{ url('/admin/cms') }}/{{ $cmsid }}" enctype="multipart/form-data">
			{{ csrf_field() }}
       		{{ method_field('PUT') }}
       		<input type="hidden" name="cms_page_id" value="{{ $cmsid }}" />
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
						<div class="form-group {{ $errors->has('cms_page_title') ? ' has-error' : '' }}">
						  <label for="cms_page_title" class="col-sm-2 control-label">CMS Title<span class="required-mark">*</span> : </label>
						  <div class="col-sm-10">
							<input type="text" class="form-control" id="cms_page_title" name="cms_page_title" placeholder="Enter CMS Page Title" value="{{ $cmsdata->cms_page_title }}">
							@if ($errors->has('cms_page_title'))
								<span class="help-block">{{ $errors->first('cms_page_title') }}</span>
							@endif
						  </div>
						</div>
						<div class="form-group {{ $errors->has('cms_page_url') ? ' has-error' : '' }}">
						  <label for="cms_page_url" class="col-sm-2 control-label">CMS URL<span class="required-mark">*</span> : </label>
						  <div class="col-sm-10">
							<input type="text" class="form-control" id="cms_page_url" name="cms_page_url" placeholder="Enter CMS Page URL" value="{{ $cmsdata->cms_page_url }}">
							@if ($errors->has('cms_page_url'))
								<span class="help-block">{{ $errors->first('cms_page_url') }}</span>
							@endif
						  </div>
						</div>
						<div class="form-group {{ $errors->has('cms_content_title') ? ' has-error' : '' }}">
						  <label for="cms_page_title" class="col-sm-2 control-label">CMS Content Title<span class="required-mark">*</span> : </label>
						  <div class="col-sm-10">
							<input type="text" class="form-control" id="cms_content_title" name="cms_content_title" placeholder="Enter CMS Content Title" value="{{ $cmsdata->cms_content_title }}">
							@if ($errors->has('cms_content_title'))
								<span class="help-block">{{ $errors->first('cms_content_title') }}</span>
							@endif
						  </div>
						</div>
						<div class="form-group {{ $errors->has('cms_page_content') ? ' has-error' : '' }}">
						  <label for="cms_page_content" class="col-sm-2 control-label">CMS Content<span class="required-mark">*</span> : </label>
						  <div class="col-sm-10">
						  	<textarea id="cms_page_content" name="cms_page_content" rows="20" cols="80" class="ckeditor">{{ $cmsdata->cms_page_content }}</textarea>
							@if ($errors->has('cms_page_content'))
								<span class="help-block">{{ $errors->first('cms_page_content') }}</span>
							@endif
						  </div>
						</div>
						<div class="form-group {{ $errors->has('cms_content_image') ? ' has-error' : '' }}">
						  <label for="sidebar_image" class="col-sm-2 control-label">Content Image : </label>
						  <div class="col-sm-10">
							<input type="file" class="input-control" id="cms_content_image" name="cms_content_image" accept="image/*">
							
							@if($cmsdata != NULL && $cmsdata->cms_content_image != '' && $cmsdata->cms_content_image != NULL)
								<img src="{{ asset('images/cmspages/'.$cmsdata->cms_page_id.'/'.$cmsdata->cms_content_image) }}" height="150px" width="150px" class="img-responsive property-mainimage">
							@endif
								
							@if ($errors->has('cms_content_image'))
								<span class="help-block">{{ $errors->first('cms_content_image') }}</span>
							@endif
						  </div>
						</div>
						<div class="form-group {{ $errors->has('cms_page_metatitle') ? ' has-error' : '' }}">
						  <label for="cms_page_url" class="col-sm-2 control-label">Meta Title<span class="required-mark">*</span> : </label>
						  <div class="col-sm-10">
							<input type="text" class="form-control" id="cms_page_metatitle" name="cms_page_metatitle" placeholder="Enter CMS Page Meta Title" value="{{ $cmsdata->cms_page_metatitle }}">
							@if ($errors->has('cms_page_metatitle'))
								<span class="help-block">{{ $errors->first('cms_page_metatitle') }}</span>
							@endif
						  </div>
						</div>
						<div class="form-group {{ $errors->has('cms_page_metakeywords') ? ' has-error' : '' }}">
						  <label for="cms_page_metakeywords" class="col-sm-2 control-label">Meta Keywords<span class="required-mark">*</span> : </label>
						  <div class="col-sm-10">
							<input data-role="tagsinput" type="text" class="form-control tagsinput" id="cms_page_metakeywords" name="cms_page_metakeywords" placeholder="Enter CMS Page MetaKeywords" value="{{ $cmsdata->cms_page_metakeywords }}">
							@if ($errors->has('cms_page_metakeywords'))
								<span class="help-block">{{ $errors->first('cms_page_metakeywords') }}</span>
							@endif
						  </div>
						</div>
						<div class="form-group {{ $errors->has('cms_page_metadesc') ? ' has-error' : '' }}">
						  <label for="cms_page_metadesc" class="col-sm-2 control-label">CMS Meta Description<span class="required-mark">*</span> : </label>
						  <div class="col-sm-10">
						  	<textarea name="cms_page_metadesc" id="cms_page_metadesc" rows="5" cols="80" placeholder="Enter Meta Description" class="form-control resizeverticleonly">{{ $cmsdata->cms_page_metadesc }}</textarea>
							@if ($errors->has('cms_page_metadesc'))
								<span class="help-block">{{ $errors->first('cms_page_metadesc') }}</span>
							@endif
						  </div>
						</div>
						<div class="form-group">
						  <label for="state_abbr" class="col-sm-2 control-label">CMS Status : </label>
						  <div class="col-sm-10">
							  <div class="radio inline">
								<label><input type="radio" name="cms_page_status" id="status_active" value="1" checked>Active</label>
							  </div>
							  <div class="radio inline">
								<label><input type="radio" name="cms_page_status" id="status_inactive" value="0" @if($cmsdata->cms_page_status == '0') checked @endif>Inactive</label>
							  </div>
						  </div>
						</div>
						<div class="form-group">
						  <label for="state_abbr" class="col-sm-2 control-label">CMS Option Display : </label>
						  <div class="col-sm-10">
							  <div class="radio inline">
								<label><input type="radio" name="page_displayed_at" id="status_header" value="1" checked>Header Menu</label>
							  </div>
							  <div class="radio inline">
								<label><input type="radio" name="page_displayed_at" id="status_footer" value="2" @if($cmsdata->page_displayed_at == '2') checked @endif>Footer Menu</label>
							  </div>
						  </div>
						</div>
						<div class="form-group">
						  <label for="hideon_site" class="col-sm-2 control-label">Hide Page On Site : </label>
						  	<div class="col-sm-10">
							    <div class="checkbox marginnone">
								  <label>
									<input type="checkbox" name="hideon_site" id="hideon_site" ng-model="hideon_site" ng-init="hideon_site=@if($cmsdata->hideon_site == 'Yes'){{ 'true' }} @else {{ 'false' }}@endif"> Yes, i don't want to show this page on site
								  </label>
								</div>
						  	</div>	
						</div>
						<div class="form-group" data-ng-hide="hideon_site">
						  <label for="cms_parent_page" class="col-sm-2 control-label">Parent CMS Page : </label>
						  <div class="col-sm-10">
						  	<select class="form-control selectbox select2" name="cms_parent_page" id="cms_parent_page">
				  	  			<option value="0">Select Parent CMS Page</option>	
					  	  		@foreach($parentcmsdata as $key=>$pagename)
									<option value="{{ $key }}" {{ ($cmsdata->cms_parent_page == $key ? "selected":"") }}>{{ $pagename }}</option>
								@endforeach
							</select>
						  </div>
						</div>
					</div>
				</div>
            </div>
            <div class="box-footer">
			  <button class="btn btn-primary mrgn-right10" type="submit">Submit</button>
			  <a class="btn btn-primary" href="{{ url('admin/cms') }}">Cancel</a>
			</div>
         </form>
          
    </div>
    <!-- /.row -->
</section>
<!-- /.content -->
@endsection