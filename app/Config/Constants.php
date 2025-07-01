<?php

//--------------------------------------------------------------------
// App Namespace
//--------------------------------------------------------------------
// This defines the default Namespace that is used throughout
// CodeIgniter to refer to the Application directory. Change
// this value to change the namespace that all application
// classes should use.
//
// NOTE: changing this will require manually modifying the
// existing namespaces of App\* namespaced classes.
defined('APP_NAMESPACE') || define('APP_NAMESPACE', 'App');

/*
 |--------------------------------------------------------------------------
 | Composer Path
 |--------------------------------------------------------------------------
 |
 | The path that Composer's autoload file is expected to live. By default,
 | the vendor folder is in the Root directory, but you can customize that here.
 */
defined('COMPOSER_PATH') || define('COMPOSER_PATH', ROOTPATH . 'vendor/autoload.php');

/*
 |--------------------------------------------------------------------------
 | Timing Constants
 |--------------------------------------------------------------------------
 |
 | Provide simple ways to work with the myriad of PHP functions that
 | require information to be expressed in seconds.
 */
defined('SECOND') || define('SECOND', 1);
defined('MINUTE') || define('MINUTE', 60);
defined('HOUR')   || define('HOUR', 3600);
defined('DAY')    || define('DAY', 86400);
defined('WEEK')   || define('WEEK', 604800);
defined('MONTH')  || define('MONTH', 2592000);
defined('YEAR')   || define('YEAR', 31536000);
defined('DECADE') || define('DECADE', 315360000);

/*
 |--------------------------------------------------------------------------
 | Exit Status Codes
 |--------------------------------------------------------------------------
 |
 | Used to indicate the conditions under which the script is exit()ing.
 | While there is no universal standard for error codes, there are some
 | broad conventions.  Three such conventions are mentioned below, for
 | those who wish to make use of them.  The CodeIgniter defaults were
 | chosen for the least overlap with these conventions, while still
 | leaving room for others to be defined in future versions and user
 | applications.
 |
 | The three main conventions used for determining exit status codes
 | are as follows:
 |
 |    Standard C/C++ Library (stdlibc):
 |       http://www.gnu.org/software/libc/manual/html_node/Exit-Status.html
 |       (This link also contains other GNU-specific conventions)
 |    BSD sysexits.h:
 |       http://www.gsp.com/cgi-bin/man.cgi?section=3&topic=sysexits
 |    Bash scripting:
 |       http://tldp.org/LDP/abs/html/exitcodes.html
 |
 */
defined('EXIT_SUCCESS')        || define('EXIT_SUCCESS', 0); // no errors
defined('EXIT_ERROR')          || define('EXIT_ERROR', 1); // generic error
defined('EXIT_CONFIG')         || define('EXIT_CONFIG', 3); // configuration error
defined('EXIT_UNKNOWN_FILE')   || define('EXIT_UNKNOWN_FILE', 4); // file not found
defined('EXIT_UNKNOWN_CLASS')  || define('EXIT_UNKNOWN_CLASS', 5); // unknown class
defined('EXIT_UNKNOWN_METHOD') || define('EXIT_UNKNOWN_METHOD', 6); // unknown class member
defined('EXIT_USER_INPUT')     || define('EXIT_USER_INPUT', 7); // invalid user input
defined('EXIT_DATABASE')       || define('EXIT_DATABASE', 8); // database error
defined('EXIT__AUTO_MIN')      || define('EXIT__AUTO_MIN', 9); // lowest automatically-assigned error code
defined('EXIT__AUTO_MAX')      || define('EXIT__AUTO_MAX', 125); // highest automatically-assigned error code

/**
 * @deprecated Use `EXIT_SUCCESS` instead.
 */
define('EXIT_OK', EXIT_SUCCESS);

/**
 * @deprecated Use `EXIT_ERROR` instead.
 */
define('EXIT_GENERAL_ERROR', EXIT_ERROR);

// Ensure FCPATH, APPPATH, WRITEPATH, ROOTPATH are defined if not already.
// These are typically set by the bootstrap process in a full CI4 environment.
// We define them here as a fallback for our manual setup.
if (! defined('FCPATH')) {
    define('FCPATH', rtrim(realpath(dirname(__DIR__, 2) . '/public') ?: dirname(__DIR__, 2) . '/public', '/ ') . '/');
}
if (! defined('APPPATH')) {
    define('APPPATH', rtrim(realpath(dirname(__DIR__)) ?: dirname(__DIR__), '/ ') . '/');
}
if (! defined('WRITEPATH')) {
    define('WRITEPATH', rtrim(realpath(dirname(__DIR__, 2) . '/writable') ?: dirname(__DIR__, 2) . '/writable', '/ ') . '/');
}
if (! defined('ROOTPATH')) {
    define('ROOTPATH', rtrim(realpath(dirname(__DIR__, 2)) ?: dirname(__DIR__, 2), '/ ') . '/');
}
// Ensure SYSTEMPATH is defined for basic functionality
if (! defined('SYSTEMPATH')) {
    // This is a simplified path. In a real CI4 install, it points to vendor/codeigniter4/framework/system
    define('SYSTEMPATH', ROOTPATH . 'vendor/codeigniter4/framework/system/');
}

