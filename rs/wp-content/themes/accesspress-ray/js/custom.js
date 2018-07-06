jQuery(function($){
  $('.event-slider').lightSlider({
        item:3,
        loop:false,
        slideMove:3,
        easing: 'cubic-bezier(0.25, 0, 0.25, 1)',
        speed:600,
        enableDrag: false,
        controls: false,
        responsive : [
            {
                breakpoint:900,
                settings: {
                    item:3,
                    slideMove:3,
                    slideMargin:6,
                  }
            },
            {
                breakpoint:767,
                settings: {
                    item:5,
                    slideMove:1
                  }
            },
            {
                breakpoint:500,
                settings: {
                    item:1,
                    slideMove:1
                  }
            }
        ]
    });

  $('.testimonial-slider').bxSlider({
   auto:true,
   mode:'fade',
   controls:'true',
   speed:1000
  });

  $(window).resize(function(){
    $('.slider-caption').each(function(){
    var cap_height = $(this).actual( 'outerHeight' );
    $(this).css('margin-top',-(cap_height/2));
    });
    }).resize();
    
  $('.caption-description').each(function(){
    $(this).find('a').appendTo($(this).parent('.ak-container'));
  });
  

  $('.commentmetadata').after('<div class="clear"></div>');

  $('.menu-toggle').click(function(){
    $('#site-navigation .menu').slideToggle('slow');
  });
    
    $('.gallery .gallery-item a').each(function(){
        $(this).addClass('fancybox-gallery').attr('data-lightbox-gallery','gallery');
    });
    
    $(".fancybox-gallery").nivoLightbox();


  $('.search-icon .fa-search').click(function(){
    $('.ak-search').fadeToggle();
  });

  $(window).bind('load',function(){
  $('.slider-wrap .slides').each(function(){
    $(this).prepend('<div class="overlay"></div>');
  });
  });

 });
