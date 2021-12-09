<?php
/** Enable W3 Total Cache */
define('WP_CACHE', true); // Added by W3 Total Cache


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
define('DB_NAME', 'tutorka1_tutorkami_wp');

/** MySQL database username */
define('DB_USER', 'tutorka1_wp');

/** MySQL database password */
define('DB_PASSWORD', 'eFyVIRkzZP!?');

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
define('AUTH_KEY',         '24>?^cP^z4$3OAw9(%jmij]&*]8:REA11iBuz LP,2pnHyuedvY8l~uGetz${qeZ');
define('SECURE_AUTH_KEY',  'Ch*/9]_h($:;N5n$b0,L0A95COb]u.nFb9mG95kry8i=0rZv-:Ea5{Oh8p@c#9,U');
define('LOGGED_IN_KEY',    'BiS#rmr=Q1taTCHlI]>dOggI|kG!KMluTO<rzsd&3+Y[Zgj&E2){0)p^c5U1pS]k');
define('NONCE_KEY',        'jwaYa[t.eHH-[||y/wPa)<ckzW8#&S!=K> /&j[7y |3YjX)S[9_$zLLA3q8#Zy4');
define('AUTH_SALT',        'IGmx:7r.((^3EYu&%KxxQC}KWG$vXl5lF&.{F~kqP4.x.$xywq)5l[x)v-`K2R{[');
define('SECURE_AUTH_SALT', 'H|%Mx[HrB<d5>?L4!L`W?n.];Rq)M<Ev okxEa*)V8a:yc?[m$DW4ss5x373|:TX');
define('LOGGED_IN_SALT',   '9-L@lz^1p%jsa=[dkmw`(<7K%;2f5~tUrCoQ|lJ=h0$Ms|B.jnqP@nyXW.?#c5+B');
define('NONCE_SALT',       '7]P|^x[#s_&Z1Pw;LA4G*#bOwuClP[j,XXG?/OHm?LK]D t>R,|(18 O-m_Ew@Vu');

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
