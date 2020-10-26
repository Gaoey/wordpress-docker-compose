<?php
/**
 * Head Render hook add action here
 *
 * Catmandu
 * @since 1.0.0
 * @author CodeManas 2020. All Rights reserved.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function catmandu_header_right_wrapper_start() {
	echo '<div id="header-right">';
}

function catmandu_header_right_wrapper_end() {
	echo '</div>';
}

function catmandu_top_header_right_wrapper_start() {
	echo '<div id="top-header-right">';
}

function catmandu_top_header_right_wrapper_end() {
	echo '</div>';
}

function catmandu_masthead_logo() {
	$display_site_title   = get_bloginfo( 'name' );
	$display_site_tagline = get_bloginfo( 'description' );
	$custom_logo          = has_custom_logo();

	$site_title_enable   = Catmandu_Theme_Options::get_option( 'field-identity-display-site-title' );
	$site_tagline_enable = Catmandu_Theme_Options::get_option( 'field-identity-display-site-tagline' );
	?>
    <div class="site-branding">
		<div id="site-identity">
			<?php
			//If we have a logo
			if ( $custom_logo ) {
				//Filter out the sizes first
				add_filter( 'wp_get_attachment_image_src', 'catmandu_header_logo_attr', 10, 4 );

				echo get_custom_logo();

				//UNhook to remove any errors that might be caused in other images
				remove_filter( 'wp_get_attachment_image_src', 'catmandu_header_logo_attr', 10 );
			}
			?>
			
			<?php if ( ! empty( $site_title_enable ) || ! empty( $site_tagline_enable ) ) { ?>
				
				<div class="site-title-wrapper">

					<?php if ( ! empty( $site_title_enable ) ) { ?>
			            <h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php echo $display_site_title; ?></a></h1>
					<?php }

					if ( ! empty( $site_tagline_enable ) ) { ?>
			            <p class="site-tagline"><?php echo $display_site_tagline; ?></p>
					<?php } ?>
				</div>
			
			<?php } ?>

		</div><!-- #site-identity -->
	</div><!-- .site-branding -->
	<?php
}

function catmandu_masthead_search() {
	$disable_search = Catmandu_Theme_Options::get_option( 'field-header-menu-disable-search' );

	if ( $disable_search ) {
		return;
	}
	?>
    <div id="header-search">
		<a href="#" class="search-icon"><i class="fa fa-search"></i></a>
		<div class="search-box-wrap">
			<div class="searchform" role="search">
				<?php get_search_form(); ?>
			</div><!-- .searchform -->
		</div><!-- .search-box-wrap -->
	</div> <!-- .header-search -->
	<?php
}

if( class_exists( 'woocommerce' ) ) {

	add_filter( 'woocommerce_add_to_cart_fragments', 'catmandu_refresh_mini_cart_count');
	function catmandu_refresh_mini_cart_count($fragments){
	    ob_start();
	    ?>
	    
	    <span id="catmandu-woo-cart-count"><?php echo absint( WC()->cart->get_cart_contents_count() ); ?></span>
	    
	    <?php
	    $fragments['#catmandu-woo-cart-count'] = ob_get_clean();
	    return $fragments;
	}
}

function catmandu_masthead_mini_cart() {
	if( ! class_exists( 'woocommerce' ) ) {
		return;
	}
	$disable_minicart = Catmandu_Theme_Options::get_option( 'field-header-menu-disable-minicart' );

	if ( $disable_minicart ) {
		return;
	}
	?>

		<div id="quick-link-buttons">
			<a href="<?php echo esc_url( wc_get_cart_url() ); ?>" class="cart-button">
				<i class="fas fa-cart-plus"></i><span id="catmandu-woo-cart-count"><?php echo absint( WC()->cart->get_cart_contents_count() ); ?></span>
			</a>
		</div><!-- #quick-link-buttons -->
	<?php
}

/**
 * Head navigation primary menu
 */

if( ! function_exists( 'catmandu_masthead_nav' ) ) {

	function catmandu_masthead_nav() {
		
		$header_design = 'header-1';

		$disable_menu = Catmandu_Theme_Options::get_option( 'field-header-menu-disable' );
		if ( ! $disable_menu ) { ?>

			<div id ="main-navigation" class=<?php echo catmandu_sticky_main_nav(); ?> >

				<?php

				if ( 'header-2' === $header_design ) {
					echo '<div class="container">';
				}

				catmandu_before_main_nav();

				?>

				<nav class="main-navigation">

						<?php
						wp_nav_menu( array(
							'theme_location' => 'primary-menu',
							'menu_class'  => 'primary-menu',
							'menu' => 'primary-menu'
						) );
						?>

				</nav> <!-- .site-navigation -->

				<?php

				catmandu_after_main_nav();

				if ( 'header-2' === $header_design ) {
					echo '</div>';
				}

				?>

			</div> <!-- #main-navigation -->
			<?php
		}
	}
}

