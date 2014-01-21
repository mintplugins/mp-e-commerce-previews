jQuery(document).ready(function($){
	
	$( '.archive article' ).mouseenter(function() {
		
		$(".mp-eccomerce-previews-popup" ).detach();
		
		var thisdiv = $(this);
		
		//Set delay so if the user is moving quickly they dont get multiple running at once
		timer = setTimeout(function () {
   			
			var post_id = thisdiv.attr('id').split("post-");
			var post_id = post_id[1];
			
			var postData = {
				action: 'mp_ecommerce_preview_ajax_popup',
				post_id: post_id      // We pass php values differently!
			};
					
			$.ajax({
				type: "POST",
				data: postData,
				url: mp_ecommerce_previews_ajax.ajaxurl,
				success: function (response) {
					var popup = $('<div class="mp-eccomerce-previews-popup">' + response + '</div>').prependTo(thisdiv);	
					
					this.iid = setInterval(function() {			
					
					var thisdiv_position = thisdiv.position();
					var holder_position = thisdiv.parent().position();
					
					//X Positions for the Article div
					xpos_left_article = thisdiv_position.left;		
					xpos_right_article = xpos_left_article + thisdiv.width();		
					
					//Y Positions for the Article div
					ypos_top_article = thisdiv_position.top;		
					ypos_bottom_article = ypos_top_article + thisdiv.height();		
					
					//X Positions for the Holder Parent div
					xpos_left_holder = holder_position.left;		
					xpos_right_holder = xpos_left_holder + thisdiv.parent().width();
					
					popup_width = popup.width();	
													
					//alert(xpos_right_holder);
					//alert(thisdiv.parent().width());
					//alert (popup_width);
							
					//Find appropriate X Pos
					if ( (xpos_right_article + popup_width) < xpos_right_holder ){
						//Position popup to the right
						popup.css({
							left: thisdiv.width(),
							visibility: 'visible'
						});
					}
					else{
						//Position popup to the left
						popup.css({
							left: -400,
							visibility: 'visible'
						});
					}
					
					//Find appropriate Y Pos
					//If the y position at the botton of this div is less than the y position at the bottom if the screen right now
					if ( ypos_bottom_article < window.pageYOffset + $(window).height() ){
						
						//Height of popup in half
						var half_height_popup = popup.height() / 2;
						
						//Position popup in the middle
						popup.css({
							top: ((thisdiv.height() - 90) / 2) - ( half_height_popup ),
							visibility: 'visible'
						});
					}
					else if( thisdiv_position.top + thisdiv.height() < window.pageYOffset + $(window).height() ){
						//Position popup above
						popup.css({
							//top: (thisdiv.height() / 2) - $('.mp-eccomerce-previews-popup').height()
							visibility: 'visible'
						});
					}
		    
					}, 25);
					
				}
			}).fail(function (data) {
				console.log(data);
			});	
					
        }, 400);
	
	})
	.mouseleave(function() {
		clearTimeout(timer);
		$( this ).find( ".mp-eccomerce-previews-popup" ).detach();
	});
	
	$( '.archive article' ).mouseover(function() {
		//$('.mp-eccomerce-previews-popup').offset({
		//   left:  e.pageX + 10,
		 //  top:   e.pageY + 20
		//});
		
		var thisdiv = $(this);
		
		
						
	});

});