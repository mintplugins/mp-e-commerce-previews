<?php
/**
 * This file contains various functions hooked to filters for outputting the preview
 *
 * @since 1.0.0
 *
 * @package    MP E-Commerce Previews
 * @subpackage Functions
 *
 * @copyright  Copyright (c) 2013, Move Plugins
 * @license    http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @author     Philip Johnston
 */

/**
 * Show Youtube Player for Preview
 *
 * @since    1.0.0
 * @link     http://moveplugins.com/doc/
 * @see      get_post_meta()
 * @see      mp_core_oembed_get()
 * @param  	 array $args See link for description.
 * @return   void
 */
function mp_ecommerce_preview_youtube_player_filter( $preview_output, $options_array, $post_id ){

	//If this preview media type is set to be youtube player	
	if ($options_array['preview_type'] == 'youtube_player'){
		
		if ( isset( $options_array['popup'] )){
			
			//Set autoplay for wpecpv
			add_filter( 'mp_video_skinner_youtube_autoplay', function (){ return true; } );
		
		}

		//Get video URL
		$youtube_video_code = get_post_meta($post_id, 'preview_youtube_video', true);
		
		if ( isset( $options_array['popup'] )){
			
			$preview_output = mp_video_skinner( $youtube_video_code, 'simpleflat', array( 'autoplay' => 1 ) );
			
		}
		else{
			$preview_output = mp_video_skinner( $youtube_video_code, 'simpleflat', array( 'autoplay' => 0 ) );
		}
			
	}
	
	//Return the incoming string unchanged
	return $preview_output;
	
}
add_filter( 'mp_ecommerce_preview_output' , 'mp_ecommerce_preview_youtube_player_filter', 10, 3 );