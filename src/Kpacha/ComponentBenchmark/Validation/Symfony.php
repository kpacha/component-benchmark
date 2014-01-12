<?php

namespace Kpacha\ComponentBenchmark\Validation;

use Symfony\Component\Validator\Validation;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Description of Symfony
 *
 * @author Kpacha <kpacha666@gmail.com>
 */
class Symfony extends ValidationBenchmark
{

    private $validator;
    private $constraint;

    public function init()
    {
        $this->validator = Validation::createValidator();

        $this->constraint = new Assert\Collection(array(
                    'name' => array(
                        new Assert\NotBlank,
                        new Assert\Type(array(
                            'type' => 'string',
                            'message' => 'The value {{ value }} is not a valid {{ type }}.'
                        ))
                    ),
                    'email' => new Assert\Email,
                    'description' => new Assert\Length(array(
                        'min' => 5,
                        'max' => 50,
                        'minMessage' => 'We want more than just their initials',
                        'maxMessage' => 'We don\'t like really long names',
                    )),
                    'age' => array(
                        new Assert\Type(array(
                            'type' => 'integer',
                            'message' => 'The value {{ value }} is not a valid {{ type }}.'
                        )),
                        new Assert\Range(array(
                            'min' => 0,
                            'max' => 100,
                            'minMessage' => 'age must be greater than or equal to 0',
                            'maxMessage' => 'age must be greater than or less than 100',
                        ))
                    ),
                    'nick' => new Assert\Regex(array(
                        'pattern' => self::ALNUM_REGEX,
                        'message' => 'The nick must be an alphanumeric field'
                    )),
                    'creditCard' => array(
                        new Assert\Luhn(array(
                            'message' => 'Please check your credit card number'
                        )),
                        new Assert\CardScheme(array(
                            'schemes' => array(
                                'VISA',
                                'MASTERCARD'
                            ),
                            'message' => 'Your credit card number is invalid.',
                        ))
                    ),
                    'accountBalance' => new Assert\Type(array(
                        'type' => 'float',
                        'message' => 'The value {{ value }} is not a valid {{ type }}.'
                    )),
                    'banned' => new Assert\Type(array(
                        'type' => 'boolean',
                        'message' => 'The banned field must be a boolean'
                    )),
                    'views' => new Assert\Regex(array(
                        'pattern' => self::POSITIVE_INT_REGEX,
                        'message' => 'The views value must be a natural integer'
                    )),
                ));
    }

    public function run(array $targets)
    {
        $errors = array();
        $this->init();
        foreach ($targets as $subject) {
            $violations = $this->validator->validateValue((array) $subject, $this->constraint);
            if (count($violations)) {
                $errors[] = $violations;
            }
        }

        return $errors;
    }
}
