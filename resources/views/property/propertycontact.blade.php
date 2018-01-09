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
        <h1 class="text-center property_name">{{ ucfirst($propertydata->property_name) }} </h1>
        <h3 class="text-center property_address">{{ $propertydata->property_address }} <br/> {{ $propertydata->Propertycity->city_name }}, {{ $propertydata->Propertystate->state_abbr }} {{ $propertydata->property_postalcode }}</h3>
        <p class="contact-notice">Please complete the form below. Mandatory fields marked <span class="required">*</span></p>
        <div class="flash-message mrgn-top15">
            @foreach (['danger', 'warning', 'success', 'info'] as $msg)
              @if(Session::has('alert-' . $msg))
              <div class="alert alert-{{ $msg }} alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><h4 class="contact-msg">{{ ucfirst(($msg == 'danger') ? "Error" : $msg) }}!</h4> {{ Session::get('alert-' . $msg) }}</div>
              @endif
            @endforeach
          </div> 
                      
        <div class="contactform-container">
            <p class="form-notice">Thank you for your interest in {{ ucfirst($propertydata->property_name) }}. Please complete this form and we will contact you soon. For emergencies please call our Customer Care Line - 855-717-5653</p>
            <form name="property_contact" id="property_contact" action='{{ url('/property/contact/'.$propertydata->property_seourl) }}' method="post" class="property_contactform">
                {{ csrf_field() }}
                <div class="form-group {{ $errors->has('contact_name') ? ' has-error' : '' }}">
                    <label for="contact_name" class="col-sm-12 control-label">Name <span class="required">*</span></label>
                    <input class="col-sm-12 form-control" name="contact_name" id="contact_name" type="text" value="{{ old('contact_name') }}"/>
                    @if ($errors->has('contact_name'))
                        <span class="help-block">{{ $errors->first('contact_name') }}</span>
                    @endif
                </div>
                <div class="form-group {{ $errors->has('contact_email') ? ' has-error' : '' }}">
                    <label for="contact_email" class="col-sm-12 control-label">Email <span class="required">*</span></label>
                    <input class="col-sm-12 form-control" name="contact_email" id="contact_email" type="text" value="{{ old('contact_email') }}"/>
                    @if ($errors->has('contact_email'))
                        <span class="help-block">{{ $errors->first('contact_email') }}</span>
                    @endif
                </div>
                <div class="form-group {{ $errors->has('contact_phone') ? ' has-error' : '' }}">
                    <label for="contact_phone" class="col-sm-12 control-label">Phone </label>
                    <input class="col-sm-12 form-control" name="contact_phone" id="contact_phone" type="text" value="{{ old('contact_phone') }}"/>
                    @if ($errors->has('contact_phone'))
                        <span class="help-block">{{ $errors->first('contact_phone') }}</span>
                    @endif
                </div>
                <div class="form-group {{ $errors->has('contact_message') ? ' has-error' : '' }}">
                    <label for="contact_message" class="col-sm-12 control-label">Message </label>
                    <textarea class="col-sm-12 form-control" name="contact_message" id="contact_message" rows="10">{{ old('contact_message') }}</textarea>
                    @if ($errors->has('contact_message'))
                        <span class="help-block">{{ $errors->first('contact_message') }}</span>
                    @endif
                </div>
                <div class="form-group {{ $errors->has('contact_timetocall') ? ' has-error' : '' }}">
                    <label class="col-sm-12 control-label">Best Time To Call</label>
                    <input class="col-sm-12 form-control" name="contact_timetocall" id="contact_timetocall" type="text" value="{{ old('contact_timetocall') }}"/>
                    @if ($errors->has('contact_timetocall'))
                        <span class="help-block">{{ $errors->first('contact_timetocall') }}</span>
                    @endif
                </div>
                <div class="form-group">
                    <button type="submit" name="submit" id="submit" class="btn formbtn submit-btn">SUBMIT</button>
                    <a href="{{ url('/property/'.$propertydata->property_seourl) }}" class="btn formbtn cancel-btn">Cancel</a>
                </div>
            </form>
        </div>
        
        <hr id="propertymap-container">
      </div>
    </section>
</section>    
@endsection

