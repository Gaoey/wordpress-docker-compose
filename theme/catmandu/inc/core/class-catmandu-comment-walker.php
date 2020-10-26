<?php
if ( ! function_exists( 'catmandu_show_comments' ) ) {
	/**
	 * Show main Comments section
	 */
	function catmandu_show_comments() {
		?>
        <h4 class="comments-title-section">
				<span>
				<?php
				$code_manas_comment_count = get_comments_number();
				if ( '1' === $code_manas_comment_count ) {
					printf( /* translators: 1: title. */
						esc_html__( '1 comment', 'catmandu' ), '<span>' . get_the_title() . '</span>' );
				} else {
					printf( esc_html( _nx( '%1$s comment', '%1$s comments', $code_manas_comment_count, 'comments title', 'catmandu' ) ), number_format_i18n( $code_manas_comment_count ), '<span>' . get_the_title() . '</span>' );
				}
				?>
				</span>
        </h4>

        <ol class="comment-list">
			<?php
			wp_list_comments( array(
				'style'       => 'ol',
				'max_depth'   => 4,
				'short_ping'  => true,
				'avatar_size' => '100',
			) );
			?>
        </ol>
		<?php
	}
}