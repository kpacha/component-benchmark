<?php

namespace Kpacha\ComponentBenchmark\Validation;

use Zend\Validator\EmailAddress;
use Zend\Validator\NotEmpty;
use Zend\Validator\StringLength;
use Zend\Validator\Between;
use Zend\Validator\Regex;
use Zend\Validator\CreditCard;

/**
 * Description of ZF2
 *
 * @author Kpacha <kpacha666@gmail.com>
 */
class ZF2 extends ValidationBenchmark
{

    private $validators = array();
    private $errors = array();

    public function init()
    {
        $this->validators['name'] = array(new StringLength, new NotEmpty);
        $this->validators['email'] = array(new EmailAddress);
        $this->validators['description'] = array(
            new StringLength(array(
                'min' => 5,
                'max' => 50
            ))
        );
        $this->validators['age'] = array(
            new Between(array(
                'min' => 0,
                'max' => 100
            ))
        );
        $this->validators['nick'] = array(
            new Regex(array(
                'pattern' => self::ALNUM_REGEX,
                'message' => 'The nick must be an alphanumeric field'
            ))
        );
        $this->validators['creditCard'] = array(
            new CreditCard(array(
                'type' => array(
                    CreditCard::AMERICAN_EXPRESS,
                    CreditCard::VISA
                ),
                'message' => 'Your credit card number is invalid'
            ))
        );
        $this->validators['accountBalance'] = array(
            new Regex(array(
                'pattern' => self::FLOAT_REGEX,
                'message' => 'The accountBalance value must be a float'
            ))
        );
//        $this->validators['banned'] = array(
//        );
        $this->validators['views'] = array(
            new Regex(array(
                'pattern' => self::POSITIVE_INT_REGEX,
                'message' => 'The views value must be a natural integer'
            ))
        );
        $this->errors = array();
    }

    public function run(array $targets)
    {
        $errors = array();
        foreach ($targets as $subject) {
            $this->init();
            if (!$this->validate($subject)) {
                $errors[] = $this->getErrors();
            }
        }
        return $errors;
    }

    private function validate($subject)
    {
        foreach ($this->validators as $name => $atributeValidators) {
            foreach ($atributeValidators as $validator) {
                if (!$validator->isValid($subject->$name)) {
                    $this->parseMessages($validator->getMessages());
                }
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
