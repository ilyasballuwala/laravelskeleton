<!-- State Listing Page -->
@extends('layouts.admin_template')
@section('content')
<div>
    <section class="content-header">
       <div class="row">
       		<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
       			<h1 class="mainsection-title">{{ $title }}</h1>
       		</div>
       		<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
       			<a href="{{ url('/admin/cms/create') }}" class="btn btn-primary headeradd-btn pull-right">Add CMS Page</a>
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
              <h3 class="box-title">City Listing</h3>
            </div>
            
            <div class="box-body">
              <table id="cmslisting" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Page Title</th>
                  <th>Page URL</th>
                  <th>Meta Title</th>
                  <th width="15%">Meta Keywords</th>
                  <th width="25%">Meta Desc</th>
                  <th>Parent Page</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>    
					@if(count($cmsdata) > 0)
					@foreach($cmsdata as $cms)
						<tr>
							<td>{{ ucfirst($cms->cms_page_title) }}</td>
							<td>{{ $cms->cms_page_url }}</td>
							<td>{{ ucfirst($cms->cms_page_metatitle) }}</td>
							<td>{{ $cms->cms_page_metakeywords }}</td>
							<td>{{ $cms->cms_page_metadesc }}</td>							
							<td>
								@if(!empty($cms->Parentpagedata) && count(!empty($cms->Parentpagedata)) > 0)
									{{ $cms->Parentpagedata->cms_page_title }}
								@else
									None
								@endif	 
							</td>
							<td>{{ ($cms->cms_page_status == 0) ? "Inactive" : "Active" }}</td>
							<td>
								<a href="{{ url('/admin/cms/'.$cms->cms_page_id.'/edit') }}" class="btn btn-primary">
									<i class="fa fa-edit"></i>
									<span class="title">Edit</span>
								</a>
								<a href="javascript:void(0)" class="btn btn-danger" onclick="return generaldelete_confirm({{ $cms->cms_page_id }}, 'cms', 'cms_pages', 'cms_page_id');">
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