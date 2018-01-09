(function ($) {
	
	if($(".select2").length > 0){
		$(".select2").select2();
	}
	
    $('#statelisting').DataTable({
      "paging": true,      
      "ordering": true,
      "info": true,
	  "aoColumnDefs": [
		  { 'bSortable': false, 'aTargets': [ 3 ] }
	  ]	
    });
	$('#citylisting').DataTable({
	  "aoColumnDefs": [
		  { 'bSortable': false, 'aTargets': [ 4 ] }
	  ]	
    });
	$('#cmslisting').DataTable({     
	  "aoColumnDefs": [
		  { 'bSortable': false, 'aTargets': [ 7 ] }
	  ]	
    });
	$('#propertylisting').DataTable({     
	  "aoColumnDefs": [
		  { 'bSortable': false, 'aTargets': [ 8 ] }
	  ]	
    });
	
	$('#contactlisting').DataTable({ });
	
	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')
		}
    });
	
	//Replace the <textarea id="cms_page_content"> with a CKEditor
    // instance, using default configuration.
	if($(".cms_page_content").length > 0){
		CKEDITOR.replace('cms_page_content');
		CKEDITOR.config.allowedContent = true;
	}
	
})(jQuery);

function generaldelete_confirm(id, controller, table, field)
{
	if(controller == 'dashboard'){
		var deleteconfirm = confirm('Are you sure you want to delete this banner image?');
	}
	else{
		var deleteconfirm = confirm('Are you sure you want to delete this '+controller+' and all informaion related to that?');
	}
	
	if(deleteconfirm == true){
		location.href = hosturl+'/admin/delete/'+controller+'/'+table+'/'+field+'/'+id;
		return true;
	}
	else{
		return false;
	}
}

function validatecontactform(formid)
{
	var formfields = $("#"+formid).serializeArray();
	//alert(formfields); return false;
	var i = 0;
	$.each(formfields, function(index, element) {
		var key = element.name;
		var value = element.value;
		
		if(key == 'g-recaptcha-response' && (value == '' || value == null)){
			if($(".g-recaptcha span.error").length == 0){
				$(".g-recaptcha").append('<span class="error">Please select captcha</span>');
			}
			i++;
		}
	  	else if(value == '' || value == null){
			$("input[name="+key+"], textarea[name="+key+"]").parent('.element-box').addClass('error');
			i++;	
		}
		else{
			if(key == 'email'){
				var emailregex = /^\b[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}\b$/;	
				if(!emailregex.test(value)){
					$("input[name="+key+"]").parent('.element-box').addClass('error');
					i++;	
				}
				else{
					$("input[name="+key+"]").parent('.element-box').removeClass('error');
				}
			}
			else if(key == 'phone')
			{
				var phoneregex = /^[0-9-+() ]{4,25}$/;
				if(!phoneregex.test(value)){
					$("input[name="+key+"]").parent('.element-box').addClass('error');
					i++;	
				}
				else{
					$("input[name="+key+"]").parent('.element-box').removeClass('error');
				}	
			}
			else{

				$("input[name="+key+"], textarea[name="+key+"]").parent('.element-box').removeClass('error');
				$(".g-recaptcha span.error").remove();
			}
		}
	});
	
	if(i == 0)
	{
		$(".loader-image").show();
		$("input[name='submit']").attr('disabled','disabled');
		$.ajax({
			type: "POST",
			url: ajaxurl,
			data: formfields,
			//dataType: 'JSON',
			success: function(result){
				//alert(result);
				//return false; 
				$(".loader-image").hide();
				$("input[name='submit']").removeAttr('disabled','disabled');
				if(result == 1){	
					$("input[class='input-material']").val('');
					$("textarea").html(''); $("textarea").val(''); $("textarea").text(''); $('textarea').empty();
					$(".element-box").removeClass('focused-state');
					$(".contactresponce-message").html('Success! Your Inquiry has been sent successfully.').show();	
					setTimeout(function(){ window.location = homeurl+'/thankyou'; }, 5000);
				}
				else if(result == 'Invalid Captcha'){
					$(".g-recaptcha").append('<span class="error">Please select captcha</span>');
				}
				else{
					$(".contactresponce-message").html('Error! There are some error occured to sent your inquiry. Please try after some time.').show();
					$(".g-recaptcha").remove('span.error');
				}
				setTimeout(function(){ $(".contactresponce-message").html('').hide(); }, 5000);
			},
			error : function(jqXHR, textStatus, errorThrown) {
				$(".loader-image").hide();
				$("input[name='submit']").removeAttr('disabled','disabled');
				$(".contactresponce-message").html('Error! '+errorThrown+'.').show();
				//console.log(jqXHR + " :: " + textStatus + " :: " + errorThrown);
				setTimeout(function(){ $(".contactresponce-message").html('').hide(); }, 5000);
			}
		});
	}
	return false;
}

