<?php
/**
 * Admin meta fields
 *
 * @author      CodeManas
 * @copyright   Copyright (c) 2019, CodeManas
 * @since       1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Catmandu_Admin_Meta_fields {

	/**
     * Hook into the appropriate actions when the class is constructed.
     */
    public function __construct() {
        add_action( 'add_meta_boxes', array( $this, 'add_meta_box' ) );
		add_action( 'save_post', array( $this, 'save' ) );
		
        add_action( 'admin_enqueue_scripts', array( $this, 'admin_scripts' ) );
    }

    /**
	 * Fallback for default editor, Enqueue Admin Scripts
	 *
	 * @return void
	 */
    public function admin_scripts( $hook ) {
        if ( $hook == 'post-new.php' || $hook == 'post.php' ) {
            wp_enqueue_style( 'wp-color-picker' );
            wp_enqueue_script( 'wp-color-picker-alpha', CODEMANAS_THEME_URL . 'assets/admin/js/wp-color-picker-alpha.min.js', array( 'wp-color-picker' ), '1.0.0', true );

            wp_enqueue_script( 'jquery-ui-tabs' );
            wp_enqueue_style( 'wp-jquery-ui', CODEMANAS_THEME_URL . 'assets/admin/css/jquery-ui.min.css', false, '1.0.0' );

            //Custom Scripts
            wp_enqueue_script( 'catmandu-meta-box', CODEMANAS_THEME_URL . 'assets/admin/js/catmandu-metabox.js', false, '1.0.0', true );
            wp_enqueue_style( 'catmandu-meta-box', CODEMANAS_THEME_URL . 'assets/admin/css/catmandu-metabox.css', false, '1.0.0' );
        }
    }

    /**
     * Adds the meta box container.
     */
    public function add_meta_box( $post_type ) {
        $args = array(
            'public' => true,
            '_builtin' => false
        );
        $post_types = get_post_types( $args, 'names' );
        $builtin_post_types = array( 'post' => 'post', 'page' => 'page');
        if( !empty( $post_types ) ) {
            $post_types = array_merge( $post_types, $builtin_post_types );
        } else {
            $post_types = $builtin_post_types;
        }

        $post_types = apply_filters( 'catmandu_inpage_supports', $post_types );
        // Limit meta box to certain post types.
        if ( in_array( $post_type, $post_types ) ) {
            add_meta_box(
                'catmandu-page-options',
                __( 'Catmandu Page Options', 'catmandu' ),
                array( $this, 'render' ),
                $post_type,
                'advanced',
				'high',
				array(
					'__back_compat_meta_box' => false,
				)
            );
        }
    }
 
    /**
     * Save the meta when the post is saved.
     *
     * @param int $post_id The ID of the post being saved.
     */
    public function save( $post_id ) {
        // Check if our nonce is set.
        if ( ! isset( $_POST['catmandu_page_settings_nonce'] ) ) {
            return $post_id;
        }
 
        $nonce = $_POST['catmandu_page_settings_nonce'];
 
        // Verify that the nonce is valid.
        if ( ! wp_verify_nonce( $nonce, 'catmandu_page_settings' ) ) {
            return $post_id;
        }
 
        /*
         * If this is an autosave, our form has not been submitted,
         * so we don't want to do anything.
         */
        if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
            return $post_id;
        }
 
        // Check the user's permissions.
        if ( 'page' == $_POST['post_type'] ) {
            if ( ! current_user_can( 'edit_page', $post_id ) ) {
                return $post_id;
            }
        } else {
            if ( ! current_user_can( 'edit_post', $post_id ) ) {
                return $post_id;
            }
        }
 
        /* OK, it's safe for us to save the data now. */
 
        // Sanitize the user input.
        $theme_color = sanitize_text_field( filter_input( INPUT_POST, 'theme_global_colors' ) );
        $sidebar_position = sanitize_text_field( filter_input( INPUT_POST, 'page_sidebar' ) );

        $top_header = sanitize_text_field( filter_input( INPUT_POST, 'enable_top_header' ) );
        $transparent_header = sanitize_text_field( filter_input( INPUT_POST, 'enable_transparent_header' ) );
        $footer_widget = sanitize_text_field( filter_input( INPUT_POST, 'enable_footer_widget_section' ) );
        $footer_copyright = sanitize_text_field( filter_input( INPUT_POST, 'enable_footer_copyright_area' ) );
        
        // Update the meta field.
        Catmandu_Theme_Options::update_catmandu_page_meta( 'theme-global-color', $theme_color, $post_id );
        Catmandu_Theme_Options::update_catmandu_page_meta( 'page-sidebar', $sidebar_position, $post_id );
        Catmandu_Theme_Options::update_catmandu_page_meta( 'top-header-layout', $top_header, $post_id );
        Catmandu_Theme_Options::update_catmandu_page_meta( 'transparent-header', $transparent_header, $post_id );
        Catmandu_Theme_Options::update_catmandu_page_meta( 'footer-widget-display', $footer_widget, $post_id );
        Catmandu_Theme_Options::update_catmandu_page_meta( 'footer-copyright-display', $footer_copyright, $post_id );
    }
 
 
    /**
     * Render Meta Box content.
     *
     * @param WP_Post $post The post object.
     */
    public function render( $post ) {
 
        // Add an nonce field so we can check for it later.
        wp_nonce_field( 'catmandu_page_settings', 'catmandu_page_settings_nonce' );

        $value = get_post_meta( $post->ID, 'catmandu_page_setting', true );
 
        ?>
        <div id="catmandu-metabox-tabs">
            <ul>
                <li><a href="#headers"><?php _e('Header', 'catmandu'); ?></a></li>
                <li><a href="#footers"><?php _e('Footer', 'catmandu'); ?></a></li>
                <li><a href="#sidebar"><?php _e('Sidebar', 'catmandu'); ?></a></li>
            </ul>
            <div id="headers">
                <?php require_once CODEMANAS_THEME_DIR . 'inc/core/meta-views/headers.php'; ?>
            </div>
            <div id="footers">
                <?php require_once CODEMANAS_THEME_DIR . 'inc/core/meta-views/footers.php'; ?>
            </div>
            <div id="sidebar">
                <?php require_once CODEMANAS_THEME_DIR . 'inc/core/meta-views/sidebar.php'; ?>
            </div>
        </div>
        <?php
    }
}

new Catmandu_Admin_Meta_fields();