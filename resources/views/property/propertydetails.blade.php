@extends('layouts.propertyapp')

@section('content')
<!-- header -->
<header class="propertydetail-header">
  <div class="container">
    <section class="banner"> <img src="{{ asset('images/property/'.$propertydata->property_id.'/'.$propertydata->property_mainimage) }}" alt=""><div class="overlay"></div>
      <div class="banner-logo"><a href="{{ url('/property/'.$propertydata->property_seourl) }}"><img src="{{ asset('images/property/'.$propertydata->property_id.'/'.$propertydata->property_logoimage) }}" alt="property-logo"></a></div>
      <div class="banner-link"><a href="{{ url('/property/contact/'.$propertydata->property_seourl) }}"><img src="{{ asset('images/btn-contact.png') }}" alt="contact-us"></a></div>
    </section>
  </div>
   <nav class="navbar navbar-default" id="property-nav">
   	<div class="container">
      <ul class="nav navbar-nav" id="propertyabout-direction">
        <li><a href="#maininfo-container">About Us</a></li>
        <li><a href="#propertymap-container">Map &amp; Directions</a></li>
      </ul>
      <!--/.container-fluid -->
      <div class="nav-adress">
        <h3>{{ $propertydata->property_phoneno }}</h3> <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#propertyabout-direction" aria-expanded="false"> <div class="menuicon-container"><span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span></div> </button>
        <p class="propertyname">{{ ucfirst($propertydata->property_name) }}</p> <p>{{ $propertydata->property_address }}</p> <p>{{ $propertydata->Propertycity->city_name }}, {{ $propertydata->Propertystate->state_abbr }} {{ $propertydata->property_postalcode }}</p>
      </div>
     </div> 
    </nav>
</header>

<!-- container	-->
<section class="propertydetails-container">
	<section class="container">
      <div class="bg-sandstones" id="maininfo-container"><img src="{{ asset('images/logo.png') }}" alt="logo">
        <p class="return"><a href="{{ url('/') }}">Return to Corporate</a></p>
        <h1 class="text-center">{{ ucfirst($propertydata->property_name) }} Apartments in {{ $propertydata->Propertycity->city_name }}</h1>
        <div class="property_description">
            <p>{!! $propertydata->property_desc !!} Learn more about our apartments in {{ $propertydata->Propertycity->city_name }} by viewing our <a href="{{ url('/property/gallary/'.$propertydata->property_seourl) }}">photo gallery</a>.</p>
        </div>
        <h2 class="text-center">Price Range:</h2>
        @if(!empty($propertydata->Propertyroomsdata) && count($propertydata->Propertyroomsdata) > 0)
        <ul class="ul-price">
        @foreach($propertydata->Propertyroomsdata as $roomsdata)
          <li>
            @if($roomsdata->studiooption_value != "" && $roomsdata->studiooption_value != 0)
                {{ $roomsdata->studiooption_value }}
            @endif
            
            @if($roomsdata->studiooption_name != "" && $roomsdata->studiooption_name != NULL)
                {{ config('custom.studio_option.'.$roomsdata->studiooption_name) }}
            @endif
            
            @if($roomsdata->bedroomoption_value != "" && $roomsdata->bedroomoption_value != 0)
                {{ $roomsdata->bedroomoption_value }}
            @endif
            
            @if($roomsdata->bedroomoption_name != "" && $roomsdata->bedroomoption_name != NULL)
                {{ config('custom.bedroom_option.'.$roomsdata->bedroomoption_name) }}
            @endif
            
            @if($roomsdata->bathoption_value != "" && $roomsdata->bathoption_value != NULL)
                {{ $roomsdata->bathoption_value }} Bath
            @endif
            
            @if($roomsdata->price_startvalue != "" && $roomsdata->price_startvalue != 0)
                ${{ $roomsdata->price_startvalue }}
            @endif
            
            @if($roomsdata->price_endvalue != "" && $roomsdata->price_endvalue != 0)
                - ${{ $roomsdata->price_endvalue }}
            @endif
         </li>
        @endforeach  
        </ul>
       @endif 
        <h2 class="text-center">Current specials for {{ ucfirst($propertydata->property_name) }}</h2>
        <p class="text-center">Call for current specials!</p>
        <h4>{{ ucfirst($propertydata->property_name) }} Community Amenities</h4>
        <ul class="ul-community">
        @if($amenitiesdata != NULL && count($amenitiesdata) > 0)
            @foreach($amenitiesdata as $amenities)
                <li>{{ $amenities->amenity_name }}</li>
            @endforeach
        @endif
        </ul>
        
        <h4>{{ ucfirst($propertydata->property_name) }} Apartment Features</h4>
        <ul class="ul-community">
        @if($featuredata != NULL && count($featuredata) > 0)
            @foreach($featuredata as $feature)
                <li>{{ $feature->feature_title }}</li>
            @endforeach
        @endif
        </ul>
        
        @if($hourscount > 0)
            <h4 class="office-hours">Office Hours</h4>
            <ul class="ul-community">
            @foreach($propertyhours as $day=>$daydetails)
                
                @if(isset($daydetails['close']) && $daydetails['close'] == true)
                    <li>{{ ucfirst(substr($day,0,3)) }} Closed
                @elseif(isset($daydetails['hours']) && $daydetails['hours'] != "" && $daydetails['hours'] != NULL)
                    <li>{{ ucfirst(substr($day,0,3)) }} {{ $daydetails['hours'] }}
                @endif
                    
            @endforeach
            </ul>
        @endif
        
        
    <h3>Apply for Residence</h3>
    <p class="download-app"><a href="{{ $propertydocument }}" class="display-b">Download Application</a><br/>
    Please give us a call for instructions on how to submit your application.</p>
    <p class="logo-rentpayment"><a href="#"><img src="{{ asset('images/logo-rentpayment.png') }}" alt="logo rentpayment"></a></p>
    <hr id="propertymap-container">
    <form method="get" id="sandstones-form" onsubmit="calcRoute(); return false;">
    <div class="sandstones-form-top">
    <div class="form-group">
        <label for="from" class="col-sm-2 control-label">From:</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" id="fromAddress" name="from_address" placeholder="Enter Your Address">
        </div>
      </div>
      <div class="form-group">
        <label for="to" class="col-sm-2 control-label">To:</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" id="toAddress" name="to_address" placeholder="Resident Address" value="{{ $propertydata->property_address }} {{ $propertydata->Propertycity->city_name }}, {{ $propertydata->Propertystate->state_abbr }} {{ $propertydata->property_postalcode }}">
        </div>
      </div>
      <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
          <button type="submit" class="btn btn-success">Get Directions!</button>
        </div>
        </div>
        <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
          <button type="button" class="btn btn-success" onClick='window.print()'>Print this page</button>
        </div>
    </div>
    <div class="clearfix"></div>
    </div>
    <div class="sandstones-form-bottom" id="directionsMap"></div>
    <div id="directionsContent"></div>
    </form>
    <hr class="mb0">
      </div>
