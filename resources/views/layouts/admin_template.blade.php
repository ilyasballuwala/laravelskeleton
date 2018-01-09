<!-- Added Amit on 28-02-2017 -->
<!-- New layout for admin section pages -->
<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html ng-app="ecApp">
<head>
	<meta charset="utf-8">
  	<meta http-equiv="X-UA-Compatible" content="IE=edge">
  	<title>Efficient Corporate | {{$title}}</title>
  	<!-- Tell the browser to be responsive to screen width -->
  	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  	<!-- Bootstrap 3.3.6 -->
  	<link rel="stylesheet" type="text/css" href="{{ asset("../bower_components/AdminLTE/bootstrap/css/bootstrap.min.css") }}" />
  	
  	<!-- Font Awesome -->
  	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  	<!-- Ionicons -->
  	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  	
  	<!-- Datatable CSS -->
  	<link rel="stylesheet" type="text/css" href="{{ asset("js/plugins/datatables/dataTables.bootstrap.css") }}" />
  	<!-- Select2 CSS -->
  	<link rel="stylesheet" type="text/css" href="{{ asset("js/plugins/select2/select2.min.css") }}" />
  	
  	<!-- Theme style -->
  	<!--<link rel="stylesheet" href="dist/css/AdminLTE.min.css">-->  
  	<link rel="stylesheet" type="text/css" href="{{ asset("../bower_components/AdminLTE/dist/css/AdminLTE.min.css") }}" />
  	<link rel="stylesheet" type="text/css" href="{{ asset("../bower_components/AdminLTE/dist/css/skins/skin-blue.min.css") }}" />
  	
  	<!-- bootstrap wysihtml5 - text editor -->
  	<link rel="stylesheet" href="{{ asset("js/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css") }}">
  	
  	<!-- Bootstrap Tags Input -->
  	<link rel="stylesheet" href="{{ asset("../bower_components/bootstrap-tagsinput/bootstrap-tagsinput.css") }}">
  	
  	<!-- Custom -->
  	<link rel="stylesheet" type="text/css" href="{{ asset("css/custom.css") }}" />
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  	<!--[if lt IE 9]>
  	<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  	<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  	<![endif]-->
  	<script type="text/javascript"> 
		var hosturl = '<?php echo URL::to('/'); ?>'; 
		window.Laravel = <?php echo json_encode([
				'csrfToken' => csrf_token(),
		]); ?>
	</script>
</head>
<body class="hold-transition skin-blue sidebar-mini" data-ng-controller="mainController">
	<div class="wrapper">
		<!-- Header -->
  		@include('layouts.header')
  		<!-- Sidebar -->
  		@include('layouts.sidebar')
		<!-- Content Wrapper. Contains page content -->
  		<div class="content-wrapper">
    		<!-- Your Page Content Here -->
			@yield('content')
  		</div>
  		<!-- /.content-wrapper -->
		<!-- Footer -->
  		@include('layouts.footer')
	</div>
	<!-- ./wrapper -->
   
    <!-- REQUIRED JS SCRIPTS -->
	<!-- jQuery 2.2.3 -->
    <script type="text/javascript" src="{{ asset("../bower_components/AdminLTE/plugins/jQuery/jquery-2.2.3.min.js") }}"></script>
    <!-- Bootstrap 3.3.6 -->
    <script type="text/javascript" src="{{ asset("../bower_components/AdminLTE/bootstrap/js/bootstrap.min.js") }}"></script>
    <!-- Select2 -->
	<script type="text/javascript" src="{{ asset("js/plugins/select2/select2.full.min.js") }}"></script>
    <!-- Bootstrap Tags Input -->
  	<script type="text/javascript" href="{{ asset("../bower_components/bootstrap-tagsinput/bootstrap-tagsinput.min.js") }}"></script>
    <!-- AdminLTE App -->
    <script type="text/javascript" src="{{ asset("../bower_components/AdminLTE/dist/js/app.min.js") }}"></script>
      
    <!-- DataTables -->
	<script type="text/javascript" src="{{ asset("js/plugins/datatables/jquery.dataTables.min.js") }}"></script>
	<script type="text/javascript" src="{{ asset("js/plugins/datatables/dataTables.bootstrap.min.js") }}"></script>
	
	<!-- CK Editor -->
	<script src="https://cdn.ckeditor.com/4.5.7/standard/ckeditor.js"></script>
	<!--<script type="text/javascript" src="{{ asset("js/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js") }}"></script>-->
	
	<!-- AngularJS 1.6.2 -->
    <script type="text/javascript" src="{{ asset("../bower_components/angular/angular.js") }}"></script>
    <!-- Angular Tag Input JS -->
    <script type="text/javascript" src="{{ asset("../bower_components/bootstrap-tagsinput/bootstrap-tagsinput.js") }}"></script>

    
    <!-- Angular App JS -->
    <script type="text/javascript" src="{{ asset("js/angular.app.js") }}"></script>    
    <!-- Custom JS -->
    <script type="text/javascript" src="{{ asset("js/custom.js") }}"></script>
    
</body>
</html>