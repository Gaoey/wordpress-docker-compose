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

class Catmandu_Customizer_Register_Sidebar extends Catmandu_Customizer_Conifg_Base {

	public function register_configuration( $configs ) { 
		$defaults = Catmandu_Theme_Options::load_defaults();
		$sidebar_fields = array(
			array(
				'category'  => 'field',
				'type'      => 'select',
				'settings'  => 'field-sidebar-type',
				'label'     => esc_html__( 'Default Sidebar', 'catmandu' ),
				'section'   => 'section-sidebar',
				'default'   => $defaults['field-sidebar-type'],
				'transport' => 'refresh',
				'priority'  => 1,
				'multiple'  => 1,
				'choices'   => [
					'none'  => esc_html__( 'No Sidebar', 'catmandu' ),
					'left'  => esc_html__( 'Left Sidebar', 'catmandu' ),
					'right' => esc_html__( 'Right Sidebar', 'catmandu' ),
				],
			),
			array(
				'category'        => 'field',
				'type'            => 'custom',
				'settings'        => 'field-horizontal-line-container-7',
				'section'         => 'section-sidebar',
				'default'         => '<hr>',
				'priority'        => 2,
				'active_callback' => [
					[
						'setting'  => 'field-sidebar-type',
						'operator' => '!==',
						'value'    => 'none',
					]
				],
			),
			array(
				'category'        => 'field',
				'type'            => 'select',
				'settings'        => 'field-sidebar-post',
				'label'           => esc_html__( 'Posts Sidebar', 'catmandu' ),
				'section'         => 'section-sidebar',
				'default'   => $defaults['field-sidebar-post'],
				'priority'        => 3,
				'multiple'        => 1,
				'transport'       => 'refresh',
				'choices'         => [
					'default' => esc_html__( 'Default', 'catmandu' ),
					'none'    => esc_html__( 'No Sidebar', 'catmandu' ),
					'left'    => esc_html__( 'Left Sidebar', 'catmandu' ),
					'right'   => esc_html__( 'Right Sidebar', 'catmandu' ),
				],
				'active_callback' => [
					[
						'setting'  => 'field-sidebar-type',
						'operator' => '!==',
						'value'    => 'none',
					]
				],
			),
			array(
				'category'        => 'field',
				'type'            => 'select',
				'settings'        => 'field-sidebar-page',
				'label'           => esc_html__( 'Pages Sidebar', 'catmandu' ),
				'section'         => 'section-sidebar',
				'default'   => $defaults['field-sidebar-page'],
				'priority'        => 4,
				'multiple'        => 1,
				'transport'       => 'refresh',
				'choices'         => [
					'default' => esc_html__( 'Default', 'catmandu' ),
					'none'    => esc_html__( 'No Sidebar', 'catmandu' ),
					'left'    => esc_html__( 'Left Sidebar', 'catmandu' ),
					'right'   => esc_html__( 'Right Sidebar', 'catmandu' ),
				],
				'active_callback' => [
					[
						'setting'  => 'field-sidebar-type',
						'operator' => '!==',
						'value'    => 'none',
					]
				],
			),
			array(
				'category'        => 'field',
				'type'            => 'select',
				'settings'        => 'field-sidebar-archive',
				'label'           => esc_html__( 'Archive or Search Sidebar', 'catmandu' ),
				'section'         => 'section-sidebar',
				'default'   => $defaults['field-sidebar-archive'],
				'priority'        => 4,
				'multiple'        => 1,
				'transport'       => 'refresh',
				'choices'         => [
					'default' => esc_html__( 'Default', 'catmandu' ),
					'none'    => esc_html__( 'No Sidebar', 'catmandu' ),
					'left'    => esc_html__( 'Left Sidebar', 'catmandu' ),
					'right'   => esc_html__( 'Right Sidebar', 'catmandu' ),
				],
				'active_callback' => [
					[
						'setting'  => 'field-sidebar-type',
						'operator' => '!==',
						'value'    => 'none',
					]
				],
			),
			array(
				'category'        => 'field',
				'type'            => 'color',
				'settings'        => 'field-sidebar-heading-color',
				'label'           => esc_html__( 'Sidebar Heading Color', 'catmandu' ),
				'section'         => 'section-sidebar',
				'default'   => $defaults['field-sidebar-heading-color'],
				'active_callback' => [
					[
						'setting'  => 'field-sidebar-type',
						'operator' => '!==',
						'value'    => 'none',
					]
				],
				'transport'       => 'auto',
				'output'          => [
					[
						'element'  => '#sidebar-primary h2.widget-title',
						'property' => 'color'
					]
				]
			),
		);

		return array_merge( $configs, $sidebar_fields );
	}
}

new Catmandu_Customizer_Register_Sidebar();


