<?php
/**
 * Homepage newsletter section
 *
 * Catmandu
 * @since 1.0.0
 * @author CodeManas 2020. All Rights reserved.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! class_exists( 'Catmandu_Newsletter_Section' ) ) {
	/**
	 * Constructor
	 */

	class Catmandu_Newsletter_Section extends Catmandu_Homepage {

		static $data_arr = [];
		
		public static function render_from_post() {
			$newsletter_post = Catmandu_Theme_Options::get_option( 'homepage-newsletter-post' );

			$post_id = absint( $newsletter_post );

			$post_arr['title'] = get_the_title( $post_id );
			$post_arr['img'] = get_the_post_thumbnail_url( $post_id );
			$post_arr['content'] = get_the_excerpt( $post_id );

			array_push( self::$data_arr, $post_arr );

			return apply_filters( 'catmandu_newsletter_post_data_arr', self::$data_arr );
		}

		public static function render_content() {
			$newsletter_enable = Catmandu_Theme_Options::get_option( 'homepage-newsletter-enable' );

			if ( ! $newsletter_enable ) {
				return;
			}

			$newsletter_shortcode = Catmandu_Theme_Options::get_option( 'homepage-newsletter-shortcode' ); 
			$image_overlay_enable = Catmandu_Theme_Options::get_option( 'homepage-newsletter-overlay-enable' );
			$overlay_class = ( $image_overlay_enable ) ? 'overlay-enabled' : '';

			$data_arr = self::render_data( self::render_from_post() );

			?>
	 		
			<?php foreach ( $data_arr  as $data ) : ?>
		 		<aside style="background-image: url(<?php echo esc_url( $data['img'] ); ?>);" class="section section-news-letter background-img <?php echo esc_attr( $overlay_class ); ?>">
	 				<div class="container">
	 					<div class="news-letter-wrappers">
	 						<div class="inner-wrapper">
								<div class="col-grid-6">
									<div class="section-title-wrap text-alignleft">

										<?php if ( ! empty( $data['title'] ) ) { ?>
				 							<h2 class="section-title"><?php echo esc_html( $data['title'] ) ; ?></h2>
				 						<?php } ?>
				 						
				 						<span class="divider"></span>
										
										<?php if ( ! empty( $data['content'] ) ) { ?>
				 							<p class="section-subtitle"><?php echo wp_kses_post( $data['content'] ) ; ?></p>
				 						<?php } ?>
								
									</div>
								</div>

								<div class="col-grid-6">
									<?php echo do_shortcode( wp_kses_post( $newsletter_shortcode ) ) ; ?>
								</div>

							</div><!-- .inner-wrapper -->
	 					</div> <!-- .news-letter-wrappers -->
	 				</div><!-- .section-newsletter -->
		 		</aside> <!-- .section-call-to-action -->
		 	<?php endforeach; ?>
		
		<?php
		}
	}

	new Catmandu_Newsletter_Section();
}

