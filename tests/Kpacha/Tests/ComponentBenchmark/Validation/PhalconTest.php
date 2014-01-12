<?php

namespace Kpacha\Tests\ComponentBenchmark\Validation;

use Kpacha\ComponentBenchmark\Validation\Phalcon;

/**
 * Description of PhalconTest
 *
 * @author Kpacha <kpacha666@gmail.com>
 */
class PhalconTest extends AbstractTest
{
    public function setUp()
    {
        $this->setValidatorBenchmark(new Phalcon);
    }
}
