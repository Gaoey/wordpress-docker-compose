<?php
/**
 * Homepage cta section
 *
 * Catmandu
 * @since 1.0.0
 * @author CodeManas 2020. All Rights reserved.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! class_exists( 'Catmandu_CTA_Section' ) ) {
	/**
	 * Constructor
	 */

	class Catmandu_CTA_Section extends Catmandu_Homepage {

		static $data_arr = [];
		
		public static function render_from_post() {
			$cta_post = Catmandu_Theme_Options::get_option( 'homepage-cta-post' );

			$post_id = absint( $cta_post );

			$post_arr['title'] = get_the_title( $post_id );
			$post_arr['img'] = get_the_post_thumbnail( $post_id );
			$post_arr['url'] = get_permalink( $post_id );
			$post_arr['content'] = get_the_excerpt( $post_id );

			$post_arr['btn-txt']          = Catmandu_Theme_Options::get_option( 'homepage-cta-btn-txt' );

			array_push( self::$data_arr, $post_arr );

			return apply_filters( 'catmandu_cta_post_data_arr', self::$data_arr );
		}

		public static function render_content() {
			$cta_enable = Catmandu_Theme_Options::get_option( 'homepage-cta-enable' );

			if ( 'disable' === $cta_enable ) {
				return;
			}

			$subtitle = Catmandu_Theme_Options::get_option( 'homepage-cta-subtitle' ); 

			$data_arr = self::render_data( self::render_from_post() );

			?>
	 		
			<?php foreach ( $data_arr  as $data ) : ?>
		 		<aside class="section section-call-to-action cta-fluid no-padding-btm">
		 			<div class="call-to-action-inner-wrapper">
		 				<div class="container">
		 					<div class="call-to-action-content">
		 						<div class="call-to-action-description">
		 							<div class="call-to-action-description">
										
										<?php if ( ! empty( $subtitle ) ) { ?>
											<p class="section-top-subtitle"><?php echo esc_html( $subtitle ) ; ?></p>
				 						<?php } ?>

										<?php if ( ! empty( $data['title'] ) ) { ?>
				 							<h2 class="section-title"><?php echo esc_html( $data['title'] ) ; ?></h2>
				 						<?php } ?>
					 						
				 						<span class="divider"></span>
										
										<?php if ( ! empty( $data['content'] ) ) { ?>
				 							<p class="section-subtitle"><?php echo wp_kses_post( $data['content'] ) ; ?></p>
				 						<?php } ?>
			
									</div><!-- .call-to-action-description -->
									<?php if ( ! empty( $data['url'] ) ) { ?>
										<div class="call-to-action-buttons">
											<a href="<?php echo esc_url( $data['url'] ); ?>"  class="custom-button button-curved custom-primary"><?php echo esc_html__( 'Go Now', 'catmandu' ) ; ?></a>
										</div><!-- .call-to-action-buttons -->
				 					<?php } ?>
									
									<?php 
									if ( ! empty( $data['img'] ) ) {
										echo $data['img']; 
									}
									?>

								</div><!-- .inner-wrapper -->
		 					</div> <!-- .call-to-action-content -->
		 				</div><!-- .section-cta -->
					</div> <!-- .call-to-action-inner-wrapper" -->
		 		</aside> <!-- .section-call-to-action -->
		 	<?php endforeach; ?>
		
		<?php
		}
	}

	new Catmandu_CTA_Section();
}

