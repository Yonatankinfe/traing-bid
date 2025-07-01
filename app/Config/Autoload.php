<?php

namespace Config;

use CodeIgniter\Config\AutoloadConfig;

class Autoload extends AutoloadConfig
{
    /**
     * -------------------------------------------------------------------
     * Namespaces
     * -------------------------------------------------------------------
     * This maps the locations of any namespaces in your application to
     * their location on the file system. These are used by the autoloader
     * to locate files the first time they are instantiated.
     *
     * The '/app' and '/system' directories are already mapped for you.
     * you may change the name of the 'App' namespace if you wish,
     * but this should be done prior to creating any namespaced classes,
     * else you will have to change all of them.
     *
     * DO NOT change the name of the CodeIgniter namespace or your application
     * will break. Analyse the Paths file to see the directories that are mapped
     * automatically.
     *
     * @var array<string, string>
     */
    public array $psr4 = [
        APP_NAMESPACE => APPPATH, // For custom classes within App
        'Config'      => APPPATH . 'Config',
    ];

    /**
     * -------------------------------------------------------------------
     * Class Map
     * -------------------------------------------------------------------
     * The class map provides a map of class names and their exact
     * location on the drive. Classes loaded in this manner will have
     * slightly faster performance because they will not have to be
     * searched for within one or more directories as they would if they
     * were being autoloaded through a namespace.
     *
     * Prototype:
     *   $classmap = [
     *       'MyClass'   => '/path/to/class/MyClass.php'
     *   ];
     *
     * @var array<string, string>
     */
    public array $classmap = [];

    /**
     * -------------------------------------------------------------------
     * Files
     * -------------------------------------------------------------------
     * The files array provides a list of paths to files that will be
     * loaded globally every time a request is made.
     *
     * Prototype:
     *   $files = [
     *       '/path/to/my/file.php',
     *   ];
     *
     * @var string[]
     */
    public array $files = [];

    /**
     * -------------------------------------------------------------------
     * Helpers
     * -------------------------------------------------------------------
     * Prototype:
     *   $helpers = [
     *       'form',
     *       'url',
     *   ];
     *
     * @var string[]
     */
    public array $helpers = ['url', 'form'];

    public function __construct()
    {
        parent::__construct();

        // Ensure APPPATH is defined for the psr4 mapping
        if (! defined('APPPATH') && defined('ROOTPATH')) {
             define('APPPATH', ROOTPATH . 'app' . DIRECTORY_SEPARATOR);
        }
        if (! defined('APP_NAMESPACE')) {
            define('APP_NAMESPACE', 'App');
        }

        // Update psr4 if APPPATH was just defined
        if (defined('APPPATH')) {
            $this->psr4[APP_NAMESPACE] = APPPATH;
            $this->psr4['Config'] = APPPATH . 'Config';
        }
    }
}
