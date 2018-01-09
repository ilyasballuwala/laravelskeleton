<!-- Added Amit on 28-02-2017 -->
<!-- Left side column for admin section template -->
<aside class="main-sidebar">
	<!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
		<!-- Sidebar user panel (optional) -->
      	<div class="user-panel">
        	<div class="pull-left image">
                <img src="{{ url('/') }}{{ config('auth.admin_avatar_path') }}/admin_avatar.jpg" class="img-circle" alt="User Image">
        	</div>
        	<div class="pull-left info">
          		<p>{{ Auth::guard('admin')->user()->name }}</p>
          		<!-- Status -->
          		<a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        	</div>
      	</div>
		<!-- Sidebar Menu -->
      	<ul class="sidebar-menu">
        	<li class="header">HEADER</li>
        	<!-- Optionally, you can add icons to the links -->
        	<li @if(Request::segment(1) == 'admin' && ( Request::segment(2) == '' || Request::segment(2) == 'dashboard') && (Request::segment(3) != 'homepagefields') ) class="active" @endif><a href="{{ url('/admin/dashboard') }}"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
        	<li @if(Request::segment(1) == 'admin' && ( Request::segment(2) == 'dashboard') && (Request::segment(3) == 'homepagefields') ) class="active" @endif><a href="{{ url('/admin/dashboard/homepagefields') }}"><i class="fa fa-home"></i> <span>Home Page Management</span></a></li>
        	<li class="treeview @if(Request::segment(1) == 'admin' && Request::segment(2) == 'state')) active @endif">
          		<a href="javascript:void(0)">
                	<i class="fa fa-h-square"></i>
                    <span>State Management</span>
            		<span class="pull-right-container">
              			<i class="fa fa-angle-left pull-right"></i>
            		</span>
          		</a>
          		<ul class="treeview-menu @if(Request::segment(1) == 'admin' && Request::segment(2) == 'state')) menu-open @endif">
            		<li @if(Request::segment(1) == 'admin' && Request::segment(2) == 'state' && (Request::segment(4) == 'edit' || Request::segment(3) == '')) class="active" @endif><a href="{{ url('/admin/state') }}"><i class="fa fa-list"></i> State List</a></li>
            		<li @if(Request::segment(1) == 'admin' && Request::segment(2) == 'state' && (Request::segment(3) == 'create')) class="active" @endif><a href="{{ url('/admin/state/create') }}"><i class="fa fa-plus-square"></i> Add State</a></li>
          		</ul>
        	</li>
            <li class="treeview @if(Request::segment(1) == 'admin' && Request::segment(2) == 'city')) active @endif">
          		<a href="javascript:void(0)">
                	<i class="fa fa-location-arrow"></i>
                    <span>City Management</span>
            		<span class="pull-right-container">
              			<i class="fa fa-angle-left pull-right"></i>
            		</span>
          		</a>
          		<ul class="treeview-menu @if(Request::segment(1) == 'admin' && Request::segment(2) == 'city')) menu-open @endif">
            		<li @if(Request::segment(1) == 'admin' && Request::segment(2) == 'city' && (Request::segment(4) == 'edit' || Request::segment(3) == '')) class="active" @endif><a href="{{ url('/admin/city') }}"><i class="fa fa-list"></i> City List</a></li>
            		<li @if(Request::segment(1) == 'admin' && Request::segment(2) == 'city' && (Request::segment(3) == 'create')) class="active" @endif><a href="{{ url('/admin/city/create') }}"><i class="fa fa-plus-square"></i> Add City</a></li>
          		</ul>
        	</li>
        	<li class="treeview @if(Request::segment(1) == 'admin' && Request::segment(2) == 'property')) active @endif">
          		<a href="javascript:void(0)">
                	<i class="fa fa-building-o"></i>
                    <span>Property Management</span>
            		<span class="pull-right-container">
              			<i class="fa fa-angle-left pull-right"></i>
            		</span>
          		</a>
          		<ul class="treeview-menu">
            		<li @if(Request::segment(1) == 'admin' && Request::segment(2) == 'property' && (Request::segment(4) == 'edit' || Request::segment(3) == '')) class="active" @endif><a href="{{ url('/admin/property') }}"><i class="fa fa-list"></i> Property List</a></li>
            		<li @if(Request::segment(1) == 'admin' && Request::segment(2) == 'property' && (Request::segment(3) == 'create')) class="active" @endif><a href="{{ url('/admin/property/create') }}"><i class="fa fa-plus-square"></i> Add Property</a></li>
          		</ul>
        	</li>
            <li class="treeview @if(Request::segment(1) == 'admin' && Request::segment(2) == 'cms')) active @endif">
          		<a href="javascript:void(0)">
                	<i class="fa fa-file"></i>
                    <span>CMS Management</span>
            		<span class="pull-right-container">
              			<i class="fa fa-angle-left pull-right"></i>
            		</span>
          		</a>
          		<ul class="treeview-menu @if(Request::segment(1) == 'admin' && Request::segment(2) == 'cms')) menu-open @endif">
            		<li @if(Request::segment(1) == 'admin' && Request::segment(2) == 'cms' && (Request::segment(4) == 'edit' || Request::segment(3) == '')) class="active" @endif><a href="{{ url('/admin/cms') }}"><i class="fa fa-list"></i> CMS List</a></li>
            		<li @if(Request::segment(1) == 'admin' && Request::segment(2) == 'cms' && (Request::segment(3) == 'create')) class="active" @endif><a href="{{ url('/admin/cms/create') }}"><i class="fa fa-plus-square"></i> Add CMS</a></li>
          		</ul>
        	</li>
            <li @if(Request::segment(1) == 'admin' && Request::segment(2) == 'websitecontact') class="active" @endif><a href="{{ url('/admin/websitecontact') }}"><i class="fa fa-users"></i> <span>Website Contacts</span></a></li>
            <li @if(Request::segment(1) == 'admin' && Request::segment(2) == 'propertycontact') class="active" @endif><a href="{{ url('/admin/propertycontact') }}"><i class="fa fa-users"></i> <span>Properties Contacts</span></a></li>
      	</ul>
      	<!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>