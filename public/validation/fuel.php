<?php

require_once __DIR__ . '/../../vendor/autoload.php';

include __DIR__ . '/../validation/subject.php';

$validators = array(
    new Kpacha\ComponentBenchmark\Validation\Fuel
);

foreach ($validators as $validator) {
    $validator->run($subjects);
}