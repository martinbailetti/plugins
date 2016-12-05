<?php
/*
Plugin Name: Sliders
Plugin URI: http://www.inthewok.com/
Description: Agrega un nuevo tipo de post para Sliders.
Version: 99.4.1
Author: Martín Bailetti
Author URI: http://www.inthewok.com/
License: GPL2
*/

  add_action( 'wp_enqueue_scripts', 'slider_css',999);
  function slider_css() {
 
      wp_enqueue_style( 'slider-style', plugin_dir_url( __FILE__ ).'nivo-slider.css');

      wp_enqueue_style( 'slider-bar-style', plugin_dir_url( __FILE__ ).'themes/bar/bar.css');
      wp_enqueue_style( 'slider-dark-style', plugin_dir_url( __FILE__ ).'themes/dark/dark.css');
      wp_enqueue_style( 'slider-default-style', plugin_dir_url( __FILE__ ).'themes/default/default.css');
      wp_enqueue_style( 'slider-light-style', plugin_dir_url( __FILE__ ).'themes/light/light.css');

      wp_enqueue_script('slider-script', plugin_dir_url( __FILE__ ) .'jquery.nivo.slider.pack.js', array('jquery'), '', true);
  }

add_action( 'init', 'sliders_create_post_type' );

function sliders_create_post_type() {
  register_post_type( 'slider',
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
        'name' => __( 'Sliders' ),
        'singular_name' => __( 'Slider' ),
        'add_new' => __( 'Añadir Slider' ),
        'add_new_item' => __( 'Añadir un nuevo Slider' )
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
  add_action( 'admin_notices', 'slider_acf_notice' );
}else{


	//Importa la configuración ACF
	include_once("acf_import.php");

}

function slider_acf_notice() {
  ?>
<div id="message" class="updated notice is-dismissible"><p>Sliders requiere la instalación del plugin <strong>Advanced Custom Fields</strong>.</p><button type="button" class="notice-dismiss"><span class="screen-reader-text">Descartar este aviso.</span></button></div>
  <?php
}


function slider_init($sliderID){

  slider_html($sliderID);
  slider_html_captions($sliderID);
  slider_js($sliderID);


}

function slider_js($sliderID){
  
    $effect = get_field("slider_effect", $sliderID);
    $effect = implode(",",$effect);

  echo "<script>";



  echo "jQuery(document).ready(function($){";

  echo "$('#slider').nivoSlider({ 
    effect: '".$effect."',
    slices: ".get_field("slider_slices", $sliderID).",
    boxCols: ".get_field("slider_boxCols", $sliderID).",
    boxRows: ".get_field("slider_boxRows", $sliderID).",
    animSpeed: ".get_field("slider_animSpeed", $sliderID).",
    pauseTime: ".get_field("slider_pauseTime", $sliderID).",
    directionNav: true,
    controlNav: true,
    controlNavThumbs: false,
    pauseOnHover: true,
    manualAdvance: false,
    prevText: 'Prev',
    nextText: 'Next',
    randomStart: false
});";

  echo "});";

  echo "</script>";

}


function slider_html($sliderID){
  
  $slides = get_field("slider_slides", $sliderID);
  
  if(count($slides)>0){


    echo '<div class="theme-'.get_field("slider_template", $sliderID).'">'; 
    echo '<div id="slider" class="nivoSlider">'; 
     
    for($i=0; $i < count($slides); $i++){

      if(!empty($slides[$i]["enlace"]))
        echo '<a href="'.$slides[$i]["enlace"].'">';

      echo '<img src="'.$slides[$i]["imagen"].'" alt="" title="#slide'.$i.'" '.(($slides[$i]["efecto"]!=0)?'data-transition="'.$slides[$i]["efecto"].'"':'').' />';  

      if(!empty($slides[$i]["enlace"]))
        echo '</a>'; 

    }

    echo '</div>';
    echo '</div>';
  }

}

function slider_html_captions($sliderID){
  
  $slides = get_field("slider_slides", $sliderID);

  if(count($slides)>0){

    echo '<div id="sliderCaptions" style="display:none">'; 
     
    for($i=0; $i < count($slides); $i++){

      echo '<div id="slide'.$i.'">';
      echo '<'.get_field("slider_titleTag", $sliderID).' class="slide_title">'.$slides[$i]["titulo"].'</'.get_field("slider_titleTag", $sliderID).'>'; 
      echo '<p class="slide_text">'.$slides[$i]["texto"].'</p>'; 
      echo '</div>'; 

    }

    echo '</div>';
  }

}