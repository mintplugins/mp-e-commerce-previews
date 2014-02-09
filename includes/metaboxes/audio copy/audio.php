<?php
/**
 * Function which creates new Meta Box
 *
 */
function mp_ecommerce_previews_audio_create_meta_box(){	
	/**
	 * Array which stores all info about the new metabox
	 *
	 */
	$mp_ecommerce_previews_audio_add_meta_box = array(
		'metabox_id' 		=> 'mp_ecommerce_previews_audio_metabox', 
		'metabox_title' 	=> __( 'Media Player Preview', 'mp_ecommerce_previews'), 
		'metabox_posttype' 	=> 'download', 
		'metabox_context' 	=> 'advanced', 
		'metabox_priority' 	=> 'low' 
	);
	
	/**
	 * Array which stores all info about the options within the metabox
	 *
	 */
	$mp_ecommerce_previews_audio_items_array = array(
			array(
					'field_id'			=> 'title',
					'field_title' 	=> __( 'Media\'s Title', 'mp_player'),
					'field_description' 	=> 'Enter the title of this media',
					'field_type' 	=> 'textbox',
					'field_value' => '',
					'field_repeater' => 'preview_media_player'
				),
				array(
					'field_id'			=> 'artist',
					'field_title' 	=> __( 'Media\'s Artist', 'mp_player'),
					'field_description' 	=> 'Enter the Artist\'s name of this media',
					'field_type' 	=> 'textbox',
					'field_value' => '',
					'field_repeater' => 'preview_media_player'
				),
				array(
					'field_id'			=> 'filetype',
					'field_title' 	=> __( 'Filetype', 'mp_player'),
					'field_description' 	=> 'Select the Filetype',
					'field_type' 	=> 'select',
					'field_value' => '',
					'field_select_values' => array( 'audio' => 'AUDIO', 'video' => 'Video' ),
					'field_repeater' => 'preview_media_player'
				),
				array(
					'field_id'			=> 'poster',
					'field_title' 	=> __( 'Media\'s Poster', 'mp_player'),
					'field_description' 	=> 'Upload a Poster for this Video',
					'field_type' 	=> 'mediaupload',
					'field_value' => '',
					'field_repeater' => 'preview_media_player'
				),
				array(
					'field_id'			=> 'mp3',
					'field_title' 	=> __( 'Media\'s MP3', 'mp_player'),
					'field_description' 	=> 'Insert your media\'s MP3 file here (Optional)',
					'field_type' 	=> 'mediaupload',
					'field_value' => '',
					'field_repeater' => 'preview_media_player'
				),
				array(
					'field_id'			=> 'ogv',
					'field_title' 	=> __( 'Media\'s OGG/OGV File', 'mp_player'),
					'field_description' 	=> 'Insert your media\'s OGG/OGV file here (Optional)',
					'field_type' 	=> 'mediaupload',
					'field_value' => '',
					'field_repeater' => 'preview_media_player'
				),
				array(
					'field_id'			=> 'm4v',
					'field_title' 	=> __( 'Media\'s MP4/M4V Video File', 'mp_player'),
					'field_description' 	=> 'Insert your media\'s MP4/M4V file here (Optional)',
					'field_type' 	=> 'mediaupload',
					'field_value' => '',
					'field_repeater' => 'preview_media_player'
				),
				array(
					'field_id'			=> 'webmv',
					'field_title' 	=> __( 'Media\'s WEBM File', 'mp_player'),
					'field_description' 	=> 'Insert your media\'s WEBM file here (Optional)',
					'field_type' 	=> 'mediaupload',
					'field_value' => '',
					'field_repeater' => 'preview_media_player'
				),
	);
	
	/**
	 * Custom filter to allow for add-on plugins to hook in their own data for add_meta_box array
	 */
	$mp_ecommerce_previews_audio_add_meta_box = has_filter('mp_ecommerce_previews_audio_meta_box_array') ? apply_filters( 'mp_ecommerce_previews_audio_meta_box_array', $mp_ecommerce_previews_audio_add_meta_box) : $mp_ecommerce_previews_audio_add_meta_box;
	
	/**
	 * Custom filter to allow for add on plugins to hook in their own extra fields 
	 */
	$mp_ecommerce_previews_audio_items_array = has_filter('mp_ecommerce_previews_audio_items_array') ? apply_filters( 'mp_ecommerce_previews_audio_items_array', $mp_ecommerce_previews_audio_items_array) : $mp_ecommerce_previews_audio_items_array;
	
	/**
	 * Create Metabox class
	 */
	global $mp_ecommerce_previews_audio_meta_box;
	$mp_ecommerce_previews_audio_meta_box = new MP_CORE_Metabox($mp_ecommerce_previews_audio_add_meta_box, $mp_ecommerce_previews_audio_items_array);
}
add_action('plugins_loaded', 'mp_ecommerce_previews_audio_create_meta_box');