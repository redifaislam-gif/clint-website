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
define( 'DB_NAME', 'wordpress_db' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', '' );

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
define( 'AUTH_KEY',         'wJvfcMRgM(JRI9}`,fSKi&g&-*4&DFq4LP @,Fn8TV+/tB($KM+RUtzn.L-{A:yu' );
define( 'SECURE_AUTH_KEY',  'YkWQ[LBoj1`0@zyGpTQh1a3u:]Pvp(}M1S{P|o+rcCNqDCSAW+(Wq`u2^- 5^L0I' );
define( 'LOGGED_IN_KEY',    'n0Nzu^~Iifj[L%Xk7_yqZ(%Q_81WEh-A0J|hKB,[AzG0V6$z|oK^Y8;bU}y`h4gO' );
define( 'NONCE_KEY',        ',JN^E5;It:Zf`&bOWViE/S1?biA=c?NCF(GOdeT!gA>wYb6jqS)_A_ECV{0doy]k' );
define( 'AUTH_SALT',        ']!w=xU.u&kguF04GP82_O5B07o;doiS1``Lp $=HA]ye`NX]+iFBt?4^v!=yT<4$' );
define( 'SECURE_AUTH_SALT', 'XYpc Vq-cay99~% /jj]_#7.?u].[-37rUW)IT3rwTQ7Mw1|%aOaZ+Q^2mYG;OT8' );
define( 'LOGGED_IN_SALT',   'Iv ~G!16n%wd#R&w5()ISHW>4D ;GSpgRE0<ZN#Fpm)_WXY;Hs;D|b1zpS>6J4l^' );
define( 'NONCE_SALT',       '556.(V0{QjS^#OJG,5N8~VC`v_*(PLt&QXxYClIu(I mbLna+Lq`V@8M7a}3`]dG' );

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
