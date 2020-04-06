<?php

/**
 * Trigger this file on Plugin uninstall
 *
 * @package  AlecadddPlugin
 */

if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	die;
}

// Clear Database stored data
$pets = get_posts( array( 'post_type' => 'pet', 'numberposts' => -1 ) );

foreach( $pets as $pet ) {
	wp_delete_post( $pet->ID, true );
}

$shelters = get_posts( array( 'post_type' => 'shelter', 'numberposts' => -1 ) );

foreach( $shelters as $shelter ) {
	wp_delete_post( $shelter->ID, true );
}

// Access the database via SQL
global $wpdb;
$wpdb->query( "DELETE FROM wp_posts WHERE post_type = 'pet' AND post_type = 'shelter'" );
$wpdb->query( "DELETE FROM wp_postmeta WHERE post_id NOT IN (SELECT id FROM wp_posts)" );
$wpdb->query( "DELETE FROM wp_term_relationships WHERE object_id NOT IN (SELECT id FROM wp_posts)" );