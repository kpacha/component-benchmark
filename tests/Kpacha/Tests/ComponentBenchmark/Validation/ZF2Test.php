<?php

namespace Kpacha\Tests\ComponentBenchmark\Validation;

use Kpacha\ComponentBenchmark\Validation\ZF2;

/**
 * Description of ZF2Test
 *
 * @author Kpacha <kpacha666@gmail.com>
 */
class ZF2Test extends AbstractTest
{    
    public function setUp()
    {
        $this->setValidatorBenchmark(new ZF2);
    }
}
