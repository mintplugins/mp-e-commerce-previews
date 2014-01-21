<?php
/**
 * This file contains various functions
 *
 * @since 1.0.0
 *
 * @package    MP Ecommerce Previews
 * @subpackage Functions
 *
 * @copyright  Copyright (c) 2013, Move Plugins
 * @license    http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @author     Philip Johnston
 */



function mp_ecommerce_preview_ajax_popup_callback() {
	
	//Get Post id
	$post_id = intval( $_POST['post_id'] );
		
	//Get mp_ecommerce_preview_data
	echo mp_ecommerce_preview( $post_id );
		
	die();
}
add_action( 'wp_ajax_mp_ecommerce_preview_ajax_popup', 'mp_ecommerce_preview_ajax_popup_callback' );