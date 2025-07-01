<?php

namespace Config;

class Paths
{
    /**
     * Path to the system directory.
     *
     * @var string
     */
    public string $systemDirectory = __DIR__ . '/../../vendor/codeigniter4/framework/system'; // Adjusted for manual setup

    /**
     * Path to the application directory.
     *
     * @var string
     */
    public string $appDirectory = __DIR__ . '/..'; // Points to 'app' directory

    /**
     * Path to the writable directory.
     *
     * @var string
     */
    public string $writableDirectory = __DIR__ . '/../../writable';

    /**
     * Path to the tests directory.
     *
     * @var string
     */
    public string $testsDirectory = __DIR__ . '/../../tests';

    /**
     * Path to the view directory.
     *
     * @var string
     */
    public string $viewDirectory = __DIR__ . '/../Views';

    /**
     * Path to the public directory.
     *
     * @var string
     */
    public string $publicDirectory = __DIR__ . '/../../public';


    public function __construct()
    {
        // Ensure basic constants are defined if not already by Constants.php or bootstrap
        if (! defined('ROOTPATH')) {
            define('ROOTPATH', realpath($this->publicDirectory . '/..') . DIRECTORY_SEPARATOR);
        }
        if (! defined('APPPATH')) {
            define('APPPATH', realpath($this->appDirectory) . DIRECTORY_SEPARATOR);
        }
        if (! defined('WRITEPATH')) {
            define('WRITEPATH', realpath($this->writableDirectory) . DIRECTORY_SEPARATOR);
        }
        if (! defined('SYSTEMPATH')) {
            // This is a placeholder, actual CI4 uses vendor path
            define('SYSTEMPATH', ROOTPATH . 'vendor/codeigniter4/framework/system/');
        }
        if (! defined('FCPATH')) {
            define('FCPATH', realpath($this->publicDirectory) . DIRECTORY_SEPARATOR);
        }
    }
}
