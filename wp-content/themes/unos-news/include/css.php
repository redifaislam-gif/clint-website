<?php


/* === Dynamic CSS === */


/* Update user based style values for premium dynamic css */
/**
 * Create user based style values for premium dynamic css
 * Priority@6: apply_filters -> base lite ; 5-> base prim
 *
 * @since 1.0
 * @access public
 * @return array
 */
function unosnews_user_style( $styles ){

	/* Override Base styles */

	/* Add child styles */
	$styles['background_color']           = hoot_get_mod( 'background_color', '#000000' ); // WordPress Custom Background
	$styles['body_fontface']              = hoot_get_mod( 'body_fontface' );
	$styles['subheadings_fontface']       = hoot_get_mod( 'subheadings_fontface' );
	$styles['subheadings_fontface_style'] = hoot_get_mod( 'subheadings_fontface_style' );

	return $styles;
}
add_filter( 'unos_user_style', 'unosnews_user_style', 6 );

/**
 * Custom CSS built from user theme options
 * For proper sanitization, always use functions from library/sanitization.php
 *
 * @since 1.0
 * @access public
 */
function unosnews_dynamic_cssrules() {

	global $hoot_style_builder;

	// Get user based style values
	$styles = unos_user_style();
	extract( $styles );

	$bodyfontface = '';
	if ( 'fontla' == $body_fontface )
		$bodyfontface = '"Lato", sans-serif';
	elseif ( 'fontos' == $body_fontface )
		$bodyfontface = '"Open Sans", sans-serif';
	elseif ( 'fontcf' == $body_fontface )
		$bodyfontface = '"Comfortaa", sans-serif';
	elseif ( 'fontow' == $body_fontface )
		$bodyfontface = '"Oswald", sans-serif';
	elseif ( 'fontim' == $body_fontface )
		$bodyfontface = 'Impact, Arial, sans-serif';
	elseif ( 'fontno' == $body_fontface )
		$bodyfontface = '"Noto Serif", serif';
	elseif ( 'fontsl' == $body_fontface )
		$bodyfontface = '"Slabo 27px", serif';
	elseif ( 'fontgr' == $body_fontface )
		$bodyfontface = 'Georgia, serif';
	hoot_add_css_rule( array(
						'selector'  => 'body' . ',' . '.enforce-body-font' . ',' . '.site-title-body-font',
						'property'  => 'font-family',
						'value'     => $bodyfontface,
					) );

	$headingproperty = array();
	if ( 'fontla' == $headings_fontface )
		$headingproperty['font-family'] = array( '"Lato", sans-serif' );
	elseif ( 'fontos' == $headings_fontface )
		$headingproperty['font-family'] = array( '"Open Sans", sans-serif' );
	elseif ( 'fontcf' == $headings_fontface )
		$headingproperty['font-family'] = array( '"Comfortaa", sans-serif' );
	elseif ( 'fontow' == $headings_fontface )
		$headingproperty['font-family'] = array( '"Oswald", sans-serif' );
	elseif ( 'fontim' == $headings_fontface )
		$headingproperty['font-family'] = array( 'Impact, Arial, sans-serif' );
	elseif ( 'fontno' == $headings_fontface )
		$headingproperty['font-family'] = array( '"Noto Serif", serif' );
	elseif ( 'fontsl' == $headings_fontface )
		$headingproperty['font-family'] = array( '"Slabo 27px", serif' );
	elseif ( 'fontgr' == $headings_fontface )
		$headingproperty['font-family'] = array( 'Georgia, serif' );
	if ( 'uppercase' == $headings_fontface_style )
		$headingproperty['text-transform'] = array( 'uppercase' );
	else
		$headingproperty['text-transform'] = array( 'none' );
	if ( !empty( $headingproperty ) ) {
		hoot_add_css_rule( array(
						'selector'  => 'h1, h2, h3, h4, h5, h6, .title, .titlefont',
						'property'  => $headingproperty,
					) );
		hoot_add_css_rule( array(
						'selector'  => '.sidebar .widget-title, .sub-footer .widget-title, .footer .widget-title',
						'property'  => $headingproperty,
					) );
		hoot_add_css_rule( array(
						'selector'  => '.post-gridunit-title, .hk-gridunit-title', // @deprecated <= HootKit v1.1.3 @9.20 postgrid=>grid-widget postslist=>list-widget
						'property'  => $headingproperty,
					) );
	}

	$subheadingproperty = array();
	if ( 'fontla' == $subheadings_fontface )
		$subheadingproperty['font-family'] = array( '"Lato", sans-serif' );
	elseif ( 'fontos' == $subheadings_fontface )
		$subheadingproperty['font-family'] = array( '"Open Sans", sans-serif' );
	elseif ( 'fontcf' == $subheadings_fontface )
		$subheadingproperty['font-family'] = array( '"Comfortaa", sans-serif' );
	elseif ( 'fontow' == $subheadings_fontface )
		$subheadingproperty['font-family'] = array( '"Oswald", sans-serif' );
	elseif ( 'fontim' == $subheadings_fontface )
		$subheadingproperty['font-family'] = array( 'Impact, Arial, sans-serif' );
	elseif ( 'fontno' == $subheadings_fontface )
		$subheadingproperty['font-family'] = array( '"Noto Serif", serif' );
	elseif ( 'fontsl' == $subheadings_fontface )
		$subheadingproperty['font-family'] = array( '"Slabo 27px", serif' );
	elseif ( 'fontgr' == $subheadings_fontface )
		$subheadingproperty['font-family'] = array( 'Georgia, serif' );
	if ( 'uppercase' == $subheadings_fontface_style || 'uppercasei' == $subheadings_fontface_style )
		$subheadingproperty['text-transform'] = array( 'uppercase' );
	else
		$subheadingproperty['text-transform'] = array( 'none' );
	if ( 'standardi' == $subheadings_fontface_style || 'uppercasei' == $subheadings_fontface_style )
		$subheadingproperty['font-style'] = array( 'italic' );
	else
		$subheadingproperty['font-style'] = array( 'normal' );
	if ( !empty( $subheadingproperty ) ) {
		hoot_add_css_rule( array(
						'selector'  => '.hoot-subtitle, .entry-byline, .post-gridunit-subtitle .entry-byline, .hk-gridunit-subtitle .entry-byline, .posts-listunit-subtitle .entry-byline, .hk-listunit-subtitle .entry-byline, .content-block-subtitle .entry-byline', // @deprecated <= HootKit v1.1.3 @9.20 postgrid=>grid-widget postslist=>list-widget
						'property'  => $subheadingproperty,
					) );
	}

	hoot_add_css_rule( array(
						'selector'  => '#topbar',
						'property'  => array(
							'background' => array( 'rgba(0,0,0,0.04)' ),
							'color'      => array( 'inherit' ),
							),
					) );

	hoot_add_css_rule( array(
						'selector'  => '#topbar.js-search .searchform.expand .searchtext',
						'property'  => 'background',
						'value'     => '#f7f7f7',
					) );
	hoot_add_css_rule( array(
						'selector'  => '#topbar.js-search .searchform.expand .searchtext' . ',' . '#topbar .js-search-placeholder',
						'property'  => 'color',
						'value'     => 'inherit',
					) );

	$logoproperty = array();
	if ( 'fontla' == $logo_fontface )
		$logoproperty['font-family'] = array( '"Lato", sans-serif' );
	elseif ( 'fontos' == $logo_fontface )
		$logoproperty['font-family'] = array( '"Open Sans", sans-serif' );
	elseif ( 'fontcf' == $logo_fontface )
		$logoproperty['font-family'] = array( '"Comfortaa", sans-serif' );
	elseif ( 'fontow' == $logo_fontface )
		$logoproperty['font-family'] = array( '"Oswald", sans-serif' );
	elseif ( 'fontim' == $logo_fontface )
		$logoproperty['font-family'] = array( 'Impact, Arial, sans-serif' );
	elseif ( 'fontno' == $logo_fontface )
		$logoproperty['font-family'] = array( '"Noto Serif", serif' );
	elseif ( 'fontsl' == $logo_fontface )
		$logoproperty['font-family'] = array( '"Slabo 27px", serif' );
	elseif ( 'fontgr' == $logo_fontface )
		$logoproperty['font-family'] = array( 'Georgia, serif' );
	if ( 'uppercase' == $logo_fontface_style )
		$logoproperty['text-transform'] = array( 'uppercase' );
	else
		$logoproperty['text-transform'] = array( 'none' );
	if ( !empty( $logoproperty ) ) {
		hoot_add_css_rule( array(
						'selector'  => '#site-title',
						'property'  => $logoproperty,
					) );
	}

	$sitetitleheadingfont = '';
	if ( 'fontla' == $headings_fontface )
		$sitetitleheadingfont = '"Lato", sans-serif';
	elseif ( 'fontos' == $headings_fontface )
		$sitetitleheadingfont = '"Open Sans", sans-serif';
	elseif ( 'fontcf' == $headings_fontface )
		$sitetitleheadingfont = '"Comfortaa", sans-serif';
	elseif ( 'fontow' == $headings_fontface )
		$sitetitleheadingfont = '"Oswald", sans-serif';
	elseif ( 'fontim' == $headings_fontface )
		$sitetitleheadingfont = 'Impact, Arial, sans-serif';
	elseif ( 'fontno' == $headings_fontface )
		$sitetitleheadingfont = '"Noto Serif", serif';
	elseif ( 'fontsl' == $headings_fontface )
		$sitetitleheadingfont = '"Slabo 27px", serif';
	elseif ( 'fontgr' == $headings_fontface )
		$sitetitleheadingfont = 'Georgia, serif';
	hoot_add_css_rule( array(
						'selector'  => '.site-title-heading-font',
						'property'  => 'font-family',
						'value'     => $sitetitleheadingfont,
					) );
	hoot_add_css_rule( array(
						'selector'  => '.entry-grid .more-link',
						'property'  => 'font-family',
						'value'     => $sitetitleheadingfont,
					) );

	$hoot_style_builder->remove( array(
		// Unos < 2.9.15
		'.menu-items li.current-menu-item, .menu-items li.current-menu-ancestor, .menu-items li:hover',
		'.menu-items li.current-menu-item > a, .menu-items li.current-menu-ancestor > a, .menu-items li:hover > a',
		// Unos >= 2.9.15
		'.menu-items li.current-menu-item:not(.nohighlight), .menu-items li.current-menu-ancestor, .menu-items li:hover',
		'.menu-items li.current-menu-item:not(.nohighlight) > a, .menu-items li.current-menu-ancestor > a, .menu-items li:hover > a',
	) );
	hoot_add_css_rule( array(
						'selector'  => '.menu-items ul li.current-menu-item:not(.nohighlight), .menu-items ul li.current-menu-ancestor, .menu-items ul li:hover',
						'property'  => 'background',
						'value'     => $accent_color,
						'idtag'     => 'accent_color'
					) );
	hoot_add_css_rule( array(
						'selector'  => '.menu-items ul li.current-menu-item:not(.nohighlight) > a, .menu-items ul li.current-menu-ancestor > a, .menu-items ul li:hover > a',
						'property'  => 'color',
						'value'     => $accent_font,
						'idtag'     => 'accent_font'
					) );
	hoot_add_css_rule( array(
						'selector'  => '#menu-home-icon',
						'property'  => array(
							'background-color' => array( $accent_color, 'accent_color' ),
							'color'            => array( $accent_font, 'accent_font' ),
							),
					) );
	hoot_add_css_rule( array(
						'selector'  => '#menu-home-icon:hover',
						'property'  => array(
							'background-color' => array( $accent_font, 'accent_font' ),
							'color'            => array( $accent_color, 'accent_color' ),
							),
					) );
	hoot_add_css_rule( array(
						'selector'  => '.menu-items > li',
						'property'  => array(
							'border-color' => array( $accent_color, 'accent_color' ),
							'color'        => array( $accent_color, 'accent_color' ),
							),
					) );
	$topmenuitems = unosnews_nav_menu_toplevel_items();
	$colorset = apply_filters( 'unosnews_menu_colorset', array(
		array( '#eb6f01', '#ffffff' ),
		array( '#7dc20f', '#ffffff' ),
		array( '#ffb22d', '#ffffff' ),
		array( '#f2407a', '#ffffff' ),
		array( '#ff4530', '#ffffff' ),
		) );
	$colorcount = 0;
	foreach ( $topmenuitems as $topitem ) { if ( !empty( $topitem->ID ) ) {
		$colorbg = ( !empty( $topitem->hootmenu['hoot_tagbg'] ) ) ? $topitem->hootmenu['hoot_tagbg'] : '';
		$colorfont = ( !empty( $topitem->hootmenu['hoot_tagbg'] ) ) ? $topitem->hootmenu['hoot_tagfont'] : '';
		if ( !$colorbg && !$colorfont ) {
			$colorbg = $colorset[ $colorcount ][0];
			$colorfont = $colorset[ $colorcount ][1];
			$colorcount++; if ( $colorcount == count( $colorset ) ) $colorcount = 0; 
		}
		if ( $colorbg ) {
			hoot_add_css_rule( array(
						'selector'  => "#menu-item-{$topitem->ID}" . ',' . "#menu-item-{$topitem->ID} .menu-tag",
						'property'  => array(
							'border-color' => $colorbg,
							'color'        => $colorbg,
							),
					) );
			hoot_add_css_rule( array(
						'selector'  => "#menu-item-{$topitem->ID} ul li.current-menu-item:not(.nohighlight), #menu-item-{$topitem->ID} ul li.current-menu-ancestor, #menu-item-{$topitem->ID} ul li:hover" . ',' . "#menu-item-{$topitem->ID} .menu-tag",
						'property'  => 'background',
						'value'     => $colorbg,
					) );
		}
		if ( $colorfont ) {
			hoot_add_css_rule( array(
						'selector'  => "#menu-item-{$topitem->ID} ul li.current-menu-item:not(.nohighlight) > a, #menu-item-{$topitem->ID} ul li.current-menu-ancestor > a, #menu-item-{$topitem->ID} ul li:hover > a" . ',' . "#menu-item-{$topitem->ID} .menu-tag",
						'property'  => 'color',
						'value'     => $colorfont,
					) );
		}
	} }
	$categories = get_categories( array( 'orderby' => 'name', 'order' => 'ASC' ) );
	$colorset = apply_filters( 'unosnews_catblocks_colorset', array(
		array( '#eb6f01', '#ffffff' ),
		array( '#7dc20f', '#ffffff' ),
		array( '#ffb22d', '#ffffff' ),
		array( '#f2407a', '#ffffff' ),
		array( '#ff4530', '#ffffff' ),
		) );
	$colorcount = 0;
	foreach ( $categories as $category ) { if ( !empty( $category->term_id ) ) {
		$property = array();
		$colorbg = get_term_meta( $category->term_id, 'hoot_term_bg', true );
		$colorfont = get_term_meta( $category->term_id, 'hoot_term_font', true );
		if ( !$colorbg && !$colorfont ) {
			$colorbg = $colorset[ $colorcount ][0];
			$colorfont = $colorset[ $colorcount ][1];
			$colorcount++; if ( $colorcount == count( $colorset ) ) $colorcount = 0; 
		}
		if ( $colorbg ) $property['background'] = $colorbg;
		if ( $colorfont ) $property['color'] = $colorfont;
		if ( !empty( $property ) )
			hoot_add_css_rule( array(
						'selector'  => ".catblock-{$category->term_id}",
						'property'  => $property,
					) );
	} }

	$halfwidgetmargin = false;
	if ( intval( $widgetmargin ) )
		$halfwidgetmargin = ( intval( $widgetmargin ) / 2 > 25 ) ? ( intval( $widgetmargin ) / 2 ) . 'px' : '25px';
	if ( $halfwidgetmargin )
		hoot_add_css_rule( array(
						'selector'  => '.main > .main-content-grid:first-child' . ',' . '.content-frontpage > .frontpage-area-boxed:first-child',
						'property'  => 'margin-top',
						'value'     => $halfwidgetmargin,
					) );

	hoot_add_css_rule( array(
						'selector'  => '.widget_newsletterwidget, .widget_newsletterwidgetminimal',
						'property'  => array(
							// property  => array( value, idtag, important, typography_reset ),
							'background' => array( $accent_color, 'accent_color' ),
							'color'      => array( $accent_font, 'accent_font' ),
							),
					) );

}
add_action( 'hoot_dynamic_cssrules', 'unosnews_dynamic_cssrules', 3 );