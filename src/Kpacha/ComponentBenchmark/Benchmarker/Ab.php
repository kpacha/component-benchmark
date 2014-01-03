<?php

namespace Kpacha\ComponentBenchmark\Benchmarker;

use Kpacha\ComponentBenchmark\Benchmarker\Base;

/**
 * Description of Ab
 *
 * @author Kpacha <kpacha666@gmail.com>
 */
class Ab extends Base
{

    const CONCURRENCY = 5;
    const TIME_LIMIT = 10;
    const LOG_PATH = 'ab/';

    public function getName()
    {
        return __CLASS__;
    }

    protected function getParsedArguments($target)
    {
        if (!$target) {
            throw new \Exception('A target is required!');
        }
        $timeLimit = $this->getArgument('timeLimit', self::TIME_LIMIT);
        $concurrency = $this->getArgument('concurrency', self::CONCURRENCY);
        $logFile = $this->getLogFile($target);
        $plotableLog = $this->getPlotableLogFile($target);
        return "-t $timeLimit -c $concurrency -g $plotableLog $target > $logFile";
    }

    protected function cleanOutput($target, array $output)
    {
        $text = $this->getLogFileContents($target);
        if ($text === false) {
            throw new \Exception('Empty log file!');
        }
        preg_match('/Requests per second: *(.*)/', $text, $matches);
        return (isset($matches[1])) ? (float) $matches[1] : null;
    }

    protected function getPlotableLogFile($target)
    {
        return str_replace('.log', '.dat', $this->getLogFile($target));
    }

    protected function getLogFile($target)
    {
        return $this->getLogPath() . md5($target) . '.log';
    }

    protected function getLogPath()
    {
        return $this->getArgument('logPath', self::LOG_PATH);
    }

    protected function getLogFileContents($target)
    {
        return @file_get_contents($this->getLogFile($target));
    }

}
