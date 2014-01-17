<?php
/**
 * Function which creates new Meta Box
 *
 */
function mp_ecommerce_previews_media_create_meta_box(){	
	/**
	 * Array which stores all info about the new metabox
	 *
	 */
	$mp_ecommerce_previews_media_add_meta_box = array(
		'metabox_id' => 'mp_ecommerce_previews_media_select_metabox', 
		'metabox_title' => __( 'Preview Selector', 'mp_ecommerce_previews'), 
		'metabox_posttype' => 'download', 
		'metabox_context' => 'advanced', 
		'metabox_priority' => 'high' 
	);
	
	/**
	 * Array which stores all info about the options within the metabox
	 *
	 */
	$mp_ecommerce_previews_media_items_array = array(
		array(
			'field_id'	 => 'preview_media_type_1',
			'field_title' => __( 'Preview Type', 'mp_ecommerce_previews'),
			'field_description' => 'Select the media type to use for this download\'s preview.',
			'field_type' => 'select',
			'field_value' => '',
			'field_select_values' => array('none' => 'None', 'image' => 'Image', 'video' => 'Video', 'audio' => 'Audio', 'media_player' => 'Media Player')
		),
	);
	
	
	/**
	 * Custom filter to allow for add-on plugins to hook in their own data for add_meta_box array
	 */
	$mp_ecommerce_previews_media_add_meta_box = has_filter('mp_ecommerce_previews_media_meta_box_array') ? apply_filters( 'mp_ecommerce_previews_media_meta_box_array', $mp_ecommerce_previews_media_add_meta_box) : $mp_ecommerce_previews_media_add_meta_box;
	
	/**
	 * Custom filter to allow for add on plugins to hook in their own extra fields 
	 */
	$mp_ecommerce_previews_media_items_array = has_filter('mp_ecommerce_previews_media_items_array') ? apply_filters( 'mp_ecommerce_previews_media_items_array', $mp_ecommerce_previews_media_items_array) : $mp_ecommerce_previews_media_items_array;
	
	
	/**
	 * Create Metabox class
	 */
	global $mp_ecommerce_previews_media_meta_box;
	$mp_ecommerce_previews_media_meta_box = new MP_CORE_Metabox($mp_ecommerce_previews_media_add_meta_box, $mp_ecommerce_previews_media_items_array);
}
add_action('plugins_loaded', 'mp_ecommerce_previews_media_create_meta_box');