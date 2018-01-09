<!-- State Listing Page -->
@extends('layouts.admin_template')
@section('content')
<div>
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
              <div class="flash-message mrgn-top15">
                @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                  @if(Session::has('alert-' . $msg))
                  <div class="alert alert-{{ $msg }} alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><h4>{{ ucfirst(($msg == 'danger') ? "Error" : $msg) }}!</h4> {{ Session::get('alert-' . $msg) }}</div>
                  @endif
                @endforeach
              </div> 
            <!-- end .flash-message -->
            
         	 <div class="box">
            <div class="box-header">
              <h3 class="box-title">Website Inquiry Contact Listing</h3>
            </div>
            
            <div class="box-body">
              <table id="contactlisting" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Phone</th>
                  <th width="15%">Message</th>
                  <th width="25%">Best Time To Call</th>
                  <!--<th>Action</th>-->
                </tr>
                </thead>
                <tbody>    
					@if(count($contactdata) > 0)
					@foreach($contactdata as $contact)
						<tr>
							<td>{{ ucfirst($contact->contact_name) }}</td>
							<td>{{ $contact->contact_email }}</td>
							<td>@if($contact->contact_phone != "" && $contact->contact_phone != NULL) {{ $contact->contact_phone }} @else N/A @endif</td>
							<td>@if($contact->contact_message != "" && $contact->contact_message != NULL) {{ $contact->contact_message }} @else N/A @endif</td>
							<td>@if($contact->contact_timetocall != "" && $contact->contact_timetocall != NULL) {{ $contact->contact_timetocall }} @else N/A @endif</td>							
							<!--<td>
								<a href="{{ url('/admin/cms/'.$contact->contact_id.'/edit') }}" class="btn btn-primary">
									<i class="fa fa-edit"></i>
									<span class="title">Edit</span>
								</a>
								<a href="javascript:void(0)" class="btn btn-danger" onclick="return generaldelete_confirm({{ $contact->contact_id }}, 'websitecontact', 'contact', 'contact_id');">
									<i class="fa fa-trash"></i>
									<span class="title">Delete</span>
								</a>
							</td>-->
						</tr>
					@endforeach
					@endif
				</tbody>
              </table>
            </div>
            
          </div>
         </div>
        </div><!-- /.row -->
    </section>
</div>
<!-- /.content -->
@endsection