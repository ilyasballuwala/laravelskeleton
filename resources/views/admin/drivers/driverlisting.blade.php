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
              <h3 class="box-title">Driver Listing</h3>
            </div>
            
            <div class="box-body">
              <table id="driverslisting" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Driver ID</th>
                  <th>Driver Image</th>
                  <th>Driver Name</th>
                  <th>Driver Email</th>
                  <th>Driver Phone</th>
                  <th>Driver Registration Date</th>
                  <th>Status</th>
                  <th>Online Status</th>
                  <th width="25%">Action</th>
                </tr>
                </thead>
                <tbody>    
					@if(count($driverdata) > 0)
					@foreach($driverdata as $driver)
						<tr>
                        	<td>DRI{{ $driver->id }}</td>
                            <td align="center">@if($driver->driver_avatar != NULL && $driver->driver_avatar != '') 
                        		<img src="{{ asset('images/drivers/'.$driver->id.'/'.$driver->driver_avatar) }}" class="img-circle avatar_image" alt="avatar_image" height="50" width="50"/>
                            @else
                            	<img src="{{ asset('images/user_avatar.jpg') }}" class="img-circle avatar_image" alt="avatar_image" height="50" width="50"/>
                            @endif</td>
							<td>{{ ucfirst($driver->name) }}</td>
							<td>{{ $driver->email }}</td>
							<td>{{ $driver->phone }}</td>
                            <td>{{ date('jS F, Y', strtotime($driver->created_at)) }}</td>
                            <td>@if($driver->driver_status == 1)
                            		Active	
                                @else
                                	Inactive
                                @endif                            
                            </td>
                            <td>@if(!empty($driver->Driverstatuslocation) && count($driver->Driverstatuslocation) > 0 && $driver->Driverstatuslocation->available_status == 1)
                            		Online
                                @else
                                	Offline
                                @endif                            
                            </td>
							<td>
								<a href="{{ url('/admin/drivers/details/'.$driver->id) }}" class="btn btn-info">
									<i class="fa fa-edit"></i>
									<span class="title">View Details</span>
								</a>
                                <button data-ng-click="openDriverEmailBox({{ $driver->id }})" data-toggle="modal" data-target="#modal-driveremail" class="btn btn-warning">
									<i class="fa fa-envelope"></i>
									<span class="title">Send Email</span>
								</button>
								<button data-ng-click="setDriverID({{ $driver->id }})" data-toggle="modal" data-target="#modal-driverchangestatus" class="btn btn-success">
									<i class="fa fa-user"></i>
									<span class="title">Change User Status</span>
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
        
        <!-- Send mail block -->
        <div class="modal fade" modal="showDriverEmailModal" id="modal-driveremail">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><b>Send Mail to Driver</b></h4>
              </div>
              <div class="modal-body">
                <form role="form">
                  <div class="form-group">
                    <label for="sendemail_subject"><span class="error">*</span>Email Subject :</label>
                    <input class="form-control" name="sendemail_subject" id="sendemail_subject" placeholder="Enter email subject" data-ng-model="sendemail_subject" type="text" />
                  </div>
                  <div class="form-group">
                    <label for="sendemail_content"><span class="error">*</span>Email Content :</label>
                    <textarea class="form-control" name="sendemail_content" id="sendemail_content" placeholder="Enter email content" data-ng-model="sendemail_content" rows="5"></textarea>	
                  </div>
                </form>
                <div class="email_error_block" id="email_error_block"></div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-success" data-ng-click="sendEmail()" id="email_send" data-ng-disabled="!sendemail_subject || !sendemail_content">Send Mail</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal" id="email_cancel">Close</button>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
        
        <!-- Send mail block -->
        <div class="modal fade" modal="showDriverChangeStatusModal" id="modal-driverchangestatus">
          <div class="modal-dialog">
            <div class="modal-content">
            <form role="form" ng-submit="changeDriverstatus($event)" action="{{ url('admin/drivers/changedriverstatus') }}" method="post">
              {{ csrf_field() }}
              <input type="hidden" name="status_driver_id" id="status_driver_id" />
              <input type="hidden" name="current_driverpage" id="current_driverpage" value="driverlisting" />	
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><b>Change Driver Status</b></h4>
              </div>
              <div class="modal-body">
                  <div class="form-group">
                    <label for="sendemail_subject"><span class="error">*</span>Select Status :</label>
                    <select class="form-control" name="driver_changedstatus" id="driver_changedstatus" onchange="showReason(this)">
                    	<option value="">Please select status</option>
                        <option value="1">Active</option>
                        <option value="2">Inactive</option>
                        <option value="3">Archived</option>
                    </select>
                  </div>
                  <div class="form-group" id="statusreason_block">
                  	<div class="warninginfo">If you want to inactivate this driver then, please give specific reason</div>
                    <label for="rider_inactivrereson">Enter Reason :</label>
                    <textarea class="form-control" name="driver_inactivereason" id="driver_inactivereason" placeholder="Enter inactive reason" rows="5"></textarea>	
                  </div>
                <div class="status_error_block" id="status_error_block"></div>
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