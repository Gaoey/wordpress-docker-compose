<?php
/**
 * Footer Section Hooks
 *
 * Catmandu
 * @since 1.0.0
 * @author CodeManas 2020. All Rights reserved.
 */

if ( ! function_exists( 'catmandu_get_footer_widgets' ) ) {
	/**
	 * Get Sidebar
	 *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	function catmandu_get_footer_widgets() {
		$layout = Catmandu_Theme_Options::get_option( 'field-footer-widget-layout' );
		switch ( $layout ) {
			case 'wd-four':
				$footer_widgets = array(
					'footer-one'   => 'Footer 1',
					'footer-two'   => 'Footer 2',
					'footer-three' => 'Footer 3',
					'footer-four'  => 'Footer 4',
				);

				foreach ( $footer_widgets as $k => $footer_widget ) {
					if ( is_active_sidebar( $k ) ) {
						?>
						<aside class="footer-active-4 footer-widget-area">
                        <!-- <aside class="col-md-3 widget-<?php echo $k; ?> catmandu-widget-<?php echo $k; ?> widget-section-wrap"> -->
							<?php dynamic_sidebar( $k ); ?>
                        </aside>
						<?php
					}
				}
				break;
			case 'wd-two':
				$footer_widgets = array(
					'footer-one' => 'Footer 1',
					'footer-two' => 'Footer 2',
				);
				foreach ( $footer_widgets as $k => $footer_widget ) {
					if ( is_active_sidebar( $k ) ) {
						?>
                        <aside class="footer-active-2 footer-widget-area">
							<?php dynamic_sidebar( $k ); ?>
                        </aside>
						<?php
					}
				}
				break;
			case 'wd-three':
				$footer_widgets = array(
					'footer-one'   => 'Footer 1',
					'footer-two'   => 'Footer 2',
					'footer-three' => 'Footer 3',
				);
				foreach ( $footer_widgets as $k => $footer_widget ) {
					if ( is_active_sidebar( $k ) ) {
						?>
                       <aside class="footer-active-3 footer-widget-area">
							<?php dynamic_sidebar( $k ); ?>
                        </aside>
						<?php
					}
				}
				break;
			case 'wd-one':
				if ( is_active_sidebar( 'footer-one' ) ) {
					?>
                    <aside class="footer-active-1 footer-widget-area">
						<?php dynamic_sidebar( 'footer-one' ); ?>
                    </aside>
					<?php
				}
				break;
		}
	}
}

if ( ! function_exists( 'catmandu_get_copyright' ) ) {
	/**
	 * Get footer social menu
	 *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	function catmandu_get_copyright() {
		$copyright = Catmandu_Theme_Options::get_option( 'field-footer-bar-copyright' );

		if ( ! empty( $copyright ) ) { ?>
			<div class="copyright">
				<?php echo wp_kses_post( $copyright ); ?> 
			</div>
		
		<?php 
		}
	}
}

if ( ! function_exists( 'catmandu_get_site_info' ) ) {
	/**
	 * Get footer social menu
	 *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	function catmandu_get_site_info() {
		?>
			<div class="site-info">
				<p><?php _e( 'Catmandu by', 'catmandu' ); ?><a rel="" href="http://codemanas.com" target="_blank"><?php _e( ' Code Manas', 'catmandu' ); ?></a> </p>
			</div> <!-- .site-info -->
		<?php 
	}
}