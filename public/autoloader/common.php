<?php

include __DIR__ . '/../validation/subject.php';

$validators = array(
    new Kpacha\ComponentBenchmark\Validation\Respect,
    new Kpacha\ComponentBenchmark\Validation\Symfony,
    new Kpacha\ComponentBenchmark\Validation\HybridLogic,
    new Kpacha\ComponentBenchmark\Validation\Fuel,
    new Kpacha\ComponentBenchmark\Validation\ZF2
);

foreach ($validators as $validator) {
    $validator->run($subjects);
}