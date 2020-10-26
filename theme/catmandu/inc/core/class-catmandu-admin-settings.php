<?php
/**
 * Admin settings for Catmandu theme
 *
 * @author      CodeManas
 * @copyright   Copyright (c) 2019, CodeManas
 * @since       1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Catmandu_Admin_Settings {

	public static $menu_title;
	public static $page_title;
	public static $slug = 'catmandu-theme';

	/**
	 * Constructor
	 */
	function __construct() {

		self::$menu_title = __( 'Catmandu Theme' , 'catmandu' );
		self::$page_title = __( 'Catmandu' , 'catmandu' );

		if ( ! is_admin() ) {
			return;
		}

		add_action( 'after_setup_theme', array( $this, 'init_settings' ), 99 );
	}

	/**
	 * Init
	 */
	public function init_settings() {
		if ( isset( $_REQUEST['page'] ) && ( self::$slug === 'catmandu-theme' ) ) {
			add_action( 'admin_enqueue_scripts', [ $this, 'styles_scripts' ] );
		}

		add_action( 'admin_menu', [ $this, 'show_admin_menu' ], 1 );
	}

	/**
	 * Show Admin Menu in admin
	 */
	public function show_admin_menu() {
		$page_title = self::$page_title;
		$capability = 'manage_options';
		$slug       = self::$slug;

		add_theme_page( $page_title, $page_title, $capability, $slug, array( $this, 'render_menu' ), 2 );
	}

	/**
	 * Render Admin settings HTML
	 */
	public function render_menu() {
		?>
        <div class="catmandu-menu-page-wrapper">
            <div class="catmandu-page-header">
                <div class="container catmandu-center">
                    <div class="catmandu-theme-logo">
                        <img src="<?php echo CODEMANAS_THEME_URL . 'assets/images/logo.png'; ?>" width="140"> <span class="catmandu-theme-version">v<?php echo CODEMANAS_THEME_VERSION; ?></span>
                    </div>
                </div>
            </div>
            <div class="catmandu-page-content">
                <div class="container">
                    <div class="catmandu-theme-border-palete-w-padding catmandu-theme-text-center">
                        <h3><?php esc_html_e( 'Welcome to Catmandu Theme', 'catmandu' ); ?></h3>
                        <p><?php esc_html_e( 'Catmandu is clean, responsive, modern and feature rich multi-purpose Business WordPress theme. It is suitable for business, portfolio, digital agencies and general corporate website. It is designed with great attention to details, flexibility and performance thus looks stunning on all types of screens and devices. Catmandu comes with creative and well-organized sections and very extensible and secure code. It is designed and developed paying careful attention to detail, to bring you a clean, modern and crisp design with the kinds of useful web elements that help make your website stand out from the crowd.', 'catmandu' ); ?></p>
                    </div>
                    <div class="catmandu-theme-options-container">
                        <div class="catmandu-theme-wrap-left">
                            <div class="catmandu-theme-border-palete-without-padding catmandu-theme-heading-box-style">
                                <h3><i class="dashicons dashicons-admin-site-alt2"></i> <?php esc_html_e( 'Customizer Settings', 'catmandu' ); ?></h3>
                                <div class="catmandu-row">
                                    <div class="catmandu-column"><i class="dashicons dashicons-editor-kitchensink"></i>&nbsp;&nbsp;<a href="<?php echo esc_url( admin_url( '/customize.php?autofocus[control]=field-global-container-width' ) ); ?>"><?php esc_html_e( 'Global Layouts', 'catmandu' ); ?></a></div>
                                    <div class="catmandu-column"><i class="dashicons dashicons-editor-textcolor"></i>&nbsp;&nbsp;<a href="<?php echo esc_url( admin_url( '/customize.php?autofocus[control]=header-menu-disable' ) ); ?>"><?php esc_html_e( 'Menu & Header Layouts', 'catmandu' ); ?></a></div>
                                </div>
                                <div class="catmandu-row">
                                    <div class="catmandu-column"><i class="dashicons dashicons-format-image"></i>&nbsp;&nbsp;<a href="<?php echo esc_url( admin_url( '/customize.php?autofocus[control]=custom_logo' ) ); ?>"><?php esc_html_e( 'Upload Logo', 'catmandu' ); ?></a></div>
                                    <div class="catmandu-column"><i class="dashicons dashicons-marker"></i>&nbsp;&nbsp;<a href="<?php echo esc_url( admin_url( '/customize.php?autofocus[control]=field-header-transparent' ) ); ?>"><?php esc_html_e( 'Header Transparency', 'catmandu' ); ?></a></div>
                                </div>
                                <div class="catmandu-row">
                                    <div class="catmandu-column"><i class="dashicons dashicons-layout"></i>&nbsp;&nbsp;<a href="<?php echo esc_url( admin_url( '/customize.php?autofocus[control]=field-blog-page-layout' ) ); ?>"><?php esc_html_e( 'Blog Page Styles', 'catmandu' ); ?></a></div>
                                    <div class="catmandu-column"><i class="dashicons dashicons-slides"></i>&nbsp;&nbsp;<a href="<?php echo esc_url( admin_url( '/customize.php?autofocus[control]=field-blog-post-pagination' ) ); ?>"><?php esc_html_e( 'Pagination Styles', 'catmandu' ); ?></a></div>
                                </div>
                                <div class="catmandu-row">
                                    <div class="catmandu-column"><i class="dashicons dashicons-networking"></i>&nbsp;&nbsp;<a href="<?php echo esc_url( admin_url( '/customize.php?autofocus[control]=field-breadcrumb-type' ) ); ?>"><?php esc_html_e( 'Breadcrumb Settings', 'catmandu' ); ?></a></div>
                                    <div class="catmandu-column"><i class="dashicons dashicons-excerpt-view"></i>&nbsp;&nbsp;<a href="<?php echo esc_url( admin_url( '/customize.php?autofocus[control]=field-sidebar-type' ) ); ?>"><?php esc_html_e( 'Sidebar Settings', 'catmandu' ); ?></a></div>
                                </div>
                                <div class="catmandu-row">
                                    <div class="catmandu-column"><i class="dashicons dashicons-admin-generic"></i>&nbsp;&nbsp;<a href="<?php echo esc_url( admin_url( '/customize.php?autofocus[control]=field-footer-widget-layout' ) ); ?>"><?php esc_html_e( 'Footer Widgets', 'catmandu' ); ?></a></div>
                                    <div class="catmandu-column"><i class="dashicons dashicons-admin-appearance"></i>&nbsp;&nbsp;<a href="<?php echo esc_url( admin_url( '/customize.php?autofocus[control]=field-footer-bar-enable' ) ); ?>"><?php esc_html_e( 'Last Footer Bar', 'catmandu' ); ?></a></div>
                                </div>
                            </div>
							<div class="catmandu-theme-border-palete-without-padding catmandu-theme-heading-box-style">
								<h3><i class="dashicons dashicons-admin-network"></i> <?php esc_html_e( 'Get Started by Importing Demo Contents', 'catmandu' ); ?></h3>
								<div class="catmandu-theme-knowledge-base">
									<?php if ( class_exists( 'OCDI_Plugin' ) ) { ?>
										<p><?php esc_html_e( 'Import existing contents and design to get started with just one click.', 'catmandu' ); ?></p>
										<p><a href="<?php echo admin_url( 'themes.php?page=pt-one-click-demo-import' ); ?>"><?php esc_html_e( 'Take me to demo import page', 'catmandu' ); ?> &#187;</a></p>
									<?php } else { ?>
										<p><?php esc_html_e( 'Install Once Click Demo Installer before importing.', 'catmandu' ); ?></p>
										<p><a href="<?php echo admin_url( 'themes.php?page=tgmpa-install-plugins' ); ?>"><?php esc_html_e( 'Install plugin', 'catmandu' ); ?> &#187;</a></p>
									<?php } ?>
								</div>
							</div>
                            <div class="catmandu-theme-border-palete-without-padding catmandu-theme-heading-box-style">
                                <h3><i class="dashicons dashicons-admin-plugins"></i> <?php esc_html_e( 'Extra Plugins', 'catmandu' ); ?></h3>
                                <div class="catmandu-theme-extra-plugins">
                                    <ul>
                                        <li>
                                            <span class="catmandu-theme-extra-plugins-left"><?php esc_html_e( 'Install recommended plugins', 'catmandu' ); ?></span>
                                            <span class="catmandu-theme-extra-plugins-right"><a href="<?php echo admin_url( 'themes.php?page=tgmpa-install-plugins' ); ?>" class="button button-primary"><?php esc_html_e( 'Install and Activate', 'catmandu' ); ?></a></span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="catmandu-theme-wrap-right">
                            <div class="catmandu-theme-border-palete-without-padding catmandu-theme-heading-box-style ">
                                <h3><i class="dashicons dashicons-welcome-learn-more"></i> <?php esc_html_e( 'Knowledge Base', 'catmandu' ); ?></h3>
                                <div class="catmandu-theme-knowledge-base">
                                    <p><?php esc_html_e( 'Having issues with theme or installation ? Take some time to explore our knowledge base to explore and learn about possiblities.', 'catmandu' ); ?></p>
                                    <p><a href="https://docs.codemanas.com/catmandu/"><?php esc_html_e( 'Visit Knowledge Base', 'catmandu' ); ?> &#187;</a></p>
                                </div>
                            </div>
                            <div class="catmandu-theme-border-palete-without-padding catmandu-theme-heading-box-style ">
                                <h3><i class="dashicons dashicons-info"></i> <?php esc_html_e( 'Support', 'catmandu' ); ?></h3>
                                <div class="catmandu-theme-knowledge-base">
                                    <p><?php esc_html_e( 'Did not find what you are looking for on knowledge base ? Ask us directly.', 'catmandu' ); ?></p>
                                    <p><a href="https://www.codemanas.com/forums/forum/premium-themes/catmandu/"><?php esc_html_e( 'Visit Support Forum', 'catmandu' ); ?> &#187;</a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
		<?php
	}

	/**
	 * Enqueue Scripts into Admin Page
	 */
	public function styles_scripts() {
		wp_enqueue_style( 'catmandu-admin-styles', CODEMANAS_THEME_URL . 'assets/admin/css/catmandu-admin-styles.css', false, CODEMANAS_THEME_VERSION );

		do_action( 'catmandu_admin_settings_enqueue_style' );
	}

}

new Catmandu_Admin_Settings();