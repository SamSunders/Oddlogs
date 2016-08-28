<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, WordPress Language, and ABSPATH. You can find more information
 * by visiting {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'oddlogsc_wrd1');

/** MySQL database username */
define('DB_USER', 'oddlogsc_wrd1');

/** MySQL database password */
define('DB_PASSWORD', 'yneSqiyTpl');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

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
define('AUTH_KEY',         'eIw3dHnrvOTnqyZG779YXu0jWmJyjNeTIqgHp75fDo5JwTNKv8XOnrMlAIecfu9U');
define('SECURE_AUTH_KEY',  'lhIkVGT7zPSJyZTPKesM31U7pc1xHYMq0shyKPOiizPyIXwtDNERaEc8gp2yWdY6');
define('LOGGED_IN_KEY',    'WSm2h1WrAdvCMpO7kYLB4cPgxAY3EhNmFhOERugFYwPajVjTyq55RXixUAYPliMV');
define('NONCE_KEY',        'QLXfzamR5if2R0kcXmnJOrT8Q29Z2PrXOjXFXKGrqQ3wiDctW0h8G8eGKAhTOxY2');
define('AUTH_SALT',        '5qWqai9vCcwtn6n3j0OapjoDbZXkIcUUt2itVwBHLUodxqogEfJDAtuHpu5jfmLZ');
define('SECURE_AUTH_SALT', 'T9bsilZwGCWbGGaeWBNxEalceQXSNJIzSiwlLRsUnpFSOE6odvmWdQVY75aLxRaT');
define('LOGGED_IN_SALT',   'DZXQ2ClhZIYayiknEKjI3f5Rlfmn5wWaHXI07NYtElVKMbfHYdZnahilCIKgAmYC');
define('NONCE_SALT',       'jNNSig1swdC4xbgPTjrawjgNQeaG8kVpz80fzSfoXuwn1DICneZ1TaOhZvfgtvN6');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * WordPress Localized Language, defaults to English.
 *
 * Change this to localize WordPress. A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de_DE.mo to wp-content/languages and set WPLANG to 'de_DE' to enable German
 * language support.
 */
define('WPLANG', '');

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