// Define ENVIRONMENT if not set (typical values: development, testing, production)
defined('ENVIRONMENT') || define('ENVIRONMENT', 'development');

// Base URL (should be set in .env or App.php)
// defined('BASEURL') || define('BASEURL', 'http://localhost:8080/');

// Path to the front controller (this file)
defined('SPARK_PATH') || define('SPARK_PATH', ROOTPATH . 'spark');
defined('TESTPATH')   || define('TESTPATH', ROOTPATH . 'tests/');

// Common directory names
define('CONFIGPATH', APPPATH . 'Config/');
define('DATABASEPATH', APPPATH . 'Database/');
define('VIEWPATH', APPPATH . 'Views/');
define('HELPERPATH', APPPATH . 'Helpers/');
define('LIBRARYPATH', APPPATH . 'Libraries/');
define('MODELPATH', APPPATH . 'Models/');
define('CONTROLLERPATH', APPPATH . 'Controllers/');
define('LANGPATH', APPPATH . 'Language/');
define('THIRDPARTYPATH', APPPATH . 'ThirdParty/');

// Other common paths
define('PUBLICPATH', FCPATH);
define('SUPPORTPATH', SYSTEMPATH . 'Support/');
define('SESSIONPATH', WRITEPATH . 'session/');
define('LOGPATH', WRITEPATH . 'logs/');
define('CACHEPATH', WRITEPATH . 'cache/');
define('DEBUGTOOLPATH', WRITEPATH . 'debugbar/');
define('UPLOADPATH', WRITEPATH . 'uploads/');
define('SHORTHANDSPATH', SYSTEMPATH . 'Helpers/');
define('FILTERSPATH', APPPATH . 'Filters/');
define('COMMANDSPATH', APPPATH . 'Commands/');
define('VALIDATIONPATH', APPPATH . 'Validation/');
define('ROUTEPATH', APPPATH . 'Config/Routes.php');

//--------------------------------------------------------------------
// Debug Toolbar
//--------------------------------------------------------------------
// If true, the debug toolbar will be displayed.
defined('SHOW_DEBUG_TOOLBAR') || define('SHOW_DEBUG_TOOLBAR', ENVIRONMENT === 'development');
// If true so the debug toolbar will collect benchmark data.
defined('COLLECT_BENCHMARKS') || define('COLLECT_BENCHMARKS', ENVIRONMENT === 'development');

//--------------------------------------------------------------------
// Error Handling
//--------------------------------------------------------------------
// If true, then errors will be displayed rather than logged.
defined('DISPLAY_ERRORS') || define('DISPLAY_ERRORS', ENVIRONMENT === 'development');

//--------------------------------------------------------------------
// Logging Threshold
//--------------------------------------------------------------------
// Threshold for logging. 0 = Disables logging, 4 = All errors.
// For more info, see https://codeigniter.com/user_guide/general/errors.html
defined('LOG_THRESHOLD') || define('LOG_THRESHOLD', (ENVIRONMENT === 'development' ? 4 : 0));

//--------------------------------------------------------------------
// Cache Path
//--------------------------------------------------------------------
// The path to the writable directory where cache files are stored.
defined('CACHE_PATH') || define('CACHE_PATH', WRITEPATH . 'cache/');

//--------------------------------------------------------------------
// Encryption Key
//--------------------------------------------------------------------
// Predefined encryption key for testing purposes.
// For production, use a secure random key and store it in .env
defined('APP_KEY') || define('APP_KEY', 'your-32-character-random-string-here');

//--------------------------------------------------------------------
// Cookie Settings
//--------------------------------------------------------------------
defined('COOKIE_PREFIX')   || define('COOKIE_PREFIX', '');
defined('COOKIE_DOMAIN')   || define('COOKIE_DOMAIN', '');
defined('COOKIE_PATH')     || define('COOKIE_PATH', '/');
defined('COOKIE_SECURE')   || define('COOKIE_SECURE', false);
defined('COOKIE_HTTPONLY') || define('COOKIE_HTTPONLY', true);
defined('COOKIE_SAMESITE') || define('COOKIE_SAMESITE', 'Lax'); // None, Lax, Strict

