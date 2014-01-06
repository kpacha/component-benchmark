<?php

namespace Kpacha\Tests\ComponentBenchmark\Validation;

use Kpacha\ComponentBenchmark\Validation\Fuel;

/**
 * Description of FuelTest
 *
 * @author Kpacha <kpacha666@gmail.com>
 */
class FuelTest extends AbstractTest
{    
    public function setUp()
    {
        $this->setValidatorBenchmark(new Fuel);
    }
}
