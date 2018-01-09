<!-- Added Amit on 28-02-2017 -->
<!-- Main Header for admin section template -->
<header class="main-header">
	<!-- Logo -->
    <a href="{{ url('/admin') }}" class="logo">
    	<!-- mini logo for sidebar mini 50x50 pixels -->
      	<span class="logo-mini"><b>A</b> EC</span>
      	<!-- logo for regular state and mobile devices -->
      	<span class="logo-lg"><b>Admin</b> EC</span>
    </a>
    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
    	<!-- Sidebar toggle button-->
      	<a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        	<span class="sr-only">Toggle navigation</span>
      	</a>
      	<!-- Navbar Right Menu -->
      	<div class="navbar-custom-menu">
        	<ul class="nav navbar-nav">
          		<!-- User Account Menu -->
          		<li class="dropdown user user-menu">
            		<!-- Menu Toggle Button -->
            		<a href="#" class="dropdown-toggle" data-toggle="dropdown">
              			<!-- The user image in the navbar-->
                        <img src="{{ url('/') }}{{ config('auth.admin_avatar_path') }}/admin_avatar.jpg" class="user-image" alt="User Image">
              			<!-- hidden-xs hides the username on small devices so only the image appears. -->
              			<span class="hidden-xs">{{ Auth::guard('admin')->user()->name }}</span>
            		</a>
            		<ul class="dropdown-menu">
              			<!-- The user image in the menu -->
              			<li class="user-header">
                			<img src="{{ url('/') }}{{ config('auth.admin_avatar_path') }}/admin_avatar.jpg" class="img-circle" alt="User Image">
							<p>
                            	{{ Auth::guard('admin')->user()->name }}
                                <small>Since {{ date('F Y',strtotime(Auth::guard('admin')->user()->created_at)) }}</small>
                            </p>
              			</li>
              			<!-- Menu Footer-->
              			<li class="user-footer">
                			<div class="pull-left">
                  				<a href="{{ url('/admin/profile') }}" class="btn btn-default btn-flat">Profile</a>
                			</div>
                            <div class="pull-left change_password_left_space">
                  				<a href="{{ url('/admin/changepass') }}" class="btn btn-default btn-flat">Change Password</a>
                			</div>
                			<div class="pull-right">
                  				<a href="{{ url('/admin/logout') }}" class="btn btn-default btn-flat" onclick="event.preventDefault();document.getElementById('logout-form').submit();">Sign out</a>
                				<form id="logout-form" action="{{ url('/admin/logout') }}" method="POST" style="display:none;">{{ csrf_field() }}</form>
                			</div>
              			</li>
            		</ul>
          		</li>
        	</ul>
      	</div>
    </nav>
</header>