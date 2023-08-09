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
define( 'DB_NAME', getenv('DB_NAME') );

/** Database username */
define( 'DB_USER', getenv('DB_USER') );

/** Database password */
define( 'DB_PASSWORD', getenv('DB_PASSWORD') );

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
define('AUTH_KEY',         '_UXUMGliC+@,e/%|1.W*.q50a3vx.rGvb^`zN*YHUvO$L G?##Z2)UP^;WE,.A(X');
define('SECURE_AUTH_KEY',  'jbFcSSRH{xWNW:K| E1mAh.(lyjrmi,ofP/E<VC0gk +7]Wx-+s=|y]5tE=7 q,v');
define('LOGGED_IN_KEY',    '?a[&V(=Q&3$-UNE0q<WN7(.RdzX`l7FR`XgiC0H0G{*uUwsE*|vN7:0OQirNBD?Y');
define('NONCE_KEY',        '=s&N`bIwj@|?~W;Vh7=gg[d+!l>Mt>Xi}n9oe7vENu=}ds.88%YC`QdTH=qqIa[h');
define('AUTH_SALT',        'LlTx+N|X1W&<$9MJP-ni>,{`x @YN<uZ}Nj>-!|f8TfH|e~`+-cC^BzE=%`X|IcO');
define('SECURE_AUTH_SALT', '.Df&&+z4#c+R.-=Ppxr:u#%ansoL+0r6RFb;>FfQhJn:0nrQs+R!tG+,6)tH;YeX');
define('LOGGED_IN_SALT',   '4$$M8FCJ[Y][HHa%m`.y{0Qb$3&Gv&A&N+P%QAs+^ikwLg=k@etK|Yk7F(t9:aF_');
define('NONCE_SALT',       '~8L|WEHAv0#|?^FN{)/P]C_<jaMp[vV8^H+VT/>c[%,]7ac%-QG@1vo5G6UR&1h{');

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

if ( ! defined( 'ABSPATH_REAL' ) ) {
    if (defined('__BPC__')) {
        define( 'ABSPATH_REAL', $_SERVER['DOCUMENT_ROOT'] . '/');
    } else {
        define( 'ABSPATH_REAL', ABSPATH);
    }
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
