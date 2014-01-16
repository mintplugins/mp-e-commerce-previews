<?php
/**
 * Function which creates new Meta Box
 *
 */
function mp_ecommerce_previews_video_create_meta_box(){	
	/**
	 * Array which stores all info about the new metabox
	 *
	 */
	$mp_ecommerce_previews_video_add_meta_box = array(
		'metabox_id' 		=> 'mp_ecommerce_previews_video_metabox', 
		'metabox_title' 	=> __( 'Video Preview', 'mp_ecommerce_previews'), 
		'metabox_posttype' 	=> 'download', 
		'metabox_context' 	=> 'advanced', 
		'metabox_priority' 	=> 'low' 
	);
	
	/**
	 * Array which stores all info about the options within the metabox
	 *
	 */
	$mp_ecommerce_previews_video_items_array = array(
		array(
			'field_id'				=> 'preview_video_url',
			'field_title' 			=> __( 'Video URL', 'mp_ecommerce_previews'),
			'field_description' 	=> 'Enter the URL to the video page.',
			'field_type' 			=> 'url',
			'field_value' 			=> ''
		),
	);
	
	/**
	 * Custom filter to allow for add-on plugins to hook in their own data for add_meta_box array
	 */
	$mp_ecommerce_previews_video_add_meta_box = has_filter('mp_ecommerce_previews_video_meta_box_array') ? apply_filters( 'mp_ecommerce_previews_video_meta_box_array', $mp_ecommerce_previews_video_add_meta_box) : $mp_ecommerce_previews_video_add_meta_box;
	
	/**
	 * Custom filter to allow for add on plugins to hook in their own extra fields 
	 */
	$mp_ecommerce_previews_video_items_array = has_filter('mp_ecommerce_previews_video_items_array') ? apply_filters( 'mp_ecommerce_previews_video_items_array', $mp_ecommerce_previews_video_items_array) : $mp_ecommerce_previews_video_items_array;
	
	/**
	 * Create Metabox class
	 */
	global $mp_ecommerce_previews_video_meta_box;
	$mp_ecommerce_previews_video_meta_box = new MP_CORE_Metabox($mp_ecommerce_previews_video_add_meta_box, $mp_ecommerce_previews_video_items_array);
}
add_action('plugins_loaded', 'mp_ecommerce_previews_video_create_meta_box');