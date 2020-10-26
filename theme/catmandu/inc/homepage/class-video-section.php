<?php
/**
 * Homepage video section
 *
 * Catmandu
 * @since 1.0.0
 * @author CodeManas 2020. All Rights reserved.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! class_exists( 'Catmandu_Video_Section' ) ) {
	/**
	 * Constructor
	 */

	class Catmandu_Video_Section extends Catmandu_Homepage {

		static $data_arr = [];
		
		public static function render_from_post() {
			$video_post = Catmandu_Theme_Options::get_option( 'homepage-video-post' );

			$post_id = absint( $video_post );

			$post_arr['title'] = get_the_title( $post_id );
			$post_arr['img'] = get_the_post_thumbnail_url( $post_id );
			$post_arr['content'] = get_the_excerpt( $post_id );

			array_push( self::$data_arr, $post_arr );

			return apply_filters( 'catmandu_video_post_data_arr', self::$data_arr );
		}

		public static function render_from_page() {
			$video_page = Catmandu_Theme_Options::get_option( 'homepage-video-page' );

			$page_id = absint( $video_page );

			$page_arr['title'] = get_the_title( $page_id );
			$page_arr['img'] = get_the_post_thumbnail_url( $page_id );
			$page_arr['content'] = get_the_content( null, false, $page_id );

			array_push( self::$data_arr, $page_arr );

			
			return apply_filters( 'catmandu_video_page_data_arr', self::$data_arr );
		}

		public static function render_from_custom() {
				$custom_arr['title']        = Catmandu_Theme_Options::get_option( 'homepage-video-title' );
				$custom_arr['content']    = Catmandu_Theme_Options::get_option( 'homepage-video-desc' );
				$custom_arr['img']          = Catmandu_Theme_Options::get_option( 'homepage-video-image' );

				array_push( self::$data_arr, $custom_arr );
				
			return apply_filters( 'catmandu_video_custom_data_arr', self::$data_arr );
		}


		public static function render_content() {
			$video_enable = Catmandu_Theme_Options::get_option( 'homepage-video-enable' );

			if ( ! $video_enable ) {
				return;
			}

			$video_link = Catmandu_Theme_Options::get_option( 'homepage-video-link' ); 
			$image_overlay_enable = Catmandu_Theme_Options::get_option( 'homepage-video-overlay-enable' );
			$overlay_class = ( $image_overlay_enable ) ? 'overlay-enabled' : '';

			$data_arr = self::render_data( self::render_from_post() );

			?>
	 		
			<?php foreach ( $data_arr  as $data ) : ?>
		 		<aside style="background-image: url(<?php echo esc_url( $data['img'] ); ?>);" class="section section-video background-img <?php echo esc_attr( $overlay_class ); ?>">
	 				<div class="container">
	 					<div class="section-title-wrap">
								<?php if ( ! empty( $data['title'] ) ) { ?>
		 							<h2 class="section-title"><?php echo esc_html( $data['title'] ) ; ?></h2>
		 						<?php } ?>
		 						
		 						<span class="divider"></span>
								
								<?php if ( ! empty( $data['content'] ) ) { ?>
		 							<p class="section-subtitle"><?php echo wp_kses_post( $data['content'] ) ; ?></p>
		 						<?php } ?>

	 					</div> <!-- .section-title-wrap -->
						
						<?php if ( ! empty( $video_link ) ) { ?>
	 						<a  class="media-zoom-icon" data-gal="prettyPhoto" rel="bookmark" href="<?php echo esc_url( $video_link ); ?>"><i class="fas fa-play"></i></a>
	 					<?php } ?>
	 				</div><!-- .section-video -->
		 		</aside> <!-- .section-call-to-action -->
		 	<?php endforeach; ?>
		
		<?php
		}
	}

	new Catmandu_Video_Section();
}

