<!-- footer	-->
<footer id="footer">
  <section class="container">
    <div class="row">
      <aside class="col-xs-8">
       @if(count($footercmspages) > 0)
         	<ul>
          	@foreach($footercmspages as $footercmspage)
       			<li><a href="{{ url('/'.$footercmspage->cms_page_url) }}">{{ ucfirst($footercmspage->cms_page_title) }}</a></li>
       		@endforeach
       		</ul>
       @endif   	 
        <p class="copy">&copy; 2017 Efficient Property Management</p>
      </aside>
      <aside class="col-xs-4"> Powered By : <br/><a href="http://methodicalsolutions.com/" target="_blank" class="logo-company"><!--<img src="{{ asset('images/logo-methodological.png') }}" alt="Logo">--> Methodical Solutions</a> </aside>
    </div>
  </section>
</footer>