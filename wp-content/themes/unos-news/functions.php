<?php
/**
 *                  _   _             _   
 *  __      ___ __ | | | | ___   ___ | |_ 
 *  \ \ /\ / / '_ \| |_| |/ _ \ / _ \| __|
 *   \ V  V /| |_) |  _  | (_) | (_) | |_ 
 *    \_/\_/ | .__/|_| |_|\___/ \___/ \__|
 *           |_|                          
 *
 * :: Theme's main functions file ::::::::::::
 * :: Initialize and setup the theme :::::::::
 *
 * Hooks, Actions and Filters are used throughout this theme. You should be able to do most of your
 * customizations without touching the main code. For more information on hooks, actions, and filters
 * @see http://codex.wordpress.org/Plugin_API
 *
 * @package    Unos News
 */

/** Set Child Theme Directory **/
$unosnews_dir = trailingslashit( get_stylesheet_directory() );

/** Include Setup Files **/
include_once( $unosnews_dir . 'include/theme-setup.php' );
include_once( $unosnews_dir . 'include/attr.php' );
include_once( $unosnews_dir . 'include/css.php' );
include_once( $unosnews_dir . 'include/customizer-options.php' );
include_once( $unosnews_dir . 'include/fonts.php' );
include_once( $unosnews_dir . 'include/menu.php' );
include_once( $unosnews_dir . 'include/category.php' );
include_once( $unosnews_dir . 'include/metainfo-display.php' );

/**
 * Dark Style Header Setup
 *
 * @since 1.0
 * @access public
 * @return void
 */
function unosnews_dark_header_setup(){

	// hoot_get_mod is available only after 'init' action priority@5
	$currentthemestyle = ( is_customize_preview() ) ? get_theme_mod('themestylepreview') : get_theme_mod( 'themestyle' );

	// hoot_data is set using 'after_setup_theme' hook priority@1
	if ( $currentthemestyle !== 'light' )
		include_once( hoot_data()->child_dir . 'include/header-dark.php' );

}
add_action( 'after_setup_theme', 'unosnews_dark_header_setup', 10 );