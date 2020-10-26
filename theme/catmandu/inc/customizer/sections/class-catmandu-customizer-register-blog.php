<?php
/**
 * Registering container section for customizer
 *
 * @package     Catmandu
 * @author      CodeManas
 * @copyright   Copyright (c) 2019, CodeManas
 * @since       1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Catmandu_Customizer_Register_Blog extends Catmandu_Customizer_Conifg_Base {

	public function register_configuration( $configs ) { 
		$defaults = Catmandu_Theme_Options::load_defaults();

		$blog_archive = array(
			//Arhive page fields
			array(
				'category' => 'field',
				'type'     => 'sortable',
				'settings' => 'field-blog-page-layout',
				'label'    => esc_html__( 'Post Structure', 'catmandu' ),
				'section'  => 'section-blog-archive',
				'default'  => $defaults['field-blog-page-layout'],
				'choices'  => [
					'image'   => esc_html__( 'Featured Image', 'catmandu' ),
					'meta'    => esc_html__( 'Meta', 'catmandu' ),
					'title'   => esc_html__( 'Title', 'catmandu' ),
					'content' => esc_html__( 'Content', 'catmandu' ),
				],
			),
			//Arhive page fields
			array(
				'category' => 'field',
				'type'     => 'select',
				'settings' => 'field-blog-archive-column',
				'label'    => esc_html__( 'Archive columns:', 'catmandu' ),
				'section'  => 'section-blog-archive',
				'default'  => $defaults['field-blog-archive-column'],
				'choices'     => [
					12 => esc_html__( '1 column', 'catmandu' ),
					3 => esc_html__( '4 columns', 'catmandu' ),
				],
			),
			array(
				'category' => 'field',
				'type'     => 'toggle',
				'settings' => 'field-blog-author-enable',
				'label'    => esc_html__( 'Enable Author', 'catmandu' ),
				'section'  => 'section-blog-archive',
				'default'  => $defaults['field-blog-author-enable'],
			),
			array(
				'category' => 'field',
				'type'     => 'text',
				'settings' => 'field-blog-read-more',
				'label'    => esc_html__( 'Read more text', 'catmandu' ),
				'section'  => 'section-blog-archive',
				'default'  => $defaults['field-blog-read-more'],
			),
			array(
				'category' => 'field',
				'type'     => 'number',
				'settings' => 'field-blog-excerpt-length',
				'label'    => esc_html__( 'Excerpt length', 'catmandu' ),
				'section'  => 'section-blog-archive',
				'default'  => $defaults['field-blog-excerpt-length'],
			),
		);
		


		$pagination = array(
			
			//Pagination
			array(
				'category' => 'field',
				'type'     => 'custom',
				'settings' => 'field-horizontal-line-container-9',
				'section'  => 'section-blog-pagination',
				'default'  => '<span class="customizer-catmandu-title wp-ui-text-highlight">' . __( 'Pagination', 'catmandu' ) . '</span>',
			),
			array(
				'category' => 'field',
				'type'     => 'radio-buttonset',
				'settings' => 'field-blog-post-pagination',
				'section'  => 'section-blog-pagination',
				'default'  => $defaults['field-blog-post-pagination'],
				'choices'  => array(
					'numeric'          => esc_html__( 'Numeric', 'catmandu' ),
					'legacy'           => esc_html__( 'Legacy Old/New', 'catmandu' ),
				),
			),
			array(
				'category' => 'field',
				'type'     => 'radio-buttonset',
				'settings' => 'field-pagination-alignment',
				'label'    => esc_html__( 'Pagination Alignment', 'catmandu' ),
				'section'  => 'section-blog-pagination',
				'default'  => $defaults['field-pagination-alignment'],
				'choices'  => [
					'left-align-pagination'   => esc_html__( 'Left', 'catmandu' ),
					'center-align-pagination' => esc_html__( 'Center', 'catmandu' ),
					'right-align-pagination'  => esc_html__( 'Right', 'catmandu' ),
				],
			),
		);

		$single_posts = array(
			array(
				'category'  => 'field',
				'type'      => 'toggle',
				'settings'  => 'field-single-pagination-enable',
				'label'     => esc_html__( 'Enable pagination ?', 'catmandu' ),
				'section'   => 'section-single-post',
				'default'   => $defaults['field-single-pagination-enable'],
				'transport' => 'refresh',
			),
		);

		return array_merge( $configs, $blog_archive, $single_posts, $pagination );
	}
}

new Catmandu_Customizer_Register_Blog();


