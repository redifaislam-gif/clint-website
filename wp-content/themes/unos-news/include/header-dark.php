<?php
/**
 * This file contains functions and hooks for styling the theme in dark mode
 * This file is loaded at 'after_setup_theme' action @priority 10 ONLY IF user selected dark option in customizer
 *
 * @package    Unos News
 */

function unosnews_enqueue_darkstyle(){
	if ( file_exists( hoot_data()->child_dir . 'style-dark.css' ) )
	wp_enqueue_style( 'unosnews-dark', hoot_data()->child_uri . 'style-dark.css', array( 'hoot-style', 'unos-hootkit' ), hoot_data()->childtheme_version );
}
add_action( 'wp_enqueue_scripts', 'unosnews_enqueue_darkstyle', 22 ); // Load after @20 in parent which enqueues 'unos-child-hootkit'

function unosnews_dynamic_css_dark_handle( $handle ) {
	return 'unosnews-dark';
}
add_filter( 'hoot_style_builder_inline_style_handle', 'unosnews_dynamic_css_dark_handle', 12 ); // Load after @10 in parent setting it to 'unos-child-hootkit'

function unosnews_dark_default_style( $defaults ){
	$defaults = array_merge( $defaults, array(
		'site_background'      => '#000000', // Used by WP custom-background
		'menu_icons_color'           => '#ffffff',
		'topbar_background'          => '#141414',
		'header_background'          => '#141414',
		'logo_background'            => '#141414',
		'menu_background'            => '#141414',
		'menu_dropdown_background'   => '#141414',
		'subfooter_background'       => '#222222',
		'footer_background'          => '#222222',
		'topbar_color'               => '#ffffff',
		'font_logo_color'            => '#ffffff',
		'font_tagline_color'         => '#ffffff',
		'font_nav_menu_color'        => '#ffffff',
		'font_nav_dropdown_color'    => '#ffffff',
		'font_footer_heading_color'  => '#ffffff',
		'font_footer_color'          => '#ffffff',
	) );
	return $defaults;
}
add_filter( 'unos_default_style', 'unosnews_dark_default_style', 10 );

function unosnews_dark_dynamic_cssrules(){
	hoot_add_css_rule( array(
						'selector'  => '#topbar',
						'property'  => array(
							'background' => array( 'rgba(255,255,255,0.08)' ),
							'color'      => array( '#ffffff' ),
							),
					) );
	hoot_add_css_rule( array(
						'selector'  => '#topbar.js-search .searchform.expand .searchtext',
						'property'  => 'background',
						'value'     => '#333333',
					) );

	hoot_add_css_rule( array(
						'selector'  => '.menu-items ul',
						'property'  => 'background',
						'value'     => '#141414',
					) );
	hoot_add_css_rule( array(
						'selector'  => '.mobilemenu-fixed .menu-toggle, .mobilemenu-fixed .menu-items',
						'property'  => 'background',
						'value'     => '#141414',
						'media'     => 'only screen and (max-width: 969px)',
				) );
}
add_action( 'hoot_dynamic_cssrules', 'unosnews_dark_dynamic_cssrules', 3 );