<?php
/**
 * Registering section for customizer
 *
 * @package     Catmandu
 * @author      CodeManas
 * @copyright   Copyright (c) 2019, CodeManas
 * @since       1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Catmandu_Customizer_Register_Sections extends Catmandu_Customizer_Conifg_Base {

	public function register_configuration( $configs ) {

		$global_sections = array(
			array(
				'name'     => 'section-global-container-layout',
				'category' => 'section',
				'priority' => 1,
				'title'    => esc_html__( 'Container', 'catmandu' ),
				'panel'    => 'panel-global'
			),
			array(
				'name'     => 'section-global-loader',
				'category' => 'section',
				'priority' => 2,
				'title'    => esc_html__( 'Loader', 'catmandu' ),
				'panel'    => 'panel-global'
			),
			//Typography
			array(
				'name'     => 'section-global-typography',
				'category' => 'section',
				'priority' => 2,
				'title'    => esc_html__( 'Typography', 'catmandu' ),
				'panel'    => 'panel-global'
			),
			//Colors
			array(
				'name'        => 'section-global-colors',
				'category'    => 'section',
				'priority'    => 3,
				'title'       => esc_html__( 'Colors', 'catmandu' ),
				'panel'       => 'panel-global',
			),

			//Buttons
			array(
				'name'     => 'section-global-buttons',
				'category' => 'section',
				'priority' => 4,
				'title'    => esc_html__( 'Buttons', 'catmandu' ),
				'panel'    => 'panel-global'
			)
		);

		$header_sections = array(
			//Site Identity
			array(
				'name'               => 'title_tagline',
				'category'           => 'section',
				'priority'           => 2,
				'title'              => __( 'Site Identity', 'catmandu' ),
				'panel'              => 'panel-header',
				'description_hidden' => true,
			),

			//Primary Header
			array(
				'name'     => 'section-header-primary',
				'category' => 'section',
				'priority' => 2,
				'title'    => esc_html__( 'Primary Header & Menus', 'catmandu' ),
				'panel'    => 'panel-header'
			),

			//Top Header
			array(
				'name'     => 'section-header-top',
				'category' => 'section',
				'priority' => 3,
				'title'    => esc_html__( 'Top Header', 'catmandu' ),
				'panel'    => 'panel-header'
			),

			//Transparent Header
			array(
				'name'     => 'section-header-transparent-header',
				'category' => 'section',
				'priority' => 4,
				'title'    => esc_html__( 'Transparent Header', 'catmandu' ),
				'panel'    => 'panel-header'
			),

			//Sticky Header
			array(
				'name'     => 'section-header-sticky',
				'category' => 'section',
				'priority' => 5,
				'title'    => esc_html__( 'Sticky Header', 'catmandu' ),
				'panel'    => 'panel-header'
			),

			//Transparent Header
			array(
				'name'     => 'section-header-banner-image',
				'category' => 'section',
				'priority' => 6,
				'title'    => esc_html__( 'Inner Banner Image', 'catmandu' ),
				'panel'    => 'panel-header'
			),
		);

		$home_page_sections = array(
			array(
				'name'               => 'section-homepage-sort',
				'category'           => 'section',
				'priority'           => 10,
				'title'              => __( 'Sort sections', 'catmandu' ),
				'description_hidden' => true,
				'panel'				 => 'panel-homepage'
			),
			array(
				'name'               => 'section-slider',
				'category'           => 'section',
				'priority'           => 20,
				'title'              => __( 'Slider', 'catmandu' ),
				'description_hidden' => true,
				'panel'				 => 'panel-homepage'
			),
			array(
				'name'               => 'section-features',
				'category'           => 'section',
				'priority'           => 40,
				'title'              => __( 'Features', 'catmandu' ),
				'description_hidden' => true,
				'panel'				 => 'panel-homepage'
			),
			array(
				'name'               => 'section-news',
				'category'           => 'section',
				'priority'           => 70,
				'title'              => __( 'News', 'catmandu' ),
				'description_hidden' => true,
				'panel'				 => 'panel-homepage'
			),
			array(
				'name'               => 'section-video',
				'category'           => 'section',
				'priority'           => 80,
				'title'              => __( 'Video', 'catmandu' ),
				'description_hidden' => true,
				'panel'				 => 'panel-homepage'
			),
			array(
				'name'               => 'section-projects',
				'category'           => 'section',
				'priority'           => 150,
				'title'              => __( 'Projects', 'catmandu' ),
				'description_hidden' => true,
				'panel'				 => 'panel-homepage'
			),
			array(
				'name'               => 'section-newsletter',
				'category'           => 'section',
				'priority'           => 180,
				'title'              => __( 'Newsletter', 'catmandu' ),
				'description_hidden' => true,
				'panel'				 => 'panel-homepage'
			),
			array(
				'name'               => 'section-cta',
				'category'           => 'section',
				'priority'           => 190,
				'title'              => __( 'Call to Action', 'catmandu' ),
				'description_hidden' => true,
				'panel'				 => 'panel-homepage'
			),
		);
		
		$breadrumb_sections = array(
			array(
				'name'               => 'section-breadcrumbs',
				'category'           => 'section',
				'priority'           => 30,
				'title'              => __( 'Breadcrumbs', 'catmandu' ),
				'description_hidden' => false,
			)
		);
		
		$blog_sections = array(
			array(
				'name'        => 'section-blog-archive',
				'category'    => 'section',
				'priority'    => 40,
				'panel'       => 'panel-blog',
				'description' => esc_html__( 'Note: This option will effect archive/blog listing page.', 'catmandu' ),
				'title'       => __( 'Blog/Archive Page', 'catmandu' ),
			),
			array(
				'name'        => 'section-single-post',
				'category'    => 'section',
				'priority'    => 45,
				'panel'       => 'panel-blog',
				'description' => esc_html__( 'Note: This option will effect only in single posts.', 'catmandu' ),
				'title'       => __( 'Single Posts', 'catmandu' ),
			),
			array(
				'name'     => 'section-blog-pagination',
				'category' => 'section',
				'priority' => 46,
				'panel'    => 'panel-blog',
				'title'    => __( 'Pagination', 'catmandu' ),
			)
		);

		$sidebar_sections = array(
			array(
				'name'               => 'section-sidebar',
				'category'           => 'section',
				'priority'           => 50,
				'title'              => __( 'Sidebar', 'catmandu' ),
				'description_hidden' => true,
			)
		);

		$footer_sections = array(
			//Footer Widgets
			array(
				'name'               => 'section-footer-widgets',
				'category'           => 'section',
				'priority'           => 50,
				'title'              => __( 'Footer Widgets', 'catmandu' ),
				'description_hidden' => true,
				'panel'              => 'panel-footer'
			),
			array(
				'name'               => 'section-footer-bar',
				'category'           => 'section',
				'priority'           => 60,
				'title'              => __( 'Last Footer Bar & Scroll Up', 'catmandu' ),
				'description_hidden' => true,
				'panel'              => 'panel-footer'
			)
		);

		return array_merge( $configs, $global_sections, $header_sections, $home_page_sections, $breadrumb_sections, $blog_sections, $sidebar_sections, $footer_sections );
	}
}

new Catmandu_Customizer_Register_Sections();