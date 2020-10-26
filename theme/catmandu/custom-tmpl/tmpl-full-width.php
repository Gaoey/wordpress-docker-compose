<?php /* Template Name: Full Width */

get_header();
?>

<div id="primary" class="content-area">
	<main id="main" class="site-main" >

		<?php
		if ( have_posts() ) :

			/* Start the Loop */
			while ( have_posts() ) :
				the_post();

					the_content();

					wp_link_pages();

			endwhile;
		endif;
		?>

	</main> <!-- #main -->
</div> <!-- #primary -->

<?php 

get_footer();