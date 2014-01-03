<?php

namespace Kpacha\ComponentBenchmark\Printer;

/**
 * Description of PrettyPrinter
 *
 * @author Kpacha <kpacha666@gmail.com>
 */
class ConsolePrinter implements Printer
{

    public function dump($benchmarkerName, array $headers, array $outputs)
    {
        $headers = $this->serialize($headers);
        $results = $this->serialize($outputs);
        return "$benchmarkerName\n\n$headers\n\n$results";
    }

    protected function serialize(array $values)
    {
        $lines = array();
        foreach ($values as $key => $value) {
            if (is_array($value)) {
                $lines[] = "$key\n--------\n" . $this->serialize($value) . "\n--------\n";
            } else if(!empty($value)) {
                $lines[] = "$key :\t$value";
            }
        }
        return $this->implode($lines);
    }

    protected function implode($lines)
    {
        return implode("\n", $lines);
    }

}
