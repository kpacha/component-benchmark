<?php

require_once __DIR__ . '/../../vendor/symfony/class-loader/Symfony/Component/ClassLoader/ClassLoader.php';

use Symfony\Component\ClassLoader\ClassLoader;

$loader = new ClassLoader();
$loader->addPrefixes(array(
    'Respect' => __DIR__ . '/../../vendor/respect/validation/library',
    'Symfony\\Component\\Validator' => __DIR__ . '/../../vendor/symfony/validator',
    'Symfony\\Component\\PropertyAccess' => __DIR__ . '/../../vendor/symfony/property-access',
    'Symfony\\Component\\Translation' => __DIR__ . '/../../vendor/symfony/translation',
    'HybridLogic' => __DIR__ . '/../../vendor/hybridlogic/validation/src',
    'Fuel' => __DIR__ . '/../../vendor/fuel/validation/classes',
    'Zend\\Validator' => __DIR__ . '/../../vendor/zendframework/zend-validator',
    'Zend\\Stdlib' => __DIR__ . '/../../vendor/zendframework/zend-stdlib',
    'Kpacha\\ComponentBenchmark' => __DIR__ . '/../../src',
));
$loader->register();

include __DIR__ . '/common.php';