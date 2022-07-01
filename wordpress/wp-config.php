<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'wordpress' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '123456' );

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
define( 'AUTH_KEY',         '[>XYIrTud{C{+z9zC=VK`[)Hpg.D*q_{y3cJO#-)#gt]a0>io]wGBaFOHitH/c34' );
define( 'SECURE_AUTH_KEY',  'On-Rv./Y~VVDLKbQQ#ywc@{h.-jFAs_2B/XN@J}Nhzpbg0a=n7Zj-!w5OLv$>C(!' );
define( 'LOGGED_IN_KEY',    '.om%fdEGx,/)B/Q*ju[@Bd.M dOLe<bPf+yZd9RGo A!i]w`Gg.CL_9I<<ur.a47' );
define( 'NONCE_KEY',        'ZZ%G sc*W=Ph!]lPs: MW>>c dB$ofT_cs;fM:SGcabfzffsG~%HJf4#-MYB<H>L' );
define( 'AUTH_SALT',        'yqmLttR}!wb:naq1Y Aqf16?sfv#V9>9>DQICY}P9r)*T<.n89RUj^p66Fkf?CRx' );
define( 'SECURE_AUTH_SALT', 'spEr9}m?(l=!y)(w{ae)M^B}5]mqBel3MF|q+f3Li#/ Mw.6V4L~XZ<FeNt^x:I*' );
define( 'LOGGED_IN_SALT',   'r@v~?oNYBt^A&E%^$@aBzcF;iEAdYN?%uL-uhQe6Gv#s4} >H*L@dRPIM7,E``a,' );
define( 'NONCE_SALT',       'A27(K=|X{)CD(.O`HoEbuD%+C?$O7cE%T;mt]u*oyjVjQ*%;Mr-X2aLK8on`xF=_' );

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
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
