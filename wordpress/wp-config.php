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
define('WP_CACHE', true);
define( 'WPCACHEHOME', '/Applications/MAMP/htdocs/wp-content/plugins/wp-super-cache/' );
define('DB_NAME', 'wordpress');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'root');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'dt9T>xhdQzBIob(+ntabs0/UHG7:-hS(P@/,pxfVU8= /&+9JTR6WH=U7gO5a}Wa');
define('SECURE_AUTH_KEY',  'H`EUKi,imyH2<IyV[|L/@d88i{b!,`5CwHui!|1_.DLh79GC9/hbl5.&L3(OiY/g');
define('LOGGED_IN_KEY',    'WKPCb,kQ*:-L(pv{uT+_E}:[N_C$!:%,Q-%VigCLEki)Gvu&?>(/Z,0H9hxjFes`');
define('NONCE_KEY',        '9@Yg-VtBe7@5a5zS.3 @)+jgp)-PU#?Q:Y|hKi_kd4OcS;nY2S(a^N!~h$Aa[,,f');
define('AUTH_SALT',        'jiE&j2$GVD&m)bvkp ,sBj:HT2j!b0,K?mYI)tC~`iIuq<LOT_,^5!;sL,{TYuc_');
define('SECURE_AUTH_SALT', 'JbL(N|noSk*no7*H=^H+vo`~x?+0+V~k[G5lUHbSb/{F/;XR=@_JKCbph%%yck?1');
define('LOGGED_IN_SALT',   'L1I5%T6csdI%Th7q4[i!4G-gQBs%B21a{5`PP>X`}j!pvFbj@7<uSWCT^wNa>gcY');
define('NONCE_SALT',       '5&=R_hPfp~[K<UZSgqS(q$KRw_1h0hVf^Xw94if*W%^dyFUr:Loo_h*!Yj#_l!(Q');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

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
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
