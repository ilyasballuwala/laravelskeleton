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
        <li><a href="{{ url('/property/'.$propertydata->property_seourl) }}#maininfo-container">About Us</a></li>
        <li><a href="{{ url('/property/'.$propertydata->property_seourl) }}#propertymap-container">Map &amp; Directions</a></li>
      </ul>
      <!--/.container-fluid -->
      <div class="nav-adress">
        <h3>{{ $propertydata->property_phoneno }}</h3><button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#propertyabout-direction" aria-expanded="false"> <div class="menuicon-container"><span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span></div> </button>
        <p class="propertyname">{{ ucfirst($propertydata->property_name) }}</p> <p>{{ $propertydata->property_address }}</p> <p>{{ $propertydata->Propertycity->city_name }}, {{ $propertydata->Propertystate->state_abbr }} {{ $propertydata->property_postalcode }}</p>
      </div>
     </div> 
    </nav>
</header>

<!-- container	-->
<section class="propertydetails-container">
    <section class="container">
      <div class="bg-sandstones propertycontact" id="maininfo-container">
        <h1 class="text-center property_phototitle">Photos of Our Apartments in {{ ucfirst($propertydata->Propertycity->city_name) }} </h1>
                      
        <div class="propertygallary-container">
            @if(!empty($propertydata->Propertyimagedata) && count($propertydata->Propertyimagedata) > 0)
              <div class="propertyslider" id="galleria">
                @foreach($propertydata->Propertyimagedata as $images)
                    <a href="{{ asset('images/property/'.$propertydata->property_id.'/'.$images->image_name) }}"><img class="propertyslider-mainimages img-responsive" src="{{ asset('images/property/'.$propertydata->property_id.'/'.$images->image_name) }}"/></a>
                @endforeach
              </div>
              
             @else
                <center><p class="no-found">No Property Images Found.</p></center> 
             @endif 
            <p class="learn-more">Learn more about our <a href="{{ url('/property/'.$propertydata->property_seourl) }}">apartments for rent in {{ ucfirst($propertydata->Propertycity->city_name) }}.</a></p>
        </div>
        
        <hr id="propertymap-container">
      </div>
    </section>
</section>    
@endsection

