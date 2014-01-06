<?php

$subjects = Kpacha\ComponentBenchmark\Dummy\ValidationSubjectBuilder::getSubjects(
                array("KoCreditCard", "KoNumber")
);

foreach ($validators as $validator) {
    echo '<p>' . count($validator->run($subjects)) . '</p>';
}