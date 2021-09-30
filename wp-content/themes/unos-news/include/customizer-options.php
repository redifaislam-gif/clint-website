<?php


/* === Customizer Options === */


/**
 * Update theme defaults
 * Prim @priority 5
 * Prim child @priority 9
 *
 * @since 1.0
 * @access public
 * @return array
 */
if ( !function_exists( 'unosnews_default_style' ) ) :
function unosnews_default_style( $defaults ){
	$defaults = array_merge( $defaults, array(
		'accent_color'         => '#ff4530',
		'accent_font'          => '#ffffff',
		'widgetmargin'         => 45,
		'logo_fontface'        => 'fontow',
		'headings_fontface'    => 'fontow',
	) );
	return $defaults;
}
endif;
add_filter( 'unos_default_style', 'unosnews_default_style', 7 );

/**
 * Add Options (settings, sections and panels) to Hoot_Customize class options object
 *
 * Parent Lite/Prim add options using 'init' hook both at priority 0. Currently there is no way
 * to hook in between them. Hence we hook in later at 5 to be able to remove options if needed.
 * The only drawback is that options involving widget areas cannot be modified/created/removed as
 * those have already been used during widgets_init hooked into init at priority 1. For adding options
 * involving widget areas, we can alterntely hook into 'after_setup_theme' before lite/prim options
 * are built. Modifying/removing such options from lite/prim still needs testing.
 *
 * @since 1.0
 * @access public
 */
if ( !function_exists( 'unosnews_add_customizer_options' ) ) :
function unosnews_add_customizer_options() {

	$hoot_customize = Hoot_Customize::get_instance();

	// Modify Options
	$hoot_customize->remove_settings( array( 'logo_tagline_size', 'logo_tagline_style' ) );
	$hoot_customize->remove_settings( 'pageheader_background_location' );

	// Define Options
	$options = array(
		'settings' => array(),
		'sections' => array(),
		'panels' => array(),
	);

	$options['settings']['headerimg_style'] = array(
		'label'       => esc_html__( 'Display Image', 'unos-news' ),
		'section'     => 'header_image',
		'type'        => 'select',
		'priority'    => 100,
		'choices'     => array(
			'background' => esc_html__( 'As Background', 'unos-news'),
			'full'       => esc_html__( 'Full Image', 'unos-news'),
		),
		'default'     => 'background',
		'transport'   => 'postMessage',
	);

	$options['settings']['show_menuhome'] = array(
		'label'       => esc_html__( 'Display Home Icon in Menu', 'unos-news' ),
		'section'     => 'header',
		'type'        => 'checkbox',
		'priority'    => 102,
		'default'     => 1,
		'transport'   => 'postMessage',
	);

	$options['settings']['themestyle'] = array(
		'label'       => esc_html__( 'Header/Footer Color Scheme', 'unos-news' ),
		'section'     => 'colors',
		'type'        => 'radio',
		'priority'    => 1,
		'choices'     => array(
			'light' => esc_html__( 'Light Background', 'unos-news'),
			'dark'  => esc_html__( 'Dark Background', 'unos-news'),
		),
		'default'     => 'dark',
		'transport'   => 'postMessage',
	);

	$options['settings']['subheadings_fontface'] = array(
		'label'       => esc_html__( 'Sub Headings Font (Free Version)', 'unos-news' ),
		'section'     => 'typography',
		'type'        => 'select',
		'priority'    => 207, // Non static options must have a priority
		'choices'     => array( ),
		'default'     => 'fontgr',
	);

	$options['settings']['subheadings_fontface_style'] = array(
		'label'       => esc_html__( 'Sub Heading Font Style', 'unos-news' ),
		'section'     => 'typography',
		'type'        => 'select',
		'priority'    => 207, // Non static options must have a priority
		'choices'     => array(
			'standard'   => esc_html__( 'Standard', 'unos-news'),
			'standardi'  => esc_html__( 'Standard Italics', 'unos-news'),
			'uppercase'  => esc_html__( 'Uppercase', 'unos-news'),
			'uppercasei' => esc_html__( 'Uppercase Italics', 'unos-news'),
		),
		'default'     => 'standardi',
		'transport' => 'postMessage',
	);

	$options['settings']['body_fontface'] = array(
		'label'       => esc_html__( 'Body Font (Free Version)', 'unos-news' ),
		'section'     => 'typography',
		'type'        => 'select',
		'priority'    => 207, // Non static options must have a priority
		'choices'     => array( ),
		'default'     => 'fontla',
	);

	// Add Options
	$hoot_customize->add_options( apply_filters( 'unosnews_customizer_options', array(
		'settings' => $options['settings'],
		'sections' => $options['sections'],
		'panels' => $options['panels'],
		) ) );

}
endif;
add_action( 'init', 'unosnews_add_customizer_options', 5 );

