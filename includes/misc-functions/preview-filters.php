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
 * Hook Previews to output for download posts
 *
 * @since    1.0.0
 * @link     http://moveplugins.com/doc/
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
 * @link     http://moveplugins.com/doc/
 * @see      get_post_meta()
 * @see      mp_core_oembed_get()
 * @param  	 array $args See link for description.
 * @return   void
 */
function mp_ecommerce_preview( $post_id ){
	
	//Get Preview Type
	$preview_type = get_post_meta($post_id, 'preview_media_type_1', true);
	
	//Set default for preview output
	$preview_output = NULL;
	
	//Get the right preview output that is hooked here
	$preview_output = apply_filters( 'mp_ecommerce_preview_output', $preview_output, $preview_type, $post_id );
			
	// Add preview to the beginning of content output
	return $preview_output;
}

/**
 * Show Video for Preview
 *
 * @since    1.0.0
 * @link     http://moveplugins.com/doc/
 * @see      get_post_meta()
 * @see      mp_core_oembed_get()
 * @param  	 array $args See link for description.
 * @return   void
 */
function mp_ecommerce_preview_video_filter( $preview_output, $preview_type, $post_id ){

	//If this stack media type is set to be text	
	if ($preview_type == 'video'){
		
		//Set default value for $new_preview_output to NULL
		$new_preview_output = NULL;
		
		//Get video URL
		$preview_video_url = get_post_meta($post_id, 'preview_video_url', true);
		
		//Preview output
		if (!empty($preview_video_url)){
			
			$new_preview_output .= '<div class="mp-ecommerce-preview-video-container">' . mp_core_oembed_get( $preview_video_url, NULL, NULL ) . '</div>'; 
			
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
 * @link     http://moveplugins.com/doc/
 * @see      get_post_meta()
 * @see      mp_core_oembed_get()
 * @param  	 array $args See link for description.
 * @return   void
 */
function mp_ecommerce_preview_image_filter( $preview_output, $preview_type, $post_id ){
		
	//If this stack media type is set to be text	
	if ($preview_type == 'image'){
		
		//Set default value for $new_preview_output to NULL
		$new_preview_output = NULL;
		
		//Get video URL
		$preview_image_url = get_post_meta($post_id, 'preview_image_url', true);
		
		//Preview output
		if (!empty($preview_image_url)){
			
			$new_preview_output .= '<div class="mp-ecommerce-preview mp-ecommerce-preview-image-container"><img class="mp-ecommerce-preview-image" src="' . $preview_image_url . '" title="' . the_title_attribute( array( 'echo' => false ) ) . '" /></div>'; 
			
			
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
 * @link     http://moveplugins.com/doc/
 * @see      get_post_meta()
 * @see      mp_core_oembed_get()
 * @param  	 array $args See link for description.
 * @return   void
 */
function mp_ecommerce_preview_audio_filter( $preview_output, $preview_type, $post_id ){
		
	//If this stack media type is set to be text	
	if ($preview_type == 'audio'){
		
		//Set default value for $new_preview_output to NULL
		$new_preview_output = NULL;
		
		//Get video URL
		$preview_audio_string = get_post_meta($post_id, 'preview_audio', true);
		
		//Preview output
		if (!empty($preview_audio_string)){
			
			$new_preview_output .= '<div class="mp-ecommerce-preview mp-ecommerce-preview-image-container">' . mp_player( $post_id, 'preview_audio' ) . '</div>'; 
			
		}
		
		//Return the video output string
		return $new_preview_output;
		
	}
	
	//Return the incoming string unchanged
	return $preview_output;
	
}
add_filter( 'mp_ecommerce_preview_output' , 'mp_ecommerce_preview_audio_filter', 10, 3 );