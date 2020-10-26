<?php
/**
 * Homepage projects section
 *
 * Catmandu
 * @since 1.0.0
 * @author CodeManas 2020. All Rights reserved.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! class_exists( 'Catmandu_Projects_Section' ) ) {
	/**
	 * Constructor
	 */

	class Catmandu_Projects_Section extends Catmandu_Homepage {

		static $data_arr = [];
		
		public static function render_from_post() {
			$projects_posts = Catmandu_Theme_Options::get_option( 'homepage-projects-post-repeater' );

			foreach ( $projects_posts as $projects ) {
				$post_id = absint( $projects['post'] );

				$cats = get_the_category( $post_id );

				$post_arr['title'] = get_the_title( $post_id );
				$post_arr['img'] = get_the_post_thumbnail( $post_id );

				if( ! empty( $cats[0] ) ) {
					$post_arr['cat'] = $cats[0]->name;
				}
				$post_arr['url'] = get_permalink( $post_id );
				$post_arr['content'] = get_the_excerpt( $post_id );

				array_push( self::$data_arr, $post_arr );
			}

			return apply_filters( 'catmandu_projects_post_data_arr', self::$data_arr );
		}

		public static function render_from_category() {
			$projects_cat = Catmandu_Theme_Options::get_option( 'homepage-projects-category' );
			$cat_query = new WP_Query( 
				array(
					'post_type'				=> 'post',
					'ignore_sticky_posts'	=> true,
					'posts_per_page'		=> 999,
					'cat'					=> absint( $projects_cat ),
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
				$post_arr['cat'] = get_cat_name( absint( $projects_cat ) );
				$post_arr['url']   = get_permalink();
				$post_arr['content'] = get_the_excerpt( $post_id );
				
				array_push( self::$data_arr, $post_arr );

				$i++;

			endwhile; 
			wp_reset_postdata();

			return apply_filters( 'catmandu_projects_category_data_arr', self::$data_arr );
		}



		public static function render_content() {
			$projects_enable = Catmandu_Theme_Options::get_option( 'homepage-projects-enable' );

			if ( ! $projects_enable ) {
				return;
			}

			$subtitle = Catmandu_Theme_Options::get_option( 'homepage-projects-subtitle' );
			$title = Catmandu_Theme_Options::get_option( 'homepage-projects-title' );

			$content_layout = Catmandu_Theme_Options::get_option( 'projects-content-sort' );

			$projects_content = Catmandu_Theme_Options::get_option( 'homepage-projects-content' );
			if ( 'post' === $projects_content ) {
				$data_arr = self::render_data( self::render_from_post() );
			} elseif ( 'category' === $projects_content ) {
				$data_arr = self::render_data( self::render_from_category() );
			}

			?>
	 		
	 		<aside class="section section-project">
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
					
					<div class="project-section">
			
						<?php 
						$i = 0;
						foreach ( $data_arr  as $data ) : ?>
							<div class="project-block">
							  	<div class="project-inner">

									<?php if ( ! empty( $data['img'] ) ) { ?>
									    <div class="project-thumb <?php echo ( $i % 2 === 0 ) ? 'alignright' : 'alignleft'; ?>">
									    	<a href="<?php echo esc_url( $data['url'] ); ?>" ><?php echo $data['img']; ?></a>
									    </div><!-- .project-thumb -->
	 								<?php } ?>

								    <div class="featured-project-section">

								    	<?php if ( ! empty( $data['cat'] ) ) { ?>
											<div class="featured-project-meta">
												<span class="featured-project-category"><?php echo esc_html( $data['cat'] ); ?></span>
											</div> <!-- .featured-project-meta -->
		 								<?php } ?>

									    <?php if ( ! empty( $data['title'] ) ) { ?>
									    	<h2><?php echo esc_html( $data['title'] ); ?></h2>
		 								<?php } ?>

										<?php if ( ! empty( $data['content'] ) ) { ?>
									    	<p><?php echo wp_kses_post( $data['content'] ); ?></p>
			 							<?php } ?>

										<?php if ( ! empty( $data['url'] ) ) { ?>
									    	<a href="<?php echo esc_url( $data['url'] ); ?>" class="custom-button button-curved"><?php echo esc_html__( 'Know More', 'catmandu' ); ?></a>
			 							<?php } ?>

								    </div><!-- .featured-project-section -->

								</div>   <!-- .block-inner -->
							</div> <!-- .project-block -->

						<?php 
						$i++;
						endforeach; ?>

					</div> <!-- .project-section -->

	 			</div> <!-- .container -->
			</aside> <!-- .section-latest-posts -->
		
		<?php
		}
	}

	new Catmandu_Projects_Section();
}

