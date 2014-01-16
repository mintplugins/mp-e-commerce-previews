jQuery(document).ready(function($){
	
	function mp_ecommerce_previews_reset_media_types(){
		//Hide media type metaboxes by looping through each item in the drodown
		var values = $("#mp_ecommerce_previews_media_select_metabox .preview_media_type_1>option").map(function() { 
			
			//Hide metaboxes with the matching name to this select item
			$('#mp_ecommerce_previews_' + $(this).val() + '_metabox').css('display', 'none');	
				
		});
	
		//Show correct media type metaboxes by looping through each item in the 1st drodown
		var values = $("#mp_ecommerce_previews_media_select_metabox .preview_media_type_1>option:selected").map(function() { 
			
			//Hide metaboxes with the matching name to this select item
			$('#mp_ecommerce_previews_' + $(this).val() + '_metabox').css('display', 'block');	
			
			//Move metabox to the top of the metaboxes
			$('#mp_ecommerce_previews_media_select_metabox').after($('#mp_ecommerce_previews_' + $(this).val() + '_metabox'));
			
		});
		
	}
	
	mp_ecommerce_previews_reset_media_types();
	
	$('#mp_ecommerce_previews_media_select_metabox .preview_media_type_1').change(function() {
		mp_ecommerce_previews_reset_media_types();
	});

});