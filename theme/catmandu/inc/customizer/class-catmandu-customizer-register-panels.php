<?php
/**
 * Registering panels for customizer
 *
 * @package     Catmandu
 * @author      CodeManas
 * @copyright   Copyright (c) 2019, CodeManas
 * @since       1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Catmandu_Customizer_Register_Panels extends Catmandu_Customizer_Conifg_Base {

	public function register_configuration( $configs ) {
		$panel = array(
			array(
				'category' => 'panel',
				'name'     => 'panel-global',
				'priority' => 10,
				'title'    => esc_html__( 'Global', 'catmandu' ),
			),
			array(
				'category' => 'panel',
				'name'     => 'panel-header',
				'priority' => 20,
				'title'    => esc_html__( 'Header', 'catmandu' ),
			),
			array(
				'category' => 'panel',
				'name'     => 'panel-blog',
				'priority' => 30,
				'title'    => esc_html__( 'Blog', 'catmandu' ),
			),
			array(
				'category' => 'panel',
				'name'     => 'panel-homepage',
				'priority' => 40,
				'title'    => esc_html__( 'Homepage', 'catmandu' ),
			),
			array(
				'category' => 'panel',
				'name'     => 'panel-about',
				'priority' => 50,
				'title'    => esc_html__( 'About Us Template', 'catmandu' ),
			),
			array(
				'category' => 'panel',
				'name'     => 'panel-footer',
				'priority' => 70,
				'title'    => esc_html__( 'Footer', 'catmandu' ),
			),
		);

		return array_merge( $configs, $panel );
	}

}

new Catmandu_Customizer_Register_Panels();