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
define('DB_NAME', 'nk');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

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
define('AUTH_KEY',         'o,Y5V|tVKY0Wd8ooavVfCjectdy7iTh:_qdh=73jr+WNH,5f;kkmuTKm!Zx^YL6S');
define('SECURE_AUTH_KEY',  'L>b]Ml?2As-ZrjIz0aVEow9f^i:87%i)6Md8XYjj7wcq;Zin|nI(?^d(H_&3]&PA');
define('LOGGED_IN_KEY',    ':H7P`mpVMeeOoSHz_KjFRWWIm9j]k#M3ZNt,n<H5T(Lydg#T)T[eSDVr*`VTt#+~');
define('NONCE_KEY',        't&2g;p1u>H3i~kU$.pX;q7Z7_G_p[NVa{Lk7IL|J Me?yhR`gKc*^:2,{7v{ A~y');
define('AUTH_SALT',        'o:&i9~c&_%+@vW9MUsR?&0o2 kz<$(x[.OF/JAj6A~E>?kDw7%m27/A//%l?|$T4');
define('SECURE_AUTH_SALT', 'k<1W}|{-yTP0D;/Bj98v{}%.(r$MAJf*dme$yn5dTT|w/u(f17244iM>a#ktV#R ');
define('LOGGED_IN_SALT',   'BUU3eXl1f _{h[,50cv^h}5a`s:]JzHK`%Kn:gkhsOpZ$_()6Q4]1UL67[vZ^L01');
define('NONCE_SALT',       'YQfY?A%EsfVs2KFGEAVB75TdR&,L/ EXu#1]ivuH;/2aJ7$yZQ<F9$O_#QmssT~0');

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
