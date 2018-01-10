<!-- Added Amit on 21/07/2017 -->
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
              		<h3>{{ $total_riders }}</h3>
					<p>Total Riders</p>
            	</div>
            	<div class="icon">
              		<i class="fa fa-user"></i>
            	</div>
            	<a href="{{ url('/admin/riders') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          	</div>
        </div>
        <div class="col-lg-3 col-xs-6">
        	<!-- small box -->
          	<div class="small-box bg-red">
            	<div class="inner">
              		<h3>{{ $total_drivers }}</h3>
					<p>Total Drivers</p>
            	</div>
            	<div class="icon">
              		<i class="fa fa-user-plus"></i>
            	</div>
            	<a href="{{ url('/admin/drivers') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          	</div>
        </div>
        <div class="col-lg-3 col-xs-6">
        	<!-- small box -->
          	<div class="small-box bg-yellow">
            	<div class="inner">
              		<h3>{{ $total_jobs }}</h3>
					<p>Total Trips</p>
            	</div>
            	<div class="icon">
              		<i class="ion ion-ios-location"></i>
            	</div>
            	<a href="{{ url('/admin/user_bookings') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          	</div>
        </div>
        <div class="col-lg-3 col-xs-6">
        	<!-- small box -->
          	<div class="small-box bg-green">
            	<div class="inner">
              		<h3>{{ $total_registered_vehicles }}</h3>
					<p>Total Registered Cars</p>
            	</div>
            	<div class="icon">
              		<i class="fa fa-car"></i>
            	</div>
            	<a href="{{ url('/admin/driver_cars') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          	</div>
        </div>
    </div><!-- /.row -->
</section>
<!-- /.content -->
@endsection