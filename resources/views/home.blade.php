@extends('layouts.app')

@section('content')
<!-- container	-->
<section class="home-bg">
  <div class="container home-container">
    <section class="slider"> 
      <div class="header-slider">
     	  @foreach($homepageimages as $image)
      	  <div><img src="{{ asset('images/homapageimages/'.$image->image_name) }}" alt="{{ $image->image_name }}"></div>
          @endforeach
      </div>
      <div class="slider-text">{{ $homepagefields->banner_title }}</div>
    </section>
    <section class="containt-part border-bottom">
      <aside class="col-sm-8">
        <div class="home-border">
          <h1>{!! $homepagefields->main_title !!}</h1>
          <div class="homepage_content">
          	{!! $homepagefields->main_content !!}
          </div>
        </div>
      </aside>
      <aside class="col-sm-4"><img src="{{ asset('images/homapageimages/'.$homepagefields->sidebar_image) }}" alt="Home Image" class="homeimage-sidebar"></aside>
      <div class="clearfix"></div>
    </section>
  </div>
</section>
@endsection
