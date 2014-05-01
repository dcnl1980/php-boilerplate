<?php

/**
 * A simple PHP MVC skeleton
 *
 * @package php-mvc
 * @author Panique
 * @link http://www.php-mvc.net
 * @link https://github.com/panique/php-mvc/
 * @license http://opensource.org/licenses/MIT MIT License
 */

// load application config (error reporting etc.)
require '../application/config/config.php';

// load the (optional) Composer auto-loader
if (file_exists(ROOT_DIR . '/vendor/autoload.php')) {
    require ROOT_DIR . '/vendor/autoload.php';
}

// load application class
require ROOT_DIR . '/application/libs/application.php';
require ROOT_DIR . '/application/libs/controller.php';

// start the application
$app = new Application();
