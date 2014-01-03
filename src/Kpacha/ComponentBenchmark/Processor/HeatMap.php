<?php

namespace Kpacha\ComponentBenchmark\Processor;

/**
 * Description of HeatMap
 *
 * @author Kpacha <kpacha666@gmail.com>
 */
class HeatMap extends BasicHeatMap
{

    protected function getCommandOptions($name, $files)
    {
        $plot = array();
        foreach ($files as $file) {
            $plot[] = "'$file' using 2:5 title '' with points";
        }
        $plotCommand = implode(', ', $plot);
        return <<<EOD
-e "set terminal pngcairo transparent enhanced font \"arial,10\" fontscale 1.0 size 500, 500; \
    set size 1,1; set grid y; set key left top; \
    set xlabel 'time'; set ylabel 'ms'; \
    set xdata time; set timefmt \"%s\"; set datafile separator '\t'; set format x \"%S\"; \
    set title \"Response time\"; \
    set output '{$this->publicFolder}$name.heatmap.png'; \
    plot $plotCommand;"
EOD;
    }

}

