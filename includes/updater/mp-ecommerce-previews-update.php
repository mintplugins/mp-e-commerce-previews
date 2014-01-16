<?php
/**
 * This file contains the function keeps the MP Stacks plugin up to date.
 *
 * @since 1.0.0
 *
 * @package    EDD Previews
 * @subpackage Functions
 *
 * @copyright  Copyright (c) 2013, Move Plugins
 * @license    http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @author     Philip Johnston
 */
 
/**
 * Check for updates for the EDD Previews Plugin by creating a new instance of the MP_CORE_Plugin_Updater class.
 *
 * @access   public
 * @since    1.0.0
 * @return   void
 */
 if (!function_exists('edd_previews_update')){
	function edd_previews_update() {
		$args = array(
			'software_name' => 'EDD Previews', //<- The exact name of this Plugin. Make sure it matches the title in your edd_previews, edd, and the WP.org stacks
			'software_api_url' => 'http://moveplugins.com',//The URL where EDD and edd_previews are installed and checked
			'software_filename' => 'edd-previews.php',
			'software_licensed' => false, //<-Boolean
		);
		
		//Since this is a plugin, call the Plugin Updater class
		$edd_previews_plugin_updater = new MP_CORE_Plugin_Updater($args);
	}
 }
add_action( 'admin_init', 'edd_previews_update' );
