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
    'publicly_queryable' => true,

      'labels' => array(
        'name' => __( 'Parallax' ),
        'singular_name' => __( 'Parallax' ),
        'add_new' => __( 'Añadir Parallax' ),
        'add_new_item' => __( 'Añadir un nuevo Parallax' ),
        'view_item' => __( 'Vista Previa' )
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

      echo "$('#parallax_".$parallaxID."').parallax('".get_field("parallax_position", $parallaxID)."%', ".get_field("parallax_inertia", $parallaxID).");";

      $childs = get_field("parallax_childs", $parallaxID);

      for($i=0; $i < count($childs); $i++){

          echo "$('#parallax_".$parallaxID."_child_".$i."').parallax('".$childs[$i]["parallax_position"]."%', ".$childs[$i]["parallax_inertia"].");";

      }

      echo "});";

      echo "</script>";
  }

   function parallax_add_html($parallaxID) {
 ?>
  <div class="parallax_layer" id="parallax_<?php echo $parallaxID ?>" style="background-image: url(<?php echo get_field("parallax_image", $parallaxID) ?>);height: <?php echo get_field("parallax_height", $parallaxID) ?>px;color: white;">
    <div class="parallax_content">
<?php
      $childs = get_field("parallax_childs", $parallaxID);
      for($i=0; $i < count($childs); $i++){
?>
    <div id="parallax_<?php echo $parallaxID."_child_".$i ?>" class="parallax_layer_child" style="background-image: url(<?php echo $childs[$i]["parallax_image"] ?>);height: <?php echo get_field("parallax_height", $parallaxID) ?>px;color: white;width:100%;z-index:20<?php echo $i ?>"></div>
<?php
      }
?>

<?php 
  
  $parallax_title = get_field("parallax_title", $parallaxID);
  $parallax_text = get_field("parallax_text", $parallaxID);
  $parallax_content_position = get_field("parallax_content_position", $parallaxID);
  $parallax_content_width = get_field("parallax_content_width", $parallaxID);

  if(!empty($parallax_title) || !empty($parallax_text)){

      $css = "width:".$parallax_content_width."px;z-index:300;";
      if($parallax_content_position==1){
        $css .= "float:right;";
      }else if($parallax_content_position==2){
        $css .= "float:left;";
      }else{
        $css .= "margin-left:auto;margin-right:auto;";
      }

      echo '<div class="parallax_content_layer" style="'.$css.'">';

  }

  if(!empty($parallax_title)){

      echo '<h2>'.$parallax_title.'</h2>';

  }

  if(!empty($parallax_text)){

      echo '<div class="parallax_text">'.$parallax_text.'</div>';

  }

  if(!empty($parallax_title) || !empty($parallax_text)){

      echo '</div>';

  }
 ?>
    
      </div> <!--.story-->

      
  </div> <!--#second-->
<?php
  }
