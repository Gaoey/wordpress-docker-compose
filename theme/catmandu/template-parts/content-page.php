<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * Catmandu
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class('hentry'); ?>>

	<?php catmandu_post_thumbnail(); ?>

	<div class="catmandu-post-content-wrap">
		<?php
		the_content();
		wp_link_pages();
		?>
	</div><!-- .entry-content -->

</article><!-- #post-<?php the_ID(); ?> -->