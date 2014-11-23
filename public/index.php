<?php

// Define path to application directory
defined('APPLICATION_PATH')
    || define('APPLICATION_PATH', realpath(dirname(__FILE__) . '/../app'));

// require composer autoloader for loading classes
require realpath(APPLICATION_PATH . '/../vendor/autoload.php');

require realpath(APPLICATION_PATH . '/config.php');

$app = new MartynBiz\Application($config);

// Run it!
$app->bootstrap()
    ->run();