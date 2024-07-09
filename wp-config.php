<?php

    if (file_exists(__DIR__ . '/vendor/autoload.php')) {
        require_once __DIR__ . '/vendor/autoload.php';

        $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
        $dotenv->load();
    }

    if (!function_exists('env')) {
        function env($key, $default = '')
        {
            return !$_ENV[$key] ? $default : $_ENV[$key];
        }
    }

    if (!function_exists('config')) {
        function config(string $config_name)
        {
            $explode = explode('.', $config_name);
            $count = count($explode);

            $file = __DIR__ . '/config/' . $explode[0] . '.php';

            if (file_exists($file)) {
                $obj = (object)include($file);

                if ($count > 1) {
                    $property = $explode[1];

                    if ($count === 3) {
                        $second_obj = (object)$obj->$property;
                        $second_property = $explode[2];

                        return $second_obj->$second_property;
                    }

                    return $obj->$property;
                } else {
                    return $obj;
                }
            } else {
                return false;
            }
        }
    }

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

    define('WP_ENVIRONMENT_TYPE', config('wordpress.environment'));
    const ENVS = [
        'staging',
        'local'
    ];

    $site_url = config('wordpress.site_url');

    if (in_array(WP_ENVIRONMENT_TYPE, ENVS)) {
        // Get the server's IP address
        $server_ip = $_SERVER['SERVER_ADDR'];

        // Define your local IP address (replace this with your actual local IP)
        $local_ip = '127.0.0.1';

        $protocol = isset($_SERVER['HTTPS']) && strtolower($_SERVER['HTTPS']) == 'on' ? 'https' : 'http';
        $protocol .= '://';

        $domain = $protocol . config('wordpress.domain');

        if (WP_ENVIRONMENT_TYPE === 'local') {
            $site_url = $domain . '.local'; // Replace with your local site URL
        } else {
            $site_url = $domain . '.' . config('wordpress.staging_url'); // Replace with your staging site URL
        }
    }

    define('WP_HOME', $site_url);
    define('WP_SITEURL', $site_url);

// ** Database settings - You can get this info from your web host ** //
    /** The name of the database for WordPress */
    define('DB_NAME', config('database.name'));

    /** Database username */
    define('DB_USER', config('database.user'));

    /** Database password */
    define('DB_PASSWORD', config('database.password'));

    /** Database hostname */
    define('DB_HOST', config('database.host'));

    /** Database charset to use in creating database tables. */
    const DB_CHARSET = 'utf8';

    /** The database collate type. Don't change this if in doubt. */
    const DB_COLLATE = '';

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
    $table_prefix = config('database.prefix');


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
    if (!defined('WP_DEBUG')) {
        define('WP_DEBUG', config('wordpress.debug'));
    }


    define('AUTH_KEY', config('wordpress.auth.key'));
    define('SECURE_AUTH_KEY', config('wordpress.auth.secret'));
    define('LOGGED_IN_KEY', config('wordpress.logged_in'));
    define('NONCE_KEY', config('wordpress.nonce'));
    define('AUTH_SALT', config('wordpress.salt.key'));
    define('SECURE_AUTH_SALT', config('wordpress.salt.secret'));
    define('LOGGED_IN_SALT', config('wordpress.salt.logged_in'));
    define('NONCE_SALT', config('wordpress.salt.nonce'));
    define( 'WP_CACHE', true ); // Added by Hummingbird
    /* That's all, stop editing! Happy publishing. */

    /** Absolute path to the WordPress directory. */
    if (!defined('ABSPATH')) {
        define('ABSPATH', __DIR__ . '/');
    }

    /** Sets up WordPress vars and included files. */
    require_once ABSPATH . 'wp-settings.php';
