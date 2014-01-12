<?php

namespace Kpacha\Tests\ComponentBenchmark\Validation;

use Kpacha\ComponentBenchmark\Validation\Symfony;

/**
 * Description of SymfonytTest
 *
 * @author Kpacha <kpacha666@gmail.com>
 */
class SymfonyTest extends AbstractTest
{
    public function setUp()
    {
        $this->setValidatorBenchmark(new Symfony);
    }
}
