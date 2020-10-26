<?php /* Template Name: Homepage */

get_header();
?>

<div id="primary" class="content-area">
	<main id="main" class="site-main" >

		<?php
		catmandu_homepage_before_main_content();

		catmandu_homepage_main_content();

		catmandu_homepage_after_main_content();

		?>

	</main> <!-- #main -->
</div> <!-- #primary -->

<?php 

get_footer();