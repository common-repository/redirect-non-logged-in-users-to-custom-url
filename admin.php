<?php
if ( ! defined( 'ABSPATH' ) ) exit;
add_action('admin_menu', 'lah_crp_redirect_admin_menu');
 
function lah_crp_redirect_admin_menu(){
	add_menu_page( 'Custom Redirect Page', 'Custom Redirect', 'manage_options', 'custom-redirect', 'lah_crp_init' );
}

add_action('admin_enqueue_scripts', 'lah_crp_reg_css');

    function lah_crp_reg_css($hook) {
		$current_screen = get_current_screen();
		if ( strpos($current_screen->base, 'custom-redirect') === false) {
			return;
		} else {
			wp_enqueue_style('boot_css', plugins_url('css/bootstrap.min.css',__FILE__ ));
        }
    }

function lah_crp_init(){
	$permission = current_user_can('administrator');
	if($permission == '1') {
		include(plugin_dir_path( __FILE__ ) . '/settings.php');
	}
}