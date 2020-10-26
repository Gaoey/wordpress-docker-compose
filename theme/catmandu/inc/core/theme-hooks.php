<?php
/**
 * @author Deepen.
 * @created_on 12/3/19
 *
 * @since 1.0.0
 * @copyright 2019. CodeManas
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * AFter head tag hook
 */
function catmandu_after_head() {
	do_action( 'catmandu_after_head' );
}

/**
 * Main body top
 */
function catmandu_body_top() {
	do_action( 'catmandu_body_top' );
}

/**
 * Before main header hook
 */
function catmandu_before_header() {
	do_action( 'catmandu_before_header' );
}

/**
 * Main header hook
 */
function catmandu_header() {
	do_action( 'catmandu_header' );
}

/**
 * After main header hook
 */
function catmandu_after_header() {
	do_action( 'catmandu_after_header' );
}

/**
 * Main Header Content
 */
function catmandu_masthead_content() {
	do_action( 'catmandu_masthead_content' );
}

/**
 * Before Main Header Content
 */
function catmandu_before_masthead_content() {
	do_action( 'catmandu_before_masthead_content' );
}

/**
 * After Main Header Content
 */
function catmandu_after_masthead_content() {
	do_action( 'catmandu_after_masthead_content' );
}

/**
 * Before top banner image content
 */
function catmandu_before_top_banner_image() {
	do_action( 'catmandu_before_top_banner_image' );
}

/**
 * Top banner image content
 */
function catmandu_top_banner_image() {
	do_action( 'catmandu_top_banner_image' );
}

/**
 * After Top banner image content
 */
function catmandu_after_top_banner_image() {
	do_action( 'catmandu_after_top_banner_image' );
}

/**
 * Before main navigation
 */
function catmandu_before_main_nav() {
	do_action( 'catmandu_before_main_nav' );
}


/**
 * Before main navigation
 */
function catmandu_after_main_nav() {
	do_action( 'catmandu_after_main_nav' );
}

/**
 * Before main footer render
 */
function catmandu_before_footer() {
	do_action( 'catmandu_before_footer' );
}

/**
 * After main container
 */
function catmandu_after_main_container() {
	do_action( 'catmandu_after_main_container' );
}

/**
 * Main Footer Hook
 */
function catmandu_footer() {
	do_action( 'catmandu_footer' );
}

/**
 * After main footer render
 */
function catmandu_after_footer() {
	do_action( 'catmandu_after_footer' );
}

/**
 * Top Header
 */
function catmandu_top_header_main() {
	do_action( 'catmandu_top_header_main' );
}

/**
 * Bottom footer
 */
function catmandu_body_bottom() {
	do_action( 'catmandu_body_bottom' );
}

/**
 * Output before footer widgets
 */
function catmandu_before_footer_widgets() {
	do_action( 'catmandu_before_footer_widgets' );
}

/**
 * Output after footer widgets
 */
function catmandu_after_footer_widgets() {
	do_action( 'catmandu_after_footer_widgets' );
}

/**
 * Output before social menus
 */
function catmandu_before_social_menus() {
	do_action( 'catmandu_before_social_menus' );
}

/**
 * Output after social menus
 */
function catmandu_after_social_menus() {
	do_action( 'catmandu_after_social_menus' );
}

/**
 * Post Hooks Start
 */
function catmandu_before_main_content() {
	do_action( 'catmandu_before_main_content' );
}

function catmandu_after_main_content() {
	do_action( 'catmandu_after_main_content' );
}

function catmandu_before_post_content() {
	do_action( 'catmandu_before_post_content' );
}

function catmandu_after_post_content() {
	do_action( 'catmandu_after_post_content' );
}

function catmandu_before_sidebar() {
	do_action( 'catmandu_before_sidebar' );
}

function catmandu_after_sidebar() {
	do_action( 'catmandu_after_sidebar' );
}

function catmandu_main_content() {
	do_action( 'catmandu_main_content' );
}

function catmandu_main_comments() {
	do_action( 'catmandu_main_comments' );
}

/**
 * Include a skip to content link at the top of the page so that users can bypass the menu.
 */
function catmandu_skip_link() {
	echo '<a class="skip-link screen-reader-text" href="#site-content">' . __( 'Skip to the content', 'catmandu' ) . '</a>';
}

add_action( 'wp_body_open', 'catmandu_skip_link', 5 );

/**
 * Post Hooks End
 */


/* Homepage hooks */
function catmandu_homepage_main_content() {
	do_action( 'catmandu_homepage_main_content' );
}

function catmandu_homepage_before_main_content() {
	do_action( 'catmandu_homepage_before_main_content' );
}

function catmandu_homepage_after_main_content() {
	do_action( 'catmandu_homepage_after_main_content' );
}

// Fake loader
add_action( 'catmandu_body_top', 'catmandu_loader' );


/**
 * Headers
 *
 * @see  Catmandu_Template_Functions::master_header()
 * @see  Catmandu_Template_Functions::after_header_contents()
 * @see  catmandu_masthead_logo()
 * @see  catmandu_masthead_nav()
 * @see  Catmandu_Template_Functions::top_header()
 * @see  Catmandu_Template_Functions::breadcrumbs_inside_header()
 */

add_action( 'catmandu_header', array( 'Catmandu_Template_Functions', 'master_header' ) );
add_action( 'catmandu_after_header', array( 'Catmandu_Template_Functions', 'after_header_contents' ), 10 );

