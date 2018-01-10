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
              <h3 class="box-title pad-top8">Driver Details</h3>
              <a class="btn btn-info pull-right" href="{{ url('admin/drivers') }}">Back to Driver Listing</a>
            </div>
            
            <div class="box-body generaldetails-container">
            	<h2 class="details-id">DRIVER ID : DRI{{ $driverdata->id }}</h2>
                <div class="details-container">
                	<div class="form-group">
                        <div class="col-xs-6 col-sm-3 col-md-3 detail-label">Driver Image :</div>
                        <div class="col-xs-6 col-sm-9 col-md-9 detail-value">
                        	@if($driverdata->user_avatar != NULL && $driverdata->user_avatar != '') 
                        		<img src="{{ asset('images/users/'.$driverdata->id.'/'.$driverdata->user_avatar) }}" class="img-circle avatar_image" alt="avatar_image" height="100" width="100"/>
                            @else
                            	<img src="{{ asset('images/user_avatar.jpg') }}" class="img-circle avatar_image" alt="avatar_image" height="100" width="100"/>
                            @endif
                        </div>
                    </div>
                    <div class="form-group">	
                        <div class="col-xs-6 col-sm-3 col-md-3 detail-label">Driver Name :</div>
                        <div class="col-xs-6 col-sm-9 col-md-9 detail-value">{{ ucfirst($driverdata->name) }}</div> 
                    </div>
                    <div class="form-group">	
                        <div class="col-xs-6 col-sm-3 col-md-3 detail-label">Driver Email :</div>
                        <div class="col-xs-6 col-sm-9 col-md-9 detail-value">{{ $driverdata->email }}</div>
                    </div>
                    <div class="form-group">	
                        <div class="col-xs-6 col-sm-3 col-md-3 detail-label">Driver Phone :</div>
                        <div class="col-xs-6 col-sm-9 col-md-9 detail-value">{{ $driverdata->phone }}</div>
                    </div>
                    <div class="form-group">	
                        <div class="col-xs-6 col-sm-3 col-md-3 detail-label">Driver Register Date :</div>
                        <div class="col-xs-6 col-sm-9 col-md-9 detail-value">{{ date('jS F, Y', strtotime($driverdata->created_at)) }}</div>
                    </div>
                    <div class="form-group">	
                        <div class="col-xs-6 col-sm-3 col-md-3 detail-label">Driver Address :</div>
                        <div class="col-xs-6 col-sm-9 col-md-9 detail-value">@if($driverdata->Driverdata->driver_address != NULL && $driverdata->Driverdata->driver_address != ''){!! $driverdata->Driverdata->driver_address !!} @else N/A @endif</div>
                    </div>
                    <div class="form-group">	
                        <div class="col-xs-6 col-sm-3 col-md-3 detail-label">Driver Online Status :</div>
                        <div class="col-xs-6 col-sm-9 col-md-9 detail-value">@if($driverdata->Driverdata->driver_online_status == 1) Online @else Offline @endif</div>
                    </div>
                    <div class="form-group">	
                        <div class="col-xs-6 col-sm-3 col-md-3 detail-label">Driver's Taxi Licence No :</div>
                        <div class="col-xs-6 col-sm-9 col-md-9 detail-value">@if($driverdata->Driverdata->driver_licence_no != NULL && $driverdata->Driverdata->driver_licence_no != ''){{ $driverdata->Driverdata->driver_licence_no }} @else N/A @endif</div>
                    </div>
                    <div class="form-group">	
                        <div class="col-xs-6 col-sm-3 col-md-3 detail-label">Driver's Licence Expire Date :</div>
                        <div class="col-xs-6 col-sm-9 col-md-9 detail-value">@if($driverdata->Driverdata->licence_expire_date != NULL && $driverdata->Driverdata->licence_expire_date != ''){{ date('jS F, Y', strtotime($driverdata->Driverdata->licence_expire_date)) }} @else N/A @endif</div>
                    </div>
                    <div class="form-group">	
                        <div class="col-xs-6 col-sm-3 col-md-3 detail-label">Driver's Per Mile Rate :</div>
                        <div class="col-xs-6 col-sm-9 col-md-9 detail-value">@if($driverdata->Driverdata->driver_per_mile_rate != NULL && $driverdata->Driverdata->driver_per_mile_rate != 0)${{ $driverdata->Driverdata->driver_per_mile_rate }}/hour @else N/A @endif</div>
                    </div>
                    <div class="form-group">	
                        <div class="col-xs-6 col-sm-3 col-md-3 detail-label">Driver's Averate Rating :</div>
                        <div class="col-xs-6 col-sm-9 col-md-9 detail-value">@if($driverdata->user_avg_rating != NULL && $driverdata->user_avg_rating != 0){{ $driverdata->user_avg_rating }} out of 5 @else N/A @endif</div>
                    </div>
                    <div class="form-group">	
                        <div class="col-xs-6 col-sm-3 col-md-3 detail-label">Driver Status :</div>
                        <div class="col-xs-6 col-sm-9 col-md-9 detail-value">
                        	@if($driverdata->user_status == 1) 
                        		Active
                            @elseif($driverdata->user_status == 2)
                            	Inactive
                            @else
                            	Archived    
                            @endif
                        </div>
                    </div>
                    @if($driverdata->user_status==2 && $driverdata->inactive_reason != NULL && $driverdata->inactive_reason != '')
                        <div class="form-group">	
                            <div class="col-xs-6 col-sm-3 col-md-3 detail-label">Driver Inactive Reason :</div>
                            <div class="col-xs-6 col-sm-9 col-md-9 detail-value">
                                    {{ $driverdata->inactive_reason }}  
                            </div>
                        </div>
                    @endif
                    
                    <div class="form-btn-group text-center">
                    	<button data-ng-click="openDriverEmailBox({{ $driverdata->id }})" data-toggle="modal" data-target="#modal-driveremail" class="btn btn-warning" style="margin-right:15px;">
                            <i class="fa fa-envelope"></i>
                            <span class="title">Send Email</span>
                        </button>
                        <button data-ng-click="setDriverID({{ $driverdata->id }})" data-toggle="modal" data-target="#modal-driverchangestatus" class="btn btn-success">
                            <i class="fa fa-user"></i>
                            <span class="title">Change User Status</span>
                        </button>
                    </div>
                </div>
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
              <input type="hidden" name="current_driverpage" id="current_driverpage" value="driverdetails" />	
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
                    <label for="driver_inactivereason">Enter Reason :</label>
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