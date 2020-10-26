<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * Catmandu
 * @since 1.0.0
 * @author CodeManas 2020. All Rights reserved.
 */

if ( ! function_exists( 'catmandu_post_posted_on' ) ) :
	/**
	 * Prints HTML with meta information for the current post-date/time.
	 */
	function catmandu_post_posted_on() {
		$enable = true;
		if ( ! empty( $enable ) ) {
			$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';

			$time_string = sprintf( $time_string, esc_attr( get_the_date( DATE_W3C ) ), esc_html( get_the_date() ) );

			$posted_on = '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>';

			echo '<span class="posted-on">' . $posted_on . '</span>'; // WPCS: XSS OK.
		}
	}
endif;

if ( ! function_exists( 'catmandu_post_posted_by' ) ) :
	/**
	 * Prints HTML with meta information for the current author.
	 */
	function catmandu_post_posted_by() {
		$enable = Catmandu_Theme_Options::get_option( 'field-blog-author-enable' );
		if ( ! empty( $enable ) && ! empty( get_the_author() ) ) {
			echo '<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'; // WPCS: XSS OK.
		}
	}
endif;

if ( ! function_exists( 'catmandu_post_category_links' ) ) :
	/**
	 * Prints Category for Current Post
	 */
	function catmandu_post_category_links() {
		// Hide category and tag text for pages.
		if ( 'post' === get_post_type() ) {
			$tags = true;
			if ( ! empty( $tags ) ) {
				/* translators: used between list items, there is a space after the comma */
				$tags_list = get_the_tag_list( '', ', ' );
				if ( $tags_list ) {
					echo '<span class="cat-tags-links">' . $tags_list . '</span>'; // WPCS: XSS OK.
				}
			}

			$cats = true;
			if ( ! empty( $cats ) ) {
				/* translators: used between list items, there is a space after the comma */
				$categories_list = get_the_category_list( ', ' );
				if ( $categories_list ) {
					echo '<span class="cat-links">' . $categories_list . '</span>'; // WPCS: XSS OK.
				}
			}
		}
	}
endif;

if ( ! function_exists( 'catmandu_post_leave_comment' ) ) :
	/**
	 * Prints Comment string on post
	 */
	function catmandu_post_leave_comment() {
		$comments = true;
		if ( ! empty( $comments ) ) {
			if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
				echo '<span class="comments-link">';
				comments_popup_link(
					sprintf(
						wp_kses( /* translators: %s: post title */
							__( 'Leave a Comment<span class="screen-reader-text"> on %s</span>', 'catmandu' ),
							array(
								'span' => array(
									'class' => array(),
								),
							)
						),
						get_the_title()
					)
				);
				echo '</span>';
			}
		}
	}
endif;

if ( ! function_exists( 'catmandu_post_thumbnail' ) ) :
	/**
	 * Displays an optional post thumbnail.
	 *
	 * Wraps the post thumbnail in an anchor element on index views, or a div
	 * element when on single views.
	 */
	function catmandu_post_thumbnail() {
		if ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) {
			return;
		}

		if ( is_singular() ) :
			?>

			<?php the_post_thumbnail(); ?>

		<?php else : ?>

			<a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
				<?php
				the_post_thumbnail(
					'post-thumbnail',
					array(
						'alt' => the_title_attribute(
							array(
								'echo' => false,
							)
						),
					)
				);
				?>
			</a>

			<?php
		endif; // End is_singular().
	}
endif;
