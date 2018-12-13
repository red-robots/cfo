/**
 *	Custom jQuery Scripts
 *	
 *	Developed by: Austin Crane	
 *	Designed by: Austin Crane
 */

jQuery(document).ready(function ($) {
	
	$(window).scroll(function(){
        if ( $(this).scrollTop() > 100 ) {
            $('.scrollup').fadeIn();
            $('body').addClass('scrolled');
        } else {
            $('.scrollup').fadeOut();
            $('body').removeClass('scrolled');
        }
    }); 

	/*
        FAQ dropdowns
	__________________________________________
	*/
	$('.question').click(function() {
	 
	    $(this).next('.answer').slideToggle(500);
	    $(this).toggleClass('close');
	    $(this).find('.plus-minus-toggle').toggleClass('collapsed');
	    $(this).parent().toggleClass('active');
	 
	});

	/*
	*
	*	Responsive iFrames
	*
	------------------------------------*/
	var $all_oembed_videos = $("iframe[src*='youtube']");
	
	$all_oembed_videos.each(function() {
	
		$(this).removeAttr('height').removeAttr('width').wrap( "<div class='embed-container'></div>" );
 	
 	});
	
	/*
	*
	*	Flexslider
	*
	------------------------------------*/
	$('.flexslider').flexslider({
		animation: "slide",
	}); // end register flexslider
	
	/*
	*
	*	Colorbox
	*
	------------------------------------*/
	$('a.gallery').colorbox({
		rel:'gal',
		width: '80%', 
		height: '80%'
	});
	
	/*
	*
	*	Isotope with Images Loaded
	*
	------------------------------------*/
	var $container = $('#container').imagesLoaded( function() {
  	$container.isotope({
    // options
	 itemSelector: '.item',
		  masonry: {
			gutter: 15
			}
 		 });
	});

	/*
	*
	*	Smooth Scroll to Anchor
	*
	------------------------------------*/
	//  $('a').click(function(){
	//     $('html, body').animate({
	//         scrollTop: $('[name="' + $.attr(this, 'href').substr(1) + '"]').offset().top
	//     }, 500);
	//     return false;
	// });

	/*
	*
	*	Nice Page Scroll
	*
	------------------------------------*/
	// $(function(){	
	// 	$("html").niceScroll();
	// });
	
	
	/*
	*
	*	Equal Heights Divs
	*
	------------------------------------*/
	$('.js-blocks').matchHeight();

	/*
	*
	*	Wow Animation
	*
	------------------------------------*/
	new WOW().init();

	/* Mobile Menu */
	$(document).on("click",".menu-toggle",function(e){
		e.preventDefault();
		$(this).toggleClass('open');
		$('body').toggleClass('open-menu');
	});

	$("a.homebox").hover( function(){
		$(this).next().addClass('show fadeInUp');
	},function(){
		$(this).next().removeClass('show fadeInUp');
	});

	$('.team-list .team').on("click",function(){
		var post_id = $(this).attr('data-id');
		$.ajax({
			url : frontajax.ajaxurl,
			type : 'post',
			dataType : "json",
			data : {
				action : 'the_staff_info',
				post_id : post_id
			},
			beforeSend:function(){
				//$(".ml-loader-wrap").show();
			},
			success : function( response ) {
				if(response.content) {
					var content = response.content;
					$('body').append(content);
					$('body').addClass('modal-open');
					//$(".ml-loader-wrap").hide();
				} 
			}
		});
	});

	resize_contentdiv();

	$( window ).resize(function() {
	  resize_contentdiv();
	});

	function resize_contentdiv() {
		if( $(".popup_wrapper").length>0 ) {
			var wrapHeight = $(".popup_wrapper .details").outerHeight();
			$(".popup_wrapper .details .inner").css('height',wrapHeight+'px');
		}
	}

	$(document).on("click","#closePopup,.popupbg",function(e){
		e.preventDefault();
		$('body').removeClass('modal-open');
		$(".popup_wrapper").fadeOut("fast",function(){
			$(this).remove();
		});
	});


});// END #####################################    END