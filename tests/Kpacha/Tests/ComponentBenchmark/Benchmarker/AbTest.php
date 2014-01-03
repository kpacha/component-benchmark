<?php

namespace Kpacha\Tests\ComponentBenchmark\Benchmarker;

use Kpacha\ComponentBenchmark\Benchmarker\Ab;

/**
 * Description of AbTest
 *
 * @author Kpacha <kpacha666@gmail.com>
 */
class AbTest extends \PHPUnit_Framework_TestCase
{

    const CLASS_NAME = 'Kpacha\ComponentBenchmark\Benchmarker\Ab';
    const DUMMY_COMMAND_PATH = 'path/to/command';
    const SAMPLE_OUTPUT = 'Requests per second:    24.99';

    private static $emptyResult = array('output' => array(), 'status' => 0);
    private $subject;

    /**
     * @param string $expectedCommand
     * @param array $arguments
     * @param string $target
     * 
     * @dataProvider commandParserProvider
     */
    public function testCommandIsPassedToExec($expectedCommand, $arguments, $target)
    {
        $this->createStubs(array(self::DUMMY_COMMAND_PATH, $arguments), $expectedCommand, self::$emptyResult,
                self::SAMPLE_OUTPUT);
        $this->subject->run($target);
    }

    public function commandParserProvider()
    {
        return array(
            'default options' => array(self::DUMMY_COMMAND_PATH . ' -t 10 -c 5 -g ab/3b6140634caf169596690676ce8838af.dat someTarget > ab/3b6140634caf169596690676ce8838af.log', array(), 'someTarget'),
            'full params' => array(self::DUMMY_COMMAND_PATH . ' -t 2 -c 3 -g ab/3b6140634caf169596690676ce8838af.dat someTarget > ab/3b6140634caf169596690676ce8838af.log', array('timeLimit' => 2, 'concurrency' => 3), 'someTarget')
        );
    }

    /**
     * @expectedException \Exception
     * @expectedExceptionMessage A target is required!
     */
    public function testInvalidTargetThrowsException()
    {
        $subject = new Ab('path');
        $subject->run(null);
    }

    public function testOutput()
    {
        $expected = 24.99;
        $target = 'someTarget';
        $rawOutput = <<<TEXT
Write errors:           0
Non-2xx responses:      251
Total transferred:      142819 bytes
HTML transferred:       54969 bytes
Requests per second:    24.99 [#/sec] (mean)
Time per request:       200.063 [ms] (mean)
Time per request:       40.013 [ms] (mean, across all concurrent requests)
Transfer rate:          13.89 [Kbytes/sec] received

Connection Times (ms)
TEXT;
        $this->createStubs(array(''), '', self::$emptyResult, $rawOutput);
        $this->subject->run($target);
        $this->assertEquals(array($target => $expected), $this->subject->getOutput());
    }

    public function testReadLog()
    {
        $expected = 16.88;
        $target = 'someTarget';
        $hashed = md5($target);
        $this->createMock(array('exec'), array('', array('logPath' => __DIR__ . "/../../../../resources/")));
        $this->stubExecMethod(self::$emptyResult);
        $this->subject->run($target);
        $this->assertEquals(array($target => $expected), $this->subject->getOutput());
    }

    /**
     * @expectedException \Exception
     * @expectedExceptionMessage Empty log file!
     */
    public function testReadLogThrowsExceptionWhenNoLog()
    {
        $this->createMock(array('exec'), array('', array('logPath' => '/unknown/path/to/ab/log/')));
        $this->stubExecMethod(self::$emptyResult);
        $this->subject->run('someTarget');
        $this->subject->getOutput();
    }

    public function testGetName()
    {
        $subject = new Ab('path');
        $this->assertEquals(self::CLASS_NAME, $subject->getName());
    }

    protected function createStubs($constructorParams, $expectedCommand, $execResult, $output = null)
    {
        $this->createMock(array('exec', 'getLogFileContents'), $constructorParams);
        $this->stubExecMethod($execResult, $expectedCommand);
        if ($output) {
            $this->stubLogContentsMethod($output);
        }
    }

    protected function createMock(array $methods, $constructorParams)
    {
        $this->subject = $this->getMock(self::CLASS_NAME, $methods, $constructorParams);
    }

    protected function stubLogContentsMethod($returnValue)
    {
        $this->subject->expects($this->once())->method('getLogFileContents')->will($this->returnValue($returnValue));
    }

    protected function stubExecMethod($returnValue, $expectedCommand = null)
    {
        if ($expectedCommand) {
            $this->subject->expects($this->once())->method('exec')->with($this->equalTo($expectedCommand))->will($this->returnValue($returnValue));
        } else {
            $this->subject->expects($this->once())->method('exec')->will($this->returnValue($returnValue));
        }
    }

}
