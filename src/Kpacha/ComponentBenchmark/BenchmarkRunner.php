<?php

namespace Kpacha\ComponentBenchmark;

use Kpacha\ComponentBenchmark\Benchmarker\Base as Benchmarker;
use Kpacha\ComponentBenchmark\Printer\ConsolePrinter;
use Kpacha\ComponentBenchmark\Printer\HtmlPrinter;

/**
 * Description of BenchmarkRunner
 *
 * @author Kpacha <kpacha666@gmail.com>
 */
class BenchmarkRunner
{

    /**
     * @var string
     */
    private $benchName;

    /**
     * The benchmarker engines
     * @var array
     */
    private $benchmarkers;

    /**
     * The configuration
     * @var array
     */
    private $targets;

    /**
     * The result container
     * @var array
     */
    private $results = array();

    /**
     * @var array of Kpacha\ComponentBenchmark\Processor\Processor 
     */
    private $processors;

    /**
     * @var array of Kpacha\ComponentBenchmark\Printer\Printer 
     */
    private $printers;

    /**
     * @var int 
     */
    private $wait;

    public function __construct($benchName, array $benchmarkers, array $targets, array $processors, array $printers,
            $wait = 0)
    {
        $this->benchName = $benchName;
        $this->benchmarkers = $benchmarkers;
        $this->targets = $targets;
        $this->processors = $processors;
        $this->printers = $printers;
        $this->wait = $wait;
    }

    public function run()
    {
        foreach ($this->benchmarkers as $benchmarker) {
            $this->runBenchmarker($benchmarker);
        }
        return $this->results;
    }

    public function processResults()
    {
        foreach ($this->benchmarkers as $benchmarker) {
            foreach ($this->processors as $processor) {
                $processor->process($benchmarker->getName(), $this->targets);
            }
        }
    }

    public function printResults()
    {
        $prettyResult = array();
        foreach ($this->benchmarkers as $benchmarker) {
            foreach ($this->printers as $printer) {
                $prettyResult[] = $printer->dump($benchmarker->getName(), $benchmarker->getArguments(),
                        $this->results[$this->benchName][$benchmarker->getName()]);
            }
        }
        return implode("\n---\n", $prettyResult);
    }

    protected function runBenchmarker(Benchmarker $benchmarker)
    {
        $benchmarkerClassName = $benchmarker->getName();
        foreach ($this->targets as $groupName => $group) {
            foreach ($group as $target) {
                $this->results[$this->benchName][$benchmarkerClassName][$groupName][$target] = $benchmarker->run($target);
                \sleep($this->wait);
            }
        }
    }

}
