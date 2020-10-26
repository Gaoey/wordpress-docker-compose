<?php
/**
 * The template for displaying comments
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * Catmandu
 * @since 1.0.0
 * @author CodeManas 2020. All Rights reserved.
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>

<div id="comments" class="comments-area">
	<?php

	if ( have_comments() ) :
		?>
        <div class="comment-wrapper">
			<?php
			catmandu_main_comments();

			the_comments_navigation();

			if ( ! comments_open() ) :
				?>
                <p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'catmandu' ); ?></p>
			<?php
			endif;
			?>
        </div>
	<?php
	endif;
	
	comment_form();
	?>
</div>