/**
 * Customize Width According to settings from customizer.
 *
 * @param $image
 * @param $attachment_id
 * @param $size
 * @param $icon
 *
 * @return mixed
 */
function catmandu_header_logo_attr( $image, $attachment_id, $size, $icon ) {
	$logo_width = Catmandu_Theme_Options::get_option( 'field-identity-logo-width' );
	if ( ! empty( $logo_width ) ) {
		$image[1] = $logo_width;
		$image[2] = 0;
	}

	return $image;
}

/**
 * Check if transparent header and add class
 *
 * @param array $data
 *
 * @return mixed
 */
add_filter('body_class', 'catmandu_transparent_header' );
function catmandu_transparent_header( $classes = array() ) {
	$page_setting = Catmandu_Theme_Options::get_page_setting( 'transparent-header' );
	if( !empty( $page_setting ) && $page_setting === "disable" ) {
		$check = false;
	} else if( !empty( $page_setting ) && $page_setting === "enable" ) {
		$check = true;
	} else {
		$transparent_header = Catmandu_Theme_Options::get_option( 'field-header-transparent' );
		$catmandu_options     = array(
			'field-header-transparent-blog-page'    => Catmandu_Theme_Options::get_option( 'field-header-transparent-blog-page' ),
			'field-header-transparent-singular'     => Catmandu_Theme_Options::get_option( 'field-header-transparent-singular' ),
			'field-header-transparent-single-page'  => Catmandu_Theme_Options::get_option( 'field-header-transparent-single-page' ),
			'field-header-transparent-single-post'  => Catmandu_Theme_Options::get_option( 'field-header-transparent-single-post' ),
			'field-header-transparent-archive-page' => Catmandu_Theme_Options::get_option( 'field-header-transparent-archive-page' ),
			'field-header-transparent-404'          => Catmandu_Theme_Options::get_option( 'field-header-transparent-404' ),
			'field-header-transparent-search-page'  => Catmandu_Theme_Options::get_option( 'field-header-transparent-search-page' ),
		);

		//Check if transparent headers setting is on.
		// $check = flag
		if ( ! empty( $transparent_header ) ) {
			$check = true;

			if ( is_front_page() ) {
				$check = true;
			} else if ( is_home() ) {
				//Disable on Blog Listing page
				if ( ! empty( $catmandu_options['field-header-transparent-blog-page'] ) ) {
					$check = false;
				}
			} else if ( ! empty( $catmandu_options['field-header-transparent-singular'] ) ) {
				//Override Setting on all single pages and posts
				if ( is_singular() ) {
					$check = false;
				}
			} else if ( is_page() ) {
				//Disable on Single pages
				if ( ! empty( $catmandu_options['field-header-transparent-single-page'] ) ) {
					$check = false;
				}
			} else if ( is_single() ) {
				//Disable on Single post
				if ( ! empty( $catmandu_options['field-header-transparent-single-post'] ) ) {
					$check = false;
				}
			} else if ( is_archive() ) {
				//Disable on Archives
				if ( ! empty( $catmandu_options['field-header-transparent-archive-page'] ) ) {
					$check = false;
				}
			} else if ( is_404() ) {
				//Disable on 404
				if ( ! empty( $catmandu_options['field-header-transparent-404'] ) ) {
					$check = false;
				}
			} else if ( is_search() ) {
				//Disable on Search
				if ( ! empty( $catmandu_options['field-header-transparent-search-page'] ) ) {
					$check = false;
				}
			}
		} else {
			$check = false;
		}
	}

	if ( $check ) {
		$classes[] = 'header-v5';
	}

	return $classes;
}

/**
 * Show Page title banner in inner pages
 */
