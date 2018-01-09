<!-- Edit Property for Admin -->
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
	
		<!-- Start .flash-message -->
		  <div class="flash-message mrgn-top15">
			@foreach (['danger', 'warning', 'success', 'info'] as $msg)
			  @if(Session::has('alert-' . $msg))
			  <div class="alert alert-{{ $msg }} alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><h4>{{ ucfirst(($msg == 'danger') ? "Error" : $msg) }}!</h4> {{ Session::get('alert-' . $msg) }}</div>
			  @endif
			@endforeach
		  </div> 
		<!-- end .flash-message -->
				
	<!-- Small boxes (Stat box) -->
    <div class="box box-primary"> 
    	<div class="box-header with-border">
        	<h3 class="box-title">Edit @{{ property.generalinfo.property_name }} Property</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        
        	<div class="box-body">
				<div class="row">
					<div class="col-xs-12 col-sm-10 col-md-10 col-lg-10">
						 <div class="nav-tabs-custom">
							<ul class="nav nav-tabs">
							  <li class="active"><a href="#generalinfo_tab" data-toggle="tab">General Info</a></li>
							  <li><a href="#priceinfo_tab" data-toggle="tab">Price &amp; Room Info</a></li>
							  <li><a href="#amenitiesinfo_tab" data-toggle="tab">Amenities &amp; Features</a></li>
							  <li><a href="#imagesinfo_tab" data-toggle="tab">Images &amp; Documents</a></li>
							  <li><a href="#seoinfo_tab" data-toggle="tab">SEO Info</a></li>
							</ul>
							<div class="tab-content">
							  <div class="tab-pane active" id="generalinfo_tab">
							  	@include('admin.property.editgeneralinfo', ['some' => 'data'])								
							  </div>
							  
							  <div class="tab-pane" id="priceinfo_tab">
								@include('admin.property.editroomsinfo', ['some' => 'data'])
							  </div>
							  
							  <div class="tab-pane" id="amenitiesinfo_tab">
								@include('admin.property.editamenitiesinfo', ['some' => 'data'])
							  </div>
							  
							  <div class="tab-pane" id="imagesinfo_tab">
							  	@include('admin.property.editimagesinfo', ['some' => 'data'])
							  </div>
							  
							  <div class="tab-pane" id="seoinfo_tab">
								@include('admin.property.editseoinfo', ['some' => 'data'])
							  </div>
							  
							</div>
						  </div>
					</div>
				</div>
            </div>
            <!--<div class="box-footer">
			</div>-->
         
          
    </div>
    <!-- /.row -->
</section>
<!-- /.content -->
@endsection