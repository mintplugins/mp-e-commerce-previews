<?php
/**
 * This file contains various functions
 *
 * @since 1.0.0
 *
 * @package    MP Ecommerce Previews
 * @subpackage Functions
 *
 * @copyright  Copyright (c) 2014, Mint Plugins
 * @license    http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @author     Philip Johnston
 */

/**
 * Ajax callback which displays the Ecommerce Preview
 *
 * @since    1.0.0
 * @link     http://mintplugins.com/doc/
 * @see      function_name()
 * @param  	 array $args See link for description.
 * @return   void
 */
function mp_ecommerce_preview_ajax_popup_callback() {
	
	//Get Post id
	$post_id = intval( $_POST['post_id'] );
	
	//Set autoplay in options array to true
	$options_array['popup'] = true;
	
	//Get mp_ecommerce_preview_data
	echo mp_ecommerce_preview( $post_id, $options_array );
		
	exit;
}
add_action( 'wp_ajax_mp_ecommerce_preview_ajax_popup', 'mp_ecommerce_preview_ajax_popup_callback' );
add_action( 'wp_ajax_nopriv_mp_ecommerce_preview_ajax_popup', 'mp_ecommerce_preview_ajax_popup_callback' );

/**
 * Allow video file types in edd uploads
 *
 * @since    1.0.0
 * @link     http://mintplugins.com/doc/
 * @see      function_name()
 * @param  	 array $args See link for description.
 * @return   void
 */
function mp_ecommerce_previews_edd_custom_modify_htaccess_rules( $rules, $method ) {
	
	switch( $method ) :
 
		case 'redirect' :
			// Prevent directory browsing
			$rules = "Options -Indexes";
			break;
 
		case 'direct' :
		default :
			// Prevent directory browsing and direct access to all files, except images (they must be allowed for featured images / thumbnails)
			$rules = "Options -Indexes\n";
			$rules .= "deny from all\n";
			$rules .= "<FilesMatch '\.(jpg|png|gif|ogg|m4v|mp4)$'>\n";
			    $rules .= "Order Allow,Deny\n";
			    $rules .= "Allow from all\n";
			$rules .= "</FilesMatch>\n";
			break;
 
	endswitch;
 
	return $rules;
}
add_filter( 'edd_protected_directory_htaccess_rules', 'mp_ecommerce_previews_edd_custom_modify_htaccess_rules', 10, 2 );

//Add the popup element class to posts that should have it
function mpecpv_add_popup_elem_class( $classes, $class, $ID ){
	
	$options_array['preview_type'] = apply_filters( 'mp_ecommerce_preview_type', get_post_meta($ID, 'preview_media_type_1', true), $post_id );
	
	//Get the preview output that is hooked here
	$mp_ecommerce_preview_output = apply_filters( 'mp_ecommerce_preview_output', '', $options_array, $ID );
	
	//If there is something to pop up, add the popup class
	if ( !empty($mp_ecommerce_preview_output) ){
		$classes['mpecpv_popup_elem'] = 'mp-ecommerce-preview-popup-element';	
	}

	return $classes;
}
add_filter( 'post_class', 'mpecpv_add_popup_elem_class', 10, 3 );