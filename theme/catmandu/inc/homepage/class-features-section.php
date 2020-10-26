<?php
/**
 * Homepage features section
 *
 * Catmandu
 * @since 1.0.0
 * @author CodeManas 2020. All Rights reserved.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! class_exists( 'Catmandu_Features_Section' ) ) {
	/**
	 * Constructor
	 */

	class Catmandu_Features_Section extends Catmandu_Homepage {

		static $data_arr = [];
		
		public static function render_from_post() {
			$features_posts = Catmandu_Theme_Options::get_option( 'homepage-features-post-repeater' );

			foreach ( $features_posts as $features ) {
				$post_id = absint( $features['post'] );

				$post_arr['title'] = get_the_title( $post_id );
				$post_arr['url'] = get_permalink( $post_id );
				$post_arr['content'] = get_the_excerpt( $post_id );

				$post_arr['icon'] = $features['icon'];
				array_push( self::$data_arr, $post_arr );
			}


			return apply_filters( 'catmandu_features_post_data_arr', self::$data_arr );
		}

		public static function render_from_category() {
			$features_cat = Catmandu_Theme_Options::get_option( 'homepage-features-category' );
			$cat_query = new WP_Query( 
				array(
					'post_type'				=> 'post',
					'ignore_sticky_posts'	=> true,
					'posts_per_page'		=> 999,
					'cat'					=> absint( $features_cat ),
				)
			);



			$post_merging_arr = [];
			$features_cat_content = Catmandu_Theme_Options::get_option( 'homepage-features-cat-repeater' );
			foreach ( $features_cat_content as $features ) {
				
				$post_content['icon'] = $features['icon'];

				array_push( $post_merging_arr, $post_content );
			}

			// Defining a new array to be merged later
			// Since there are two loops, the result of two loops will have double arrays to be merged, it is defined such that the data in this array will be merged with later formed array and structure will be like that of previous ones.
			$i = 0;
			while ( $cat_query->have_posts() ): 
				$cat_query->the_post();
				$post_id = get_the_ID();
				$post_arr['title'] = get_the_title();
				$post_arr['url']   = get_permalink();
				$post_arr['content'] = get_the_excerpt( $post_id );

				if ( ! empty( $post_merging_arr[$i] ) ) {
					$post_merged_arr = array_merge( $post_merging_arr[ $i ], $post_arr );

					array_push( self::$data_arr, $post_merged_arr );
				} else {
					array_push( self::$data_arr, $post_arr );
				}

				$i++;

			endwhile; 
			wp_reset_postdata();

			return apply_filters( 'catmandu_features_category_data_arr', self::$data_arr );
		}



		public static function render_content() {
			$features_enable = Catmandu_Theme_Options::get_option( 'homepage-features-enable' );

			if ( ! $features_enable ) {
				return;
			}

			$subtitle = Catmandu_Theme_Options::get_option( 'homepage-features-subtitle' );
			$title = Catmandu_Theme_Options::get_option( 'homepage-features-title' );

			$layout = '1';
			$background = 'lite';

			$features_content = Catmandu_Theme_Options::get_option( 'homepage-features-content' );
			if ( 'post' === $features_content ) {
				$data_arr = self::render_data( self::render_from_post() );
			} elseif ( 'category' === $features_content ) {
				$data_arr = self::render_data( self::render_from_category() );
			}

			?>
	 		
			<aside class="section section-services <?php echo esc_attr( $background ); ?>-background service-layout-<?php echo esc_attr( $layout ); ?>">
				<div class="container">
	 				
	 				<div class="section-title-wrap">

	 					<?php if ( ! empty( $subtitle ) ) { ?>
	 						<p class="section-top-subtitle"><?php echo esc_html( $subtitle ); ?></p>
	 					<?php } ?>

	 					<?php if ( ! empty( $title ) ) { ?>
	 						<h2 class="section-title"><?php echo esc_html( $title ); ?></h2>
	 					<?php } ?>

	 					<span class="divider"></span>
	 				</div>
					
					<div class="service-block-list">
						<div class="inner-wrapper">
				
							<?php foreach ( $data_arr  as $data ) : ?>
								<div class="col-grid-4 service-block-item">
									<div class="service-block-inner box-shadow-block">

										<a class="service-icon" href="<?php echo esc_url( $data['url'] ); ?>" ><i class="icon-<?php echo esc_attr( $data["icon"] ); ?>"></i></a>

										<div class="service-block-inner-content">
												
												<?php if ( ! empty( $data['title'] ) ) { ?>
													<h3 class="service-item-title">
														<a href="<?php echo esc_url( $data['url'] ); ?>"><?php echo esc_html( $data['title'] ); ?></a>
													</h3>
	 											<?php } ?>

												<?php if ( ! empty( $data['content'] ) ) { ?>
													<div class="service-block-item-excerpt">
														<p><?php echo wp_kses_post( $data['content'] ); ?></p>
														<?php if ( ! empty( $data['url'] ) ) { ?>
															<a href="<?php echo esc_url( $data['url'] ); ?>" class="more-link button-curved"><?php echo esc_html__( 'Know More', 'catmandu' ); ?></a>
			 											<?php } ?>
													</div><!-- .service-block-item-excerpt -->
	 											<?php } ?>


										</div><!-- .service-block-inner-content -->

									</div> <!-- .service-block-inner -->
								</div> <!-- .featured-page-grid-item  -->

							<?php endforeach; ?>
						</div> <!-- .inner-wrapper -->
					</div> <!-- .service-block-list -->
	 			</div> <!-- .container -->
			</aside> <!-- .section section-services -->
		
		<?php
		}
	}

	new Catmandu_Features_Section();
}

