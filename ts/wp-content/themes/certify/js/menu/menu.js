	jQuery(document).ready(function() {
		
	   jQuery('.nav li.dropdown').hover(function() {
		   jQuery(this).addClass('open');
	   }, function() {
		   jQuery(this).removeClass('open');
	   }); 
	   
	});
	
	//For header fix
	
	if(jQuery(window).width() >= 991){
		jQuery(window).scroll(function(){
			if (jQuery(window).scrollTop() >= 100) {
				   jQuery('.overlaped-navigation').addClass('stiky-header animated fadeInDown');
			}
			else {
				   jQuery('.overlaped-navigation').removeClass('stiky-header animated fadeInDown');
			}
		});
	}
	