<?php

namespace Kpacha\Tests\ComponentBenchmark\Printer;

use Kpacha\ComponentBenchmark\Printer\ConsolePrinter;

/**
 * Description of ConsolePrinterTest
 *
 * @author Kpacha <kpacha666@gmail.com>
 */
class ConsolePrinterTest extends \PHPUnit_Framework_TestCase
{

    public function testDump()
    {
        $benchmarkName = 'test';
        $arguments = array('group1' => array('agr1' => true));
        $target = 'target';
        $output = 10.90;
        $expected = "$benchmarkName\n\ngroup1\n--------\nagr1 :\t1\n--------\n\n\n$target :\t$output";

        $printer = new ConsolePrinter;

        $this->assertEquals($expected, $printer->dump($benchmarkName, $arguments, array($target => $output)));
    }

}
