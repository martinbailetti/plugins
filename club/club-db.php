<?php

global $club_db_version;
global $club_db_version;
$club_db_version = '1.0';

function club_install() {
	global $wpdb;
	global $club_db_version;

	$table_name = $wpdb->prefix . 'club_socios';
	
	$charset_collate = $wpdb->get_charset_collate();

	$sql = "CREATE TABLE $table_name (
		id mediumint(9) NOT NULL AUTO_INCREMENT,
		nombre varchar(100) DEFAULT '' NOT NULL,
		apellidos varchar(100) DEFAULT '' NOT NULL,
		correo varchar(100) DEFAULT '' NOT NULL,
		codigo varchar(100),
		estado tinyint(1),
		registro datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
		PRIMARY KEY  (id)
	) $charset_collate;";

	require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
	dbDelta( $sql );

	add_option( 'club_db_version', $club_db_version );
}
/*
function club_install_data() {
	global $wpdb;
	
	$welcome_name = 'Mr. WordPress';
	$welcome_text = 'Congratulations, you just completed the installation!';
	
	$table_name = $wpdb->prefix . 'liveshoutbox';
	
	$wpdb->insert( 
		$table_name, 
		array( 
			'time' => current_time( 'mysql' ), 
			'name' => $welcome_name, 
			'text' => $welcome_text, 
		) 
	);
}
*/