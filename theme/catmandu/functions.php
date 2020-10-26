<?php
/**
 * Main functions for the theme
 *
 * Catmandu
 * @since 1.0.0
 * @author CodeManas 2019. All Rights reserved.
 */

$catmandu_current_theme = wp_get_theme();
define( 'CODEMANAS_THEME_VERSION', esc_html( $catmandu_current_theme->get( 'Version' ) ) );
define( 'CODEMANAS_THEME_DIR', trailingslashit( get_template_directory() ) );
define( 'CODEMANAS_THEME_URL', trailingslashit( esc_url( get_template_directory_uri() ) ) );

// Core
require_once CODEMANAS_THEME_DIR . 'inc/core/class-catmandu-enqueue-scripts.php';
require_once CODEMANAS_THEME_DIR . 'inc/core/class-catmandu-theme-options.php';
require_once CODEMANAS_THEME_DIR . 'inc/core/class-catmandu-theme-setup.php';
require_once CODEMANAS_THEME_DIR . 'inc/core/class-catmandu-admin-settings.php';
require_once CODEMANAS_THEME_DIR . 'inc/core/class-catmandu-admin-meta-fields.php';
require_once CODEMANAS_THEME_DIR . 'inc/core/theme-hooks.php';
require_once CODEMANAS_THEME_DIR . 'inc/core/widgets.php';
require_once CODEMANAS_THEME_DIR . 'inc/helpers.php';
require_once CODEMANAS_THEME_DIR . 'inc/core/class-catmandu-comment-walker.php';

// Customizer Pro 
require_once CODEMANAS_THEME_DIR . 'inc/customizer/trt-customize-pro/class-customize.php';

/**
 * Template related functions
 */
require_once CODEMANAS_THEME_DIR . 'inc/class-catmandu-template-functions.php';
require_once CODEMANAS_THEME_DIR . 'inc/template-tags.php';

/**
 * Customizer
 */
require_once CODEMANAS_THEME_DIR . 'inc/customizer/class-catmandu-customizer.php';

// Render Elements
require_once CODEMANAS_THEME_DIR . 'inc/extras/headers.php';
require_once CODEMANAS_THEME_DIR . 'inc/extras/menus.php';
require_once CODEMANAS_THEME_DIR . 'inc/extras/posts-pages-sidebars.php';
require_once CODEMANAS_THEME_DIR . 'inc/extras/footers.php';
require_once CODEMANAS_THEME_DIR . 'inc/extras/paginations.php';

require_once CODEMANAS_THEME_DIR . 'inc/core/required-plugins.php';