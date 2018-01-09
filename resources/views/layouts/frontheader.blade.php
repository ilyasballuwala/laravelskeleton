<!-- Main Header for front section template -->
<header>
  <section class="header-top">
    <div class="container">
      <div class="row">
        <aside class="col-sm-5"> <a class="text-hide" href="{{ url('/') }}"><img src="{{ asset('images/logo.png') }} " alt="EC project"></a> </aside>
        <aside class="col-sm-7 form-top">
          <form class="form-horizontal" role="form" method="post" action="{{ url('/findpropertyzipcode') }}">
          	{{ csrf_field() }}
            <section class="row">
              <div class="col-sm-5 pull-right">
                <div class="input-group add-on">
                  <input class="form-control" placeholder="SEARCH BY ZIP" name="property_zipcode" id="property_zipcode" type="text">
                  <div class="input-group-btn">
                    <button class="btn btn-default" type="submit"><i class="fa fa-search"></i></button>
                  </div>
                </div>
              </div>	
              <div class="col-sm-7">
               <div class="btn-group bootstrap-select show-tick form-control open">
               		<a class="btn dropdown-toggle" title="FIND YOUR NEW HOME" href="{{ url('/our_community') }}">
               			<span class="filter-option pull-left">FIND YOUR NEW HOME</span>&nbsp;<span class="bs-caret"><span class="fa fa-chevron-right"></span></span>
               		</a>
               </div>
              </div>
              
            </section>
          </form>
        </aside>
      </div>
    </div>
  </section>
  <nav class="navbar navbar-default" id="nav">
    <div class="container">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false"> <div class="sr-only">Menu</div> <div class="menuicon-container"><span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span></div> </button>
      </div>
      <div id="bs-example-navbar-collapse-1" class="navbar-collapse collapse" aria-expanded="false">
        <ul class="nav navbar-nav">
          <li @if(Request::url() === url('/')) class="active" @endif><a href="{{ url('/') }}">HOME</a></li>
          <li class="hassubmenu @if(Request::url() === url('/our_community')) active @endif"><a href="{{ url('/our_community') }}">COMMUNITIEs</a>
          	@if(!empty($menustatedata) && count($menustatedata) > 0)
            	<ul class="hassubmenu submenu">
                	@foreach($menustatedata as $state)
                    	<li @if(count($state->Citydata) > 0) class="hassubmenu" @endif><a href="{{ url('/apartments/'.ucfirst($state->state_name).'/efficient_property_management') }}">{{ $state->state_name }}</a>
                        	@if(count($state->Citydata) > 0)
                                <ul class="submenu innermenu" role="menu">
                                	@foreach($state->Citydata as $city)
                                    	@if(count($city->Propertydata) > 0)
                                    	<li><a @if(count($city->Propertydata) > 1) href="{{ url('/apartments/'.ucfirst($city->city_name).'/efficient_property_management') }}" @else href="{{ url('/property/'.$city->Propertydata[0]->property_seourl) }}" @endif>{{ $city->city_name }}</a></li>
                                        @endif
                                    @endforeach
                                </ul>
                            @endif
                        </li>
                    @endforeach
                </ul>
            @endif
          </li>
          @if(count($cmspages) > 0)
          	@foreach($cmspages as $cmspage) 
          		<li class="@if(count($cmspage->Childpagedata) > 0) hassubmenu @endif @if(Request::url() === url('/'.$cmspage->cms_page_url)) active @endif"><a href="{{ url('/'.$cmspage->cms_page_url) }}">{{ strtoupper($cmspage->cms_page_title) }}</a> <!---->
          			@if(count($cmspage->Childpagedata) > 0)
          				<ul class="hassubmenu submenu" role="menu">
          					@foreach($cmspage->Childpagedata as $childpage)
						  		<li><a href="{{ url('/'.$childpage->cms_page_url) }}">{{ ucfirst($childpage->cms_page_title) }}</a></li>
						    @endforeach
						</ul>
          			@endif
          		</li>
          	@endforeach
          @endif
          <li @if(Request::url() === url('/contact')) class="active" @endif><a href="{{ url('/contact') }}">CONTACT</a></li>
        </ul>
      </div>
      <!--/.nav-collapse --> 
    </div>
    <!--/.container-fluid --> 
  </nav>
</header>
