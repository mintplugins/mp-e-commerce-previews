jQuery(document).ready(function($){
	
	//Show the Preview Types that should be shown
	function mp_ecommerce_previews_reset_preview_types(){
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
	
	//Set them on page load
	mp_ecommerce_previews_reset_preview_types();
	
	//Set them when the select field is changed
	$('#mp_ecommerce_previews_media_select_metabox .preview_media_type_1').change(function() {
		mp_ecommerce_previews_reset_preview_types();
	});
	
	//When the Media Player's Filetype is changed
	$(document.body).on('change', '#mp_ecommerce_previews_media_player_metabox select.mp_repeater', function() {
	
		//Get this fields repeater number
		var id = $(this).attr('name').split("[");
		var id = id[1].split("]");
		var id = id[0];
		
		//Call function which resets filetypes for Media Player
		//reset_media_player_filetypes(id, $(this))
		
	});
	
	$('#mp_ecommerce_previews_media_player_metabox select.mp_repeater').each(function() {
		
		//Get this fields repeater number
		var id = $(this).attr('name').split("[");
		var id = id[1].split("]");
		var id = id[0];
		
		//Call function which resets filetypes for Media Player
		//reset_media_player_filetypes(id, $(this));
	});
	
	//Reset filetypes shown for Media Player
	function reset_media_player_filetypes(id, select_object){
		
		//Looping through each selected item in the select object
		var values = select_object.find("option:selected").map(function() { 
			
			
			//Show fields for this filetype
			if ( $(this).val() == 'video' ){
									
				//Show in-use types
				$('.mp_field_preview_media_playerAAAAA' + id + 'BBBBBAAAAAtitleBBBBB').css('display', 'block' );	
				$('.mp_field_preview_media_playerAAAAA' + id + 'BBBBBAAAAAartistBBBBB').css('display', 'block' );
				$('.mp_field_preview_media_playerAAAAA' + id + 'BBBBBAAAAAposterBBBBB').css('display', 'block' );	
				$('.mp_field_preview_media_playerAAAAA' + id + 'BBBBBAAAAAm4vBBBBB').css('display', 'block' );
				
				//Hide non-use types
				$('.mp_field_preview_media_playerAAAAA' + id + 'BBBBBAAAAAmp3BBBBB').css('display', 'none' );	
			
			}
			
			//Show fields for this filetype
			else if ( $(this).val() == 'audio' ){
									
				//Show in-use types
				$('.mp_field_preview_media_playerAAAAA' + id + 'BBBBBAAAAAtitleBBBBB').css('display', 'block' );	
				$('.mp_field_preview_media_playerAAAAA' + id + 'BBBBBAAAAAartistBBBBB').css('display', 'block' );
				$('.mp_field_preview_media_playerAAAAA' + id + 'BBBBBAAAAAmp3BBBBB').css('display', 'block' );	
				
				//Hide in-use types
				$('.mp_field_preview_media_playerAAAAA' + id + 'BBBBBAAAAAposterBBBBB').css('display', 'none' );	
				$('.mp_field_preview_media_playerAAAAA' + id + 'BBBBBAAAAAm4vBBBBB').css('display', 'none' );
			
			}
			else{
				
				//Hide all types
				//Show in-use types
				$('.mp_field_preview_media_playerAAAAA' + id + 'BBBBBAAAAAtitleBBBBB').css('display', 'none' );	
				$('.mp_field_preview_media_playerAAAAA' + id + 'BBBBBAAAAAartistBBBBB').css('display', 'none' );
				$('.mp_field_preview_media_playerAAAAA' + id + 'BBBBBAAAAAmp3BBBBB').css('display', 'none' );	
				$('.mp_field_preview_media_playerAAAAA' + id + 'BBBBBAAAAAposterBBBBB').css('display', 'none' );	
				$('.mp_field_preview_media_playerAAAAA' + id + 'BBBBBAAAAAm4vBBBBB').css('display', 'none' );
			}
	
		});
	}
	
});