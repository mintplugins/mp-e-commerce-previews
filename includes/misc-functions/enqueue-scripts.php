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
		
		//front end js
		wp_enqueue_script( 'mp_ecommerce_previews_front_end_js', plugins_url('js/mp-ecommerce-previews-front-end.js', dirname(__FILE__) ), array( 'jquery' ) );
		
		//front end css
		wp_enqueue_style( 'mp_ecommerce_previews_admin_style', plugins_url('css/mp-ecommerce-previews-admin-style.css', dirname(__FILE__)) );
}
add_action( 'wp_enqueue_scripts', 'mp_ecommerce_previews_frontend_enqueue' );