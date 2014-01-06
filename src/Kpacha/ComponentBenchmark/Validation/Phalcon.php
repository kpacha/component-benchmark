<?php

namespace Kpacha\ComponentBenchmark\Validation;

use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\Email;
use Phalcon\Validation\Validator\StringLength;
use Phalcon\Validation\Validator\Between;
use Phalcon\Validation\Validator\Regex;
use Phalcon\Validation\Validator\InclusionIn;
use Phalcon\Validation;

/**
 * Description of Phalcon
 *
 * @author Kpacha <kpacha666@gmail.com>
 */
class Phalcon extends ValidationBenchmark
{

    private $validator;

    public function init()
    {
        $this->validator = new Validation();

        $this->validator->add('name',
                new PresenceOf(array(
                    'message' => 'The name is required'
                )));

        $this->validator->add('name',
                new Regex(array(
                    'pattern' => self::ALPHA_REGEX,
                    'message' => 'The name must be an alpha field'
                )));

        $this->validator->add('email',
                new Email(array(
                    'message' => 'The e-mail is not valid'
                )));

        $this->validator->add('description',
                new StringLength(array(
                    'max' => 50,
                    'min' => 5,
                    'messageMaximum' => 'We don\'t like really long names',
                    'messageMinimum' => 'We want more than just their initials'
                )));

        $this->validator->add('age',
                new Between(array(
                    'minimum' => 0,
                    'maximum' => 100,
                    'message' => 'The age must be between 0 and 100'
                )));

        $this->validator->add('nick',
                new Regex(array(
                    'pattern' => self::ALNUM_REGEX,
                    'message' => 'The nick must be an alphanumeric field'
                )));

        $this->validator->add('accountBalance',
                new Regex(array(
                    'pattern' => self::FLOAT_REGEX,
                    'message' => 'The accountBalance value must be a float'
                )));

        $this->validator->add('banned',
                new InclusionIn(array(
                    'domain' => array(true, false),
                    'message' => 'The banned field must be a boolean'
                )));

        $this->validator->add('views',
                new Regex(array(
                    'pattern' => self::POSITIVE_INT_REGEX,
                    'message' => 'The views value must be a natural integer'
                )));
    }

    public function run(array $targets)
    {
        $errors = array();
        $this->init();
        foreach ($targets as $subject) {
            $v = array();
            $violations = $this->validator->validate((array) $subject);
            foreach ($violations as $violation) {
                $v[] = $violation;
            }
            if (count($v)) {
                $errors[] = $v;
            }
        }
        return $errors;
    }

}
