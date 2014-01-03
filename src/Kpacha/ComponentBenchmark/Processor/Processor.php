<?php

namespace Kpacha\ComponentBenchmark\Processor;

/**
 *
 * @author Kpacha <kpacha666@gmail.com>
 */
interface Processor
{

    public function process($benchmarkerName, array $targets);
}
