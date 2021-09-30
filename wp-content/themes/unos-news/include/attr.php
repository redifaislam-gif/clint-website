<?php


/* === Attr === */


/**
 * Topbar meta attributes.
 * Priority@10: 7-> base lite ; 9-> base prim
 *
 * @since 1.0
 * @param array $attr
 * @param string $context
 * @return array
 */
function unosnews_attr_topbar( $attr, $context ) {
	if ( !empty( $attr['classes'] ) )
		$attr['classes'] = str_replace( 'social-icons-invert', '', $attr['classes'] );
	return $attr;
}
add_filter( 'hoot_attr_topbar', 'unosnews_attr_topbar', 10, 2 );

/**
 * Loop meta attributes.
 * Priority@10: 7-> base lite ; 9-> base prim
 *
 * @since 1.0
 * @param array $attr
 * @param string $context
 * @return array
 */
function unosnews_attr_premium_loop_meta_wrap( $attr, $context ) {
	$attr['class'] = ( empty( $attr['class'] ) ) ? '' : $attr['class'];

	/* Overwrite all and apply background class for both */
	$attr['class'] = str_replace( array( 'loop-meta-wrap pageheader-bg-default', 'loop-meta-wrap pageheader-bg-stretch', 'loop-meta-wrap pageheader-bg-incontent', 'loop-meta-wrap pageheader-bg-both', 'loop-meta-wrap pageheader-bg-none', ), '', $attr['class'] );
	$attr['class'] .= ' loop-meta-wrap pageheader-bg-both';

	return $attr;
}
add_filter( 'hoot_attr_loop-meta-wrap', 'unosnews_attr_premium_loop_meta_wrap', 10, 2 );

/**
 * Show image in header
 *
 * @since 1.0
 * @access public
 * @param array $attr
 * @param string $context
 * @return array
 */
function unosnews_attr_header_part( $attr, $context ) {
	$header_image = get_header_image();
	$headerimg_style = hoot_get_mod( 'headerimg_style' );
	if ( $context == 'primary' && $header_image ) {
		$attr['style'] = ( empty( $attr['style'] ) ) ? '' : $attr['style'];
		$attr['class'] = ( empty( $attr['class'] ) ) ? '' : $attr['class'];
		$attr['style'] .= ' background-image:url(' . esc_url( $header_image ) . '); ';
		$attr['class'] .= ' withbg ';
		$attr['class'] .= ( $headerimg_style == 'full' ) ? ' bgcontained ' : '';
		add_filter( 'theme_mod_header_image', 'unosnews_remove_header_image' );
	}
	return $attr;
}
add_filter( 'hoot_attr_header-part', 'unosnews_attr_header_part', 10, 2 );
function unosnews_remove_header_image(){ return 'remove-header'; }