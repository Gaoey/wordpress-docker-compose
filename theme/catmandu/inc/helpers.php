<?php
/**
 * Helpers to the rescue Here !
 *
 * Catmandu
 * @since 1.0.0
 * @author CodeManas 2020. All Rights reserved.
 */
if ( ! function_exists( 'catmandu_is_navxt_breadcrumbs_enabled' ) ) {
	function catmandu_is_navxt_breadcrumbs_enabled() {
		$active_plugins = (array) get_option( 'active_plugins', array() );

		return in_array( 'breadcrumb-navxt/breadcrumb-navxt.php', $active_plugins ) || array_key_exists( 'breadcrumb-navxt/breadcrumb-navxt.php', $active_plugins );
	}
}

if ( ! function_exists( 'catmandu_dump' ) ) {
	function catmandu_dump( $str ) {
		echo "<pre>";
		var_dump( $str );
		echo "</pre>";
	}
}

/**
 * Breadcrumbs apply
 */
if ( ! function_exists( 'catmandu_breacrumbs' ) ) {
	function catmandu_breacrumbs() {
		if ( function_exists( 'bcn_display' ) ) {
			$breadcrumb = Catmandu_Theme_Options::get_option( 'field-breadcrumb-type' );
			if ( ! empty( $breadcrumb ) && $breadcrumb !== "none" ) {
				?>
                <div class="breadcrumbs" typeof="BreadcrumbList" vocab="https://schema.org/">
					<?php bcn_display(); ?>
                </div>
				<?php
			}
		}
	}
}

/**
 * Check if the current page is archive/search/blog
 *
 * @return bool True if the current page is archive or search or blog
 */
if ( ! function_exists( 'catmandu_is_archive' ) ) {
	function catmandu_is_archive() {
		return is_archive() || is_search() || is_home() || wp_doing_ajax();
	}
}

if ( ! function_exists( 'catmandu_search_results' ) ) {
	/**
	 * Return if search page did not find anything on it
	 * @return bool
	 */
	function catmandu_search_results() {
		// Checking on search page only
		if ( is_search() ) {
			global $wp_query;

			//If Search doesnot if anything return false
			if ( 0 === $wp_query->found_posts ) {
				return false;
			}
		}

		return true;
	}
}

add_filter( 'bcn_settings_init', 'catmandu_breadcrumb_trail' );
/**
 * Change Breadcrum seperator to theme
 *
 * @param $trail
 *
 * @return mixed
 */
function catmandu_breadcrumb_trail( $trail ) {
	$seperator = Catmandu_Theme_Options::get_option( 'field-breadcrumb-seperator' );
	if ( ! empty( $seperator ) ) {
		$trail['hseparator'] = '<span class="seperator">' . $seperator . '</span>';
	}

	return $trail;
}

/**
 * Display type of layout for the content
 *
 * @param string $default
 *
 * @return mixed
 */
function catmandu_content_layout_type() {
	$page_layout    = Catmandu_Theme_Options::get_option( 'field-global-page-layout-selection' );
	$blog_layout    = Catmandu_Theme_Options::get_option( 'field-global-blog-layout-selection' );
	$archive_layout = Catmandu_Theme_Options::get_option( 'field-global-archives-layout-selection' );
	$global_layout  = Catmandu_Theme_Options::get_option( 'field-global-layout-selection' );

	//For pages and single pages
	if ( is_front_page() && ! empty( $global_layout ) ) {
		$default = catmandu_get_content_layout( $global_layout );
	} else if ( is_page() && ! empty( $page_layout ) ) {
		$default = catmandu_get_content_layout( $page_layout );
	} else if ( ( is_home() || is_single() ) && ! empty( $blog_layout ) ) {
		//For Blog pages and single blog pages
		$default = catmandu_get_content_layout( $blog_layout );
	} else if ( ( is_archive() || is_search() ) && ! empty( $archive_layout ) ) {
		//For Blog pages and single blog pages
		$default = catmandu_get_content_layout( $archive_layout );
	} else {
		if ( ! empty( $global_layout ) ) {
			$default = catmandu_get_content_layout( $global_layout );
		}
	}

	return $default;
}

/**
 * Get Type of content and output class accordingly
 *
 * @param $layout
 *
 * @return mixed
 */
function catmandu_get_content_layout( $layout ) {
	if ( ! empty( $layout ) && $layout === "full-width" ) {
		//If page is built with elemetnor change class to sth else to suit
		$args = 'container-fluid';
		
	} else {
		$args = 'boxed';
	}

	return apply_filters( 'catmandu_content_layout_option', $args );
}

function catmandu_excerpt_more( $more ) {
    if ( ! is_admin() && is_home() ) {
		$text    = Catmandu_Theme_Options::get_option( 'field-blog-read-more' );
        $more = sprintf( '<a class="custom-button button-curved" href="%1$s">%2$s</a>',
            get_permalink( get_the_ID() ),
            esc_html( $text )
        );
    }

    return $more;
}
add_filter( 'excerpt_more', 'catmandu_excerpt_more' );

function catmandu_excerpt_length( $length ) {
    if ( ! is_admin() && is_home() ) {
		$length    = Catmandu_Theme_Options::get_option( 'field-blog-excerpt-length' );
	}

    return $length;
}
add_filter( 'excerpt_length', 'catmandu_excerpt_length', 999 );

function catmandu_features_plugin_is_active() {
	/**
	 * Detect plugin. For use on Front End only.
	 */
	include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
	 
	// check for plugin using plugin name
	if ( is_plugin_active( 'catmandu-features/catmandu-features.php' ) ) {
	    return true;
	} else {
		return false;
	}
}

function catmandu_content_type( $more_content_type ) {
	$content_type = array(
		'post' => esc_html__( 'Post', 'catmandu' ),
		'page' => esc_html__( 'Page', 'catmandu' ),
		'category' => esc_html__( 'Category', 'catmandu' ),
		'custom' => esc_html__( 'Custom', 'catmandu' ),
	);

	if( catmandu_features_plugin_is_active() ) {
		if( 'portfolio' === $more_content_type ) {
			$content_type['portfolio'] = esc_html__( 'Portfolio', 'catmandu' );
		} elseif( 'service' === $more_content_type ) {
			$content_type['service'] = esc_html__( 'Service', 'catmandu' );
		}
	}

	return $content_type;
}