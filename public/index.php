<?php

/**
 * A simple PHP MVC framework. Based on php-mvc-advanced.
 *
 * @author Mawalu
 * @link https://github.com/mawalu/php-boilerplate/
 * @link https://github.com/panique/php-mvc-advanced
 * @license http://opensource.org/licenses/MIT MIT License
 */

/** 
 * Load composer and config constants
 *
 * @todo replace global config constants with something ... better
 */

require '../vendor/autoload.php';

// load application configuration
$config = new phpBoilerplate\core\config();
$config->parseYamlFolder(dirname(__FILE__) . "/../config");

// start the application
$app = new phpBoilerplate\core\application($config);
$app->handleRequest();
