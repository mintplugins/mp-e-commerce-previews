<?php
/**
 * Function which creates new Meta Box
 *
 */
function mp_ecommerce_previews_youtube_player_create_meta_box(){	
	/**
	 * Array which stores all info about the new metabox
	 *
	 */
	$mp_ecommerce_previews_youtube_player_add_meta_box = array(
		'metabox_id' 		=> 'mp_ecommerce_previews_youtube_player_metabox', 
		'metabox_title' 	=> __( 'YouTube Player Preview', 'mp_ecommerce_previews'), 
		'metabox_posttype' 	=> 'download', 
		'metabox_context' 	=> 'advanced', 
		'metabox_priority' 	=> 'low' 
	);
	
	/**
	 * Array which stores all info about the options within the metabox
	 *
	 */
	$mp_ecommerce_previews_youtube_player_items_array = array(
		array(
			'field_id'				=> 'preview_youtube_video',
			'field_title' 			=> __( 'Video URL', 'mp_ecommerce_previews'),
			'field_description' 	=> 'Enter the URL or Embed code for the Youtube video.',
			'field_type' 			=> 'textarea',
			'field_value' 			=> ''
		),
	);
	
	/**
	 * Custom filter to allow for add-on plugins to hook in their own data for add_meta_box array
	 */
	$mp_ecommerce_previews_youtube_player_add_meta_box = has_filter('mp_ecommerce_previews_youtube_player_meta_box_array') ? apply_filters( 'mp_ecommerce_previews_youtube_player_meta_box_array', $mp_ecommerce_previews_youtube_player_add_meta_box) : $mp_ecommerce_previews_youtube_player_add_meta_box;
	
	/**
	 * Custom filter to allow for add on plugins to hook in their own extra fields 
	 */
	$mp_ecommerce_previews_youtube_player_items_array = has_filter('mp_ecommerce_previews_youtube_player_items_array') ? apply_filters( 'mp_ecommerce_previews_youtube_player_items_array', $mp_ecommerce_previews_youtube_player_items_array) : $mp_ecommerce_previews_youtube_player_items_array;
	
	/**
	 * Create Metabox class
	 */
	global $mp_ecommerce_previews_youtube_player_meta_box;
	$mp_ecommerce_previews_youtube_player_meta_box = new MP_CORE_Metabox($mp_ecommerce_previews_youtube_player_add_meta_box, $mp_ecommerce_previews_youtube_player_items_array);
}
add_action('plugins_loaded', 'mp_ecommerce_previews_youtube_player_create_meta_box');

/**
 * Add Youtube Player as a Preview Type to the dropdown
 *
 * @since    1.0.0
 * @link     http://moveplugins.com/doc/
 * @param    array $args See link for description.
 * @return   void
 */
function mp_ecommerce_previews_add_youtube_player_media_type( $preview_types_array ){	
	
	/**
	 * Array which stores all info about the options within the metabox
	 *
	 */
	$preview_types_array[0]['field_select_values']['youtube_player'] = 'Youtube Player';
	
	return $preview_types_array;

}
add_filter('mp_ecommerce_previews_media_items_array', 'mp_ecommerce_previews_add_youtube_player_media_type');