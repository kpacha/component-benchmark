<?php

namespace Kpacha\ComponentBenchmark\Validation;

/**
 *
 * @author Kpacha <kpacha666@gmail.com>
 */
abstract class ValidationBenchmark
{
    const ALPHA_REGEX = '/^[\-\ a-zA-Z]+$/';
    const ALNUM_REGEX = '/^[a-zA-Z0-9]+$/';
    const INT_REGEX = '/^[\-0-9]+$/';
    const POSITIVE_INT_REGEX = '/^[\d]+$/';
    const FLOAT_REGEX = '/^[\-\.0-9]+$/';
    
    abstract public function init();
    abstract public function run(array $targets);
}
