<?php
/*
Plugin Name: Productos
Plugin URI: http://www.inthewok.com/
Description: Agrega un nuevo tipo de post para Productos.
Version: 99.4.1
Author: Martín Bailetti
Author URI: http://www.inthewok.com/
License: GPL2
*/


add_action( 'init', 'productos_create_post_type' );
function productos_create_post_type() {
  register_post_type( 'producto',
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
    'hierarchical' => true,

      'labels' => array(
        'name' => __( 'Productos' ),
        'singular_name' => __( 'Producto' ),
        'add_new' => __( 'Añadir Producto' ),
        'add_new_item' => __( 'Añadir un nuevo Producto' )
      ),
      'public' => true,
      'has_archive' => true,
    )
  );
  register_post_type( 'categoria',
    array(

    'exclude_from_search' => true, // the important line here!
    'public' => true,
    'publicly_queryable' => true,
    'show_ui' => true,
    'show_in_menu' => "edit.php?post_type=producto",
    'query_var' => true,
    'rewrite' => true,
    'capability_type' => 'page',
    'has_archive' => true,
    'hierarchical' => true,

      'labels' => array(
        'name' => __( 'Categorías' ),
        'singular_name' => __( 'Categoría' ),
        'add_new' => __( 'Añadir Categoría' ),
        'add_new_item' => __( 'Añadir una nueva Categoría' )
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
  add_action( 'admin_notices', 'producto_acf_notice' );
}else{


	//Importa la configuración ACF
	include_once("acf_import.php");

}

function producto_acf_notice() {
  ?>
<div id="message" class="updated notice is-dismissible"><p>Admin Configurator requiere la instalación del plugin <strong>Advanced Custom Fields</strong>.</p><button type="button" class="notice-dismiss"><span class="screen-reader-text">Descartar este aviso.</span></button></div>
  <?php
}

/*
Modifica el Listado de Productos
*/

function producto_columns($columns)
{
	$columns = array(
		'cb'	 	=> '<input type="checkbox" />',
		'title' 	=> 'Title',
		'producto_precio'	=>	'Precio',
		'producto_codigo' 	=> 'Código',
		'date'		=>	'Date'
	);
	return $columns;
}

function producto_custom_columns($column)
{
	global $post;
	echo $post->ID;

	if($column == 'producto_precio')
	{
		echo  get_field('producto_precio', $post->ID);
	}else if($column == 'producto_codigo')
	{
		echo  get_field('producto_codigo', $post->ID);
	}
}

add_action("manage_pages_custom_column", "producto_custom_columns");
add_filter("manage_edit-producto_columns", "producto_columns");

function producto_register_sortable( $columns )
{
	$columns['producto_precio'] = 'producto_precio';
	$columns['producto_codigo'] = 'producto_codigo';
	return $columns;
}

add_filter("manage_edit-producto_sortable_columns", "producto_register_sortable" );
