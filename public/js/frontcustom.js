 $(window).scroll(function() {
    /*if ($(this).scrollTop() > 180){  
        $('#nav').addClass("sticky");
    }
    else{
        $('#nav').removeClass("sticky");
    }*/
});


// When the DOM is ready, run this function
$(document).ready(function() {
  //Set the carousel options
  $('#quote-carousel').carousel({
    pause: true,
    interval: 4000,
  });
  
  if($(window).width() <= 767){
  	$("ul.nav li.hassubmenu a").unbind('click').on('click',function(e){
		if($(this).parent('li').hasClass('hassubmenu')){
			e.preventDefault();	
			$(this).siblings('ul.submenu').slideToggle();
			e.stopPropagation();
		}
	});
  }
});
/*wow = new WOW(
      {
        animateClass: 'animated',
        offset: 100,
        callback: function(box) {
          console.log("WOW: animating <" + box.tagName.toLowerCase() + ">")
        }
      }
    );
    wow.init();
    document.getElementById('moar').onclick = function() {
      var section = document.createElement('section');
      section.className = 'section--purple wow fadeInDown';
      this.parentNode.insertBefore(section, this);
    };*/
	
	
$(document).ready(function () {
	
	if($("#property-nav").length > 0){
		$("#property-nav").sticky({topSpacing:0});
	}
	
    var mySelect = $('#first-disabled2');

    $('#special').on('click', function () {
      mySelect.find('option:selected').prop('disabled', true);
      mySelect.selectpicker('refresh');
    });

    $('#special2').on('click', function () {
      mySelect.find('option:disabled').prop('disabled', false);
      mySelect.selectpicker('refresh');
    });

    $('#basic2').selectpicker({
      liveSearch: true,
      maxOptions: 1
    });
	
	$('.header-slider').slick({
	  dots: false,
	  arrows: false,
	  infinite: true,
	  speed: 800,
	  fade: true,
	  cssEase: 'linear',
	  autoplay:true,
	  autoplaySpeed: 7000,
	});
	
	if($('#galleria').length > 0){
		// Load the classic theme
		Galleria.loadTheme('../../js/plugins/gallaria/galleria.classic.min.js');
		// Initialize Galleria
		Galleria.run('#galleria');
	}

	function toggleIcon(e) {
		$(e.target)
			.prev('.panel-heading')
			.find(".more-less")
			.toggleClass('fa-caret-down fa-caret-right');
		}
		$('.panel-group').on('hidden.bs.collapse', toggleIcon);
		$('.panel-group').on('shown.bs.collapse', toggleIcon);
	
	$(document).on('click', 'a[href^="#"]', function(e) {
		// target element id
		var id = $(this).attr('href');
		// target element
		var $id = $(id);
		if ($id.length === 0) {
			return;
		}
		// prevent standard hash navigation (avoid blinking in IE)
		e.preventDefault();
		// top position relative to the document
		var pos = $id.offset().top;
		// animated top scrolling
		$('body, html').animate({scrollTop: pos}, 1000);
	});

  });
