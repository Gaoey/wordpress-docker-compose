<?php

/**
 * The template for displaying Archive pages
 *
 * Used to display archive-type pages if nothing more specific matches a query.
 * For example, puts together date-based pages if no date.php file exists.
 *
 * If you'd like to further customize these archive views, you may create a
 * new template file for each specific one. For example, Twenty Fourteen
 * already has tag.php for Tag archives, category.php for Category archives,
 * and author.php for Author archives.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */

get_header(); ?>

<section id="primary" class="content-area">
  <div id="content" class="site-content" role="main">
    <?php if (have_posts()) : ?>

      <div class="gaton-search-box">
        <form action="" method="get">
          <input type="text" name="term" id="term" placeholder="Enter search term">
          <button type="sumbit" class="submit">Search</button>
        </form>
      </div>

    <?php
      // Start the Loop.
      $term = sanitize_text_field($_GET['term']);
      echo do_shortcode('[ajax_load_more id="5032124631" search="' . $term . '" container_type="div" post_type="pet" posts_per_page="2" button_label="Load More"]');
      // while (have_posts()) :
      //   the_post();
      //   /*
      // 		 * Include the post format-specific template for the content. If you want
      // 		 * to use this in a child theme, then include a file called content-___.php
      // 		 * (where ___ is the post format) and that will be used instead.
      // 		 */
      //   get_template_part('content', 'shelter');

      // endwhile;
      // Previous/next page navigation.
      twentyfourteen_paging_nav();

    else :
      // If no content, include the "No posts found" template.
      get_template_part('content', 'none');

    endif;
    ?>
  </div><!-- #content -->
</section><!-- #primary -->

<?php
get_sidebar('content');
get_sidebar();
get_footer();
