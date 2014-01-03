<?php

namespace Kpacha\ComponentBenchmark\Processor;

use Kpacha\ComponentBenchmark\Helper\FinderFactory;

/**
 * Description of Gnuplot
 *
 * @author Kpacha <kpacha666@gmail.com>
 */
abstract class Gnuplot implements Processor
{

    /**
     * @var string
     */
    private $logFolder;

    /**
     * @var string
     */
    protected $publicFolder;

    /**
     * @var string
     */
    protected $commandPath;

    /**
     * @var FinderFactory
     */
    private $finderFactory;

    public function __construct(FinderFactory $finderFactory, array $params)
    {
        $this->finderFactory = $finderFactory;
        $this->logFolder = rtrim($params['logPath'], '/') . '/';
        $this->publicFolder = rtrim($params['publicPath'], '/') . '/';
        $this->commandPath = $params['path'];
    }

    public function process($benchmarkerName, array $targets)
    {
        foreach ($targets as $groupName => $group) {
            $this->buildGraphs($groupName, $this->getDatFiles($group));
        }
    }

    protected function getDatFiles($targets)
    {
        $pattern = array();
        foreach ($targets as $target) {
            $pattern[] = md5($target);
        }
        $finder = $this->finderFactory->create()->files()->in($this->logFolder)->name('@(' . implode('|', $pattern) . ')\.dat@');
        $files = array();
        foreach ($finder as $file) {
            $files[] = $file->getRealpath();
        }
        return $files;
    }

    abstract protected function buildGraphs($name, $files);

    protected function exec($commandOptions)
    {
        $return = array('output' => array(), 'status' => null);
        exec($this->commandPath . ' ' . $commandOptions, $return['output'], $return['status']);
        return $return;
    }

}

