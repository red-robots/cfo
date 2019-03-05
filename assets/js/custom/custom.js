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
	*	Equal Heights Divs
	*
	------------------------------------*/
	$('.js-blocks').matchHeight();
	$('.footer-menu-wrap .menu > li > a').matchHeight();

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

	/* POP-UP STAFF DETAILS */
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
				$(".ml-loader-wrap").show();
			},
			success : function( response ) {
				if(response.content) {
					var content = response.content;
					$('body').append(content);
					$('body').addClass('modal-open');
					$(".ml-loader-wrap").hide();
				} 
			}
		});
	});


	/* Pop-up Page Content */
	//var popup_pages = ['privacy-policy','terms-of-use','disclaimer','disclosures'];
	$('#colophon-menu a').on("click",function(e){
		var page_url = $(this).attr('href');
		var slug = $(this).attr('data-slug');
		if(slug) {
			e.preventDefault();
			//if($.inArray(slug, popup_pages) !== -1) {
				$.ajax({
					url : frontajax.ajaxurl,
					type : 'post',
					dataType : "json",
					data : {
						action : 'get_the_page_content',
						post_name : slug
					},
					beforeSend:function(){
						$(".ml-loader-wrap").show();
					},
					success : function( response ) {
						if(response.content) {
							var content = response.content;
							$('body').append(content);
							$('body').addClass('modal-open');
							$(".ml-loader-wrap").hide();
						} 
					}
				});
			//}
		} 
	});


	resize_contentdiv();

	$( window ).resize(function() {
	  resize_contentdiv();
	});

	function resize_contentdiv() {
		if( $(".popup_wrapper").length>0 ) {
			var wrapHeight = $(".popup_wrapper .details").outerHeight();
			$(".popup_wrapper .details .inner").css('height',wrapHeight+'px');
			//var insideDiv = $(".popup_wrapper .inside").outerHeight();
			//$(".popup_wrapper .contentwrap").css('height',insideDiv+'px');
		}
	}

	$(document).on("click","#closePopup",function(e){
		e.preventDefault();
		$('body').removeClass('modal-open');
		$(".popup_wrapper").fadeOut("fast",function(){
			$(this).remove();
		});
	});

	$(document).mouseup(function(e)  {
	    var container = $(".ajax_contentdiv");
	    if (!container.is(e.target) && container.has(e.target).length === 0)  {
	        $('body').removeClass('modal-open');
			$(".popup_wrapper").fadeOut("fast",function(){
				$(this).remove();
			});
	    }
	});


	$(document).keyup(function(e) {
	    if (e.key === "Escape") { // escape key maps to keycode `27`
			if( $(".popup_wrapper").length>0 ) {
				$('body').removeClass('modal-open');
				$(".popup_wrapper").fadeOut("fast",function(){
					$(this).remove();
				});
			}
	    }
	});

	/* Archive Pagination */
	$(document).on("click","#archive_pagination a",function(e){
		e.preventDefault();
		e.preventDefault();
    	var page_url = $(this).attr('href');
    	window.history.replaceState( null, null, page_url );
    	//$('.divspinner').fadeIn();
    	setTimeout(function(){
    		$('#js_reload').load(page_url + " .post-sidebar-content",function(){
    			//$('.divspinner').fadeOut();
    		});
    	},400);
	});


});// END #####################################    END