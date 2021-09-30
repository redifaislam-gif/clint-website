<?php


/* === Menu === */


/**
 * Add default values for Nav Menu
 *
 * @since 1.0
 */
function unosnews_nav_menu_defaults( $defaults ){
	return array(
		'tagbg' => '#ff4530',
		'tagfont' => '#ffffff',
		'tagbg_label' => __( 'Tag &amp; Hover Background (leave empty for automatic color)', 'unos-news' ),
		'tagfont_label' => __( 'Tag &amp; Hover Font (leave empty for automatic color)', 'unos-news' ),
	);
}
add_filter( 'unos_nav_menu_defaults', 'unosnews_nav_menu_defaults' );

/**
 * Disable menu tag hover change
 *
 * @since 1.0
 * @access public
 * @return bool
 */
function unosnews_menutag_inverthover( $enable ){
	return false;
}
add_filter( 'unos_menutag_inverthover', 'unosnews_menutag_inverthover', 5 );

/**
 * Get the top level menu items array
 *
 * @since 1.0
 * @access public
 * @return void
 */
function unosnews_nav_menu_toplevel_items( $theme_location = 'hoot-primary-menu' ) {
	static $location_items;
	if ( !isset( $location_items[$theme_location] ) && ($theme_locations = get_nav_menu_locations()) && isset( $theme_locations[$theme_location] ) ) {
		$menu_obj = get_term( $theme_locations[$theme_location], 'nav_menu' );
		if ( !empty( $menu_obj->term_id ) ) {
			$menu_items = wp_get_nav_menu_items($menu_obj->term_id);
			if ( $menu_items )
				foreach( $menu_items as $menu_item )
					if ( empty( $menu_item->menu_item_parent ) )
						$location_items[$theme_location][] = $menu_item;
		}
	}
	if ( !empty( $location_items[$theme_location] ) )
		return $location_items[$theme_location];
	else
		return array();
}

/**
 * Add Home Button
 *
 * @since 1.0
 * @access public
 * @return string
 */
function unosnews_wp_nav_menu_items( $items, $args ){
	if ( !empty( $args->theme_location ) && $args->theme_location == 'hoot-primary-menu' ) {
		$show_menuhome = hoot_get_mod( 'show_menuhome' );
		$preview = is_customize_preview();
		if ( $show_menuhome || $preview ) {
			$noshow = ( $preview && !$show_menuhome ) ? ' noshow' : '';
			$homeicon = '';
			$homeicon .= '<li id="menu-home-icon" class="menu-item menu-item-home menu-home-icon' . $noshow . '">';
				$homeicon .= '<a href="' . esc_url( home_url() ) . '" rel="home" itemprop="url">';
					$homeicon .= '<i class="fa-home fas"></i>';
				$homeicon .= '</a>';
			$homeicon .= '</li>';
			$items = $homeicon . $items;
		}
	}
	return $items;
}
add_filter( 'wp_nav_menu_items', 'unosnews_wp_nav_menu_items', 10, 2 );