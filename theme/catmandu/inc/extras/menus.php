<?php
/**
 * Menu Render hook add action here
 *
 * Catmandu
 * @since 1.0.0
 * @author CodeManas 2020. All Rights reserved.
 */

// add_filter( 'catmandu_masthead_main_class', 'catmandu_header_menu_layouts', 1 );
/**
 * Header Layout classes
 *
 * @param $data
 *
 * @return mixed
 */
function catmandu_header_menu_layouts() {
	$layout = 'catmandu-left-logo';
	if( $layout === "catmandu-left-logo" ) {
		$data[] = 'catmandu-left-logo';

		//Adding further Menus
		add_filter( 'wp_nav_menu_items', 'catmandu_after_menu_items_adds_last', 10, 2 );
	}

	$sticky_enable = false;
	
	$header_design = 'header-1';

	$data[] = ( $sticky_enable && 'header-1' === $header_design ) ? 'sticky-enabled' : '';

	$result = apply_filters( 'catmandu_header_menu_layouts', $data );
	if ( ! empty( $result ) ) {
		return implode( " ", $result );
	} else {
		return false;
	}
}

/**
 * Add further menus after to main menu
 *
 * @param $items
 * @param $args
 *
 * @return string
 */
function catmandu_after_menu_items_adds_last( $items, $args ) {
	$header_last_item = Catmandu_Theme_Options::get_option( 'field-header-menu-last-item' );

	if ( $args->theme_location === "primary-menu" ) {

		if ( ! empty( $header_last_item ) && $header_last_item === "button" ) {
			$btn_text = Catmandu_Theme_Options::get_option( 'field-header-menu-last-item-button-text' );
			$btn_link = Catmandu_Theme_Options::get_option( 'field-header-menu-last-item-btn-link' );

			if ( ! empty( $btn_link ) && ! empty( $btn_text ) ) {
				$items .= '<li id="menu-item-989899" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-989899"><a class="button custom-button catmandu-theme-btn" title="' . esc_html( $btn_text ) . '" href="' . esc_url( $btn_link ) . '">' . esc_html( $btn_text ) . '</a></li>';
			}
		}

		if ( ! empty( $header_last_item ) && $header_last_item === "text/html" ) {
			$html  = Catmandu_Theme_Options::get_option( 'field-header-menu-last-item-btn-custom-text' );
			$items .= '<li id="menu-item-9898999" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-9898999">' . $html . '</li>';
		}
	}

	return $items;
}

/**
 * Add further menus before to main menu
 *
 * @param $items
 * @param $args
 *
 * @return string
 */
function catmandu_after_menu_items_adds_before( $items, $args ) {
	$header_last_item = Catmandu_Theme_Options::get_option( 'field-header-menu-last-item' );

	if ( $args->theme_location === "primary-menu" ) {

		if ( ! empty( $header_last_item ) && $header_last_item === "button" ) {
			$btn_text = Catmandu_Theme_Options::get_option( 'field-header-menu-last-item-button-text' );
			$btn_link = Catmandu_Theme_Options::get_option( 'field-header-menu-last-item-btn-link' );
			if ( ! empty( $btn_link ) && ! empty( $btn_text ) ) {
				$items .= '<li id="menu-item-989899" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-989899"><a class="button custom-button catmandu-theme-btn" title="' . esc_html( $btn_text ) . '" href="' . esc_url( $btn_link ) . '">' . esc_html( $btn_text ) . '</a></li>';
			}
		}

		if ( ! empty( $header_last_item ) && $header_last_item === "text/html" ) {
			$html  = Catmandu_Theme_Options::get_option( 'field-header-menu-last-item-btn-custom-text' );
			$items .= '<li id="menu-item-9898999" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-9898999">' . $html . '</li>';
		}

		$items = $items;
	}

	return $items;
}