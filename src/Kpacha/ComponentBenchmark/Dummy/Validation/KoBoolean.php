<?php

namespace Kpacha\ComponentBenchmark\Dummy\Validation;

/**
 * A simple validation subject for the benchmarking
 *
 * @author Kpacha <kpacha666@gmail.com>
 */
class KoBoolean extends OkSubject
{
    public function __construct()
    {
        $this->banned = 'not banned';
    }
}
