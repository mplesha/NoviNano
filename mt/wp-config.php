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
define('DB_NAME', 'mt');

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
define('AUTH_KEY',         '4I.1v0(22*>aj#kbrEK.pc}-zP%9]793%2Z^j#sazJu0%U@uP|&CO$5* |-[C:Wn');
define('SECURE_AUTH_KEY',  'nU?KR1aAL7.nuh!kLw-KA#cUrqu>nA?mZ5^G90*%cuf=%%fe/YdjL_E|0ynm;c1)');
define('LOGGED_IN_KEY',    'wRs#rU0wBQ?d#pv8-X8TU30$PmMn8J%.@_%`TV_?OWcq)|SrXmS0|kT/$xbe<1fm');
define('NONCE_KEY',        '_Qw$dg6Fv)x/0R0FIMeEP|]dj=fCK/(w|jJei]Dia|5m)~SDax9FIpeZ]Qo^3VLx');
define('AUTH_SALT',        '8gy;If!`#xnD.T{.<n)Jc>sAyhXWi~RH(*iCfBM@P&dqK^wXrp>f<c/7>^nFDFH!');
define('SECURE_AUTH_SALT', 'c(,+iEXmbR|LMIba3@T!L8&!mrji[DR!)7=X0GFXl}3/|:~Xbjpp48feuTy .ebs');
define('LOGGED_IN_SALT',   'LFs@mRkP`AFN8AjIh?u1A#113dr#Ok[0^)ait=`930~lWCUkC9E@^DKjBFT(C=4^');
define('NONCE_SALT',       'N,@58$y Pi%Z&oKGjW,23S~5zvCJ##t7Z_Za1Of0-_)WW@V.6nd8,/!p$(p%JQ`)');

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
