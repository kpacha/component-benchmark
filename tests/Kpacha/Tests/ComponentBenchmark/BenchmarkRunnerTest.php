<?php

namespace Kpacha\Tests\ComponentBenchmark;

use Kpacha\ComponentBenchmark\BenchmarkRunner;

/**
 * Description of BenchmarkTest
 *
 * @author Kpacha <kpacha666@gmail.com>
 */
class BenchmarkRunnerTest extends \PHPUnit_Framework_TestCase
{

    private $target = 'target';
    private $output = array(9.89);
    private $benchmarker;
    private $benchmarkerName = 'Benchmarker';
    private $benchmarkerClassName = 'Kpacha\ComponentBenchmark\Benchmarker\Base';
    private $printerClassName = 'Kpacha\ComponentBenchmark\Printer\Printer';
    private $processorClassName = 'Kpacha\ComponentBenchmark\Processor\Processor';

    public function setUp()
    {
        $this->benchmarker = $this->getMockedBenchmarker();
    }

    public function testRun()
    {
        $benchmark = new BenchmarkRunner('test', array($this->benchmarker),
                        array('group1' => array($this->target)), array(), array());
        $this->assertSame(
                array('test' => array($this->benchmarkerName => array('group1' => array($this->target => $this->output)))),
                $benchmark->run()
        );
    }

    public function testProcess()
    {
        $processor = $this->getMock($this->processorClassName, array('process'));
        $processor->expects($this->exactly(2))
                ->method('process')
                ->with($this->equalTo($this->benchmarkerName), $this->equalTo(array('group1' => array($this->target))));

        $benchmark = new BenchmarkRunner('test', array($this->benchmarker, $this->benchmarker),
                        array('group1' => array($this->target)), array($processor), array());
        $benchmark->run();
        $benchmark->processResults();
    }

    public function testPrint()
    {
        $expected = 'console result';

        $printer = $this->getMock($this->printerClassName, array('dump'));
        $printer->expects($this->exactly(2))
                ->method('dump')
                ->with($this->equalTo($this->benchmarkerName), $this->equalTo(array()),
                        $this->equalTo(array('group1' => array($this->target => (array) $this->output))))
                ->will($this->returnValue($expected));

        $benchmark = new BenchmarkRunner('test', array($this->benchmarker, $this->benchmarker),
                        array('group1' => array($this->target)), array(), array($printer));
        $benchmark->run();
        $this->assertEquals("$expected\n---\n$expected", $benchmark->printResults());
    }

    protected function getMockedBenchmarker()
    {
        $benchmarker = $this->getMock($this->benchmarkerClassName, array('run', 'getName'), array(''));
        $benchmarker->expects($this->any())
                ->method('run')
                ->with($this->equalTo($this->target))
                ->will($this->returnValue($this->output));
        $benchmarker->expects($this->any())
                ->method('getName')
                ->will($this->returnValue($this->benchmarkerName));
        return $benchmarker;
    }

}
