<?php

namespace Kpacha\ComponentBenchmark\Dummy;

use Kpacha\BenchmarkTool\Helper\FinderFactory;

/**
 * Description of ValidationSubjectBuilder
 *
 * @author Kpacha <kpacha666@gmail.com>
 */
class ValidationSubjectBuilder
{

    private static $finderFactory;

    private static function getFinderFactory()
    {
        if (!self::$finderFactory) {
            self::$finderFactory = new FinderFactory;
        }

        return self::$finderFactory;
    }

    public static function getSubjects($excludedDummies = array())
    {
        $subjects = array();
        foreach (self::getDummyFiles($excludedDummies) as $file) {
            $className = $file->getBasename('.php');
            $fullClassName = 'Kpacha\ComponentBenchmark\Dummy\Validation\\' . $className;
            $subjects[$className] = new $fullClassName;
        }

        return $subjects;
    }

    private static function getDummyFiles(array $excludedDummies)
    {
        $finder = self::getFinderFactory()->create()->files()->in(__DIR__ . '/Validation')->name('*.php');
        foreach ($excludedDummies as $excludedDummy) {
            $finder->notName($excludedDummy . '.php');
        }

        return $finder;
    }
}
