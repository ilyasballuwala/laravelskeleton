@extends('layouts.app')

@section('content')
<!-- container	-->
<!-- container	-->
<section class="communities-bg">
  <div class="container">
    <section class="communities-part">
      <h1>Efficient Property Management Apartment Communities</h1>
      <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
       @if($statecitydata != NULL && count($statecitydata) > 0)
       		<?php $i = 1; ?>
      		@foreach($statecitydata as $statedata)
      			<div class="panel panel-default">
				  <div class="panel-heading" role="tab" id="stateHeading{{ $statedata->state_id }}">
					<h4 class="panel-title"><a @if($i != 1) class="collapsed" @endif role="button" data-toggle="collapse" data-parent="#accordion" href="#state{{ $statedata->state_id }}" @if($i == 1) aria-expanded="true" @else aria-expanded="false" @endif aria-controls="state{{ $statedata->state_id }}"> @if($i == 1) <i class="more-less fa fa-caret-down"></i> @else <i class="more-less fa fa fa-caret-right"></i> @endif<span>{{ ucfirst($statedata->state_name) }}</span></a></h4>
				  </div>
				  <div id="state{{ $statedata->state_id }}" @if($i == 1) class="panel-collapse collapse in" @else class="panel-collapse collapse" @endif role="tabpanel" aria-labelledby="stateHeading{{ $statedata->state_id }}">
					<div class="panel-body">
				  	  @if($statedata->Propertydata != NULL && !empty($statedata->Propertydata) && count($statedata->Propertydata) > 0)
     					<section class="panel-body-red">
							<div class="row">
							  <aside class="col-sm-3"> <span class="locations">Locations</span> </aside>
							  <aside class="col-sm-9"> <span class="city">City, ST</span> </aside>
							</div>
					    </section>	
      					@foreach($statedata->Propertydata as $propertydata)
      					  <section class="panel-body-grey">
							<div class="row">
							  <aside class="col-sm-3"> <a href="{{ url('/property/'.$propertydata->property_seourl) }}"><span class="state">{{ $propertydata->property_name }}</span></a> </aside>
							  <aside class="col-sm-9"> <span class="country">{{ ucfirst($propertydata->Propertycity->city_name) }}, {{ ucfirst($statedata->state_abbr) }}</span> </aside>
							</div>
						  </section>
      					@endforeach
      				    <div class="areaPageLink">
							<a href="{{ url('/apartments/'.ucfirst($statedata->state_name).'/efficient_property_management') }}">View our {{ count($statedata->Propertydata) }} {{ ucfirst($statedata->state_name) }} Locations <span>&gt;</span></a>
						</div>
       				  @else	
					  	 <section class="panel-body-grey">
							<div class="row">
							  <aside class="col-sm-12"> <span class="state">No Property Found.</span> </aside>
							</div>
						 </section>
					  @endif
					</div>
				  </div>
				</div>
     		<?php $i++; ?>
      		@endforeach
       @else
       		<center><h4>No State Found.</h4></center>
       @endif
        
      </div>
      <!-- panel-group -->
      <div class="clearfix"></div>
    </section>
  </div>
</section>
@endsection
