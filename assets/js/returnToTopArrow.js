// ===== Scroll to Top ==== 
jQuery(document).ready(function($){
	$(window).scroll(function() {
    	if ($(this).scrollTop() >= 300) {          // If page is scrolled more than 800px
        	$('#return-to-top').fadeIn('slow');    // Fade in the arrow
    	} else {
        	$('#return-to-top').fadeOut('slow');           // Else fade out the arrow
    }
	});
	$('#return-to-top').click(function() {                 // When arrow is clicked
    	$('body,html').animate({ scrollTop : 0 }, 300);   // Scroll to top of body                 
    	return false;
	});
});
