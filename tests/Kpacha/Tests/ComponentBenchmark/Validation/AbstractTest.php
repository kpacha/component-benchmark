<?php

namespace Kpacha\Tests\ComponentBenchmark\Validation;

use Kpacha\ComponentBenchmark\Validation\ValidationBenchmark;
use Kpacha\ComponentBenchmark\Dummy\Validation as DummySubjects;

/**
 * Description of RespectTest
 *
 * @author Kpacha <kpacha666@gmail.com>
 */
abstract class AbstractTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @var Kpacha\ComponentBenchmark\Validation\ValidationBenchmark 
     */
    private $validatorBenchmark;

    /**
     * @param mixed $subject
     * @param boolean $expectedResult
     * @dataProvider validationSubjectProvider
     */
    public function testValidation($subject, $expectedCount)
    {
        $this->assertCount($expectedCount, $violations = $this->validatorBenchmark->run(array($subject)));
    }

    public function validationSubjectProvider()
    {
        return array(
            'KoAlpha' => array(new DummySubjects\KoAlpha, 1),
//            'KoBoolean' => array(new DummySubjects\KoBoolean, 1),
//            'KoCreditCard' => array(new DummySubjects\KoCreditCard, 1),
            'KoEmail' => array(new DummySubjects\KoEmail, 1),
            'KoEmpty' => array(new DummySubjects\KoEmpty, 1),
            'KoFloat' => array(new DummySubjects\KoFloat, 1),
            'KoInteger' => array(new DummySubjects\KoInteger, 1),
            'KoLong' => array(new DummySubjects\KoLong, 1),
            'KoNegative' => array(new DummySubjects\KoNegative, 1),
            'KoNumber' => array(new DummySubjects\KoNumber, 1),
            'KoShort' => array(new DummySubjects\KoShort, 1),
            'KoString' => array(new DummySubjects\KoString, 1),
            'OkSubject' => array(new DummySubjects\OkSubject, 0),
        );
    }

    protected function setValidatorBenchmark(ValidationBenchmark $validatorBenchmark)
    {
        $this->validatorBenchmark = $validatorBenchmark;
    }

}
