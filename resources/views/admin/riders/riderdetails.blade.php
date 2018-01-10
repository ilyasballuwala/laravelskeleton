<!-- Rider Listing Page -->
@extends('layouts.admin_template')
@section('content')
<div data-ng-controller="RiderController">
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
              <h3 class="box-title pad-top8">Rider Details</h3>
              <a class="btn btn-info pull-right" href="{{ url('admin/riders') }}">Back to Rider Listing</a>
            </div>
            
            <div class="box-body generaldetails-container">
            	<h2 class="details-id">RIDER ID : RI{{ $riderdata->id }}</h2>
                <div class="details-container">
                	<div class="form-group">
                        <div class="col-xs-6 col-sm-3 col-md-3 detail-label">Rider Image :</div>
                        <div class="col-xs-6 col-sm-9 col-md-9 detail-value">
                        	@if($riderdata->rider_avatar != NULL && $riderdata->rider_avatar != '') 
                        		<img src="{{ asset('images/riders/'.$riderdata->id.'/'.$riderdata->rider_avatar) }}" class="img-circle avatar_image" alt="avatar_image" height="100" width="100"/>
                            @else
                            	<img src="{{ asset('images/user_avatar.jpg') }}" class="img-circle avatar_image" alt="avatar_image" height="100" width="100"/>
                            @endif
                        </div>
                    </div>
                    <div class="form-group">	
                        <div class="col-xs-6 col-sm-3 col-md-3 detail-label">Rider Name :</div>
                        <div class="col-xs-6 col-sm-9 col-md-9 detail-value">{{ ucfirst($riderdata->name) }}</div>
                    </div>
                    <div class="form-group">	
                        <div class="col-xs-6 col-sm-3 col-md-3 detail-label">Rider Email :</div>
                        <div class="col-xs-6 col-sm-9 col-md-9 detail-value">{{ $riderdata->email }}</div>
                    </div>
                    <div class="form-group">	
                        <div class="col-xs-6 col-sm-3 col-md-3 detail-label">Rider Phone :</div>
                        <div class="col-xs-6 col-sm-9 col-md-9 detail-value">{{ $riderdata->phone }}</div>
                    </div>
                    <div class="form-group">	
                        <div class="col-xs-6 col-sm-3 col-md-3 detail-label">Business Customer :</div>
                        <div class="col-xs-6 col-sm-9 col-md-9 detail-value">
                        	@if($riderdata->business_customer == 1) 
                        		Yes
                            @else
                            	No
                            @endif
                        </div>
                    </div>
                    @if($riderdata->business_customer == 1)
                    	<div class="form-group">	
                            <div class="col-xs-6 col-sm-3 col-md-3 detail-label">Business Address :</div>
                            <div class="col-xs-6 col-sm-9 col-md-9 detail-value">{{ $riderdata->business_address }}</div>
                        </div>
                        <div class="form-group">	
                            <div class="col-xs-6 col-sm-3 col-md-3 detail-label">Business Phone :</div>
                            <div class="col-xs-6 col-sm-9 col-md-9 detail-value">{{ $riderdata->business_phone }}</div>
                        </div>
                    @endif
                    <div class="form-group">	
                        <div class="col-xs-6 col-sm-3 col-md-3 detail-label">Rider Status :</div>
                        <div class="col-xs-6 col-sm-9 col-md-9 detail-value">
                        	@if($riderdata->rider_status == 1) 
                        		Active
                            @else
                            	Inactive    
                            @endif
                        </div>
                    </div>
                    
                    @if($riderdata->rider_status==2 && $riderdata->comment != NULL && $riderdata->comment != '')
                        <div class="form-group">	
                            <div class="col-xs-6 col-sm-3 col-md-3 detail-label">Comments :</div>
                            <div class="col-xs-6 col-sm-9 col-md-9 detail-value">
                                    {{ $riderdata->comment }}  
                            </div>
                        </div>
                    @endif
                    
                    <div class="form-btn-group text-center">
                    	<button data-ng-click="openRiderEmailBox({{ $riderdata->id }})" data-toggle="modal" data-target="#modal-rideremail" class="btn btn-warning" style="margin-right:15px;">
                            <i class="fa fa-envelope"></i>
                            <span class="title">Send Email</span>
                        </button>
                        <button data-ng-click="setRiderID({{ $riderdata->id }})" data-toggle="modal" data-target="#modal-riderchangestatus" class="btn btn-success">
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
        <div class="modal fade" modal="showRiderEmailModal" id="modal-rideremail">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><b>Send Mail to Rider</b></h4>
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
        <div class="modal fade" modal="showRiderChangeStatusModal" id="modal-riderchangestatus">
          <div class="modal-dialog">
            <div class="modal-content">
            <form role="form" ng-submit="changeRiderstatus($event)" action="{{ url('admin/riders/changeriderstatus') }}" method="post">
              {{ csrf_field() }}
              <input type="hidden" name="status_rider_id" id="status_rider_id" />
              <input type="hidden" name="current_riderpage" id="current_riderpage" value="riderdetails" />	
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><b>Change Rider Status</b></h4>
              </div>
              <div class="modal-body">
                  <div class="form-group">
                    <label for="sendemail_subject"><span class="error">*</span>Select Status :</label>
                    <select class="form-control" name="rider_changedstatus" id="rider_changedstatus" onchange="showReason(this)">
                    	<option value="">Please select status</option>
                        <option value="1">Active</option>
                        <option value="2">Inactive</option>
                    </select>
                  </div>
                  <div class="form-group" id="statusreason_block">
                  	<div class="warninginfo">If you want to inactivate this rider then, please give specific reason</div>
                    <label for="rider_inactivrereson">Enter Reason :</label>
                    <textarea class="form-control" name="rider_inactivrereson" id="rider_inactivrereson" placeholder="Enter inactive reason" rows="5"></textarea>	
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