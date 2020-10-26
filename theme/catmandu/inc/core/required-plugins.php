<?php
/**
 * Activation Plugn notices for the theme.
 *
 * @since 1.0.0
 * @author CodeManas
 * @copyright 2019 CodeManas. All Rights Reserved !
 */

require_once CODEMANAS_THEME_DIR . 'inc/core/class-catmandu-tgm-plugina-activation.php';

add_action( 'tgmpa_register', 'catmandu_register_required_plugins' );

//If PRO VERSION exists remove notice
function catmandu_check_if_pro_plugin_exists() {
	$plugins = array(
		// This is an example of how to include a plugin from the WordPress Plugin Repository.
		array(
			'name'     => __( 'One Click Demo Importer', 'catmandu' ),
			'slug'     => 'one-click-demo-import',
			'required' => false,
		),
		array(
			'name'     => __( 'Breadcrumb NavXT', 'catmandu' ),
			'slug'     => 'breadcrumb-navxt',
			'required' => false,
		),
		array(
			'name'     => __( 'Contact Form 7', 'catmandu' ),
			'slug'     => 'contact-form-7',
			'required' => false,
		),
		array(
			'name'     => __( 'Mailpoet', 'catmandu' ),
			'slug'     => 'mailpoet',
			'required' => false,
		),
		array(
			'name'     => __( 'WooCommerce', 'catmandu' ),
			'slug'     => 'woocommerce',
			'required' => false,
		),
	);

	if( class_exists( 'OCDI\PluginsInstaller' ) ) {
		foreach ( $plugins as $key => $plugin ) {
			//Check if PRO version exists
			$pro_version = OCDI\PluginsInstaller::pro_plugin_exist_by_slug( $plugin['slug'] );
			if ( $pro_version ) {
				unset( $plugins[ $key ] );
			}
		}
	}

	return $plugins;
}

/**
 * Register the required plugins for this theme.
 */
function catmandu_register_required_plugins() {

	$plugins = catmandu_check_if_pro_plugin_exists();

	$config = array(
		'id'           => 'catmandu',
		'menu'         => 'tgmpa-install-plugins',
		'parent_slug'  => 'catmandu-theme',
		'capability'   => 'edit_theme_options',
		'has_notices'  => true,
		'dismissable'  => true,
		'dismiss_msg'  => '',
		'is_automatic' => false,
	);

	tgmpa( $plugins, $config );
}