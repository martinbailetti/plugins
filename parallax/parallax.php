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
      wp_enqueue_script('parallax-script', plugin_dir_url( __FILE__ ) .'js/jquery.parallax-1.1.3.js', array('jquery'), '', true);
  }

add_action( 'init', 'parallax_create_post_type' );

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
//	include_once("acf_import.php");

}

function parallax_acf_notice() {
  ?>
<div id="message" class="updated notice is-dismissible"><p>Sliders requiere la instalación del plugin <strong>Advanced Custom Fields</strong>.</p><button type="button" class="notice-dismiss"><span class="screen-reader-text">Descartar este aviso.</span></button></div>
  <?php
}



   function parallax_init($parallaxID) {
//xPosition - Horizontal position of the element
  //inertia - speed to move relative to vertical scroll. Example: 0.1 is one tenth the speed of scrolling, 2 is twice the speed of scrolling
  //outerHeight (true/false) - Whether or not jQuery should use it's outerHeight option to determine when a section is in the viewport
      parallax_add_html($parallaxID);
      parallax_add_js($parallaxID);

   }

   function parallax_add_js($parallaxID) {
 
      echo "<script>";

      echo "jQuery(document).ready(function($){";

      echo "$('#second').parallax('".get_field("parallax_position")."%', 0.1);";
      echo "$('.bg').parallax('50%', 0.4);";
      echo "$('.bg2').parallax('20%', 0.6);";

      echo "});";

      echo "</script>";
  }

   function parallax_add_html($parallaxID) {
 ?>
  <div id="second">
    <div class="story"><div class="bg"></div><div class="bg2"></div>
        <div class="float-right">
              <h2>Multiple Backgrounds</h2>
              <p>The multiple backgrounds applied to this section are moved in a similar way to the first section -- every time the user scrolls down the page by a pixel, the positions of the backgrounds are changed.</p>
              <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean nibh erat, sagittis sit amet congue at, aliquam eu libero. Integer molestie, turpis vel ultrices facilisis, nisi mauris sollicitudin mauris, volutpat elementum enim urna eget odio. Donec egestas aliquet facilisis. Nunc eu nunc eget neque ornare fringilla. Nam vel sodales lectus. Nulla in pellentesque eros. Donec ultricies, enim vitae varius cursus, risus mauris iaculis neque, euismod sollicitudin metus erat vitae sapien. Sed pulvinar.</p>
          </div>
      </div> <!--.story-->
      
  </div> <!--#second-->
<?php
  }