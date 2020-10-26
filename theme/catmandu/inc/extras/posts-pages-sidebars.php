<?php
/**
 * Sidebar Functions Here
 *
 * Catmandu
 * @since 1.0.0
 * @author CodeManas 2020. All Rights reserved.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function catmandu_blog_archive_column( $classes ) {
	if ( wp_doing_ajax() || is_archive() || is_home() ) {

		$col = Catmandu_Theme_Options::get_option( 'field-blog-archive-column' );

		if ( ! empty( $col ) ) {
			$classes[] = 'col-grid-' . absint( $col );
		}
		return apply_filters( 'catmandu_blog_archive_column', $classes );
	} elseif( is_singular() ) {
		$classes[] = 'col-grid-12';
	}

	return $classes;
}

/**
 * Fetch type of sidebar style
 *
 * @param $sidebar
 *
 * @return mixed
 */
function catmandu_get_sidebar_style( $sidebar ) {
	if ( $sidebar === 'left' ) {
		$result = 'left-sidebar';
	} elseif ( $sidebar === 'right' ) {
		$result = 'right-sidebar';
	} elseif ( $sidebar === 'default' ) {
		$result = Catmandu_Theme_Options::get_option( 'field-sidebar-type' );
		$result = catmandu_get_sidebar_style( $result );
	} else {
		$result = 'none';
	}

	return apply_filters( 'catmandu_sidebar_layout_style', $result );
}

/**
 * Fetch sidebar layout
 */
function catmandu_get_sidebar_layout() {
	if ( ! catmandu_search_results() ) {
		return;
	}

	// Global Sidebar
	$sidebar_layout = array(
		'field-sidebar-type'    => Catmandu_Theme_Options::get_option( 'field-sidebar-type' ),
		'field-sidebar-post'    => Catmandu_Theme_Options::get_option( 'field-sidebar-post' ),
		'field-sidebar-page'    => Catmandu_Theme_Options::get_option( 'field-sidebar-page' ),
		'field-sidebar-archive' => Catmandu_Theme_Options::get_option( 'field-sidebar-archive' ),
	);

	// Post Sidebar
	$global_sidebar = ! empty( $sidebar_layout['field-sidebar-type'] ) ? $sidebar_layout['field-sidebar-type'] : false;
	// Return global sidebar
	$sidebar = $global_sidebar;

	if ( $global_sidebar !== 'none' ) {



		// If is WooCommerce
		if ( ( is_home() || is_single() ) ) {
			// Post Sidebar
			$page_setting = Catmandu_Theme_Options::get_page_setting( 'page-sidebar' );

			if( 'default' == $page_setting || ! $page_setting ) {
				$post_sidebar = ! empty( $sidebar_layout['field-sidebar-post'] ) ? $sidebar_layout['field-sidebar-post'] : false;
			} else {
				$post_sidebar = $page_setting;
			}
			$sidebar = catmandu_get_sidebar_style( $post_sidebar );
		} elseif ( is_page() ) {
			// Pages Sidebar

			$page_setting = Catmandu_Theme_Options::get_page_setting( 'page-sidebar' );

			if( 'default' == $page_setting || ! $page_setting ) {
				$pages_sidebar = ! empty( $sidebar_layout['field-sidebar-page'] ) ? $sidebar_layout['field-sidebar-page'] : false;
			} else {
				$pages_sidebar = $page_setting;
			}
			$sidebar = catmandu_get_sidebar_style( $pages_sidebar );

		} elseif ( is_archive() || is_search() ) {
			// Archives Sidebar
			$archive_sidebar = ! empty( $sidebar_layout['field-sidebar-archive'] ) ? $sidebar_layout['field-sidebar-archive'] : false;
			$sidebar = catmandu_get_sidebar_style( $archive_sidebar );
		} else {
			$sidebar = catmandu_get_sidebar_style( $sidebar );
		}
	}

	return apply_filters( 'catmandu_sidebar_layout', $sidebar, $sidebar_layout );
}

function catmandu_sidebar_class() {
	if( is_page_template( 'custom-tmpl/tmpl-home.php' ) || is_page_template( 'custom-tmpl/tmpl-full-width.php' ) ){
		$class = 'global-layout-no-sidebar';
	} else {
		$sidebar_layout = catmandu_get_sidebar_layout();
		if ( $sidebar_layout == 'none' ) {
			$archive_column = Catmandu_Theme_Options::get_option( 'field-blog-archive-column' );
			if ( 12 != $archive_column ) {
				$class = "default-full-width blog-grid-layout";
			}  else {
				$class = "default-full-width blog-full-width";
			}
		} elseif ( $sidebar_layout == 'left-sidebar' ) { 
			$class = "global-layout-left-sidebar";
		} else {
			$class = "global-layout-right-sidebar";
		}
	}

	return apply_filters( 'catmandu_sidebar_class', $class );
}

/**
 * Make Content Sortable Here
 */
if ( ! function_exists( 'catmandu_content_post_sortable' ) ) {
	function catmandu_content_post_sortable() {
		// Blog Archive Page
		$post_content = Catmandu_Theme_Options::get_option( 'field-blog-page-layout' );
		if ( ! empty( $post_content ) ) {
			foreach ( $post_content as $cont ) {
				switch ( $cont ) {
					case 'title':
						?>
						<header class="entry-header">
							<?php
							if ( is_singular() ) :
								the_title( '<h1 class="entry-title">', '</h1>' );
							else :
								the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
							endif;
							?>
						</header><!-- .entry-header -->
						<?php
						break;

					case 'image':
						if ( has_post_thumbnail() ) {
							?>
							<div class="entry-thumb aligncenter">
								<?php catmandu_post_thumbnail(); ?>
							</div>
							<?php
						}
						break;

					case 'meta':
						?>
						<?php
						if ( 'post' === get_post_type() ) :
							?>
							<div class="entry-meta">
								<?php
								catmandu_post_posted_on();
								catmandu_post_category_links();
								catmandu_post_posted_by();
								catmandu_post_leave_comment();
								?>
							</div>
						<?php endif; ?>
						<?php
						break;

					case 'content':
						?>
						<div class="entry-content">
							<?php
							if ( is_singular() ) :
								the_content();
								wp_link_pages();
							else :
								the_excerpt();
							endif;
							?>
						</div><!-- .entry-content -->
						<?php
						break;
				}
			}
		}
	}
}

