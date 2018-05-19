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
define('DB_NAME', 'alowibdi_wp4');

/** MySQL database username */
define('DB_USER', 'alowibdi_wp4');

/** MySQL database password */
define('DB_PASSWORD', 'B[jXmoqdFVY9LjjG8S[98][0');

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
define('AUTH_KEY',         '7I4Gc5AiLrj40L0EAs4da4lAO9vqfGOltZG6I2tjKYkyoGN40ZIg9i8zZkXKplsJ');
define('SECURE_AUTH_KEY',  'trGQ3biN0WP8IGaszebZbwgBTiG0olCslV8B6tmPxVlKPcYDr47DB4QEHSZczNF7');
define('LOGGED_IN_KEY',    'iGubzWC97mVBRIX8wkxTMMMRrbZkfXcLSrdIdZpfcqlVMGyYOkzGAux1NZeUUfrs');
define('NONCE_KEY',        'gpGntsR456y3MO0F7ZelxYSmvhOpUjPofkG7G963a00FSnYACb0aKUVVqkOdivM5');
define('AUTH_SALT',        '3SJ2EcMPaGc71dE79TRSu4pdKJlfeSkPcST0UQyPuXFJIxefZqDnWhCuFyiShcPy');
define('SECURE_AUTH_SALT', 'PQkIR6J9La3MEqDFxqZ0lSSObLojCbqhVc7EjoQ3wufaMpirMh8tX4zILQGJAE6K');
define('LOGGED_IN_SALT',   'HHADcHlrC1gckraw6VC7chuGueAbzrZFjT0DjKVsRnsVVnOlMYW8nTy04nuA0nAR');
define('NONCE_SALT',       'sSlWk1lGoDtgPv68nNzafXlMSzyN0E8aDCiyWRX5hjrovQ6rUv2uyTpob0A1Xi1m');

/**
 * Other customizations.
 */
define('FS_METHOD','direct');define('FS_CHMOD_DIR',0755);define('FS_CHMOD_FILE',0644);
define('WP_TEMP_DIR',dirname(__FILE__).'/wp-content/uploads');

/**
 * Turn off automatic updates since these are managed upstream.
 */
define('AUTOMATIC_UPDATER_DISABLED', true);


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
