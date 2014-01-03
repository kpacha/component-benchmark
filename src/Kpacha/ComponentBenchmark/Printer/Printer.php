<?php

namespace Kpacha\ComponentBenchmark\Printer;

/**
 *
 * @author Kpacha <kpacha666@gmail.com>
 */
interface Printer
{
    public function dump($benchmarkerName, array $headers, array $outputs);
}
