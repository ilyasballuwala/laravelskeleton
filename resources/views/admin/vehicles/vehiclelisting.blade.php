<!-- Rider Listing Page -->
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
              <h3 class="box-title">Vehicle Listing</h3>
            </div>
            
            <div class="box-body">
              <table id="driverslisting" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Vehicle ID</th>
                  <th>Vehicle Image</th>
                  <th>Vehicle Name</th>
                  <th>Vehicle Number Plate</th>
                  <th>Vehicle Company</th>
                  <th>Vehicle Colour</th>
                  <th>Vehicle Driver</th>
                  <th>Vehicle Status</th>
                  <th width="25%">Action</th>
                </tr>
                </thead>
                <tbody>    
					@if(count($vehiclesdata) > 0)
					@foreach($vehiclesdata as $vehicle)
						<tr>
                        	<td>VEH{{ $vehicle->driver_car_id }}</td>
                            <td align="center" valign="middle">@if($vehicle->vehicle_image != NULL && $vehicle->vehicle_image != '') 
                        		<img src="{{ asset('images/vehicles/'.$vehicle->driver_car_id.'/'.$vehicle->vehicle_image) }}" class="img-circle avatar_image" alt="avatar_image" height="60" width="60"/>
                            @else
                            	<img src="{{ asset('images/vehicles/default-car.png') }}" class="img-circle avatar_image" alt="avatar_image" height="60" width="60"/>
                            @endif</td>
							<td>{{ ucfirst($vehicle->car_name) }}</td>
							<td>{{ $vehicle->car_number_plate }}</td>
							<td>{{ $vehicle->car_company }}</td>
                            <td>{{ $vehicle->car_colour }}</td>
                            <td>{{ ucfirst($vehicle->Driverdata->name) }}</td>
                            <td>@if($vehicle->car_status == 1)
                            		Active
                                @else
                                	Inactive
                                @endif                            
                            </td>
							<td>
								<a href="{{ url('/admin/vehicles/details/'.$vehicle->driver_car_id) }}" class="btn btn-info">
									<i class="fa fa-edit"></i>
									<span class="title">View Details</span>
								</a>
								<button data-ng-click="setVehicleID({{ $vehicle->driver_car_id }})" data-toggle="modal" data-target="#modal-vehiclechangestatus" class="btn btn-success">
									<i class="fa fa-user"></i>
									<span class="title">Change Vehicle Status</span>
								</button>
							</td>
						</tr>
					@endforeach
					@endif
				</tbody>
              </table>
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
              <input type="hidden" name="current_vehiclepage" id="current_vehiclepage" value="vehiclelisting" />	
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