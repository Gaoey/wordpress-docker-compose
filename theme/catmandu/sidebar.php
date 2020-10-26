<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * Catmandu
 * @since 1.0.0
 * @author CodeManas 2019. All Rights reserved.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}


$sidebar = apply_filters( 'catmandu_get_sidebar', 'sidebar' );

if ( ! is_active_sidebar( $sidebar ) ) :
	return;
endif;
?>

<?php catmandu_before_sidebar(); ?>

    <div id="sidebar-primary" class="sidebar widget-area" >

    	<div class="sidebar-widget-wrapper">

				<?php dynamic_sidebar( $sidebar ); ?>

		</div>

    </div><!-- #sidebar-primary -->

<?php catmandu_after_sidebar(); ?>