<?php
/**
 * Script enqueue
 *
 * @author      CodeManas
 * @copyright   Copyright (c) 2019, CodeManas
 * @since       1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Theme Enqueue Scripts
 */
if ( ! class_exists( 'Catmandu_Enqueue_Scripts' ) ) {

	/**
	 * Theme Enqueue Scripts
	 */
	class Catmandu_Enqueue_Scripts {

		/**
		 * Constructor
		 */
		public function __construct() {
			add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
		}

		/**
		 * Load Assets into array
		 *
		 * @return mixed
		 */
		private function theme_assets() {
			$default_assets = array(
				'js'      => array(
					'catmandu-custom' => 'custom',
					'skip-link-focus-fix' => 'skip-link-focus-fix',
				),

				'css'     => array(
					'catmandu-man' => 'main',
					'catmandu-custom' => 'custom',
				),

				'vendors_css' => array(
					'sidr'        => 'sidr/css/jquery.sidr.dark',
					'slick'        => 'slick/css/slick',
					'animate'        => 'wow/css/animate',
					'prettyPhoto'        => 'prettyphoto/css/prettyPhoto',
					'fakeLoader'        => 'fakeloader/fakeLoader',
					'fontAwesome'        => 'fontawesome/css/all',
					'et-icons' => 'icons/icons',
				),
				'vendors_js' => array(
					'sidr'        => 'sidr/js/jquery.sidr',
					'cycle2'        => 'cycle2/jquery.cycle2',
					'slick'        => 'slick/js/slick',
					'wow'        => 'wow/js/wow',
					'waypoints'        => 'counter-up/js/waypoints',
					'counterup'        => 'counter-up/js/jquery.counterup',
					'isotope'        => 'isotope/js/isotope.pkgd',
					'prettyPhoto'        => 'prettyphoto/js/jquery.prettyPhoto',
					'fakeloader'        => 'fakeloader/fakeLoader',
					'imagesloaded'        => 'imagesloaded/imagesloaded.pkgd',
				),
			);

			return apply_filters( 'catmandu_theme_assets', $default_assets );
		}

		/**
		 * Enqueue Scripts
		 */
		public function enqueue_scripts() {
			$this->enqueue_fonts();

			/* Directory and Extension */
			$file_prefix = ( SCRIPT_DEBUG ) ? '' : '.min';

			$js_uri     = CODEMANAS_THEME_URL . 'assets/scripts/';
			$css_uri    = CODEMANAS_THEME_URL . 'assets/styles/';
			$vendor_uri = CODEMANAS_THEME_URL . 'assets/vendors/';

			// All assets.
			$all_assets = $this->theme_assets();
			$styles     = $all_assets['css'];
			$scripts    = $all_assets['js'];
			$vendors_css    = $all_assets['vendors_css'];
			$vendors_js    = $all_assets['vendors_js'];

			if ( is_array( $styles ) && ! empty( $styles ) ) {
				// Register & Enqueue Styles.
				foreach ( $styles as $key => $style ) {

					$uri = filter_var( $style, FILTER_VALIDATE_URL ) ? $style : $css_uri . $style;

					// Generate CSS URL.
					$css_file = $uri . $file_prefix . '.css';

					// Register.
					wp_register_style( $key, $css_file, false, CODEMANAS_THEME_VERSION, 'all' );

					// Enqueue.
					wp_enqueue_style( $key );
				}
			}

			if ( is_array( $scripts ) && ! empty( $scripts ) ) {
				// Register & Enqueue Scripts.
				foreach ( $scripts as $key => $script ) {

					// Register.
					wp_register_script( $key, $js_uri . $script . $file_prefix . '.js', array( 'jquery' ), CODEMANAS_THEME_VERSION, true );

					// Enqueue.
					wp_enqueue_script( $key );
				}
			}

			if ( is_array( $vendors_css ) && ! empty( $vendors_css ) ) {
				// Register & Enqueue Scripts.
				foreach ( $vendors_css as $key => $vendor ) {

					// Register.
					wp_register_style( $key, $vendor_uri . $vendor . $file_prefix . '.css', false, CODEMANAS_THEME_VERSION, 'all' );

					// Enqueue.
					wp_enqueue_style( $key );
				}
			}

			if ( is_array( $vendors_js ) && ! empty( $vendors_js ) ) {
				// Register & Enqueue Scripts.
				foreach ( $vendors_js as $key => $vendor ) {

					// Register.
					wp_register_script( $key, $vendor_uri . $vendor . $file_prefix . '.js', array( 'jquery' ), CODEMANAS_THEME_VERSION, true );

					// Enqueue.
					wp_enqueue_script( $key );
				}
			}

			if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
				wp_enqueue_script( 'comment-reply' );
			}

			$this->localize_scripts();
		}

		function enqueue_fonts() {
			wp_enqueue_style( 'catmandu-google-fonts', '//fonts.googleapis.com/css?family=Open+Sans:400,500,600,700|Montserrat:400,500,600,700', false );
		}

		/**
		 * Script Localizations
		 */
		function localize_scripts() {
			$options = array(
				'header_layout'       => 'catmandu-left-logo',
				'loader_spinner'       => 'spinner1',
				'loader_bg'       => '#f51e46',
				'ajaxurl'             => admin_url( 'admin-ajax.php' ),
				'ajaxButtonType'      => Catmandu_Theme_Options::get_option( 'field-blog-post-pagination' ),
				'ajaxLoadMoreLocales' => array(
					'loading'   => __( 'Loading...', 'catmandu' ),
					'load_more' => __( 'Load More', 'catmandu' ),
					'error'     => __( 'Error loading the posts.', 'catmandu' ),
				),
			);

			wp_localize_script( 'catmandu-custom', 'catmandu_options', $options );
		}
	}

	new Catmandu_Enqueue_Scripts();
}
