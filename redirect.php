<?php
/*
* Plugin Name: Redirect non logged in users to custom URL
* Description: Redirect non logged in users to a custom URL of your choice.
* Author: Luke Hemingway
* Version: 1.0
* Author URL: https://3mi.co.uk
*/

if ( ! defined( 'ABSPATH' ) ) exit;

include( plugin_dir_path( __FILE__ ) . '/admin.php');
add_option( 'lah_crp_custom_redirect_plugin', 'http://example.com/', '', 'yes' );

add_action( 'template_redirect', 'lah_crp_redirect_page' );

function lah_crp_redirect_page() {
    if ( is_user_logged_in() ) {
        return;
    }

    $allowed_pages = array( 7966 );
	// 7966 is login page

    if ( !in_array( get_queried_object_id(), $allowed_pages ) ) {
		$url = get_option( 'lah_crp_custom_redirect_plugin' );
        wp_redirect($url);
        exit();
    }
}