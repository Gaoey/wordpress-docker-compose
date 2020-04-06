<?php

/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Twenty_Nineteen
 * @since Twenty Nineteen 1.0
 */

get_header();
?>

<div id="primary" class="content-area">
	<main id="main" class="site-main">
		<h1>archive Shelter</h1>
		<?php if (have_posts()) : ?>

			<header class="page-header">
				<?php
				the_archive_title('<h1 class="page-title">', '</h1>');
				?>
			</header><!-- .page-header -->

			<?php
			$loop = new WP_Query(array('post_type' => 'shelter'));
			if ($loop->have_posts()) :
				while ($loop->have_posts()) : $loop->the_post();
					echo_log(the_post());
			?>

					<div class="pindex">
						<?php if (has_post_thumbnail()) { ?>
							<div class="pimage">
								<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail(); ?></a>
							</div>
						<?php } ?>
					</div>
				<?php endwhile;
				if ($loop->max_num_pages > 1) : ?>
					<div id="nav-below" class="navigation">
						<div class="nav-previous"><?php next_posts_link(__('<span class="meta-nav">&larr;</span> Previous', 'domain')); ?></div>
						<div class="nav-next"><?php previous_posts_link(__('Next <span class="meta-nav">&rarr;</span>', 'domain')); ?></div>
					</div>
			<?php endif;
			endif;
			wp_reset_postdata();
			?>

		<?php
			// Start the Loop.
			while (have_posts()) :
				the_post();

				/*
				 * Include the Post-Format-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Format name) and that
				 * will be used instead.
				 */
				get_template_part('template-parts/content/content', 'shelter');

			// End the loop.
			endwhile;

			// Previous/next page navigation.
			twentynineteen_the_posts_navigation();

		// If no content, include the "No posts found" template.
		else :
			get_template_part('template-parts/content/content', 'none');

		endif;
		?>
	</main><!-- #main -->
</div><!-- #primary -->

<?php
get_footer();
