<?php

require_once __DIR__ . '/../../vendor/autoload.php';

include __DIR__ . '/subject.php';

$validators = array(
    new Kpacha\ComponentBenchmark\Validation\ZF2
);

foreach ($validators as $validator) {
    $validator->run($subjects);
}