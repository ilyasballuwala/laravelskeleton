<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
	<title>Efficient Property Management Apartment Homes</title>
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<meta name="HandheldFriendly" content="true">
	<meta name="apple-touch-fullscreen" content="yes">
	
	<!-- Meta Content -->
  	<meta name="title" content="{{ (isset($meta_title) && $meta_title != '') ? $meta_title : 'Efficient Property Management Apartment Homes' }}">
  	<meta name="keywords" content="{{ (isset($meta_keywords) && $meta_keywords != '') ? $meta_keywords : 'Efficient, Property, Management, Apartment, Homes' }}">
  	<meta name="description" content="{{ (isset($meta_desc) && $meta_desc != '') ? $meta_desc : 'Efficient Property Management Apartment Homes' }}">
   
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <!-- Google Fonts-->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700|Ubuntu+Condensed" rel="stylesheet"> 

	<!-- ICON WEB FONTS	-->
	<link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}" type="text/css" media="all">

	<!-- MAIN STYLESHEETS-->
	<link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}" type="text/css" media="all">
	<link rel="stylesheet" href="{{ asset('css/bootstrap-theme.css') }}" type="text/css" media="all">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" type="text/css" media="all">
    <link rel="stylesheet" href="{{ asset('css/bootstrap-select.css') }}" type="text/css" media="all">

    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
    
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?sensor=false&key=AIzaSyBMbwVyYIwW0LSTwmnhkaatJ253xhCUCOo"></script>
</head>
<body class="sandstones">

	<div id="app">
        @yield('content')
    </div>

   
    <!-- footer	-->
<footer id="footer">
  <section class="container">
    <div class="row">
      <aside class="col-xs-8">
      <p class="copy"><span class="display-b">Site Map | Efficient Property Management Privacy Policy</span>
&copy; 2017 Efficient Property Management Pensacola, FL</p>
      </aside>
    </div>
  </section>
</footer>

 	<script src="{{ asset('js/jquery.js') }}"></script> 
	<script src="{{ asset('js/bootstrap.min.js') }}"></script> 
	<script src="{{ asset('js/bootstrap-select.js') }}"></script>
	<script src="{{ asset('js/slick.min.js') }}"></script>
    <script src="{{ asset('js/plugins/jq-sticky/jquery.sticky.js') }}"></script>
    <script src="{{ asset('js/plugins/gallaria/galleria.min.js') }}"></script>
    <script src="{{ asset('js/plugins/gallaria/galleria.history.min.js') }}"></script>
	<script src="{{ asset('js/frontcustom.js') }}"></script>
          
</body>
</html>
