<?php 
/*
Plugin Name: gnoyelle : ACF Gallery Nivoslider
Plugin URI: http://wwww.gregoirenoyelle.com
Description: For using nivoslider with ACF Gallery add on  
Version: 1.0
Author: Grégoire Noyelle
Author URI: http://wwww.gregoirenoyelle.com
License: GPL2
GitHub Plugin URI: https://github.com/gregoirenoyelle/gnoyelle-acf-nivoslider
GitHub Branch: master
*/

// If this file is called directly, abort.
if ( ! defined( 'ABSPATH' ) ) {
    die;
}


/***********
* CONSTANTES
************/
define('ACFN_GN_PLUGIN_PATH', plugin_dir_path( __FILE__ ) );
define('ACFN_GN_PLUGIN_URL', plugin_dir_url( __FILE__ ) );

/**************************
* ENQUEUE ADMIN
**************************/

// scripts
add_action('wp_enqueue_scripts','acfnivo_scripts');
function acfnivo_scripts(){
	wp_register_script('nivo-js', ACFN_GN_PLUGIN_URL . 'Nivo-Slider/jquery.nivo.slider.js', array('jquery'),'3.2',true);
	wp_register_script('nivo-pack-js', ACFN_GN_PLUGIN_URL . 'Nivo-Slider/jquery.nivo.slider.pack.js', array('jquery'),'3.2',true);
	wp_register_script('acfnivo-js', ACFN_GN_PLUGIN_URL . 'js/acfnivo.js', array('jquery'),'1.0',true);
	wp_register_script('acftab-js', ACFN_GN_PLUGIN_URL . 'js/acftab.js', array('jquery'),'1.0',true);
	// place for conditionnal
	// wp_enqueue_script('acfnivo-js');
	if ( is_page_template('p-temp-mod.php' ) ) :
		wp_enqueue_script('nivo-js');
		wp_enqueue_script('nivo-pack-js');
		wp_enqueue_script('acftab-js');
	endif;

}

// CSS
add_action('wp_print_styles', 'acfnivo_css', 11);
function acfnivo_css() {
	// wp_enqueue_style( 'acfnivo-css', ACFN_GN_PLUGIN_URL . '/css/acfnivo.css');
	wp_register_style( 'nivo-css', ACFN_GN_PLUGIN_URL . 'Nivo-Slider/nivo-slider.css');
	wp_register_style( 'nivo-css-default', ACFN_GN_PLUGIN_URL . 'Nivo-Slider/themes/default/default.css');
	if ( is_page_template('p-temp-mod.php' ) ):
		wp_enqueue_style( 'nivo-css');
		wp_enqueue_style( 'nivo-css-default');
	endif;
}

/**************************
* NEW TEMPLATE
**************************/
// le 17/06/2014 n'affiche pas dans les template dans le back
// function gn_new_template( $page_template )
// {
// 	if (is_page('contact')):
//     	$new_page_template = ACFN_GN_PLUGIN_PATH .'template/acf-temp-mod.php';
//     	if ( '' != $new_page_template ) return $new_page_template;
//     endif;
//     return $page_template;

// }
// add_filter( 'template_include', 'gn_new_template', 99 );

/**************************
* PHP IMPORT
**************************/
// require_once( PLUGIN_PATH'. 'folder/file.php' );