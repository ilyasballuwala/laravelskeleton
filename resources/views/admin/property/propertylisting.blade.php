<!-- Property Listing Page -->
@extends('layouts.admin_template')

@section('content')
<div>
    <section class="content-header">
       <div class="row">
       		<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
       			<h1 class="mainsection-title">{{ $title }}</h1>
       		</div>
       		<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
       			<a href="{{ url('/admin/property/create') }}" class="btn btn-primary headeradd-btn pull-right">Add New Property</a>
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
              <h3 class="box-title">Property Listing</h3>
            </div>
            
            <div class="box-body">
              <table id="propertylisting" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Property Name</th>
                  <th>Property Image</th>
                  <th>Property Location</th>
                  <th>Property State</th>
                  <th>Property City</th>
                  <th>Property Email</th>
                  <th>Property SEO URL</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>    
					@if(count($propertydata) > 0)
					@foreach($propertydata as $property)
						<tr>
							<td>{{ ucfirst($property->property_name) }}</td>
							<td>
								@if($property->property_mainimage != '' && $property->property_mainimage != NULL)
									<img src="{{ asset('images/property/'.$property->property_id.'/'.$property->property_mainimage) }}" height="80px" width="80px" class="img-responsive propertyimage" />
								@else
									<img src="{{ asset('images/property/noproperty.jpg') }}" height="80px" width="80px" class="img-responsive propertyimage" />
								@endif</td>
							<td>{{ $property->property_location }}</td>
							<td>{{ $property->Propertystate->state_name }}</td>
							<td>{{ $property->Propertycity->city_name }}</td>	
							<td>{{ $property->property_email }}</td>						
							<td>{{ $property->property_seourl }}</td>
							<td>{{ ($property->property_status == 0) ? "Inactive" : "Active" }}</td>
							<td>
								<a href="{{ url('/admin/property/'.$property->property_id.'/edit') }}" class="btn btn-primary">
									<i class="fa fa-edit"></i>
									<span class="title">Edit</span>
								</a>
								<a href="javascript:void(0)" class="btn btn-danger" onclick="return generaldelete_confirm({{ $property->property_id }}, 'property', 'property', 'property_id');">
									<i class="fa fa-trash"></i>
									<span class="title">Delete</span>
								</a>
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
    </section>
</div>
<!-- /.content -->

@endsection