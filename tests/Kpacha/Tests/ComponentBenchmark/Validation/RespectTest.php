<?php

namespace Kpacha\Tests\ComponentBenchmark\Validation;

use Kpacha\ComponentBenchmark\Validation\Respect;

/**
 * Description of RespectTest
 *
 * @author Kpacha <kpacha666@gmail.com>
 */
class RespectTest extends AbstractTest
{    
    public function setUp()
    {
        $this->setValidatorBenchmark(new Respect);
    }
}
