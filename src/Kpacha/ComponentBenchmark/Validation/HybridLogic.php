<?php

namespace Kpacha\ComponentBenchmark\Validation;

use HybridLogic\Validation\Validator as HybridLogicValidator;
use HybridLogic\Validation\Rule;

/**
 * Description of HybridLogic
 *
 * @author Kpacha <kpacha666@gmail.com>
 */
class HybridLogic implements ValidationBenchmark
{

    private $validator;

    public function init()
    {
        $this->validator = new HybridLogicValidator();
        $this->validator
                ->add_rule('name', new Rule\NotEmpty)
                ->add_rule('email', new Rule\NotEmpty)
                ->add_rule('email', new Rule\Email)
                ->add_rule('description', new Rule\MinLength(5))
                ->add_rule('description', new Rule\MaxLength(50))
                ->add_rule('age', new Rule\NumMax(100))
                ->add_rule('age', new Rule\NumMin(0))
        ;
    }

    public function run(array $targets)
    {
        foreach ($targets as $name => $subject) {
            $this->init();
            if (!$this->validator->is_valid((array) $subject)) {
                foreach ($this->validator->get_errors() as $message) {
                    echo "$name $message\n";
                }
            }
        }
    }

}
