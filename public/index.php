<?php
/**
 * This makes our life easier when dealing with paths. Everything is relative
 * to the application root now.
 */
chdir(dirname(__DIR__));

// require composer autoloader for loading classes
require 'vendor/autoload.php';

require 'app/config.php';

$app = new MartynBiz\Application($config);

// Run it!
$app->run();