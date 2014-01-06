<?php

require_once __DIR__ . '/../../vendor/composer/ClassLoader.php';

$loader = new \Composer\Autoload\ClassLoader;
$loader->set('Respect', __DIR__ . '/../../vendor/respect/validation/library');
$loader->set('Symfony\\Component\\Validator', __DIR__ . '/../../vendor/symfony/validator');
$loader->set('Symfony\\Component\\PropertyAccess', __DIR__ . '/../../vendor/symfony/property-access');
$loader->set('Symfony\\Component\\Translation', __DIR__ . '/../../vendor/symfony/translation');
$loader->set('HybridLogic', __DIR__ . '/../../vendor/hybridlogic/validation/src');
$loader->set('Fuel', __DIR__ . '/../../vendor/fuelphp/validation/src');
$loader->set('Zend\\Validator', __DIR__ . '/../../vendor/zendframework/zend-validator');
$loader->set('Zend\\Stdlib', __DIR__ . '/../../vendor/zendframework/zend-stdlib');
$loader->set('Kpacha\\ComponentBenchmark', __DIR__ . '/../../src');
$loader->set('Kpacha\\BenchmarkTool', __DIR__ . '/../../vendor/kpacha/php-benchmark-tool/src');
$loader->set('Symfony\\Component\\Finder', __DIR__ . '/../../vendor/symfony/finder');
$loader->register();

include __DIR__ . '/common.php';