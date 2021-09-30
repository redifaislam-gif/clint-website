/**
 * Theme Customizer
 */

( function( api ) {

	// Color Schemes @credit TwentySixteen theme
	api.controlConstructor.radio = api.Control.extend( {
		ready: function() {
			if ( 'themestyle' === this.id ) {
				this.setting.bind( 'change', function( value ) {
					var sitebg = '', boxbg = '';
					switch (value) {
						case 'dark' : sitebg = '#131313'; boxbg = '#333333'; break;
						case 'light': sitebg = '#ffffff'; boxbg = '#ffffff'; break;
					}
					// Background Color
					if ( 'undefined' !== typeof api.control( 'background_color' ) ) {
						api( 'background_color' ).set( sitebg );
						api.control( 'background_color' ).container.find( '.color-picker-hex' )
							.data( 'data-default-color', sitebg )
							.wpColorPicker( 'defaultColor', sitebg );
					} else if ( 'undefined' !== typeof api.control( 'background-color' ) ) {
						api( 'background-color' ).set( sitebg );
						api.control( 'background-color' ).container.find( '.color-picker-hex' )
							.data( 'data-default-color', sitebg )
							.wpColorPicker( 'defaultColor', sitebg );
					}
				} );
			}
		}
	} );

} )( wp.customize );