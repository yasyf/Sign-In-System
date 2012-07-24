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
define('DB_NAME', 'signin_wp');

/** MySQL database username */
define('DB_USER', 'signin_wp');

/** MySQL database password */
define('DB_PASSWORD', 'HJ9dFt52OFs0WLpYr');

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
define('AUTH_KEY',         '0Y{_FCec>{91O8t56H9-Y<.mC;.Nut*}saSH`M0$U|/|A|_i90`!.T[>CCl UGg0');
define('SECURE_AUTH_KEY',  '}0K?^r-`Z%NV_D|Nka?Kifi@y8-mXv<a3G%~96X,kUe&|n%UeZ]AHZih0LI*g*nG');
define('LOGGED_IN_KEY',    '6q|,Ao}D/Ar&2St^)>Ao0)yawH3P!)lSZ-cbMD,d`vhat(kW_n*{x|pkN:EJe6)a');
define('NONCE_KEY',        '$*-:;KOefE6[B YrDBqh8wm5!-4[dY5XG^i4r/J=V#65=o#pLJ/@j2n{@)ZcIR+m');
define('AUTH_SALT',        'ua)]_[?&|E3t{8CRAOK%Y(UT!|jGN|~i)2UQ(l!q!nRA$obtUO6d?WCF_(%l9*Ed');
define('SECURE_AUTH_SALT', 's;#ufK!3;L>O-+tfrv<S%~X)4Pl@a6eAnB|$L?`=@lY/!|~rB#qKL>rV+5=a,R6>');
define('LOGGED_IN_SALT',   '(@N|+4l^]8j|Q9UnjT`DSKnilxpP ?:Xh*>OaWj*@R.f/Hnf.r^n>&B;P|r>t:6U');
define('NONCE_SALT',       '[kIh+94P/nheWpL&K|%|iQ,R1xZL2AR2&|xECPA86U9|fwlLrkG3+| S[K3Xl2 T');

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
