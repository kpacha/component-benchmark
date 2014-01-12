<?php

namespace Kpacha\ComponentBenchmark\Dummy\Validation;

/**
 * A simple validation subject for the benchmarking
 *
 * @author Kpacha <kpacha666@gmail.com>
 */
class KoCreditCard extends OkSubject
{
    public function __construct()
    {
        $this->creditCard = '4929763080215205';
    }
}
