<?php

/**
 * Template Name: Shelter
 */

get_header();
?>

<div id="primary" class="content-area">
	<main id="main" class="site-main">

		<h1>Page Shelter</h1>
		<?php

		// Start the Loop.
		while (have_posts()) :
			the_post();

			get_template_part('template-parts/content/content', 'shelter');

			// If comments are open or we have at least one comment, load up the comment template.
			if (comments_open() || get_comments_number()) {
				comments_template();
			}

		endwhile; // End the loop.
		?>

	</main><!-- #main -->
</div><!-- #primary -->

<?php
get_footer();
