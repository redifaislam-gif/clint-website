<?php
/**
 * This file contains functions and hooks for styling Hootkit plugin
 *   Hootkit is a free plugin released under GPL license and hosted on wordpress.org.
 *   It is recommended to the user via wp-admin using TGMPA class
 *
 * This file is loaded at 'after_setup_theme' action @priority 10 ONLY IF hootkit plugin is active
 *
 * @package    Unos News
 * @subpackage HootKit
 */

// Register HootKit
// Parent added @priority 5
add_filter( 'hootkit_register', 'unosnews_register_hootkit', 7 );

// Add dynamic CSS for hootkit
add_action( 'hoot_dynamic_cssrules', 'unosnews_hootkit_dynamic_cssrules', 8 );

/**
 * Register Hootkit
 * Parent added @priority 5
 *
 * @since 1.0
 * @param array $config
 * @return string
 */
if ( !function_exists( 'unosnews_register_hootkit' ) ) :
function unosnews_register_hootkit( $config ) {
	// Array of configuration settings.
	if ( isset( $config['supports'] ) && is_array( $config['supports'] ) )
		$config['supports'][] = 'widget-subtitle';
	return $config;
}
endif;

add_action( 'wp_enqueue_scripts', 'unosnews_enqueue_hootkit', 15 );
if ( !function_exists( 'unosnews_enqueue_hootkit' ) ) :
function unosnews_enqueue_hootkit() {

	// Backward compatibility @deprecated <Unos2.9.16
	if ( !function_exists( 'unos_enqueue_childhootkit' ) ) {
	/* 'unos-hootkit' is loaded using 'hoot_locate_style' which loads child theme location. Hence deregister it and load files again */
	wp_deregister_style( 'unos-hootkit' );
	/* Load Hootkit Style - Add dependency so that hotkit is loaded after */
	if ( file_exists( hoot_data()->template_dir . 'hootkit/hootkit.css' ) )
	wp_enqueue_style( 'unos-hootkit', hoot_data()->template_uri . 'hootkit/hootkit.css', array( 'hoot-style' ), hoot_data()->template_version );
	if ( file_exists( hoot_data()->child_dir . 'hootkit/hootkit.css' ) )
	wp_enqueue_style( 'unosnews-hootkit', hoot_data()->child_uri . 'hootkit/hootkit.css', array( 'hoot-style', 'unos-hootkit' ), hoot_data()->childtheme_version );
	}

}
endif;

add_filter( 'hoot_style_builder_inline_style_handle', 'unosnews_dynamic_css_hootkit_handle', 8 );
if ( !function_exists( 'unosnews_dynamic_css_hootkit_handle' ) ) :
function unosnews_dynamic_css_hootkit_handle( $handle ) {
	// Backward compatibility @deprecated <Unos2.9.16
	if ( !function_exists( 'unos_dynamic_css_childhootkit_handle' ) )
	return 'unosnews-hootkit';
	else return $handle;
}
endif;

/**
 * Custom CSS built from user theme options for hootkit features
 *
 * @since 1.0
 * @access public
 */
if ( !function_exists( 'unosnews_hootkit_dynamic_cssrules' ) ) :
function unosnews_hootkit_dynamic_cssrules() {

	global $hoot_style_builder;

	// Get user based style values
	$styles = unos_user_style();
	extract( $styles );

	$hoot_style_builder->remove( array(
		'.social-icons-icon',
		'#topbar .social-icons-icon, #page-wrapper .social-icons-icon',
	) );

	/*** Add Dynamic CSS ***/

	hoot_add_css_rule( array(
						'selector'  => '.content-block-subtitle',
						'property'  => 'color',
						'value'     => $accent_color,
						'idtag'     => 'accent_color'
					) );

}
endif;

/**
 * Modify category placement for widgets
 *
 * @since 1.0
 * @param array $settings
 * @return string
 */
add_filter( 'hootkit_post_grid_display_catblock', '__return_true' );

/**
 * Modify Post Grid default style
 *
 * @since 1.0
 * @param array $settings
 * @return string
 */
function unosnews_post_grid_widget_settings( $settings ) {
	if ( isset( $settings['form_options']['unitheight']['desc'] ) )
		$settings['form_options']['unitheight']['desc'] = __( 'Default: 200 (in pixels)', 'unos-news' );
	return $settings;
}
add_filter( 'hootkit_post_grid_widget_settings', 'unosnews_post_grid_widget_settings', 5 );
add_filter( 'hootkit_content_grid_widget_settings', 'unosnews_post_grid_widget_settings', 5 );

/**
 * Modify Ticker default style
 *
 * @since 1.0
 * @param array $settings
 * @return string
 */
function unosnews_ticker_widget_settings( $settings ) {
	if ( isset( $settings['form_options']['thumbheight']['desc'] ) )
		$settings['form_options']['thumbheight']['desc'] = __( 'Default: 40 (recommended for single line style below).<br />Set this to 75 for multiline style below', 'unos-news' );
	return $settings;
}
function unosnews_ticker_products_widget_settings( $settings ) {
	if ( isset( $settings['form_options']['thumbheight']['desc'] ) )
		$settings['form_options']['thumbheight']['desc'] = __( 'Default: 75 (recommended for multi line style below).<br />Set this to 40 for single line style below', 'unos-news' );
	return $settings;
}
add_filter( 'hootkit_ticker_posts_widget_settings', 'unosnews_ticker_widget_settings', 5 );
add_filter( 'hootkit_products_ticker_widget_settings', 'unosnews_ticker_products_widget_settings', 5 );

/**
 * Modify Products Cart Icon default style
 *
 * @since 1.0
 * @param array $settings
 * @return string
 */
function unosmvu_products_carticon_widget_settings( $settings ) {
	if ( isset( $settings['form_options']['background'] ) )
		$settings['form_options']['background']['std'] = '#ff4530';
	if ( isset( $settings['form_options']['fontcolor'] ) )
		$settings['form_options']['fontcolor']['std'] = '#ffffff';
	return $settings;
}
add_filter( 'hootkit_products_carticon_widget_settings', 'unosmvu_products_carticon_widget_settings', 5 );

/**
 * Filter Ticker and Ticker Posts display Title markup
 *
 * @since 1.0
 * @param array $settings
 * @return string
 */
function unosnews_hootkit_widget_title( $display, $title, $context, $icon = '' ) {
	$display = '<div class="ticker-title accent-typo">' . $icon . $title . '</div>';
	return $display;
}
add_filter( 'hootkit_widget_ticker_title', 'unosnews_hootkit_widget_title', 5, 4 );