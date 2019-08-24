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
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'ai4atm' );

/** MySQL database username */
define( 'DB_USER', 'ai4atm' );

/** MySQL database password */
define( 'DB_PASSWORD', 'ai4atm' );

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
define( 'AUTH_KEY',         'czD`4*jR563^E,&YNZ5i;$c:4o)uWv.sfdve7#sMDfI0NwwyOk&SE#g5/n@YJW_/' );
define( 'SECURE_AUTH_KEY',  'pHh(TA.OSc!etjDp{La-i8<f9ecK~-ONPlB.k*^SLx~NB).#$(LOxB0V&XT+6!K:' );
define( 'LOGGED_IN_KEY',    'gj%#G-.*TD,g!<$<O+U,C[y%83zxmv2tiB~rk^k,<VbT~{1cB4ZT!Yu=NUygjr@]' );
define( 'NONCE_KEY',        'MInzJ@L{~e$.tzZD*dec3(~+K@UGrl),v*m@t~!0JsRe4EPFnS]AbK``Ux4YF(/o' );
define( 'AUTH_SALT',        '$Zk=|K~?L3%_e>X?6g`YqKB$~zpc_E#Y-:Z+LW3z5|rSfL%PpSm=,8/4lUa4Uh{p' );
define( 'SECURE_AUTH_SALT', '2<}]OOu@Oz#kV>~Wz9$M%:Mt;_GSe{B3xX4]Ttt&r=SN-#s)8CkoW%KzFgC1p&@2' );
define( 'LOGGED_IN_SALT',   'SfNx[9K-roBS_g<%bjR(A:uaJGpA3~te17</y8B.[%00Bbrz:k@?c|xbGgtmQeq?' );
define( 'NONCE_SALT',       'z-fCHf$.6K>4(=Nj>PyO5n> K:eK#BP(}vBT.(W+X,fiT/,es5!BRLOi1WH~^ZPl' );

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'ai4atm_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define( 'WP_DEBUG', false );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once( ABSPATH . 'wp-settings.php' );
