<?php
/**
 * Homepage news section
 *
 * Catmandu
 * @since 1.0.0
 * @author CodeManas 2020. All Rights reserved.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! class_exists( 'Catmandu_News_Section' ) ) {
	/**
	 * Constructor
	 */

	class Catmandu_News_Section extends Catmandu_Homepage {

		static $data_arr = [];
		
		public static function render_from_post() {
			$news_posts = Catmandu_Theme_Options::get_option( 'homepage-news-post-repeater' );

			foreach ( $news_posts as $news ) {
				$post_id = absint( $news['post'] );

				$cats = get_the_category( $post_id );

				$post_arr['title'] = get_the_title( $post_id );
				$post_arr['img'] = get_the_post_thumbnail( $post_id );
				$post_arr['date'] = get_the_date( get_option( 'date_format' ), $post_id );
				if ( ! empty( $cats[0] ) ) {
					$post_arr['cat'] = $cats[0]->name;
				}
				$post_arr['url'] = get_permalink( $post_id );
				$post_arr['content'] = get_the_excerpt( $post_id );

				array_push( self::$data_arr, $post_arr );
			}

			return apply_filters( 'catmandu_news_post_data_arr', self::$data_arr );
		}

		public static function render_from_category() {
			$news_cat = Catmandu_Theme_Options::get_option( 'homepage-news-category' );
			$cat_query = new WP_Query( 
				array(
					'post_type'				=> 'post',
					'ignore_sticky_posts'	=> true,
					'cat'					=> absint( $news_cat ),
					'posts_per_page'		=> 999,
				)
			);

			// Defining a new array to be merged later
			// Since there are two loops, the result of two loops will have double arrays to be merged, it is defined such that the data in this array will be merged with later formed array and structure will be like that of previous ones.
			$i = 0;
			while ( $cat_query->have_posts() ): 
				$cat_query->the_post();
				
				$post_id = get_the_ID();
				$post_arr['title'] = get_the_title();
				$post_arr['img']   = get_the_post_thumbnail();
				$post_arr['cat'] = get_cat_name( absint( $news_cat ) );

				$post_arr['date'] = get_the_date( get_option( 'date_format' ), $post_id );
				$post_arr['url']   = get_permalink();
				$post_arr['content'] = get_the_excerpt( $post_id );

				array_push( self::$data_arr, $post_arr );

				$i++;

			endwhile; 
			wp_reset_postdata();

			return apply_filters( 'catmandu_news_category_data_arr', self::$data_arr );
		}



		public static function render_content() {
			$news_enable = Catmandu_Theme_Options::get_option( 'homepage-news-enable' );

			if ( ! $news_enable ) {
				return;
			}

			$subtitle = Catmandu_Theme_Options::get_option( 'homepage-news-subtitle' );
			$title = Catmandu_Theme_Options::get_option( 'homepage-news-title' );

			$news_btn_txt = esc_html__( 'Explore More', 'catmandu' );
			$news_btn_url = Catmandu_Theme_Options::get_option( 'homepage-news-btn-url' );

			$content_layout = array( 'image', 'content' );

			$columns = '4';

			$news_content = Catmandu_Theme_Options::get_option( 'homepage-news-content' );
			if ( 'post' === $news_content ) {
				$data_arr = self::render_data( self::render_from_post() );
			} elseif ( 'category' === $news_content ) {
				$data_arr = self::render_data( self::render_from_category() );
			}

			?>
	 		
	 		<aside class="section section-latest-posts">
				<div class="container">
	 				<div class="latest-posts-section">

		 				<div class="section-title-wrap">

		 					<?php if ( ! empty( $subtitle ) ) { ?>
		 						<p class="section-top-subtitle"><?php echo esc_html( $subtitle ); ?></p>
		 					<?php } ?>

		 					<?php if ( ! empty( $title ) ) { ?>
		 						<h2 class="section-title"><?php echo esc_html( $title ); ?></h2>
		 					<?php } ?>

		 					<span class="divider"></span>
		 					
		 				</div>
						
						<div class="inner-wrapper">
				
							<?php foreach ( $data_arr  as $data ) : ?>
								<div class="col-grid-<?php echo esc_attr( $columns ); ?> latest-posts-item">
									<div class="latest-posts-wrapper box-shadow-block">

										<?php 
										$image = '';
										if ( ! empty( $data['img'] ) ) { 
											$image = '<div class="latest-posts-thumb">
														<a href="' . esc_url( $data['url'] ) . '" >' . $data['img'] . '</a>
													</div>';
										?>
	 									<?php } ?>


	 									<?php ob_start(); ?>
										<div class="latest-posts-text-content-wrapper">
											<div class="latest-posts-text-content">
												
												<?php if ( ! empty( $data['title'] ) ) { ?>
													<h3 class="latest-posts-title">
														<a href="<?php echo esc_url( $data['url'] ); ?>"><?php echo esc_html( $data['title'] ); ?></a>
													</h3>
	 											<?php } ?>

	 											<div class="entry-meta latest-posts-meta">

													<?php if ( ! empty( $data['date'] ) ) { ?>
	 													<span class="posted-on"><?php echo esc_html( $data['date'] ); ?></span>
	 												<?php } ?>

													<?php if ( ! empty( $data['cat'] ) ) { ?>
	 													<span class="cat-links"><?php echo esc_html( $data['cat'] ); ?></span>
	 												<?php } ?>

	 											</div>

												<?php if ( ! empty( $data['content'] ) ) { ?>
													<div class="latest-posts-summary">
														<p><?php echo wp_kses_post( $data['content'] ); ?></p>
													</div>
	 											<?php } ?>

												<?php if ( ! empty( $data['url'] ) ) { ?>
													<a href="<?php echo esc_url( $data['url'] ); ?>" class="more-link button-curved"><?php echo esc_html__( 'Know More', 'catmandu' ); ?></a>
	 											<?php } ?>

											</div> <!-- .latest-posts-text-content -->
										</div> <!-- .latest-posts-text-content-wrapper -->
										<?php 
										$content = ob_get_contents();
										ob_end_clean();

										foreach( $content_layout as $value ) {
										   	echo $$value;
										}
										?>

									</div> <!-- .latest-posts-wrapper -->
								</div> <!-- .latest-posts-item  -->

							<?php endforeach; ?>

							<?php if ( ! empty( $news_btn_txt ) ){ ?>
								<div class="more-wrapper">
									<a href="<?php echo esc_url( $news_btn_url ); ?>" class="custom-button button-curved"><?php echo esc_html( $news_btn_txt ); ?></a>
								</div> <!-- .more-wrapper -->
	 						<?php } ?>

						</div> <!-- .inner-wrapper -->

					</div> <!-- .latest-posts-section -->
	 			</div> <!-- .container -->
			</aside> <!-- .section-latest-posts -->
		
		<?php
		}
	}

	new Catmandu_News_Section();
}

