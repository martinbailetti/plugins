<?php
/*
Plugin Name: Admin Configurator
Plugin URI: http://www.inthewok.com/
Version: 1.0.1
Author: MB
Author URI: http://hbt.io/
*/

/*
 * Verifica si existe el ACF   
 */

include_once( ABSPATH . 'wp-admin/includes/plugin.php' ); 
if ( !is_plugin_active( 'advanced-custom-fields-pro/acf.php' ) ) {
  add_action( 'admin_notices', 'my_acf_notice' );
}


function my_acf_notice() {
  ?>
<div id="message" class="updated notice is-dismissible"><p>Admin Configurator requiere la instalación del plugin <strong>Advanced Custom Fields</strong>.</p><button type="button" class="notice-dismiss"><span class="screen-reader-text">Descartar este aviso.</span></button></div>
  <?php
}
/**
 * Include Scripts for Admin
 */
function admin_scripts() {

    //Estilo del administrador
    wp_enqueue_style( 'admin-configurator-styles',  plugin_dir_url( __FILE__ ) . 'files/admin-conf.css' );
   
    //Scripts para el administrador
    wp_enqueue_script('admin-configurator-script', plugin_dir_url( __FILE__ ) . 'files/admin-conf.js', array('jquery'), false, true);
    $data = array( 'site_url' => __( site_url() ) );
    wp_localize_script( 'admin-configurator-script', 'WP_OBJECT', $data );

}
add_action( 'admin_enqueue_scripts', 'admin_scripts' );

/*
ACF Customization
*/
add_filter( 'site_transient_update_plugins', 'remove_update_notifications' );
function remove_update_notifications( $value ) {

    if ( isset( $value ) && is_object( $value ) ) {
        unset( $value->response[ 'advanced-custom-fields-pro/acf.php' ] );
    }

    return $value;
}


add_action( 'admin_menu', 'adjust_the_wp_menu', 999 );
function adjust_the_wp_menu() {
     

     //Para eliminar submenu edit.php
     remove_submenu_page("edit.php?post_type=acf-field-group", "acf-settings-updates");


     //Configura el administrador
     $options = get_option('wporg_options');

    if(!empty($options) && $options['wporg_field_type'] == "Producción"){

     	remove_menu_page("edit.php?post_type=acf-field-group");

    }
     
 
}

//Configura el administrador
function hide_plugins() {

     $options = get_option('wporg_options');
    if(!empty($options) && $options['wporg_field_type'] == "Producción"){
		  global $wp_list_table;
		  $hidearr = array('advanced-custom-fields-pro/acf.php');
		  $myplugins = $wp_list_table->items;
		  foreach ($myplugins as $key => $val) {
		    if (in_array($key,$hidearr)) {
		      unset($wp_list_table->items[$key]);
		    }
		  }
    }
}
 
add_action('pre_current_active_plugins', 'hide_plugins');




require_once 'files/options.php';
