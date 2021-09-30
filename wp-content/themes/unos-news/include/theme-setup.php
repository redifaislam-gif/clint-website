<?php


/* === Theme Setup === */


/**
 * Theme Setup
 *
 * @since 1.0
 * @access public
 * @return void
 */
function unosnews_theme_setup(){

	// Load theme's Hootkit functions if plugin is active
	if ( class_exists( 'HootKit' ) && file_exists( hoot_data()->child_dir . 'hootkit/functions.php' ) )
		include_once( hoot_data()->child_dir . 'hootkit/functions.php' );

}
add_action( 'after_setup_theme', 'unosnews_theme_setup', 10 );

/**
 * Set dynamic css handle to child stylesheet
 *
 * @since 1.0
 * @access public
 * @return string
 */
if ( !function_exists( 'unosnews_dynamic_css_child_handle' ) ) :
function unosnews_dynamic_css_child_handle( $handle ) {
	return 'hoot-child-style';
}
endif;
add_filter( 'hoot_style_builder_inline_style_handle', 'unosnews_dynamic_css_child_handle', 8 );

/**
 * Add theme name in body class
 *
 * @since 1.0
 * @access public
 * @return string
 */
if ( !function_exists( 'unosnews_default_body_class' ) ) :
function unosnews_default_body_class( $class ) {
	return 'unos-news';
}
endif;
add_filter( 'unos_default_body_class', 'unosnews_default_body_class', 7 );

/**
 * Update tags in Template's About Page
 *
 * @since 1.0
 * @access public
 * @return bool
 */
function unosnews_abouttags( $tags ) {
	return array(
		'slug' => 'unos-news',
		'name' => __( 'Unos News', 'unos-news' ),
		'vers' => hoot_data( 'childtheme_version' ),
		'shot' => ( file_exists( hoot_data()->child_dir . 'screenshot.jpg' ) ) ? hoot_data()->child_uri . 'screenshot.jpg' : (
					( file_exists( hoot_data()->child_dir . 'screenshot.png' ) ) ? hoot_data()->child_uri . 'screenshot.png' : ''
					),
		);
}
add_filter( 'unos_abouttags', 'unosnews_abouttags', 5 );

/**
 * Alter Customizer Section Pro args
 *
 * @since 1.0
 * @access public
 * @return void
 */
function unosnews_customize_section_pro( $args ) {
	if ( isset( $args['title'] ) )
		$args['title'] = esc_html__( 'Unos News Premium', 'unos-news' );
	if ( isset( $args['pro_url'] ) )
		$args['pro_url'] = esc_url( admin_url('themes.php?page=unos-news-welcome') );
	return $args;
}
add_filter( 'hoot_theme_customize_section_pro', 'unosnews_customize_section_pro' );

/**
 * Modify custom-header
 * Priority@5 to come before 10 used by unos for adding support
 *    @ref wp-includes/theme.php #2440
 *    // Merge in data from previous add_theme_support() calls.
 *    // The first value registered wins. (A child theme is set up first.)
 * For remove_theme_support, use priority@15
 *
 * @since 1.0
 * @access public
 * @return void
 */
function unosnews_custom_header() {
	add_theme_support( 'custom-header', array(
		'width' => 1440,
		'height' => 250,
		'flex-height' => true,
		'flex-width' => true,
		'default-image' => '',
		'header-text' => false
	) );
}
add_filter( 'after_setup_theme', 'unosnews_custom_header', 5 );


/* === Misc === */


/**
 * Disable accent typography for sidebar and footer widget titles
 *
 * @since 1.0
 * @access public
 * @return bool
 */
function unosnews_sidebarwidgettitle_accenttypo( $enable ){
	return false;
}
add_filter( 'unos_sidebarwidgettitle_accenttypo', 'unosnews_sidebarwidgettitle_accenttypo', 5 );