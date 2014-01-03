<?php

namespace Kpacha\ComponentBenchmark\Validation;

use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\Email;
use Phalcon\Validation\Validator\StringLength;
use Phalcon\Validation\Validator\Between;
use Phalcon\Validation;

/**
 * Description of Phalcon
 *
 * @author Kpacha <kpacha666@gmail.com>
 */
class Phalcon implements ValidationBenchmark
{

    private $validator;

    public function init()
    {
        $this->validator = new Validation();

        $this->validator->add('name',
                new PresenceOf(array(
                    'message' => 'The name is required'
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
    }

    public function run(array $targets)
    {
        foreach ($targets as $name => $subject) {
            $this->init();
            $messages = $this->validator->validate((array) $subject);
            foreach ($messages as $message) {
                echo "$name $message\n";
            }
        }
    }

}
