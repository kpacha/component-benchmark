<?php

// Creates the autoloader
$loader = new \Phalcon\Loader();

$classMap = require_once __DIR__ . '/../../vendor/composer/autoload_classmap.php';

//Register the class map
$loader->registerClasses($classMap);

// register autoloader
$loader->register();

include __DIR__ . '/common.php';