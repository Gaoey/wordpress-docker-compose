<?php
/**
 * Theme options for getters and setters
 *
 * @author      CodeManas
 * @copyright   Copyright (c) 2019, CodeManas
 * @since       1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class Catmandu_Theme_Options
 *
 * Catmandu Theme options pull class
 */
class Catmandu_Theme_Options {

	public function __construct() {
		add_action( 'after_theme_setup', array( $this, 'load_defaults' ) );
	}

	/**
	 * Get singular theme data
	 *
	 * @param $option
	 *
	 * @return mixed
	 */
	static function get_option( $option ) {
		$defaults = self::load_defaults();

		$theme_options = ! empty( $defaults[ $option ] ) ? get_theme_mod( $option, $defaults[ $option ] ) : get_theme_mod( $option );

		$theme_options = apply_filters( 'catmandu_filter_get_option', $theme_options, $option );

		return $theme_options;
	}

	/**
	 * Get all theme data
	 *
	 * @param $option
	 *
	 * @return mixed
	 */
	static function get_options( $option = '' ) {
		$theme_options = get_theme_mods();

		$theme_options = apply_filters( 'catmandu_filter_get_options', $theme_options, $option );

		$value = ! empty( $theme_options[ $option ] ) ? $theme_options[ $option ] : $theme_options;

		return apply_filters( "catmandu_get_option_{$option}", $value, $option );
	}

	/**
	 * Save Page Settings
	 *
	 * @param $name
	 * @param $value
	 * @return void
	 */
	static function update_catmandu_page_meta( $name, $value, $post_id = 0 ) {
		$mods      = self::get_catmandu_page_meta( $post_id );
		$old_value = isset( $mods[ $name ] ) ? $mods[ $name ] : false;
	
		$mods[ $name ] = apply_filters( "catmandu_pre_set_page_setting_{$name}", $value, $old_value );
		
		update_post_meta( $post_id, 'catmandu_page_setting', $mods );
	}

	/**
	 * Get Page Settings
	 *
	 * @return mixed
	 */
	static function get_catmandu_page_meta( $post_id ) {
		$mods = get_post_meta( $post_id, "catmandu_page_setting", true );
		if ( !empty( $mods ) ) {
			return $mods;
		} else {
			return false;
		}
	}

	/**
	 * Get Page Setting by ID and Name
	 *
	 * @param $page_id
	 * @param $meta_name
	 * @return mixed
	 */
	static function get_page_setting( $meta_name, $page_id = '' ) {
		$page_id = !empty( $page_id ) ? $page_id : get_queried_object_id();
		$page_meta = !empty( $page_id ) ? self::get_catmandu_page_meta( $page_id ) : false;
		if( !empty( $page_meta ) && !empty( $page_meta[$meta_name] ) ) {
			return $page_meta[$meta_name];
		} else {
			return false;
		}
	}

