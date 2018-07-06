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
define('DB_NAME', 'rs');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');
define('FS_METHOD', 'direct');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'HY|gomXj)&N&$u5}t~&-7IB5Tq-^m ^E:q)ldYB%>9!$y|-9|iefoAs/-t~^,3m|');
define('SECURE_AUTH_KEY',  '[-w< 7@QEyI(gD39frnlL!7,-o.jJ#0E}gw[]qoB8%s3reUsi Rpsn]|Wop~RG1V');
define('LOGGED_IN_KEY',    '%s#^iDo/HYWms~&HPVK /}eBs+6qiQx^.}!:==<=$a@xM^[qyps&dU,h+:jE.P_Z');
define('NONCE_KEY',        'S2x^5E4t,)&Kku?%B+eh C wFcKh`oz~@6+~gG; `/8j;-/2Erp U~X?{nV|?_YX');
define('AUTH_SALT',        'J+gIF?2ruG}LOMT5FiU>(tM;-FDhXk1Qw}bl-/`@/Isn.@l8fP 5D/EJ1xa8 Ju2');
define('SECURE_AUTH_SALT', 'F$z(H}0)o8x3:.Rv D]e+yvE|0a-FL*kMIS@?hFW.mNFL]0+4<<j+6<p-bi;|<B|');
define('LOGGED_IN_SALT',   '5%%<9&xh`2wEe)K`O$|.?QM1z4dfw|H@S*@Xi}W$>VJ[-|@#Yf6n+2];^w-5(aAA');
define('NONCE_SALT',       '$#yIWU7aD+DP,z4uRpJ0DBMiC?yS]{M!>}:Sj+[Kka+=(hv+Kjb(E)kp[myQgi)H');

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



