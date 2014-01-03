<?php

namespace Kpacha\ComponentBenchmark\Validation;

/**
 *
 * @author Kpacha <kpacha666@gmail.com>
 */
interface ValidationBenchmark
{
    public function init();
    public function run(array $targets);
}
