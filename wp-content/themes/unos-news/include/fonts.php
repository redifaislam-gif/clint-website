<?php


/* === Fonts === */


/**
 * Build URL for loading Google Fonts
 * Priority@5 : Prim loads at priority 10
 *
 * @since 1.0
 * @access public
 * @return void
 */
function unosnews_google_fonts_preparearray( $fonts ) {
	$fonts = array();

		$modsfont = array( hoot_get_mod( 'body_fontface' ), hoot_get_mod( 'logo_fontface' ), hoot_get_mod( 'headings_fontface' ), hoot_get_mod( 'subheadings_fontface' ) );

		if ( in_array( 'fontla', $modsfont ) ) {
			$fonts[ 'Lato' ] = array(
				'normal' => array( '400','500','700' ),
				'italic' => array( '400','500','700' ),
			);
		}
		if ( in_array( 'fontos', $modsfont ) ) {
			$fonts[ 'Open Sans' ] = array(
				'normal' => array( '300','400','500','600','700','800' ),
				'italic' => array( '400','700' ),
			);
		}
		if ( in_array( 'fontcf', $modsfont ) ) {
			$fonts[ 'Comfortaa' ] = array(
				'normal' => array( '400','700' ),
			);
		}
		if ( in_array( 'fontow', $modsfont ) ) {
			$fonts[ 'Oswald' ] = array(
				'normal' => array( '400', 700 ),
			);
		}
		if ( in_array( 'fontno', $modsfont ) ) {
			$fonts[ 'Noto Serif' ] = array(
				'normal' => array( '400','700' ),
				'italic' => array( '400','700' ),
			);
		}
		if ( in_array( 'fontsl', $modsfont ) ) {
			$fonts[ 'Slabo 27px' ] = array(
				'normal' => array( '400' ),
			);
		}

	return $fonts;
}
add_filter( 'unos_google_fonts_preparearray', 'unosnews_google_fonts_preparearray', 5, 2 );

/**
 * Modify the font (websafe) list
 * Font list should always have the form:
 * {css style} => {font name}
 * 
 * Even though this list isn't currently used in customizer options (no typography options)
 * this is still needed so that sanitization functions recognize the font.
 * Priority@15 to overwrite Lite @priority 10
 *
 * @since 1.0
 * @access public
 * @return array
 */
function unosnews_fonts_list( $fonts ) {
	if ( !function_exists( 'hoot_lib_premium_core' ) ) {
		$fonts['Impact, Arial, sans-serif'] = 'Impact';
		if ( isset( $fonts['"Lora", serif'] ) )
			unset( $fonts['"Lora", serif'] );
		$fonts['"Lato", sans-serif'] = 'Lato';
		$fonts['"Noto Serif", serif'] = 'Noto Serif';
	} else {
		// let those fonts occur in their natural order as stated in hoot_googlefonts_list()
		return $fonts;
	}
	return $fonts;
}
add_filter( 'hoot_fonts_list', 'unosnews_fonts_list', 15 );