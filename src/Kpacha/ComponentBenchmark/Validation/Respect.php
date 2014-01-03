<?php

namespace Kpacha\ComponentBenchmark\Validation;

use Respect\Validation\Validator as v;

/**
 * Description of Respect
 *
 * @author Kpacha <kpacha666@gmail.com>
 */
class Respect implements ValidationBenchmark
{

    private $validator;

    public function init()
    {
        $this->validator = v::attribute('name', v::string()->notEmpty())
                ->attribute('email', v::email())
                ->attribute('description', v::string()->length(5, 50))
                ->attribute('age', v::numeric()->between(0, 100));
    }

    public function run(array $targets)
    {
        foreach ($targets as $name => $subject) {
            $this->init();
            try {
                $this->validator->assert($subject);
            } catch (\InvalidArgumentException $e) {
                echo "$name {$e->getFullMessage()}\n";
            }
        }
    }

}
