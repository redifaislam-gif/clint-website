<?php


/* === Category Colors === */


/**
 * Display separate Category Blocks in meta info
 *
 * @since 1.0
 * @access public
 * @return string
 */
function unosnews_display_meta_catblock( $blocks, $context, $display, $editlink ){
	$dofor = apply_filters( 'unosnews_display_meta_catblocks', array(
				'loop-meta', // meta info shown in header along with title
				'archive-big', 'archive-medium', 'archive-small', 'archive-block2', 'archive-block3', 'mixedunit-big', 'mixedunit-medium', 'mixedunit-small', 'mixedunit-block2', 'mixedunit-block3', 'archive-mosaic2', 'archive-mosaic3', 'archive-mosaic4',
				'customizer',
				'post-gridunit', // @deprecated <= HootKit v1.2.1 @12.20
				'hk-gridunit', 'posts-listunit', 'post-listcarouselunit', 'content-post-block'
			), $blocks, $context, $display, $editlink );
	if ( !empty( $blocks ) && !empty( $blocks['cats'] ) && in_array( $context, $dofor ) ) {
		$categories = get_the_category();
		if ( !empty( $categories ) ) {
			$print = '';
			foreach ( $categories as $category ) {
				$print .= '<span class="catblock catblock-' . $category->term_id . '"><a href="' . esc_url( get_category_link( $category->term_id ) ) . '" rel="category">' . esc_html( $category->name ) . '</a></span>';
			}
		}
		if ( !empty( $print ) ) {
			unset( $blocks['cats'] );
			if ( apply_filters( 'unosnews_display_meta_catblock_inline', true, $blocks, $context, $display, $editlink, $dofor ) && !empty( $print ) ) {
				array_unshift( $blocks, array( 'label' => '', 'content' => $print ) );
			} else {
				echo '<div class="entry-byline-catblock">' . $print . '</div>';
			}
		}
	}
	return $blocks;
}
add_filter( 'hoot_display_meta_info', 'unosnews_display_meta_catblock', 5, 4 );

/*
 * Category Colors - Admin
 * @since 1.0
 */
function unosnews_taxonomy_fields_init(){
	if ( is_admin() ) :
		$taxonomies = apply_filters( 'unosnews_taxonomy_fields_taxonomies', array( 'category' ) );
		if ( !empty( $taxonomies ) ) {
			add_action( 'admin_enqueue_scripts', 'unosnews_taxonomy_enqueue' );
			foreach ( $taxonomies as $taxonomy ) {
				add_filter( "manage_edit-{$taxonomy}_columns", 'unosnews_taxonomy_columns_header' );
				add_filter( "manage_{$taxonomy}_custom_column", 'unosnews_taxonomy_column', 10, 3 );
				add_action( "{$taxonomy}_add_form_fields", 'unosnews_add_taxonomy_field' );
				add_filter( "{$taxonomy}_edit_form_fields", 'unosnews_edit_taxonomy_field' );
			}
			add_action( 'created_term', 'unosnews_term_update', 10, 3 );
			add_action( 'edit_term', 'unosnews_term_update', 10, 3 );
		}
	endif;
}
add_action( 'after_setup_theme', 'unosnews_taxonomy_fields_init' );

function unosnews_taxonomy_enqueue( $hook ) {
	$screen = get_current_screen();
	$currenttax = str_replace( 'edit-', '', $screen->id );
	if ( in_array( $currenttax, apply_filters( 'unosnews_taxonomy_fields_taxonomies', array( 'category' ) ) ) ) {
		wp_enqueue_style( 'wp-color-picker' );
		if ( file_exists( hoot_data()->child_dir . 'admin/taxedit.js' ) )
			wp_enqueue_script( 'unosnews-taxedit', hoot_data()->child_uri . 'admin/taxedit.js', array( 'wp-color-picker' ), hoot_data()->hoot_version, true );
	}
}

function unosnews_taxonomy_columns_header( $defaults ){
	$defaults['hoot_term_colors']  = __( 'Label Color', 'unos-news' );
	return $defaults;
}

function unosnews_taxonomy_column( $columns, $column, $id ){
	if ( 'hoot_term_colors' === $column ) {
		$bg = get_term_meta( $id, 'hoot_term_bg', true );
		$font = get_term_meta( $id, 'hoot_term_font', true );
		$columns .= ( empty( $bg ) ) ? __( 'Auto', 'unos-news' ) . ' / ' : '<span style="display:inline-block;height:15px;width:15px;border:solid 1px #999;background:' . sanitize_hex_color( $bg ) . ';margin-right:5px;"></span>';
		$columns .= ( empty( $font ) ) ? __( 'Auto', 'unos-news' ) : '<span style="display:inline-block;height:15px;width:15px;border:solid 1px #999;background:' . sanitize_hex_color( $font ) . ';"></span>';
	}
	return $columns;
}

function unosnews_add_taxonomy_field( $term ) {
	?><div class="form-field">
		<label for="hoot_term_bg"><?php esc_html_e( 'Label Background', 'unos-news' ); ?></label>
		<input type="input" id="hoot_term_bg" class="hoot-color" name="hoot_term_bg" value="" data-default-color="#ff4530" />
	</div><div class="form-field">
		<label for="hoot_term_font"><?php esc_html_e( 'Label Font', 'unos-news' ); ?></label>
		<input type="input" id="hoot_term_font" class="hoot-color" name="hoot_term_font" value="" data-default-color="#ffffff" />
	</div><?php
}

function unosnews_edit_taxonomy_field( $term ) {
	$bg = get_term_meta( $term->term_id, 'hoot_term_bg', true );
	$font = get_term_meta( $term->term_id, 'hoot_term_font', true );
	?><tr class="form-field">
		<th scope="row" valign="top">
			<label for="hoot_term_bg"><?php esc_html_e( 'Label Background', 'unos-news' ); ?></label>
		</th>
		<td>
			<input type="input" id="hoot_term_bg" class="hoot-color" name="hoot_term_bg" value="<?php echo sanitize_hex_color( $bg ); ?>" data-default-color="#ff4530" />
			<p class="description" style="margin:0"><?php _e( 'Leave empty for automatic color selection', 'unos-news' ) ?></p>
		</td>
	</tr><tr class="form-field">
		<th scope="row" valign="top">
			<label for="hoot_term_font"><?php esc_html_e( 'Label Font', 'unos-news' ); ?></label>
		</th>
		<td>
			<input type="input" id="hoot_term_font" class="hoot-color" name="hoot_term_font" value="<?php echo sanitize_hex_color( $font ); ?>" data-default-color="#ffffff" />
			<p class="description" style="margin:0"><?php _e( 'Leave empty for automatic color selection', 'unos-news' ) ?></p>
		</td>
	</tr><?php
}

// @ref. https://developer.wordpress.org/reference/hooks/edit_term/
function unosnews_term_update( $term_id, $tt_id = '', $taxonomy = '' ){
	if ( in_array( $taxonomy, apply_filters( 'unosnews_taxonomy_fields_taxonomies', array( 'category' ) ) ) ) {
		if ( isset( $_POST['hoot_term_bg'] ) )
			update_term_meta( $term_id, 'hoot_term_bg', sanitize_hex_color( $_POST['hoot_term_bg'] ) );
		if ( isset( $_POST['hoot_term_font'] ) )
			update_term_meta( $term_id, 'hoot_term_font', sanitize_hex_color( $_POST['hoot_term_font'] ) );
	}
}