function catmandu_pageshow_title_in_banner() {
	$enable_title        = true;
	$breadcrumb_position = Catmandu_Theme_Options::get_option( 'field-breadcrumb-type' );

	if ( ! empty( $breadcrumb_position ) && $breadcrumb_position === "before-title" ) {
		Catmandu_Template_Functions::get_breadcrumbs( 'breadcrumb-after-header' );
	}

	if ( ! empty( $enable_title ) ) { ?>
		<h1 class="page-title">
		<?php
			if (is_singular() ) {
				single_post_title();
			} elseif ( is_404() ) {
				esc_html_e( '404', 'catmandu' );
			} elseif ( is_search() ) {
				_e( 'Search results for:', 'catmandu' );
				echo '<div class="search-query">' . get_search_query() . '</div>';
			} elseif(  ! is_front_page() || is_home() ) {
				esc_html_e( 'Blogs', 'catmandu' );
			}
		?>
		</h1>
	<?php }

	if ( ! empty( $breadcrumb_position ) && $breadcrumb_position === "after-title" ) {
		Catmandu_Template_Functions::get_breadcrumbs( 'breadcrumb-after-header' );
	}
}

/**
 * Render Top Header social connections
 *
 * @return void
 */
function catmandu_top_header_social_connects() {
	$social_connects = Catmandu_Theme_Options::get_option( 'top-social-connect' );

	if( empty( $social_connects ) ) {
		return;
	}
	?>
	<div class="header-social-wrapper">
		<div class="social-links">
			<ul>

				<?php foreach( $social_connects as $connect ) :
					$link = $connect['link'];

					if ( ! empty( $link ) ) : ?>

						<li><a href="<?php echo esc_url( $link ); ?>" target="_blank"></a></li>

					<?php endif; ?>

				<?php endforeach; ?>

			</ul>
		</div> <!-- .social-links -->
	</div><!-- .header-social-wrapper -->
<?php
}

/**
 * Render Top Header quick contacts
 *
 * @return void
 */
function catmandu_top_header_quick_contacts() {
	$quick_contacts = Catmandu_Theme_Options::get_option( 'top-quick-contact' );
	if ( empty( $quick_contacts ) ) {
		return;
	}
	?>
	<div id="quick-contact">
		<ul>

			<?php foreach( $quick_contacts as $contact ) :
				$icon = $contact['icon'];
				$text = $contact['contact'];
				$title = $contact['title'];
				?>

				<li class="quick-call">

					<?php
					
					$header_design = 'header-1';
					// $header_design = 'header-1';
					if ( 'header-2' === $header_design ) {
						echo '<div class="header-box-icon">';
					}
					?>

					<?php if ( ! empty( $icon ) ) : ?>
						<i class="<?php echo esc_attr( $icon ); ?>"></i>
					<?php endif; ?>

					<?php
					if ( 'header-2' === $header_design ) {
						echo '
								</div>
							<div class="header-box-info">';
					}
					?>
						<?php if ( ! empty( $title ) ) : ?>
							<strong><?php echo esc_html( $title ); ?></strong>
						<?php endif; ?>

					<?php if ( ! empty( $text ) ) :

						if ( strpos( $icon, 'phone') ) :
							echo '<a href="tel:' . esc_attr( $text ) . '" >';
						elseif ( strpos( $icon, 'mail') || strpos( $icon, 'envelope') ) :
						    echo '<a href="mailto:' . sanitize_email( $text ) . '" >';
						endif; ?>

							<?php echo esc_html( $text );

						if ( strpos( $icon, 'phone') || strpos( $icon, 'mail') || strpos( $icon, 'envelope') ) :
							echo '</a>';
						endif; ?>

					<?php endif; ?>

					<?php
					if ( 'header-2' === $header_design ) {
						echo '</div>';
					}
					?>

				</li>

			<?php endforeach; ?>

		</ul>
	</div> <!-- .quick-contact -->
<?php
}


function catmandu_body_class( $classes ) {
	$classes[] = catmandu_content_layout_type();

	$header_design = 'header-1';

	if ( 'header-2' === $header_design ) {
		$classes[] = 'header-v2';
	} else {
		$classes[] = 'header-v1';
	}

	// Button design
	$classes[] = Catmandu_Theme_Options::get_option( 'field-global-button-design' );
	$classes[] = Catmandu_Theme_Options::get_option( 'field-global-button-size' );

	return apply_filters( 'catmandu_body_class', $classes );
}

function catmandu_loader() {

	$loader_enable = Catmandu_Theme_Options::get_option( 'field-global-loader-enable' );
	if ( ! $loader_enable ) {
		return;
	}

	echo '<div id="fakeloader"></div>';
}

function catmandu_sticky_main_nav( $classes = '' ) {
	$sticky_enable = false;

	$header_design = 'header-1';

	if( $sticky_enable && 'header-2' === $header_design ) {
		$classes = 'sticky-enabled';
	}

	return apply_filters( 'catmandu_sticky_main_nav', $classes );
}
