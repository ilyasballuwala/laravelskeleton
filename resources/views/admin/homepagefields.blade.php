<!-- Add CMS for Admin -->
@extends('layouts.admin_template')
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
	<div class="row">
       		<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
       			<h1 class="mainsection-title">{{ $title }}</h1>
       		</div>
       </div>
</section>
<!-- Main content -->
<section class="content">
	<!-- Small boxes (Stat box) -->
    <div class="box box-primary">
    	<div class="box-header with-border">
        	<h3 class="box-title">Home Page Fields</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form class="" role="form" method="POST" action="{{ url('/admin/dashboard/homepagefields') }}" enctype="multipart/form-data">
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
						<div class="form-group {{ $errors->has('banner_title') ? ' has-error' : '' }}">
						  <label for="banner_title" class="col-sm-2 control-label">Banner Title<span class="required-mark">*</span> : </label>
						  <div class="col-sm-10">
							<input type="text" class="form-control" id="banner_title" name="banner_title" placeholder="Enter Banner Title" value="{{ ($homepagefields != NULL && isset($homepagefields->banner_title))? $homepagefields->banner_title : '' }}">
							@if ($errors->has('banner_title'))
								<span class="help-block">{{ $errors->first('banner_title') }}</span>
							@endif
						  </div>
						</div>
						<div class="form-group {{ $errors->has('main_title') ? ' has-error' : '' }}">
						  <label for="main_title" class="col-sm-2 control-label">Main Content Title<span class="required-mark">*</span> : </label>
						  <div class="col-sm-10">
							<input type="text" class="form-control" id="main_title" name="main_title" placeholder="Enter Main Content Title" value="{{ ($homepagefields != NULL && isset($homepagefields->main_title))? $homepagefields->main_title : '' }}">
							@if ($errors->has('main_title'))
								<span class="help-block">{{ $errors->first('main_title') }}</span>
							@endif
						  </div>
						</div>
						<div class="form-group {{ $errors->has('main_content') ? ' has-error' : '' }}">
						  <label for="main_content" class="col-sm-2 control-label">Main Content<span class="required-mark">*</span> : </label>
						  <div class="col-sm-10">
						  	<textarea id="main_content" name="main_content" rows="20" cols="80" class="ckeditor">{{ ($homepagefields != NULL && isset($homepagefields->main_content))? $homepagefields->main_content : '' }}</textarea>
							@if ($errors->has('main_content'))
								<span class="help-block">{{ $errors->first('main_content') }}</span>
							@endif
						  </div>
						</div>
						<div class="form-group {{ $errors->has('sidebar_image') ? ' has-error' : '' }}">
						  <label for="sidebar_image" class="col-sm-2 control-label">Sidebar Image : </label>
						  <div class="col-sm-10">
							<input type="file" class="input-control" id="sidebar_image" name="sidebar_image" accept="image/*">
							
							@if($homepagefields != NULL && $homepagefields->sidebar_image != '' && $homepagefields->sidebar_image != NULL)
								<img src="{{ asset('images/homapageimages/'.$homepagefields->sidebar_image) }}" height="150px" width="150px" class="img-responsive property-mainimage">
							@endif
								
							@if ($errors->has('sidebar_image'))
								<span class="help-block">{{ $errors->first('sidebar_image') }}</span>
							@endif
						  </div>
						</div>
						<div class="form-group {{ $errors->has('banner_image') ? ' has-error' : '' }}">
						  <label for="banner_image" class="col-sm-2 control-label">Banner Images : </label>
						  <div class="col-sm-10">
							<input type="file" class="input-control" id="banner_image" name="banner_image[]" accept="image/*" multiple> <span class="imagenote">(Note* : To Upload multiple images, hit ctrl+click to select images and only images with 760x290 OR above resolution will acceptable.)</span>
							@if ($errors->has('banner_image'))
								<span class="help-block">{{ $errors->first('banner_image') }}</span>
							@endif
							
							@if(count($homepageimages) > 0 && !empty($homepageimages))
							<div class="row homeimages-container">
							  @foreach($homepageimages as $bannerimages)
								<div class="col-xs-6 col-sm-3 col-md-4 col-lg-4">
									<img src="{{ asset('images/homapageimages/'.$bannerimages->image_name) }}" class="img-responsive banner-otherimage">
									<a class="removepropertyimage" onclick="return generaldelete_confirm({{ $bannerimages->image_id }}, 'dashboard', 'banner_slider_images', 'image_id');"><i class="fa fa-times"></i></a>
								</div>
							  @endforeach 	
							</div>
							@else
								<div class="nobannerimages">No Banner Images Found.</div>
							@endif
						  </div>
						</div>
						
						<div class="form-group {{ $errors->has('meta_title') ? ' has-error' : '' }}">
						  <label for="meta_title" class="col-sm-2 control-label">Meta Title<span class="required-mark">*</span> : </label>
						  <div class="col-sm-10">
							<input type="text" class="form-control" id="meta_title" name="meta_title" placeholder="Enter Meta Title" value="{{ ($homepagefields != NULL && isset($homepagefields->meta_title))? $homepagefields->meta_title : '' }}">
							@if ($errors->has('meta_title'))
								<span class="help-block">{{ $errors->first('meta_title') }}</span>
							@endif
						  </div>
						</div>
						<div class="form-group {{ $errors->has('meta_keywords') ? ' has-error' : '' }}">
						  <label for="meta_keywords" class="col-sm-2 control-label">Meta Keywords<span class="required-mark">*</span> : </label>
						  <div class="col-sm-10">
							<input data-role="tagsinput" type="text" class="form-control tagsinput" id="meta_keywords" name="meta_keywords" placeholder="Enter Meta Keywords" value="{{ ($homepagefields != NULL && isset($homepagefields->meta_keywords))? $homepagefields->meta_keywords : '' }}">
							@if ($errors->has('meta_keywords'))
								<span class="help-block">{{ $errors->first('meta_keywords') }}</span>
							@endif
						  </div>
						</div>
						<div class="form-group {{ $errors->has('meta_desc') ? ' has-error' : '' }}">
						  <label for="meta_desc" class="col-sm-2 control-label">CMS Meta Description<span class="required-mark">*</span> : </label>
						  <div class="col-sm-10">
						  	<textarea name="meta_desc" id="meta_desc" rows="5" cols="80" placeholder="Enter Meta Description" class="form-control resizeverticleonly">{{ ($homepagefields != NULL && isset($homepagefields->meta_desc))? $homepagefields->meta_desc : '' }}</textarea>
							@if ($errors->has('meta_desc'))
								<span class="help-block">{{ $errors->first('meta_desc') }}</span>
							@endif
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