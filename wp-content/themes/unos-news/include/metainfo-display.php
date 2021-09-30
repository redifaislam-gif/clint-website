<?php

/* === Meta Info Option === */


/**
 * Edit Customizer Options
 *
 * @since 1.0
 * @access public
 * @return array
 */
function unosnews_postmeta_customizer_options( $options ){
	unset( $options['settings']['post_meta_location'] );
	$options['settings']['post_meta']['label'] = esc_html__( 'Meta Information on Posts (After Title)', 'unos-news' );
	$options['settings']['post_meta']['default'] = 'cats';
	unset( $options['settings']['post_meta']['selective_refresh'] );
	$options['settings']['post_meta_bottom'] = array(
		'label'       => esc_html__( 'Meta Information on Posts (After Content)', 'unos-news' ),
		'sublabel'    => esc_html__( "Check which meta information to display on an individual 'Post' page", 'unos-news' ),
		'section'     => 'singular',
		'type'        => 'checkbox',
		'choices'     => array(
			'author'   => esc_html__( 'Author', 'unos-news' ),
			'date'     => esc_html__( 'Date', 'unos-news' ),
			'cats'     => esc_html__( 'Categories', 'unos-news' ),
			'tags'     => esc_html__( 'Tags', 'unos-news' ),
			'comments' => esc_html__( 'No. of comments', 'unos-news' )
		),
		'default'     => 'author, date, cats, tags, comments',
		'priority'    => '325',
	);
	return $options;
}
add_filter( 'unos_customizer_options', 'unosnews_postmeta_customizer_options' );

/**
 * Display Loop Meta
 * Hook to a later priority for 'meta_hide_info' meta option to work
 *
 * @since 1.0
 * @access public
 * @return bool
 */
function unosnews_display_meta( $hide, $context ){
	if ( $hide ) return true;
	if ( is_attachment() ):
		return;
	elseif ( $context == 'top' ):
		if ( function_exists( 'is_bbpress' ) && is_bbpress() ):
			if ( bbp_is_single_forum() ) {
				?><div <?php hoot_attr( 'loop-description' ); ?>><?php
					bbp_forum_content();
				?></div><!-- .loop-description --><?php
			};
		else:
			$metarray = ( is_page() ) ? hoot_get_mod('page_meta') : hoot_get_mod('post_meta');
			if ( hoot_meta_info( $metarray, 'loop-meta', true ) ) :
				?><div <?php hoot_attr( 'loop-description' ); ?>><?php
					hoot_display_meta_info( $metarray, 'loop-meta', false );
				?></div><!-- .loop-description --><?php
			endif;
		endif;
	elseif ( $context == 'bottom' ):
		if ( is_page() ) return true;
		$metarray = hoot_get_mod('post_meta_bottom');
		if ( hoot_meta_info( $metarray, 'post', true ) ) :
			?><footer class="entry-footer"><?php
				hoot_display_meta_info( $metarray, 'post', false );
			?></footer><!-- .entry-footer --><?php
		endif;
	else:
		return false;
	endif;
	return true;
}
add_filter( 'unos_hide_meta', 'unosnews_display_meta', 99, 2 );