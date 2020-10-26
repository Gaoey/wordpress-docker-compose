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

class Catmandu_Customizer_Register_Header extends Catmandu_Customizer_Conifg_Base {

	public function register_configuration( $configs ) { 
		$defaults = Catmandu_Theme_Options::load_defaults();

		$top_header = array(
			
			//Top Header
			array(
				'category'  => 'field',
				'type'      => 'toggle',
				'settings'  => 'field-top-header-enable',
				'label'     => esc_html__( 'Enable Top Header ?', 'catmandu' ),
				'section'   => 'section-header-top',
				'default'   => $defaults['field-top-header-enable'],
				'transport' => 'refresh',
			),
			array(
				'category'    => 'field',
				'type'        => 'repeater',
				'label'       => esc_html__( 'Quick contact:', 'catmandu' ),
				'section'     => 'section-header-top',
				'choices' => [
					'limit' => 1
				],
				'row_label' => [
					'type'  => 'text',
					'value' => esc_html__( 'Quick contact ', 'catmandu' ),
				],
				'button_label' => esc_html__('Add quick contact', 'catmandu' ),
				'settings'     => 'top-quick-contact',
				'fields' => [
					'title' => [
						'type'        => 'text',
						'label'       => esc_html__( 'Title', 'catmandu' ),
						'description'       => esc_html__( 'This will not be visible in Header 1 layout', 'catmandu' ),
					],
					'contact' => [
						'type'        => 'text',
						'label'       => esc_html__( 'Contact', 'catmandu' ),
					],
					'icon'  => [
						'type'        => 'text',
						'label'       => esc_html__( 'Icon', 'catmandu' ),
						'description' => __( 'You can choose any of <a href="https://fontawesome.com/cheatsheet?from=io" target="_blank">Fontawesome Icons</a> as a prefix icon for the contact.', 'catmandu' ),
					],
				]
			),
			array(
				'category'    => 'field',
				'type'        => 'repeater',
				'label'       => esc_html__( 'Social connects:', 'catmandu' ),
				'section'     => 'section-header-top',
				'choices' => [
					'limit' => 2
				],
				'row_label' => [
					'type'  => 'text',
					'value' => esc_html__( 'Social connect ', 'catmandu' ),
				],
				'button_label' => esc_html__('Add connection', 'catmandu' ),
				'settings'     => 'top-social-connect',
				'fields' => [
					'link' => [
						'type'        => 'link',
						'label'       => esc_html__( 'Link', 'catmandu' ),
					],
				]
			),
		);

		$_header_menu_disable_cb = array(
			'setting'  => 'field-header-menu-disable',
			'operator' => '===',
			'value'    => false,
		);

		$primary_header_field = array(
			array(
				'category'        => 'field',
				'type'            => 'custom',
				'settings'        => 'field-horizontal-line-container-3',
				'section'         => 'section-header-primary',
				'default'         => '<span class="customizer-catmandu-title wp-ui-text-highlight nomargin">' . __( 'Menu Section', 'catmandu' ) . '</span>',
				'active_callback' => [ $_header_menu_disable_cb ]
			),
			array(
				'category' => 'field',
				'type'     => 'checkbox',
				'settings' => 'field-header-menu-disable',
				'label'    => esc_html__( 'Disable Menu', 'catmandu' ),
				'section'  => 'section-header-primary',
				'default'  => $defaults['field-header-menu-disable'],
			),
			array(
				'category'        => 'field',
				'type'            => 'checkbox',
				'settings'        => 'field-header-menu-disable-search',
				'label'           => esc_html__( 'Disable Search', 'catmandu' ),
				'section'         => 'section-header-primary',
				'default'         => $defaults['field-header-menu-disable-search'],
				'active_callback' => [ $_header_menu_disable_cb ]
			),
			array(
				'category'        => 'field',
				'type'            => 'checkbox',
				'settings'        => 'field-header-menu-disable-minicart',
				'label'           => esc_html__( 'Disable Mini Cart', 'catmandu' ),
				'section'         => 'section-header-primary',
				'default'         => $defaults['field-header-menu-disable-minicart'],
				'active_callback' => [ $_header_menu_disable_cb ]
			),
			array(
				'category'        => 'field',
				'type'            => 'select',
				'settings'        => 'field-header-menu-last-item',
				'transport'       => 'auto',
				'label'           => esc_html__( 'Last item in menu', 'catmandu' ),
				'section'         => 'section-header-primary',
				'default'         => $defaults['field-header-menu-last-item'],
				'choices'         => $this->lastMenuItems(),
				'active_callback' => [ $_header_menu_disable_cb ]
			),
			array(
				'category'        => 'field',
				'type'            => 'text',
				'settings'        => 'field-header-menu-last-item-button-text',
				'label'           => esc_html__( 'Button Text', 'catmandu' ),
				'section'         => 'section-header-primary',
				'default'         => $defaults['field-header-menu-last-item-button-text'],
				'active_callback' => array(
					$_header_menu_disable_cb,
					array(
						'setting'  => 'field-header-menu-last-item',
						'operator' => '===',
						'value'    => 'button',
					),
				),
				'partial_refresh'    => [
					'field-header-menu-last-item-button-text' => [
						'selector'        => '.catmandu-theme-btn',
						'render_callback' => function() {
							return Catmandu_Theme_Options::get_option( 'field-header-menu-last-item-button-text' );
						},
					],
				],
			),
			array(
				'category'        => 'field',
				'type'            => 'link',
				'settings'        => 'field-header-menu-last-item-btn-link',
				'label'           => esc_html__( 'Button Link', 'catmandu' ),
				'section'         => 'section-header-primary',
				'default'         => $defaults['field-header-menu-last-item-btn-link'],
				'active_callback' => array(
					$_header_menu_disable_cb,
					array(
						'setting'  => 'field-header-menu-last-item',
						'operator' => '===',
						'value'    => 'button',
					),
				),
			),
			array(
				'category'        => 'field',
				'type'            => 'color',
				'settings'        => 'field-header-menu-last-item-btn-color',
				'label'           => __( 'Button Background Color', 'catmandu' ),
				'section'         => 'section-header-primary',
				'default'         => $defaults['field-header-menu-last-item-btn-color'],
				'active_callback' => array(
					$_header_menu_disable_cb,
					array(
						'setting'  => 'field-header-menu-last-item',
						'operator' => '===',
						'value'    => 'button',
					),
				),
				'transport'       => 'auto',
				'output'          => [
					[
						'element'  => '.main-navigation ul li a.catmandu-theme-btn',
						'property' => 'background'
					]
				]
			),
			array(
				'category'        => 'field',
				'type'            => 'color',
				'settings'        => 'field-header-menu-last-item-btn-text-color',
				'label'           => __( 'Button Text Color', 'catmandu' ),
				'section'         => 'section-header-primary',
				'default'         => $defaults['field-header-menu-last-item-btn-text-color'],
				'active_callback' => array(
					$_header_menu_disable_cb,
					array(
						'setting'  => 'field-header-menu-last-item',
						'operator' => '===',
						'value'    => 'button',
					),
				),
				'transport'       => 'auto',
				'output'          => [
					[
						'element'  => '.main-navigation ul li a.catmandu-theme-btn',
						'property' => 'color',
						'suffix'   => '!important'
					]
				]
			),
			array(
				'category'        => 'field',
				'type'            => 'slider',
				'settings'        => 'field-header-menu-last-item-btn-vertical',
				'label'           => __( 'Vertical Padding', 'catmandu' ),
				'section'         => 'section-header-primary',
				'default'         => $defaults['field-header-menu-last-item-btn-vertical'],
				'choices'         => [
					'min'  => 1,
					'max'  => 40,
					'step' => 1,
				],
				'transport'       => 'auto',
				'output'          => [
					[
						'element'       => '.main-navigation ul li a.catmandu-theme-btn',
						'property'      => 'padding-top',
						'value_pattern' => '$px',
					],
					[
						'element'       => '.main-navigation ul li a.catmandu-theme-btn',
						'property'      => 'padding-bottom',
						'value_pattern' => '$px',
					],
				],
				'active_callback' => array(
					$_header_menu_disable_cb,
					array(
						'setting'  => 'field-header-menu-last-item',
						'operator' => '===',
						'value'    => 'button',
					),
				)
			),
			array(
				'category'        => 'field',
				'type'            => 'slider',
				'settings'        => 'field-header-menu-last-item-btn-horizontal',
				'label'           => __( 'Horizontal Padding', 'catmandu' ),
				'section'         => 'section-header-primary',
				'default'         => $defaults['field-header-menu-last-item-btn-horizontal'],
				'choices'         => [
					'min'  => 1,
					'max'  => 40,
					'step' => 1,
				],
				'transport'       => 'auto',
				'output'          => [
					[
						'element'       => '.main-navigation ul li a.catmandu-theme-btn',
						'property'      => 'padding-left',
						'value_pattern' => '$px',
					],
					[
						'element'       => '.main-navigation ul li a.catmandu-theme-btn',
						'property'      => 'padding-right',
						'value_pattern' => '$px',
					],
				],
				'active_callback' => array(
					$_header_menu_disable_cb,
					array(
						'setting'  => 'field-header-menu-last-item',
						'operator' => '===',
						'value'    => 'button',
					),
				)
			),
			array(
				'category'        => 'field',
				'type'            => 'slider',
				'settings'        => 'field-header-menu-last-item-btn-border',
				'label'           => esc_html__( 'Border Width', 'catmandu' ),
				'section'         => 'section-header-primary',
				'default'         => $defaults['field-header-menu-last-item-btn-border'],
				'choices'         => [
					'min'  => 0,
					'max'  => 40,
					'step' => 1,
				],
				'active_callback' => array(
					$_header_menu_disable_cb,
					array(
						'setting'  => 'field-header-menu-last-item',
						'operator' => '===',
						'value'    => 'button',
					),
				),
				'transport'       => 'auto',
				'output'          => [
					[
						'element'       => '.main-navigation ul li a.catmandu-theme-btn',
						'property'      => 'border',
						'value_pattern' => '$px solid'
					]
				]
			),
			array(
				'category'        => 'field',
				'type'            => 'color',
				'settings'        => 'field-header-menu-last-item-btn-border-color',
				'label'           => __( 'Button Border Color', 'catmandu' ),
				'section'         => 'section-header-primary',
				'default'         => $defaults['field-header-menu-last-item-btn-border-color'],
				'active_callback' => array(
					$_header_menu_disable_cb,
					array(
						'setting'  => 'field-header-menu-last-item',
						'operator' => '===',
						'value'    => 'button',
					),
				),
				'transport'       => 'auto',
				'output'          => [
					[
						'element'  => '.main-navigation ul li a.catmandu-theme-btn',
						'property' => 'border-color',
					]
				]
			),
			array(
				'category'        => 'field',
				'type'            => 'textarea',
				'settings'        => 'field-header-menu-last-item-btn-custom-text',
				'label'           => esc_html__( 'Custom Text/HTML', 'catmandu' ),
				'section'         => 'section-header-primary',
				'default'         => $defaults['field-header-menu-last-item-btn-custom-text'],
				'active_callback' => array(
					$_header_menu_disable_cb,
					array(
						'setting'  => 'field-header-menu-last-item',
						'operator' => '===',
						'value'    => 'text/html',
					),
				),
			),
			array(
				'category' => 'field',
				'type'     => 'custom',
				'settings' => 'field-horizontal-line-container-4',
				'section'  => 'section-header-primary',
				'default'  => '<span class="customizer-catmandu-title wp-ui-text-highlight">' . __( 'Menu Colors', 'catmandu' ) . '</span>',
			),
			array(
				'category'  => 'field',
				'type'      => 'color',
				'label'     => __( 'Menu color', 'catmandu' ),
				'settings'  => 'field-header-color-menu',
				'section'   => 'section-header-primary',
				'default'         => $defaults['field-header-color-menu'],
				'transport' => 'auto',
				'output'    => [
					[
						'element'  => '.main-navigation ul li a',
						'property' => 'color'
					]
				],
			),
			array(
				'category'  => 'field',
				'type'      => 'color',
				'settings'  => 'field-header-color-menu-hover',
				'label'     => __( 'Hover Menu color', 'catmandu' ),
				'section'   => 'section-header-primary',
				'default'         => $defaults['field-header-color-menu-hover'],
				'transport' => 'auto',
				'output'    => [
					[
						'element'  => '.main-navigation li > a:hover',
						'property' => 'color'
					]
				],
			),
			array(
				'category'  => 'field',
				'type'      => 'color',
				'settings'  => 'field-header-color-active-menu',
				'section'   => 'section-header-primary',
				'label'     => __( 'Active Menu Color', 'catmandu' ),
				'default'         => $defaults['field-header-color-active-menu'],
				'transport' => 'auto',
				'output'    => [
					[
						'element'  => '.main-navigation li.current-menu-item > a',
						'property' => 'color'
					],
					[
						'element'  => '.main-navigation li a::after',
						'property' => 'background-color'
					]
				],
			),
			array(
				'category' => 'field',
				'type'     => 'custom',
				'settings' => 'field-horizontal-line-container-12312',
				'section'  => 'section-header-primary',
				'default'  => '<span class="customizer-catmandu-title wp-ui-text-highlight">' . __( 'Sub-Menu Colors', 'catmandu' ) . '</span>',
			),
			array(
				'category'  => 'field',
				'type'      => 'color',
				'settings'  => 'field-header-color-sub-menu',
				'label'     => __( 'Sub-Menu Background color', 'catmandu' ),
				'section'   => 'section-header-primary',
				'default'         => $defaults['field-header-color-sub-menu'],
				'choices'   => [
					'alpha' => true,
				],
				'transport' => 'auto',
				'output'    => [
					[
						'element'  => '.main-navigation ul ul.sub-menu',
						'property' => 'background-color'
					],
				],
			),
			array(
				'category'  => 'field',
				'type'      => 'color',
				'settings'  => 'field-header-color-submenu-hover',
				'label'     => __( 'Sub-Menu Text color', 'catmandu' ),
				'section'   => 'section-header-primary',
				'default'         => $defaults['field-header-color-submenu-hover'],
				'transport' => 'auto',
				'output'    => [
					[
						'element'  => '.main-navigation ul ul a',
						'property' => 'color'
					]
				],
			),
			array(
				'category'  => 'field',
				'type'      => 'color',
				'settings'  => 'field-header-color-submenu-hover-text',
				'label'     => __( 'Sub-Menu Hover Text Color', 'catmandu' ),
				'section'   => 'section-header-primary',
				'default'         => $defaults['field-header-color-submenu-hover-text'],
				'transport' => 'auto',
				'output'    => [
					[
						'element'  => '.main-navigation li li:hover > a',
						'property' => 'color'
					]
				],
			),

			array(
				'category' => 'field',
				'type'     => 'custom',
				'settings' => 'field-horizontal-line-container-mobile-menu',
				'section'  => 'section-header-primary',
				'default'  => '<span class="customizer-catmandu-title wp-ui-text-highlight">' . __( 'Mobile Menu & Colors', 'catmandu' ) . '</span>',
			),
			array(
				'category'  => 'field',
				'type'      => 'color',
				'settings'  => 'field-header-mobile-menu-background',
				'section'   => 'section-header-primary',
				'label'     => __( 'Background Color', 'catmandu' ),
				'default'         => $defaults['field-header-mobile-menu-background'],
				'transport' => 'auto',
				'output'    => [
					[
						'element'     => '.sidr, .sidr .dropdown-icon',
						'property'    => 'background',
					],
					[
						'element'     => '.sidr, .sidr .dropdown-icon, .sidr ul li:hover > a',
						'property'    => 'box-shadow',
						'value_pattern' => '0 0 5px 5px $ inset'
					],
					[
						'element'     => '.sidr ul li',
						'property'    => 'border-top',
						'value_pattern' => '1px solid $'
					],
					[
						'element'     => '.sidr ul li',
						'property'    => 'border-bottom',
						'value_pattern' => '1px solid $'
					],
				],
			),
			array(
				'category'  => 'field',
				'type'      => 'color',
				'settings'  => 'field-header-mobile-menu-text-color',
				'section'   => 'section-header-primary',
				'label'     => __( 'Link Colors', 'catmandu' ),
				'default'         => $defaults['field-header-mobile-menu-text-color'],
				'transport' => 'auto',
				'output'    => [
					[
						'element'     => '.sidr ul li a, .sidr ul li ul li a',
						'property'    => 'color',
					],
				],
			),
			array(
				'category'  => 'field',
				'type'      => 'color',
				'settings'  => 'field-header-mobile-menu-hamburger',
				'section'   => 'section-header-primary',
				'label'     => __( 'Hamburger Color', 'catmandu' ),
				'default'         => $defaults['field-header-mobile-menu-hamburger'],
				'transport' => 'auto',
				'output'    => [
					[
						'element'     => '#mobile-trigger, #mobile-trigger-quick',
						'property'    => 'color',
					]
				],
			),
		);

		$site_identity = array(
			//Site Identity
			array(
				'category' => 'field',
				'type'     => 'slider',
				'settings' => 'field-identity-logo-width',
				'label'    => '<span class="customizer-catmandu-title wp-ui-text-highlight">' . __( 'Site Logo Width & Site Titles', 'catmandu' ) . '</span>',
				'section'  => 'title_tagline',
				'default'  => $defaults['field-identity-logo-width'],
				'choices'  => [
					'min'  => 1,
					'max'  => 600,
					'step' => 1,
				],
			),
			array(
				'category' => 'field',
				'type'     => 'checkbox',
				'settings' => 'field-identity-display-site-title',
				'label'    => esc_html__( 'Display Site Title', 'catmandu' ),
				'section'  => 'title_tagline',
				'default'  => $defaults['field-identity-display-site-title'],
			),
			array(
				'category' => 'field',
				'type'     => 'checkbox',
				'settings' => 'field-identity-display-site-tagline',
				'label'    => esc_html__( 'Display Site Tagline', 'catmandu' ),
				'section'  => 'title_tagline',
				'default'  => $defaults['field-identity-display-site-tagline'],
			),
			array(
				'category'        => 'field',
				'type'            => 'typography',
				'settings'        => 'field-identity-site-title-typography',
				'transport'       => 'auto',
				'label'           => esc_html__( 'Site Title Typography', 'catmandu' ),
				'section'         => 'title_tagline',
				'default'         => $defaults['field-identity-site-title-typography'],
				'active_callback' => array(
					array(
						'setting'  => 'field-identity-display-site-title',
						'operator' => '===',
						'value'    => true,
					),
				),
				'output'          => [
					[
						'element' => '.site-title a',
					],
				],
			),
			array(
				'category'        => 'field',
				'type'            => 'typography',
				'settings'        => 'field-identity-site-tagline',
				'transport'       => 'auto',
				'label'           => esc_html__( 'Site Tagline Typography', 'catmandu' ),
				'section'         => 'title_tagline',
				'default'         => $defaults['field-identity-site-tagline'],
				'active_callback' => array(
					array(
						'setting'  => 'field-identity-display-site-tagline',
						'operator' => '===',
						'value'    => true,
					),
				),
				'output'          => [
					[
						'element' => '.site-tagline',
					],
				],
			),

			array(
				'category' => 'field',
				'type'     => 'custom',
				'settings' => 'field-horizontal-line-container-favicon',
				'section'  => 'title_tagline',
				'default'  => '<span class="customizer-catmandu-title wp-ui-text-highlight">' . __( 'Site Favicon', 'catmandu' ) . '</span>',
			),
		);
		
		$transparent_header = array(
			//Transparent Header
			array(
				'category'  => 'field',
				'type'      => 'checkbox',
				'settings'  => 'field-header-transparent',
				'label'     => esc_html__( 'Enable Transparent Header Globally', 'catmandu' ),
				'section'   => 'section-header-transparent-header',
				'default'   => $defaults['field-header-transparent'],
				'transport' => 'refresh',
			),
			array(
				'category'        => 'field',
				'type'            => 'checkbox',
				'settings'        => 'field-header-transparent-blog-page',
				'label'           => esc_html__( 'Disable on Blog/Posts page ?', 'catmandu' ),
				'section'         => 'section-header-transparent-header',
				'default'         => $defaults['field-header-transparent-blog-page'],
				'transport'       => 'refresh',
				'active_callback' => array(
					array(
						'setting'  => 'field-header-transparent',
						'operator' => '===',
						'value'    => true,
					)
				),
			),
			array(
				'category'        => 'field',
				'type'            => 'checkbox',
				'settings'        => 'field-header-transparent-search-page',
				'label'           => esc_html__( 'Disable on Search page ?', 'catmandu' ),
				'section'         => 'section-header-transparent-header',
				'transport'       => 'refresh',
				'default'         => $defaults['field-header-transparent-search-page'],
				'active_callback' => array(
					array(
						'setting'  => 'field-header-transparent',
						'operator' => '===',
						'value'    => true,
					)
				),
			),
			array(
				'category'        => 'field',
				'type'            => 'checkbox',
				'settings'        => 'field-header-transparent-archive-page',
				'label'           => esc_html__( 'Disable on Archive page ?', 'catmandu' ),
				'transport'       => 'refresh',
				'default'         => $defaults['field-header-transparent-archive-page'],
				'section'         => 'section-header-transparent-header',
				'active_callback' => array(
					array(
						'setting'  => 'field-header-transparent',
						'operator' => '===',
						'value'    => true,
					)
				),
			),
			array(
				'category'        => 'field',
				'type'            => 'checkbox',
				'settings'        => 'field-header-transparent-single-page',
				'label'           => esc_html__( 'Disable on Single page ?', 'catmandu' ),
				'default'         => $defaults['field-header-transparent-single-page'],
				'section'         => 'section-header-transparent-header',
				'transport'       => 'refresh',
				'active_callback' => array(
					array(
						'setting'  => 'field-header-transparent',
						'operator' => '===',
						'value'    => true,
					)
				),
			),
			array(
				'category'        => 'field',
				'type'            => 'checkbox',
				'settings'        => 'field-header-transparent-single-post',
				'label'           => esc_html__( 'Disable on Single Post ?', 'catmandu' ),
				'section'         => 'section-header-transparent-header',
				'transport'       => 'refresh',
				'default'         => $defaults['field-header-transparent-single-post'],
				'active_callback' => array(
					array(
						'setting'  => 'field-header-transparent',
						'operator' => '===',
						'value'    => true,
					)
				),
			),
			array(
				'category'        => 'field',
				'type'            => 'checkbox',
				'settings'        => 'field-header-transparent-singular',
				'label'           => esc_html__( 'Disable on all single post/pages ?', 'catmandu' ),
				'section'         => 'section-header-transparent-header',
				'description'     => __( 'This will override single page or post options if enabled.', 'catmandu' ),
				'default'         => $defaults['field-header-transparent-singular'],
				'transport'       => 'refresh',
				'active_callback' => array(
					array(
						'setting'  => 'field-header-transparent',
						'operator' => '===',
						'value'    => true,
					)
				),
			),
			array(
				'category'        => 'field',
				'type'            => 'checkbox',
				'settings'        => 'field-header-transparent-404',
				'label'           => esc_html__( 'Disable on 404 ?', 'catmandu' ),
				'section'         => 'section-header-transparent-header',
				'transport'       => 'refresh',
				'default'         => $defaults['field-header-transparent-404'],
				'active_callback' => array(
					array(
						'setting'  => 'field-header-transparent',
						'operator' => '===',
						'value'    => true,
					)
				),
			),
			array(
				'category' => 'field',
				'type'     => 'checkbox',
				'settings' => 'field-header-menu-disable',
				'label'    => esc_html__( 'Disable Menu', 'catmandu' ),
				'section'  => 'section-header-primary',
				'default'  => $defaults['field-header-menu-disable'],
			),
		);

		return array_merge( $configs, $top_header, $site_identity, $transparent_header, $primary_header_field );
	}

	

	/**
	 * For Adding last item menus
	 *
	 * @return array|mixed
	 */
	public function lastMenuItems() {
		$items = array(
			'none'      => __( 'None', 'catmandu' ),
			'button'    => __( 'Button', 'catmandu' ),
			'text/html' => __( 'Text/HTML', 'catmandu' )
		);

		$items = apply_filters( 'catmandu_customer_last_item_menus', $items );

		return $items;
	}
}

new Catmandu_Customizer_Register_Header();