/**
 * Modify Lite customizer options
 * Prim hooks in later at priority 9
 *
 * @since 1.0
 * @access public
 */
function unosnews_modify_customizer_options( $options ){

	if ( isset( $options['settings']['widgetmargin'] ) )
		$options['settings']['widgetmargin']['input_attrs']['placeholder'] = esc_html__( 'default: 35', 'unos-news' );
	if ( isset( $options['settings']['menu_location'] ) )
		$options['settings']['menu_location']['default'] = 'bottom';
	if ( isset( $options['settings']['logo_size'] ) )
		$options['settings']['logo_size']['default'] = 'medium';
	if ( isset( $options['settings']['logo_side'] ) )
		$options['settings']['logo_side']['default'] = 'widget-area';
	if ( isset( $options['settings']['fullwidth_menu_align'] ) )
		$options['settings']['fullwidth_menu_align']['default'] = 'left';
	if ( isset( $options['settings']['logo_custom'] ) )
		$options['settings']['logo_custom']['default'] = array(
			'line1'  => array( 'text' => wp_kses_post( __( '<b>Hoot</b>', 'unos-news' ) ), 'size' => '18px', 'font' => 'standard' ),
			'line2'  => array( 'text' => wp_kses_post( __( '<em>Unos</em><mark>News</mark>', 'unos-news' ) ), 'size' => '60px' ),
		);
	if ( !empty( $options['settings']['logo_custom']['description'] ) )
		$options['settings']['logo_custom']['description'] = sprintf( esc_html__( 'Use &lt;b&gt; &lt;em&gt; and &lt;mark&gt; tags in "Line Text" fields below to emphasize different words. Example:%1$s%2$s&lt;b&gt;Hoot&lt;/b&gt; &lt;em&gt;Unos&lt;/em&gt; &lt;mark&gt;News&lt;/mark&gt;%3$s', 'unos-news' ), '<br />', '<code>', '</code>' );

	if ( isset( $options['settings']['logo_custo']['options'] ) ) {
		foreach ( $options['settings']['logo_custom']['options'] as $linekey => $linevalue ) {
			$options['settings']['logo_custom']['options'][$linekey] = array_merge( $options['settings']['logo_custom']['options'][$linekey], array(
				'accentbg' => array(
					'label'       => esc_html__( 'Accent Background', 'unos-news' ),
					'type'        => 'checkbox',
				),
			) );
		}
	}
	if ( isset( $options['settings']['headings_fontface_style'] ) )
		$options['settings']['headings_fontface_style']['default'] = 'uppercase';
	return $options;
}
add_filter( 'unos_customizer_options', 'unosnews_modify_customizer_options', 7 );

/**
 * Modify default WordPress Settings Sections and Panels
 *
 * @since 1.0
 * @param object $wp_customize
 * @return void
 */
function unosnews_modify_default_customizer_options( $wp_customize ) {
	if ( current_theme_supports( 'custom-header' ) ) {
		$wp_customize->get_section( 'header_image' )->priority = 8;
		$wp_customize->get_section( 'header_image' )->title = esc_html__( 'Header Image', 'unos-news' );
	}
}
add_action( 'customize_register', 'unosnews_modify_default_customizer_options', 105 );

/**
 * Modify customizer options before being added to Class options variable
 *
 * @since 1.0
 * @access public
 */
function unosnews_hoot_customize_add_settings( $settings ){
	$fontoptions = array( 'logo_fontface', 'headings_fontface', 'subheadings_fontface', 'body_fontface' );
	foreach ( $fontoptions as $key ) if ( !empty( $settings[ $key ] ) )
		$settings[ $key ]['choices'] = array(
			'fontla' => esc_html__( 'Standard Font 1 (Lato)', 'unos-news'),
			'fontos' => esc_html__( 'Standard Font 2 (Open Sans)', 'unos-news'),
			'fontcf' => esc_html__( 'Alternate Font (Comfortaa)', 'unos-news'),
			'fontow' => esc_html__( 'Display Font 1 (Oswald)', 'unos-news'),
			'fontim' => esc_html__( 'Display Font 2 (Impact)', 'unos-news'),
			'fontno' => esc_html__( 'Heading Font 1 (Noto Serif)', 'unos-news'),
			'fontsl' => esc_html__( 'Heading Font 2 (Slabo)', 'unos-news'),
			'fontgr' => esc_html__( 'Heading Font 3 (Georgia)', 'unos-news'),
		);
	return $settings;
}
add_filter( 'hoot_customize_add_settings', 'unosnews_hoot_customize_add_settings' );

