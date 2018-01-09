@extends('layouts.app')

@section('content')
<!-- container	-->
<!-- container	-->
<section class="communities-bg">
  <div class="container">
   @if($statepropertydata != NULL && count($statepropertydata) > 0)
    <section class="communities-part">
      <center><h1>We have {{ count($statepropertydata->Propertydata) }} {{ucfirst($state)}} Apartments Locations.</h1></center>
      <div class="propertylisting_container" id="property-listing">
      	<h2 class="property_subtitle">Apartments {{ucfirst($state)}}</h2>
      	<div class="row">
      		<div class="col-sm-8 col-md-8 col-lg-8 property-container">
      		  @if($statepropertydata != NULL && count($statepropertydata) > 0 && $statepropertydata->Propertydata != NULL && count($statepropertydata->Propertydata) > 0)
				  @foreach($statepropertydata->Propertydata as $propertydata)
				  	  <a href="{{ url('/property/'.$propertydata->property_seourl) }}" class="property_link">
						  <div class="actual-property">
							<img src="{{ asset('images/property/'.$propertydata->property_id) }}/{{ $propertydata->property_mainimage }}" class="img-responsive property-thumb" alt="property-image">
							<address class="vcard">
							  <span class="company_name">{{ ucfirst($propertydata->property_name) }}</span>
							  <div class="adr">
								<span class="street_address">{{ ucfirst($propertydata->property_address) }}</span>
								<span class="locality">{{ ucfirst($propertydata->Propertycity->city_name) }}</span>,
								<abbr class="region">{{ ucfirst($statepropertydata->state_abbr) }}</abbr>
								<span class="postal_code">{{ ucfirst($propertydata->property_postalcode) }}</span>
							  </div>
							</address>
							<span class="ap_visit_location">Visit Location</span>
						  </div>
					  </a>
					@endforeach
			  @else
					<center><h4 class="noproperty-found">No Property Found.</h4></center>
			  @endif 
      		</div>
      		<div class="col-sm-4 col-md-4 col-lg-4 map-container">
            	<section id="right-map">
                	<div class="map-bg" id="property_map"></div>
                	<p><strong>Click on the markers for Apartments Community information.</strong> Click and drag on the map to find the Community closest to you. Use the (+) and (-) icons to zoom.</p>
                </section>
      		</div>
      	</div> 
	  </div>     
      <div class="clearfix"></div>
    </section>
   @endif 
  </div>
</section>

<script type="text/javascript">
  var delay = 100;
  var infowindow = new google.maps.InfoWindow();
  //var latlng = new google.maps.LatLng(33.952602,-84.549933);
  var mapOptions = {
    zoom: 4,
    //center: latlng,
    mapTypeId: google.maps.MapTypeId.ROADMAP
  }
  var geocoder = new google.maps.Geocoder(); 
  var map = new google.maps.Map(document.getElementById("property_map"), mapOptions);
  var bounds = new google.maps.LatLngBounds();

  var locations = <?php echo json_encode($propertydetailarray); ?>;
  var propertyinfocontent = <?php echo $finalcontentinfo; ?>;
  var nextAddress = 0;
  function theNext() {
    if (nextAddress < locations.length) {
	  var contentobj = propertyinfocontent[nextAddress];
	  	  //console.log(contentobj);	  
		  //console.log(locations[nextAddress]+'initial');
	  	setTimeout(function(address){ geocodeAddress('"'+locations[nextAddress]+'"',theNext, contentobj); nextAddress++; }, delay);
    } else {
		// Extend the bounds for each marker
		if (bounds.getNorthEast().equals(bounds.getSouthWest())) {
		   var extendPoint1 = new google.maps.LatLng(bounds.getNorthEast().lat() + 0.01, bounds.getNorthEast().lng() + 0.01);
		   var extendPoint2 = new google.maps.LatLng(bounds.getNorthEast().lat() - 0.01, bounds.getNorthEast().lng() - 0.01);
		   bounds.extend(extendPoint1);
		   bounds.extend(extendPoint2);
		}

      map.fitBounds(bounds);
    }
  }
  theNext();
  
  function geocodeAddress(address, next, propetycontent) {
    geocoder.geocode({address:address}, function (results,status)
      { 
         if (status == google.maps.GeocoderStatus.OK) {
          var p = results[0].geometry.location;
          var lat=p.lat();
          var lng=p.lng();
		  console.log(lat+" "+lng);
          createMarker(address,lat,lng, propetycontent);
        }
        else {
           if(status == google.maps.GeocoderStatus.OVER_QUERY_LIMIT) {
            nextAddress--;
            delay++;
           } else { }   
        }
        next();
      }
    );
  }
  
  function createMarker(add,lat,lng, propetycontent) {
   var contentString = propetycontent;
   var marker = new google.maps.Marker({
     position: new google.maps.LatLng(lat,lng),
     map: map,
   });

  google.maps.event.addListener(marker, 'click', function() {
     infowindow.setContent(contentString); 
     infowindow.open(map,marker);
   });
	
   bounds.extend(marker.position);
   if (bounds.getNorthEast().equals(bounds.getSouthWest())) {
	   var extendPoint1 = new google.maps.LatLng(bounds.getNorthEast().lat() + 0.01, bounds.getNorthEast().lng() + 0.01);
	   var extendPoint2 = new google.maps.LatLng(bounds.getNorthEast().lat() - 0.01, bounds.getNorthEast().lng() - 0.01);
	   bounds.extend(extendPoint1);
	   bounds.extend(extendPoint2);
	}
 }
  	
</script>
          
@endsection
