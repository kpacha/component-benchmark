<?php

namespace Kpacha\ComponentBenchmark\Processor;

/**
 * Description of ResponseTime
 *
 * @author Kpacha <kpacha666@gmail.com>
 */
class ResponseTime extends Gnuplot
{

    protected function buildGraphs($name, $files)
    {
        foreach ($files as $file) {
            $this->exec($this->getCommandOptions($name, $file, str_replace('.dat', '', basename($file))));
        }
    }

    protected function getCommandOptions($name, $input, $output)
    {
        return <<<EOD
-e "set terminal pngcairo transparent enhanced font \"arial,10\" fontscale 1.0 size 500, 350; \
    set size 1,1; set grid y; set key left top; \
    set xlabel 'time'; set ylabel 'ms'; \
    set datafile separator '\t'; \
    set xdata time; set timefmt \"%s\"; set format x \"%S\"; \
    set title \"Response time\"; \
    set output '{$this->publicFolder}$output.timeseries.png'; \
    plot \"$input\" every ::2 using 2:5 title '' with points;"
EOD;
    }

//    protected function getCommandOptions($name, $input, $output)
//    {
//        return <<<EOD
//-e "set terminal pngcairo transparent enhanced font \"arial,10\" fontscale 1.0 size 500, 350; \
//    set size 1,1; set grid y; set key left top; \
//    set xlabel 'time'; set ylabel 'ms'; \
//    set datafile separator '\t'; \
//    set xdata time; set timefmt \"%s\"; set format x \"%S\"; \
//    set title \"Response time\"; \
//    set output '{$this->publicFolder}$output.timeseries.png'; \
//    plot \"$input\" every ::2 using 2:5 title '' with points;"
//EOD;
//    }

}

