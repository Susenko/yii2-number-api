<?php

namespace app\services\interfaces;

use app\dto\SumEvenNumbersDto;

interface SumCalculatorInterface
{
    public function calculate(SumEvenNumbersDto $dto): int;
}
