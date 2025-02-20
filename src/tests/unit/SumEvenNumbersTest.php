<?php

namespace tests\unit;

use app\dto\SumEvenNumbersDto;
use app\validators\NumbersValidator;
use PHPUnit\Framework\TestCase;

class SumEvenNumbersTest extends TestCase
{
    public function testSumEvenNumbers()
    {
        $dto = new SumEvenNumbersDto([1, 2, 3, 4, 5, 6]);
        $this->assertEquals(12, $dto->getSumEven());
    }

    public function testSumWithNoEvenNumbers()
    {
        $dto = new SumEvenNumbersDto([1, 3, 5, 7]);
        $this->assertEquals(0, $dto->getSumEven());
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
}
