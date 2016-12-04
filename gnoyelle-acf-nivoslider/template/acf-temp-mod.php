<?php 
// Template Name: Page Modulable Galerie

/**************************
* scritp head
**************************/

add_action('wp_head','acfnivo_gn_script_head');
function acfnivo_gn_script_head() { 
	$output = "<script type='text/javascript'>";
		$output .= "jQuery(window).load(function() {";
		while (have_rows('gn_zone_page')) : the_row();	
			while (have_rows('gn_rang_page')) : the_row();
				if (get_row_layout()=='gn_content_galerie') :
					$numb_gall = get_sub_field('gn_nombre_galerie'); 
					$output .= "jQuery('#slider-{$numb_gall}').nivoSlider({";
						$output .= "effect: 'fade',";
						$output .= "pauseTime : 3000";
					$output .=  "});";	
				endif;	
			endwhile;
		endwhile;	
		$output .= "});";
	$output .= "</script>";
	echo $output;
} // END function acfnivo_gn_script_head


/**************************
* loop ACF
**************************/

remove_action( 'genesis_loop', 'genesis_do_loop' );
add_action( 'genesis_loop', 'gn_page_loop_acf' );

function gn_page_loop_acf() { 
$title = get_the_title();
echo "<header class='entry-header'>";
echo "<h1 class='entry-title' itemprop='headline'>$title</h1>";	
echo "</header>";

if (have_rows('gn_zone_page')) : 

	while (have_rows('gn_zone_page')) : the_row();
		$gn_post_class = implode(' ', get_post_class('gn-raw-bloc-mod'));
		echo "<article class='{$gn_post_class}' itemscope='itemscope' itemtype='http://schema.org/CreativeWork'>";

			if (have_rows('gn_rang_page')) :
				while (have_rows('gn_rang_page')) : the_row();
					if (get_row_layout()=='gn_content_editeur') :
						// ACF value
						$largeur_e = get_sub_field('gn_largeur_editeur');
						$marge_d = get_sub_field('gn_marge_droite');
						$largeur_e = ( $largeur_e  ? $largeur_e : '100');
						$marge_d = ( $marge_d  ? $marge_d : '0');


						echo "<section class='gn-bloc-mod' style='width:{$largeur_e}%;margin-right:{$marge_d}%'>";
							the_sub_field('gn_editeur');
						echo "</section>";

					
					elseif (get_row_layout()=='gn_content_galerie') :	
						// ACF value
						$images = get_sub_field('gn_galerie');
						$largeur_e = get_sub_field('gn_largeur_editeur');
						$marge_d = get_sub_field('gn_marge_droite');
						$numb_gall = get_sub_field('gn_nombre_galerie');				
						$largeur_e = ( $largeur_e  ? $largeur_e : '100');
						$marge_d = ( $marge_d  ? $marge_d : '0');	

						if ($images) :
							echo "<section class='gn-bloc-mod slider-wrapper theme-default' style='width:{$largeur_e}%;margin-right:{$marge_d}%'>";
								echo "<div id='slider-{$numb_gall}' class='nivoSlider'>";
									foreach ($images as $image) :
										echo "<img src='{$image['sizes']['large']}' title='{$image['caption']}'>";						
									endforeach;	
								echo "</div>";	
							echo "</section>";	
						endif; // $images?	
						// aff_p($images);
					endif;

				endwhile;
			else :
				echo "Merci d'Ajouter une un type de contenu";
			
			endif;	
			
		echo "</article>";

	endwhile;	
else : 
	echo "Merci d'Ajouter un rang à votre page";

endif;


} // END function gn_page_loop_acf

genesis();