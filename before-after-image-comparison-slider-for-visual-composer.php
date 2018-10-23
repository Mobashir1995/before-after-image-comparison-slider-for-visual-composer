<?php
/**
 Plugin Name: Before After Image Comparison Slider for Visual Composer
 Description: Before After Image Comparison Slider for Visual Composer
 Author: Web Builder03
 Author URI: https://profiles.wordpress.org/webbuilder03
 Version: 1.0.0
 Text Domain: before-after-image-comparison-slider-for-visual-composer
 */

// don't load directly
if (!defined('ABSPATH')){
	die('-1');
}

define( 'WB_VC_BAIC_PATH', plugin_dir_path( __FILE__ ) );
define( 'WB_VC_BAIC_URL', plugin_dir_url( __FILE__ ) ) ;

function WB_VC_BAIC_load_files(){
	require_once( WB_VC_BAIC_PATH . '/admin/check-compatibility.php' );
	if ( defined( 'WPB_VC_VERSION' ) ) {
		require_once( WB_VC_BAIC_PATH . '/admin/main.php' );
	}
}

add_action('plugins_loaded', 'WB_VC_BAIC_load_files');