//--------------------------------------------------------------------
// CSRF Settings
//--------------------------------------------------------------------
defined('CSRF_PROTECTION') || define('CSRF_PROTECTION', true);
defined('CSRF_TOKEN_NAME') || define('CSRF_TOKEN_NAME', 'csrf_test_name');
defined('CSRF_COOKIE_NAME')|| define('CSRF_COOKIE_NAME', 'csrf_cookie_name');
defined('CSRF_EXPIRE')     || define('CSRF_EXPIRE', 7200);
defined('CSRF_REGENERATE') || define('CSRF_REGENERATE', true);
defined('CSRF_REDIRECT')   || define('CSRF_REDIRECT', false);
defined('CSRF_SAMESITE')   || define('CSRF_SAMESITE', 'Lax');

//--------------------------------------------------------------------
// HTTP Status Codes
//--------------------------------------------------------------------
defined('HTTP_OK')                    || define('HTTP_OK', 200);
defined('HTTP_CREATED')               || define('HTTP_CREATED', 201);
defined('HTTP_NO_CONTENT')            || define('HTTP_NO_CONTENT', 204);
defined('HTTP_BAD_REQUEST')           || define('HTTP_BAD_REQUEST', 400);
defined('HTTP_UNAUTHORIZED')          || define('HTTP_UNAUTHORIZED', 401);
defined('HTTP_FORBIDDEN')             || define('HTTP_FORBIDDEN', 403);
defined('HTTP_NOT_FOUND')             || define('HTTP_NOT_FOUND', 404);
defined('HTTP_METHOD_NOT_ALLOWED')    || define('HTTP_METHOD_NOT_ALLOWED', 405);
defined('HTTP_CONFLICT')              || define('HTTP_CONFLICT', 409);
defined('HTTP_TOO_MANY_REQUESTS')     || define('HTTP_TOO_MANY_REQUESTS', 429);
defined('HTTP_INTERNAL_SERVER_ERROR') || define('HTTP_INTERNAL_SERVER_ERROR', 500);
defined('HTTP_SERVICE_UNAVAILABLE')   || define('HTTP_SERVICE_UNAVAILABLE', 503);

//--------------------------------------------------------------------
// Database
//--------------------------------------------------------------------
defined('DB_DRIVER')   || define('DB_DRIVER', 'MySQLi');
defined('DB_HOSTNAME') || define('DB_HOSTNAME', 'localhost');
defined('DB_USERNAME') || define('DB_USERNAME', 'root');
defined('DB_PASSWORD') || define('DB_PASSWORD', '');
defined('DB_DATABASE') || define('DB_DATABASE', 'myigniterapp');
defined('DB_PORT')     || define('DB_PORT', 3306);
defined('DB_PREFIX')   || define('DB_PREFIX', '');
defined('DB_CHARSET')  || define('DB_CHARSET', 'utf8');
defined('DB_COLLATION')|| define('DB_COLLATION', 'utf8_general_ci');

//--------------------------------------------------------------------
// Session
//--------------------------------------------------------------------
defined('SESSION_DRIVER')           || define('SESSION_DRIVER', 'CodeIgniter\Session\Handlers\FileHandler');
defined('SESSION_COOKIE_NAME')      || define('SESSION_COOKIE_NAME', 'ci_session');
defined('SESSION_EXPIRATION')       || define('SESSION_EXPIRATION', 7200);
defined('SESSION_SAVE_PATH')        || define('SESSION_SAVE_PATH', WRITEPATH . 'session');
defined('SESSION_MATCH_IP')         || define('SESSION_MATCH_IP', false);
defined('SESSION_TIME_TO_UPDATE')   || define('SESSION_TIME_TO_UPDATE', 300);
defined('SESSION_REGENERATE_DESTROY')|| define('SESSION_REGENERATE_DESTROY', false);

//--------------------------------------------------------------------
// Timezone
//--------------------------------------------------------------------
defined('APP_TIMEZONE') || define('APP_TIMEZONE', 'UTC');

//--------------------------------------------------------------------
// Locale
//--------------------------------------------------------------------
defined('APP_DEFAULT_LOCALE') || define('APP_DEFAULT_LOCALE', 'en');

//--------------------------------------------------------------------
// Paths
//--------------------------------------------------------------------
// Path to the system directory.
// defined('SYSTEMPATH') || define('SYSTEMPATH', FCPATH . '../system/'); // This would be for CI3 style

// Path to the application directory.
// defined('APPPATH') || define('APPPATH', FCPATH . '../app/');

// Path to the writable directory.
// defined('WRITEPATH') || define('WRITEPATH', FCPATH . '../writable/');

// Path to the tests directory.
// defined('TESTSPATH') || define('TESTSPATH', FCPATH . '../tests/');
?>
