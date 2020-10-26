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

class Catmandu_Customizer_Register_Footer extends Catmandu_Customizer_Conifg_Base {

	public function register_configuration( $configs ) { 
		$defaults = Catmandu_Theme_Options::load_defaults();

		$footer_widgets = array(
			array(
				'category' => 'field',
				'type'     => 'radio-image',
				'settings' => 'field-footer-widget-layout',
				'label'    => esc_html__( 'Widget Layout Columns', 'catmandu' ),
				'section'  => 'section-footer-widgets',
				'default'         => $defaults['field-footer-widget-layout'],
				'choices'  => array(
					'no-widget' => get_theme_file_uri( '/assets/images/no-widget.svg' ),
					'wd-three'    => get_theme_file_uri( '/assets/images/widget-3.svg' ),
				),
			),
			array(
				'category'        => 'field',
				'type'            => 'color',
				'settings'        => 'field-footer-widget-background-color',
				'label'           => __( 'Widget area background Color', 'catmandu' ),
				'section'         => 'section-footer-widgets',
				'default'         => $defaults['field-footer-widget-background-color'],
				'active_callback' => [
					[
						'setting'  => 'field-footer-widget-layout',
						'operator' => '!==',
						'value'    => 'no-widget',
					]
				],
				'transport'       => 'auto',
				'output'          => [
					[
						'element'  => '#footer-widgets',
						'property' => 'background',
					]
				],
			),
			array(
				'category'        => 'field',
				'type'            => 'color',
				'settings'        => 'field-footer-widget-heading-color',
				'label'           => esc_html__( 'Foote widget heading color', 'catmandu' ),
				'section'         => 'section-footer-widgets',
				'default'   => $defaults['field-footer-widget-heading-color'],
				'active_callback' => [
					[
						'setting'  => 'field-footer-widget-layout',
						'operator' => '!==',
						'value'    => 'no-widget',
					]
				],
				'transport'       => 'auto',
				'output'          => [
					[
						'element'  => '#footer-widgets h4.widget-title',
						'property' => 'color'
					]
				]
			),
		);
		
		$footer_bar = array(
			//Footer Bar
			array(
				'category'    => 'field',
				'type'        => 'toggle',
				'settings'    => 'field-footer-bar-enable',
				'label'       => esc_html__( 'Enable Bottom Footer Bar', 'catmandu' ),
				'description' => esc_html__( 'This option toggles the footer bar.', 'catmandu' ),
				'section'     => 'section-footer-bar',
				'default'	=> $defaults['field-footer-bar-enable'],
			),
			array(
				'category'        => 'field',
				'type'            => 'textarea',
				'settings'        => 'field-footer-bar-copyright',
				'label'           => esc_html__( 'Copyright content', 'catmandu' ),
				'description'     => esc_html__( 'HTML allowed', 'catmandu' ),
				'section'         => 'section-footer-bar',
				'default'	=> $defaults['field-footer-bar-copyright'],
				'active_callback' => [
					[
						'setting'  => 'field-footer-bar-enable',
						'operator' => '===',
						'value'    => true,
					]
				],
				'partial_refresh'    => [
					'field-footer-bar-copyright' => [
						'selector'        => '#colophon .copyright',
						'render_callback' => function() {
							return 	Catmandu_Theme_Options::get_option( 'field-footer-bar-copyright' );
						},
					],
				],
			),
			
			// Add footer background option
			array(
				'category'        => 'field',
				'type'            => 'color',
				'settings'        => 'field-footer-bar-background-color',
				'label'           => esc_html__( 'Background Color', 'catmandu' ),
				'section'         => 'section-footer-bar',
				'default'	=> $defaults['field-footer-bar-background-color'],
				'active_callback' => [
					[
						'setting'  => 'field-footer-bar-enable',
						'operator' => '===',
						'value'    => true,
					]
				],
				'transport'       => 'auto',
				'output'          => [
					[
						'element'  => '#colophon',
						'property' => 'background'
					]
				]
			),

			array(
				'category'        => 'field',
				'type'            => 'custom',
				'settings'        => 'field-horizontal-scroll-up-section',
				'section'         => 'section-footer-bar',
				'default'         => '<span class="customizer-catmandu-title wp-ui-text-highlight">' . __( 'Scroll Up', 'catmandu' ) . '</span>',
				'active_callback' => [
					[
						'setting'  => 'field-footer-bar-enable',
						'operator' => '===',
						'value'    => true,
					]
				],
			),
			// Add scroll up enable option
			array(
				'category'        => 'field',
				'type'            => 'toggle',
				'settings'        => 'field-footer-bar-enable-scrollup',
				'label'           => esc_html__( 'Enable scroll up', 'catmandu' ),
				'description'     => esc_html__( 'This option toggles the "Scroll to top" arrow.', 'catmandu' ),
				'section'         => 'section-footer-bar',
				'default'	=> $defaults['field-footer-bar-enable-scrollup'],
			),
			// Add scroll up color option
			array(
				'category'        => 'field',
				'type'            => 'color',
				'settings'        => 'field-footer-bar-enable-scrollup-color',
				'transport'       => 'auto',
				'label'           => esc_html__( 'Scroll up background color', 'catmandu' ),
				'section'         => 'section-footer-bar',
				'default'	=> $defaults['field-footer-bar-enable-scrollup-color'],
				'active_callback' => [
					[
						'setting'  => 'field-footer-bar-enable-scrollup',
						'operator' => '===',
						'value'    => true,
					],
				],
				'output'          => [
					[
						'element'  => '#btn-scrollup a.scrollup',
						'property' => 'background'
					]
				]
			),
		);

		return array_merge( $configs, $footer_widgets, $footer_bar );
	}
}

new Catmandu_Customizer_Register_Footer();


