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
 * * Localized language
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'local' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', 'root' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

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
define( 'AUTH_KEY',          'IPX{jaKfz%Rie+wLc66uOK] `:::;|MU?4aE06S63LQr}9LQ+9zo/4S o^)I%BBA' );
define( 'SECURE_AUTH_KEY',   '!78:9&@%[|SUF`qm0));uIq^54&UUQC*UyAnOt LN+nKls-49+Fm/P7q]dd8lpn!' );
define( 'LOGGED_IN_KEY',     '[CQaa!3Hvb)p0YRH<~_[#=mW[w+&#K}!bd3N&v)%+]9X/tk7lZA0kXm4J$P[3Q[y' );
define( 'NONCE_KEY',         'Zxhj2$hKlW,N5D<WvVk~;6D6}vCu7<S@qoD[c3UpP0qXl8KD3<C5C@.vqG8K4N?B' );
define( 'AUTH_SALT',         'Mej&J[p5K~1AvZ+]c?M`u;vAa#O}kE.3IR,XElS-y=fj0iNGL|B$iW:x)CrF;a&,' );
define( 'SECURE_AUTH_SALT',  'XH[^qb]u9%=NlgkYBum4otrC*OmgVEkmUZ|pNILTk$o6|>-ZNZ&%KlQb.BPFN1}H' );
define( 'LOGGED_IN_SALT',    '?WN@B{Y<onF:}ZMqh}HM|YaO#b[z8iG?4Z/y6!85|hV*ED) 6aEW3a-i6P:bw*PP' );
define( 'NONCE_SALT',        'LgB#c8+:yJ%72Tkqwlq[nf]h3_Ht,(wMKlz[[:|RDWYXni{|{KK!uligM Ea@zw#' );
define( 'WP_CACHE_KEY_SALT', '$`Kx~.E+u=Hq$1XBJ;HVTTiH+|jO6majnzK^_w8Ck+IP:S&@Z$c?MB)NXn1pVndi' );


/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';


/* Add any custom values between this line and the "stop editing" line. */



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
if ( ! defined( 'WP_DEBUG' ) ) {
	define( 'WP_DEBUG', false );
}

define( 'WP_ENVIRONMENT_TYPE', 'local' );
/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
