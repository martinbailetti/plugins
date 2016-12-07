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