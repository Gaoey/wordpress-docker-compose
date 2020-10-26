<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * Catmandu
 * @since 1.0.0
 * @author CodeManas 2020. All Rights reserved.
 */

get_header();

	catmandu_before_main_content();
	?>
	<div id="primary" class="content-area">
		<main id="main" class="site-main">
				<?php
				catmandu_before_post_content();

				if ( have_posts() ) :

					/* Start the Loop */
					while ( have_posts() ) :
						the_post();

						get_template_part( 'template-parts/content', 'single' );

						$single_pagination = Catmandu_Theme_Options::get_option( 'field-single-pagination-enable' );
						if ( $single_pagination ) {
							the_post_navigation();
						}

						// If comments are open or we have at least one comment, load up the comment template.
						if ( comments_open() || get_comments_number() ) :
							comments_template();
						endif;

					endwhile;

				else :

					get_template_part( 'template-parts/content', 'none' );

				endif;

				catmandu_after_post_content();
				?>
			
		</main><!-- #main -->
	</div><!-- #primary -->
	
	<?php
	catmandu_after_main_content();

	if ( catmandu_get_sidebar_layout() != "none" ) {
		get_sidebar();
	}

get_footer();
