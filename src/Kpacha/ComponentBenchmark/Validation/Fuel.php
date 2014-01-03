<?php

namespace Kpacha\ComponentBenchmark\Validation;

use Fuel\Validation\Base as FuelBase;

/**
 * Description of Fuel
 *
 * @author Kpacha <kpacha666@gmail.com>
 */
class Fuel implements ValidationBenchmark
{

    private $validator;

    public function init()
    {
        $this->validator = new FuelBase;

        $this->validator->validate('name', function($v) {
                    return $v->require();
                });
        $this->validator->validate('email', function($v) {
                    return $v->isEmail();
                });
        $this->validator->validate('description',
                function($v) {
                    return $v->atLeastChars(5)
                            and $v->atMostChars(50);
                });
        $this->validator->validate('age',
                function($v) {
                    return $v->atLeastNum(0)
                            and $v->atMostNum(100);
                });
    }

    public function run(array $targets)
    {
        foreach ($targets as $name => $subject) {
            $this->init();
            if (!$this->validator->execute((array) $subject)) {
                foreach ((array) $this->validator->getError() as $message) {
                    echo "$name $message\n";
                }
            }
        }
    }

}
