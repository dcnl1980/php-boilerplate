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

/** 
 * Load composer and config constants
 *
 * @todo replace global config constants with something ... better
 */

require '../vendor/autoload.php';
require '../src/config/config.php';

// start the application
$app = new phpBoilerplate\core\application();
