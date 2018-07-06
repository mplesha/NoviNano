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
define('DB_NAME', 'mr');

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
define('AUTH_KEY',         '>C.6~;51_-W*G|MOm((G{cPAd>e54Q]btT&}rE4pb_jId<!W2JBo~S9u8Rqdue%a');
define('SECURE_AUTH_KEY',  '-Bi%c?=(y~|7G#dtF`?J.u0sN.N/J9R9!|r$IuZVc1{D{)nMU=xAZGT&U5x}eO:n');
define('LOGGED_IN_KEY',    't.*.U+grTIx(Z]TZ[+6={RzIy6Ntw3*5P>h6@5i/UrimZ:U$xn7ddnAe iE}%uE$');
define('NONCE_KEY',        '_-j5trAfo}>2Y%GDLKnkF]t_1.giziR{R-wwKw5<ntuOoEf6/`9(u(/Nq(ok_4Vb');
define('AUTH_SALT',        '1e`Rz@4WX=/a]9g&o+Ub s{p{GmIb)2Z$QxRd6k.HxEhSD GvCRC]y64ecD}uiUd');
define('SECURE_AUTH_SALT', ':SifrY7P2@t@J|r.9PGQnH?x%F?c4lj9vJA?.uidy:?R7Wlt3$fA4|LB^.Qdum;)');
define('LOGGED_IN_SALT',   'f7:IvdPh4-e`Ip/Q xbJy}@)t2e(`?bM,s;@CZTT<X%;S>~#><;B3hSAW]&F@4KE');
define('NONCE_SALT',       '0k/jP126Yhb6u$D#z:9Z5FF~2[NRzn:dECRLnzKwxu*i4w<Nd;2$W n|Jb{^akKx');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'localwp_';

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