/**
 * Modify Customizer Link Section
 *
 * @since 1.0
 * @access public
 */
function unosnews_customizer_option_linksection( $lcontent ){
	if ( is_array( $lcontent ) ) {
		if ( !empty( $lcontent['demo'] ) )
			$lcontent['demo'] = str_replace( 'demo.wphoot.com/unos', 'demo.wphoot.com/unos-news', $lcontent['demo'] );
		if ( !empty( $lcontent['install'] ) )
			$lcontent['install'] = str_replace( 'wphoot.com/support/unos', 'wphoot.com/support/unos-news', $lcontent['install'] );
		if ( !empty( $lcontent['rateus'] ) )
			$lcontent['rateus'] = str_replace( 'wordpress.org/support/theme/unos', 'wordpress.org/support/theme/unos-news', $lcontent['rateus'] );
	}
	return $lcontent;
}
add_filter( 'unos_customizer_option_linksection', 'unosnews_customizer_option_linksection' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 *
 * @since 1.0
 * @return void
 */
function unosnews_customize_preview_js() {
	if ( file_exists( hoot_data()->child_dir . 'admin/customize-preview.js' ) )
		wp_enqueue_script( 'unosnews-customize-preview', hoot_data()->child_uri . 'admin/customize-preview.js', array( 'hoot-customize-preview', 'customize-preview' ), hoot_data()->childtheme_version, true );
}
add_action( 'customize_preview_init', 'unosnews_customize_preview_js', 12 );

/**
 * Enqueue custom scripts to customizer screen
 * Library files and localize data (Customizer Interface) @priority 11
 * Include styles/scripts (theme specific) @priority 12
 *
 * @since 1.0
 * @return void
 */
function unosnews_customizer_enqueue_scripts() {
	if ( file_exists( hoot_data()->child_dir . 'admin/customize-controls.js' ) )
		wp_enqueue_script( 'unosnews-customize-controls', hoot_data()->child_uri . 'admin/customize-controls.js', array( 'unos-customize-controls' ), hoot_data()->childtheme_version, true );
}
add_action( 'customize_controls_enqueue_scripts', 'unosnews_customizer_enqueue_scripts', 15 );

/**
 * Add style tag to support dynamic css via postMessage script in customizer preview
 *
 * @since 1.0
 * @access public
 */

function unosnews_customize_dynamic_selectors( $settings ) {
	if ( !is_array( $settings ) ) return $settings;
	$hootpload = ( function_exists( 'hoot_lib_premium_core' ) ) ? 1 : '';

	$modify = array(
		'box_background_color' => array(
			'color'			=> array( 'remove' => array(), 'add' => array(), ),
			'background'	=> array( 'remove' => array(), 'add' => array(), ),
		),
		'accent_color' => array(
			'color' => array(
				'remove' => array(
				),
				'add' => array(
					'.menu-items ul li.current-menu-item > a, .menu-items ul li.current-menu-ancestor > a, .menu-items ul li:hover > a',
					'.content-block-subtitle',
				),
			),
			'background' => array(
				'add' => array(
					'.widget_newsletterwidget, .widget_newsletterwidgetminimal',
				),
				'remove' => array(
					'.menu-items li.current-menu-item, .menu-items li.current-menu-ancestor, .menu-items li:hover',
					'.social-icons-icon',
				),
			),
			'border-color' => array(
				'add' => array(
					'.menu-items > li.current-menu-item:after, .menu-items > li.current-menu-ancestor:after, .menu-items > li:hover:after' . ',' . '.menu-hoottag',
				),
			),
		),
		'accent_font' => array(
			'color' => array(
				'add' => array(
					'.widget_newsletterwidget, .widget_newsletterwidgetminimal',
				),
				'remove' => array(
					'.menu-items li.current-menu-item > a, .menu-items li.current-menu-ancestor > a, .menu-items li:hover > a',
					'#topbar .social-icons-icon, #page-wrapper .social-icons-icon',
				),
			),
			'background' => array(
				'remove' => array(
				),
				'add' => array(
					'.menu-items ul li.current-menu-item, .menu-items ul li.current-menu-ancestor, .menu-items ul li:hover',
				),
			),
		),
	);

	if ( !$hootpload ) {
		array_push( $modify['accent_color']['background']['remove'], '#topbar', '#topbar.js-search .searchform.expand .searchtext' );
		array_push( $modify['accent_font']['color']['remove'], '#topbar', '#topbar.js-search .searchform.expand .searchtext', '#topbar .js-search-placeholder' );
		$modify['headings_fontface_style']['text-transform']['add'] = array( '.sidebar .widget-title, .sub-footer .widget-title, .footer .widget-title', '.post-gridunit-title, .hk-gridunit-title' ); // @deprecated <= HootKit v1.1.3 @9.20 postgrid=>grid-widget postslist=>list-widget
	}

	foreach ( $modify as $id => $props ) {
		foreach ( $props as $prop => $ops ) {
			foreach ( $ops as $op => $values ) {
				if ( $op == 'remove' ) {
					foreach ( $values as $val ) {
						$akey = array_search( $val, $settings[$id][$prop] );
						if ( $akey !== false ) unset( $settings[$id][$prop][$akey] );
					}
				} elseif ( $op == 'add' ) {
					foreach ( $values as $val ) {
						$settings[$id][$prop][] = $val;
					}
				}
			}
		}
	}

	if ( !$hootpload ) {
		$settings['subheadings_fontface_style'] = array(
			'font-style'=> array( '.hoot-subtitle, .entry-byline, .post-gridunit-subtitle .entry-byline, .hk-gridunit-subtitle .entry-byline, .posts-listunit-subtitle .entry-byline, .hk-listunit-subtitle .entry-byline, .content-block-subtitle .entry-byline' ), // @deprecated <= HootKit v1.1.3 @9.20 postgrid=>grid-widget postslist=>list-widget
		);
		$settings['subheadings_fontface_style_trans'] = array(
			'text-transform'=> array( '.hoot-subtitle, .entry-byline, .post-gridunit-subtitle .entry-byline, .hk-gridunit-subtitle .entry-byline, .posts-listunit-subtitle .entry-byline, .hk-listunit-subtitle .entry-byline, .content-block-subtitle .entry-byline' ), // @deprecated <= HootKit v1.1.3 @9.20 postgrid=>grid-widget postslist=>list-widget
		);
	}

	return $settings;
}
add_filter( 'hoot_customize_dynamic_selectors', 'unosnews_customize_dynamic_selectors', 5 );

/**
 * Actions in 'theme-dark.php' need to run before 'wp_loaded'
 * However the new option set in customizer is available only at wp_loaded
 * Hence we set_theme_mod (if it has changed from $currentthemestyle) and refresh the preview
 *   refreshing the preview could not be done by adding
 *   <script>( function( $ ) { wp.customize.preview.send( 'refresh' ); } )( jQuery );</script>
 *   in wp_head (customize-preview.js not loaded) or wp_footer@999 (wp.customize.preview is undefined)
 *   => use postMessage for themestyle and set_theme_mod using ajax
 */
function unosnews_customize_preview_setthemestyle() {
	if ( ! wp_verify_nonce( $_GET['_wpnonce'], 'unosnews-customize-preview' ) )
		wp_die( __( 'Invalid request.', 'unos-news' ), 403 );
	if ( current_user_can( 'edit_theme_options' ) ) {
		$newval = ( !empty( $_REQUEST['newval'] ) ) ? $_REQUEST['newval'] : 'dark';
		set_theme_mod( 'themestylepreview', $newval );
	}
	wp_send_json_success();
	wp_die();
}
function unosnews_reset_customize_preview_setthemestyle(){
	// Reset themestylepreview on customizer load (any unpublished change from previous times)
	set_theme_mod( 'themestylepreview', get_theme_mod('themestyle') );
}
function unosnews_customize_preview_localize() {
	wp_localize_script( 'unosnews-customize-preview', 'unosnewsData', array(
		'ajaxurl' => wp_nonce_url( admin_url('admin-ajax.php'), 'unosnews-customize-preview' )
	) );
}
add_action( 'wp_ajax_unos_set_themestyle', 'unosnews_customize_preview_setthemestyle' );
add_action( 'customize_controls_init', 'unosnews_reset_customize_preview_setthemestyle' );
add_action( 'customize_preview_init', 'unosnews_customize_preview_localize', 13 ); // enqueued @12