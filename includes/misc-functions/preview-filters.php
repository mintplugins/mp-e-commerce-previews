<?php
/**
 * This file contains various functions hooked to filters for outputting the preview
 *
 * @since 1.0.0
 *
 * @package    MP E-Commerce Previews
 * @subpackage Functions
 *
 * @copyright  Copyright (c) 2014, Mint Plugins
 * @license    http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @author     Philip Johnston
 */

/**
 * Hook Previews to output for download posts
 *
 * @since    1.0.0
 * @link     http://mintplugins.com/doc/
 * @see      get_post_meta()
 * @see      mp_core_oembed_get()
 * @param  	 array $args See link for description.
 * @return   void
 */
function mp_ecommerce_preview_content_hook( $content ){
	
	//If this theme doesn't handle 'mp_ecommerce_previews' itself AND we are on a download single page
	if ( !get_theme_support( 'mp_ecommerce_previews' ) && is_singular( array( 'download' ) ) ){
		
		//Get post info
		global $post;
		
		//Return the preview ahead of the content
		return mp_ecommerce_preview( $post->ID ) . $content;
		
	}

    // Returns the content.
    return $content;
}
add_filter( 'the_content', 'mp_ecommerce_preview_content_hook' );

/**
 * return EDD Preview Output
 *
 * @since    1.0.0
 * @link     http://mintplugins.com/doc/
 * @see      get_post_meta()
 * @see      mp_core_oembed_get()
 * @param  	 array $args See link for description.
 * @return   void
 */
function mp_ecommerce_preview( $post_id, $options_array = NULL ){
	
	//Get Preview Type
	$options_array['preview_type'] = apply_filters( 'mp_ecommerce_preview_type', get_post_meta($post_id, 'preview_media_type_1', true), $post_id );
	
	//Get the right preview output that is hooked here
	$mp_ecommerce_preview_output = apply_filters( 'mp_ecommerce_preview_output', '', $options_array, $post_id );
	
	if ( empty( $mp_ecommerce_preview_output ) ){
		return;	
	}
	
	//Get custom classes to use for the container
	$custom_container_class = apply_filters('mp_ecommerce_preview_container_class', '', $post_id);
	
	//Set opening for mp ecommerce preview
	$preview_output = '<div class="mp-ecommerce-preview ' . $custom_container_class . '">';
		
		//Allow for child themes/plugins to hook content before - like watermarks
		$preview_output .= apply_filters( 'mp_ecommerce_preview_output_before', '', $options_array, $post_id );
		
			$preview_output .= '<div class="mp-ecommerce-preview-container mp-ecommerce-preview-' . $options_array['preview_type'] . '-container">';
				
				//Get the right preview output that is hooked here
				$preview_output .= $mp_ecommerce_preview_output;
				
			$preview_output .= '</div>';
		
		//Allow for child themes/plugins to hook content after - like watermarks
		$preview_output .= apply_filters( 'mp_ecommerce_preview_output_after', '', $options_array, $post_id );
	
	//Set closing
	$preview_output .= '</div>';
			
	// Add preview to the beginning of content output
	return $preview_output;
}

/**
 * Show Video for Preview
 *
 * @since    1.0.0
 * @link     http://mintplugins.com/doc/
 * @see      get_post_meta()
 * @see      mp_core_oembed_get()
 * @param  	 array $args See link for description.
 * @return   void
 */
function mp_ecommerce_preview_video_filter( $preview_output, $options_array, $post_id ){

	//If this stack media type is set to be text	
	if ($options_array['preview_type'] == 'video'){
		
		//Set default value for $new_preview_output to NULL
		$new_preview_output = NULL;
		
		//Get video URL
		$preview_video_url = get_post_meta($post_id, 'preview_video_url', true);
		
		//Preview output
		if (!empty($preview_video_url)){
			
			$new_preview_output .= mp_core_oembed_get( $preview_video_url, NULL, NULL ); 
			
		}
		
		//Return the video output string
		return $new_preview_output;
		
	}
	
	//Return the incoming string unchanged
	return $preview_output;
	
}
add_filter( 'mp_ecommerce_preview_output' , 'mp_ecommerce_preview_video_filter', 10, 3 );

/**
 * Show Image for Preview
 *
 * @since    1.0.0
 * @link     http://mintplugins.com/doc/
 * @see      get_post_meta()
 * @param  	 array $args See link for description.
 * @return   void
 */
function mp_ecommerce_preview_image_filter( $preview_output, $options_array, $post_id ){
		
	//If this stack media type is set to be text	
	if ($options_array['preview_type'] == 'image'){
		
		//Set default value for $new_preview_output to NULL
		$new_preview_output = NULL;
		
		//Get video URL
		$preview_image_url = get_post_meta($post_id, 'preview_image_url', true);
		
		//Preview output
		if (!empty($preview_image_url)){
			
			$new_preview_output .= '<img class="mp-ecommerce-preview-image" src="' . $preview_image_url . '" title="' . the_title_attribute( array( 'echo' => false ) ) . '" />'; 
			
			
		}
		
		//Return the video output string
		return $new_preview_output;
		
	}
	
	//Return the incoming string unchanged
	return $preview_output;
	
}
add_filter( 'mp_ecommerce_preview_output' , 'mp_ecommerce_preview_image_filter', 10, 3 );

/**
 * Show Audio for Preview
 *
 * @since    1.0.0
 * @link     http://mintplugins.com/doc/
 * @see      get_post_meta()
 * @see      mp_core_oembed_get()
 * @param  	 array $args See link for description.
 * @return   void
 */
function mp_ecommerce_preview_media_player_filter( $preview_output, $options_array, $post_id ){
		
	//If this stack media type is set to be text	
	if ( $options_array['preview_type'] == 'media_player' ){
		
		//Set default value for $new_preview_output to NULL
		$new_preview_output = NULL;
		
		//Get video URL
		$preview_media_player_string = get_post_meta($post_id, 'preview_media_player', true);
						
		//Preview output - only output if a media type has been passed
		if (!empty($preview_media_player_string[0]['mp3']) || !empty($preview_media_player_string[0]['m4v']) || !empty($preview_media_player_string[0]['ogv']) || !empty($preview_media_player_string[0]['webmv'])){
			
			if ( isset( $options_array['popup'] ) || isset( $options_array['autoPlay'] )){
				
				$new_preview_output .= mp_player( $post_id, 'preview_media_player', array('autoPlay' => 1) ); 
			}
			else{
				
				$new_preview_output .= mp_player( $post_id, 'preview_media_player' ); 
			}
			
			
		}
		
		//If there is nothing returned from the mp_player, this is likely an unfinished jingle so return the default track (if there is one)
		if ( empty( $new_preview_output ) ){
						
			$preview_media_player_string = apply_filters( 'mp_ecomm_preview_default_media_player_array', NULL, $post_id );
			
			if ( isset( $options_array['popup'] ) || isset( $options_array['autoPlay'] )){
				
				$new_preview_output .= mp_player( $post_id, $preview_media_player_string, array('autoPlay' => 1) ); 
			}
			else{
				
				$new_preview_output .= mp_player( $post_id, $preview_media_player_string ); 
			}
			
		}
		
		//Return the video output string
		return $new_preview_output;
		
	}
	
	//Return the incoming string unchanged
	return $preview_output;
	
}
add_filter( 'mp_ecommerce_preview_output' , 'mp_ecommerce_preview_media_player_filter', 10, 3 );