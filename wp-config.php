<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the website, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'wordpress' );

/** Database username */
define( 'DB_USER', 'vincent' );

/** Database password */
define( 'DB_PASSWORD', 'lolo' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'wQBzm^1u{2Qggv=BHk5l _0tnWj>yaV8e;/NJMndI/YCTjOe0?tt(TW.[.VBWa35' );
define( 'SECURE_AUTH_KEY',  'qYe+=&_[d@e#re6 narryv(Q$}u?Q;r(mAZ.bPF4Am)i&-sFdUbOpUY5^e+e]@l!' );
define( 'LOGGED_IN_KEY',    'yPP#|*Xm.fkhJXn-Y:a<,@j`h0qWFm?3G![BC/B.T>P[3r=aOk2B7</_yK5u90Kx' );
define( 'NONCE_KEY',        '&dHo21b )Do.,7!Qz7VsqM&A=Wd<#%|hhK]:XF~c?.Q^>.*p|g?[bh`25RoW=+L{' );
define( 'AUTH_SALT',        'qpmbG`Wp(U&[UStvH2~pfw5z&rbULjrO(B7V|SXVonOWB4T,m]uM1#`-rwV]QWXV' );
define( 'SECURE_AUTH_SALT', 'pL`m,+fi2sjF}QFud/=V0^EPY-b?tT@SQoHrwCF|WW97sM$$p1@b8 a;Y8`xSup!' );
define( 'LOGGED_IN_SALT',   'L1SsU(1oNN5QK1*4]0%t~Y]QYq&NwdN1!OK*(_ZB}=ankBRjl~gIQ*eDjYHHOndS' );
define( 'NONCE_SALT',       'jCVK6.Q!F*FJzS&lh^1`;;lo -w_{lwdA|8YTK}@JT|lPHEZBaR]H,R8{]c7ee!S' );
define('FS_METHOD', 'direct');
define( 'WP_DEBUG', true );
define( 'WP_DEBUG_LOG', true );
define( 'WP_DEBUG_DISPLAY', false );


/**#@-*/

/**
 * WordPress database table prefix.
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
 * @link https://developer.wordpress.org/advanced-administration/debug/debug-wordpress/
 */
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */

define('FORCE_SSL_ADMIN', true);
if (strpos($_SERVER['HTTP_X_FORWARDED_PROTO'], 'https') !== false)
    $_SERVER['HTTPS'] = 'on';

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