add_action( 'wp', 'catmandu_header_design_layout_cb' ); // Hooked to wp since the template functions does not work until wp is loaded.

if( ! function_exists( 'catmandu_header_design_layout_cb' ) ) {

	function catmandu_header_design_layout_cb() {

		$header_design = 'header-1';

		if ( 'header-2' === $header_design ) {
			add_action( 'catmandu_before_header', 'catmandu_masthead_nav', 5 );
			add_action( 'catmandu_masthead_content', 'catmandu_masthead_logo', 10 );
			add_action( 'catmandu_masthead_content', 'catmandu_top_header_quick_contacts', 20 );
		} else {
			add_action( 'catmandu_masthead_content', 'catmandu_masthead_logo', 10 );
			add_action( 'catmandu_masthead_content', 'catmandu_header_right_wrapper_start', 15 );
			add_action( 'catmandu_masthead_content', 'catmandu_masthead_nav', 20 );
			add_action( 'catmandu_masthead_content', 'catmandu_masthead_mini_cart', 30 );
			add_action( 'catmandu_masthead_content', 'catmandu_masthead_search', 40 );
			add_action( 'catmandu_masthead_content', 'catmandu_header_right_wrapper_end', 45 );
		}

		if ( 'header-1' === $header_design ) {
			add_action( 'catmandu_before_header', array( 'Catmandu_Template_Functions', 'top_header' ), 20 );
		}

		if ( 'header-2' === $header_design ) {
			add_action( 'catmandu_after_main_nav', 'catmandu_top_header_right_wrapper_start', 5 );
			add_action( 'catmandu_after_main_nav', 'catmandu_top_header_social_connects', 10 );
			add_action( 'catmandu_after_main_nav', 'catmandu_masthead_search', 20 );
			add_action( 'catmandu_after_main_nav', 'catmandu_masthead_mini_cart', 30 );
			add_action( 'catmandu_after_main_nav', 'catmandu_top_header_right_wrapper_end', 35 );
		} else {
			add_action( 'catmandu_top_header_main', 'catmandu_top_header_quick_contacts', 10 );
			add_action( 'catmandu_top_header_main', 'catmandu_top_header_social_connects', 20 );
		}
	}
}

// Top header
add_action( 'catmandu_before_header', array( 'Catmandu_Template_Functions', 'mobile_menu' ), 10 );



/**
 * Top banner image
 *
 * @see  catmandu_pageshow_title_in_banner()
 */

add_action( 'catmandu_top_banner_image', 'catmandu_pageshow_title_in_banner' );

/**
 * Homepage sections
 *
 * @see  catmandu_pageshow_title_in_banner()
 */
add_action( 'wp', 'catmandu_homepage_sorting_cb' ); // Hooked to wp since the template functions does not work until wp is loaded.
function catmandu_homepage_sorting_cb() {
	$homepage_sort_sections = Catmandu_Theme_Options::get_option( 'field-homepage-sort' );

	$section_priority = 10;
	foreach ( $homepage_sort_sections as $section ) {
		add_action( 'catmandu_homepage_main_content', array( 'Catmandu_' . esc_html( $section ) . '_Section', 'render_content' ), $section_priority );
	}
}


add_action( 'wp', 'catmandu_cta_section_hook' ); // Hooked to wp since the template functions does not work until wp is loaded.
function catmandu_cta_section_hook() {
	$cta_section_enable = Catmandu_Theme_Options::get_option( 'homepage-cta-enable' );

	if( 'entire-site' === $cta_section_enable ) {
		if( ! is_page_template( 'custom-tmpl/tmpl-home.php' ) ) {
			add_action( 'catmandu_before_footer', array( 'Catmandu_CTA_Section', 'render_content' ) );
		}
	} elseif ( 'pages' === $cta_section_enable ) {
		if( ! is_page_template( 'custom-tmpl/tmpl-home.php' ) && is_page() ) {
			add_action( 'catmandu_before_footer', array( 'Catmandu_CTA_Section', 'render_content' ) );
		}
	} elseif ( 'posts' == $cta_section_enable ) {
		if( is_single() ) {
			add_action( 'catmandu_before_footer', array( 'Catmandu_CTA_Section', 'render_content' ) );
		}
	}
}

/**
 * Footer
 *
 * @see Catmandu_Template_Functions::master_footer()
 * @see Catmandu_Template_Functions::main_footer()
 * @see Catmandu_Template_Functions::super_footer()
 */

add_action( 'catmandu_footer', array( 'Catmandu_Template_Functions', 'footer_widgets' ) );
add_action( 'catmandu_footer', array( 'Catmandu_Template_Functions', 'footer_site_info' ), 30 );
add_action( 'catmandu_body_bottom', array( 'Catmandu_Template_Functions', 'catmandu_scrollToTop' ), 10 );


/**
 * Singular hooks
 *
 * @see catmandu_before_main_content_wrapper_start()
 * @see Catmandu_Template_Functions::main_footer()
 */

add_action( 'catmandu_main_content', 'catmandu_content_post_sortable', 10 );
add_action( 'catmandu_main_comments', 'catmandu_show_comments' );


// Post/body classes
add_filter( 'post_class', 'catmandu_blog_archive_column', 10, 1 );
add_filter( 'body_class', 'catmandu_body_class', 10, 1 );