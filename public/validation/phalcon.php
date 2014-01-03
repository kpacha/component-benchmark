<?php

require_once __DIR__ . '/../../vendor/autoload.php';

include __DIR__ . '/../validation/subject.php';

$validators = array(
    new Kpacha\ComponentBenchmark\Validation\Phalcon
);

foreach ($validators as $validator) {
    $validator->run($subjects);
}
