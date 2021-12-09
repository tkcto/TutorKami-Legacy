<?php 
# LOAD GLOBAL CONFIG FILE #
require_once(dirname(__DIR__).'/admin/classes/config.php.inc');

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

define('DB_NAME', DBNAME);



/** MySQL database username */

define('DB_USER', DB_USER);



/** MySQL database password */

define('DB_PASSWORD', DB_PASS);



/** MySQL hostname */

define('DB_HOST', HOSTNAME);



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

define('AUTH_KEY',         'cO,-?ERMP5oU9W=Z^>e(6_gK)B#1uqgn<3@9bn7d&;=Nw{4}nINv=:.}g&8~1A23');

define('SECURE_AUTH_KEY',  'KCvSH* a >qHcgHJHQKU2RV~jko{WpK^yNdW*E5_Jm{aB8/Xa&k}_ZV4}rwDx1dr');

define('LOGGED_IN_KEY',    'eeg^:Dj?ncZ]thHrJ_-QL3MMRCl|=jNj/r1([xGVgWliv-gv>P.$8m1^<;4&5+bZ');

define('NONCE_KEY',        '<,2jF;Dec3$S=iyK}yRzCq~<u3hCql75cmQ/mvJZ:pzF}m:/M.Qm-~<L/NItt5pl');

define('AUTH_SALT',        't-x:6@v.?0$/=N4~:{>eGuGHXh=bvo2K+pQ6y`2c,1VCz/BgHiV`xo,O}=AloCt}');

define('SECURE_AUTH_SALT', '48/?=dqOPGLoax!;h3y8;?lu-mn.rJqcs{*{MI^1 Biua&hKJ>!oOTJ1M|@6#pfZ');

define('LOGGED_IN_SALT',   '1*[,dpg9;V3QAu>uqA7s7T& !w<t|=nM~F!;r8vg{Z~{Xmb.gpqegLP]<23.+!-5');

define('NONCE_SALT',       '#-hxEs9@WcJ8~cM0My*GU/V)K@&O.{QFTDQKKN[O/dC@MV:jZ#ZkHx24W:s &)0*');



/**#@-*/



/**

 * WordPress Database Table prefix.

 *

 * You can have multiple installations in one database if you give each

 * a unique prefix. Only numbers, letters, and underscores please!

 */

$table_prefix  = 'tk_wp_';



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

