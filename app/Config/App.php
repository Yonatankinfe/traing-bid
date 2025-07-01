<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

class App extends BaseConfig
{
    public string $baseURL = 'http://localhost:8080/'; // Adjust as needed
    public array $allowedHostnames = [];
    public string $indexPage = 'index.php';
    public string $uriProtocol = 'REQUEST_URI';
    public string $defaultLocale = 'en';
    public bool $negotiateLocale = false;
    public array $supportedLocales = ['en'];
    public string $appTimezone = 'UTC';
    public string $charset = 'UTF-8';
    public bool $forceGlobalSecureRequests = false;
    public array $CSPEnabled = []; // Content Security Policy

    // Session
    public string $sessionDriver = 'CodeIgniter\Session\Handlers\FileHandler';
    public string $sessionCookieName = 'ci_session';
    public int $sessionExpiration = 7200;
    public string $sessionSavePath = WRITEPATH . 'session';
    public bool $sessionMatchIP = false;
    public string $sessionTimeToUpdate = '300';
    public bool $sessionRegenerateDestroy = false;
    public string $cookiePrefix = '';
    public string $cookieDomain = '';
    public string $cookiePath = '/';
    public bool $cookieSecure = false;
    public bool $cookieHTTPOnly = false;
    public string $cookieSameSite = 'Lax'; // None, Lax, Strict
    public array $proxyIPs = [];

    // CSRF Protection
    public bool $CSRFProtection = true;
    public string $CSRFTokenName = 'csrf_token_name';
    public string $CSRFHeaderName = 'X-CSRF-TOKEN';
    public string $CSRFCookieName = 'csrf_cookie_name';
    public int $CSRFExpire = 7200;
    public bool $CSRFRegenerate = true;
    public bool $CSRFRedirect = true;
    public string $CSRFSameSite = 'Lax';

    // Others
    public bool $logThreshold = false; // Set to true to enable logging
    public array $logHandlers = [];
    public string $encryptionKey = ''; // Set this in .env: CIPHER_KEY=your-32-character-key

    public function __construct()
    {
        parent::__construct();

        // Ensure WRITEPATH is defined
        if (! defined('WRITEPATH')) {
            define('WRITEPATH', rtrim(realpath(dirname(__DIR__, 2) . '/writable') ?: dirname(__DIR__, 2) . '/writable', '/ ') . '/');
        }
        // Ensure FCPATH is defined
        if (! defined('FCPATH')) {
            define('FCPATH', rtrim(realpath(dirname(__DIR__, 2) . '/public') ?: dirname(__DIR__, 2) . '/public', '/ ') . '/');
        }
        // Ensure APPPATH is defined
        if (! defined('APPPATH')) {
            define('APPPATH', rtrim(realpath(dirname(__DIR__)) ?: dirname(__DIR__), '/ ') . '/');
        }
        // Ensure ROOTPATH is defined
        if (! defined('ROOTPATH')) {
            define('ROOTPATH', rtrim(realpath(dirname(__DIR__, 2)) ?: dirname(__DIR__, 2), '/ ') . '/');
        }
         // Ensure SYSTEMPATH is defined for basic functionality
        if (! defined('SYSTEMPATH')) {
            // This is a simplified path. In a real CI4 install, it points to vendor/codeigniter4/framework/system
            define('SYSTEMPATH', ROOTPATH . 'vendor/codeigniter4/framework/system/');
        }
    }
}
