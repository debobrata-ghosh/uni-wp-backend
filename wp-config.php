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
define( 'DB_NAME', 'unitek-rebuild' );

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
define( 'AUTH_KEY',         '7m&3Ss&9(MkiDCU)?68<U~gK;N~,-@FB2o8F!C2{o(<<r8U8<q8Unh5=Y])D/O~E' );
define( 'SECURE_AUTH_KEY',  '{&;&*dUN(sOjvk}_e^uvPoU4IUv2V{Z,A=eVy}`|(P~qtXQi^RaV-Kt15jDUfyl;' );
define( 'LOGGED_IN_KEY',    '#!i6/5^Fb^?I.%{;sD[H`Z[iEI (-64$EpLtS3=fsmq) ^ptV#$x^EoMo(hrl*U(' );
define( 'NONCE_KEY',        'b]m`SqfMukv}@?OXkyiN<x:MFoko8NDEitOjU5!3HwxB~Fy>Z&nxkvR{VYG~tFY9' );
define( 'AUTH_SALT',        'c=Q@eMj{c2zk9R0hth;ag[xCL~<n^>zYv;Q;K?yH<8;(vM-|b,&STT<lu#*d k/j' );
define( 'SECURE_AUTH_SALT', 'x@,A]>VL&B:ZJygax4/J9<%u!),e1:J(M+3Q4qkRqi+Z3KOXSiPK6n%{3~exH%c:' );
define( 'LOGGED_IN_SALT',   'z%4<%;sE5=tH#,~)UJ~KQ5&nmwu99y4yuG_,@D ~]EEsuB;p5}ak)nA08[JUO:y9' );
define( 'NONCE_SALT',       'Y}p,%*x-#iIF4.sobEp`Qzx)dCx>AqNtc97-}%F&(V;}|&tUX3,rz!( u)Fp*(g?' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 *
 * At the installation time, database tables are created with the specified prefix.
 * Changing this value after WordPress is installed will make your site think
 * it has not been installed.
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/#table-prefix
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
define( 'WP_DEBUG', true );
define( 'WP_DEBUG_LOG', true );
define( 'WP_DEBUG_DISPLAY', false );
/* Add any custom values between this line and the "stop editing" line. */

define('FS_METHOD', 'direct');


/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
