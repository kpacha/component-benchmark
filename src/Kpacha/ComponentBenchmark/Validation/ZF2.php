<?php

namespace Kpacha\ComponentBenchmark\Validation;

use Zend\Validator\EmailAddress;
use Zend\Validator\NotEmpty;
use Zend\Validator\StringLength;
use Zend\Validator\Between;

/**
 * Description of ZF2
 *
 * @author Kpacha <kpacha666@gmail.com>
 */
class ZF2 implements ValidationBenchmark
{

    private $validators = array();
    private $errors = array();

    public function init()
    {
        $this->validators['name'] = new NotEmpty;
        $this->validators['email'] = new EmailAddress;
        $this->validators['description'] = new StringLength(array('min' => 5, 'max' => 50));
        $this->validators['age'] = new Between(array('min' => 0, 'max' => 100));
        $this->errors = array();
    }

    public function run(array $targets)
    {
        foreach ($targets as $name => $subject) {
            $this->init();
            if (!$this->validate($subject)) {
                foreach ((array) $this->getErrors() as $message) {
                    echo "$name $message\n";
                }
            }
        }
    }

    private function validate($subject)
    {
        foreach ($this->validators as $name => $validator) {
            if (!$validator->isValid($subject->$name)) {
                $this->parseMessages($validator->getMessages());
            }
        }
        return !count($this->errors);
    }

    private function parseMessages($messages)
    {
        foreach ($messages as $message) {
            $this->errors[] = $message;
        }
    }

    private function getErrors()
    {
        return $this->errors;
    }

}
