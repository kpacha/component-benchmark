<?php

namespace Kpacha\ComponentBenchmark\Validation;

use Fuel\Validation\Validator as FuelValidator;

/**
 * Description of Fuel
 *
 * @author Kpacha <kpacha666@gmail.com>
 */
class Fuel extends ValidationBenchmark
{

    private $validator;

    public function init()
    {
        $this->validator = new FuelValidator;

        $this->validator->addField('name', 'The user name')->required()->regex(self::ALPHA_REGEX);
        $this->validator->addField('email', 'Email Address')->required()->email();
        $this->validator->addField('description', 'A not too long text')->required()->minLength(5)->maxLength(50);
        $this->validator->addField('age', 'The user age')->required()->numericBetween(0,100);
        $this->validator->addField('nick', 'The user nick')->required()->regex(self::ALNUM_REGEX);
        $this->validator->addField('accountBalance', 'The user account balance')->required()->number();
        $this->validator->addField('views', 'Total views')->required()->number();
    }

    public function run(array $targets)
    {
        $errors = array();
        foreach ($targets as $subject) {
            $this->init();
            $result = $this->validator->run((array) $subject);
            if (!$result->isValid()) {
                $errors[] = $result->getErrors();
            }
        }
        return $errors;
    }

}
