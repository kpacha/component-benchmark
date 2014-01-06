<?php

$subjects = Kpacha\ComponentBenchmark\Dummy\ValidationSubjectBuilder::getSubjects(
                array("KoBoolean", "KoCreditCard")
);

foreach ($validators as $validator) {
    echo '<p>' . count($validator->run($subjects)) . '</p>';
}