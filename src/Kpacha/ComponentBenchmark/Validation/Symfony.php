<?php

namespace Kpacha\ComponentBenchmark\Validation;

use Symfony\Component\Validator\Validation;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Description of Symfony
 *
 * @author Kpacha <kpacha666@gmail.com>
 */
class Symfony implements ValidationBenchmark
{

    private $validator;
    private $constraint;

    public function init()
    {
        $this->validator = Validation::createValidator();

        $this->constraint = new Assert\Collection(array(
                    'name' => new Assert\NotBlank,
                    'email' => new Assert\Email,
                    'description' => new Assert\Length(array(
                        'min' => 5,
                        'max' => 50,
                        'minMessage' => 'We want more than just their initials',
                        'maxMessage' => 'We don\'t like really long names',
                    )),
                    'age' => new Assert\Range(array(
                        'min' => 0,
                        'max' => 100,
                        'minMessage' => 'age must be greater than or equal to 0',
                        'maxMessage' => 'age must be greater than or less than 100',
                    ))
                ));
    }

    public function run(array $targets)
    {
        foreach ($targets as $name => $subject) {
            $this->init();
            $messages = $this->validator->validateValue((array) $subject, $this->constraint);
            foreach ($messages as $message) {
                echo "$name {$message->getMessage()}\n";
            }
        }
    }

}
