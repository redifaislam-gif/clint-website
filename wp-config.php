<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'wordpress' );

/** MySQL database username */
define( 'DB_USER', 'redifa' );

/** MySQL database password */
define( 'DB_PASSWORD', '6XWDUT5Lh39PLJKY' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'qh{[a:w9Q2:v5}PYF2*o8D)M0Z1=L[1GpU+U~h+Ca|y?Z{&~N})4bPk$[y^;pIc=' );
define( 'SECURE_AUTH_KEY',  'v9@1OmRN#.!b65M+TGbCLG`5p=hj5S*QB-8^.TksNgE:0C1D0s@EY,FH#[<;UwR~' );
define( 'LOGGED_IN_KEY',    'tQL$.AOB+#L%6H(dY5[?f<XV3}mWf<E~&,vc(x~!q5*Qfc0q8wVLe^87eJ_K__f`' );
define( 'NONCE_KEY',        'YfcTU2W~M@t<EDgs8Dj@q&i:)_RlF@HR j+/Au[7~82MazrhH[]1Q+~-mNIm%f/w' );
define( 'AUTH_SALT',        '_]61K#JHqKkBehFL(0w~>l-UwU}.;i*9UEza%70d#oI#}:}6R%9zh ea|ZWvVY]s' );
define( 'SECURE_AUTH_SALT', 'WN-oSaHALC63K?uF3<*GJIS=VNc(B9ng#C?DMyXqs*=a/B.9=R]/9ir?p^i3&#6:' );
define( 'LOGGED_IN_SALT',   'i?TszV*f*.S:*Z6,.|%qMqekPzHrg%+aidu+0Q~CZ`TpNt@}adPqLtWSV&i};p,{' );
define( 'NONCE_SALT',       'eY|-oV;V.<hNv1du3W{l2/v-5Zb=a/z|)a]+a8(EsD^p2X>JI@#<=>55W4bIZ8t)' );

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the documentation.
 *
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
