<?php

namespace Kpacha\ComponentBenchmark\Validation;

use Respect\Validation\Validator as v;

/**
 * Description of Respect
 *
 * @author Kpacha <kpacha666@gmail.com>
 */
class Respect extends ValidationBenchmark
{

    private $validator;

    public function init()
    {
        $this->validator = v::attribute('name', v::string()->notEmpty())
                ->attribute('email', v::email())
                ->attribute('description', v::string()->length(5, 50))
                ->attribute('age', v::callback('is_int')->between(0, 100))
                ->attribute('nick', v::string()->alnum()->noWhitespace())
                ->attribute('creditCard', v::numeric()->creditCard())
                ->attribute('accountBalance', v::float())
                ->attribute('banned', v::bool())
                ->attribute('views', v::callback('is_int')->positive());
    }

    public function run(array $targets)
    {
        $this->init();
        $errors = array();
        foreach ($targets as $subject) {
            try {
                $this->validator->assert($subject);
            } catch (\InvalidArgumentException $e) {
                $errors[] = $e->getFullMessage();
            }
        }

        return $errors;
    }
}
