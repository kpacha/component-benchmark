<?php

$validators = array(
    new Kpacha\ComponentBenchmark\Validation\Respect,
    new Kpacha\ComponentBenchmark\Validation\Symfony,
    new Kpacha\ComponentBenchmark\Validation\HybridLogic,
    new Kpacha\ComponentBenchmark\Validation\Fuel,
    new Kpacha\ComponentBenchmark\Validation\ZF2
);

require_once __DIR__ . '/../common.php';