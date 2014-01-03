<?php

require_once __DIR__ . '/../../vendor/zendframework/zend-loader/Zend/Loader/StandardAutoloader.php';

$loader = new Zend\Loader\StandardAutoloader;
$loader->registerNamespace('Respect', __DIR__ . '/../../vendor/respect/validation/library/Respect');
$loader->registerNamespace('Symfony\\Component\\Validator', __DIR__ . '/../../vendor/symfony/validator/Symfony/Component/Validator');
$loader->registerNamespace('Symfony\\Component\\PropertyAccess', __DIR__ . '/../../vendor/symfony/property-access/Symfony/Component/PropertyAccess');
$loader->registerNamespace('Symfony\\Component\\Translation', __DIR__ . '/../../vendor/symfony/translation/Symfony/Component/Translation');
$loader->registerNamespace('HybridLogic', __DIR__ . '/../../vendor/hybridlogic/validation/src/HybridLogic');
$loader->registerNamespace('Fuel', __DIR__ . '/../../vendor/fuel/validation/classes/Fuel');
$loader->registerNamespace('Zend\\Validator', __DIR__ . '/../../vendor/zendframework/zend-validator/Zend/Validator');
$loader->registerNamespace('Zend\\Stdlib', __DIR__ . '/../../vendor/zendframework/zend-stdlib/Zend/Stdlib');
$loader->registerNamespace('Kpacha\\ComponentBenchmark', __DIR__ . '/../../src/Kpacha/ComponentBenchmark');
$loader->register();

include __DIR__ . '/common.php';