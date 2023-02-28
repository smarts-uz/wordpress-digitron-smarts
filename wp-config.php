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
define( 'DB_NAME', 'smarts' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '' );

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
define( 'AUTH_KEY',         '4[8b)|Qn,Z/]b[BE=j0wJkr72d:,)rDY(fZ<&=bWjXs_`8)MnTA{j5U61U+qCXAC' );
define( 'SECURE_AUTH_KEY',  '&lDEP>o!p$akg2*fB1 Oqhr>9b?=N1.$m~9}`J/Z1[:sNUDHmrrN-b1h}d#^EZ^-' );
define( 'LOGGED_IN_KEY',    'BC2/{=]9?MMBlbKH4_CY%`x-h=~zRG9]V* 4Q5=3vG5`qe~Zl`sGf/TF*<[28T5m' );
define( 'NONCE_KEY',        '^M^P+~A_I&*tpE<3 O0i 3nq||yyL%5@K>CN@Y9qV},E6Z^}6!$=^u:)#g_SUEF=' );
define( 'AUTH_SALT',        'CN-lbU_~lRCJ8C^; t;r )$J^ufNJpGffW#FWT$HCAn$7# EgN>06Y-C.nsuQt#$' );
define( 'SECURE_AUTH_SALT', '63is`>Vs6MDck/@7C:ET]u22kJ n3V{/5BoG5u>#h5vRxlZ[YtVCX}?^yv,<+:(T' );
define( 'LOGGED_IN_SALT',   ' D}+ v%rtQZbShi_F9Kl5a42{<>mEWjFq9u9]ELu,e^=Aw#;/+6s.m;r,JfvGFU5' );
define( 'NONCE_SALT',       'h XFO}cx;nTlsUJ( aRO:V7R&.!YlbQH^db*H!5N1Ob[n=Ll5@)JR%<UX=C*ZFL`' );

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
