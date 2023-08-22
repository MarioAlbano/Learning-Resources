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


define('AUTH_KEY',         'F88I0SZFD13LFd2BqAUZUz0miookmJJfIb4uHrfa7bQUMTNS6elsacHC/WFFxIfaexEszJ1H835Ov1+Bk2JEkA==');
define('SECURE_AUTH_KEY',  'hDLzdwD+IfwWutGPsXuxXoo9Nb3E2hTOr01vVjLNJOgc0/mXMu2GsW7Xl6Vo07rQsR1O4/wPGsd8WE931IYnrg==');
define('LOGGED_IN_KEY',    '2b5Apf0CSS6v6MF2SfZJEwLBuarl8kOe7MFEwFH9Y3Sb79yFp7eO0wV4Py8KWASXj0oNXugNfDVPG94xic3Abw==');
define('NONCE_KEY',        'ugtCnvcpOlzhm84nOX5C2xXYV5e7a9cEHnUbtcx72+0NkBWEr92h66W/XNhF5p8iJ7YKtPHTqpz8EQBPwPynNA==');
define('AUTH_SALT',        '4ai1g7xgQ9JSICASFpxRhuq2n9gSTvflcfYPyTFBSMEKVF9eO9XBofmYhaz47hWk+Wtud/xUQiDCtZTrjBJtvg==');
define('SECURE_AUTH_SALT', 'GUJq/2wGplW769PMmb5PXnusMFO3sXvXKuulimmb7o4Fs8tOasCMPoSHcNP4XNLc7EdZJ5DgdzoFFwNzkXhfew==');
define('LOGGED_IN_SALT',   'rZEpEUEREJXTAe7O7B/SGKyaoLCeAJ9cB8sdrkzCY1Xee2AkjtamQ7oi80m7NGupvk3Z06kq/JaaRASxANeEjw==');
define('NONCE_SALT',       '8z7J2bnT7JxP0EmJ8+w5Aw0W6qQ+6yLtzNsg0rszyhUAzgJJ/hYI0g8ivll8wwndkVvHdMuNE2P0sJ/Zl6c8KQ==');
define( 'WP_ENVIRONMENT_TYPE', 'local' );
/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
