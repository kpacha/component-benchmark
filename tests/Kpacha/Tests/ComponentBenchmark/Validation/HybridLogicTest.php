<?php

namespace Kpacha\Tests\ComponentBenchmark\Validation;

use Kpacha\ComponentBenchmark\Validation\HybridLogic;

/**
 * Description of HybridLogicTest
 *
 * @author Kpacha <kpacha666@gmail.com>
 */
class HybridLogicTest extends AbstractTest
{    
    public function setUp()
    {
        $this->setValidatorBenchmark(new HybridLogic);
    }
}
