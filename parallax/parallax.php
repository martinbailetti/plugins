<?php
/*
Plugin Name: Parallax
Plugin URI: http://www.inthewok.com/
Description: Agrega áreas con efecto parallax.
Version: 99.4.1
Author: Martín Bailetti
Author URI: http://www.inthewok.com/
License: GPL2
*/

  add_action( 'wp_enqueue_scripts', 'parallax_scripts',999);
  function parallax_scripts() {
 
      wp_enqueue_style( 'parallax-style', plugin_dir_url( __FILE__ ).'parallax.css');

      wp_enqueue_script('scrollto-script', plugin_dir_url( __FILE__ ) .'js/jquery.scrollTo-1.4.2-min.js', array('jquery'), '', true);
      wp_enqueue_script('localscroll-script', plugin_dir_url( __FILE__ ) .'js/jquery.localscroll-1.2.7-min.js', array('jquery'), '', true);
      wp_enqueue_script('parallax-script', plugin_dir_url( __FILE__ ) .'js/jquery.scrollTo-1.4.2-min.js', array('jquery'), '', true);
  }

add_action( 'init', 'sliders_create_post_type' );

function parallax_create_post_type() {
  register_post_type( 'parallax',
    array(

    'exclude_from_search' => true, // the important line here!
    'public' => true,
    'publicly_queryable' => true,
    'show_ui' => true,
    'show_in_menu' => true,
    'query_var' => true,
    'rewrite' => true,
    'capability_type' => 'page',
    'has_archive' => true,
    'hierarchical' => false,

      'labels' => array(
        'name' => __( 'Parallax' ),
        'singular_name' => __( 'Parallax' ),
        'add_new' => __( 'Añadir Parallax' ),
        'add_new_item' => __( 'Añadir un nuevo Parallax' )
      ),
      'public' => true,
      'has_archive' => true,
    )
  );
}


/*
 * Verifica si existe el ACF   
 */

include_once( ABSPATH . 'wp-admin/includes/plugin.php' ); 
if ( !is_plugin_active( 'advanced-custom-fields-pro/acf.php' ) ) {
  add_action( 'admin_notices', 'parallax_acf_notice' );
}else{


	//Importa la configuración ACF
	include_once("acf_import.php");

}

function parallax_acf_notice() {
  ?>
<div id="message" class="updated notice is-dismissible"><p>Sliders requiere la instalación del plugin <strong>Advanced Custom Fields</strong>.</p><button type="button" class="notice-dismiss"><span class="screen-reader-text">Descartar este aviso.</span></button></div>
  <?php
}




   function parallax_add_js() {
 
      echo "$('#intro').parallax('50%', 0.1);";
  }

   function parallax_add_html() {
 ?>
      	<div id="intro">
			<div class="story">
		    	<div class="float-left">
				<h2>(Almost) Static Background</h2>
		        <p>This section has a background that moves slightly slower than the user scrolls. This is achieved by changing the top position of the background for every pixel the page is scrolled.</p>
		        </div>
		    </div> <!--.story-->
		</div>
<?php
  }