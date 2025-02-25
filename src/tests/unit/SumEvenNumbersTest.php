<?php

namespace tests\unit;

use app\dto\SumEvenNumbersDto;
use app\services\SumEvenCalculator;
use app\validators\NumbersValidator;
use PHPUnit\Framework\TestCase;
use yii\base\InvalidArgumentException;

class SumEvenNumbersTest extends TestCase
{
    public function testSumEvenNumbers()
    {
        $dto = new SumEvenNumbersDto(['numbers' => [1, 2, 3, 4, 5, 6]]);
        $calculator = new SumEvenCalculator();

        $this->assertEquals(12, $calculator->calculate($dto));
    }

    public function testSumWithNoEvenNumbers()
    {
        $dto = new SumEvenNumbersDto(['numbers' => [1, 3, 5, 7]]);
        $calculator = new SumEvenCalculator();

        $this->assertEquals(0, $calculator->calculate($dto));
    }

    public function testValidatorFailsOnInvalidData()
    {
        $validator = new NumbersValidator();
        $validator->numbers = ["a", "b", 3];

        $this->assertFalse($validator->validate());
    }

    public function testValidatorPassesOnValidData()
    {
        $validator = new NumbersValidator();
        $validator->numbers = [2, 4, 6];

        $this->assertTrue($validator->validate());
    }

    public function testDtoThrowsExceptionWhenNumbersKeyIsMissing()
    {
        $this->expectException(InvalidArgumentException::class);
        new SumEvenNumbersDto([]);
    }

    public function testDtoThrowsExceptionWhenNumbersIsNotArray()
    {
        $this->expectException(InvalidArgumentException::class);
        new SumEvenNumbersDto(['numbers' => 'not an array']);
    }
}
