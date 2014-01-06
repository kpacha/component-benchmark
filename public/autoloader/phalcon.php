<?php

// Creates the autoloader
$loader = new \Phalcon\Loader();

//Register some namespaces
$loader->registerNamespaces(array(
    'Respect' => __DIR__ . '/../../vendor/respect/validation/library/Respect/',
    'Symfony\\Component\\Validator' => __DIR__ . '/../../vendor/symfony/validator/Symfony/Component/Validator/',
    'Symfony\\Component\\PropertyAccess' => __DIR__ . '/../../vendor/symfony/property-access/Symfony/Component/PropertyAccess/',
    'Symfony\\Component\\Translation' => __DIR__ . '/../../vendor/symfony/translation/Symfony/Component/Translation/',
    'HybridLogic' => __DIR__ . '/../../vendor/hybridlogic/validation/src/HybridLogic/',
    'Fuel' => __DIR__ . '/../../vendor/fuelphp/validation/src/Fuel/',
    'Zend\\Validator' => __DIR__ . '/../../vendor/zendframework/zend-validator/Zend/Validator/',
    'Zend\\Stdlib' => __DIR__ . '/../../vendor/zendframework/zend-stdlib/Zend/Stdlib/',
    'Kpacha\\ComponentBenchmark' => __DIR__ . '/../../src/Kpacha/ComponentBenchmark/',
    'Kpacha\\BenchmarkTool' => __DIR__ . '/../../vendor/kpacha/php-benchmark-tool/src/Kpacha/BenchmarkTool/',
    'Symfony\\Component\\Finder' => __DIR__ . '/../../vendor/symfony/finder/Symfony/Component/Finder/'
));

// register autoloader
$loader->register();

include __DIR__ . '/common.php';