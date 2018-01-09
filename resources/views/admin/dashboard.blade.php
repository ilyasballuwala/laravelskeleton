<!-- Added Amit on 28-02-2017 -->
<!-- Admin Dashboard Page -->
@extends('layouts.admin_template')
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
	<h1>Dashboard<small>Control panel</small></h1>
</section>
<!-- Main content -->
<section class="content">
	<div class='row'>
    	<div class="col-lg-3 col-xs-6">
        	<!-- small box -->
          	<div class="small-box bg-aqua">
            	<div class="inner">
              		<h3>{{ $total_states }}</h3>
					<p>Total States</p>
            	</div>
            	<div class="icon">
              		<i class="ion ion-ios-location"></i>
            	</div>
            	<a href="{{ url('/admin/state') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          	</div>
        </div>
        <div class="col-lg-3 col-xs-6">
        	<!-- small box -->
          	<div class="small-box bg-red">
            	<div class="inner">
              		<h3>{{ $total_city }}</h3>
					<p>Total City</p>
            	</div>
            	<div class="icon">
              		<i class="fa fa-location-arrow"></i>
            	</div>
            	<a href="{{ url('/admin/city') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          	</div>
        </div>
        <div class="col-lg-3 col-xs-6">
        	<!-- small box -->
          	<div class="small-box bg-yellow">
            	<div class="inner">
              		<h3>{{ $total_properties }}</h3>
					<p>Total Properties</p>
            	</div>
            	<div class="icon">
              		<i class="ion ion-home"></i>
            	</div>
            	<a href="{{ url('/admin/property') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          	</div>
        </div>
    </div><!-- /.row -->
</section>
<!-- /.content -->
@endsection