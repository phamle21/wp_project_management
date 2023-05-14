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
 * @link https://wordpress.org/documentation/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'manage_project' );

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
define( 'AUTH_KEY',         ',yr]-& ;ehYRO##^Iwp]K(NQZqp?*Im)oGEgpkY<K`.W=U2HrMHcIcc/o~hi/Ker' );
define( 'SECURE_AUTH_KEY',  'K+fVPs>BYr%XP&w4y]XX5(s}4<#23eNKn&iMiNCe~O0K@<k;jVj=W3fCs]ok=JI$' );
define( 'LOGGED_IN_KEY',    '%[mD9_7|;Q4fe?EtqC:p{w%R|,3stM`2$@FJ8YS27)KqZ_(x;GyF<QEMaX>yuHr,' );
define( 'NONCE_KEY',        'pt<z:%3^H1R,Tob-M5]KclR:0Ye1e]}NJ0;>R5WjXZ91JMpngbwALu58n.x5YyUV' );
define( 'AUTH_SALT',        'fQ{$4cXEQipwgR1iU*tsnMrZV.16fkw(K(8k`B^[~s_?:p(gSEWuW9uAVkH:PF6n' );
define( 'SECURE_AUTH_SALT', '6`hA]KhvEKZ o[m)r(Q`]!QmKCEm8Gbc_J9Lq^o}edwjR4TS][<TlvCF6cPH;VO+' );
define( 'LOGGED_IN_SALT',   'vM%^IUtkOQ5zK&}C^fLd5!l,O:imf;Ne4FCGolCo4T.cS}pT,p_&wo.tD_2#y{0f' );
define( 'NONCE_SALT',       'lWKf1?X7HS+F2W;IF8]Fm0`?[{k2hnwzD4Cvi0+kx!<xyPD=w.-v|md.M,.uoPcJ' );

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
 * @link https://wordpress.org/documentation/article/debugging-in-wordpress/
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
