<?php

namespace Kpacha\Tests\ComponentBenchmark\Benchmarker;

use Kpacha\ComponentBenchmark\Benchmarker\Base;

/**
 * Description of BaseTest
 *
 * @author Kpacha <kpacha666@gmail.com>
 */
class BaseTest extends \PHPUnit_Framework_TestCase
{

    const DUMMY_COMMAND_PATH = 'path/to/command';
    const CLASS_NAME = 'Kpacha\ComponentBenchmark\Benchmarker\Base';

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
        $this->mockSubject(array(self::DUMMY_COMMAND_PATH, $arguments), $expectedCommand, self::$emptyResult);
        $this->subject->run($target);
    }

    public function commandParserProvider()
    {
        return array(
            'empty params' => array(self::DUMMY_COMMAND_PATH, array(), null),
            'just arguments' => array(self::DUMMY_COMMAND_PATH . ' some arguments', array('some', 'arguments'), null),
            'just target' => array(self::DUMMY_COMMAND_PATH . ' someTarget', array(), 'someTarget'),
            'full params' => array(self::DUMMY_COMMAND_PATH . ' some arguments someTarget', array('some', 'arguments'), 'someTarget'),
        );
    }

    public function testExec()
    {
        $subject = new Base('ls');
        $this->assertContains(basename(__FILE__), $subject->run(__DIR__));
    }
    
    public function testGetName()
    {
        $subject = new Base('ls');
        $this->assertEquals(self::CLASS_NAME, $subject->getName());
    }
    
    public function testGetArguments()
    {
        $arguments = array('first', 'second');
        $subject = new Base('ls', $arguments);
        $this->assertEquals($arguments, $subject->getArguments());
    }

    protected function mockSubject($constructorParams, $expectedCommand, $result)
    {
        $this->subject = $this->getMock(self::CLASS_NAME, array('exec'), $constructorParams);
        if ($expectedCommand) {
            $this->subject->expects($this->once())->method('exec')->with($this->equalTo($expectedCommand))->will($this->returnValue($result));
        } else {
            $this->subject->expects($this->once())->method('exec')->will($this->returnValue($result));
        }
    }

}
