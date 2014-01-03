<?php

namespace Kpacha\ComponentBenchmark\Printer;

use Kpacha\ComponentBenchmark\Helper\FinderFactory;

/**
 * Description of HtmlPrinter
 *
 * @author Kpacha <kpacha666@gmail.com>
 */
class HtmlPrinter implements Printer
{

    private $logFolder;
    private $publicFolder;

    /**
     * @var FinderFactory
     */
    private $finderFactory;

    public function __construct(FinderFactory $finderFactory, array $params)
    {
        $this->finderFactory = $finderFactory;
        $this->logFolder = rtrim($params['logPath'], '/') . '/';
        $this->publicFolder = rtrim($params['publicPath'], '/') . '/';
    }

    public function dump($benchmarkerName, array $headers, array $outputs)
    {
        $headers = $this->serialize($headers);
        $results = $this->serialize($outputs);
        $logs = $this->getLogs($outputs);
        $this->write("<h2>$benchmarkerName</h2>\n<div><h3>Config</h3>$headers</div>\n<div><h3>Preview</h3>$results</div>\n<div><h3>Results</h3>$logs</div>");
    }

    protected function serialize(array $values)
    {
        $lines = array('<table>');
        foreach ($values as $key => $value) {
            $hashedTarget = md5($key);
            if (!is_array($value)) {
                $lines[] = "<tr><td><a href=\"#$hashedTarget\">$key</a></td><td>$value</td></tr>";
            } else {
                $lines[] = "<tr><td colspan=\"2\"><h4>$key</h4></td></tr><tr><td colspan=\"2\"><img src=\"$key.heatmap.png\"></td></tr><tr><td colspan=\"2\">" . $this->serialize($value) . "</td></tr>";
            }
        }
        $lines[] = '</table>';
        return $this->implode($lines);
    }

    protected function getLogs(array $values)
    {
        $logs = array('<ul>');
        foreach ($values as $key => $value) {
            if (is_array($value)) {
                $logs[] = '<li><h4>' . $key . '</h4>' . $this->getLogs($value) . '</li>';
            } else {
                $logs[] = $this->getLogByTarget($key);
            }
        }
        $logs[] = '</ul>';
        return $this->implode($logs);
    }

    protected function getLogByTarget($target)
    {
        $hashedTarget = md5($target);
        $log = '<li><h4 id="' . $hashedTarget . '">' . $target . '</h4><ul>';
        $log .= $this->getLogContent($this->logFolder, $hashedTarget);
        $log .= $this->getImageLink($hashedTarget);
        $log .= '</ul></li>';
        return $log;
    }

    protected function implode($lines)
    {
        return implode("", $lines);
    }

    protected function getLogContent($path, $name)
    {
        $finder = $this->finderFactory->create()->files()->in($path)->name("$name.log");
        $content = array();
        foreach ($finder as $file) {
            $content = $file->getContents();
        }
        return '<li><pre>' . $content . '</pre></li>';
    }

    protected function getImageLink($pathWithoutExtension)
    {
        return "<li><img src=\"$pathWithoutExtension.sequence.png\"></li><li><img src=\"$pathWithoutExtension.timeseries.png\"></li>";
    }

    protected function write($content)
    {
        file_put_contents($this->publicFolder . 'report.html', $content);
    }

}
