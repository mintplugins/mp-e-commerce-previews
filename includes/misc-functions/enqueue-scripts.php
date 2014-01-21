<?php
/**
 * Enqueue stylesheet used for shortcode
 */
function mp_ecommerce_previews_admin_enqueue(){
	
	//css
	wp_enqueue_style( 'mp_ecommerce_previews_admin_style', plugins_url('css/mp-ecommerce-previews-admin-style.css', dirname(__FILE__)) );
	
	//admin side js
	wp_enqueue_script( 'mp_ecommerce_previews_admin_js', plugins_url('js/mp-ecommerce-previews-admin.js', dirname(__FILE__) ), array( 'jquery' ) );
	
}
add_action('admin_enqueue_scripts', 'mp_ecommerce_previews_admin_enqueue');


function mp_ecommerce_previews_frontend_enqueue(){
		
		//ajax popup script
		wp_enqueue_script( 'mp_ecommerce_previews_ajax_popup', plugins_url('js/mp-ecommerce-previews-ajax-popup.js', dirname(__FILE__) ), array( 'jquery' ) );
		
		//localize ajax popup script
		wp_localize_script( 'mp_ecommerce_previews_ajax_popup', 'mp_ecommerce_previews_ajax', array( 'ajaxurl' => admin_url( 'admin-ajax.php' )));   
		
		//front end css
		wp_enqueue_style( 'mp_ecommerce_previews_style', plugins_url('css/mp-ecommerce-previews-style.css', dirname(__FILE__)) );
}
add_action( 'wp_enqueue_scripts', 'mp_ecommerce_previews_frontend_enqueue' );