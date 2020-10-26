<?php
/**
 * Registering homepage section for customizer
 *
 * @package     Catmandu
 * @author      CodeManas
 * @copyright   Copyright (c) 2019, CodeManas
 * @since       1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}


class Catmandu_Customizer_Register_Homepage extends Catmandu_Customizer_Conifg_Base {

	public function register_configuration( $configs ) { 

		$defaults = Catmandu_Theme_Options::load_defaults();

		$homepage_sort_fields = [
			'Slider'      => esc_html__( 'Slider', 'catmandu' ),
			'Features'    => esc_html__( 'Features', 'catmandu' ),
			'News'        => esc_html__( 'News', 'catmandu' ),
			'Video'       => esc_html__( 'Video', 'catmandu' ),
			'Projects'    => esc_html__( 'Projects', 'catmandu' ),
			'Newsletter'  => esc_html__( 'Newsletter', 'catmandu' ),
			'CTA'         => esc_html__( 'Call To Action', 'catmandu' ),
		];

		$homepage_sort_fields = apply_filters( 'catmandu_filter_homepage_sort_fields', $homepage_sort_fields );

		$homepage_sections = array(
			array(
				'category'    => 'field',
				'type'        => 'sortable',
				'settings'    => 'field-homepage-sort',
				'label'       => esc_html__( 'Drag and drop the homepage sections', 'catmandu' ),
				'section'     => 'section-homepage-sort',
				'default'     => $defaults['field-homepage-sort'],
				'choices'     => $homepage_sort_fields,
			),
		);

		$slider_text_alignments = [
					'left'   => esc_html__( 'Left', 'catmandu' ),
					'right'  => esc_html__( 'Right', 'catmandu' ),
				];

		$slider_text_alignments = apply_filters( 'catmandu_filter_slider_text_alignments', $slider_text_alignments );

		$slider_sections = array(
			array(
				'category'  => 'field',
				'type'      => 'toggle',
				'settings'  => 'homepage-slider-enable',
				'label'     => esc_html__( 'Enable Slider ?', 'catmandu' ),
				'section'   => 'section-slider',
				'default'   => $defaults['homepage-slider-enable'],
				'transport' => 'refresh',
			),
			array(
				'category'    => 'field',
				'type'        => 'select',
				'settings'    => 'homepage-slider-content',
				'label'       => esc_html__( 'Content Type:', 'catmandu' ),
				'section'     => 'section-slider',
				'default'	  => $defaults['homepage-slider-content'],
				'active_callback' => $this->section_enable_active_cb( 'homepage-slider-enable' ),
				'choices'     => [
					'post' => esc_html__( 'Post', 'catmandu' ),
					'category' => esc_html__( 'Category', 'catmandu' ),
				],
			),
			array(
				'category'    => 'field',
				'type'        => 'repeater',
				'label'       => esc_html__( 'Post slider:', 'catmandu' ),
				'section'     => 'section-slider',
				'choices' => [
					'limit' => 3
				],
				'row_label' => [
					'type'  => 'text',
					'value' => esc_html__( 'Slider', 'catmandu' ),
				],
				'button_label' => esc_html__('Add slider', 'catmandu' ),
				'settings'     => 'homepage-slider-post-repeater',
				'default'	  => $defaults['homepage-slider-post-repeater'],
				'active_callback' => $this->slider_content_active_cb( 'post' ),
				'fields' => [
					'post' => [
						'type'        => 'select',
						'label'       => esc_html__( 'Post', 'catmandu' ),
						'choices' 	  => Kirki_Helper::get_posts( array( 'post_type' => 'post', 'posts_per_page' => 999 ) ),
					],
					'button_1_url'  => [
						'type'        => 'link',
						'label'       => esc_html__( 'Button 1 link', 'catmandu' ),
					],
					'button_2_url'  => [
						'type'        => 'link',
						'label'       => esc_html__( 'Button 2 link', 'catmandu' ),
					],
				]
			),

			array(
				'category'    => 'field',
				'type'        => 'select',
				'settings'    => 'homepage-slider-category',
				'label'       => esc_html__( 'Select Category:', 'catmandu' ),
				'section'     => 'section-slider',
				'choices'	  => Kirki_Helper::get_terms( 'category' ),
				'active_callback' => $this->slider_content_active_cb( 'category' )
			),
			array(
				'category'    => 'field',
				'type'        => 'repeater',
				'label'       => esc_html__( 'Category slider content:', 'catmandu' ),
				'section'     => 'section-slider',
				'active_callback' => $this->slider_content_active_cb( 'category' ),
				'row_label' => [
					'type'  => 'text',
					'value' => esc_html__( 'Slider content', 'catmandu' ),
				],
				'button_label' => esc_html__('Add slider content', 'catmandu' ),
				'settings'     => 'homepage-slider-cat-repeater',
				'choices' => [
					'limit' => 3
				],
				'fields' => [
					'button_1_txt'  => [
						'type'        => 'text',
						'label'       => esc_html__( 'Button 1 text', 'catmandu' ),
					],
					'button_1_url'  => [
						'type'        => 'link',
						'label'       => esc_html__( 'Button 1 link', 'catmandu' ),
					],
				]
			),

			array(
				'category' => 'field',
				'type'     => 'custom',
				'settings' => 'field-horizontal-slider',
				'active_callback' => $this->section_enable_active_cb( 'homepage-slider-enable' ),
				'section'  => 'section-slider',
				'default'  => '<span class="customizer-catmandu-title wp-ui-text-highlight">' . __( 'Slider Options', 'catmandu' ) . '</span>',
			),
			array(
				'category'    => 'field',
				'type'        => 'radio-buttonset',
				'settings'    => 'homepage-slider-text-position',
				'label'       => esc_html__( 'Text alignment:', 'catmandu' ),
				'active_callback' => $this->section_enable_active_cb( 'homepage-slider-enable' ),
				'default'     => $defaults['homepage-slider-text-position'],
				'choices'     => $slider_text_alignments,
				'section'     => 'section-slider',
			),
			array(
				'category'  => 'field',
				'type'      => 'toggle',
				'settings'  => 'slider-pause-enable',
				'label'     => esc_html__( 'Enable pause on hover ?', 'catmandu' ),
				'section'   => 'section-slider',
				'active_callback' => $this->section_enable_active_cb( 'homepage-slider-enable' ),
				'default'   => $defaults['slider-pause-enable'],
				'transport' => 'refresh',
			),
			
		);

		$features_sections = array(
			array(
				'category'  => 'field',
				'type'      => 'toggle',
				'settings'  => 'homepage-features-enable',
				'label'     => esc_html__( 'Enable Features ?', 'catmandu' ),
				'section'   => 'section-features',
				'default'   => $defaults['homepage-features-enable'],
				'transport' => 'refresh',
			),
			array(
				'category'  => 'field',
				'type'      => 'text',
				'settings'  => 'homepage-features-subtitle',
				'label'     => esc_html__( 'Sub title', 'catmandu' ),
				'section'   => 'section-features',
				'default'   => $defaults['homepage-features-subtitle'],
				'active_callback' => $this->section_enable_active_cb( 'homepage-features-enable' ),
				'partial_refresh'    => [
					'homepage-features-subtitle' => [
						'selector'        => '.page-template-tmpl-home .section-services .section-top-subtitle',
						'render_callback' => function() {
							return 	Catmandu_Theme_Options::get_option( 'homepage-features-subtitle' );
						},
					],
				],
			),
			array(
				'category'  => 'field',
				'type'      => 'text',
				'settings'  => 'homepage-features-title',
				'label'     => esc_html__( 'Title', 'catmandu' ),
				'section'   => 'section-features',
				'default'   => $defaults['homepage-features-title'],
				'active_callback' => $this->section_enable_active_cb( 'homepage-features-enable' ),
				'partial_refresh'    => [
					'homepage-features-title' => [
						'selector'        => '.page-template-tmpl-home .section-services .section-title',
						'render_callback' => function() {
							return 	Catmandu_Theme_Options::get_option( 'homepage-features-title' );
						},
					],
				],
			),
			array(
				'category'    => 'field',
				'type'        => 'select',
				'settings'    => 'homepage-features-content',
				'label'       => esc_html__( 'Content Type:', 'catmandu' ),
				'section'     => 'section-features',
				'default'	  => $defaults['homepage-features-content'],
				'active_callback' => $this->section_enable_active_cb( 'homepage-features-enable' ),
				'choices'     => [
					'post' => esc_html__( 'Post', 'catmandu' ),
					'category' => esc_html__( 'Category', 'catmandu' ),
				],
			),
			array(
				'category'    => 'field',
				'type'        => 'repeater',
				'label'       => esc_html__( 'Post features:', 'catmandu' ),
				'section'     => 'section-features',
				'choices' => [
					'limit' => 3
				],
				'row_label' => [
					'type'  => 'text',
					'value' => esc_html__( 'Features', 'catmandu' ),
				],
				'button_label' => esc_html__('Add feature', 'catmandu' ),
				'settings'     => 'homepage-features-post-repeater',
				'default'	  => $defaults['homepage-features-post-repeater'],
				'active_callback' => $this->features_content_active_cb( 'post' ),
				'fields' => [
					'post' => [
						'type'        => 'select',
						'label'       => esc_html__( 'Post', 'catmandu' ),
						'choices' 	  => Kirki_Helper::get_posts( array( 'post_type' => 'post', 'posts_per_page' => 999 ) ),
					],
					'icon'  => [
						'type'        => 'text',
						'label'       => esc_html__( 'Icon', 'catmandu' ),
						'description' => __( 'You can choose any of <a href="http://rhythm.nikadevs.com/content/icons-et-line" target="_blank">ET Icons</a>', 'catmandu' ),
					],
				]
			),
			array(
				'category'    => 'field',
				'type'        => 'select',
				'settings'    => 'homepage-features-category',
				'label'       => esc_html__( 'Select Category:', 'catmandu' ),
				'section'     => 'section-features',
				'choices'	  => Kirki_Helper::get_terms( 'category' ),
				'active_callback' => $this->features_content_active_cb( 'category' )
			),
			array(
				'category'    => 'field',
				'type'        => 'repeater',
				'label'       => esc_html__( 'Category features content:', 'catmandu' ),
				'section'     => 'section-features',
				'active_callback' => $this->features_content_active_cb( 'category' ),
				'row_label' => [
					'type'  => 'text',
					'value' => esc_html__( 'Features content', 'catmandu' ),
				],
				'button_label' => esc_html__('Add feature', 'catmandu' ),
				'settings'     => 'homepage-features-cat-repeater',
				'choices' => [
					'limit' => $this->count_posts_in_category( 'homepage-features-category' )
				],
				'fields' => [
					'btn_txt'  => [
						'type'        => 'text',
						'label'       => esc_html__( 'Button text', 'catmandu' ),
					],
					'icon'  => [
						'type'        => 'text',
						'label'       => esc_html__( 'Icon', 'catmandu' ),
						'description' => __( 'You can choose any of <a href="http://rhythm.nikadevs.com/content/icons-et-line" target="_blank">ET Icons</a>', 'catmandu' ),
					],
				]
			),
		);

		$news_sections = array(
			array(
				'category'  => 'field',
				'type'      => 'toggle',
				'settings'  => 'homepage-news-enable',
				'label'     => esc_html__( 'Enable News ?', 'catmandu' ),
				'section'   => 'section-news',
				'default'   => $defaults['homepage-news-enable'],
				'transport' => 'refresh',
			),
			array(
				'category'  => 'field',
				'type'      => 'text',
				'settings'  => 'homepage-news-subtitle',
				'label'     => esc_html__( 'Sub title', 'catmandu' ),
				'section'   => 'section-news',
				'default'   => $defaults['homepage-news-subtitle'],
				'active_callback' => $this->section_enable_active_cb( 'homepage-news-enable' ),
				'partial_refresh'    => [
					'homepage-news-subtitle' => [
						'selector'        => '.page-template-tmpl-home .section-latest-posts .section-top-subtitle',
						'render_callback' => function() {
							return 	Catmandu_Theme_Options::get_option( 'homepage-news-subtitle' );
						},
					],
				],
			),
			array(
				'category'  => 'field',
				'type'      => 'text',
				'settings'  => 'homepage-news-title',
				'label'     => esc_html__( 'Title', 'catmandu' ),
				'section'   => 'section-news',
				'default'   => $defaults['homepage-news-title'],
				'active_callback' => $this->section_enable_active_cb( 'homepage-news-enable' ),
				'partial_refresh'    => [
					'homepage-news-title' => [
						'selector'        => '.page-template-tmpl-home .section-latest-posts .section-title',
						'render_callback' => function() {
							return 	Catmandu_Theme_Options::get_option( 'homepage-news-title' );
						},
					],
				],
			),
			array(
				'category'    => 'field',
				'type'        => 'select',
				'settings'    => 'homepage-news-content',
				'label'       => esc_html__( 'Content Type:', 'catmandu' ),
				'section'     => 'section-news',
				'default'	  => $defaults['homepage-news-content'],
				'active_callback' => $this->section_enable_active_cb( 'homepage-news-enable' ),
				'choices'     => [
					'post' => esc_html__( 'Post', 'catmandu' ),
					'category' => esc_html__( 'Category', 'catmandu' ),
				],
			),
			array(
				'category'    => 'field',
				'type'        => 'repeater',
				'label'       => esc_html__( 'Post news:', 'catmandu' ),
				'section'     => 'section-news',
				'choices' => [
					'limit' => 3
				],
				'row_label' => [
					'type'  => 'text',
					'value' => esc_html__( 'News', 'catmandu' ),
				],
				'button_label' => esc_html__('Add news', 'catmandu' ),
				'settings'     => 'homepage-news-post-repeater',
				'default'	  => $defaults['homepage-news-post-repeater'],
				'active_callback' => $this->news_content_active_cb( 'post' ),
				'fields' => [
					'post' => [
						'type'        => 'select',
						'label'       => esc_html__( 'Post', 'catmandu' ),
						'choices' 	  => Kirki_Helper::get_posts( array( 'post_type' => 'post', 'posts_per_page' => 999 ) ),
					],
				]
			),
			array(
				'category'    => 'field',
				'type'        => 'select',
				'settings'    => 'homepage-news-category',
				'label'       => esc_html__( 'Select Category:', 'catmandu' ),
				'section'     => 'section-news',
				'choices'	  => Kirki_Helper::get_terms( 'category' ),
				'active_callback' => $this->news_content_active_cb( 'category' )
			),
			array(
				'category' => 'field',
				'type'     => 'custom',
				'settings' => 'field-horizontal-news',
				'active_callback' => $this->section_enable_active_cb('homepage-news-enable'),
				'section'  => 'section-news',
				'default'  => '<span class="customizer-catmandu-title wp-ui-text-highlight">' . __( 'News Options', 'catmandu' ) . '</span>',
			),
			array(
				'category'  => 'field',
				'type'      => 'link',
				'settings'  => 'homepage-news-btn-url',
				'label'     => esc_html__( 'Button link', 'catmandu' ),
				'section'   => 'section-news',
				'default'   => $defaults['homepage-news-btn-url'],
				'active_callback' => $this->section_enable_active_cb( 'homepage-news-enable' ),
			),
		);

		$video_sections = array(
			array(
				'category'  => 'field',
				'type'      => 'toggle',
				'settings'  => 'homepage-video-enable',
				'label'     => esc_html__( 'Enable video section ?', 'catmandu' ),
				'section'   => 'section-video',
				'default'   => $defaults['homepage-video-enable'],
				'transport' => 'refresh',
			),
			array(
				'category'    => 'field',
				'type'        => 'select',
				'choices' 	  => Kirki_Helper::get_posts( array( 'post_type' => 'post', 'posts_per_page' => 999 ) ),
				'label'       => esc_html__( 'Post:', 'catmandu' ),
				'section'     => 'section-video',
				'settings'     => 'homepage-video-post',
				'default'	  => $defaults['homepage-video-post'],
				'active_callback' => $this->video_content_active_cb(),
			),
			array(
				'category'  => 'field',
				'type'      => 'link',
				'settings'  => 'homepage-video-link',
				'label'     => esc_html__( 'Video Link', 'catmandu' ),
				'section'   => 'section-video',
				'default'   => $defaults['homepage-video-link'],
				'active_callback' => $this->section_enable_active_cb( 'homepage-video-enable' ),
			),
			array(
				'category'  => 'field',
				'type'      => 'toggle',
				'settings'  => 'homepage-video-overlay-enable',
				'label'     => esc_html__( 'Enable overlay on image?', 'catmandu' ),
				'section'   => 'section-video',
				'active_callback' => $this->section_enable_active_cb( 'homepage-video-enable' ),
				'default'   => $defaults['homepage-video-overlay-enable'],
			),
		);

		$projects_sections = array(
			array(
				'category'  => 'field',
				'type'      => 'toggle',
				'settings'  => 'homepage-projects-enable',
				'label'     => esc_html__( 'Enable Project ?', 'catmandu' ),
				'section'   => 'section-projects',
				'default'   => $defaults['homepage-projects-enable'],
				'transport' => 'refresh',
			),
			array(
				'category'  => 'field',
				'type'      => 'text',
				'settings'  => 'homepage-projects-subtitle',
				'label'     => esc_html__( 'Sub title', 'catmandu' ),
				'section'   => 'section-projects',
				'default'   => $defaults['homepage-projects-subtitle'],
				'active_callback' => $this->section_enable_active_cb( 'homepage-projects-enable' ),
				'partial_refresh'    => [
					'homepage-projects-subtitle' => [
						'selector'        => '.page-template-tmpl-home .section-project .section-top-subtitle',
						'render_callback' => function() {
							return 	Catmandu_Theme_Options::get_option( 'homepage-projects-subtitle' );
						},
					],
				],
			),
			array(
				'category'  => 'field',
				'type'      => 'text',
				'settings'  => 'homepage-projects-title',
				'label'     => esc_html__( 'Title', 'catmandu' ),
				'section'   => 'section-projects',
				'default'   => $defaults['homepage-projects-title'],
				'active_callback' => $this->section_enable_active_cb( 'homepage-projects-enable' ),
				'partial_refresh'    => [
					'homepage-projects-title' => [
						'selector'        => '.page-template-tmpl-home .section-project .section-title',
						'render_callback' => function() {
							return 	Catmandu_Theme_Options::get_option( 'homepage-projects-title' );
						},
					],
				],
			),
			array(
				'category'    => 'field',
				'type'        => 'select',
				'settings'    => 'homepage-projects-content',
				'label'       => esc_html__( 'Content Type:', 'catmandu' ),
				'section'     => 'section-projects',
				'default'	  => $defaults['homepage-projects-content'],
				'active_callback' => $this->section_enable_active_cb( 'homepage-projects-enable' ),
				'choices'     => [
					'post' => esc_html__( 'Post', 'catmandu' ),
					'category' => esc_html__( 'Category', 'catmandu' ),
				],
			),
			array(
				'category'    => 'field',
				'type'        => 'repeater',
				'label'       => esc_html__( 'Post projects:', 'catmandu' ),
				'section'     => 'section-projects',
				'choices' => [
					'limit' => 3
				],
				'row_label' => [
					'type'  => 'text',
					'value' => esc_html__( 'Project', 'catmandu' ),
				],
				'button_label' => esc_html__('Add projects', 'catmandu' ),
				'settings'     => 'homepage-projects-post-repeater',
				'default'	  => $defaults['homepage-projects-post-repeater'],
				'active_callback' => $this->projects_content_active_cb( 'post' ),
				'fields' => [
					'post' => [
						'type'        => 'select',
						'label'       => esc_html__( 'Post', 'catmandu' ),
						'choices' 	  => Kirki_Helper::get_posts( array( 'post_type' => 'post', 'posts_per_page' => 999 ) ),
					],
				]
			),
			array(
				'category'    => 'field',
				'type'        => 'select',
				'settings'    => 'homepage-projects-category',
				'label'       => esc_html__( 'Select Category:', 'catmandu' ),
				'section'     => 'section-projects',
				'choices'	  => Kirki_Helper::get_terms( 'category' ),
				'active_callback' => $this->projects_content_active_cb( 'category' )
			),
		);

		$newsletter_sections = array(
			array(
				'category'  => 'field',
				'type'      => 'toggle',
				'settings'  => 'homepage-newsletter-enable',
				'label'     => esc_html__( 'Enable newsletter section ?', 'catmandu' ),
				'section'   => 'section-newsletter',
				'default'   => $defaults['homepage-newsletter-enable'],
				'transport' => 'refresh',
			),
			array(
				'category'    => 'field',
				'type'        => 'select',
				'choices' 	  => Kirki_Helper::get_posts( array( 'post_type' => 'post', 'posts_per_page' => 999 ) ),
				'label'       => esc_html__( 'Post:', 'catmandu' ),
				'section'     => 'section-newsletter',
				'settings'     => 'homepage-newsletter-post',
				'default'	  => $defaults['homepage-newsletter-post'],
				'active_callback' => $this->newsletter_content_active_cb(),
			),
			array(
				'category'  => 'field',
				'type'      => 'text',
				'settings'  => 'homepage-newsletter-shortcode',
				'label'     => esc_html__( 'Newsletter shortcode', 'catmandu' ),
				'default'   => $defaults['homepage-newsletter-shortcode'],
				'section'   => 'section-newsletter',
				'active_callback' => $this->section_enable_active_cb( 'homepage-newsletter-enable' ),
			),
			array(
				'category'  => 'field',
				'type'      => 'toggle',
				'settings'  => 'homepage-newsletter-overlay-enable',
				'label'     => esc_html__( 'Enable overlay on image?', 'catmandu' ),
				'section'   => 'section-newsletter',
				'active_callback' => $this->section_enable_active_cb( 'homepage-newsletter-enable' ),
				'default'   => $defaults['homepage-newsletter-overlay-enable'],
			),
		);

		$cta_sections = array(
			array(
				'category'  => 'field',
				'type'      => 'select',
				'settings'  => 'homepage-cta-enable',
				'label'     => esc_html__( 'Enable "call to action" section on ?', 'catmandu' ),
				'section'   => 'section-cta',
				'default'   => $defaults['homepage-cta-enable'],
				'choices'     => [
					'homepage' => esc_html__( 'Homepage Template', 'catmandu' ),
					'entire-site' => esc_html__( 'Entire Site', 'catmandu' ),
					'pages' => esc_html__( 'Pages Only', 'catmandu' ),
					'posts' => esc_html__( 'Posts Only', 'catmandu' ),
					'disable' => esc_html__( 'Disable', 'catmandu' ),
				],
			),
			array(
				'category'    => 'field',
				'type'        => 'select',
				'choices' 	  => Kirki_Helper::get_posts( array( 'post_type' => 'post', 'posts_per_page' => 999 ) ),
				'label'       => esc_html__( 'Post:', 'catmandu' ),
				'section'     => 'section-cta',
				'settings'     => 'homepage-cta-post',
				'default'	  => $defaults['homepage-cta-post'],
				'active_callback' => $this->cta_content_active_cb( 'post' ),
			),
			array(
				'category'  => 'field',
				'type'      => 'text',
				'settings'  => 'homepage-cta-subtitle',
				'label'     => esc_html__( 'Sub title', 'catmandu' ),
				'section'   => 'section-cta',
				'default'   => $defaults['homepage-cta-subtitle'],
				'active_callback' => $this->section_enable_on_active_cb( 'homepage-cta-enable' ),
				'partial_refresh'    => [
					'homepage-cta-subtitle' => [
						'selector'        => '.page-template-tmpl-home .section-call-to-action .section-top-subtitle',
						'render_callback' => function() {
							return 	Catmandu_Theme_Options::get_option( 'homepage-cta-subtitle' );
						},
					],
				],
			),
		);

		return array_merge( $configs, $homepage_sections, $slider_sections, $features_sections, $news_sections, $video_sections, $projects_sections, $newsletter_sections, $cta_sections );
	}

	public function section_enable_active_cb( $setting ) {
		return [
			[
				'setting'  => $setting,
				'operator' => '===',
				'value'    => true,
			]
		];
	}

	private function section_enable_on_active_cb( $setting ) {
		return [
			[
				'setting'  => $setting,
				'operator' => '!=',
				'value'    => 'disable',
			]
		];
	}

	private function slider_content_active_cb( $value ) {
		return [
			[
				'setting'  => 'homepage-slider-enable',
				'operator' => '===',
				'value'    => true,
			],
			[
				'setting'  => 'homepage-slider-content',
				'operator' => '===',
				'value'    => $value,
			],
		];
	}

	private function features_content_active_cb( $value ) {
		return [
			[
				'setting'  => 'homepage-features-enable',
				'operator' => '===',
				'value'    => true,
			],
			[
				'setting'  => 'homepage-features-content',
				'operator' => '===',
				'value'    => $value,
			],
		];
	}

	private function news_content_active_cb( $value ) {
		return [
			[
				'setting'  => 'homepage-news-enable',
				'operator' => '===',
				'value'    => true,
			],
			[
				'setting'  => 'homepage-news-content',
				'operator' => '===',
				'value'    => $value,
			],
		];
	}

	private function video_content_active_cb() {
		return [
			[
				'setting'  => 'homepage-video-enable',
				'operator' => '===',
				'value'    => true,
			],
		];
	}

	private function projects_content_active_cb( $value ) {
		return [
			[
				'setting'  => 'homepage-projects-enable',
				'operator' => '===',
				'value'    => true,
			],
			[
				'setting'  => 'homepage-projects-content',
				'operator' => '===',
				'value'    => $value,
			],
		];
	}

	private function newsletter_content_active_cb() {
		return [
			[
				'setting'  => 'homepage-newsletter-enable',
				'operator' => '===',
				'value'    => true,
			],
		];
	}

	private function cta_content_active_cb() {
		return [
			[
				'setting'  => 'homepage-cta-enable',
				'operator' => '!=',
				'value'    => 'disable',
			],
		];
	}

	private function count_posts_in_category( $setting ) {
		$selected_cat = Catmandu_Theme_Options::get_option( $setting );

		$cat = get_category( absint( $selected_cat ) );

		if ( ! empty( $cat->count ) ) {
			return $cat->count;
		} else {
			return 1;
		}

	}
}

new Catmandu_Customizer_Register_Homepage();

