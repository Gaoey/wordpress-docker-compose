<?php
/**
 * Homepage sections
 *
 * Catmandu
 * @since 1.0.0
 * @author CodeManas 2020. All Rights reserved.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! class_exists( 'Catmandu_Slider_Section' ) ) {
	/**
	 * Constructor
	 */

	class Catmandu_Slider_Section extends Catmandu_Homepage {

		static $data_arr = [];
		
		public static function render_from_post() {
			$slider_posts = Catmandu_Theme_Options::get_option( 'homepage-slider-post-repeater' );

			foreach ( $slider_posts as $slider ) {
				$post_id = absint( $slider['post'] );

				$post_arr['title'] = get_the_title( $post_id );
				$post_arr['img'] = get_the_post_thumbnail( $post_id );
				$post_arr['url'] = get_permalink( $post_id );

				$post_arr['button_2_url'] = $slider['button_2_url'];
				$post_arr['button_1_url'] = $slider['button_1_url'];

				array_push( self::$data_arr, $post_arr );


			}
			
			return apply_filters( 'catmandu_slider_post_data_arr', self::$data_arr );
		}

		public static function render_from_category() {
			$slider_cat = Catmandu_Theme_Options::get_option( 'homepage-slider-category' );
			$cat_query = new WP_Query( 
				array(
					'post_type'				=> 'post',
					'ignore_sticky_posts'	=> true,
					'posts_per_page'		=> 999,
					'cat'					=> absint( $slider_cat ),
				)
			);

			// Defining a new array to be merged later
			// Since there are two loops, the result of two loops will have double arrays to be merged, it is defined such that the data in this array will be merged with later formed array and structure will be like that of previous ones.

			$post_merging_arr = [];
			$slider_cat_content = Catmandu_Theme_Options::get_option( 'homepage-slider-cat-repeater' );
			foreach ( $slider_cat_content as $slider ) {
				
				$post_content['button_2_url'] = $slider['button_2_url'];
				$post_content['button_1_url'] = $slider['button_1_url'];

				array_push( $post_merging_arr, $post_content );
			}

			$i = 0;
			while ( $cat_query->have_posts() ): 
				$cat_query->the_post();
				
				$post_arr['title'] = get_the_title();
				$post_arr['img']   = get_the_post_thumbnail();
				$post_arr['url']   = get_permalink();

				if ( ! empty( $post_merging_arr[$i] ) ) {
					$post_merged_arr = array_merge( $post_merging_arr[ $i ], $post_arr );
					array_push( self::$data_arr, $post_merged_arr );
				} else {
					array_push( self::$data_arr, $post_arr );
				}
				$i++;

			endwhile; 
			wp_reset_postdata();

			return apply_filters( 'catmandu_slider_category_data_arr', self::$data_arr );
		}



		public static function render_content() {
			$slider_enable = Catmandu_Theme_Options::get_option( 'homepage-slider-enable' );

			if ( ! $slider_enable ) {
				return;
			}

			$homepage_slider_text_position = Catmandu_Theme_Options::get_option( 'homepage-slider-text-position' );
			$text_align_class = "text-alignleft";
			if ( 'center' === $homepage_slider_text_position ) {
				$text_align_class = "text-aligncenter";
			} elseif ( 'right' === $homepage_slider_text_position ) {
				$text_align_class = "text-alignright";
			}

			$slider_pause_enable = true;
			$slider_next_icon_enable = false;
			$slider_pager_enable = true;

			$slider_overlay_enable = true;
			$overlay_class = ( $slider_overlay_enable ) ? 'overlay-enabled' : '';

			$slider_transitions = 'fadeout';
			$slider_speed = '3000';


			$slider_content = Catmandu_Theme_Options::get_option( 'homepage-slider-content' );
			if ( 'post' === $slider_content ) {
				$data_arr = self::render_data( self::render_from_post() );
			} elseif ( 'category' === $slider_content ) {
				$data_arr = self::render_data( self::render_from_category() );
			}
			?>
	 		
	 		<aside class="section section-featured-slider">
	 			<div id="main-slider"  class="cycle-slideshow <?php echo esc_attr( $overlay_class ); ?> featrued-slider" data-cycle-fx="<?php echo esc_attr( $slider_transitions); ?>"  data-cycle-speed="1000"  data-cycle-pause-on-hover="<?php echo esc_attr( $slider_pause_enable ); ?>"  data-cycle-loader="true"  data-cycle-log="false"  data-cycle-swipe="true" data-cycle-auto-height="container"  data-cycle-timeout="<?php echo absint( $slider_speed ); ?>"  data-cycle-slides="article" data-pager-template='<span class="pager-box"></span>'>
	 				
	 				<?php if ( $slider_next_icon_enable ) : ?>
		 				<!-- prev/next links -->
		 				<div class="cycle-prev button-circle button-circle"><i class="fas fa-angle-left" aria-hidden="true"></i></div>
		 				<div class="cycle-next button-circle button-circle"><i class="fas fa-angle-right" aria-hidden="true"></i></div>
	 				<?php endif; ?>

	 				<?php if ( $slider_pager_enable ) : ?>
		 				<!-- pager -->
		 				<div class="cycle-pager"> </div>
	 				<?php endif; ?>

					<?php foreach ( $data_arr  as $data ) : ?>
		 				
		 				<?php if ( ! empty( $data['img'] ) ) { ?>
		 				
			 				<article class="first">
			 					<div class="caption">
			 						<div class="cycle-caption <?php echo esc_attr( $text_align_class ); ?>">
											
											<?php if ( ! empty( $data['title'] ) ) { ?>
			 									<h3>
			 											<a href="<?php echo esc_url( $data['url'] ); ?>" >

			 											<?php echo wp_kses_post( $data['title'] ); ?>

			 											</a>
			 									</h3>
											<?php } ?>

			 								<div class="slider-buttons">

			 									<?php if ( ! empty( $data['button_1_url'] ) ) { ?>
		 										<a class="custom-button button-curved" href="<?php echo esc_url( $data['button_1_url'] ); ?>"><?php echo esc_html__( 'Learn More', 'catmandu' ); ?></a>
			 									<?php } ?>
											
			 									<?php if ( ! empty( $data['button_2_url'] ) ) { ?>
												<a class="custom-button button-curved custom-secondary-button" href="<?php echo esc_url( $data['button_2_url'] ); ?>"><?php echo esc_html__( 'About Us', 'catmandu' ); ?></a>
			 									<?php } ?>
			 								</div> <!-- .slider-buttons -->

			 						</div> <!-- .cycle-caption -->
			 					</div> <!-- .caption -->

			 					<?php if ( ! empty( $data['img'] ) ) { ?>

				 					<a href="<?php  echo esc_url( $data['url'] ); ?>"  >
				 						<?php echo $data['img']; ?>
				 					</a>

			 					<?php } ?>

			 				</article>  <!-- article -->
		 				
		 				<?php } ?>

					<?php endforeach; ?>

	 			</div><!-- #main-slider -->
	 		</aside> <!-- .section-featured-slider -->
		
		<?php
		}
	}

	new Catmandu_Slider_Section();
}

