<!-- Driver Listing Page -->
@extends('layouts.admin_template')
@section('content')
<div data-ng-controller="DriverController">
    <section class="content-header">
       <div class="row">
       		<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
       			<h1 class="mainsection-title">{{ $title }}</h1>
       		</div>
       </div>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
         <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        	 <!-- Start .flash-message -->
              <div class="flash-message mrgn-top15" id="flash-message">
                @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                  @if(Session::has('alert-' . $msg))
                  <div class="alert alert-{{ $msg }} alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><h4>{{ ucfirst(($msg == 'danger') ? "Error" : $msg) }}!</h4> {{ Session::get('alert-' . $msg) }}</div>
                  @endif
                @endforeach
              </div> 
            <!-- end .flash-message -->
            
         	<div class="box">
            <div class="box-header">
              <h3 class="box-title pad-top8">Vehicle Details</h3>
              <a class="btn btn-info pull-right" href="{{ url('admin/vehicles') }}">Back to Vehicle Listing</a>
            </div>
            
            <div class="box-body generaldetails-container">
            	<h2 class="details-id">VEHICLE ID : VEH{{ $vehicledata->driver_car_id }}</h2>
                <div class="details-container">
                	<div class="form-group">
                        <div class="col-xs-6 col-sm-3 col-md-3 detail-label">Vehicle Image :</div>
                        <div class="col-xs-6 col-sm-9 col-md-9 detail-value">
                        	@if($vehicledata->vehicle_image != NULL && $vehicledata->vehicle_image != '') 
                        		<a href="{{ asset('images/vehicles/'.$vehicledata->driver_car_id.'/'.$vehicledata->vehicle_image) }}" data-lightbox="image-1" data-title="Vehical Image"><img src="{{ asset('images/vehicles/'.$vehicledata->driver_car_id.'/'.$vehicledata->vehicle_image) }}" class="img-responsive" alt="avatar_image"/></a>
                            @else
                            	<a href="{{ asset('images/vehicles/default-car.png') }}" data-lightbox="image-1" data-title="Vehical Image"><img src="{{ asset('images/vehicles/default-car.png') }}" class="img-responsive" alt="car_image" style="max-width:50%;"/></a>
                            @endif
                        </div>
                    </div>
                    <div class="form-group">	
                        <div class="col-xs-6 col-sm-3 col-md-3 detail-label">Vehicle Name :</div>
                        <div class="col-xs-6 col-sm-9 col-md-9 detail-value">{{ ucfirst($vehicledata->car_name) }}</div> 
                    </div>
                    <div class="form-group">	
                        <div class="col-xs-6 col-sm-3 col-md-3 detail-label">Vehicle Type :</div>
                        <div class="col-xs-6 col-sm-9 col-md-9 detail-value">{{ $vehicledata->car_type }}</div>
                    </div>
                    <div class="form-group">	
                        <div class="col-xs-6 col-sm-3 col-md-3 detail-label">Vehicle Company :</div>
                        <div class="col-xs-6 col-sm-9 col-md-9 detail-value">{{ $vehicledata->car_company }}</div>
                    </div>
                    <div class="form-group">	
                        <div class="col-xs-6 col-sm-3 col-md-3 detail-label">Vehicle Color :</div>
                        <div class="col-xs-6 col-sm-9 col-md-9 detail-value">{{ $vehicledata->car_colour }}</div>
                    </div>
                     <div class="form-group">	
                        <div class="col-xs-6 col-sm-3 col-md-3 detail-label">Vehicle Number Plate :</div>
                        <div class="col-xs-6 col-sm-9 col-md-9 detail-value">{{ $vehicledata->car_number_plate }}</div>
                    </div>
                    <div class="form-group">	
                        <div class="col-xs-6 col-sm-3 col-md-3 detail-label">Vehicle Passanger Capacity :</div>
                        <div class="col-xs-6 col-sm-9 col-md-9 detail-value">{{ $vehicledata->passanger_capacity }}</div>
                    </div>
                    <div class="form-group">	
                        <div class="col-xs-6 col-sm-3 col-md-3 detail-label">Vehicle Wheelchair Passanger Capacity :</div>
                        <div class="col-xs-6 col-sm-9 col-md-9 detail-value">{{ $vehicledata->wheelchair_passanger_capacity }}</div>
                    </div>
                    <div class="form-group">	
                        <div class="col-xs-6 col-sm-3 col-md-3 detail-label">Vehicle Child Seat Capacity :</div>
                        <div class="col-xs-6 col-sm-9 col-md-9 detail-value">{{ $vehicledata->child_seat_capacity }}</div>
                    </div>
                    <div class="form-group">	
                        <div class="col-xs-6 col-sm-3 col-md-3 detail-label">Vehicle Child Booster Capacity :</div>
                        <div class="col-xs-6 col-sm-9 col-md-9 detail-value">{{ $vehicledata->child_booster_capacity }}</div>
                    </div>
                    <div class="form-group">	
                        <div class="col-xs-6 col-sm-3 col-md-3 detail-label">Vehicle Large Luggage Capacity :</div>
                        <div class="col-xs-6 col-sm-9 col-md-9 detail-value">{{ $vehicledata->large_luggage_capacity }}</div>
                    </div>
                    <div class="form-group">	
                        <div class="col-xs-6 col-sm-3 col-md-3 detail-label">Vehicle Small Luggage Capacity :</div>
                        <div class="col-xs-6 col-sm-9 col-md-9 detail-value">{{ $vehicledata->small_luggage_capacity }}</div>
                    </div>
                    <div class="form-group">	
                        <div class="col-xs-6 col-sm-3 col-md-3 detail-label">Vehicle Status :</div>
                        <div class="col-xs-6 col-sm-9 col-md-9 detail-value">
                        	@if($vehicledata->car_status == 1) 
                        		Active
                            @else
                            	Inactive    
                            @endif
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <div class="col-xs-6 col-sm-3 col-md-3 detail-label">Vehicle Other Images :</div>
                        <div class="col-xs-6 col-sm-9 col-md-9 detail-value">
                        	@if(count($vehicledata->Carimages) > 0 && !empty($vehicledata->Carimages))
                              <div class="row">
                                @foreach($vehicledata->Carimages as $carimage)
                                  <div class="col-xs-6 col-sm-3 col-md-2 col-lg-2">	
                                	<a href="{{ asset('images/vehicles/'.$vehicledata->driver_car_id.'/'.$carimage->car_image_name) }}" data-lightbox="roadtrip"><img src="{{ asset('images/vehicles/'.$vehicledata->driver_car_id.'/'.$carimage->car_image_name) }}" class="car_image img-responsive" alt="{{ $carimage->car_image_name }}"/></a>
                                  </div>  
                                @endforeach 
                        	  </div>
                            @else
                            	N/A    
                            @endif
                        </div>
                    </div>
                    
                    <div class="form-btn-group text-center mrgn-top40">
                        <button data-ng-click="setVehicleID({{ $vehicledata->driver_car_id }})" data-toggle="modal" data-target="#modal-vehiclechangestatus" class="btn btn-info">
                            <i class="fa fa-user"></i>
                            <span class="title">Change Vehicle Status</span>
                        </button>
                    </div>
                </div>
            </div>
          </div>
         </div>
        </div><!-- /.row -->
        
         <!-- Change Status block -->
        <div class="modal fade" modal="showVehicleChangeStatusModal" id="modal-vehiclechangestatus">
          <div class="modal-dialog">
            <div class="modal-content">
            <form role="form" action="{{ url('admin/vehicles/changevehiclestatus') }}" method="post">
              {{ csrf_field() }}
              <input type="hidden" name="status_vehicle_id" id="status_vehicle_id" />
              <input type="hidden" name="current_vehiclepage" id="current_vehiclepage" value="vehicledetails" />	
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><b>Change Vehicle Status</b></h4>
              </div>
              <div class="modal-body">
                <div class="vehiclechange_text">Are you sure you want to change the status of this Vehicle?</div>
              </div>
              <div class="modal-footer">	
                <button type="submit" class="btn btn-success" id="status_send">Submit</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal" id="status_cancel">Close</button> 
              </div>
            </form>  
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
        
    </section>
</div>
<!-- /.content -->
@endsection