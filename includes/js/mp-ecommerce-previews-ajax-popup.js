jQuery(document).ready(function($){
	
	var mp_ecpv_request;
	
	$( '.archive article' ).bind('mp_ecpv_ajax_popup', function() {
		
		$(".mp-eccomerce-previews-popup" ).detach();
		
		$(this).prepend('<div class="mp-eccomerce-previews-loading">loading...</div>');
				
		var thisdiv = $(this);
		
		//Set delay so if the user is moving quickly they dont get multiple running at once
		//timer = setTimeout(function () {
   			
			var post_id = thisdiv.attr('id').split("post-");
			var post_id = post_id[1];
			
			var postData = {
				action: 'mp_ecommerce_preview_ajax_popup',
				post_id: post_id      // We pass php values differently!
			};
					
			mp_ecpv_request = $.ajax({
				type: "POST",
				data: postData,
				url: mp_ecommerce_previews_ajax.ajaxurl,
				success: function (response) {
					thisdiv.find('.mp-eccomerce-previews-loading').remove();
					var popup = $('<div class="mp-eccomerce-previews-popup">' + response + '</div>').prependTo(thisdiv);	
										
					var thisdiv_position = thisdiv.offset();
					var holder_position = thisdiv.parent().offset();
					
					//X Positions for the Article div
					xpos_left_article = thisdiv_position.left;		
					xpos_right_article = xpos_left_article + thisdiv.width();		
					
					//Y Positions for the Article div
					ypos_top_article = thisdiv_position.top;		
					ypos_bottom_article = ypos_top_article + thisdiv.height();		
					
					//X Positions for the Holder Parent div
					xpos_left_holder = holder_position.left;
					xpos_right_holder = xpos_left_holder + thisdiv.parent().width();
					
					//Width of the popup
					popup_width = popup.width();	
					popup_height = popup.height();	
																					
					//Find appropriate X Pos
					//If there is enough space to the right 
					if ( (xpos_right_article + popup_width) < xpos_right_holder ){
						//Position popup to the right 
						popup.css({
							left: thisdiv.width(),
							visibility: 'visible',
							opacity:1
						});
						
						
					}
					//If there is enough space to the left 
					else if ( (xpos_left_article - popup_width) > xpos_left_holder ){
						
						//Position popup to the left 
						popup.css({
							left: -popup_width,
							visibility: 'visible',
							opacity:1
						});
					}
					else{
						//Position popup directory centered over
						popup.css({
							left: ( thisdiv.width() /2 ) - ( popup_width /2 ),
							visibility: 'visible',
							width: thisdiv.width(),
						});
					}
					
					//Find appropriate Y Pos
					//If this entire article is in view
					if ( ypos_bottom_article < window.pageYOffset + $(window).height() && ypos_top_article > window.pageYOffset ){
						
						//Height of popup in half
						var half_height_popup = popup.height() / 2;
						
						//Position popup in the vertical middle of the article
						popup.css({
							top: ((thisdiv.height()) / 2) - ( half_height_popup ),
							visibility: 'visible',
							opacity:1
						});
					}
					//If the top of the article is cut-off
					else if( ypos_bottom_article < window.pageYOffset + $(window).height() && ypos_top_article < window.pageYOffset ){
						
						//Position popup below
						popup.css({
							top: (thisdiv.height()),
							visibility: 'visible',
							opacity:1
						});
					}
					//If the bottom of the article is cut-off
					else if( ypos_bottom_article > window.pageYOffset + $(window).height() && ypos_top_article > window.pageYOffset ){
						
						//Position popup above
						popup.css({
							top: -popup_height,
							visibility: 'visible',
							opacity:1
						});
					}
								
				}
			}).fail(function (data) {
				console.log(data);
			});	
					
      //  }, 500);
	
	});
	
	var timeout;
    $('.archive article').mouseenter(function(e) {
        var self = this;
        clearTimeout(timeout);
        timeout = setTimeout(function() {
            $(self).trigger('mp_ecpv_ajax_popup')
        }, 500);
    });
    $('.archive article').mouseleave(function() {
        if (mp_ecpv_request) {
            mp_ecpv_request.abort();
            mp_ecpv_request = null;
        }
        $( 'body' ).find( ".mp-eccomerce-previews-popup" ).detach();
		$(this).find('.mp-eccomerce-previews-loading').remove();
    });

});