</section>
</section>

<script type="text/javascript">
	function clearText(field){
	  if (field.defaultValue == field.value) field.value = '';
	  else if (field.value == '') field.value = field.defaultValue;
	}
	
	var styles = '<style>';
	// style directions text and background
	styles += '#directionsContent .adp-summary { color: #2c2c2c; background-color: #eeeeee; border-left: 1px solid gray; border-top: 1px solid gray; border-right: 1px solid gray; }';
	styles += '#directionsContent .adp-summary + div { background-color: #eeeeee; border-left: 1px solid gray; border-bottom: 1px solid gray; border-right: 1px solid gray; }';
	styles += '#directionsContent .adp-summary + div table { color: #2c2c2c; }';
	// remove white background behind images
	styles += '#directionsMap img { background-color: transparent; }';
	styles += '#directionsContent img { background-color: transparent; }';
	styles += '</style>';
	
	$('head').append(styles);
    </script>
    
    <script type="text/javascript">      
		var directionsDisplay;
        var directionsService = new google.maps.DirectionsService();
          
		  function calcRoute() {
            var fromAddress = document.getElementById("fromAddress").value;
            var toAddress = document.getElementById("toAddress").value;
            var request = {
                origin:fromAddress,
                destination:toAddress,
                travelMode: google.maps.DirectionsTravelMode.DRIVING
            };
            directionsService.route(request, function(response, status) {
              if (status == google.maps.DirectionsStatus.OK) {
                directionsDisplay.setDirections(response);
              }
            });
			
          }
		  
      var map;
      var image = "";
      var infowindow = new google.maps.InfoWindow();
	  var myOptions = {
        zoom: 14,
        mapTypeId: google.maps.MapTypeId.ROADMAP,
	  };
	   
      function initialize() {
		  geocoder = new google.maps.Geocoder();
          map = new google.maps.Map(document.getElementById("directionsMap"), myOptions);

            var bounds = new google.maps.LatLngBounds();
			
			//Your Variable Containing The Address
			var address = "<?php echo $propertyaddress; ?>";
			geocoder.geocode( { 'address': address}, function(results, status) { 
			  if (status == google.maps.GeocoderStatus.OK) {
				  
				//places a marker on every location
				var marker = new google.maps.Marker({ 
					map: map,
					position: results[0].geometry.location 
				});
				
				var contentString = '<?php echo $propertyinfocontent; ?>';
		
				var infowindow = new google.maps.InfoWindow({
				  content: contentString
				});
		
				marker.addListener('click', function() {
					  infowindow.open(map, marker);
				});
				
				// Don't zoom in too far on only one marker
				if (bounds.getNorthEast().equals(bounds.getSouthWest())) {
				   var extendPoint1 = new google.maps.LatLng(bounds.getNorthEast().lat() + 0.01, bounds.getNorthEast().lng() + 0.01);
				   var extendPoint2 = new google.maps.LatLng(bounds.getNorthEast().lat() - 0.01, bounds.getNorthEast().lng() - 0.01);
				   bounds.extend(extendPoint1);
				   bounds.extend(extendPoint2);
				}

            	map.fitBounds(bounds);
				map_recenter(map,results[0].geometry.location,0,0);
				
				google.maps.event.addDomListener(window, 'resize', function(){
				  map.fitBounds(bounds);
				  map_recenter(map,results[0].geometry.location,0,0);
				});
				
				directionsDisplay = new google.maps.DirectionsRenderer();
				directionsDisplay.setMap(map);
				directionsDisplay.setPanel(document.getElementById("directionsContent"));
			  }
			  
			 });
		}
		 
		  function map_recenter(map,latlng,offsetx,offsety) {
			  map.setZoom(14);
			  //alert(map.getZoom());
			var point1 = map.getProjection().fromLatLngToPoint(
				(latlng instanceof google.maps.LatLng) ? latlng : map.getCenter()
			);
			var point2 = new google.maps.Point(
				( (typeof(offsetx) == 'number' ? offsetx : 0) / Math.pow(2, map.getZoom()) ) || 0,

				( (typeof(offsety) == 'number' ? offsety : 0) / Math.pow(2, map.getZoom()) ) || 0
			);  
			map.setCenter(map.getProjection().fromPointToLatLng(new google.maps.Point(
				point1.x - point2.x,
				point1.y + point2.y
			)));
		}
	        
          window.onload = initialize
  
    </script>
    
@endsection

