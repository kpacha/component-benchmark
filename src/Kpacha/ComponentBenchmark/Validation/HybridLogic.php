<?php

namespace Kpacha\ComponentBenchmark\Validation;

use HybridLogic\Validation\Validator as HybridLogicValidator;
use HybridLogic\Validation\Rule;

/**
 * Description of HybridLogic
 *
 * @author Kpacha <kpacha666@gmail.com>
 */
class HybridLogic extends ValidationBenchmark
{

    private $validator;

    public function init()
    {
        $this->validator = new HybridLogicValidator();
        $this->validator
                ->add_rule('name', new Rule\NotEmpty)
                ->add_rule('name', new Rule\Regex(self::ALPHA_REGEX))
                ->add_rule('email', new Rule\NotEmpty)
                ->add_rule('email', new Rule\Email)
                ->add_rule('description', new Rule\MinLength(5))
                ->add_rule('description', new Rule\MaxLength(50))
                ->add_rule('age', new Rule\NumRange(0, 100))
                ->add_rule('nick', new Rule\AlphaNumeric)
                ->add_rule('accountBalance', new Rule\Number)
                ->add_rule('views', new Rule\NumNatural)
        ;
    }

    public function run(array $targets)
    {
        $errors = array();
        foreach ($targets as $subject) {
            $this->init();
            if (!$this->validator->is_valid((array) $subject)) {
                $errors[] = $this->validator->get_errors();
            }
        }

        return $errors;
    }
}
