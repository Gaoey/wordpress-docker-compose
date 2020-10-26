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

		<?php if ( has_post_thumbnail() ) {
			?>
			<div class="entry-thumb aligncenter">
				<?php catmandu_post_thumbnail(); ?>
			</div>
			<?php
		}
		?>
		
		<div class="entry-content-wrapper">
			<header class="entry-header">
				<?php
				if ( is_singular() ) :
					the_title( '<h1 class="entry-title">', '</h1>' );
				else :
					the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
				endif;
				?>
			</header><!-- .entry-header -->
			<?php
			if ( 'post' === get_post_type() ) :
				?>
				<div class="entry-meta">
					<?php
					catmandu_post_posted_on();
					catmandu_post_category_links();
					catmandu_post_posted_by();
					catmandu_post_leave_comment();
					?>
				</div>
			<?php endif; ?>
			<div class="entry-content">
				<?php
				if ( is_singular() ) :
					the_content();
					wp_link_pages();
				else :
					the_excerpt();
				endif;
				?>
			</div><!-- .entry-content -->
		</div>
</article><!-- #post-<?php the_ID(); ?> -->