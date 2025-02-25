<?php

namespace app\services;

use app\dto\SumEvenNumbersDto;
use app\services\interfaces\SumCalculatorInterface;

class SumEvenCalculator implements SumCalculatorInterface
{
    public function calculate(SumEvenNumbersDto $dto): int
    {
        return array_sum(array_filter($dto->getNumbers(), fn($num) => $num % 2 === 0));
    }
}