	/**
	 * Load Default data in initial setup process
	 */
	static function load_defaults() {
		// Get default post id
		$posts = get_posts( array( 'numberposts' => 1, 'fields' => 'ids' ) );
		$default_post = 1;
		if ( ! empty( $posts ) ) {
			$default_post = $posts[0];
		}
		
		// Get default page id
		$pages = get_posts( array( 'numberposts' => 1, 'post_type' => 'page', 'fields' => 'ids' ) );
		$default_page = 1;
		if ( ! empty( $pages ) ) {
			$default_page = $pages[0];
		}

		$defaults = array(
			// Container
			'field-global-container-width'           => 1230,
			'field-global-layout-selection'          => 'full-width',
			'field-global-page-layout-selection'     => 'full-width',
			'field-global-blog-layout-selection'     => 'full-width',
			'field-global-archives-layout-selection' => 'full-width',
			
			// Loader
			'field-global-loader-enable'             => true,	
			
			// Typography 
			'field-global-typography-body'           => array(
			'font-family'                            => 'Open Sans',
			),
			
			// Color
			'field-global-body-bg-color'             => '#ffffff',
			
			// Buttons
			'field-global-button-design'             => 'catmandu-btn-curved',
			'field-global-button-size'               => 'catmandu-btn-medium',
			
			// Header
			'field-header-mobile-menu-background'    => '#333',
			'field-header-mobile-menu-text-color'    => '#fff',
			'field-header-mobile-menu-hamburger'     => '#ffffff',
			'field-header-menu-disable'              => false,
			'field-header-menu-disable-search'       => false,
			'field-header-menu-disable-minicart'     => false,
			'field-header-color-menu'                         => '#222',
			'field-header-color-menu-hover'                   => '#f51e46',
			'field-header-color-sub-menu'                     => '#fff',
			'field-header-color-submenu-hover'                => '#666666',
			'field-header-color-submenu-hover-background'     => '#ffffff',
			'field-header-color-submenu-hover-text'           => '#f51e46',
			'field-header-color-submenu-bordr-color'          => '#333333',
			'field-header-color-active-menu'                  => '#f51e46',
			'field-header-transparent'                        => false,
			'field-header-transparent-blog-page'              => false,
			'field-header-transparent-search-page'            => false,
			'field-header-transparent-archive-page'           => false,
			'field-header-transparent-single-post'            => false,
			'field-header-transparent-404'                    => false,
			'field-header-transparent-singular'               => false,
			'field-header-transparent-single-page'            => false,
			'field-header-menu-last-item'            => 'none',
			'field-header-menu-last-item-btn-link'            => 'https://www.codemanas.com/',
			'field-header-menu-last-item-btn-color'           => '#f51e46',
			'field-header-menu-last-item-btn-text-color'      => '#ffffff',
			'field-header-menu-last-item-btn-vertical'        => '10',
			'field-header-menu-last-item-btn-horizontal'      => '10',
			'field-header-menu-last-item-btn-border'          => '0',
			'field-header-menu-last-item-btn-border-color'	          => '#f51e46',
			'field-header-menu-last-item-button-text'        => esc_html__( 'Get a Quote', 'catmandu' ),
			'field-header-menu-last-item-btn-custom-text'     => '<button>' . esc_html__( 'Register', 'catmandu' ) . '</button>',
			'field-header-menu-sticky-hide-logo-mobile'       => false,

			// Site identity
			'field-identity-logo-width'                       => '140',
			'field-identity-display-site-title'               => true,
			'field-identity-display-site-tagline'             => true,
			'field-identity-site-title-typography'            => array(
				'font-size'      => '26px',
				'text-transform' => 'none',
				'font-family'    => 'Montserrat',
				'variant'        => '',
				'color'          => '#f51e46',
				'font-backup'    => '',
				'font-weight'    => 700,
				'font-style'     => 'normal',
			),
			'field-identity-site-tagline'                     => array(
				'font-size'      => '16px',
				'letter-spacing' => '0px',
				'text-transform' => 'none',
				'font-family'    => 'Montserrat',
				'variant'        => '',
				'color'          => '#222',
				'font-backup'    => '',
				'font-weight'    => '',
				'font-style'     => 'normal',
			),
			
			// Blog
			'field-blog-archive-column'               => 12,
			'field-blog-page-layout'                          => array(
				'image',
				'title',
				'meta',
				'content',
			),
			'field-blog-author-enable'                        => true,
			'field-single-pagination-enable'				=> true,
			'field-blog-excerpt-length'                      => 30,
			'field-blog-read-more' =>	esc_html__( 'Read More', 'catmandu' ),
			'field-blog-post-pagination'                      => 'numeric',
			'field-pagination-alignment'                      => 'center-align-pagination',

			// Footer
			'field-footer-bar-enable-scrollup'       => true,
			'field-footer-bar-enable-scrollup-color' => '#000000',
			'field-footer-bar-background-color'      => '#ffffff',
			'field-footer-bar-enable'                         => true,
			'field-footer-bar-copyright'                      => '<p>Copyright &#169;. All rights reserved.</p><p>Powered by <strong>WordPress</strong></p>',
			'field-footer-widget-layout'                      => 'wd-two',
			'field-footer-widget-border-top'                  => '0',
			'field-footer-widget-background-color'            => '#101010',
			'field-footer-widget-heading-color'            => '#fff',

			'field-footer-bar-enable' => true,
			'field-footer-bar-copyright' => __( '<p> Copyright &#9400; 2020</p>', 'catmandu' ),
			'field-footer-bar-background-color' => '#161616',
			'field-footer-widget-typography-link-hover-color' => '#254099',

			// Sidebar
			'field-sidebar-type'                              => 'right',
			'field-sidebar-post'                              => 'default',
			'field-sidebar-page'                              => 'none',
			'field-sidebar-archive'                           => 'default',
			'field-sidebar-heading-color'                     => '#222',
			
			// Breadcrumb
			'field-breadcrumb-seperator'                      => '&#187;',
			'field-breadcrumb-type'                           => 'after-title',
			'field-breadcrumb-disable-homepage'               => true,
			'field-breadcrumb-disable-blog'                   => false,
			'field-breadcrumb-disable-single-page'            => false,
			'field-breadcrumb-disable-single-post'            => false,
			'field-breadcrumb-disable-single'                 => false,
			'field-breadcrumb-disable-search'                 => false,
			'field-breadcrumb-disable-archive'                => false,
			'field-breadcrumb-disable-404'                    => false,
			'field-breadcrumb-alignment'                      => 'center',

			// Top header
			'field-top-header-enable'					   	  => true,

			/*Homepage*/
			// Homepage sorting
			'field-homepage-sort' => [
				'Slider',
				'Features',
				'News',
				'Video',
				'Projects',
				'Newsletter',
				'CTA',
			],

			// Slider
			'homepage-slider-enable' => false,
			'slider-pause-enable' => true,
			'homepage-slider-content' => 'post',
			'homepage-slider-post-repeater' => [
				[
					'post'		=> $default_post,
					'button_1_url' => '#',
					'button_2_url' => '#',
				],
				[
					'post'		=> $default_post,
					'button_1_url' => '#',
					'button_2_url' => '#',
				],
				[
					'post'		=> $default_post,
					'button_1_url' => '#',
					'button_2_url' => '#',
				],
			],
			'homepage-slider-text-position' => 'left',

			// Features
			'homepage-features-enable' => false,
			'homepage-features-subtitle' => esc_html__( 'ABOUT COMPANY', 'catmandu' ),
			'homepage-features-title' => esc_html__( 'We Provided Services Since 1963', 'catmandu' ),
			'homepage-features-content' => 'post',
			'homepage-features-post-repeater' => [
				[
					'post'		=> $default_post,
					'icon'  => 'tools',
				],
				[
					'post'		=> $default_post,
					'icon'  => 'tools',
				],
				[
					'post'		=> $default_post,
					'icon'  => 'tools',
				],
			],

			// News
			'homepage-news-enable' => false,
			'homepage-news-subtitle' => esc_html__( 'From Blog', 'catmandu' ),
			'homepage-news-title' => esc_html__( 'Recent News', 'catmandu' ),
			'homepage-news-content' => 'post',
			'homepage-news-post-repeater' => [
				[
					'post'		=> $default_post,
				],
				[
					'post'		=> $default_post,
				],
				[
					'post'		=> $default_post,
				],
			],
			'homepage-news-btn-url' => '#',

			// Video
			'homepage-video-enable' => false,
			'homepage-video-post' => strval($default_post),
			'homepage-video-link'  => esc_url( 'https://www.youtube.com/watch?v=52kqVx1nXJ8' ),
			'homepage-video-overlay-enable' => true,

			// Projects
			'homepage-projects-enable' => false,
			'homepage-projects-subtitle' => esc_html__( 'Projects', 'catmandu' ),
			'homepage-projects-title' => esc_html__( 'Project Showcase', 'catmandu' ),
			'homepage-projects-content' => 'post',
			'homepage-projects-post-repeater' => [
				[
					'post'		=> $default_post,
				],
				[
					'post'		=> $default_post,
				],
				[
					'post'		=> $default_post,
				],
			],

			// Newsletter
			'homepage-newsletter-enable' => false,
			'homepage-newsletter-post' => strval($default_post), // converted to string since field type select provides value with string
			'homepage-newsletter-shortcode' => '[mailpoet_form id="1"]',
			'homepage-newsletter-overlay-enable' => false,

			// Call to action
			'homepage-cta-enable' => 'disable',
			'homepage-cta-post' => strval($default_post), // converted to string since field type select provides value with string
			'homepage-cta-subtitle' => esc_html__( 'We\'re Hiring', 'catmandu' ),
			'homepage-cta-overlay-enable' => true,
		);

		return apply_filters( 'catmandu_theme_defaults', $defaults );
	}
}

new Catmandu_Theme_Options();